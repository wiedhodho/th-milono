<?php

namespace App\Models;

use CodeIgniter\Model;

class Mkeuangan extends Model {
	protected $table = 'keuangan';
	protected $primaryKey = 'keuangan_id';

	protected $returnType = 'object';
	protected $useSoftDeletes = true;

	protected $allowedFields = [
		'keuangan_nominal',
		'keuangan_keterangan',
		'keuangan_user',
		'keuangan_approved',
		'keuangan_approved_by',
	];

	protected $useTimestamps = true;
	protected $createdField = 'keuangan_created';
	protected $updatedField = 'keuangan_updated';
	protected $deletedField = 'keuangan_deleted';

	protected $validationRules = [
		'keuangan_nominal' => 'required|decimal',
		'keuangan_keterangan' => 'required|min_length[5]',
	];

	public function getOwnValidationRules() {
		$prefixed_array = [];
		$len = strlen($this->table) + 1;

		foreach ($this->validationRules as $key => $value) {
			$prefixed_array[substr($key, $len)] = $value;
		}

		return $prefixed_array;
	}
}
