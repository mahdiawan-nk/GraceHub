<link href="https://cdn.datatables.net/v/bs5/dt-2.0.8/r-3.0.2/datatables.min.css" rel="stylesheet">
<div class="page-title dark-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Informasi Gereja</h1>
        
    </div>
</div>
<section id="portfolio-details" class="portfolio-details section">
    <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
            <div class="col-lg-6">
                <h3 id="title-gereja">Nama Gereja</h3>
            </div>
            <div class="col-lg-6">
                <nav aria-label="Page navigation example" id="pagination">
                    <ul class="pagination justify-content-end">
                        <li class="page-item me-1" id="prev-page">
                            <button class="page-link" onclick="loadData(currentPage - 1)"><i class="bi bi-caret-left-square-fill"></i></button>
                        </li>
                        <li class="page-item" id="next-page">
                            <a class="page-link" href="#" onclick="loadData(currentPage + 1)"><i class="bi bi-caret-right-square-fill"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

        <div class="card">
            <div class="card-body">
                <table class="table table-hover" id="table-data">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jadwal</th>
                            <th scope="col">Jenis Ibadah</th>
                            <th scope="col">Tata Laksana</th>
                            <th scope="col">No Handpone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</section>
<script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/r-3.0.2/datatables.min.js"></script>
<script>
    const baseUrl = '<?= base_url('') ?>';
    const idKec = '<?= $idkec ?>';
    const headers = {
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    }

    let currentPage = 1;
    const limit = 1;
    const fetchInfoGereja = async (idGereja) => {
        try {
            const response = await axios.get(baseUrl + 'api/infogereja?gereja=' + idGereja);
            const data = response.data.data;
            new DataTable('#table-data', {
                processing: true,
                serverSide: false,
                responsive: false,
                data: data,
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
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

                ],
            })
        } catch (error) {
            console.error('Error fetching data', error);
        }
    }
    const fetchDataGereja = async (page) => {
        if (page < 1) return;

        const offset = (page - 1) * limit;

        try {
            const response = await axios.get(baseUrl + 'api/gereja?kecamatan=' + idKec, {
                params: {
                    limit: limit,
                    offset: offset
                }
            });

            const data = response.data.data;
            const total = response.data.total;
            const totalPages = Math.ceil(total / limit);

            if (total == 0) {
                $('#pagination').hide()
                await fetchInfoGereja(0);
                return;
            }
            if (page > totalPages) return;

            const list = document.getElementById('title-gereja');
            list.innerHTML = '';

            for (const item of data) {
                list.innerHTML += item.nama;
                await fetchInfoGereja(item.id); // Menunggu fetchInfoGereja selesai
            }

            // $('#table-data').DataTable().clear().destroy(); // Menghancurkan dan menginisialisasi kembali DataTable

            currentPage = page;

            let prevBtn = document.getElementById('prev-page');
            let nextBtn = document.getElementById('next-page');

            currentPage === 1 ? prevBtn.classList.add('disabled') : prevBtn.classList.remove('disabled');
            currentPage === totalPages ? nextBtn.classList.add('disabled') : nextBtn.classList.remove('disabled');
        } catch (error) {
            console.error('Error fetching data', error);
        }
    };



    fetchDataGereja(currentPage);

    function loadData(page) {
        $('#table-data').DataTable().clear().destroy();
        fetchDataGereja(page);
    }
</script>