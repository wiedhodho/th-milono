<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\User;
use App\Libraries\Definisi;

class Users extends BaseController {
	protected $halaman = 'users/';
	protected $model;

	public function __construct() {
		$this->model = new User();
	}

	public function index() {
		$data['title'] = 'List users';

		$def = new Definisi();
		$data['users'] = $this->model->findAll();
		$data['level'] = $def->level();
		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'index', $data);
	}

	public function add() {
		$data['title'] = 'Tambah User';

		$def = new Definisi();
		$data['level'] = $def->level();
		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'add', $data);
	}

	public function save() {
		$valid = $this->model->getOwnValidationRules();
		$avatar = $this->request->getFile('foto');
		$foto = 'default.png';

		if ($avatar->isValid()) {
			$avatar->move('foto');
			$foto = $avatar->getName();
		} else {
			return redirect()
				->to('/users/add')
				->withInput();
		}

		$valid['ulangi_password'] = 'matches[password]';

		if (!$this->validate($valid)) {
			return redirect()
				->to('/users/add')
				->withInput();
		}


		$data = [
			'users_name' => $this->request->getPost('name'),
			'users_password' => $this->request->getPost('password'),
			'users_foto' => $foto,
			'users_level' => $this->request->getPost('level'),
			'users_nohp' => $this->request->getPost('nohp'),
			'users_nama' => $this->request->getPost('nama'),
			'users_aktif' => $this->request->getPost('aktif')
		];

		$r = $this->model->save($data);
		if ($r) {
			$this->notif('User Berhasil disimpan.');
		} else {
			$this->notif('User Gagal disimpan.', 'error');
		}
		return redirect()->to('/users');
	}

	public function profil() {
		$data['title'] = 'Profil Anda';

		$def = new Definisi();
		$data['level'] = $def->level();
		$data['validation'] = \Config\Services::validation();
		$data['item'] = $this->model->find(session()->userid);
		return view($this->halaman . 'profil', $data);
	}

	public function edit($id) {
		$data['title'] = 'Edit User';

		$def = new Definisi();
		$data['level'] = $def->level();
		$data['validation'] = \Config\Services::validation();
		$data['item'] = $this->model->find($id);
		return view($this->halaman . 'edit', $data);
	}

	public function update($id) {
		$valid = $this->model->getOwnValidationRules();
		$foto = $this->request->getFile('foto');

		if ($foto->isValid()) {
			$valid['foto'] = 'uploaded[foto]|max_size[foto,4196]';
		}

		if ($this->request->getPost('password') != '') {
			$valid['ulangi_password'] = 'matches[password]';
		}

		unset($valid['password']);

		if (!$this->validate($valid)) {
			return redirect()
				->to('/users/edit/' . $id)
				->withInput();
		}


		$data = [
			'users_id' => $id,
			'users_name' => $this->request->getPost('name'),
			'users_nama' => $this->request->getPost('nama'),
			'users_level' => $this->request->getPost('level'),
			'users_nohp' => $this->request->getPost('nohp'),
			'users_aktif' => $this->request->getPost('aktif')
		];

		if ($foto->isValid()) {
			$foto->move(ROOTPATH . getenv('PUBLIC_PATH') . '/foto');
			$file_foto = $foto->getName();
			$data['users_foto'] = $file_foto;
		}

		if ($this->request->getPost('password') != '') {
			$data['users_password'] = $this->request->getPost('password');
		}

		$r = $this->model->save($data);
		if ($r) {
			$this->notif('Data User Berhasil disimpan.');
			return redirect()->to('/users');
		} else {
			return redirect()->to('/users/edit/' . $id);
			$this->notif('Data User Gagal disimpan.', 'error');
		}
	}

	public function update_profil() {
		$valid = $this->model->getOwnValidationRules();
		$foto = $this->request->getFile('foto');

		if ($foto->isValid()) {
			$valid['foto'] = 'uploaded[foto]|max_size[foto,4196]';
		}

		if ($this->request->getPost('password') != '') {
			$valid['ulangi_password'] = 'matches[password]';
		}

		unset($valid['password']);

		if (!$this->validate($valid)) {
			return redirect()
				->to('/users/profil/')
				->withInput();
		}


		$data = [
			'users_id' => session()->userid,
			'users_name' => $this->request->getPost('name'),
			'users_nama' => $this->request->getPost('nama'),
			'users_nohp' => $this->request->getPost('nohp'),
		];

		if ($foto->isValid()) {
			$foto->move(ROOTPATH . getenv('PUBLIC_PATH') . '/foto');
			$file_foto = $foto->getName();
			$data['users_foto'] = $file_foto;
		}

		if ($this->request->getPost('password') != '') {
			$data['users_password'] = $this->request->getPost('password');
		}

		$r = $this->model->save($data);
		if ($r) {
			$this->notif('Data Profil Berhasil disimpan.');
		} else {
			$this->notif('Data Profil Gagal disimpan.', 'error');
		}
		return redirect()->to('/users/profil/');
	}

	public function delete($id) {
		$r = $this->model->delete($id);

		if ($r) {
			$this->notif('User Berhasil dihapus.');
		} else {
			$this->notif('User Gagal dihapus.', 'error');
		}
		return redirect()->to('/users');
	}
}
