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
      ->select('kk.*,penduduk.id_penduduk,penduduk.nama,penduduk.id_shdk')
      ->join('penduduk', 'penduduk.id_kk = kk.id_kk', 'LEFT')
      ->where("penduduk.id_shdk='1'")
      ->get()->getResultObject();

    return view('penduduk/add.php', $data);
  }

  public function edit($id = '')
  {
    $data['id'] = $id;
    $data['validation'] = $this->validation;
    $data['user'] = $this->admin->find($id);
    return view('admin/edit.php', $data);
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
          'min_lenght' => ('NIK MINIMAL 10 ANGKA'),
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

    // function cek kepala keluarga
    // function callback_cek_kk($id_kk)
    // {
    //   $shdk = $this->request->getVar('shdk');
    //   if ($shdk == "" or $id_kk == "") {
    //     return TRUE;
    //   } else {
    //     $hasil = $this->db->table('kk')
    //       ->select('kk.*,penduduk.id_penduduk,penduduk.nama,penduduk.id_shdk')
    //       ->join('penduduk', 'penduduk.id_kk = kk.id_kk', 'LEFT')
    //       ->where("penduduk.id_shdk='1'")
    //       ->get()->getResultObject();
    //   }
    // }
    // dd($this->request->getVar('tempat_lahir'));

    $this->penduduk->save([
      'id_kk' => $this->request->getVar('kk'),
      'nik' => $this->request->getVar('nik'),
      'nama' => $this->request->getVar('nama'),
      'tempat_lahir' => $this->request->getVar('tempat_lahir'),
      'tgl_lahir' => $this->request->getVar('tgl_lahir'),
      'jk' => $this->request->getVar('jk'),
      'id_agama' => $this->request->getVar('agama'),
      'pekerjaan' => $this->request->getVar('pekerjaan'),
      'id_shdk' => $this->request->getVar('shdk'),
      'id_status' => $this->request->getVar('status'),
      // 'bentuk_informasi' => $this->request->getVar('bentuk_informasi'),
      // 'jangka_penyimpanan' => $this->request->getVar('jangka_penyimpanan'),


    ]);

    session()->setFlashdata('pesan', 'Data Berhasil di Tambahkan');

    return redirect()->to('/penduduk');
  }

  public function update()
  {
    $old_data = $this->admin->find($this->request->getVar('id'));
    // dd($old_data);
    // $email_lama = $this->admin->find($this->request->getVar('email'));
    if ($old_data->email == $this->request->getVar('email')) {
      $role_email = 'required';
    } else {
      $role_email = 'required|is_unique[users.email]|valid_email';
    }
    if ($old_data->username == $this->request->getVar('username')) {
      $role_username = 'required|alpha_numeric';
    } else {
      $role_username = 'required|is_unique[users.username]|alpha_numeric';
    }

    if ($this->request->getVar('password') == "") {
      $pass_leng = "0";
    } else {
      $pass_leng =  "6";
    }

    if (!$this->validate(
      [
        'username' => [
          'rules' => $role_username,
          'errors' => [
            'required' => ('{field} HARUS DIISI '),
            'is_unique' => ('{field} SUDAH DIGUNAKAN'),
            'alpha_numeric' => ('{field} TIDAK DIIJINKAN')
          ]
        ],
        'email' => [
          'rules' => $role_email,
          'errors' => [
            'required' => ('{field} HARUS DI ISI '),
            'valid_email' => ('{field} TIDAK VALID'),
            'is_unique' => ('{field} SUDAH DIGUNAKAN')
          ]
        ],
        'fullname' => [
          'rules' => 'required',
          'errors' => [
            'required' => ('{field} HARUS DIISI ')
          ]
        ],

        'password' => [
          'rules' => 'min_length[' . $pass_leng . ']',
          'errors' => [
            'required' => ('{field} HARUS DIISI '),
            'min_length' => ('{field} MINIMAL 6 KARAKTER '),
          ]
        ],

        'password2' => [
          // required|matches[password]
          'rules' => 'matches[password]',
          'errors' => [
            'required' => ('PASSWORD HARUS DIISI '),
            'matches' => ('PASSWORD TIDAK SAMA, ULANGI PASSWORD ')
          ]
        ],
      ]
    )) {
      // $validation = \Config\Services::validation();
      return redirect()->to('/admin/edit/' . $this->request->getVar('id'))->withInput();
    };

    $file = $this->request->getFile('profil_img');

    if ($file->getError() == 4) {
      // dd($old_data);
      $namaFile = $old_data->user_image;
    } else {
      // dd($file);
      // $namaFile = $file->getRandomName();
      $namaFile = $file->getRandomName();
      $file->move('img/profil/', $namaFile);
      // $file->move('img/ktp-adart', $namaFile);
      if ($old_data->user_image != 'default.jpg') {
        unlink('img/profil/' . $old_data->user_image);
      }
    }


    if ($this->request->getVar('password') == "") {
      $pass = $old_data->password_hash;
    } else {
      $hashOptions = [
        'memory_cost' => 2048,
        'time_cost'   => 4,
        'threads'     => 4
      ];
      $pass = password_hash(
        base64_encode(
          hash('sha384', $this->request->getVar('password'), true)
        ),
        PASSWORD_DEFAULT,
        $hashOptions
      );
    };

    // dd($namaFile);
    $this->admin->save([
      'id' =>  $this->request->getVar('id'),
      'email' => $this->request->getVar('email'),
      'username' => $this->request->getVar('username'),
      'fullname' => $this->request->getVar('fullname'),
      'user_image' => $namaFile,
      'password_hash' => $pass,
      'active' => '1'
    ]);

    session()->setFlashdata('pesan', 'Data Berhasil di Ubah');

    return redirect()->to('/admin');
  }

  public function delete($id)
  {
    // $id = (int)$id;
    // $data = $this->admin->find();
    // dd($data);
    // if ($data->user_image != 'default.jpg') {
    //   unlink('img/profil/' . $data->user_image);
    // }
    $this->admin->delete($id);
    session()->setFlashdata('pesan', 'Data Berhasil di Hapus');

    return redirect()->to('/admin');
  }

  public function json()
  {
    return DataTables::use('penduduk')
      ->select('penduduk.id_penduduk as id,penduduk.id_kk,penduduk.nik,penduduk.nama,penduduk.tempat_lahir,penduduk.tgl_lahir,penduduk.jk,penduduk.id_agama,penduduk.id_shdk,penduduk.id_status,agama.nama_agama,kk.no_kk,shdk.nama_shdk')
      ->join('kk', 'penduduk.id_kk = kk.id_kk', 'LEFT')
      ->join('agama', 'penduduk.id_agama = agama.id_agama', 'LEFT')
      ->join('shdk', 'penduduk.id_shdk = shdk.id_shdk', 'LEFT')
      // ->order('title', 'DESC')
      ->addColumn('action', function ($data) {
        return "
        <form action='/penduduk/" . $data->id . "' method='post' class='d-inline'>
                           " . csrf_field() . "
                          <input type='hidden' name='_method' value='delete' />
                          <button onClick='return confirm(" . '"Anda Yakin ?"' . ")' class='btn btn-icon waves-effect waves-light btn-danger' type='submit'><i class='fas fa-trash'></i> </button>
        <a class='btn btn-icon waves-effect waves-light btn-info'> <i class='fas fa-list'></i> </a>
        <a href='" . base_url('admin/penduduk/' . $data->id) . "' class='btn btn-icon waves-effect waves-light btn-warning'> <i class='fas fa-pen'></i> </a>";
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

  //--------------------------------------------------------------------

}
