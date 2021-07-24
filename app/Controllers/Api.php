<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Api extends ResourceController {
    protected $modelName = 'App\Models\Msetting';
    protected $format    = 'json';

    public function settings() {
        return $this->respond($this->model->select("setting_name, setting_value")->findAll());
    }

    // ...
}
