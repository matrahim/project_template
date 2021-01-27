<?= $this->extend('templates/index'); ?>


<?= $this->section('page-content'); ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-xl-12">
      <div class="card-box">
        <h4 class="header-title mt-0 mb-3">Form Tambah Data Penduduk</h4>

        <form action="/penduduk/save" method="POST">
          <?= csrf_field() ?>
          <div class="row">

            <div class=" form-group col-xl-4">
              <label for="nik">NIK</label>
              <input type="text" name="nik" placeholder="NIK" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ""; ?>" value="<?= old('nik'); ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('nik'); ?>
              </div>
              <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
            </div>
            <div class=" form-group col-xl-4">
              <label for="nama">Nama</label>
              <input type="text" name="nama" placeholder="Nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ""; ?>" value="<?= old('nama'); ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('nama'); ?>
              </div>
              <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
            </div>

            <div class="form-group col-xl-4">
              <label for="agama">Agama</label>
              <select name="agama" class="custom-select <?= ($validation->hasError('agama')) ? 'is-invalid' : ""; ?>">
                <option <?= old('agama') == "" ? "selected" : ""; ?> value="">Pilih Agama</option>
                <?php foreach ($agama as $row) : ?>
                  <option <?= old('agama') == $row['id_agama'] ? "selected" : ""; ?> value="<?= $row['id_agama'] ?>"><?= $row['nama_agama'] ?></option>
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
              <input type="text" name="tempat_lahir" placeholder="Temapat Lahir" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ""; ?>" value="<?= old('tempat_lahir'); ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('tempat_lahir'); ?>
              </div>
              <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
            </div>
            <div class=" form-group col-xl-4">
              <label for="tgl_lahir">Tanggal Lahir</label>
              <input type="date" name="tgl_lahir" placeholder="Tanggal Lahir" class="form-control <?= ($validation->hasError('tgl_lahir')) ? 'is-invalid' : ""; ?>" value="<?= old('tgl_lahir'); ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('tgl_lahir'); ?>
              </div>
              <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
            </div>

            <div class="form-group col-xl-4">
              <label for="pekerjaan">Pekerjaan</label>
              <input type="text" name="pekerjaan" placeholder="Pekerjaan" class="form-control <?= ($validation->hasError('pekerjaan')) ? 'is-invalid' : ""; ?>" value="<?= old('pekerjaan'); ?>">
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
                <option <?= old('jk') == "" ? "selected" : ""; ?> value="">Pilih Jenis Kelamin</option>
                <option <?= old('jk') == 'L' ? "selected" : ""; ?> value="L">Laki-laki</option>
                <option <?= old('jk') == 'P' ? "selected" : ""; ?> value="P">Perempuan</option>
              </select>

              <div class="invalid-feedback">
                <?= $validation->getError('jk'); ?>
              </div>
              <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
            </div>
            <div class=" form-group col-xl-4">
              <label for="shdk">SHDK</label>
              <select name="shdk" class="custom-select <?= ($validation->hasError('shdk')) ? 'is-invalid' : ""; ?>">
                <option value="" <?= old('shdk') == "" ? "selected" : ""; ?>>Pilih Status Hubungan Dalam Keluarga</option>
                <?php foreach ($shdk as $row) : ?>
                  <option <?= old('shdk') == $row['id_shdk'] ? "selected" : ""; ?> value="<?= $row['id_shdk'] ?>"><?= $row['nama_shdk'] ?></option>
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
                <option value="" <?= old('agama') == "" ? "selected" : ""; ?>>Status Perkawinan</option>
                <?php foreach ($status as $row) : ?>
                  <option <?= old('status') == $row['id_status'] ? "selected" : ""; ?> value="<?= $row['id_status'] ?>"><?= $row['nama_status'] ?></option>
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
              <select name="kk" id="nkk" class="form-control select2 <?= ($validation->hasError('kk')) ? 'is-invalid' : ""; ?>">
                <option value="" <?= old('kk') == "" ? "selected" : ""; ?>>Pilih No KK - Kepala keluarga</option>
                <?php foreach ($kk as $row) : ?>
                  <option <?= old('kk') == $row->id_kk ? "selected" : ""; ?> value="<?= $row->id_kk ?>"><?= $row->no_kk . ' - ' . $row->nama ?></option>
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
                    <a href="/" type="reset" class="btn btn-secondary waves-effect waves-light">
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