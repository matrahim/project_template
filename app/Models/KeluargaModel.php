<?php

namespace App\Models;

// use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class KeluargaModel extends Model
{

  protected $table = "kk";
  protected $primaryKey = "id_kk";
  protected $useTimestamps = true;

  protected $allowedFields = ['no_kk', 'id_dusun', 'rt', 'rw',];
}
