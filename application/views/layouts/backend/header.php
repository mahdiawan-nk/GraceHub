<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$this->config->load('app_config');
?>
<header id="page-topbar">
    <div class="navbar-header">
        <!-- LOGO -->
        <div class="navbar-brand-box d-flex align-items-left">
            <a href="index.html" class="logo">
                <span>
                    <img src="<?= $this->config->item('admin_assets') ?>static-file/logo.jpg" alt="" height="32" class="rounded-circle">
                    <label for="" class="font-weight-bold text-white" style="font-size: 1rem;"> <?= $this->config->item('app_name') ?></label>
                </span>
                <i>
                    <img src="<?= $this->config->item('admin_assets') ?>static-file/logo.jpg" alt="" height="24" class="rounded-circle">
                </i>
            </a>

            <button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect waves-light" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex align-items-center">
            <div class="dropdown d-inline-block ml-2">
                <button type="button" class="btn header-item waves-effect waves-light" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?= $this->config->item('admin_assets') ?>static-file/logo.jpg" alt="Header Avatar">
                    <span class="d-sm-inline-block ml-1" id="page-header-user-name"></span>
                    (<span class="d-sm-inline-block ml-1" id="page-header-user-role"></span>)
                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)" data-toggle="modal" data-target="#modalProfile">
                        <span>Profile</span>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)" onclick="logout()">
                        <span>Log Out</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</header>

<div class="modal fade" id="modalProfile" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card mb-0 py-4">
                    <div class="text-center">
                        <img src="<?= $this->config->item('admin_assets') ?>static-file/logo.jpg" width="100" class="rounded-circle">
                    </div>
                    <div class="text-center mt-3">
                        <span class="bg-secondary p-1 px-4 rounded text-white" id="modal-profile-user-role"></span>
                        <h5 class="mt-2 mb-0" id="modal-profile-user-name"></h5>
                        <span id="modal-profile-user-email"></span>
                        <div class="px-4 mt-1">

                        </div>
                        <div class="buttons">
                            <button type="button" class="btn btn-outline-primary waves-effect waves-light" data-toggle="modal" data-target="#updateProfile" data-dismiss="modal">Update Profile</button>
                            <button type="button" class="btn btn-outline-primary waves-effect waves-light" data-toggle="modal" data-target="#updatePassword" data-dismiss="modal">Update Password</button>
                            <button type="button" class="btn btn-outline-primary waves-effect waves-light" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateProfile" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card mb-0 py-4 px-4">
                    <form class="form-horizontal" id="update-profile-form">
                        <div class="form-group row mb-3">
                            <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="update-nama-lengkap" v>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="update-user-name" >
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="update-user-email" >
                            </div>
                        </div>
                        <div class="form-group mb-0 justify-content-end row">
                            <div class="col-9">
                                <button type="button" class="btn btn-outline-primary waves-effect waves-light" data-toggle="modal" data-target="#modalProfile" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-info waves-effect waves-light" id="btn-update-profile">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updatePassword" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card mb-0 py-4 px-4">
                    <form class="form-horizontal">
                        <div class="form-group row mb-3">
                            <label for="password-email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="password-email" value="" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="new-password" class="col-sm-3 col-form-label">New Password</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="new-password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group mb-0 justify-content-end row">
                            <div class="col-9">
                                <button type="button" class="btn btn-outline-primary waves-effect waves-light" data-toggle="modal" data-target="#modalProfile" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-info waves-effect waves-light" id="btn-update-password">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>