<?php

namespace App\Models;

// use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class PendudukModel extends Model
{

  protected $table = "penduduk";
  protected $primaryKey = "id_penduduk";
  protected $useTimestamps = true;

  protected $allowedFields = ['id_kk', 'nik', 'nama', 'tempat_lahir', 'tgl_lahir', 'jk', 'id_agama', 'pekerjaan', 'id_shdk', 'id_status'];
}
