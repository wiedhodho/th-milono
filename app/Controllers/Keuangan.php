<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Mkeuangan;

class Keuangan extends BaseController {
	protected $halaman = 'keuangan/';
	protected $model;

	public function __construct() {
		$this->model = new Mkeuangan();
	}

	public function index() {
		$data['title'] = 'List keuangan';

		$data['keuangan'] = $this->model->findAll();
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
