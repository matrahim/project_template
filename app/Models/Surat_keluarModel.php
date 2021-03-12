<?php

namespace App\Models;

// use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Surat_keluarModel extends Model
{

    protected $table = "surat_keluar";
    protected $primaryKey = "id_sk";
    protected $useTimestamps = true;

    protected $allowedFields = ['id_jenissurat', 'no_surat', 'id_penduduk', 'tgl_srt',];
}
