<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Mtransaksi;
use App\Models\Mbarang;
use App\Models\Mcustomer;
use App\Models\Msatuan;
use App\Models\Mhistory;
use App\Libraries\Definisi;

class Transaksi extends BaseController {
	protected $halaman = 'transaksi/';
	protected $model;

	public function __construct() {
		$this->model = new Mtransaksi();
	}

	public function index() {
		$data['title'] = 'List transaksi';
		$def = new Definisi();
		$data['status'] = $def->status();
		$data['transaksi'] = $this->model
			->select('transaksi_id,customer_nama, transaksi_updated, transaksi_status, (SELECT barang_pekerjaan FROM barang WHERE barang_transaksi=transaksi_id LIMIT 1) as barang_pekerjaan')
			->join('customer', 'transaksi_customer=customer_id')
			->orderBy('transaksi_updated', 'desc')
			->findAll();
		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'index', $data);
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
				'barang_harga' => $d['harga']
			);
			$total += $d['harga'];
		}

		$data = [
			'transaksi_customer' => $this->request->getPost('customer'),
			'transaksi_user' => session()->userid,
			'transaksi_status' => 0,
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
				'history_status' => 0,
			]);
			$this->notif('Transaksi Berhasil disimpan.');
		} else {
			$this->notif('Transaksi Gagal disimpan.', 'error');
		}
		return redirect()->to('/transaksi');
	}

	public function edit($id) {
		$data['title'] = 'Edit transaksi';

		$data['validation'] = \Config\Services::validation();
		$data['item'] = $this->model->find($id);
		return view($this->halaman . 'edit', $data);
	}

	public function update($id) {
		$valid = $this->model->getOwnValidationRules();

		if (!$this->validate($valid)) {
			return redirect()
				->to('/transaksi/edit/' . $id)
				->withInput();
		}


		$data = [
			'transaksi_id' => $id,
			'transaksi_nama' => $this->request->getPost('nama'),
			'transaksi_alamat' => $this->request->getPost('alamat'),
			'transaksi_telp' => $this->request->getPost('telp'),
			'transaksi_user' => session()->userid,
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

	public function delete($id) {
		$r = $this->model->delete($id);

		if ($r) {
			$this->notif('transaksi Berhasil dihapus.');
		} else {
			$this->notif('transaksi Gagal dihapus.', 'error');
		}
		return redirect()->to('/transaksi');
	}
}
