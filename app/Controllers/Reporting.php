<?php

namespace App\Controllers;

use App\Models\Mkeuangan;

class Reporting extends BaseController {
	protected $halaman = 'keuangan/';

	public function index() {
		$data['title'] = 'Download Laporan';
		$data['tgl'] = date('d');
		$data['bln'] = date('m');
		$data['thn'] = date('Y');
		return view($this->halaman . 'report', $data);
	}

	public function download() {
		$keuangan = new Mkeuangan();
		$data['mulai'] = $this->request->getPost('mulai');
		$data['selesai'] = $this->request->getPost('selesai');
		$data['keuangan'] = $keuangan
			->where('keuangan_created >=', $this->request->getPost('mulai'))
			->where('keuangan_created <=', $this->request->getPost('selesai'))
			->findAll();
		$dompdf = new \Dompdf\Dompdf();
		$dompdf->loadHtml(view($this->halaman . 'cetak', $data));
		$dompdf->setPaper('A4');
		$dompdf->render();
		$dompdf->stream();
	}
}
