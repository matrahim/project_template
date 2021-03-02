<?= $this->extend('templates/index'); ?>


<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="mt-0 header-title">Daftar Keluarga</h4>
                <p class="text-muted font-14 mb-3">
                    Manage Keluarga
                </p>
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif ?>
                <a href="<?= base_url("keluarga/add"); ?>">
                    <button class="btn btn-info waves-effect waves-light mb-3"> <i class="fa fa-user-plus mr-1"></i> <span>Tambah data Keluarga</span> </button>
                </a>

                <table id="datatable_kk" class="table table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>Kepala Keluarga</th>
                            <th>NKK</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                </table>
            </div>
        </div>
    </div> <!-- end row -->

</div> <!-- container-fluid -->

<?= $this->endSection(); ?>