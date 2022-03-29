<div class="inner">
	<div class="row" id="isidata">
		<div class="col-lg-12">
			<?php if ($this->session->userdata('level') < 3) { ?>
				<div class="col-md-2 col-xs-12">
					<div class="form-group">
						<select id="filter_kelas" onChange="drawTable()" class="form-control">
							<option value="">== Filter Kelas ==</option>
							<?php foreach ($filterkelas as $t) { ?>
								<option value="<?= $t->gmp_kelas ?>"><?= $t->kls_nama ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			<?php } ?>
			<div class="card">
				<div class="card-header">
					<b>RAPOR SISWA</b>
					<hr width="20%" align="left">
					<?php if ($rapor) { ?>
						<!-- <a href="<?= base_url('Rapor/cetak_rapor') ?>" target="_blank" class="btn btn-success" style="float: right;"><i class="fas fa-print"></i> Cetak Rapor</a> -->
						<i class="fas fa-door-open"></i> Kelas : <?= $rapor->kls_nama ?><br>
						<i class="fas fa-user-tie"></i> Wali Kelas : <?= $rapor->gru_nama ?><br>
						<i class="fas fa-calendar-alt"></i> Tahun Akademik : <?= $rapor->ta_tahun ?><br>
					<?php } ?>
				</div>
				<div class="card-body table-responsive">
					<table class="table table-striped table-bordered table-hover" id="tabel-rapor" width="100%" style="font-size:120%;">
						<thead>
							<tr>
								<?php if ($this->session->userdata('level') < 3) { ?>
									<th>No</th>
								<?php } else { ?>
									<th>Peringkat</th>
								<?php } ?>
								<th>NISN</th>
								<th>Nama</th>
								<th>Jenis Kelamin</th>
								<th>Kelas</th>
								<th>Nilai Rata-rata Rapor</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="3" align="center">Tidak ada data</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_sikap" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"><i class="glyphicon glyphicon-info"></i> Penilaian Sikap Siswa</h3>
			</div>
			<form role="form col-lg-6" name="Sikap" id="frm_sikap">
				<div class="modal-body form">
					<div class="card-body" style="padding: 0px;">
						<div class="row">
							<input type="hidden" id="sks_pd_id" name="sks_pd_id" value="">
							<input type="hidden" id="sks_ta_id" name="sks_ta_id" value="">
							<div class="col-lg-12">
								<h5>Sikap Spiritual</h5>
								<hr>
								<div class="form group">
									<label>Predikat</label>
									<select class="form-control" name="sks_predikat_spiritual" id="sks_predikat_spiritual">
										<option value="">== Pilih ==</option>
										<option value="Baik">Baik</option>
										<option value="Cukup">Cukup</option>
										<option value="Kurang">Kurang</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<label>Deskripsi</label>
								<textarea rows="3" class="form-control" id="sks_deskripsi_spiritual" name="sks_deskripsi_spiritual"></textarea>
							</div>
							<div class="col-lg-12">
								<h5 style="margin-top: 20px;">Sikap Sosial</h5>
								<hr>
								<div class="form group">
									<label>Predikat</label>
									<select class="form-control" name="sks_predikat_sosial" id="sks_predikat_sosial">
										<option value="">== Pilih ==</option>
										<option value="Baik">Baik</option>
										<option value="Cukup">Cukup</option>
										<option value="Kurang">Kurang</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<label>Deskripsi</label>
								<textarea rows="3" class="form-control" id="sks_deskripsi_sosial" name="sks_deskripsi_sosial"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="sks_simpan" class="btn btn-info">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal_eskul" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"><i class="glyphicon glyphicon-info"></i> Penilaian Ekstrakurikuler</h3>
			</div>
			<form role="form col-lg" name="Eskul" id="frm_eskul">
				<div class="modal-body form">
					<div class="card-body">
						<div class="row">
							<input type="hidden" id="eks_pd_id" name="eks_pd_id" value="">
							<input type="hidden" id="eks_ta_id" name="eks_ta_id" value="">
							<div class="col-lg-12">
								<div class="form-group" id="dynamic">
									<table class="table" id="dynamic_field"></table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="eks_simpan" class="btn btn-info">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="reset_form();">Batal</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_absensi" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"><i class="glyphicon glyphicon-info"></i> Absensi</h3>
			</div>
			<form role="form col-lg-6" name="Absensi" id="frm_absensi">
				<div class="modal-body form">
					<div class="card-body">
						<div class="row">
							<input type="hidden" id="abs_id" name="abs_id" value="">
							<input type="hidden" id="abs_pd_id" name="abs_pd_id" value="">
							<input type="hidden" id="abs_ta_id" name="abs_ta_id" value="">
							<div class="col-lg-4">
								<div class="form-group">
									<label>Sakit</label>
									<input type="number" min="0" class="form-control" name="abs_sakit" id="abs_sakit">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label>Izin</label>
									<input type="number" min="0" class="form-control" name="abs_izin" id="abs_izin">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label>Tanpa Keterangan</label>
									<input type="number" min="0" class="form-control" name="abs_alfa" id="abs_alfa">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="abs_simpan" class="btn btn-info">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="reset_form();">Batal</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- DataTables -->
<script src="<?= base_url("assets"); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/buttons.colVis.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/pdfmake.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/vfs_fonts.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/jszip.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url("assets"); ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url("assets"); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Select 2 -->
<script src="<?= base_url("assets"); ?>/plugins/select2/select2.js"></script>

<!-- Toastr -->
<script src="<?= base_url("assets"); ?>/plugins/toastr/toastr.min.js"></script>

<script>
	var save_method; //for save method string
	var table;

	function drawTable() {
		var filter_kelas = $("#filter_kelas").val();
		if (!filter_kelas) filter_kelas = null;
		$('#tabel-rapor').DataTable({
			"destroy": true,
			dom: 'Bfrtip',
			lengthMenu: [
				[10, 25, 50, -1],
				['10 rows', '25 rows', '50 rows', 'Show all']
			],
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength'
			],
			// "oLanguage": {
			// "sProcessing": '<center><img src="<?= base_url("assets/"); ?>assets/img/fb.gif" style="width:2%;"> Loading Data</center>',
			// },
			"responsive": true,
			"sort": true,
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "ajax_list_peserta_didik/" + filter_kelas,
				"type": "POST"
			},
			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [-1], //last column
				"orderable": false, //set not orderable
			}, ],
			"initComplete": function(settings, json) {
				$("#process").html("<i class='glyphicon glyphicon-search'></i> Process")
				$(".btn").attr("disabled", false);
				$("#isidata").fadeIn();
			}
		});
	}

	function sikap_siswa(id, ta) {
		$("#sks_pd_id").val(id);
		$("#sks_ta_id").val(ta);
		$.ajax({
			type: "POST",
			data: {
				id: id,
				ta
			},
			url: "cari_sikap/" + id + "/" + ta,
			success: function(data) {
				$("#sikap").html(data);
				$("#modal_sikap").modal({
					show: true,
					keyboard: false,
					backdrop: 'static'
				});
			}
		});
	}

	function get_nilai_sikap() {
		var id = $("#sks_pd_id").val();
		var ta = $("#sks_ta_id").val();

		$.ajax({
			type: "POST",
			data: {
				id: id,
				ta
			},
			url: "cari_sikap/" + id + "/" + ta,
			success: function(data) {
				$("#sikap").html(data);
			}
		});
	}

	$("#frm_sikap").submit(function(e) {
		e.preventDefault();
		$("#sks_simpan").html("Menyimpan...");
		$(".btn").attr("disabled", true);
		$.ajax({
			type: "POST",
			url: "simpan_nilai_sikap/",
			data: new FormData(this),
			processData: false,
			contentType: false,
			success: function(d) {
				var res = JSON.parse(d);
				var msg = "";
				if (res.status == 1) {
					toastr.success(res.desc);
					drawTable();
					$("#modal_sikap").modal("hide");
				} else {
					toastr.error(res.desc);
				}
				$("#sks_simpan").html("Simpan");
				$(".btn").attr("disabled", false);
			},
			error: function(jqXHR, namaStatus, errorThrown) {
				$("#sks_simpan").html("Simpan");
				$(".btn").attr("disabled", false);
				alert('Error get data from ajax');
			}
		});
	});

	function absensi(id, ta) {
		$("#abs_pd_id").val(id);
		$("#abs_ta_id").val(ta);
		$.ajax({
			type: "POST",
			data: {
				id: id,
				ta
			},
			url: "cari_absensi/" + id + "/" + ta,
			dataType: "json",
			success: function(data) {
				reset_form();
				var obj = Object.entries(data);
				obj.map((dt) => {
					$("#" + dt[0]).val(dt[1]);
				});
				$(".inputan").attr("disabled", false);
				$("#modal_absensi").modal({
					show: true,
					keyboard: false,
					backdrop: 'static'
				});
				return false;
			}
		});
	}

	function get_jml_absen(jenis) {
		var id = $("#abs_pd_id").val();
		var ta = $("#abs_ta_id").val();

		$.ajax({
			type: "POST",
			data: {
				id: id,
				ta
			},
			url: "cari_absensi/" + id + "/" + ta,
			dataType: "json",
			success: function(data) {
				reset_form();
				var obj = Object.entries(data);
				obj.map((dt) => {
					$("#" + dt[0]).val(dt[1]);
				});
				return false;
			}
		});
	}

	$("#frm_absensi").submit(function(e) {
		e.preventDefault();
		$("#abs_simpan").html("Menyimpan...");
		$(".btn").attr("disabled", true);
		$.ajax({
			type: "POST",
			url: "simpan_absensi",
			data: new FormData(this),
			processData: false,
			contentType: false,
			success: function(d) {
				var res = JSON.parse(d);
				var msg = "";
				if (res.status == 1) {
					toastr.success(res.desc);
					drawTable();
					$("#modal_absensi").modal("hide");
				} else {
					toastr.error(res.desc);
				}
				$("#abs_simpan").html("Simpan");
				$(".btn").attr("disabled", false);
			},
			error: function(jqXHR, namaStatus, errorThrown) {
				$("#abs_simpan").html("Simpan");
				$(".btn").attr("disabled", false);
				alert('Error get data from ajax');
			}
		});
	});

	function ekstrakurikuler(id, ta) {
		$("#eks_pd_id").val(id);
		$("#eks_ta_id").val(ta);
		$.ajax({
			type: "POST",
			data: {
				id: id,
				ta
			},
			url: "cari_eskul/" + id + "/" + ta,
			dataType: "json",
			success: function(data) {
				eskul();
				if (data) {
					data.map((eks, i) => {
						if (i > 0) $("#add").trigger('click');
						var obj = Object.entries(eks);
						var n = i + 1;
						obj.map((dt) => {
							$("#" + dt[0] + n).val(dt[1]);
						});
					})
				}
				$(".inputan").attr("disabled", false);
				$("#modal_eskul").modal({
					show: true,
					keyboard: false,
					backdrop: 'static'
				});
				return false;
			}
		});
	}

	function get_nilai_eskul(jenis) {
		var id = $("#eks_pd_id").val();
		var ta = $("#eks_ta_id").val();

		$.ajax({
			type: "POST",
			data: {
				id: id,
				ta
			},
			url: "cari_eskul/" + id + "/" + ta,
			dataType: "json",
			success: function(data) {
				eskul();
				if (data) {
					data.map((eks, i) => {
						if (i > 0) $("#add").trigger('click');
						var obj = Object.entries(eks);
						var n = i + 1;
						obj.map((dt) => {
							$("#" + dt[0] + n).val(dt[1]);
						});
					})
				}
				return false;
			}
		});
	}

	$("#frm_eskul").submit(function(e) {
		e.preventDefault();
		$("#eks_simpan").html("Menyimpan...");
		$(".btn").attr("disabled", true);
		$.ajax({
			type: "POST",
			url: "simpan_eskul",
			data: new FormData(this),
			processData: false,
			contentType: false,
			success: function(d) {
				var res = JSON.parse(d);
				var msg = "";
				if (res.status == 1) {
					toastr.success(res.desc);
					drawTable();
					$("#modal_eskul").modal("hide");
				} else {
					toastr.error(res.desc);
				}
				$("#eks_simpan").html("Simpan");
				$(".btn").attr("disabled", false);
			},
			error: function(jqXHR, namaStatus, errorThrown) {
				$("#eks_simpan").html("Simpan");
				$(".btn").attr("disabled", false);
				alert('Error get data from ajax');
			}
		});
	});

	var i = 1;

	//Dynamic Form
	function tambah() {
		i++;
		$('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added">' +
			`<td><input type="text" id="eks_nama` + i + `" name="eks_nama[]" placeholder="Nama Kegiatan" class="form-control name_list"></td>` +
			`<td><input type="text" id="eks_nilai` + i + `" name="eks_nilai[]" placeholder="Nilai" class="form-control name_list"></td>` +
			`<td><input type="text" id="eks_keterangan` + i + `" name="eks_keterangan[]" placeholder="Keterangan" class="form-control name_list"></td>` +
			'<td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove"><i class="fas fa-minus-circle"></i></button></td></tr>');
	}

	$(document).on('click', '.btn_remove', function() {
		var button_id = $(this).attr("id");
		$('#row' + button_id + '').remove();
	});

	function eskul() {
		i = 1;
		$("#dynamic_field").html(`<tr>
										<td width="36%"><input type="text" id="eks_nama1" name="eks_nama[]" placeholder="Nama Kegiatan" class="form-control name_list"></td>
										<td><input type="text" id="eks_nilai1" name="eks_nilai[]" placeholder="Nilai" class="form-control name_list"></td>
										<td><input type="text" id="eks_keterangan1" name="eks_keterangan[]" placeholder="Keterangan" class="form-control name_list"></td>

										<td><button type="button" name="add" id="add" class="btn btn-success" onclick="tambah()"><i class="fas fa-plus-circle"></button></td>
									</tr>`);
	}

	function reset_form() {
		eskul();
		$("#abs_id").val(0);
		$("#eks_id").val(0);
		$("#frm_absensi")[0].reset();
		$("#frm_eskul")[0].reset();
	}

	$(document).ready(function() {
		drawTable();
		eskul();
	});
</script>