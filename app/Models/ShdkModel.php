<?php

namespace App\Models;

// use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class ShdkModel extends Model
{

  protected $table = "shdk";
  protected $primaryKey = "id_shdk";
  protected $useTimestamps = true;

  protected $allowedFields = ['nama_shdk'];
}
