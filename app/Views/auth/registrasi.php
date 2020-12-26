<?= $this->extend('auth/templates/index'); ?>

<?= $this->section('content'); ?>

<div class="account-pages mt-5 mb-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="text-center">
          <a href="index.html">
            <span><img src="<?= base_url(); ?>/assets/images/logo-dark.png" alt="" height="22"></span>
          </a>
          <p class="text-muted mt-2 mb-4">Responsive Admin Dashboard</p>
        </div>
        <div class="card">

          <div class="card-body p-4">

            <div class="text-center mb-4">
              <h4 class="text-uppercase mt-0"><?= lang('Auth.register') ?></h4>
            </div>
            <?= view('Myth\Auth\Views\_message_block') ?>

            <form action="<?= route_to('register') ?>" method="post">
              <?= csrf_field() ?>

              <div class="form-group">
                <label for="email"><?= lang('Auth.email') ?></label>
                <input class="form-control" type="email" <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
              </div>
              <div class="form-group">
                <label for="username"><?= lang('Auth.username') ?></label>
                <input class="form-control" type="text" <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-6">
                    <label for="password"><?= lang('Auth.password') ?></label>
                    <input class="form-control" name="password" type="password" <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                  </div>
                  <div class="col-6">
                    <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                    <input class="form-control" name="pass_confirm" type="password" <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                  </div>
                </div>
              </div>
              <!-- <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="checkbox-signup">
                  <label class="custom-control-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                </div>
              </div> -->
              <div class="form-group mb-0 text-center">
                <button class="btn btn-primary btn-block" type="submit"> <?= lang('Auth.register') ?></button>
              </div>

            </form>

          </div> <!-- end card-body -->
        </div>
        <!-- end card -->

        <div class="row mt-3">
          <div class="col-12 text-center">
            <p class="text-white"><?= lang('Auth.alreadyRegistered') ?> <a href="<?= route_to('login') ?>" class="text-dark ml-1"><b><?= lang('Auth.signIn') ?></b></a></p>
          </div> <!-- end col -->
        </div>
        <!-- end row -->

      </div> <!-- end col -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</div>
<!-- end page -->
<?= $this->endSection(); ?>