<?php

namespace App\Models;

// use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Jenis_suratModel extends Model
{

    protected $table = "jenis_surat";
    protected $primaryKey = "id_jenissurat";
    protected $useTimestamps = true;

    protected $allowedFields = ['nama_jenissurat'];
}
