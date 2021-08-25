<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Mbarang;

class Barang extends BaseController {
	protected $halaman = 'barang/';
	protected $model;

	public function __construct() {
		$this->model = new Mbarang();
	}

	public function detail($id) {
		$data['title'] = 'Detail';

		$data['item'] = $this->model->join('satuan', 'barang_satuan=satuan_id')->where('barang_transaksi', $id)->findAll();
		return view($this->halaman . 'detail', $data);
	}
}
