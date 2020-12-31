<?php

namespace App\Controllers;

use Irsyadulibad\DataTables\DataTables;

class Admin extends BaseController
{

  public function index()
  {
    return view('admin/index.php');
  }
  public function add()
  {
    return view('admin/add.php');
  }
  public function edit($id = '')
  {
    $data['id'] = $id;
    return view('admin/edit.php', $data);
  }

  public function json()
  {
    return DataTables::use('users')
      ->select('users.id, users.email, users.username, users.fullname, users.user_image, auth_groups.name as type_user, auth_groups_users.group_id as id_group')
      ->join('auth_groups_users', 'users.id = auth_groups_users.user_id', 'LEFT JOIN')
      ->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id', 'LEFT JOIN')
      ->addColumn('action', function ($data) {
        return '
        <a class="btn btn-icon waves-effect waves-light btn-danger"> <i class="fas fa-trash"></i> </a>
        <a class="btn btn-icon waves-effect waves-light btn-info"> <i class="fas fa-list"></i> </a>
        <a href="' . base_url('admin/edit/' . $data->id) . '" class="btn btn-icon waves-effect waves-light btn-warning"> <i class="fas fa-pen"></i> </a>';
      })
      ->rawColumns(['action'])
      // ->hideColumns(['password_hash'])
      ->make(true);
  }

  //--------------------------------------------------------------------

}
