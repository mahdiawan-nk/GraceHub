<?php
$infoUser = detailUser();
?>

<div class="row" <?= $infoUser->role == 2 ? 'style="display: none;"' : '' ?> >
    <div class="col-md-6 col-xl-3" data-aos="zoom-in-down" data-aos-offset="200" data-aos-delay="50" data-aos-duration="500">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h5 class="card-title mb-0">Total Kecamatan</h5>
                </div>
                <div class="row d-flex align-items-center">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0 counter">
                            <?= $kecamatan ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3" data-aos="zoom-in-down" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h5 class="card-title mb-0">Total Gereja</h5>
                </div>
                <div class="row d-flex align-items-center ">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0 counter">
                            <?= $gereja ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3" data-aos="zoom-in-down" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1500">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h5 class="card-title mb-0">Total Jemaat Seluruh Gereja</h5>
                </div>
                <div class="row d-flex align-items-center ">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0 counter">
                            <?= $jemaat ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3" data-aos="zoom-in-down" data-aos-offset="200" data-aos-delay="50" data-aos-duration="2000">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h5 class="card-title mb-0">Admin Gereja</h5>
                </div>
                <div class="row d-flex align-items-center ">
                    <div class="col-8"> 
                        <h2 class="d-flex align-items-center mb-0 counter">
                            <?= $admin ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end col-->
</div>
<div class="card text-primary" data-aos="zoom-in" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000">
    <img src="<?= $this->config->item('admin_assets') ?>static-file/bg-gereja.jpg" class="card-img img-fluid" alt="..." style="max-height: 65dvh">
    <div class="card-img-overlay text-center mx-auto my-auto align-self-center shadow" style="background-color: #f0f8ff91;">
        <h2 class="text-dark fw-bolder text-dashboard">Selamat Datang Di Sistem Informasi Gereja</h2>
    </div>
</div>

<script>
    
    $(document).ready(function() {
        $('.counter').each(function() {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {
                duration: 1500,
                easing: 'swing',
                step: function(now) {
                    $(this).text(Math.ceil(now));
                }
            });
        })
    });
</script>