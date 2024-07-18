<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - iPortfolio Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('') ?>assets/front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/front/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/front/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/front/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/front/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Main CSS File -->
    <link href="<?= base_url('') ?>assets/front/css/main.css" rel="stylesheet">
    <style>
        .counter {
            color: #fff;
            background: linear-gradient(to right bottom, #FFD81B, #f9b12a);
            font-family: 'Dosis', sans-serif;
            text-align: center;
            width: 180px;
            height: 180px;
            padding: 40px 20px 20px;
            margin: 0 auto;
            border-radius: 10px 10px 100px 100px;
            box-shadow: 0 0 15px -3px rgba(40, 46, 46, 0.91);
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .counter:after {
            content: '';
            background-color: #f9b12a;
            height: 100%;
            width: 100%;
            position: absolute;
            left: 0;
            top: 0;
            z-index: -1;
            clip-path: polygon(100% 0, 0% 100%, 100% 100%);
        }

        .counter .counter-value {
            font-size: 55px;
            font-weight: 600;
            line-height: 40px;
            margin: 0 0 15px;
            display: block;
        }

        .counter h3 {
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 0 20px;
        }

        .counter.green {
            background: linear-gradient(to right bottom, #a9dd23, #52C242);
        }

        .counter.green:after {
            background: #52C242;
        }

        .counter.cgreen {
            background: linear-gradient(to right bottom, #01AD9F, #008888);
        }

        .counter.cgreen:after {
            background: #008888;
        }

        .counter.blue {
            background: linear-gradient(to right bottom, #00C5EF, #0092f4);
        }

        .counter.blue:after {
            background: #0092f4;
        }

        @media screen and (max-width:990px) {
            .counter {
                margin-bottom: 40px;
            }
        }
    </style>
</head>

<body class="index-page">

    <?php $this->load->view('layouts/frontend/navigaton'); ?>

    <main class="main" style="min-height: 90dvh;">
        <?php $this->load->view($pages); ?>

    </main>
    <?php
    $this->config->load('app_config');
    ?>
    <footer id="footer" class="footer  light-background">

        <div class="container">
            <div class="copyright text-center ">
                <p>© <span>Copyright</span> <strong class="px-1 sitename"><?= $this->config->item('app_name') ?> Version <?= $this->config->item('app_version') ?></strong> <span>All Rights Reserved</span></p>
            </div>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/"> <?= $this->config->item('app_author') ?></a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('') ?>assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('') ?>assets/front/vendor/php-email-form/validate.js"></script>
    <script src="<?= base_url('') ?>assets/front/vendor/aos/aos.js"></script>
    <script src="<?= base_url('') ?>assets/front/vendor/typed.js/typed.umd.js"></script>
    <script src="<?= base_url('') ?>assets/front/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?= base_url('') ?>assets/front/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="<?= base_url('') ?>assets/front/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url('') ?>assets/front/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="<?= base_url('') ?>assets/front/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?= base_url('') ?>assets/front/vendor/swiper/swiper-bundle.min.js"></script>


    <!-- Main JS File -->
    <script src="<?= base_url('') ?>assets/front/js/main.js"></script>
    <script>
        const baseUrlKecamatan = '<?= base_url('api/kecamatan') ?>';
        $(document).ready(function() {
            $('.counter-value').each(function() {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 3500,
                    easing: 'swing',
                    step: function(now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });
        });
    </script>

</body>

</html>