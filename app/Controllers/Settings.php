<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Msetting;

class Settings extends BaseController {
	protected $halaman = 'settings/';
	protected $model;

	public function __construct() {
		$this->model = new Msetting();
	}

	public function index() {
		$data['title'] = 'List Settings';
		$data['data'] = $this->model->findAll();
		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'index', $data);
	}

	public function edit($id) {
		$data['title'] = 'Edit Setting';

		$data['validation'] = \Config\Services::validation();
		$data['item'] = $this->model->find($id);
		return view($this->halaman . 'edit', $data);
	}

	public function update() {
		$data = [
			'setting_name' => $this->request->getPost('nama'),
			'setting_value' => $this->request->getPost('value'),
		];

		if ($this->request->getPost('tipe') == 'file') {
			$file = $this->request->getFile('value');
			if ($file->isValid()) {
				$file->move(ROOTPATH . getenv('PUBLIC_PATH') . '/images');
				$file_nama = $file->getName();
				$data['setting_value'] = $file_nama;
			}
		}

		$r = $this->model->save($data);

		return redirect()->to('/settings');
	}
}
