<?= $this->extend('templates/index'); ?>


<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <h4 class="header-title mt-0 mb-3">Form Edit Surat Keluar</h4>

                <form action="/surat_keluar/update" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_sk" value="<?= $id ?>">
                    <div class="row">

                        <div class=" form-group col-xl-6">
                            <label for="no_surat">No Surat</label>
                            <input type="text" name="no_surat" placeholder="Nomor Surat" class="form-control <?= ($validation->hasError('no_surat')) ? 'is-invalid' : ""; ?>" value="<?= old('no_surat') == "" ? $surat_keluar['no_surat'] : old('no_surat') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_surat'); ?>
                            </div>
                            <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
                        </div>
                        <div class=" form-group col-xl-6">
                            <label for="tgl_srt">Tanggal Surat</label>
                            <input type="date" name="tgl_srt" placeholder="Tanggal Surat" class="form-control <?= ($validation->hasError('tgl_srt')) ? 'is-invalid' : ""; ?>" value="<?= old('tgl_srt') == "" ? $surat_keluar['tgl_srt'] : old('tgl_srt'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tgl_srt'); ?>
                            </div>
                            <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
                        </div>


                    </div>
                    <div class="row">

                        <div class=" form-group col-xl-6">
                            <label for="id_jenissurat">Jenis Surat</label>
                            <select name="id_jenissurat" class="custom-select <?= ($validation->hasError('id_jenissurat')) ? 'is-invalid' : ""; ?>">
                                <option value="">Pilih Jenis Surat</option>
                                <?php foreach ($jenis_surat as $row) : ?>
                                    <option <?php
                                            if (old('id_jenissurat') == "") {
                                                if ($surat_keluar['id_jenissurat'] == $row['id_jenissurat']) {
                                                    echo "selected";
                                                }
                                            } else {
                                                if (old('id_jenissurat') == $row['id_jenissurat']) {
                                                    echo "selected";
                                                }
                                            } ?> value="<?= $row['id_jenissurat'] ?>"><?= $row['nama_jenissurat'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('id_jenissurat'); ?>
                            </div>
                            <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
                        </div>
                        <div class=" form-group col-xl-6">
                            <label for="penduduk_sk">Pilih Penduduk</label>
                            <select name="id_penduduk" id="penduduk_sk" class="form-control select2 <?= ($validation->hasError('id_penduduk')) ? 'is-invalid' : ""; ?>">
                                <option value="" <?= old('id_penduduk') == "" ? "selected" : ""; ?>>Pilih Penduduk - Nik </option>
                                <?php foreach ($penduduk as $row) : ?>
                                    <option <?php
                                            if (old('id_penduduk') == "") {
                                                if ($surat_keluar['id_penduduk'] == $row['id_penduduk']) {
                                                    echo "selected";
                                                }
                                            } else {
                                                if (old('id_penduduk') == $row['id_penduduk']) {
                                                    echo "selected";
                                                }
                                            } ?> value="<?= $row['id_penduduk'] ?>"><?= $row['nama'] . ' - ' . $row['nik'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <div class="invalid-feedback">
                                <?= $validation->getError('id_penduduk'); ?>
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
                                <a href="/surat_keluar" type="reset" class="btn btn-secondary waves-effect waves-light">
                                    Cancel
                                </a>
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