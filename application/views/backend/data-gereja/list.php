<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    table.dataTable tbody td {
        vertical-align: middle;
    }
</style>
<div class="row" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000">
    <div class="col-sm-12" id="page-create" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" id="page-title">Tambah Data Gereja</h4>
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
                    <div class="form-group">
                        <label for="lokasi">Jumlah Jemaat</label>
                        <input type="text" class="form-control" id="jumlah-jemaat" aria-describedby="emailHelp" placeholder="Enter Jumlah Jemaat">
                    </div>
                    <div class="form-group">
                        <label for="id_kecamatan">Kecamatan</label>
                        <select name="id_kecamatan" id="id_kecamatan" class="form-control"></select>
                    </div>
                    <button class="btn btn-secondary waves-effect waves-light btn-cancel">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-submit">Submit</button>
                </form>

            </div>
        </div>
    </div>
    <div class="col-xl-12" id="page-list">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-sm btn-primary" id="btn-create"><i class="fa-solid fa-plus mr-2"></i>Tambah Data Gereja</button>
                <hr>
                <div class="table-responsive">
                    <table class="table mb-0" id="table-data">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama Gereja</th>
                                <th>Aliran Gereja</th>
                                <th>Pimpinan Gereja</th>
                                <th>Sejarah Gereja</th>
                                <th>Visi Misi</th>
                                <th>Lokasi</th>
                                <th>Kecamatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>
            <!-- end card-body-->
        </div>
        <!-- end card -->

    </div>
    <!-- end col -->
</div>

<script>
    const baseUrl = '<?= base_url('api/datagereja'); ?>';
    var table;
    var modeForm = 'create';
    var uid = null
    let DataGereja = {
        foto: null,
        nama: '',
        aliran: '',
        pimpinan: '',
        sejarah: '',
        visi: '',
        misi: '',
        lokasi: '',
        jumlah_jemaat: '',
        id_kecamatan: '',
    }

    const headers = {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    }
    const fetchListGereja = async () => {
        try {
            const response = await axios.get(baseUrl);
            const datas = response.data.data;
            table = new DataTable('#table-data', {
                processing: true,
                serverSide: false,
                responsive: true,
                data: datas,
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        orderable: false,
                        data: 'thumbnail',
                        render: (h) => {
                            return `<img src="${h}" width="75" height="50">`;
                        }
                    },
                    {
                        orderable: false,
                        data: 'nama'
                    },
                    {
                        orderable: false,
                        data: 'aliran'
                    },
                    {
                        orderable: false,
                        data: 'pimpinan'
                    },
                    {
                        orderable: false,
                        data: 'sejarah',
                        render: (h) => {
                            return truncateText(h, 50)
                        }
                    },
                    {
                        orderable: false,
                        data: {
                            visi: "visi",
                            misi: "misi"
                        },
                        render: (h) => {
                            return truncateText(h.visi, 50) +'<br>'+ truncateText(h.misi, 50)
                        }
                    },
                    {
                        orderable: false,
                        data: 'lokasi',
                    },
                    {
                        orderable: false,
                        data: 'kecamatan',

                    },
                    {
                        orderable: false,
                        data: 'id',
                        render: (h) => {
                            return `<button type="button" class="btn btn-sm btn-outline-secondary waves-effect waves-light btn-edit"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit</button>
                                <button type="button" class="btn btn-sm btn-outline-danger waves-effect waves-light btn-delete"><i class="fa-solid fa-trash mr-2"></i>Hapus</button>`
                        }
                    },
                ],
            })
        } catch (error) {
            console.log(error);
        }
    }

    const fetchGerejaById = async (id) => {
        try {
            const response = await axios.get(baseUrl + '/' + id);
            const data = response.data;
            return data;
        } catch (error) {
            console.log(error);
        }
    }

    const deleteDataGereja = async (id) => {
        try {
            const response = await axios.delete(baseUrl + '/' + id, headers);
            const data = response.data;
            return data;
        } catch (error) {
            console.log(error);
        }
    }
    const insertDataGereja = async () => {
        try {
            const response = await axios.post(baseUrl, DataGereja, headers);
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

    const fetchListKecamatan = async () => {
        try {
            const response = await axios.get('<?= base_url('api/kecamatan'); ?>');
            const data = response.data;
            const listKecamatan = '<option value="">Pilih Kecamatan</option>' + response.data.data.map(element => {
                return '<option value="' + element.id + '">' + element.nama + '</option>';
            }).join('');

            return listKecamatan;
        } catch (error) {
            console.log(error);
        }
    }

    fetchListGereja()

    fetchListKecamatan().then(data => {
        $('#id_kecamatan').html(data);
    })

    function truncateText(str, maxLength) {
        if (str.length > maxLength) {
            return str.substring(0, maxLength) + '...';
        }
        return str;
    }
    $(function() {
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

        $('#btn-create').click(function() {
            modeForm = 'create';
            $('#form-create')[0].reset();
            $('#sejarah').summernote('code', '')
            $('#visi').summernote('code', '')
            $('#misi').summernote('code', '')
            $('#page-title').text('Tambah Data Gereja')
            $('#page-create').show()
            $('#page-list').hide()
        })

        $('.btn-cancel').click(function(e) {
            e.preventDefault()
            $('#page-create').hide()
            $('#page-list').show()
        })

        $('#table-data').on('click', '.btn-delete', async function(e) {
            e.preventDefault();
            let dataTable = table.row($(this).parents('tr')).data().id;

            const result = await Swal.fire({
                title: 'Are you sure?',
                text: "Data Tidak Dapat Dipulihkan Kembali!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            });

            if (result.isConfirmed) {
                try {
                    const data = await deleteDataGereja(dataTable);
                    if (data.status === 'success') {
                        $('#table-data').DataTable().clear().destroy();
                        await fetchListGereja();
                        Swal.fire({
                            toast: true,
                            color: '#fff',
                            background: '#28a745',
                            position: "top-end",
                            icon: "success",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            toast: true,
                            color: '#fff',
                            background: '#28a745',
                            position: "top-end",
                            icon: "error",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                } catch (error) {
                    console.error(error);

                }
            }
        });

        $('#table-data').on('click', '.btn-edit', function(e) {
            let dataTable = table.row($(this).parents('tr')).data().id
            uid = dataTable
            fetchGerejaById(dataTable).then(data => {
                modeForm = 'update'
                $('#id').val(data.data.id)
                $('#preview-image').attr('src', data.data.thumbnail)
                $('#nama').val(data.data.nama)
                $('#aliran').val(data.data.aliran)
                $('#pimpinan').val(data.data.pimpinan)
                $('#sejarah').summernote('code', data.data.sejarah)
                $('#visi').summernote('code', data.data.visi)
                $('#misi').summernote('code', data.data.misi)
                $('#lokasi').val(data.data.lokasi)
                $('#id_kecamatan').val(data.data.id_kecamatan)
                $('#jumlah-jemaat').val(data.data.jumlah_jemaat)
                $('#page-title').text('Ubah Data Gereja')
                $('#page-create').show()
                $('#page-list').hide()
            })

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
            DataGereja.jumlah_jemaat = $('#jumlah-jemaat').val()
            DataGereja.id_kecamatan = $('#id_kecamatan').val()

            try {
                let response;
                if (modeForm === 'create') {
                    if (!DataGereja.foto) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: 'Please select a photo before submitting.',
                            confirmButtonColor: '#28a745'
                        });
                        return;
                    }
                    response = await insertDataGereja(DataGereja);
                } else if (modeForm === 'update') {

                    response = await updateDataGereja(uid, DataGereja);
                }
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
                $('#page-list').show();
                $('#table-data').DataTable().clear().destroy();
                await fetchListGereja();
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
</script>