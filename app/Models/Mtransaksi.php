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
		'transaksi_keterangan',
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

	private $searchField = ['transaksi_id', 'customer_nama', 'customer_telp'];
	private $request;
	private $filter;
	private $value;
	private $select = "transaksi.*, customer_nama, customer_telp, (SELECT barang_pekerjaan FROM barang WHERE barang_transaksi=transaksi_id LIMIT 1) as barang_pekerjaan";

	public function query() {
		$this->request = service('request');

		$i = 0;
		foreach ($this->searchField as $item) {
			if ($this->request->getGet('search')['value']) {
				$keyword = $this->request->getGet('search')['value'];
				if ($i === 0) {
					$this->groupStart();
					$this->like($item, $keyword);
				} else {
					$this->orLike($item, $keyword);
				}
				if (count($this->searchField) - 1 == $i) {
					$this->groupEnd();
				}
			}
			$i++;
		}

		$this->select($this->select);


		$this->join('customer', 'customer_id=transaksi_customer');

		if ($this->filter !== null) {
			foreach ($this->filter as $k => $f) {
				if (is_array($this->value[$k])) {
					$this->whereIn($f, $this->value[$k]);
				} else {
					$this->where($f, $this->value[$k]);
				}
			}
		}

		// if
		// $idx = [0]['column'];
		$columnIndex = $this->request->getGet('order')[0]['column']; // Column index
		$columnName = $this->request->getGet('columns')[$columnIndex]['data'];
		$columnSortOrder = $this->request->getGet('order')[0]['dir'];
		if ($columnName == 'transaksi_id') {
			$columnName = 'transaksi_updated';
			$columnSortOrder = 'DESC';
		}

		$this->orderBy($columnName, $columnSortOrder)
			->where($this->deletedField, NULL);
	}

	public function datatables($filter = null, $value = null, $table = null, $select = null) {
		if ($table !== null)
			$this->table = $table;

		if ($select !== null)
			$this->select = $select;

		$this->filter = $filter;
		$this->value = $value;
		$this->request = service('request');
		$this->query();
		$this->limit(
			$this->request->getGet('length'),
			$this->request->getGet('start')
		);
		$query = $this->get();
		// echo $this->getLastQuery();
		return $query->getResult();
	}

	public function count_filtered() {
		$this->query();
		return $this->countAllResults();
		// echo $this->getLastQuery();
	}

	public function count_all() {
		if ($this->filter !== null) {
			foreach ($this->filter as $k => $f) {
				if (is_array($this->value[$k])) {
					$this->whereIn($f, $this->value[$k]);
				} else {
					$this->where($f, $this->value[$k]);
				}
			}
		}
		return $this->countAllResults();
		// echo $this->getLastQuery();
	}
}
