<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Definisi;

use App\Models\Mhistory;

class History extends BaseController {
	protected $halaman = 'history/';
	protected $model;

	public function __construct() {
		$this->model = new Mhistory();
	}

	public function detail($id) {
		$data['title'] = 'Detail';
		$def = new Definisi();
		$data['status'] = $def->status();

		$data['item'] = $this->model->join('users', 'history_user=users_id')->where('history_transaksi', $id)->findAll();
		return view($this->halaman . 'detail', $data);
	}
}
