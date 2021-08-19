<?php

namespace App\Models;

use CodeIgniter\Model;

class Mbarang extends Model {
	protected $table = 'barang';
	protected $primaryKey = 'barang_id';

	protected $returnType = 'object';
	protected $useSoftDeletes = true;

	protected $allowedFields = [
		'barang_transaksi',
		'barang_nama',
		'barang_pekerjaan',
		'barang_harga',
		'barang_qty',
		'barang_satuan',
	];

	protected $useTimestamps = true;
	protected $createdField = 'barang_created';
	protected $updatedField = 'barang_updated';
	protected $deletedField = 'barang_deleted';

	protected $validationRules = [];
}
