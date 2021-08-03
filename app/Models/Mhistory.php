<?php

namespace App\Models;

use CodeIgniter\Model;

class Mhistory extends Model {
	protected $table = 'history';
	protected $primaryKey = 'history_id';

	protected $returnType = 'object';
	protected $useSoftDeletes = false;

	protected $allowedFields = [
		'history_transaksi',
		'history_user',
		'history_status',
		'history_tanggal'
	];

	protected $createdField = 'history_tanggal';
	protected $updatedField = 'history_tanggal';
	protected $useTimestamps = true;

	protected $validationRules = [];
}
