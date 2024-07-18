<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="row" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000">
    <div class="col-sm-12" id="page-create" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" id="page-title">Tambah Data Gereja</h4>
                <form id="form-create">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" aria-describedby="emailHelp" placeholder="Enter nama lengkap">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email ">
                    </div>
                    <div class="form-group">
                        <label for="id_gereja">Admin Gereja</label>
                        <select name="id_gereja" id="id_gereja" class="form-control">
                        </select>
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
                <button class="btn btn-sm btn-primary" id="btn-create">Tambah Pengguna</button>
                <hr>
                <div class="table-responsive">
                    <table class="table mb-0" id="table-data">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Admin Gereja</th>
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
    const baseUrl = '<?= base_url('api/users'); ?>';
    var table;
    var modeForm = 'create';
    var uid = null
    let DataUsers = {
        nama_lengkap: '',
        username: '',
        email: '',
        id_gereja: '',
        role: 2
    }

    const headers = {
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    }
    const fetchListUsers = async () => {
        try {
            const response = await axios.get(baseUrl);
            const datas = response.data.data;
            console.log(datas)
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
                        data: 'nama_lengkap'
                    },
                    {
                        orderable: false,
                        data: 'username'
                    },
                    {
                        orderable: false,
                        data: 'email'
                    },
                    {
                        orderable: false,
                        data: 'role',
                        render: (h) => {
                            return `<span class="badge badge-${h == 1? 'primary':'warning'}">${h == 1 ? 'Administrator' : 'Admin Users'}</span>`
                        }
                    },
                    {
                        orderable: false,
                        data: 'gereja',
                    },
                    {
                        orderable: false,
                        data: 'role',
                        render: (h) => {
                            if (h == 2) {
                                return `<button type="button" class="btn btn-sm btn-outline-secondary waves-effect waves-light btn-edit"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger waves-effect waves-light btn-delete"><i class="fa-solid fa-trash mr-2"></i>Hapus</button>`
                            } else {
                                return ''
                            }

                        }
                    },
                ],
            })
        } catch (error) {
            console.log(error);
        }
    }

    const fetchUsersById = async (id) => {
        try {
            const response = await axios.get(baseUrl + '/' + id);
            const data = response.data;
            return data;
        } catch (error) {
            console.log(error);
        }
    }

    const deleteDataUsers = async (id) => {
        try {
            const response = await axios.delete(baseUrl + '/' + id, headers);
            const data = response.data;
            return data;
        } catch (error) {
            console.log(error);
        }
    }
    const insertDataUsers = async () => {
        try {
            const response = await axios.post(baseUrl, DataUsers, headers);
            const data = response.data;
            return data;
        } catch (error) {
            console.log(error);
        }
    }

    const updateDataUsers = async (id) => {
        try {
            const response = await axios.post(baseUrl + '/' + id, DataUsers, headers);
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
                    allowEscapeKey: false,
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

    fetchListUsers()

    fetchListGereja().then(data => {
        $('#id_gereja').html(data);
    })

    $(function() {

        $('#btn-create').click(function() {
            modeForm = 'create';
            $('#form-create')[0].reset();
            $('#page-title').text('Tambah Data Users')
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
                    const data = await deleteDataUsers(dataTable);
                    if (data.status === 'success') {
                        $('#table-data').DataTable().clear().destroy();
                        await fetchListUsers();
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
                            icon: "error",
                            title: 'Gagal Hapus Data',
                            html: data.message,
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
            fetchUsersById(dataTable).then(data => {
                modeForm = 'update'
                $('#id_gereja').val(data.data.id_gereja)
                $('#nama_lengkap').val(data.data.nama_lengkap)
                $('#username').val(data.data.username)
                $('#email').val(data.data.email)
                $('#page-title').text('Ubah Data Users')
                $('#page-create').show()
                $('#page-list').hide()
            })

        })

        $('#form-create').submit(async function(e) {
            e.preventDefault();
            DataUsers.nama_lengkap = $('#nama_lengkap').val()
            DataUsers.username = $('#username').val()
            DataUsers.email = $('#email').val()
            DataUsers.id_gereja = $('#id_gereja').val()


            try {
                let response;
                if (modeForm === 'create') {
                    response = await insertDataUsers(DataUsers);
                } else if (modeForm === 'update') {
                    response = await updateDataUsers(uid, DataUsers);
                }

                Swal.fire({
                    icon: response.status,
                    title: response.status,
                    html: response.message,
                });

                if (response.status === 'success') {
                    $('#page-create').hide();
                    $('#page-list').show();
                    $('#table-data').DataTable().clear().destroy();
                    await fetchListUsers();
                }

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