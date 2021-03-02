<?= $this->extend('templates/index'); ?>


<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <h4 class="header-title mt-0 mb-3">Form Edit Data Keluarga</h4>

                <form action="/kk/update" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_kk" value="<?= $id ?>">
                    <input type="hidden" name="old_no_kk" value="<?= $kk->no_kk ?>">
                    <div class="row">

                        <div class=" form-group col-xl-4">
                            <label for="no_kk">No Kartu Keluarga</label>
                            <input type="text" name="no_kk" placeholder="No Kartu keluarga" class="form-control <?= ($validation->hasError('no_kk')) ? 'is-invalid' : ""; ?>" value="<?= old('no_kk') == "" ? $kk->no_kk : old('no_kk'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_kk'); ?>
                            </div>
                            <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
                        </div>
                        <div class=" form-group col-xl-4">
                            <label for="rt">RT</label>
                            <input type="text" name="rt" placeholder="No RT" class="form-control <?= ($validation->hasError('rt')) ? 'is-invalid' : ""; ?>" value="<?= old('rt') == "" ? $kk->rt : old('rt'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('rt'); ?>
                            </div>
                            <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
                        </div>

                        <div class=" form-group col-xl-4">
                            <label for="rw">RW</label>
                            <input type="text" name="rw" placeholder="No RW" class="form-control <?= ($validation->hasError('rw')) ? 'is-invalid' : ""; ?>" value="<?= old('rw') == "" ? $kk->rw : old('rw'); ?>">
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
                                    <option <?php
                                            if (old('id_dusun') == "") {
                                                if ($row['id_dusun'] == $kk->id_dusun) {

                                                    echo  "selected";
                                                }
                                            } else {
                                                if ($row['id_dusun'] == old('id_dusun')) {

                                                    echo  "selected";
                                                }
                                            }
                                            ?> value="<?= $row['id_dusun'] ?>"><?= $row['nama_dusun'] ?></option>
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
                                <?php foreach ($penduduk as $row) : ?>
                                    <option <?php
                                            if (old('kk') == "") {
                                                if ($kk->id_kk == $row->id_kk) {
                                                    echo "selected";
                                                }
                                            } else {
                                                if (old('kk') == $row->id_kk) {
                                                    echo  "selected";
                                                }
                                            }

                                            ?> data-id="<?= $row->id_kk ?>" value="<?= $row->id_kk . ',' . $row->id_penduduk ?>"><?= $row->nama . ' - ' . $row->nik ?></option>
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