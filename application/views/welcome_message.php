
<section id="hero" class="about section">

	<div class="container" data-aos="fade-up" data-aos-delay="100">
		<div class="row">
			<?php foreach ($kecamatan as $item) : ?>
				<div class="col-md-4 col-sm-6 ">
					<div class="counter">
						<span class="counter-value"><?= $item->total_gereja ?></span>
						<h3>Kec. <?= $item->nama ?></h3>
					</div>
				</div>
			<?php endforeach; ?>
			<div class="col-md-4 col-sm-6">
				<div class="counter green">
					<span class="counter-value"><?= $jemaat ?></span>
					<h3>Total Jemaat</h3>
				</div>
			</div>
		</div>
	</div>

	<div class="container mt-5" data-aos="fade-up" data-aos-delay="100">
		<div class="card shadow-sm">
			<div class="card-body">
				<nav aria-label="Page navigation example" id="pagination">
					<ul class="pagination justify-content-end">
						<li class="page-item me-1">
							<a class="page-link" href="#" onclick="loadData(currentPage - 1)"><i class="bi bi-caret-left-square-fill"></i></a>
						</li>
						<li class="page-item">
							<a class="page-link" href="#" onclick="loadData(currentPage + 1)"><i class="bi bi-caret-right-square-fill"></i></a>
						</li>
					</ul>
				</nav>
				<div class="row" id="gereja-list">

				</div>
			</div>
		</div>

	</div>

</section>

<script>
	const baseUrl = '<?= base_url('') ?>';
	const headers = {
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded'
		}
	}

	let currentPage = 1;
	const limit = 4;
	const fetchDataGereja = async (page) => {
		if (page < 1) return;
		const offset = (page - 1) * limit;

		try {
			const response = await axios.get(baseUrl + 'api/gereja', {
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



			data.forEach(item => {
				list.innerHTML += `
					<div class="col-sm-6">
					<div class="card mb-3">
						<div class="row g-0">
							<div class="col-md-4">
								<img src="<?= base_url('') ?>assets/front/img/icon-gereja-2.jpg" class="img-fluid rounded-start" alt="...">
							</div>
							<div class="col-md-8">
								<div class="card-body">
									<ul class="list-group list-group-flush">
										<li class="list-group-item fw-bold">${item.nama}</li>
										<li class="list-group-item"><label>Nama Pimpinan </label> : ${item.pimpinan}</li>
										<li class="list-group-item"><label>Lokasi </label> : ${item.lokasi}</li>
										<li class="list-group-item"><label>Jumlah Jemaat </label> : ${item.jumlah_jemaat}</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				`;
			});

			currentPage = page;
		} catch (error) {
			console.error('Error fetching data', error);
		}

	}

	fetchDataGereja(currentPage);

	function loadData(page) {
		fetchDataGereja(page);
	}
</script>