<?php
$this->config->load('app_config');
?>
<header id="header" class="header dark-background d-flex flex-column">
    <i class="header-toggle d-xl-none bi bi-list"></i>

    <div class="profile-img">
        <img src="<?= base_url('') ?>assets/front/img/icon-gereja-2.jpg" alt="" class="img-fluid rounded-circle">
    </div>

    <a href="index.html" class="logo d-flex align-items-center justify-content-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename" style="font-size: 20px;"><?= $this->config->item('app_name') ?></h1>
    </a>

    <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href="<?= base_url() ?>" class="active"><i class="bi bi-house navicon"></i>Home</a></li>
            <li class="dropdown"><a href="#"><i class="bi bi-menu-button navicon"></i> <span>Data Gereja</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul id="list-kecamatan-data-gereja">
                    <?php foreach (dataKecamatan() as $item) : ?>
                        <li><a href="<?= base_url('page-gereja/' . $item->id) ?>"><?= $item->nama ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li class="dropdown"><a href="#"><i class="bi bi-menu-button navicon"></i> <span>Informasi Gereja</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul id="list-kecamatan-info-gereja">
                    <?php foreach (dataKecamatan() as $item) : ?>
                        <li><a href="<?= base_url('info-gereja/' . $item->id) ?>"><?= $item->nama ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>

        </ul>
    </nav>

</header>