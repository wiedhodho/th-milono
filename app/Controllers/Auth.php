<?php

namespace App\Controllers;

// use App\Models\PengaturanModel;
use App\Models\User;
use App\Models\OpdModel;

class Auth extends BaseController {
	protected $halaman = 'login/';
	protected $model;

	public function __construct() {
		$this->model = new User();
		// $this->pengaturanModel = new PengaturanModel();
	}

	public function index() {
		if (session()->isLoggedIn) {
			return redirect()->to(site_url('/home'));
		}

		// $data['pengaturan'] = $this->pengaturanModel->first();
		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'index', $data);
	}

	public function register() {
		if (session()->isLoggedIn) {
			return redirect()->to(site_url('/home'));
		}
		$opd = new OpdModel();
		$data['opd'] = $opd->findAll();
		// $data['pengaturan'] = $this->pengaturanModel->first();
		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'register', $data);
	}

	public function register_save() {
		// dd($this->request->getPost());
		$valid = $this->model->getOwnValidationRules();
		$foto = $this->request->getFile('foto');
		$ktp = $this->request->getFile('ktp');
		$valid['foto'] = 'uploaded[foto]|max_size[foto,4196]';
		$valid['ktp'] = 'uploaded[ktp]|max_size[ktp,4196]';
		$valid['ulangi_password'] = 'matches[password]';

		if (!$this->validate($valid)) {
			return redirect()
				->to('/auth/register')
				->withInput();
		}
		if ($foto->isValid()) {
			$foto->move(ROOTPATH . getenv('PUBLIC_PATH') . '/foto');
			$file_foto = $foto->getName();
		}
		if ($ktp->isValid()) {
			$ktp->move(ROOTPATH . getenv('PUBLIC_PATH') . '/foto');
			$file_ktp = $ktp->getName();
		}

		$data = [
			'users_name' => $this->request->getPost('name'),
			'users_nama' => $this->request->getPost('nama'),
			'users_password' => $this->request->getPost('password'),
			'users_email' => $this->request->getPost('email'),
			'users_level' => 5,
			'users_nohp' => $this->request->getPost('nohp'),
			'users_nik' => $this->request->getPost('nik'),
			'users_nip' => $this->request->getPost('nip'),
			'users_pangkat' => $this->request->getPost('pangkat'),
			'users_jabatan' => $this->request->getPost('jabatan'),
			'users_opd' => $this->request->getPost('opd'),
			'users_foto' => $file_foto,
			'users_aktif' => 0,
			'users_ktp' => $file_ktp
		];

		$r = $this->model->save($data);
		if ($r) {
			$this->notif('Pendaftaran Berhasil.');
		} else {
			// dd($this->model->errors());
			$this->notif('Pendaftaran Gagal.', 'error');
		}
		return redirect()->to(site_url('/auth'));
	}

	public function check_login() {
		$rules = [
			'username' => 'required|min_length[5]',
			'password' => 'required|min_length[5]|checkLogin[username,password]',
		];
		$errors = [
			'password' => [
				'checkLogin' => 'Username dan password tidak terdaftar.',
			],
		];

		if (!$this->validate($rules, $errors)) {
			// $validation = \Config\Services::validation();
			return redirect()
				->to('/auth')
				->withInput();
		}

		// $data = $this->model
		// 	->where('users_name', $this->request->getPost('username'))
		// 	->find();
		// dd($data);
		$data = $this->model
			->where('users_name', $this->request->getPost('username'))
			->find()[0];

		if ($data->users_aktif != 1) {
			return redirect()->to('/auth')->with('tipe', 'danger')->with('pesan', 'Akun anda belum aktif! Silahkan hubungi administrator.');
		}
		$this->regSession($data);
		return redirect()->to('/home');
	}

	protected function regSession($x) {
		$data = [
			'isLoggedIn' => true,
			'userid' => $x->users_id,
			'foto' => $x->users_foto,
			'username' => $x->users_name,
			'nama' => $x->users_nama,
			'level' => $x->users_level,
		];
		session()->set($data);
		return true;
	}

	public function logout() {
		// session()->destroy();
		session()->remove('isLoggedIn');
		$this->notif('Terima kasih');
		return redirect()->to('/auth')->with('logout', true);
	}
}
