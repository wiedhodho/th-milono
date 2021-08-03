<?php

namespace App\Models;

use CodeIgniter\Model;

class Msatuan extends Model {
	protected $table = 'satuan';
	protected $primaryKey = 'satuan_id';

	protected $returnType = 'object';
	protected $useSoftDeletes = false;

	protected $allowedFields = [
		'satuan_nama'
	];

	protected $useTimestamps = false;

	protected $validationRules = [];
}
