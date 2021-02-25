<?php

namespace App\Controllers;

// use Irsyadulibad\DataTables\DataTables;
use Myth\Auth\Models\UserModel;

class Account extends BaseController
{
  protected $admin;

  public function __construct()
  {
    $this->admin = new UserModel();
    $this->validation = \Config\Services::validation();
  }

  public function edit($id = '')
  {
    $data['id']         = $id;
    $data['validation'] = $this->validation;
    $data['user']       = $this->admin->find($id);
    return view('account/edit.php', $data);
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

        'profil_img' => [
          'rules' => 'max_size[profil_img,1020]|is_image[profil_img]|mime_in[profil_img,image/jpg,image/jpeg,image/png]',
          'errors' => [
            'max_size' => ('Ukuran gamber terlalu besar !!'),
            'is_image' => ('Yang anda upload pilih bukan gambar !!'),
            'mime_in' => ('Yang anda upload pilih bukan gambar !!'),
          ]
        ],
      ]
    )) {
      // $validation = \Config\Services::validation();
      return redirect()->to('edit/' . $this->request->getVar('id'))->withInput();
    };

    $file = $this->request->getFile('profil_img');
    // dd($file);
    if ($file->getError() == 4) {
      // dd($old_data);
      $namaFile = $old_data->user_image;
    } else {
      // dd($file);
      // $namaFile = $file->getRandomName();
      $namaFile = $file->getRandomName();
      $file->move('img/profil/', $namaFile);
      // $file->move('img/ktp-adart', $namaFile);
      if ($old_data->user_image != 'default.jpg' && file_exists('img/profil/' . $old_data->user_image)) {
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

    return redirect()->to('/');
  }

  // public function json()
  // {
  //   return DataTables::use('users')
  //     ->select('users.id, users.email, users.username, users.fullname, users.user_image, auth_groups.name as type_user, auth_groups_users.group_id as id_group')
  //     ->join('auth_groups_users', 'users.id = auth_groups_users.user_id', 'LEFT')
  //     ->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id', 'LEFT')
  //     ->addColumn('action', function ($data) {
  //       return "
  //       <form action='/admin/" . $data->id . "' method='post' class='d-inline'>
  //       " . csrf_field() . "
  //      <input type='hidden' name='_method' value='delete' />
  //      <button onClick='return confirm(" . '"Anda Yakin ?"' . ")' class='btn btn-icon waves-effect waves-light btn-danger' type='submit'><i class='fas fa-trash'></i> </button>
  //     <a class='btn btn-icon waves-effect waves-light btn-info'> <i class='fas fa-list'></i> </a>
  //     <a href='" . base_url('admin/edit/' . $data->id) . "' class='btn btn-icon waves-effect waves-light btn-warning'> <i class='fas fa-pen'></i> </a>";
  //     })
  //     ->addColumn('foto', function ($data) {
  //       return '
  //       <img width="100" src="' . base_url('img/profil') . '/' . $data->user_image . '" />';
  //     })
  //     ->rawColumns(['action', 'foto'])
  //     ->where(['deleted_at' => null])
  //     ->make(true);
  // }
}
