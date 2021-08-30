<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Controllers\BaseController;

use App\Models\Mtransaksi;
use App\Models\Mbarang;
use App\Models\Mcustomer;
use App\Models\Msatuan;
use App\Models\Mhistory;
use App\Libraries\Definisi;

class Transaksi extends BaseController {
	use ResponseTrait;
	protected $halaman = 'transaksi/';
	protected $model;

	public function __construct() {
		$this->model = new Mtransaksi();
	}

	public function index() {
		$data['title'] = 'List Semua Transaksi';
		$def = new Definisi();
		$data['status'] = json_encode($def->status());
		$data['tahap'] = '';
		// $data['transaksi'] = $this->model
		// 	->select('transaksi_id,customer_nama, transaksi_updated, transaksi_status, (SELECT barang_pekerjaan FROM barang WHERE barang_transaksi=transaksi_id LIMIT 1) as barang_pekerjaan')
		// 	->join('customer', 'transaksi_customer=customer_id')
		// 	->orderBy('transaksi_updated', 'desc')
		// 	->findAll();

		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'index', $data);
	}

	public function data($tahap = '') {
		if ($tahap == '')
			$data['data'] = $this->model->datatables();
		else
			$data['data'] = $this->model->datatables(['transaksi_status'], [$tahap]);
		$data['recordsTotal'] = $this->model->count_all();
		$data['recordsFiltered'] = $this->model->count_filtered();

		$data['draw'] = $this->request->getGet('draw');
		return $this->respond($data);
	}

	public function status($id) {
		$def = new Definisi();
		$data['status'] = $def->status();
		$status = $data['status'][$id]['label'];
		$data['status'] = json_encode($def->status());
		$data['title'] = 'List Transaksi ' . $status;
		$data['tahap'] = $id;


		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'index', $data);
	}

	public function proses($tahap, $id) {
		$hist = new Mhistory();
		$hist->save([
			'history_transaksi' => $id,
			'history_user' => session()->userid,
			'history_status' => $tahap + 1,
		]);
		$this->model->set('transaksi_status', $tahap + 1);
		$this->model->update($id);
		return redirect()->to($this->request->getUserAgent()->getReferrer());
	}

	public function add() {
		$data['title'] = 'Tambah Transaksi';
		$cust = new Mcustomer();
		$satuan = new Msatuan();
		$data['customer'] = $cust->orderBy('customer_nama')->findAll();
		$data['satuan'] = $satuan->orderBy('satuan_nama')->findAll();
		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'add', $data);
	}

	public function save() {
		$total = 0;
		$data_barang = [];
		foreach ($this->request->getPost('data') as $d) {
			$data_barang[] = array(
				'barang_transaksi' => 0,
				'barang_nama' => $d['nama'],
				'barang_pekerjaan' => $d['pekerjaan'],
				'barang_qty' => $d['qty'],
				'barang_harga' => $d['harga'],
				'barang_satuan' => $d['satuan']
			);
			$total += $d['harga'];
		}

		$data = [
			'transaksi_customer' => $this->request->getPost('customer'),
			'transaksi_user' => session()->userid,
			'transaksi_status' => 1,
			'transaksi_total' => $total,
		];

		$r = $this->model->save($data);
		$last_id = $this->model->getInsertID();

		if ($r) {
			foreach ($data_barang as  $k => $b) {
				$data_barang[$k]['barang_transaksi'] = $last_id;
			}
			$barang = new Mbarang();
			$barang->insertBatch($data_barang);
			$hist = new Mhistory();
			$hist->save([
				'history_transaksi' => $last_id,
				'history_user' => session()->userid,
				'history_status' => 1,
			]);
			$this->notif('Transaksi Berhasil disimpan.');
		} else {
			$this->notif('Transaksi Gagal disimpan.', 'error');
		}
		return redirect()->to('/transaksi');
	}

	public function edit($id) {
		$data['title'] = 'Edit Transaksi';

		$data['validation'] = \Config\Services::validation();
		$data['item'] = $this->model->find($id);

		$barang = new Mbarang();
		$cust = new Mcustomer();
		$satuan = new Msatuan();
		$data['barang'] = $barang->where('barang_transaksi', $id)->findAll();
		$data['customer'] = $cust->orderBy('customer_nama')->findAll();
		$data['satuan'] = $satuan->orderBy('satuan_nama')->findAll();
		return view($this->halaman . 'edit', $data);
	}

	public function print($id) {
		$data['title'] = 'Edit Transaksi';
		$logoPath = ROOTPATH . 'htdocs/img/logo.png';
		$data['extension'] = pathinfo($logoPath, PATHINFO_EXTENSION);
		$data['logo'] = base64_encode(file_get_contents($logoPath));
		$data['validation'] = \Config\Services::validation();
		$data['item'] = $this->model->join('customer', 'transaksi_customer=customer_id')->find($id);

		$barang = new Mbarang();

		$data['barang'] = $barang->join('satuan', 'barang_satuan=satuan_id')->where('barang_transaksi', $id)->findAll();

		$dompdf = new \Dompdf\Dompdf();
		$dompdf->loadHtml(view('transaksi/cetak', $data));
		$dompdf->setPaper('A5', 'landscape');
		$dompdf->render();
		$dompdf->stream();
	}

	public function update($id) {
		$barang = new Mbarang();
		if ($this->request->getPost('deleted') != '') {
			$delete_item = explode(',', $this->request->getPost('deleted'));
			foreach ($delete_item as $d) {
				$barang->delete(['barang_id' => $d]);
			}
		}
		$barang->updateBatch($this->request->getPost('data'), 'barang_id');
		$total = 0;
		foreach ($this->request->getPost('data') as $d) {
			$total = $total + ($d['barang_qty'] * $d['barang_harga']);
		}
		$data = [
			'transaksi_id' => $id,
			'transaksi_customer' => $this->request->getPost('customer'),
			'transaksi_user' => session()->userid,
			'transaksi_total' => $total,
		];

		$r = $this->model->save($data);
		if ($r) {
			$this->notif('Data transaksi Berhasil disimpan.');
			return redirect()->to('/transaksi');
		} else {
			return redirect()->to('/transaksi/edit/' . $id);
			$this->notif('Data transaksi Gagal disimpan.', 'error');
		}
	}
}
