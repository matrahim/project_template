<?= $this->extend('templates/index'); ?>


<?= $this->section('page-content'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-xl-12">
      <div class="card-box">
        <h4 class="header-title mt-0 mb-3">Form Edit Data</h4>

        <form action="/account/update" method="POST" enctype="multipart/form-data">
          <?= csrf_field() ?>
          <input type="hidden" value="<?= $user->id; ?>" name="id">
          <div class="row">

            <div class=" form-group col-xl-4">
              <label for="username">User Name</label>
              <input type="text" name="username" placeholder="User Name" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ""; ?>" value="<?= old('username') == "" ? $user->username : old('username'); ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('username'); ?>
              </div>
              <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
            </div>
            <div class=" form-group col-xl-4">
              <label for="email">Email address</label>
              <input type="text" name="email" placeholder="Email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ""; ?>" value="<?= old('email') == "" ? $user->email : old('email'); ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('email'); ?>
              </div>
              <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
            </div>

            <div class="form-group col-xl-4">
              <label for="userName">Full Name</label>
              <input type="text" name="fullname" placeholder="Full Name" class="form-control <?= ($validation->hasError('fullname')) ? 'is-invalid' : ""; ?>" value="<?= old('fullname') == "" ? $user->fullname : old('fullname'); ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('fullname'); ?>
              </div>
              <!-- <input type="text" name="fullname" placeholder="Enter user name" class="form-control" id="userName"> -->
            </div>
          </div>


          <div class="row">
            <div class="form-group col-xl-4">
              <label for="pass1">Password</label>
              <input type="password" name="password" placeholder="Password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ""; ?>" value="<?= old('password') == "" ? $user->password : old('password'); ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('password'); ?>
              </div>
            </div>
            <div class="form-group col-xl-4">
              <label for="password2">Confirm Password </label>
              <input type="password" name="password2" placeholder="Confirm Password" class="form-control <?= ($validation->hasError('password2')) ? 'is-invalid' : ""; ?>" value="<?= old('password2'); ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('password2'); ?>
              </div>
              <!-- <input type="password" placeholder="Password" class="form-control"> -->
            </div>
            <div class="form-group col-xl-4">
              <label for="profil_img">Profil Pic</label>
              <!-- <h4 class="header-title mt-0 mb-3">Profil Pic</h4> -->
              <div class="form-group row">
                <div class="col-xl-4">
                  <img src="<?= base_url() ?>/img/profil/<?= $user->user_image; ?> " class="img-thumbnail img-preview">
                </div>
                <div class="col-xl-8">
                  <input onchange="previewImg()" type="file" class="custom-file-input <?= ($validation->hasError('profil_img')) ? 'is-invalid' : ''; ?>" id="profil_img" name="profil_img">
                  <label class="custom-file-label" for="profil_img">Pilih Gambar</label>

                  <div class="invalid-feedback">
                    <?= $validation->getError('profil_img'); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group text-center mb-0">
            <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
              Submit
            </button>
            <a href="/" type="reset" class="btn btn-secondary waves-effect waves-light">
              Cancel
            </a>
          </div>

        </form>
      </div>
    </div><!-- end col -->


  </div>
  <!-- end row -->

</div> <!-- container-fluid -->



<?= $this->endSection(); ?>