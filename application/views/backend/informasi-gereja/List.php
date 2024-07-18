<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="row" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000">
    <div class="col-sm-12" id="page-create" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" id="page-title">Tambah Data Gereja</h4>
                <form id="form-create">
                    <div class="form-group">
                        <label for="nama">Gereja</label>
                        <select name="id_gereja" id="id_gereja" class="form-control">

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jadwal">Jadwal</label>
                        <input type="date" class="form-control" id="jadwal" aria-describedby="emailHelp" placeholder="Enter jadwal Gereja">
                    </div>
                    <div class="form-group">
                        <label for="jenis_ibadah">Jenis Ibadah</label>
                        <input type="text" class="form-control" id="jenis_ibadah" aria-describedby="emailHelp" placeholder="Enter jenis_ibadah Gereja">
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telpon</label>
                        <input type="text" class="form-control" id="no_telp" aria-describedby="emailHelp" placeholder="Enter no_telp Gereja">
                    </div>
                    <div class="form-group">
                        <label for="tata_laksana">Tata Laksana</label>
                        <textarea name="tata_laksana" id="tata_laksana" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
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
                <button class="btn btn-sm btn-primary" id="btn-create">Tambah Informasi Gereja</button>
                <hr>
                <div class="table-responsive">
                    <table class="table mb-0" id="table-data">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Gereja</th>
                                <th>Jadwal</th>
                                <th>Jenis Ibadah</th>
                                <th>Tata Laksana Ibadah</th>
                                <th>No Telepon</th>
                                <th>Keterangan</th>
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
    const baseUrl = '<?= base_url('api/infogereja'); ?>';
    const idGerejaUser = '<?= detailUser()->id_gereja ?>'
    var table;
    var modeForm = 'create';
    var uid = null
    let DataInfoGereja = {
        id_gereja: '',
        jadwal: '',
        jenis_ibadah: '',
        tata_laksana: '',
        keterangan: '',
        no_telp: '',
    }

    const headers = {
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    }
    const fetchListInfoGereja = async () => {
        try {
            const response = await axios.get(baseUrl);
            const datas = response.data.data;
            table = new DataTable('#table-data', {
                processing: true,
                serverSide: false,
                responsive: false,
                data: datas,
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        orderable: false,
                        data: 'gereja'
                    },
                    {
                        orderable: false,
                        data: 'jadwal'
                    },
                    {
                        orderable: false,
                        data: 'jenis_ibadah'
                    },
                    {
                        orderable: false,
                        data: 'tata_laksana'
                    },

                    {
                        orderable: false,
                        data: 'no_telp',
                    },
                    {
                        orderable: false,
                        data: 'keterangan',

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

    const fetchInfoGerejaById = async (id) => {
        try {
            const response = await axios.get(baseUrl + '/' + id);
            const data = response.data;
            return data;
        } catch (error) {
            console.log(error);
        }
    }

    const deleteDataInfoGereja = async (id) => {
        try {
            const response = await axios.delete(baseUrl + '/' + id, headers);
            const data = response.data;
            return data;
        } catch (error) {
            console.log(error);
        }
    }
    const insertDataInfoGereja = async () => {
        try {
            const response = await axios.post(baseUrl, DataInfoGereja, headers);
            const data = response.data;
            return data;
        } catch (error) {
            console.log(error);
        }
    }

    const updateDataInfoGereja = async (id) => {
        try {
            const response = await axios.post(baseUrl + '/' + id, DataInfoGereja, headers);
            const data = response.data;
            return data;
        } catch (error) {
            console.log(error);
        }
    }

    const fetchListGereja = async () => {
        try {
            const response = await axios.get('<?= base_url('api/datagereja'); ?>');
            const data = response.data;
            if (data.data.length == 0) {
                Swal.fire({
                    allowOutsideClick: false,
                    allowEscapeKey  : false,
                    stopKeydownPropagation: false,
                    icon: "error",
                    title: "Oops...",
                    text: "Data Gereja Masih Kosong, silahkan isi terlebih dahulu!",
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.href = '<?= base_url('admins/data-gereja'); ?>';
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });
                return
            }
            const listGereja = '<option value="">Pilih Gereja</option>' + response.data.data.map(element => {
                return '<option value="' + element.id + '">' + element.nama + '</option>';
            }).join('');

            return listGereja;
        } catch (error) {
            console.log(error);
        }
    }

    fetchListInfoGereja()

    fetchListGereja().then(data => {
        $('#id_gereja').html(data);
    })

    $(function() {
        $('#tata_laksan,#keterangan').summernote({
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
            if (idGerejaUser != '') {
                DataInfoGereja.id_gereja = idGerejaUser
                $('#id_gereja').val(idGerejaUser).attr('disabled', 'disabled');
            }
            $('#tata_laksana').summernote('code', '')
            $('#keterangan').summernote('code', '')
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
                    const data = await deleteDataInfoGereja(dataTable);
                    if (data.status === 'success') {
                        $('#table-data').DataTable().clear().destroy();
                        await fetchListInfoGereja();
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
            fetchInfoGerejaById(dataTable).then(data => {
                modeForm = 'update'
                if (idGerejaUser != '') {
                    DataInfoGereja.id_gereja = idGerejaUser
                    $('#id_gereja').val(idGerejaUser).attr('disabled', 'disabled');
                } else {
                    $('#id_gereja').val(data.data.id_gereja)
                }

                $('#jadwal').val(data.data.jadwal)
                $('#jenis_ibadah').val(data.data.jenis_ibadah)
                $('#tata_laksana').summernote('code', data.data.tata_laksana)
                $('#keterangan').summernote('code', data.data.keterangan)
                $('#no_telpon').val(data.data.no_telp)
                $('#page-title').text('Ubah Informasi Gereja')
                $('#page-create').show()
                $('#page-list').hide()
            })

        })

        $('#form-create').submit(async function(e) {
            e.preventDefault();

            DataInfoGereja.id_gereja = DataInfoGereja.id_gereja ? DataInfoGereja.id_gereja : $('#id_gereja').val()
            DataInfoGereja.jadwal = $('#jadwal').val()
            DataInfoGereja.jenis_ibadah = $('#jenis_ibadah').val()
            DataInfoGereja.tata_laksana = $('#tata_laksana').val()
            DataInfoGereja.keterangan = $('#keterangan').val()
            DataInfoGereja.no_telp = $('#no_telp').val()

            try {
                let response;
                if (modeForm === 'create') {
                    response = await insertDataInfoGereja();
                } else if (modeForm === 'update') {
                    response = await updateDataInfoGereja(uid);
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
                await fetchListInfoGereja();
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