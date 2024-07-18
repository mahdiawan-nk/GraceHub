<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Lurid - Material Design Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= $this->config->item('admin_assets') ?>images/favicon.ico">

    <!-- App css -->
    <link href="<?= $this->config->item('admin_assets') ?>vertical/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $this->config->item('admin_assets') ?>vertical/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $this->config->item('admin_assets') ?>vertical/css/theme.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center align-items-center min-vh-100">
                        <div class="d-block bg-white shadow-lg rounded my-5">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <a href="index.html" class="d-block mb-5">
                                                <h3 class="fw-bolder">Sistem Informasi Gereja</h3>
                                            </a>
                                        </div>
                                        <h1 class="h5 mb-1">Welcome Back!</h1>
                                        <p class="text-muted mb-4">Enter your Username and password to access admin panel.</p>
                                        <form class="user" id="form-login" method="POST">
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control form-control-user" id="username" placeholder="Username">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password">
                                            </div>
                                            <button type="submit" class="btn btn-success btn-block waves-effect waves-light"> Log In </button>
                                        </form>
                                        <!-- end row -->
                                    </div> <!-- end .padding-5 -->
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div> <!-- end .w-100 -->
                    </div> <!-- end .d-flex -->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- jQuery  -->
    <script src="<?= $this->config->item('admin_assets') ?>vertical/js/jquery.min.js"></script>
    <script src="<?= $this->config->item('admin_assets') ?>vertical/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $this->config->item('admin_assets') ?>vertical/js/waves.js"></script>
    <script src="<?= $this->config->item('admin_assets') ?>vertical/js/simplebar.min.js"></script>
    <script src="<?= $this->config->item('admin_assets') ?>vertical/js/metismenu.min.js"></script>

    <!-- App js -->
    <script src="<?= $this->config->item('admin_assets') ?>vertical/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        const base_url = '<?= base_url() ?>';
        const urlLogin = 'api/login';
        let DataUser = {
            username: '',
            password: ''
        };
        const headers = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }

        const fetchLogin = async (data) => {
            try {
                const response = await axios.post(urlLogin, DataUser, headers)
                return response.data
            } catch (error) {
                console.log(error);
            }
        }

        $(document).ready(function() {
            $('#form-login').submit(async function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                DataUser.username = $('#username').val();
                DataUser.password = $('#password').val();

                const response = await fetchLogin(DataUser);

                if (response.code == 200) {
                    window.location.href = base_url + 'admins/dashboard';
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: response.message || 'An error occurred. Please try again.',
                    });
                }

            })
        })
    </script>

</body>

</html>