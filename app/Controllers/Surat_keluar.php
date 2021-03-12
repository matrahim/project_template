<?php

namespace App\Controllers;

use Irsyadulibad\DataTables\DataTables;
// use app\CodeIgniter\Model;
use App\Models\PendudukModel;
use App\Models\KkModel;
use App\Models\Surat_keluarModel;
use App\Models\Jenis_suratModel;
use App\Models\StatusModel;
use TCPDF;


class Surat_keluar extends BaseController
{
    protected $penduduk;
    protected $kk;

    protected $sk;
    protected $js;
    protected $db;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->penduduk = new PendudukModel();
        $this->kk = new KkModel();

        $this->sk = new Surat_keluarModel();
        $this->js = new Jenis_suratModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        return view('surat_keluar/index.php');
    }

    public function create()
    {
        $data['validation'] = $this->validation;
        // $data['agama'] = $this->agama->find();
        // $data['shdk'] = $this->shdk->find();
        // $data['status'] = $this->status->find();
        $data['surat_keluar'] = $this->sk->find();
        $data['jenis_surat'] = $this->js->find();
        $data['penduduk'] = $this->penduduk->find();


        return view('surat_keluar/add.php', $data);
    }

    public function edit($id = '')
    {
        $data['id'] = $id;
        $data['validation'] = $this->validation;
        $data['surat_keluar'] = $this->sk->find($id);
        $data['jenis_surat'] = $this->js->find();
        $data['penduduk'] = $this->penduduk->find();

        return view('surat_keluar/edit.php', $data);
    }

    public function save()
    {

        if (!$this->validate([
            'no_surat' => [
                'rules' => 'required|is_numeric|min_length[1]',
                'errors' => [
                    'required' => ('NO SURAT HARUS DIISI '),
                    'is_unique' => ('NO SURAT SUDAH DIGUNAKAN'),
                    'is_numeric' => ('NO SURAT HARUS BERISI ANGKA'),
                    'min_length' => ('NO SURAT MINIMAL 10 ANGKA'),
                ]
            ],
            'tgl_srt' => [
                'rules' => 'required',
                'errors' => [
                    'required' => ('TANGGAl SURAT HARUS DIISI '),

                ]
            ],
            'id_jenissurat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => ('PILIH JENIS SURAT'),

                ]
            ],
            'id_penduduk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => ('PILIH PENDUDUK'),

                ]
            ],



        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to('/surat_keluar/add')->withInput();
        };

        $this->sk->save([
            'id_jenissurat' => $this->request->getVar('id_jenissurat'),
            'tgl_srt' => $this->request->getVar('tgl_srt'),
            'no_surat' => $this->request->getVar('no_surat'),
            'id_penduduk' => $this->request->getVar('id_penduduk')
        ]);
        // dd($res);


        session()->setFlashdata('pesan', 'Data Berhasil di Tambahkan');

        return redirect()->to('/surat_keluar');
    }

    public function update()
    {

        if (!$this->validate([
            'no_surat' => [
                'rules' => 'required|is_numeric|min_length[1]',
                'errors' => [
                    'required' => ('NO SURAT HARUS DIISI '),
                    'is_unique' => ('NO SURAT SUDAH DIGUNAKAN'),
                    'is_numeric' => ('NO SURAT HARUS BERISI ANGKA'),
                    'min_length' => ('NO SURAT MINIMAL 10 ANGKA'),
                ]
            ],
            'tgl_srt' => [
                'rules' => 'required',
                'errors' => [
                    'required' => ('TANGGAl SURAT HARUS DIISI '),

                ]
            ],
            'id_jenissurat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => ('PILIH JENIS SURAT'),

                ]
            ],
            'id_penduduk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => ('PILIH PENDUDUK'),

                ]
            ],



        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to('/surat_keluar/edit/' . $this->request->getVar('id_sk'))->withInput();
        };

        $this->sk->save([

            'id_sk' => $this->request->getVar('id_sk'),
            'id_jenissurat' => $this->request->getVar('id_jenissurat'),
            'tgl_srt' => $this->request->getVar('tgl_srt'),
            'no_surat' => $this->request->getVar('no_surat'),
            'id_penduduk' => $this->request->getVar('id_penduduk')
        ]);
        // dd($res);


        session()->setFlashdata('pesan', 'Data Berhasil di Tambahkan');

        return redirect()->to('/surat_keluar');
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
        $this->sk->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil di Hapus');
        // dd($res);
        return redirect()->to('/surat_keluar');
    }

    public function cetak($id)
    {
        if ($id == "") {
            return redirect()->to('/surat_keluar');
        };


        $surat_keluar = $this->db->table('surat_keluar')
            ->select('jenis_surat.*,penduduk.*')
            ->join('jenis_surat', 'surat_keluar.id_jenissurat = jenis_surat.id_jenissurat', 'LEFT')
            ->join('penduduk', 'surat_keluar.id_penduduk = penduduk.id_penduduk', 'LEFT')
            ->where("surat_keluar.id_sk=" . $id)
            ->get()->getResultObject();

        $penduduk = $this->db->table('penduduk')
            ->select('penduduk.*,agama.*,status.*,shdk.*,status.*,kk.*')
            ->join('kk', 'penduduk.id_kk = kk.id_kk', 'LEFT')
            ->join('agama', 'penduduk.id_agama = agama.id_agama', 'LEFT')
            ->join('status', 'penduduk.id_status = status.id_status', 'LEFT')
            ->join('shdk', 'penduduk.id_shdk = shdk.id_shdk', 'LEFT')
            // ->join('shdk', 'penduduk.id_shdk = shdk.id_shdk', 'LEFT')
            ->where("penduduk.id_penduduk=" . $surat_keluar[0]->id_penduduk)
            ->get()->getResultObject();
        dd($penduduk);
        $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <h1>coba</h1>
        </body>
        </html>';

        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Dea Venditama');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        //line ini penting
        $this->response->setContentType('application/pdf');
        //Close and output PDF document
        $pdf->Output('invoice.pdf', 'I');
    }

    public function json()
    {
        return DataTables::use('surat_keluar')
            ->select('surat_keluar.*,
            jenis_surat.nama_jenissurat,
            penduduk.nama,
            penduduk.nik')
            ->join('jenis_surat', 'jenis_surat.id_jenissurat = surat_keluar.id_jenissurat', 'LEFT')
            ->join('penduduk', 'penduduk.id_penduduk = surat_keluar.id_penduduk', 'LEFT')
            // ->where(['penduduk.id_shdk' => "1"])
            // ->order('id_surat', 'DESC')
            ->addColumn('action', function ($data) {
                return "
        <form action='/surat_keluar/" . $data->id_sk . "' method='post' class='d-inline'>
                           " . csrf_field() . "
                          <input type='hidden' name='_method' value='delete' />
                          <button onClick='return confirm(" . '"Anda Yakin ?"' . ")' class='btn btn-icon waves-effect waves-light btn-danger' type='submit'><i class='fas fa-trash'></i> </button></form>            
        <a href='" . base_url('surat_keluar/edit/' . $data->id_sk) . "' class='btn btn-icon waves-effect waves-light btn-warning'> <i class='fas fa-pen'></i> </a>
        <a target='_blank' href='" . base_url('surat_keluar/cetak/' . $data->id_sk) . "' class='btn btn-icon waves-effect waves-light btn-info'> <i class='fas fa-print'></i> </a>";
            })
            // ->rawColumns(['action'])
            // ->where(['id_shdk' => 1])
            // ->order(['id'])
            ->rawColumns(['action'])
            // ->hideColumns(['password_hash'])
            ->make(true);
    }





    //--------------------------------------------------------------------

}
