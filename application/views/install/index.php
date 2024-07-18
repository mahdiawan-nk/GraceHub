<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation Wizard Aplikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .wizard-step {
            display: none;
        }

        .wizard-step.active {
            display: block;
        }

        .error {
            color: red;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h3>Form Wizard Instalasi Aplikasi</h3>
                    </div>
                    <div class="card-body">
                        <form id="wizardForm">
                            <div class="wizard-step active" id="step-1">
                                <h4>Step 1 - Setting Aplikasi</h4>
                                <hr>
                                <div class="mb-3 row">
                                    <label for="app_name" class="form-label col-sm-3">Nama Aplikasi</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="app_name" name="app_name" value="GraceHub" required>
                                        <div class="error" id="app_name-error"></div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="author" class="form-label col-sm-3">Author</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="author" name="author" value="Mahdiawan" required>
                                        <div class="error" id="author-error"></div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="deskripsi" class="form-label col-sm-3">Deskripsi</label>
                                    <div class="col-sm-9">
                                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control">GH, GraceHub adalah aplikasi berbasis web sebagai Pusat informasi dan manajemen gereja yang mempermudah pengelolaan kegiatan dan komunikasi antar jemaat.
                                        </textarea>
                                        <div class="error" id="deskripsi-error"></div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary next-step" data-step="1">Submit</button>
                            </div>
                            <!-- Step 1 -->
                            <div class="wizard-step " id="step-2">
                                <h4>Step 2 - Setting Database</h4>
                                <hr>
                                <div class="mb-3 row">
                                    <label for="db-host" class="form-label col-sm-3">DB HOST</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="db-host" name="db_hostname" value="localhost" required>
                                        <div class="error" id="db-host-error"></div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="db-username" class="form-label col-sm-3">DB Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="db-username" name="db_username" value="root" required>
                                        <div class="error" id="db-username-error"></div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="db-password" class="form-label col-sm-3">DB Password</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="db-password" name="db_password">
                                        <div class="error" id="db-password-error"></div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="db-name" class="form-label col-sm-3">DB Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="db-name" name="db_name" value="db-sim-gereja" required>
                                        <div class="error" id="db-name-error"></div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                <button type="button" class="btn btn-primary next-step" data-step="1">Submit</button>
                            </div>

                            <!-- Step 2 -->
                            <div class="wizard-step" id="step-3">
                                <h4>Step 3 - Create Account Administrator</h4>
                                <hr>
                                <div class="mb-3 row">
                                    <label for="nama_lengkap" class="form-label col-sm-3">Nama Lengkap</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                                        <div class="error" id="nama_lengkap-error"></div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="form-label col-sm-3">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="email" name="email" required>
                                        <div class="error" id="email-error"></div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="username" class="form-label col-sm-3">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="username" name="username" required>
                                        <div class="error" id="username-error"></div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="password" class="form-label col-sm-3">Password</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="password" name="password" required>
                                        <div class="error" id="password-error"></div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            var currentStep = 1;
            var totalSteps = $(".wizard-step").length;

            $(".next-step").click(function() {
                var isValid = validateStep(currentStep);
                if (isValid) {
                    var formData = getFormData(currentStep);
                    $.ajax({
                        url: '<?= base_url('installs/process_installation/') ?>' + currentStep,
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.status == "error") {
                                Swal.fire({
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    stopKeydownPropagation: false,
                                    icon: "error",
                                    title: "Oops...",
                                    text: response.message,
                                });
                                return
                            }
                            Swal.fire({
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                stopKeydownPropagation: false,
                                icon: "success",
                                title: "Berhasil",
                                text: response.message,
                                confirmButtonText: "Next",
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    if (currentStep < totalSteps) {
                                        $("#step-" + currentStep).removeClass("active");
                                        currentStep++;
                                        $("#step-" + currentStep).addClass("active");
                                    }
                                }
                            })

                        },
                        error: function(a, b, c) {
                            console.log(a)
                        }
                    });
                }
            });

            $(".prev-step").click(function() {
                if (currentStep > 1) {
                    $("#step-" + currentStep).removeClass("active");
                    currentStep--;
                    $("#step-" + currentStep).addClass("active");
                }
            });

            $("#wizardForm").submit(function(e) {
                e.preventDefault();
                var formData = getFormData(currentStep);
                $.ajax({
                    url: '<?= base_url('installs/process_installation/') ?>' + currentStep,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        let timerInterval;
                        Swal.fire({
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            stopKeydownPropagation: false,
                            title: "Configuration In Progress!",
                            html: "I will close in <b></b> milliseconds.",
                            timer: 10000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                                const timer = Swal.getPopup().querySelector("b");
                                timerInterval = setInterval(() => {
                                    timer.textContent = `${Swal.getTimerLeft()}`;
                                }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                Swal.fire({
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    stopKeydownPropagation: false,
                                    title: "success",
                                    text: "Configuration completed successfully!",
                                    icon: "success"
                                }).then((result) => {
                                    /* Read more about isConfirmed, isDenied below */
                                    if (result.isConfirmed) {
                                        window.location.reload()
                                    }
                                })
                            }
                        });
                    },
                    error: function(a, b, c) {
                        console.log(a)
                    }
                });
                // Process final form submission here
            });

            function validateStep(step) {
                var isValid = true;
                $("#step-" + step + " .form-control").each(function() {
                    var input = $(this);
                    if (input.attr('name') === 'db_password') {
                        return true; // Lanjutkan ke input berikutnya
                    }
                    if (input.val() === "") {
                        isValid = false;
                        input.next(".error").text("This field is required.");
                    } else {
                        input.next(".error").text("");
                    }
                });
                return isValid;
            }

            function getFormData(step) {
                var formData = {};
                $("#step-" + step + " .form-control").each(function() {
                    var input = $(this);
                    formData[input.attr("name")] = input.val();
                });
                return formData;
            }
        });
    </script>
</body>

</html>