<div class="page-title dark-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Data Gereja</h1>
        
    </div>
</div>
<section id="portfolio-details" class="portfolio-details section">
    <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
            <div class="col-lg-6">
                <!-- <div class="input-group">
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" value="">
                    <span class="input-group-text" id="inputGroup-sizing-lg"><i class="bi bi-search"></i></span>

                </div> -->
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

        <div class="row gy-4" id="gereja-list">

        </div>

    </div>

</section>

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

            const list = document.getElementById('gereja-list');
            list.innerHTML = '';
            if (total == 0) {
                $('#pagination').hide()
                list.innerHTML = `<div class="col-sm-12">
				<div class="alert alert-primary" role="alert">
					Data Tidak Ditemukan Atau Data kosong
					</div>
				</div>`;
                return;
            }
            if (page > totalPages) return;

            $('#pagination').show()

            data.forEach(item => {
                list.innerHTML += templatePage(item);
            });

            currentPage = page;

            let prevBtn = document.getElementById('prev-page')
            let nextBtn = document.getElementById('next-page')
            currentPage == 1 ? prevBtn.classList.add('disabled') : prevBtn.classList.remove('disabled')
            currentPage == totalPages ? nextBtn.classList.add('disabled') : nextBtn.classList.remove('disabled')
        } catch (error) {
            console.error('Error fetching data', error);
        }


    }

    function templatePage(data) {
        return `
        <div class="col-lg-6">
                <img src="<?= base_url('') ?>assets/admin/static-file/bg-gereja.jpg" alt="" class="w-100">
            </div>
            <div class="col-lg-6">
                <div class="portfolio-info aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                    <h3>${data.nama}</h3>
                    <ul>
                        <li><strong>Aliran Gereja</strong>: ${data.aliran}</li>
                        <li><strong>Pimpinan</strong>: ${data.pimpinan}</li>
                        <li><strong>Lokasi</strong>: ${data.lokasi}</li>
                        <li><strong>Jumlah Jemaat</strong>: ${data.jumlah_jemaat}</li>
                    </ul>
                </div>
                <div class="portfolio-description aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                    <h2>Sejarah</h2>
                    <p>
                        ${data.sejarah}
                    </p>
                </div>
                <div class="portfolio-description aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                    <h2>Visi</h2>
                    <p>
                       ${data.visi}
                    </p>
                </div>
                <div class="portfolio-description aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                    <h2>Misi</h2>
                    <p>
                        ${data.misi}
                    </p>
                </div>
            </div>
        `
    }

    fetchDataGereja(currentPage);

    function loadData(page) {
        fetchDataGereja(page);
    }
</script>