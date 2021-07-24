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
			0 => ['label' => 'Draft', 'warna' => 'secondary'],
			1 => ['label' => 'Pengajuan', 'warna' => 'info'],
			2 => ['label' => 'Diproses 1 of 3', 'warna' => 'warning'], //kadis
			3 => ['label' => 'Diproses 2 of 3', 'warna' => 'warning'], //kabid
			4 => ['label' => 'Diproses 3 of 3', 'warna' => 'warning'], //kasi
			5 => ['label' => 'Diusulkan ke BSRe', 'warna' => 'primary'], // verif
			6 => ['label' => 'Disetujui', 'warna' => 'primary'], // verif
			7 => ['label' => 'Ditolak', 'warna' => 'danger'], //verif
		];
		return $data;
	}
}
