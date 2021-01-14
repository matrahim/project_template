<?php

namespace App\Models;

// use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class AgamaModel extends Model
{

  protected $table = "agama";
  protected $primaryKey = "id_agama";
  protected $useTimestamps = true;

  protected $allowedFields = ['nama_agama'];
}
