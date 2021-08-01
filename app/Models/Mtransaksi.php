<?php

namespace App\Models;

use CodeIgniter\Model;

class Mtransaksi extends Model {
	protected $table = 'transaksi';
	protected $primaryKey = 'transaksi_id';

	protected $returnType = 'object';
	protected $useSoftDeletes = true;

	protected $allowedFields = [
		'transaksi_customer',
		'transaksi_user',
		'transaksi_status',
		'transaksi_total',
	];

	protected $useTimestamps = true;
	protected $createdField = 'transaksi_created';
	protected $updatedField = 'transaksi_updated';
	protected $deletedField = 'transaksi_deleted';

	protected $validationRules = [
		'transaksi_customer' => 'required'
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
