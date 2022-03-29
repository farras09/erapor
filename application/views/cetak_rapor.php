<?php

if (!isset($this->session->userdata['id_user'])) {
	redirect(base_url("login"));
}
?>
<!-- Theme style -->
<link rel="stylesheet" href="<?= base_url("assets"); ?>/dist/css/adminlte.min.css">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="<?= base_url("assets"); ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url("assets"); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url("assets"); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url("assets"); ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<div class="inner">

	<div class="row" id="isidata">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div style="position:absolute; margin: 0px 0px 0px 280px;">
							<img src="<?= base_url('assets/files/logo.png') ?>" width="75px">
						</div>
						<div style="margin: 10px 0px 0px 400px">
							<h4 align="center">SMA NEGERI 1 KAMPAR KIRI HILIR</h4>
							<h6 align="center">Jl. Pekanbaru - Lipat Kain KM. 30</h6>
							<!-- <h6 align="center">Email : </h6> -->
						</div>
						<hr size="1" width="100%">
						<br><br>
					</div>
					<h5 align="center"><u>LAPORAN HASIL BELAJAR AKHIR SEMESTER</u></h5>
					<table style="width: 100%; font-weight:bold;">
						<tr>
							<td width="15%;">Nama Siswa</td>
							<td width="20%;">: <?= $nama_siswa ?></td>
							<td width="10%;"></td>
							<td width="10%;">Semester</td>
							<td width="30%;">: <?= $semester ?></td>
						</tr>
						<tr>
							<td width="15%;">Kelas</td>
							<td width="20%;">: <?= $kelas ?></td>
							<td width="10%;"></td>
							<td width="10%;">Tahun Ajaran</td>
							<td width="30%;">: <?= $tahun_ajaran ?></td>
						</tr>
						<tr>
							<td width="15%;">Nomor Induk Siswa</td>
							<td width="20%;">: <?= $nisn ?></td>
						</tr>
					</table>
				</div>
				<div class="card-body table-responsive">
					<h6>I. PENILAIAN MATA PELAJARAN</h6>
					<table class="table table-striped table-bordered table-hover" width="100%" style="font-size:120%;">
						<thead align="center">
							<tr>
								<th rowspan="2" width="5%">No.</th>
								<th rowspan="2" width="35%">Mata Pelajaran</th>
								<th colspan="13">Nilai Pengetahuan (K3)</th>
							</tr>
							<tr>
								<!-- <th>PH-1</th>
 								<th>PH-2</th>
 								<th>PH-3</th> -->
								<th>RATA-RATA PH</th>
								<!-- <th>TUGAS 1</th>
 								<th>TUGAS 2</th>
 								<th>TUGAS 3</th> -->
								<th>RATA-RATA TUGAS</th>
								<th>RATA-RATA NPH</th>
								<th>PTS</th>
								<th>PAS</th>
								<th>NILAI AKHIR</th>
								<th>PREDIKAT</th>
							</tr>
						</thead>
						<tbody align="center">
							<?php
							$no = 1;
							foreach ($mapel as $mpl) {
							?>
								<tr>
									<td><?= $no++ ?></td>
									<td align="left"><?= $mpl->mpl_nama ?></td>
									<!-- <td><?= $mpl->rpr_ph1 ?></td>
 									<td><?= $mpl->rpr_ph2 ?></td>
 									<td><?= $mpl->rpr_ph3 ?></td> -->
									<td><?= $mpl->rpr_rata_ph ?></td>
									<!-- <td><?= $mpl->rpr_tgs1 ?></td>
 									<td><?= $mpl->rpr_tgs2 ?></td>
 									<td><?= $mpl->rpr_tgs3 ?></td> -->
									<td><?= $mpl->rpr_rata_tgs ?></td>
									<td><?= $mpl->rpr_rata_nph ?></td>
									<td><?= $mpl->rpr_pts ?></td>
									<td><?= $mpl->rpr_pas ?></td>
									<td><?= $mpl->rpr_nilai_akhir ?></td>
									<td><?= $mpl->rpr_predikat ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
					<br><br>
					<h6>II. SIKAP SISWA</h6>
					<table class="table table-striped table-bordered table-hover" width="100%" style="font-size:120%;">
						<thead align="center">
							<tr>
								<th width="5%">No.</th>
								<th width="40%">Sikap</th>
								<th>Penilaian</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($sikap) { ?>
								<tr>
									<td>1</td>
									<td>Sikap Spiritual</td>
									<td><?= $sikap->sks_predikat_spiritual ?></td>
									<td><?= $sikap->sks_deskripsi_spiritual ?></td>
								</tr>
								<tr>
									<td>2</td>
									<td>Sikap Sosial</td>
									<td><?= $sikap->sks_predikat_sosial ?></td>
									<td><?= $sikap->sks_deskripsi_sosial ?></td>
								</tr>
							<?php } else {
								echo "<td colspan='4' align='center'><i>Belum Ada Nilai</i></td>";
							} ?>
						</tbody>
					</table>
					<br><br>
					<h6>III. KEGIATAN EKSTRA KURIKULER</h6>
					<table class="table table-striped table-bordered table-hover" width="100%" style="font-size:120%;">
						<thead align="center">
							<tr>
								<th width="5%">No.</th>
								<th width="35%">Nama Kegiatan</th>
								<th>Nilai</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody align="center">
							<?php
							if ($ekstrakurikuler) {
								$no = 1;
								foreach ($ekstrakurikuler as $eskul) { ?>
									<tr>
										<td><?= $no++ ?></td>
										<td align="left"><?= $eskul->eks_nama ?></td>
										<td><?= $eskul->eks_nilai ?></td>
										<td><?= $eskul->eks_keterangan ?></td>
									</tr>
								<?php }
							} else { ?>
								<tr>
									<td colspan="5"><i>Tidak Ada Data Ekstrakurikuler</i></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
					<br><br>
					<h6>!V. KETIDAKHADIRAN</h6>
					<table class="table table-striped table-bordered table-hover" width="100%" style="font-size:120%;">
						<tbody>
							<?php if ($absensi) { ?>
								<tr>
									<td>Sakit</td>
									<td><?= $absensi->abs_sakit ?> Hari</td>
								</tr>
								<tr>
									<td>Izin</td>
									<td><?= $absensi->abs_izin ?> Hari</td>
								</tr>
								<tr>
									<td>Tanpa Keterangan</td>
									<td><?= $absensi->abs_alfa ?> Hari</td>
								</tr>
							<?php } else { ?>
								<tr>
									<td colspan="5" align="center"><i>Tidak Ada Data Absensi</i></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
					<br><br>

					<br><br>
					<p style="text-align: right; margin-right: 50px;">Sungai Pagar, <?= date('d F Y') ?></p>
					<table border="0" style="width: 90%; text-align: center;">
						<tr>
							<td colspan="3">Mengetahui,</td>
						</tr>
						<tr>
							<td style="padding-bottom: 65px; width: 30%">Orang Tua / Wali Siswa</td>
							<!-- <td style="padding-bottom: 65px; width: 30%">Kepala Sekolah</td> -->
							<td style="padding-bottom: 65px; width: 30%">Wali Kelas</td>
						</tr>
						<tr style="font-weight: bold;">
							<td><?php if (!$ortu) {
									echo "";
								} else {
									echo $ortu->otw_nama;
								} ?></td>
							<!-- <td><?= $kepsek ?></td> -->
							<td><?= $wali_kelas ?></td>
						</tr>
						<tr style="font-weight: bold;">
							<td></td>
							<!-- <td>NIK. <?= $nik_kepsek ?></td> -->
							<td>NIK. <?= $nik_guru ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	window.print()
	setTimeout(function() {
		window.close();
	}, 300);
</script>