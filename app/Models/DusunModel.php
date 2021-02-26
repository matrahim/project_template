<?php

namespace App\Models;

// use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class DusunModel extends Model
{

    protected $table = "dusun";
    protected $primaryKey = "id_dusun";
    protected $useTimestamps = true;

    protected $allowedFields = ['nama_dusun'];
}
