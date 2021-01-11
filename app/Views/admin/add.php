<?= $this->extend('templates/index'); ?>


<?= $this->section('page-content'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-xl-12">
      <div class="card-box">
        <h4 class="header-title mt-0 mb-3">Form Add Data</h4>

        <form action="/admin/save" method="POST" enctype="multipart/form-data">
          <?= csrf_field() ?>
          <div class="row">

            <div class=" form-group col-xl-4">
              <label for="username">User Name</label>
              <input type="text" name="username" placeholder="User Name" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ""; ?>" value="<?= old('username'); ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('username'); ?>
              </div>
              <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
            </div>
            <div class=" form-group col-xl-4">
              <label for="email">Email address</label>
              <input type="text" name="email" placeholder="Email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ""; ?>" value="<?= old('email'); ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('email'); ?>
              </div>
              <!-- <input type="email" name="email" placeholder="Email" class="form-control"> -->
            </div>

            <div class="form-group col-xl-4">
              <label for="userName">Full Name</label>
              <input type="text" name="fullname" placeholder="Full Name" class="form-control <?= ($validation->hasError('fullname')) ? 'is-invalid' : ""; ?>" value="<?= old('fullname'); ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('fullname'); ?>
              </div>
              <!-- <input type="text" name="fullname" placeholder="Enter user name" class="form-control" id="userName"> -->
            </div>
          </div>


          <div class="row">
            <div class="form-group col-xl-4">
              <label for="pass1">Password</label>
              <input type="password" name="password" placeholder="Password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ""; ?>" value="<?= old('password'); ?>">
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
              <h4 class="header-title mt-0 mb-3">Profil Pic</h4>

              <input type="file" name="profil_img" class="dropify <?= ($validation->hasError('profil_img')) ? 'is-invalid' : ""; ?>" data-height="100" data-max-file-size="500k" data-allowed-file-extensions="jpg png jpeg" />
              <div class="invalid-feedback">
                <?= $validation->getError('profil_img'); ?>
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