<?= $this->extend('templates/index'); ?>


<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <h4 class="header-title mt-0 mb-3">Form Tambah Data Keluarga</h4>

                <form action="/keluarga/save" method="POST">
                    <?= csrf_field() ?>
                    <div class="row">

                        <div class=" form-group col-xl-4">
                            <label for="no_kk">No Kartu Keluarga</label>
                            <input type="text" name="no_kk" placeholder="No Kartu keluarga" class="form-control <?= ($validation->hasError('no_kk')) ? 'is-invalid' : ""; ?>" value="<?= old('no_kk'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_kk'); ?>
                            </div>
                            <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
                        </div>
                        <div class=" form-group col-xl-4">
                            <label for="rt">RT</label>
                            <input type="text" name="rt" placeholder="No RT" class="form-control <?= ($validation->hasError('rt')) ? 'is-invalid' : ""; ?>" value="<?= old('rt'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('rt'); ?>
                            </div>
                            <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
                        </div>

                        <div class=" form-group col-xl-4">
                            <label for="rw">RW</label>
                            <input type="text" name="rw" placeholder="No RW" class="form-control <?= ($validation->hasError('rw')) ? 'is-invalid' : ""; ?>" value="<?= old('rw'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('rw'); ?>
                            </div>
                            <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
                        </div>

                    </div>
                    <div class="row">

                        <div class=" form-group col-xl-6">
                            <label for="id_dusun">Dusun</label>
                            <select name="id_dusun" class="custom-select <?= ($validation->hasError('id_dusun')) ? 'is-invalid' : ""; ?>">
                                <option value="" <?= old('id_dusun') == "" ? "selected" : ""; ?>>Pilih Dusun</option>
                                <?php foreach ($dusun as $row) : ?>
                                    <option <?= old('id_dusun') == $row['id_dusun'] ? "selected" : ""; ?> value="<?= $row['id_dusun'] ?>"><?= $row['nama_dusun'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('id_dusun'); ?>
                            </div>
                            <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
                        </div>
                        <div class=" form-group col-xl-6">
                            <label for="nkk">Kepala Keluarga</label>
                            <select onchange="angotakk()" name="kk" id="nkk" class="form-control select2 <?= ($validation->hasError('kk')) ? 'is-invalid' : ""; ?>">
                                <option value="" <?= old('kk') == "" ? "selected" : ""; ?>>Pilih Kepala keluarga - Nik </option>
                                <?php foreach ($kk as $row) : ?>
                                    <option <?= old('kk') == $row->id_kk ? "selected" : ""; ?> data-id="<?= $row->id_penduduk ?>" value="<?= $row->id_kk ?>"><?= $row->nama . ' - ' . $row->nik ?></option>
                                <?php endforeach; ?>
                            </select>

                            <div class="invalid-feedback">
                                <?= $validation->getError('kk'); ?>
                            </div>
                            <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class=" form-group col-xl-12">
                            <div class="form-group text-center mt-3">
                                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                    Submit
                                </button>
                                <a href="/kk" type="reset" class="btn btn-secondary waves-effect waves-light">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" form-group col-xl-12">
                            <h4 class="mt-0 header-title">Anggota Keluarga</h4>

                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>SHDK</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tbody id="isi_kk">

                                        <tr>
                                            <th colspan="4" class="text-muted text-center">Data Kosong</th>

                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div><!-- end col -->


    </div>
    <!-- end row -->

</div> <!-- container-fluid -->



<?= $this->endSection(); ?>