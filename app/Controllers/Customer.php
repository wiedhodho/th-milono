<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Mcustomer;

class Customer extends BaseController {
	protected $halaman = 'customer/';
	protected $model;

	public function __construct() {
		$this->model = new Mcustomer();
	}

	public function index() {
		$data['title'] = 'List customer';

		$data['customer'] = $this->model->findAll();
		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'index', $data);
	}

	public function add() {
		$data['title'] = 'Tambah Customer';

		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'add', $data);
	}

	public function save() {
		$valid = $this->model->getOwnValidationRules();

		if (!$this->validate($valid)) {
			return redirect()
				->to('/customer/add')
				->withInput();
		}


		$data = [
			'customer_nama' => $this->request->getPost('nama'),
			'customer_alamat' => $this->request->getPost('alamat'),
			'customer_telp' => $this->request->getPost('telp'),
			'customer_user' => session()->userid,
		];

		$r = $this->model->save($data);
		if ($r) {
			$this->notif('Customer Berhasil disimpan.');
		} else {
			$this->notif('Customer Gagal disimpan.', 'error');
		}
		return redirect()->to('/customer');
	}

	public function edit($id) {
		$data['title'] = 'Edit Customer';

		$data['validation'] = \Config\Services::validation();
		$data['item'] = $this->model->find($id);
		return view($this->halaman . 'edit', $data);
	}

	public function update($id) {
		$valid = $this->model->getOwnValidationRules();

		if (!$this->validate($valid)) {
			return redirect()
				->to('/customer/edit/' . $id)
				->withInput();
		}


		$data = [
			'customer_id' => $id,
			'customer_nama' => $this->request->getPost('nama'),
			'customer_alamat' => $this->request->getPost('alamat'),
			'customer_telp' => $this->request->getPost('telp'),
			'customer_user' => session()->userid,
		];

		$r = $this->model->save($data);
		if ($r) {
			$this->notif('Data Customer Berhasil disimpan.');
			return redirect()->to('/customer');
		} else {
			return redirect()->to('/customer/edit/' . $id);
			$this->notif('Data Customer Gagal disimpan.', 'error');
		}
	}

	public function delete($id) {
		$r = $this->model->delete($id);

		if ($r) {
			$this->notif('Customer Berhasil dihapus.');
		} else {
			$this->notif('Customer Gagal dihapus.', 'error');
		}
		return redirect()->to('/customer');
	}
}
