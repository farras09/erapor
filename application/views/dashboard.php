<?php
// File Size 
function file_size($size)
{
	$ms = "B";
	$sz = number_format($size, 2, ",", ".");
	if ($size > 1024) {
		$sz = number_format($size / 1024, 2, ",", ".");
		$ms = "KB";
	}
	if ($size > 1048576) {
		$sz = number_format($size / 1048576, 2, ",", ".");
		$ms = "MB";
	}
	if ($size > 1073741824) {
		$sz = number_format($size / 1073741824, 2, ",", ".");
		$ms = "GB";
	}
	if ($size > 1099511627776) {
		$sz = number_format($size / 1099511627776, 2, ",", ".");
		$ms = "TB";
	}
	return "{$sz} {$ms}";
}
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<div class="container">
	<div class="row">
		<div class="col-md-3 col-sm-6 col-12">
			<div class="info-box">
				<span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Jumlah Siswa</span>
					<span class="info-box-number"><?= number_format($peserta_didik, 0, ",", "."); ?> Orang</span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-12">
			<div class="info-box">
				<span class="info-box-icon bg-info"><i class="fas fa-chalkboard-teacher"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Jumlah Guru</span>
					<span class="info-box-number"><?= number_format($guru, 0, ",", "."); ?> Orang</span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-12">
			<div class="info-box">
				<span class="info-box-icon bg-info"><i class="fas fa-door-open"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Jumlah Kelas</span>
					<span class="info-box-number"><?= number_format($kelas, 0, ",", "."); ?> Ruangan</span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-12">
			<div class="info-box">
				<span class="info-box-icon bg-info"><i class="fas fa-book"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Jumlah Mata Pelajaran</span>
					<span class="info-box-number"><?= number_format($mapel, 0, ",", "."); ?></span>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">

</div>

<!-- Custom Java Script -->
<script>
	var save_method; //for save method string
	var table;
	var tgl1 = null;
	var tgl2 = null;

	$(document).ready(function() {});
</script>