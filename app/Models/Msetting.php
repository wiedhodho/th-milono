<?php

namespace App\Models;

use CodeIgniter\Model;

class Msetting extends Model {
	protected $table = 'setting';
	protected $primaryKey = 'setting_name';

	protected $returnType = 'object';
	// protected $useSoftDeletes = true;

	protected $allowedFields = [
		'setting_value'
	];

	protected $useTimestamps = true;
	protected $createdField = '';
	protected $updatedField = 'setting_updated';
	protected $deletedField = '';

	protected $validationRules = [];

	protected $validationMessages = [];
	protected $skipValidation = false;
}
