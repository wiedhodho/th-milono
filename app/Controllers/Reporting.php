<?php

namespace App\Controllers;

use App\Models\Mkeuangan;
use App\Models\Mcustomer;
use App\Models\Mtransaksi;

class Reporting extends BaseController {
	protected $halaman = 'keuangan/';

	public function index() {
		$data['title'] = 'Download Laporan';
		$data['tgl'] = date('d');
		$data['bln'] = date('m');
		$data['thn'] = date('Y');
		return view($this->halaman . 'report', $data);
	}

	public function tagihan() {
		$data['title'] = 'Cetak Tagihan';
		$data['tgl'] = date('d');
		$data['bln'] = date('m');
		$data['thn'] = date('Y');
		$cust = new Mcustomer();
		$data['customer'] = $cust->select('customer_id, customer_nama, count(transaksi_id) as banyak')
			->join('transaksi', 'transaksi_customer=customer_id')
			->where('transaksi_status', 4)
			->groupBy('customer_id')->orderBy('customer_nama')->findAll();
		return view('transaksi/tagihan', $data);
	}

	public function cetak_tagihan() {
		$transaksi = new Mtransaksi();
		$data['mulai'] = $this->request->getPost('mulai');
		$data['selesai'] = $this->request->getPost('selesai');
		$data['transaksi'] = $transaksi
			->select('transaksi_id,transaksi_total,transaksi_created, customer_nama, (SELECT barang_pekerjaan FROM barang WHERE barang_transaksi=transaksi_id LIMIT 1) as barang_pekerjaan')
			->join('customer', 'transaksi_customer=customer_id')
			->where('transaksi_created >=', $this->request->getPost('mulai'))
			->where('transaksi_created <=', $this->request->getPost('selesai'))
			->where('transaksi_customer', $this->request->getPost('customer'))
			->where('transaksi_status', 4)
			->findAll();
		$dompdf = new \Dompdf\Dompdf();
		$dompdf->loadHtml(view('transaksi/cetak_tagihan', $data));
		$dompdf->setPaper('A4');
		$dompdf->render();
		$dompdf->stream('tagihan.pdf');
	}

	public function download() {
		$keuangan = new Mkeuangan();
		$data['mulai'] = $this->request->getPost('mulai');
		$data['selesai'] = $this->request->getPost('selesai');
		$keuangan
			->where('keuangan_created >=', $this->request->getPost('mulai'))
			->where('keuangan_created <=', $this->request->getPost('selesai'));
		if ($this->request->getPost('transfer') != -1) {
			$keuangan->where('keuangan_transfer', $this->request->getPost('transfer'));
		}
		$data['keuangan'] = $keuangan->findAll();
		$dompdf = new \Dompdf\Dompdf();
		$dompdf->loadHtml(view($this->halaman . 'cetak', $data));
		$dompdf->setPaper('A4');
		$dompdf->render();
		$dompdf->stream('laporan_keuangan.pdf');
	}
}
