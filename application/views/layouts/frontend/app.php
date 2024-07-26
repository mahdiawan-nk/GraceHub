<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>GraceHub</title>
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
    <!-- <script src="<?= base_url('') ?>assets/front/js/main.js"></script> -->
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

        const headerToggleBtn = document.querySelector('.header-toggle');

        function headerToggle() {
            document.querySelector('#header').classList.toggle('header-show');
            headerToggleBtn.classList.toggle('bi-list');
            headerToggleBtn.classList.toggle('bi-x');
        }
        headerToggleBtn.addEventListener('click', headerToggle);

        /**
         * Hide mobile nav on same-page/hash links
         */
        document.querySelectorAll('#navmenu a').forEach(navmenu => {
            navmenu.addEventListener('click', () => {
                if (document.querySelector('.header-show')) {
                    headerToggle();
                }
            });

        });

        /**
         * Toggle mobile nav dropdowns
         */
        document.querySelectorAll('.navmenu .dropdown > a').forEach(navmenu => {
            navmenu.addEventListener('click', function(e) {
                e.preventDefault();

                const parentLi = this.parentNode;
                const subUl = parentLi.querySelector('ul');

                // Tutup semua menu dropdown lainnya
                document.querySelectorAll('.navmenu .dropdown').forEach(dropdown => {
                    if (dropdown !== parentLi) {
                        dropdown.classList.remove('active');
                        dropdown.querySelector('ul').classList.remove('dropdown-active');
                        dropdown.querySelector('.toggle-dropdown').classList.remove('bi-chevron-up');
                        dropdown.querySelector('.toggle-dropdown').classList.add('bi-chevron-down');
                        dropdown.querySelector('ul').style.display = 'none';
                    }
                });

                // Toggle menu yang diklik
                parentLi.classList.toggle('active');
                subUl.classList.toggle('dropdown-active');
                subUl.style.display = subUl.classList.contains('dropdown-active') ? 'block' : 'none';

                // Toggle ikon
                const toggleIcon = this.querySelector('.toggle-dropdown');
                toggleIcon.classList.toggle('bi-chevron-down');
                toggleIcon.classList.toggle('bi-chevron-up');

                e.stopImmediatePropagation();
            });
        });


        /**
         * Preloader
         */
        const preloader = document.querySelector('#preloader');
        if (preloader) {
            window.addEventListener('load', () => {
                preloader.remove();
            });
        }

        /**
         * Scroll top button
         */
        let scrollTop = document.querySelector('.scroll-top');

        function toggleScrollTop() {
            if (scrollTop) {
                window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
            }
        }
        scrollTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        window.addEventListener('load', toggleScrollTop);
        document.addEventListener('scroll', toggleScrollTop);

        /**
         * Animation on scroll function and init
         */
        function aosInit() {
            AOS.init({
                duration: 600,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });
        }
        window.addEventListener('load', aosInit);

        /**
         * Init typed.js
         */
        const selectTyped = document.querySelector('.typed');
        if (selectTyped) {
            let typed_strings = selectTyped.getAttribute('data-typed-items');
            typed_strings = typed_strings.split(',');
            new Typed('.typed', {
                strings: typed_strings,
                loop: true,
                typeSpeed: 100,
                backSpeed: 50,
                backDelay: 2000
            });
        }

        /**
         * Initiate Pure Counter
         */
        new PureCounter();

        /**
         * Animate the skills items on reveal
         */
        let skillsAnimation = document.querySelectorAll('.skills-animation');
        skillsAnimation.forEach((item) => {
            new Waypoint({
                element: item,
                offset: '80%',
                handler: function(direction) {
                    let progress = item.querySelectorAll('.progress .progress-bar');
                    progress.forEach(el => {
                        el.style.width = el.getAttribute('aria-valuenow') + '%';
                    });
                }
            });
        });

        /**
         * Initiate glightbox
         */
        const glightbox = GLightbox({
            selector: '.glightbox'
        });

        /**
         * Init isotope layout and filters
         */
        document.querySelectorAll('.isotope-layout').forEach(function(isotopeItem) {
            let layout = isotopeItem.getAttribute('data-layout') ?? 'masonry';
            let filter = isotopeItem.getAttribute('data-default-filter') ?? '*';
            let sort = isotopeItem.getAttribute('data-sort') ?? 'original-order';

            let initIsotope;
            imagesLoaded(isotopeItem.querySelector('.isotope-container'), function() {
                initIsotope = new Isotope(isotopeItem.querySelector('.isotope-container'), {
                    itemSelector: '.isotope-item',
                    layoutMode: layout,
                    filter: filter,
                    sortBy: sort
                });
            });

            isotopeItem.querySelectorAll('.isotope-filters li').forEach(function(filters) {
                filters.addEventListener('click', function() {
                    isotopeItem.querySelector('.isotope-filters .filter-active').classList.remove('filter-active');
                    this.classList.add('filter-active');
                    initIsotope.arrange({
                        filter: this.getAttribute('data-filter')
                    });
                    if (typeof aosInit === 'function') {
                        aosInit();
                    }
                }, false);
            });

        });

        /**
         * Init swiper sliders
         */
        function initSwiper() {
            document.querySelectorAll(".init-swiper").forEach(function(swiperElement) {
                let config = JSON.parse(
                    swiperElement.querySelector(".swiper-config").innerHTML.trim()
                );

                if (swiperElement.classList.contains("swiper-tab")) {
                    initSwiperWithCustomPagination(swiperElement, config);
                } else {
                    new Swiper(swiperElement, config);
                }
            });
        }

        window.addEventListener("load", initSwiper);

        /**
         * Correct scrolling position upon page load for URLs containing hash links.
         */
        window.addEventListener('load', function(e) {
            if (window.location.hash) {
                if (document.querySelector(window.location.hash)) {
                    setTimeout(() => {
                        let section = document.querySelector(window.location.hash);
                        let scrollMarginTop = getComputedStyle(section).scrollMarginTop;
                        window.scrollTo({
                            top: section.offsetTop - parseInt(scrollMarginTop),
                            behavior: 'smooth'
                        });
                    }, 100);
                }
            }
        });

        /**
         * Navmenu Scrollspy
         */
        let navmenulinks = document.querySelectorAll('.navmenu a');

        function navmenuScrollspy() {
            navmenulinks.forEach(navmenulink => {
                if (!navmenulink.hash) return;
                let section = document.querySelector(navmenulink.hash);
                if (!section) return;
                let position = window.scrollY + 200;
                if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
                    document.querySelectorAll('.navmenu a.active').forEach(link => link.classList.remove('active'));
                    navmenulink.classList.add('active');
                } else {
                    navmenulink.classList.remove('active');
                }
            })
        }
        window.addEventListener('load', navmenuScrollspy);
        document.addEventListener('scroll', navmenuScrollspy);
    </script>

</body>

</html>