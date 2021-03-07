<?php

namespace App\Controllers;

use Irsyadulibad\DataTables\DataTables;
// use app\CodeIgniter\Model;
use App\Models\PendudukModel;
use App\Models\KkModel;
use App\Models\AgamaModel;
use App\Models\ShdkModel;
use App\Models\StatusModel;

class Penduduk extends BaseController
{
  protected $penduduk;
  protected $kk;
  protected $agama;
  protected $shdk;
  protected $status;
  protected $db;

  public function __construct()
  {
    $this->db      = \Config\Database::connect();
    $this->penduduk = new PendudukModel();
    $this->kk = new KkModel();
    $this->agama = new AgamaModel();
    $this->shdk = new ShdkModel();
    $this->status = new StatusModel();
    $this->validation = \Config\Services::validation();
  }

  public function index()
  {
    return view('penduduk/index.php');
  }

  public function create()
  {
    $data['validation'] = $this->validation;
    $data['agama'] = $this->agama->find();
    $data['shdk'] = $this->shdk->find();
    $data['status'] = $this->status->find();
    $data['penduduk'] = $this->penduduk->find();
    $data['kk'] = $this->db->table('kk')
      ->select('kk.*,penduduk.id_penduduk,penduduk.nama')
      ->join('penduduk', 'penduduk.id_kk = kk.id_kk', 'LEFT')
      // ->where("penduduk.id_shdk='1'")
      ->get()->getResultObject();

    return view('penduduk/add.php', $data);
  }

  public function edit($id = '')
  {
    $data['id'] = $id;
    $data['validation'] = $this->validation;
    $data['agama'] = $this->agama->find();
    $data['shdk'] = $this->shdk->find();
    $data['status'] = $this->status->find();
    $data['penduduk'] = $this->penduduk->find($id);
    $data['kk'] = $this->db->table('kk')
      ->select('kk.*,penduduk.id_penduduk,penduduk.nama')
      ->join('penduduk', 'penduduk.id_kk = kk.id_kk', 'LEFT')
      // ->where("penduduk.id_shdk='1'")
      ->get()->getResultObject();
    return view('penduduk/edit.php', $data);
  }


  public function save()
  {

    if (!$this->validate([
      'nik' => [
        'rules' => 'required|is_numeric|min_length[10]',
        'errors' => [
          'required' => ('NIK HARUS DIISI '),
          // 'is_unique' => ('{field} SUDAH DIGUNAKAN'),
          'is_numeric' => ('NIK HARUS BERISI ANGKA'),
          'min_length' => ('NIK MINIMAL 10 ANGKA'),
        ]
      ],
      'nama' => [
        'rules' => 'required',
        'errors' => [
          'required' => ('NAMA HARUS DI ISI ')
        ]
      ],
      // 'tempat_lahir' => [
      //   'rules' => 'required',
      //   'errors' => [
      //     'required' => ('{field} HARUS DIISI ')
      //   ]
      // ],
      // 'tgl_lahir' => [
      //   // required|matches[password]
      //   'rules' => 'valid_date',
      //   'errors' => [
      //     'valid_date' => ('TANGGAL TIDAK VALID'),
      //     // 'min_length' => ('{field} MINIMAL 6 KARAKTER '),
      //   ]
      // ],
      'jk' => [
        // required|matches[password]
        'rules' => 'required',
        'errors' => [
          'required' => ('PILIH JENIS KELAMIN'),
          // 'matches' => ('PASSWORD TIDAK SAMA, ULANGI PASSWORD ')
        ]
      ],
      // 'agama' => [
      //   // required|matches[password]
      //   'rules' => 'required|matches[password]',
      //   'errors' => [
      //     'required' => ('PASSWORD HARUS DIISI '),
      //     'matches' => ('PASSWORD TIDAK SAMA, ULANGI PASSWORD ')
      //   ]
      // ],
      'pekerjaan' => [
        // required|matches[password]
        'rules' => 'required',
        'errors' => [
          'required' => ('PEKERJAAN HARUS DIISI '),
          // 'matches' => ('PASSWORD TIDAK SAMA, ULANGI PASSWORD ')
        ]
      ],
      'shdk' => [
        // required|matches[password]
        'rules' => 'required',
        'errors' => [
          'required' => ('PILIH SHDK'),
          // 'matches' => ('PASSWORD TIDAK SAMA, ULANGI PASSWORD ')
        ]
      ],
      'status' => [
        // required|matches[password]
        'rules' => 'required',
        'errors' => [
          'required' => ('PILIH STATUS '),
          // 'matches' => ('PASSWORD TIDAK SAMA, ULANGI PASSWORD ')
        ]
      ],
      // cekk kk
      // 'kk' => [
      //   // required|matches[password]
      //   'rules' => 'callback_cek_kk['.$this->input->post('id').']',
      //   'errors' => [
      //     'required' => ('PILIH No KK '),
      //     // 'matches' => ('PASSWORD TIDAK SAMA, ULANGI PASSWORD ')
      //   ]
      // ],

    ])) {
      // $validation = \Config\Services::validation();
      return redirect()->to('/penduduk/add')->withInput();
    };

    // dd($this->request->getVar('kk'));

    $this->penduduk->save([
      'id_kk' => $this->request->getVar('kk') == "" ? NULL : $this->request->getVar('kk'),
      'nik' => $this->request->getVar('nik'),
      'nama' => $this->request->getVar('nama'),
      'tempat_lahir' => $this->request->getVar('tempat_lahir'),
      'tgl_lahir' => $this->request->getVar('tgl_lahir'),
      'jk' => $this->request->getVar('jk'),
      'id_agama' => $this->request->getVar('agama') == "" ? NULL : $this->request->getVar('agama'),
      'pekerjaan' => $this->request->getVar('pekerjaan'),
      'id_shdk' => $this->request->getVar('shdk'),
      'id_status' => $this->request->getVar('status'),
    ]);

    session()->setFlashdata('pesan', 'Data Berhasil di Tambahkan');

    return redirect()->to('/penduduk');
  }

  public function update()
  {
    if (!$this->validate([
      'nik' => [
        'rules' => 'required|is_numeric|min_length[10]',
        'errors' => [
          'required' => ('NIK HARUS DIISI '),

          'is_numeric' => ('NIK HARUS BERISI ANGKA'),
          'min_length' => ('NIK MINIMAL 10 ANGKA'),
        ]
      ],
      'nama' => [
        'rules' => 'required',
        'errors' => [
          'required' => ('NAMA HARUS DI ISI ')
        ]
      ],

      'jk' => [

        'rules' => 'required',
        'errors' => [
          'required' => ('PILIH JENIS KELAMIN'),

        ]
      ],

      'pekerjaan' => [

        'rules' => 'required',
        'errors' => [
          'required' => ('PEKERJAAN HARUS DIISI '),

        ]
      ],
      'shdk' => [
        // required|matches[password]
        'rules' => 'required',
        'errors' => [
          'required' => ('PILIH SHDK'),

        ]
      ],
      'status' => [

        'rules' => 'required',
        'errors' => [
          'required' => ('PILIH STATUS '),

        ]
      ],

    ])) {

      return redirect()->to('/penduduk/edit/' . $this->request->getVar('id_penduduk'))->withInput();
    };

    // dd($this->request->getVar('tgl_lahir'));

    $this->penduduk->save([
      'id_penduduk' => $this->request->getVar('id_penduduk'),
      'id_kk' => empty($this->request->getVar('kk')) ? Null : $this->request->getVar('kk'),
      'nik' => $this->request->getVar('nik'),
      'nama' => $this->request->getVar('nama'),
      'tempat_lahir' => $this->request->getVar('tempat_lahir'),
      'tgl_lahir' => $this->request->getVar('tgl_lahir'),
      'jk' => $this->request->getVar('jk'),
      'id_agama' => $this->request->getVar('agama'),
      'pekerjaan' => $this->request->getVar('pekerjaan'),
      'id_shdk' => $this->request->getVar('shdk'),
      'id_status' => $this->request->getVar('status'),
    ]);

    session()->setFlashdata('pesan', 'Data Berhasil di Ubah');

    return redirect()->to('/penduduk');
  }

  public function delete($id)
  {
    // $id = (int)$id;
    // $data = $this->admin->find();
    // dd($data);
    // if ($data->user_image != 'default.jpg') {
    //   unlink('img/profil/' . $data->user_image);
    // }
    $this->penduduk->delete($id);
    session()->setFlashdata('pesan', 'Data Berhasil di Hapus');

    return redirect()->to('/penduduk');
  }

  public function json()
  {
    return DataTables::use('penduduk')
      ->select('penduduk.id_penduduk as id,penduduk.id_kk as kk_id,penduduk.nik,penduduk.nama,penduduk.tempat_lahir,penduduk.tgl_lahir,penduduk.jk,penduduk.id_agama,penduduk.id_shdk,penduduk.id_status,agama.nama_agama,kk.no_kk,shdk.nama_shdk')
      ->join('kk', 'penduduk.id_kk = kk.id_kk', 'LEFT')
      ->join('agama', 'penduduk.id_agama = agama.id_agama', 'LEFT')
      ->join('shdk', 'penduduk.id_shdk = shdk.id_shdk', 'LEFT')
      // ->order('title', 'DESC')
      ->addColumn('action', function ($data) {
        return "
        <form action='/penduduk/" . $data->id . "' method='post' class='d-inline'>
                           " . csrf_field() . "
                          <input type='hidden' name='_method' value='delete' />
                          <button onClick='return confirm(" . '"Anda Yakin ?"' . ")' class='btn btn-icon waves-effect waves-light btn-danger' type='submit'><i class='fas fa-trash'></i> </button></form>
        <button onClick='detailData(" . $data->id . "," . $data->kk_id . ")' type='button' class='btn btn-primary waves-effect waves-light' data-toggle='modal' data-target='#exampleModalScrollable'><i class='fas fa-list'></i></button>
        <a href='" . base_url('penduduk/edit/' . $data->id) . "' class='btn btn-icon waves-effect waves-light btn-warning'> <i class='fas fa-pen'></i> </a>";
      })
      ->addColumn('ttl', function ($data) {
        return $data->tempat_lahir . ' - ' . $data->tgl_lahir;
      })
      // ->rawColumns(['action'])
      // ->where(['deleted_at' => null])
      // ->order(['id'])
      ->rawColumns(['action'], ['ttl'])
      // ->hideColumns(['password_hash'])
      ->make(true);
  }

  public function getKK()
  {
    $id = $this->request->getVar('id');
    $dataKK = $this->daftarKK($id);
    // return ;
    echo json_encode($dataKK);
  }

  public function daftarKK($id)
  {
    $res = $this->db->table('penduduk')
      ->select('penduduk.nama,penduduk.nik,penduduk.id_shdk,shdk.nama_shdk,penduduk.id_status,status.nama_status,kk.id_dusun,kk.rt,kk.rw,dusun.nama_dusun')
      ->join('kk', 'kk.id_kk = penduduk.id_kk', 'LEFT')
      ->join('shdk', 'shdk.id_shdk = penduduk.id_shdk', 'LEFT')
      ->join('status', 'status.id_status = penduduk.id_status', 'LEFT')
      ->join('dusun', 'dusun.id_dusun = kk.id_dusun', 'LEFT')
      ->where("penduduk.id_kk='" . $id . "'")
      ->orderBy('penduduk.id_shdk', 'ASC')
      ->get()->getResultArray();

    return $res;
  }

  public function detail()
  {
    $pend = $this->request->getVar('id_pend');
    $kk = $this->request->getVar('id_kk');

    $dataKK = $this->daftarKK($kk);

    $dataPend = $this->db->table('penduduk')
      ->select('penduduk.nama,penduduk.nik,penduduk.tempat_lahir,penduduk.tgl_lahir,penduduk.jk,penduduk.pekerjaan,shdk.nama_shdk,status.nama_status,kk.no_kk,kk.rt,kk.rw,dusun.nama_dusun,agama.nama_agama,')
      ->join('kk', 'kk.id_kk = penduduk.id_kk', 'LEFT')
      ->join('agama', 'penduduk.id_agama = agama.id_agama', 'LEFT')
      ->join('shdk', 'shdk.id_shdk = penduduk.id_shdk', 'LEFT')
      ->join('status', 'status.id_status = penduduk.id_status', 'LEFT')
      ->join('dusun', 'dusun.id_dusun = kk.id_dusun', 'LEFT')
      ->where("penduduk.id_penduduk='" . $pend . "'")
      // ->orderBy('penduduk.id_shdk', 'ASC')
      ->get()->getResultArray();

    $data['penduduk'] = $dataPend[0];
    $data['keluarga'] = $dataKK;
    echo json_encode($data);
  }
  //--------------------------------------------------------------------

}
