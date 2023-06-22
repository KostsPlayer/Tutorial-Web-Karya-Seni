<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('assets') ?>/Bethany/assets/img/logo_wa_.png" rel="icon">
    <link href="<?= base_url('assets') ?>/Bethany/assets/img/logo_wa_.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/Bethany/assets/vendor/fontawesome-free-6.4.0-web/css/all.min.css" type="text/css">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets') ?>/Bethany/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/Bethany/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/Bethany/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/Bethany/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/Bethany/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/Bethany/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/Bethany/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('assets') ?>/Bethany/assets/css/style.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/css/mystyle.css" rel="stylesheet">

    <style>
        .poster-video {
            width: 100%;
            /* Sesuaikan ukuran yang diinginkan */
            height: auto;
            /* Sesuaikan ukuran yang diinginkan */
        }
    </style>

    <!-- =======================================================
  * Template Name: Bethany
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container">
            <div class="header-container d-flex align-items-center justify-content-between">
                <div class="logo">
                    <h1 class="text-light"><a href="<?= base_url('main') ?>"><i class="fa-solid fa-palette fa-bounce"></i><span class="mx-1">ARTS.co</span></a></h1>
                    <!-- Uncomment below if you prefer to use an image logo -->
                    <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
                </div>

                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a class="nav-link scrollto active" href="<?= base_url('main/index/#hero') ?>">Home</a></li>
                        <li><a class="nav-link scrollto" href="<?= base_url('main/index/#services') ?>">Services</a></li>
                        <li><a class="nav-link scrollto" href="<?= base_url('main/index/#why-us') ?>">Blog</a></li>
                        <li><a class="nav-link scrollto " href="<?= base_url('main/index/#portfolio') ?>">Gallery</a></li>
                        <li><a class="nav-link scrollto" href="<?= base_url('main/index/#contact') ?>">Contact</a></li>
                        <li><a class="getstarted scrollto" href="<?= base_url('auth'); ?>">Sign Up</a></li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->

            </div><!-- End Header Container -->
        </div>
    </header><!-- End Header -->