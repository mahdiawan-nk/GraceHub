<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
<style>
    .portfolio-menu {
        text-align: center;
    }

    .portfolio-menu ul li {
        display: inline-block;
        margin: 0;
        list-style: none;
        padding: 10px 15px;
        cursor: pointer;
        -webkit-transition: all 05s ease;
        -moz-transition: all 05s ease;
        -ms-transition: all 05s ease;
        -o-transition: all 05s ease;
        transition: all .5s ease;
    }

    .portfolio-item .item {
        /*width:303px;*/
        float: left;
        margin-bottom: 10px;
    }

    .image-container {
        position: relative;
        display: inline-block;
    }

    .icon-overlay {
        position: absolute;
        bottom: 10px;
        /* Adjust distance from bottom */
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        /* Space between icons */
    }

    .icon {
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent background */
        color: white;
        border-radius: 50%;
        padding: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }

    .icon:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }
</style>
<div class="row" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000">
    <div class="col-sm-12" id="page-create" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" id="page-title">Perbarui Data Gereja</h4>
                <form id="form-create">
                    <img src="<?= $this->config->item('admin_assets') ?>static-file/upload-image.jpg" id="preview-image" class="rounded img-thumbnail shadow-lg mb-2" alt="..." style="width:100%;height:720px;object-fit:cover">
                    <button class="btn btn-info waves-effect waves-light d-block mx-auto" id="upload-image">Upload Gambar</button>
                    <input type="file" id="file-input" name="file" accept="image/*" class="form-control" hidden>
                    <div class="form-group">
                        <label for="nama">Nama Gereja</label>
                        <input type="text" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="Enter Nama Gereja">
                    </div>
                    <div class="form-group">
                        <label for="aliran">Aliran Gereja</label>
                        <input type="text" class="form-control" id="aliran" aria-describedby="emailHelp" placeholder="Enter aliran Gereja">
                    </div>
                    <div class="form-group">
                        <label for="pimpinan">Pimpinan Gereja</label>
                        <input type="text" class="form-control" id="pimpinan" aria-describedby="emailHelp" placeholder="Enter pimpinan Gereja">
                    </div>
                    <div class="form-group">
                        <label for="sejarah">Sejarah Gereja</label>
                        <textarea name="sejarah" id="sejarah" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="visi">Visi Gereja</label>
                        <textarea name="visi" id="visi" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="misi">Misi Gereja</label>
                        <textarea name="misi" id="misi" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi Gereja</label>
                        <input type="text" class="form-control" id="lokasi" aria-describedby="emailHelp" placeholder="Enter lokasi Gereja">
                    </div>
                    <button type="button" class="btn btn-secondary waves-effect waves-light btn-cancel">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-submit">Submit</button>
                </form>

            </div>
        </div>
    </div>
    <div class="col-sm-12" id="page-show">
        <div class="card mb-0">
            <img src="<?= $this->config->item('admin_assets') ?>static-file/bg-gereja.jpg" id="img-gereja" class="card-img img-fluid" alt="..." style="max-height: 65dvh;object-fit:cover">
            <div class="card-img-overlay text-center mx-auto my-auto align-self-center shadow" style="background-color: #f0f8ff91;">
                <h2 class="text-dark fw-bolder title-gereja" style="font-size: 3rem"></h2>
            </div>
        </div>
        <div class="card mt-0">
            <div class="card-body">
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item">
                        <a href="#home" data-toggle="tab" aria-expanded="false" class="nav-link active">
                            <i class="mdi mdi-home-variant d-lg-none d-block"></i>
                            <span class="d-none d-lg-block">Informasi Gereja</span>
                        </a>
                    </li>
                    <li class="nav-item" hidden>
                        <a href="#profile" data-toggle="tab" aria-expanded="true" class="nav-link">
                            <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                            <span class="d-none d-lg-block">Galery Gereja</span>
                        </a>
                    </li>

                </ul>

                <div class="tab-content">
                    <div class="tab-pane show active" id="home">
                        <button class="btn btn-sm btn-primary" id="btn-update">Perbarui Informasi Data Gereja</button>
                        <hr>
                        <ul class="list-group list-group-flush" id="deskripsi-gereja">
                        </ul>
                    </div>
                    <div class="tab-pane" id="profile" hidden>
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#new-kategori-modal">New Kategory Gallery</button>
                        <button class="btn btn-sm btn-warning" id="btn-create-gallery">New Gallery</button>
                        <hr>
                        <div class="portfolio-menu mt-2 mb-4">
                            <ul>
                                <li class="btn btn-outline-dark active" data-filter="*">All</li>
                               
                            </ul>
                        </div>
                        <div class="portfolio-item row">
                                <div class="item appcol-lg-3 col-md-4 col-6 col-sm">
                                    <div class="image-container">
                                        <a href="https://image.freepik.com/free-photo/stylish-young-woman-with-bags-taking-selfie_23-2147962203.jpg" class="fancylight popup-btn" data-fancybox-group="light">
                                            <img class="img-fluid" src="https://image.freepik.com/free-photo/stylish-young-woman-with-bags-taking-selfie_23-2147962203.jpg" alt="">
                                        </a>
                                        <div class="icon-overlay">
                                            <a href="#" class="icon edit-icon" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" class="icon delete-icon" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<div class="modal fade" id="new-kategori-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Data Kategori Gallery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group d-flex flex-row">
                            <label for="inputState" class="col-form-label mr-2">Kategori</label>
                            <input type="text" class="form-control " id="nama-kategori" name="nama-kategori">
                            <button class="btn btn-primary btn-sm ml-1" id="btn-simpan-kategori">Simpan</button>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table mb-0" id="table-kategori">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    const idGerejaUser = '<?= detailUser()->id_gereja ?>';
    const baseUrl = '<?= base_url('api/datagereja'); ?>';
    let DataGereja = {
        foto: null,
        nama: '',
        aliran: '',
        pimpinan: '',
        sejarah: '',
        visi: '',
        misi: '',
        lokasi: '',
    }
    let datakategori = {
        kategori: ''
    }
    const headers = {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    }

    const fetchGerejaById = async () => {
        try {
            const response = await axios.get(baseUrl + '/' + idGerejaUser);
            const data = response.data;
            return data;
        } catch (error) {
            console.log(error);
        }
    }

    const updateDataGereja = async (id) => {
        try {
            const response = await axios.post(baseUrl + '/' + id, DataGereja, headers);
            const data = response.data;
            return data;
        } catch (error) {
            console.log(error);
        }
    }

    const init = async () => {
        const data = await fetchGerejaById();
        const {
            nama,
            aliran,
            pimpinan,
            sejarah,
            visi,
            misi,
            lokasi,
            thumbnail
        } = data.data;
        $('.title-gereja').html(nama)
        $('#img-gereja').attr('src', thumbnail)
        $('#preview-image').attr('src', thumbnail)
        $('#deskripsi-gereja').empty()
        $('#deskripsi-gereja').append(`<li class="list-group-item">
                        <div class="d-flex flex-column bd-highlight">
                            <div class="py-2 font-weight-bold">Nama Gereja</div>
                            <div class="">${nama}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex flex-column bd-highlight">
                            <div class="py-2 font-weight-bold">Aliran Gereja</div>
                            <div class="">${aliran}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex flex-column bd-highlight">
                            <div class="py-2 font-weight-bold">Pimpinan Gereja</div>
                            <div class="">${pimpinan}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex flex-column bd-highlight">
                            <div class="py-2 font-weight-bold">Alamat/Lokasi Gereja</div>
                            <div class="">${lokasi}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex flex-column bd-highlight">
                            <div class="py-2 font-weight-bold">Sejarah Gereja</div>
                            <div class="text-break">${sejarah}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex flex-column bd-highlight">
                            <div class="py-2 font-weight-bold">Visi Gereja</div>
                            <div class="text-break">${visi }</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex flex-column bd-highlight">
                            <div class="py-2 font-weight-bold">Misi Gereja</div>
                            <div class="text-break">${misi}</div>
                        </div>
                    </li>`);

        $('#nama').val(nama)
        $('#aliran').val(aliran)
        $('#pimpinan').val(pimpinan)
        $('#sejarah').summernote('code', sejarah)
        $('#visi').summernote('code', visi)
        $('#misi').summernote('code', misi)
        $('#lokasi').val(lokasi)

    }
    init();

    $(function() {
        new DataTable('#table-kategori')
        $('.portfolio-menu ul li').click(function() {
            $('.portfolio-menu ul li').removeClass('active');
            $(this).addClass('active');

            var selector = $(this).attr('data-filter');
            $('.portfolio-item').isotope({
                filter: selector
            });
            return false;
        });
        var popup_btn = $('.popup-btn');
        popup_btn.magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });

        $('#upload-image').click(function(e) {
            e.preventDefault();
            $('#file-input').trigger('click');
        });
        $('#file-input').change(function(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = new Image();
                    img.onload = function() {
                        var width = img.width;
                        var height = img.height;
                        var aspectRatio = width / height;
                        var minWidth = 854;
                        var minHeight = 480;
                        var maxWidth = 7680;
                        var maxHeight = 4320;

                        if (width < minWidth || height < minHeight) {
                            Swal.fire({
                                icon: "error",
                                title: 'Dimensions are too small.',
                                html: " Minimum width is 426px and minimum height is 240px.",
                            });
                            $('#file-input').val('');
                        } else if (width > maxWidth || height > maxHeight) {
                            Swal.fire({
                                icon: "error",
                                title: 'Dimensions are too large',
                                html: "Dimensions are too large. Maximum width is 7680px and maximum height is 4320px.",
                            });
                            $('#file-input').val('');
                        } else {
                            $('#preview-image').attr('src', e.target.result);
                        }
                    }
                    img.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
        $('#sejarah,#visi,#misi').summernote({
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
        });
        $('#btn-update').on('click', function() {
            $('#page-create').show();
            $('#page-show').hide();
        })
        $('.btn-cancel').click(function(e) {
            e.preventDefault()
            $('#page-create').hide()
            $('#page-show').show()
        })
    

        $('#form-create').submit(async function(e) {
            e.preventDefault();
            DataGereja.foto = $('#file-input')[0].files[0];
            DataGereja.nama = $('#nama').val()
            DataGereja.aliran = $('#aliran').val()
            DataGereja.pimpinan = $('#pimpinan').val()
            DataGereja.sejarah = $('#sejarah').summernote('code')
            DataGereja.visi = $('#visi').summernote('code')
            DataGereja.misi = $('#misi').summernote('code')
            DataGereja.lokasi = $('#lokasi').val()

            try {
                let response = await updateDataGereja(idGerejaUser);

                if (response.status == 'error') {
                    Swal.fire({
                        icon: "error",
                        title: 'Error',
                        html: response.message,
                    });
                    return
                }

                Swal.fire({
                    toast: true,
                    color: '#fff',
                    background: '#28a745',
                    position: "top-end",
                    icon: "success",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });

                $('#page-create').hide();
                $('#page-show').show();
                await init();
            } catch (error) {
                Swal.fire({
                    toast: true,
                    color: '#fff',
                    background: '#dc3545',
                    position: "top-end",
                    icon: "error",
                    title: 'An error occurred',
                    showConfirmButton: false,
                    timer: 1500
                });
                console.error(error);
            }
        });
    });

    function editKategori(id,name){
        $('#nama-kategori').val(name)
    }
</script>