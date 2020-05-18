<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model{

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['id', 'nome', 'email', 'senha', 'nivel'];
    






}

