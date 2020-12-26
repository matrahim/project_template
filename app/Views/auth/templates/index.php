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

  <!-- App css -->
  <link href="<?= base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>


<body class="authentication-bg">

  <div class="home-btn d-none d-sm-block">
    <a href="index.html"><i class="fas fa-home h2 text-dark"></i></a>
  </div>

  <?= $this->renderSection('content'); ?>
  <!-- end page -->


  <!-- Vendor js -->
  <script src="<?= base_url(); ?>/assets/js/vendor.min.js"></script>

  <!-- App js -->
  <script src="<?= base_url(); ?>/assets/js/app.min.js"></script>

</body>

</html>