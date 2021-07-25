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
