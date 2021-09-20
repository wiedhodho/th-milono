<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

use App\Models\Mkeuangan;
use App\Models\Mtransaksi;
use App\Models\Mhistory;

class Keuangan extends BaseController {
	protected $halaman = 'keuangan/';
	protected $model;

	public function __construct() {
		$this->model = new Mkeuangan();
	}

	public function index() {
		$data['title'] = 'List keuangan';
		$this->model->orderBy('keuangan_id', 'DESC');
		if ($this->request->getPost('tgl2')) {
			$data['now'] = $this->request->getPost('tgl2');
		} else {
			$data['now'] = date('Y-m-d');
		}
		$this->model->like('keuangan_created', $data['now'], 'after');
		$data['keuangan'] = $this->model->findAll();
		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'index', $data);
	}

	public function approved() {
		$data['title'] = 'List Keuangan Approved';
		$this->model->orderBy('keuangan_id', 'DESC');
		if ($this->request->getPost('tgl2')) {
			$data['now'] = $this->request->getPost('tgl2');
		} else {
			$data['now'] = date('Y-m-d');
		}
		$this->model->like('keuangan_created', $data['now'], 'after');
		$data['keuangan'] = $this->model->where('keuangan_approved!=', null)->findAll();
		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'index', $data);
	}

	public function add() {
		$data['title'] = 'Tambah Keuangan';

		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'add', $data);
	}

	public function save() {
		$valid = $this->model->getOwnValidationRules();

		if (!$this->validate($valid)) {
			return redirect()
				->to('/keuangan/add')
				->withInput();
		}


		$data = [
			'keuangan_keterangan' => $this->request->getPost('keterangan'),
			'keuangan_dk' => $this->request->getPost('dk'),
			'keuangan_transfer' => $this->request->getPost('transfer'),
			'keuangan_nominal' => $this->request->getPost('nominal'),
			'keuangan_user' => session()->userid,
		];

		$r = $this->model->save($data);
		if ($r) {
			$this->notif('Keuangan Berhasil disimpan.');
		} else {
			$this->notif('Keuangan Gagal disimpan.', 'error');
		}
		return redirect()->to('/keuangan');
	}

	public function bayar($trx_id, $transfer) {
		$trx = new Mtransaksi();
		$tr = $trx->join('customer', 'transaksi_customer=customer_id')->find($trx_id);
		$keterangan = 'Pembayaran Nota No. ' . $trx_id . ' an. ' . $tr->customer_nama;
		$data = [
			'keuangan_keterangan' => $keterangan,
			'keuangan_dk' => 'K',
			'keuangan_transfer' => $transfer,
			'keuangan_nominal' => $tr->transaksi_total,
			'keuangan_user' => session()->userid,
		];

		$r = $this->model->save($data);
		if ($r) {
			$hist = new Mhistory();
			$hist->save([
				'history_transaksi' => $trx_id,
				'history_user' => session()->userid,
				'history_status' => 5,
			]);
			$trx->set('transaksi_status', 5);
			$trx->update($trx_id);
			$this->notif('Keuangan Berhasil disimpan.');
		} else {
			$this->notif('Keuangan Gagal disimpan.', 'error');
		}
		return redirect()->to('/transaksi/status/4');
	}

	public function edit($id) {
		$data['title'] = 'Edit Keuangan';

		$data['validation'] = \Config\Services::validation();
		$data['item'] = $this->model->find($id);
		return view($this->halaman . 'edit', $data);
	}

	public function update($id) {
		$valid = $this->model->getOwnValidationRules();

		if (!$this->validate($valid)) {
			return redirect()
				->to('/keuangan/edit/' . $id)
				->withInput();
		}


		$data = [
			'keuangan_id' => $id,
			'keuangan_dk' => $this->request->getPost('dk'),
			'keuangan_transfer' => $this->request->getPost('transfer'),
			'keuangan_keterangan' => $this->request->getPost('keterangan'),
			'keuangan_nominal' => $this->request->getPost('nominal'),
			'keuangan_user' => session()->userid,
		];

		$r = $this->model->save($data);
		if ($r) {
			$this->notif('Data Keuangan Berhasil disimpan.');
			return redirect()->to('/keuangan');
		} else {
			return redirect()->to('/keuangan/edit/' . $id);
			$this->notif('Data Keuangan Gagal disimpan.', 'error');
		}
	}

	public function approve($id) {
		$data = [
			'keuangan_id' => $id,
			'keuangan_approved' => Time::now(),
			'keuangan_approved_by' => session()->userid,
		];

		$r = $this->model->save($data);
		if ($r) {
			$this->notif('Data Keuangan Berhasil disimpan.');
			return redirect()->to('/keuangan');
		} else {
			return redirect()->to('/keuangan/edit/' . $id);
			$this->notif('Data Keuangan Gagal disimpan.', 'error');
		}
	}

	public function delete($id) {
		$r = $this->model->delete($id);

		if ($r) {
			$this->notif('Keuangan Berhasil dihapus.');
		} else {
			$this->notif('Keuangan Gagal dihapus.', 'error');
		}
		return redirect()->to('/keuangan');
	}
}
