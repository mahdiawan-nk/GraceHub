<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="<?=base_url('admins/dashboard')?>" class="waves-effect"><i class="mdi mdi-view-dashboard"></i><span>Dashboard</span></a>
                </li>

                <li>
                    <a href="<?=base_url('admins/data-gereja')?>" class="waves-effect"><i class="mdi mdi-office-building"></i><span>Data Gereja</span></a>
                </li>
                <li>
                    <a href="<?=base_url('admins/informasi-gereja')?>" class="waves-effect"><i class="mdi mdi-information"></i><span>Informasi Gereja</span></a>
                </li>
                <?php if(detailUser()->role == 1):?>
                <li>
                    <a href="<?=base_url('admins/pengguna')?>" class="waves-effect"><i class="mdi mdi-account-multiple-outline"></i><span>Manajemen Akun</span></a>
                </li>
                <?php endif?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>