<?= $this->extend('templates/index'); ?>


<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <h4 class="header-title mt-0 mb-3">Form Edit Data Penduduk</h4>

                <form action="/penduduk/update" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_penduduk" value="<?= $id ?>">
                    <div class="row">

                        <div class=" form-group col-xl-4">
                            <label for="nik">NIK</label>
                            <input type="text" name="nik" placeholder="NIK" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ""; ?>" value="<?= old('nik') == "" ? $penduduk['nik'] : old('nik'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nik'); ?>
                            </div>
                            <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
                        </div>
                        <div class=" form-group col-xl-4">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" placeholder="Nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ""; ?>" value="<?= old('nama') == "" ? $penduduk['nama'] : old('nama');; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                            <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
                        </div>

                        <div class="form-group col-xl-4">
                            <label for="agama">Agama</label>
                            <select name="agama" class="custom-select <?= ($validation->hasError('agama')) ? 'is-invalid' : ""; ?>">

                                <?php foreach ($agama as $row) : ?>
                                    <option <?php if (old('agama') == "") {
                                                if ($penduduk['id_agama'] == $row['id_agama']) {
                                                    echo "selected";
                                                }
                                            } elseif (old('agama') == $row['id_agama']) {
                                                echo "selected";
                                            }  ?> value="<?= $row['id_agama'] ?>"><?= $row['nama_agama'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <div class="invalid-feedback">
                                <?= $validation->getError('agama'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class=" form-group col-xl-4">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" placeholder="Temapat Lahir" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ""; ?>" value="<?= old('tempat_lahir') == "" ? $penduduk['tempat_lahir'] : old('tempat_lahir'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tempat_lahir'); ?>
                            </div>
                            <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
                        </div>
                        <div class=" form-group col-xl-4">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" placeholder="Tanggal Lahir" class="form-control <?= ($validation->hasError('tgl_lahir')) ? 'is-invalid' : ""; ?>" value="<?= old('tgl_lahir') == "" ? $penduduk['tgl_lahir'] : old('tgl_lahir'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tgl_lahir'); ?>
                            </div>
                            <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
                        </div>

                        <div class="form-group col-xl-4">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input type="text" name="pekerjaan" placeholder="Pekerjaan" class="form-control <?= ($validation->hasError('pekerjaan')) ? 'is-invalid' : ""; ?>" value="<?= old('pekerjaan') == "" ? $penduduk['pekerjaan'] : old('pekerjaan'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('pekerjaan'); ?>
                            </div>
                            <!-- <input type="text" name="fullname" placeholder="Enter user name" class="form-control" id="userName"> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class=" form-group col-xl-4">
                            <label for="jk">Jenis Kelamin</label>
                            <select name="jk" class="custom-select <?= ($validation->hasError('jk')) ? 'is-invalid' : ""; ?>">

                                <?php
                                $jk = ['L', 'P'];
                                foreach ($jk as $row) :
                                ?>
                                    <option <?php
                                            if (old('jk') == "") {
                                                if ($penduduk['jk'] == $row) {
                                                    echo "selected";
                                                }
                                            } else {
                                                if (old('jk') == $row) {
                                                    echo "selected";
                                                }
                                            }

                                            ?> value="<?= $row ?>"><?= $row == "P" ? "Perempuan" : "Laki-laki" ?></option>
                                <?php endforeach; ?>
                            </select>

                            <div class="invalid-feedback">
                                <?= $validation->getError('jk'); ?>
                            </div>
                            <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
                        </div>
                        <div class=" form-group col-xl-4">
                            <label for="shdk">Status Hubungan Dalam Keluarga</label>
                            <select name="shdk" class="custom-select <?= ($validation->hasError('shdk')) ? 'is-invalid' : ""; ?>">

                                <?php foreach ($shdk as $row) : ?>
                                    <option <?php
                                            if (old('shdk') == "") {
                                                if ($penduduk['id_shdk'] == $row['id_shdk']) {
                                                    echo "selected";
                                                }
                                            } else {
                                                if (old('shdk') == $row['id_shdk']) {
                                                    echo "selected";
                                                }
                                            }

                                            ?> value="<?= $row['id_shdk'] ?>"><?= $row['nama_shdk'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('shdk'); ?>
                            </div>
                            <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
                        </div>

                        <div class="form-group col-xl-4">
                            <label for="status">Status Perkawinan</label>
                            <select name="status" class="custom-select <?= ($validation->hasError('status')) ? 'is-invalid' : ""; ?>">

                                <?php foreach ($status as $row) : ?>
                                    <option <?php
                                            if (old('status') == "") {
                                                if ($penduduk['id_shdk'] == $row['id_status']) {
                                                    echo "selected";
                                                }
                                            } else {
                                                if (old('status') == $row['id_status']) {
                                                    echo "selected";
                                                }
                                            }

                                            ?> value="<?= $row['id_status'] ?>"><?= $row['nama_status'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('status'); ?>
                            </div>
                            <!-- <input type="text" name="fullname" placeholder="Enter user name" class="form-control" id="userName"> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class=" form-group col-xl-4">
                            <label for="nkk">No Kartu Keluarga</label>
                            <select onchange="angotakk()" name="kk" id="nkk" class="form-control select2 <?= ($validation->hasError('kk')) ? 'is-invalid' : ""; ?>">
                                <option value="" <?php
                                                    if (old('kk') == "" && $penduduk['id_kk'] == "") {

                                                        echo "selected";
                                                    }

                                                    ?>>Pilih No KK - Kepala keluarga</option>
                                <?php foreach ($kk as $row) : ?>
                                    <option <?php
                                            if (old('kk') == "") {
                                                if ($penduduk['id_kk'] == $row->id_kk) {
                                                    echo "selected";
                                                }
                                            } else {
                                                if (old('kk') == $row->id_kk) {
                                                    echo "selected";
                                                }
                                            }

                                            ?> data-id="<?= $row->id_kk ?>" value="<?= $row->id_kk ?>"><?= $row->no_kk . ' - ' . $row->nama ?></option>
                                <?php endforeach; ?>
                            </select>

                            <div class="invalid-feedback">
                                <?= $validation->getError('kk'); ?>
                            </div>
                            <div class="row">
                                <div class=" form-group col-xl-12">
                                    <div class="form-group text-center mt-3">
                                        <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                            Submit
                                        </button>
                                        <a href="/penduduk" type="reset" class="btn btn-secondary waves-effect waves-light">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
                        </div>
                        <div class=" form-group col-xl-8">
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