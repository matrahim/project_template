<?php

namespace App\Models;

// use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class StatusModel extends Model
{

  protected $table = "status";
  protected $primaryKey = "id_status";
  protected $useTimestamps = true;

  protected $allowedFields = ['nama_status'];
}
