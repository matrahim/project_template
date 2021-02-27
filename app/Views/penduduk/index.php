<?= $this->extend('templates/index'); ?>


<?= $this->section('page-content'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card-box">
        <h4 class="mt-0 header-title">Penduduk</h4>
        <p class="text-muted font-14 mb-3">
          Manage Penduduk
        </p>
        <?php if (session()->getFlashdata('pesan')) : ?>
          <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
          </div>
        <?php endif ?>
        <a href="<?= base_url("penduduk/add"); ?>">
          <button class="btn btn-info waves-effect waves-light mb-3"> <i class="fa fa-user-plus mr-1"></i> <span>Tambah Data Penduduk</span> </button>
        </a>

        <table id="datatable_penduduk" class="table table-bordered dt-responsive nowrap">
          <thead>
            <tr>
              <th>NKK</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Tempat Tanggal Lahir</th>
              <th>Jenis Kelamin</th>
              <th>Action</th>
            </tr>
          </thead>


        </table>
      </div>
    </div>
  </div> <!-- end row -->

</div> <!-- container-fluid -->

<?= $this->endSection(); ?>