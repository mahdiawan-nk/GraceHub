<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>SIREJA- <?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="<?= $this->config->item('admin_assets') ?>vertical/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $this->config->item('admin_assets') ?>vertical/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?= $this->config->item('admin_assets') ?>vertical/css/theme.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/v/bs4/dt-2.1.0/r-3.0.2/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="<?= $this->config->item('admin_assets') ?>vertical/js/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-2.1.0/r-3.0.2/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        .text-dashboard {
            font-size: 3rem;
        }

        @media only screen and (max-width: 600px) {
            .text-dashboard {
                font-size: 1rem;
            }
        }

        .card:before {

            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background-color: #80a0cf;
            transform: scaleY(1);
            transition: all 0.5s;
            transform-origin: bottom
        }

        .card:after {

            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background-color: #3281f2;
            transform: scaleY(0);
            transition: all 0.5s;
            transform-origin: bottom
        }

        .card:hover::after {
            transform: scaleY(1);
        }


        .fonts {
            font-size: 11px;
        }
    </style>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php $this->load->view('layouts/backend/header') ?>


        <!-- ========== Left Sidebar Start ========== -->
        <?php $this->load->view('layouts/backend/sidebar') ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18"><?= $title ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                        <li class="breadcrumb-item active">Starter</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <?php $this->load->view($pages) ?>
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <?php $this->load->view('layouts/backend/footer') ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Overlay-->
    <div class="menu-overlay"></div>


    <!-- jQuery  -->

    <script src="<?= $this->config->item('admin_assets') ?>vertical/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $this->config->item('admin_assets') ?>vertical/js/metismenu.min.js"></script>
    <script src="<?= $this->config->item('admin_assets') ?>vertical/js/waves.js"></script>
    <script src="<?= $this->config->item('admin_assets') ?>vertical/js/simplebar.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- App js -->
    <script src="<?= $this->config->item('admin_assets') ?>vertical/js/theme.js"></script>

    <script>
        AOS.init();
        var uid = null
        const urlLogout = '<?= base_url('api/logout') ?>';
        const fetchLougout = async () => {
            try {
                const response = await axios.get(urlLogout);
                const datas = response.data;
                if (datas.status) {
                    window.location.href = '<?= base_url('/admins') ?>';
                }
            } catch (error) {
                console.log(error);
            }
        }

        const fetchMe = async () => {
            try {
                const response = await axios.get('<?= base_url('api/me') ?>');
                const datas = response.data;
                if (datas.status) {
                    const {
                        id,
                        username,
                        nama_lengkap,
                        email,
                        role
                    } = datas.data;
                    const data = datas.data;

                    document.getElementById('page-header-user-name').innerHTML = nama_lengkap;
                    document.getElementById('page-header-user-role').innerHTML = role == '2' ? 'Admin Gereja' : 'Administrator';
                    document.getElementById('modal-profile-user-name').innerHTML = nama_lengkap;
                    document.getElementById('modal-profile-user-role').innerHTML = role == '2' ? 'Admin Gereja' : 'Administrator';
                    document.getElementById('modal-profile-user-email').innerHTML = email;
                    document.getElementById('update-user-email').value = email;
                    document.getElementById('update-user-name').value = username;
                    document.getElementById('update-nama-lengkap').value = nama_lengkap;
                    document.getElementById('password-email').value = email;

                    uid = id

                }
            } catch (error) {
                console.log(error);
            }
        }

        fetchMe();

        function logout() {
            Swal.fire({
                title: 'Logout',
                text: 'Apakah anda yakin ingin keluar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetchLougout();
                }
            })
        }

        const fetchUpdateProfile = async (id, dataProfile) => {
            try {
                const response = await axios.post('<?= base_url('api/users/') ?>' + id, dataProfile, {
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                });
                const datas = response.data;
                return datas
            } catch (error) {
                console.log(error);
            }
        }

        const fetchUpdatePassword = async (id, dataPassword) => {
            try {
                const response = await axios.post('<?= base_url('api/users/password/') ?>' + id, dataPassword, {
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                });
                const datas = response.data;
                return datas
            } catch (error) {
                console.log(error);
            }
        }
        $(function() {

        });
        var elmtModalProfile = $('#modalProfile');
        var elmtModalPassword = $('#updatePassword');
        var elmtModalUpdateProfile = $('#updateProfile');
        const btnUpdateProfile = document.getElementById('btn-update-profile');
        const btnUpdatePassword = document.getElementById('btn-update-password');

        btnUpdateProfile.addEventListener('click', async (e) => {
            e.preventDefault();
            const email = document.getElementById('update-user-email').value;
            const name = document.getElementById('update-user-name').value;
            const nama_lurator = document.getElementById('update-nama-lengkap').value;
            const dataProfile = {
                email: email,
                username: name,
                nama_lengkap: nama_lurator
            }
            const datas = await fetchUpdateProfile(uid, dataProfile);
            console.log(datas)
            if (datas.status) {
                Swal.fire({
                    title: "Berhasil",
                    text: datas.message,
                    icon: "success",
                    toast: true,
                    timer: 3500,
                    position: 'top-end',
                    showConfirmButton: false
                });
                elmtModalUpdateProfile.modal('hide');
                elmtModalProfile.modal('show');
                fetchMe();
            } else {
                Swal.fire('Data Tidak Berubah', 'Data Tidak Berubah', 'error');
            }

        });

        btnUpdatePassword.addEventListener('click', async (e) => {
            e.preventDefault();
            const password = document.getElementById('new-password').value;

            const dataPassword = {
                password: password,
            }
            const datas = await fetchUpdatePassword(uid, dataPassword);
            if (datas.status) {
                Swal.fire({
                    title: "Berhasil",
                    text: datas.message,
                    icon: "success",
                    toast: true,
                    timer: 3500,
                    position: 'top-end',
                    showConfirmButton: false
                });
                elmtModalPassword.modal('hide');
                elmtModalProfile.modal('show');
                fetchMe();
            } else {
                Swal.fire('Data Tidak Berubah', 'Data Tidak Berubah', 'error');
            }

        });
    </script>


</body>

</html>