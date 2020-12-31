<?= $this->extend('templates/index'); ?>


<?= $this->section('page-content'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-xl-12">
      <div class="card-box">
        <h4 class="header-title mt-0 mb-3">Form Add Data</h4>

        <form action="#" data-parsley-validate novalidate>
          <div class="row">
            <div class="form-group col-xl-4">
              <label for="userName">User Name</label>
              <input type="text" name="username" parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="userName">
            </div>
            <div class="form-group col-xl-4">
              <label for="email">Email address</label>
              <input type="email" name="email" parsley-trigger="change" required placeholder="Enter email" class="form-control" id="email">
            </div>

            <div class="form-group col-xl-4">
              <label for="userName">Full Name</label>
              <input type="text" name="username" parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="userName">
            </div>
          </div>


          <div class="row">
            <div class="form-group col-xl-4">

              <label for="pass1">Password</label>
              <input id="pass1" type="password" placeholder="Password" required class="form-control">
            </div>
            <div class="form-group col-xl-4">
              <label for="passWord2">Confirm Password </label>
              <input data-parsley-equalto="#pass1" type="password" required placeholder="Password" class="form-control" id="passWord2">
            </div>
            <div class="form-group col-xl-4">
              <h4 class="header-title mt-0 mb-3">Profil Pic</h4>

              <input type="file" class="dropify" data-height="100" />
            </div>
          </div>

          <div class="form-group text-center mb-0">
            <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
              Submit
            </button>
            <button type="reset" class="btn btn-secondary waves-effect waves-light">
              Cancel
            </button>
          </div>

        </form>
      </div>
    </div><!-- end col -->


  </div>
  <!-- end row -->

</div> <!-- container-fluid -->

<?= $this->endSection(); ?>