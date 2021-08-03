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
			-1 => ['label' => 'Batal', 'warna' => 'danger'],
			0 => ['label' => 'Barang Masuk', 'warna' => 'secondary'],
			1 => ['label' => 'Dikerjakan', 'warna' => 'danger'],
			2 => ['label' => 'Selesai', 'warna' => 'warning'],
			3 => ['label' => 'Diambil', 'warna' => 'primary'],
			4 => ['label' => 'Dibayar', 'warna' => 'info'],
		];
		return $data;
	}
}
