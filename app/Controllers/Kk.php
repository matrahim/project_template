<?php

namespace App\Controllers;

use Irsyadulibad\DataTables\DataTables;
// use app\CodeIgniter\Model;
use App\Models\PendudukModel;
use App\Models\KkModel;
use App\Models\DusunModel;
use App\Models\ShdkModel;
use App\Models\StatusModel;

class Kk extends BaseController
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
        $this->kk = new KkModel();
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
        $data['penduduk'] =  $this->db->table('penduduk')
            ->select('penduduk.id_penduduk,penduduk.nama,penduduk.id_kk,penduduk.id_shdk,penduduk.nik')
            ->where("penduduk.id_shdk=1")
            ->get()->getResultObject();
        $data['kk'] = $this->db->table('kk')
            ->select('kk.*,penduduk.id_penduduk,penduduk.nama,penduduk.nik')
            ->join('penduduk', 'penduduk.id_kk = kk.id_kk', 'LEFT')
            // ->where("penduduk.id_shdk='1'")
            ->get()->getResultObject();

        return view('kk/add.php', $data);
    }

    public function edit($id = '')
    {
        $data['id'] = $id;
        $data['validation'] = $this->validation;
        $data['dusun'] = $this->dusun->find();

        $data['penduduk'] = $this->db->table('penduduk')
            ->select('penduduk.id_penduduk,penduduk.nama,penduduk.id_kk,penduduk.id_shdk,penduduk.nik')
            ->where("penduduk.id_shdk=1")
            ->get()->getResultObject();
        $data['kk'] = $this->db->table('kk')
            ->select('kk.id_kk,kk.no_kk,penduduk.id_penduduk,kk.rt,kk.rw,kk.id_dusun')
            ->join('penduduk', 'penduduk.id_kk = kk.id_kk', 'LEFT')
            ->where("kk.id_kk=" . $id)
            // ->andWhere("penduduk.id_shdk=1")
            ->get()->getRow();
        return view('kk/edit.php', $data);
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
        // dd();
        if ($this->request->getVar('old_no_kk') == $this->request->getVar('no_kk')) {
            $rules = 'required|is_numeric|min_length[10]';
        } else {
            $rules = 'required|is_numeric|min_length[10]|is_unique[kk.no_kk]';
        }
        if (!$this->validate([
            'no_kk' => [
                'rules' => $rules,
                'errors' => [
                    'required' => ('No KK HARUS DIISI '),
                    'is_unique' => ('No KK SUDAH DIGUNAKAN'),
                    'is_numeric' => ('No KK HARUS BERISI ANGKA'),
                    'min_length' => ('No KK MINIMAL 10 ANGKA'),
                ]
            ],

        ])) {

            return redirect()->to('/kk/edit/' . $this->request->getVar('id_kk'))->withInput();
        };

        // dd($this->request->getVar('tgl_lahir'));

        $this->kk->save([
            'id_kk' => $this->request->getVar('id_kk'),
            'no_kk' => $this->request->getVar('no_kk'),
            'rt' => $this->request->getVar('rt'),
            'rw' => $this->request->getVar('rw'),
            'id_dusun' => $this->request->getVar('id_dusun') == "" ? NULL : $this->request->getVar('id_dusun')
        ]);

        if (($this->request->getVar('kk')) != "") {
            $id_penduduk = explode(',', $this->request->getVar('kk'))[1];
            $id_kk = $this->request->getVar('id_kk');
            $this->penduduk->save(
                [
                    'id_penduduk' => $id_penduduk,
                    'id_kk' => $id_kk
                ]
            );
        }

        session()->setFlashdata('pesan', 'Data Berhasil di Ubah');

        return redirect()->to('/kk');
    }

    public function delete($id)
    {
        // $id = (int)$id;
        // $data = $this->admin->find();
        // dd($data);
        // if ($data->user_image != 'default.jpg') {
        //   unlink('img/profil/' . $data->user_image);
        // }
        // dd($id);
        $this->kk->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil di Hapus');
        // dd($res);
        return redirect()->to('/keluarga');
    }

    public function json()
    {
        return DataTables::use('kk')
            ->select('kk.*,
            penduduk.nama,
            penduduk.id_shdk,
            dusun.nama_dusun')
            ->join('dusun', 'dusun.id_dusun = kk.id_dusun', 'LEFT')
            ->join('penduduk', 'penduduk.id_kk = kk.id_kk', 'LEFT')
            ->where(['penduduk.id_shdk' => "1"])
            // ->order('title', 'DESC')
            ->addColumn('action', function ($data) {
                return "
        <form action='/kk/" . $data->id_kk . "' method='post' class='d-inline'>
                           " . csrf_field() . "
                          <input type='hidden' name='_method' value='delete' />
                          <button onClick='return confirm(" . '"Anda Yakin ?"' . ")' class='btn btn-icon waves-effect waves-light btn-danger' type='submit'><i class='fas fa-trash'></i> </button></form>
                          <button onClick='detailDataKK(" . $data->id_kk . ")' type='button' class='btn btn-primary waves-effect waves-light' data-toggle='modal' data-target='#exampleModalScrollable'><i class='fas fa-list'></i></button>
        <a href='" . base_url('kk/edit/' . $data->id_kk) . "' class='btn btn-icon waves-effect waves-light btn-warning'> <i class='fas fa-pen'></i> </a>";
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
        $dataKK = $this->daftarKK($id);
        // return ;
        echo json_encode($dataKK);
    }

    public function daftarKK($id)
    {
        $res = $this->db->table('penduduk')
            ->select('penduduk.nama,penduduk.id_shdk,penduduk.nik,shdk.nama_shdk,penduduk.id_status,status.nama_status,kk.id_dusun,kk.rt,kk.rw,dusun.nama_dusun')
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
        // $pend = $this->request->getVar('id_pend');
        $kk = $this->request->getVar('id_kk');

        $dataKK = $this->daftarKK($kk);

        $dataKk = $this->db->table('kk')
            ->select('kk.*,dusun.nama_dusun')
            ->join('dusun', 'dusun.id_dusun = kk.id_dusun', 'LEFT')
            ->where("kk.id_kk='" . $kk . "'")
            // ->orderBy('penduduk.id_shdk', 'ASC')
            ->get()->getResultArray();

        $data['kk'] = $dataKk[0];
        $data['keluarga'] = $dataKK;
        echo json_encode($data);
    }
    //--------------------------------------------------------------------

}
