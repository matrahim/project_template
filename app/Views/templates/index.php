<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Adminto - Responsive Admin Dashboard Template</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
  <meta content="Coderthemes" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="<?= base_url(); ?>/assets/images/favicon.ico">

  <!-- third party css -->
  <link href="<?= base_url(); ?>/assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>/assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>/assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>/assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
  <!-- third party css end -->

  <!-- dropify -->
  <link href="<?= base_url(); ?>/assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />

  <!-- App css -->
  <link href="<?= base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

  <!-- Begin page -->
  <div id="wrapper">

    <!-- Topbar Start -->

    <?= $this->include('templates/topbar'); ?>
    <!-- end Topbar -->

    <!-- ========== Left Sidebar Start ========== -->
    <?= $this->include('templates/sidebar'); ?>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
      <div class="content">

        <!-- Start Content-->
        <?= $this->renderSection('page-content'); ?>
      </div> <!-- content -->

      <!-- Footer Start -->
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <?= date('Y'); ?> &copy; Mamuju.Tech <a href=""></a>
            </div>
            <div class="col-md-6">
              <div class="text-md-right footer-links d-none d-sm-block">
                <a href="javascript:void(0);">About Us</a>
                <a href="javascript:void(0);">Help</a>
                <a href="javascript:void(0);">Contact Us</a>
              </div>
            </div>
          </div>
        </div>
      </footer>
      <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


  </div>
  <!-- END wrapper -->


  <!-- Vendor js -->
  <script src="<?= base_url(); ?>/assets/js/vendor.min.js"></script>

  <!-- third party js -->
  <script src="<?= base_url(); ?>/assets/libs/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url(); ?>/assets/libs/datatables/dataTables.bootstrap4.js"></script>
  <script src="<?= base_url(); ?>/assets/libs/datatables/dataTables.responsive.min.js"></script>
  <script src="<?= base_url(); ?>/assets/libs/datatables/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url(); ?>/assets/libs/datatables/dataTables.buttons.min.js"></script>
  <script src="<?= base_url(); ?>/assets/libs/datatables/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url(); ?>/assets/libs/datatables/buttons.html5.min.js"></script>
  <script src="<?= base_url(); ?>/assets/libs/datatables/buttons.flash.min.js"></script>
  <script src="<?= base_url(); ?>/assets/libs/datatables/buttons.print.min.js"></script>
  <script src="<?= base_url(); ?>/assets/libs/datatables/dataTables.keyTable.min.js"></script>
  <script src="<?= base_url(); ?>/assets/libs/datatables/dataTables.select.min.js"></script>
  <script src="<?= base_url(); ?>/assets/libs/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url(); ?>/assets/libs/pdfmake/vfs_fonts.js"></script>
  <!-- third party js ends -->
  <!-- Datatables init -->
  <script src="<?= base_url(); ?>/assets/js/pages/datatables.init.js"></script>
  <!-- Validation js (Parsleyjs) -->
  <script src="<?= base_url(); ?>/assets/libs/parsleyjs/parsley.min.js"></script>

  <!-- dropify js -->
  <script src="<?= base_url(); ?>/assets/libs/dropify/dropify.min.js"></script>

  <!-- form-upload init -->
  <script src="<?= base_url(); ?>/assets/js/pages/form-fileupload.init.js"></script>

  <!-- validation init -->
  <script src="<?= base_url(); ?>/assets/js/pages/form-validation.init.js"></script>
  <!-- App js -->
  <script src="<?= base_url(); ?>/assets/js/app.min.js"></script>

  <script>
    $('#datatable_user').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: '<?= base_url('admin') ?>/json'
      },
      columns: [{
          data: 'username',
          name: 'username'
        },
        {
          data: 'email',
          name: 'email'
        },
        {
          data: 'fullname',
          name: 'fullname'
        },
        {
          data: 'foto',
          name: 'foto'
        },
        {
          data: 'type_user',
          name: 'type_user'
        },
        {
          data: 'action',
          name: 'action'
        },
      ]
    });


    function previewImg() {

      const gambar = document.querySelector('#profil_img');
      const label = document.querySelector('.custom-file-label');
      const imgPrev = document.querySelector('.img-preview');

      label.textContent = gambar.files[0].name;

      const fileLabel = new FileReader();
      fileLabel.readAsDataURL(gambar.files[0]);

      fileLabel.onload = function(e) {
        imgPrev.src = e.target.result;
      }
    }
  </script>
</body>

</html>