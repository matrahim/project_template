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
              <h4 class="text-uppercase mt-0"><?= lang('Auth.loginTitle') ?></h4>
            </div>
            <?= view('Myth\Auth\Views\_message_block') ?>

            <form action="<?= route_to('login') ?>" method="post">
              <?= csrf_field() ?>

              <?php if ($config->validFields === ['email']) : ?>
                <div class="form-group mb-3">
                  <label for="login"><?= lang('Auth.email') ?></label>
                  <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                  <div class="invalid-feedback">
                    <?= session('errors.login') ?>
                  </div>
                </div>
              <?php else : ?>
                <div class="form-group mb-3">
                  <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
                  <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                  <div class="invalid-feedback">
                    <?= session('errors.login') ?>
                  </div>
                </div>
              <?php endif; ?>

              <div class="form-group mb-3">
                <label for="password"><?= lang('Auth.password') ?></label>
                <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                <div class="invalid-feedback">
                  <?= session('errors.password') ?>
                </div>
              </div>

              <?php if ($config->allowRemembering) : ?>
                <div class="form-group mb-3">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" id="checkbox-signin" <?php if (old('remember')) : ?> checked <?php endif ?>>
                    <label class="custom-control-label" for="checkbox-signin">
                      <?= lang('Auth.rememberMe') ?>
                    </label>
                  </div>
                </div>
              <?php endif; ?>

              <div class="form-group mb-0 text-center">
                <button class="btn btn-primary btn-block" type="submit"><?= lang('Auth.loginAction') ?> </button>
              </div>

            </form>

            <div class="row mt-3">
              <?php if ($config->activeResetter) : ?>
                <div class="col-12 text-center">
                  <p> <a href="<?= route_to('forgot') ?>" class="text-black ml-1"><i class="fa fa-lock mr-1"></i><?= lang('Auth.forgotYourPassword') ?></a></p>
                <?php endif; ?>
                <?php if ($config->allowRegistration) : ?>
                  <p class="text-black">Don't have an account? <a href="<?= route_to('register') ?>" class="text-black ml-1"><?= lang('Auth.needAnAccount') ?></a></p>
                <?php endif; ?>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
          </div> <!-- end card-body -->
        </div>
        <!-- end card -->




      </div> <!-- end col -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</div>
<!-- end page -->
<?= $this->endSection(); ?>