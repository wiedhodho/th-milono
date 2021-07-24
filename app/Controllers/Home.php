<?php

namespace App\Controllers;

// use App\Models\User;

class Home extends BaseController {
	protected $halaman = 'dashboard/';

	public function index() {
		//$user = new User();
		$data['home'] = 'oke';

		return view($this->halaman . 'index', $data);
	}
}
