<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Mtransaksi;

class Transaksi extends BaseController {
	protected $halaman = 'transaksi/';
	protected $model;

	public function __construct() {
		$this->model = new Mtransaksi();
	}

	public function index() {
		$data['title'] = 'List transaksi';

		$data['transaksi'] = $this->model
			->select('customer_nama, transaksi_created, transaksi_status, (SELECT barang_nama FROM barang WHERE barang_transaksi=transaksi_id LIMIT 1) as barang_nama')
			->join('customer', 'transaksi_customer=customer_id')
			->orderBy('transaksi_updated', 'desc')
			->findAll();
		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'index', $data);
	}

	public function add() {
		$data['title'] = 'Tambah transaksi';

		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'add', $data);
	}

	public function save() {
		$valid = $this->model->getOwnValidationRules();

		if (!$this->validate($valid)) {
			return redirect()
				->to('/transaksi/add')
				->withInput();
		}


		$data = [
			'transaksi_nama' => $this->request->getPost('nama'),
			'transaksi_alamat' => $this->request->getPost('alamat'),
			'transaksi_telp' => $this->request->getPost('telp'),
			'transaksi_user' => session()->userid,
		];

		$r = $this->model->save($data);
		if ($r) {
			$this->notif('transaksi Berhasil disimpan.');
		} else {
			$this->notif('transaksi Gagal disimpan.', 'error');
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
