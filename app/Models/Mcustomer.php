<?php

namespace App\Models;

use CodeIgniter\Model;

class Mcustomer extends Model {
	protected $table = 'customer';
	protected $primaryKey = 'customer_id';

	protected $returnType = 'object';
	protected $useSoftDeletes = true;

	protected $allowedFields = [
		'customer_nama',
		'customer_alamat',
		'customer_telp',
		'customer_user',
	];

	protected $useTimestamps = true;
	protected $createdField = 'customer_created';
	protected $updatedField = 'customer_updated';
	protected $deletedField = 'customer_deleted';

	protected $validationRules = [
		'customer_nama' => 'required|min_length[5]',
		'customer_telp' => 'required',
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
