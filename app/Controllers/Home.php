<?php

namespace App\Controllers;

use App\Models\Mtransaksi;
use App\Models\Mcustomer;

class Home extends BaseController {
	protected $halaman = 'dashboard/';

	public function index() {
		$customer = new Mcustomer();
		$transaksi = new Mtransaksi();
		$data['home'] = 'oke';
		$data['customer'] = $customer->countAllResults();
		$data['count_transaksi'] = $transaksi->where('transaksi_status<', 3)->where('transaksi_status>', 0)->countAllResults();
		$bln_ini = date('Y-m');
		$data['transaksi_bln_ini'] = $transaksi->like('transaksi_created', $bln_ini, 'after')->where('transaksi_status>', 0)->countAllResults();
		$data['last_trx'] = $transaksi->select('customer_nama, transaksi_created,(SELECT barang_nama FROM barang WHERE barang_transaksi=transaksi_id LIMIT 1) as barang')
			->join('customer', 'transaksi_customer=customer_id')->orderBy('transaksi_id', 'DESC')->findAll(5);
		$data['trx_per_bulan'] = $transaksi->select('count(transaksi_id) as banyak,MONTH(transaksi_created) as bulan')->where('transaksi_status>', 0)->where('YEAR(transaksi_created)', date('Y'))->groupBy('MONTH(transaksi_created)')->findAll();
		return view($this->halaman . 'index', $data);
	}
}
