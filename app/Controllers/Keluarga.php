<?php

namespace App\Controllers;

use Irsyadulibad\DataTables\DataTables;
// use app\CodeIgniter\Model;
use App\Models\PendudukModel;
use App\Models\KeluargaModel;
use App\Models\DusunModel;
use App\Models\ShdkModel;
use App\Models\StatusModel;

class Keluarga extends BaseController
{
    protected $penduduk;
    protected $kk;
    protected $dusun;
    // protected $shdk;
    // protected $status;
    protected $db;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->penduduk = new PendudukModel();
        $this->kk = new KeluargaModel();
        $this->dusun = new DusunModel();
        // $this->shdk = new ShdkModel();
        // $this->status = new StatusModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        return view('kk/index.php');
    }

    public function create()
    {
        $data['validation'] = $this->validation;
        // $data['agama'] = $this->agama->find();
        // $data['shdk'] = $this->shdk->find();
        // $data['status'] = $this->status->find();
        $data['dusun'] = $this->dusun->find();
        $data['penduduk'] = $this->penduduk->find();
        $data['kk'] = $this->db->table('kk')
            ->select('kk.*,penduduk.id_penduduk,penduduk.nama,penduduk.nik')
            ->join('penduduk', 'penduduk.id_kk = kk.id_kk', 'LEFT')
            ->where("penduduk.id_shdk='1'")
            ->get()->getResultObject();

        return view('kk/add.php', $data);
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
            ->select('kk.*,penduduk.id_penduduk,penduduk.nama,penduduk.id_shdk')
            ->join('penduduk', 'penduduk.id_kk = kk.id_kk', 'LEFT')
            ->where("penduduk.id_shdk='1'")
            ->get()->getResultObject();
        return view('penduduk/edit.php', $data);
    }


    public function save()
    {

        if (!$this->validate([
            'no_kk' => [
                'rules' => 'required|is_numeric|min_length[10]|is_unique[kk.no_kk]',
                'errors' => [
                    'required' => ('No KK HARUS DIISI '),
                    'is_unique' => ('No KK SUDAH DIGUNAKAN'),
                    'is_numeric' => ('No KK HARUS BERISI ANGKA'),
                    'min_length' => ('No KK MINIMAL 10 ANGKA'),
                ]
            ],



        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to('/kk/add')->withInput();
        };

        $this->kk->save([
            'no_kk' => $this->request->getVar('no_kk'),
            'rt' => $this->request->getVar('rt'),
            'rw' => $this->request->getVar('rw'),
            'id_dusun' => $this->request->getVar('id_dusun') == "" ? NULL : $this->request->getVar('id_dusun')
        ]);
        // dd($res);

        if (($this->request->getVar('kk')) != "") {
            $id_penduduk = json_decode($this->request->getVar('kk'))[1];
            $id_kk = $this->kk->getInsertID();
            $this->penduduk->save(
                [
                    'id_penduduk' => $id_penduduk,
                    'id_kk' => $id_kk
                ]
            );
        }


        session()->setFlashdata('pesan', 'Data Berhasil di Tambahkan');

        return redirect()->to('/kk');
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
        return DataTables::use('kk')
            ->select('kk.*,penduduk.id_kk,penduduk.nama,penduduk.id_shdk,dusun.id_dusun,dusun.nama_dusun')
            ->join('penduduk', 'penduduk.id_kk = kk.id_kk', 'LEFT')
            ->join('dusun', 'dusun.id_dusun = kk.id_dusun', 'LEFT')
            // ->order('title', 'DESC')
            ->addColumn('action', function ($data) {
                return "
        <form action='/penduduk/" . $data->id_kk . "' method='post' class='d-inline'>
                           " . csrf_field() . "
                          <input type='hidden' name='_method' value='delete' />
                          <button onClick='return confirm(" . '"Anda Yakin ?"' . ")' class='btn btn-icon waves-effect waves-light btn-danger' type='submit'><i class='fas fa-trash'></i> </button></form>
        <a class='btn btn-icon waves-effect waves-light btn-info'> <i class='fas fa-list'></i> </a>
        <a href='" . base_url('penduduk/edit/' . $data->id_kk) . "' class='btn btn-icon waves-effect waves-light btn-warning'> <i class='fas fa-pen'></i> </a>";
            })
            // ->rawColumns(['action'])
            // ->where(['id_shdk' => 1])
            // ->order(['id'])
            ->rawColumns(['action'])
            // ->hideColumns(['password_hash'])
            ->make(true);
    }

    public function getKK()
    {
        $id = $this->request->getVar('id');
        $dataKK = $this->db->table('penduduk')
            ->select('penduduk.nama,penduduk.id_shdk,shdk.nama_shdk,penduduk.id_status,status.nama_status,kk.id_dusun,kk.rt,kk.rw,dusun.nama_dusun')
            ->join('kk', 'kk.id_kk = penduduk.id_kk', 'LEFT')
            ->join('shdk', 'shdk.id_shdk = penduduk.id_shdk', 'LEFT')
            ->join('status', 'status.id_status = penduduk.id_status', 'LEFT')
            ->join('dusun', 'dusun.id_dusun = kk.id_dusun', 'LEFT')
            ->where("penduduk.id_kk='" . $id . "'")
            ->orderBy('penduduk.id_shdk', 'ASC')

            ->get()->getResultArray();
        // return ;
        echo json_encode($dataKK);
    }
    //--------------------------------------------------------------------

}
