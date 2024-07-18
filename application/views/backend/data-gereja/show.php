<div class="row" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000">
    <div class="col-sm-12" id="page-create" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" id="page-title">Perbarui Data Gereja</h4>
                <form id="form-create">
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
                    <button class="btn btn-secondary waves-effect waves-light btn-cancel">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-submit">Submit</button>
                </form>

            </div>
        </div>
    </div>
    <div class="col-sm-12" id="page-show">
        <div class="card mb-0">
            <img src="<?= $this->config->item('admin_assets') ?>static-file/bg-gereja.jpg" class="card-img img-fluid" alt="..." style="max-height: 65dvh">
            <div class="card-img-overlay text-center mx-auto my-auto align-self-center shadow" style="background-color: #f0f8ff91;">
                <h2 class="text-dark fw-bolder title-gereja" style="font-size: 3rem"></h2>
            </div>
        </div>
        <div class="card mt-0">
            <div class="card-body">
                <button class="btn btn-sm btn-primary" id="btn-update">Perbarui Informasi Data Gereja</button>
                <hr>
                <ul class="list-group list-group-flush" id="deskripsi-gereja">
                </ul>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>

<script>
    const idGerejaUser = '<?= detailUser()->id_gereja ?>';
    const baseUrl = '<?= base_url('api/datagereja'); ?>';
    let DataGereja = {
        nama: '',
        aliran: '',
        pimpinan: '',
        sejarah: '',
        visi: '',
        misi: '',
        lokasi: '',
    }
    const headers = {
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
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
            lokasi
        } = data.data;
        $('.title-gereja').html(nama)
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
                            <div class="">${sejarah}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex flex-column bd-highlight">
                            <div class="py-2 font-weight-bold">Visi Gereja</div>
                            <div class="">${visi }</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex flex-column bd-highlight">
                            <div class="py-2 font-weight-bold">Misi Gereja</div>
                            <div class="">${misi}</div>
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

        $('#form-create').submit(async function(e) {
            e.preventDefault();
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
</script>