<?php

namespace App\Libraries;

class Definisi {
	public function level() {
		$data = [
			1 => 'Owner',
			2 => 'Admin',
			3 => 'Operator',
			4 => 'Kepala Bengkel'
		];
		return $data;
	}

	public function status() {
		$data = [
			0 => ['label' => 'Batal', 'warna' => 'danger'],
			1 => ['label' => 'Barang Masuk', 'warna' => 'secondary'],
			2 => ['label' => 'Dikerjakan', 'warna' => 'danger'],
			3 => ['label' => 'Selesai', 'warna' => 'warning'],
			4 => ['label' => 'Diambil', 'warna' => 'primary'],
			5 => ['label' => 'Dibayar', 'warna' => 'info'],
		];
		return $data;
	}
}
