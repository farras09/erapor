<div class="inner">
	<div class="row" id="isidata">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Data Kelas Siswa
				</div>
				<div class="card-body table-responsive">
					<table class="table table-striped table-bordered table-hover" id="tabel-kelas" width="100%" style="font-size:120%;">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Kelas</th>
								<th>Tingkat Kelas</th>
								<th>Jumlah Siswa</th>
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
<div class="modal fade" id="modal_kelas" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"><i class="glyphicon glyphicon-info"></i> Form Data kelas</h3>
			</div>
			<div class="modal-body form">
				<form role="form col-lg" name="kelas" id="frm_kelas">
					<div class="row">
						<input type="hidden" id="kss_id" name="kss_id" value="">
						<input type="hidden" id="kss_kls_id" name="kss_kls_id" value="">

						<div class="col-lg-5">
							<div class="form-group">
								<select class="form-control" name="kss_ta_id" id="kss_ta_id" onChange="drawTableSiswa(); cek_tahun_ajaran()" required>
									<option value="">== Pilih Tahun Ajaran ==</option>
									<?php foreach ($ta as $t) {
										if ($t->ta_semester == 1) {
											$smstr = "Ganjil";
										} else {
											$smstr = "Genap";
										} ?>
										<option value="<?= $t->ta_id ?>"><?= $t->ta_tahun . " " . $smstr ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<select class="form-control select2" name="kss_pd_id" id="kss_pd_id" style="width:100%;line-height:100px;" required>
									<option value="">== Pilih Siswa ==</option>
									<?php foreach ($siswa as $s) { ?>
										<option value="<?= $s->pd_id ?>"><?= $s->pd_nama ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<button type="submit" id="kss_simpan" class="btn btn-success">Masukkan</button>
							</div>
						</div>
					</div>
				</form>
				<form role="form col-lg" name="kelas_salin" id="frm_kelas_salin">
					<div class="row" id="isidatasiswa">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									Data Siswa
								</div>
								<div class="card-body table-responsive">
									<table class="table table-striped table-bordered table-hover" id="tabel-siswa" width="100%" style="font-size:120%;">
										<thead>
											<tr>
												<th>No</th>
												<th>NISN</th>
												<th>Nama Siswa</th>
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
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="reset_form()">Tutup</button>
			</div>
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
<script src="<?= base_url("assets"); ?>/plugins/select2/js/select2.full.js"></script>

<!-- Toastr -->
<script src="<?= base_url("assets"); ?>/plugins/toastr/toastr.min.js"></script>

<script>
	var save_method; //for save method string
	var table;
	var id_kelas = $("#kls_id").val();
	var filter = 1;

	function drawTable() {
		$('#tabel-kelas').DataTable({
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
				"url": "ajax_list_kelas_siswa/",
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

	function drawTableSiswa() {
		var id_ta = $("#kss_ta_id").val();
		if (!id_ta) id_ta = null;
		$('#tabel-siswa').DataTable({
			"destroy": true,
			dom: 'Bfrtip',
			lengthMenu: [
				[10, 25, 50, -1],
				['10 rows', '25 rows', '50 rows', 'Show all']
			],
			buttons: [
				'pageLength'
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
				"url": "ajax_list_siswa/" + id_kelas + "/" + id_ta,
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
				$("#isidatasiswa").fadeIn();
			}
		});
		// cek_tahun_ajaran();
	}

	$("#frm_kelas").submit(function(e) {
		e.preventDefault();
		$("#kss_simpan").html("Memasukkan...");
		$(".btn").attr("disabled", true);
		$.ajax({
			type: "POST",
			url: "simpan",
			data: new FormData(this),
			processData: false,
			contentType: false,
			success: function(d) {
				var res = JSON.parse(d);
				var msg = "";
				if (res.status == 1) {
					toastr.success(res.desc);
					drawTable();
					drawTableSiswa();
					reset_form();
				} else {
					toastr.error(res.desc);
				}
				$("#kss_simpan").html("Masukkan");
				$(".btn").attr("disabled", false);
			},
			error: function(jqXHR, namaStatus, errorThrown) {
				$("#kss_simpan").html("Masukkan");
				$(".btn").attr("disabled", false);
				alert('Error get data from ajax');
			}
		});
	});

	function hapus_siswa(id) {
		event.preventDefault();
		$("#kss_id").val(id);
		$.ajax({
			type: "GET",
			url: "hapus/" + id,
			success: function(d) {
				var res = JSON.parse(d);
				var msg = "";
				if (res.status == 1) {
					toastr.success(res.desc);
					drawTableSiswa();
					drawTable();
				} else {
					toastr.error(res.desc + "[" + res.err + "]");
				}
				$(".btn").attr("disabled", false);
			},
			error: function(jqXHR, namaStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function ubah_kelas(id, jml) {
		$("#kss_kls_id").val(id);
		event.preventDefault();
		id_kelas = id;
		drawTableSiswa();
		if (jml > 0) {
			$("#salin").addClass("disabled");
		} else {
			$("#salin").removeClass("disabled");
		}
		$("#modal_kelas").modal({
			show: true,
			keyboard: false,
			backdrop: 'static'
		});
	}

	function cek_tahun_ajaran() {
		var id = $("#kss_kls_id").val();
		var ta = $("#kss_ta_id").val();
		if (!ta) ta = null;
		$.ajax({
			type: "GET",
			url: "get_tahun_ajaran/" + id + "/" + ta,
			success: function(d) {
				var res = JSON.parse(d);
				if (res > 0) {
					$("#salin").addClass("disabled");
				} else {
					$("#salin").removeClass("disabled");
				}
			},
			error: function(jqXHR, namaStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function reset_form() {
		$("#kss_id").val(0);
		$("#frm_kelas")[0].reset();
	}

	$("#yaKonfirm").click(function() {
		var id = $("#kss_id").val();

		$("#isiKonfirm").html("Sedang menghapus data...");
		$(".btn").attr("disabled", true);
		$.ajax({
			type: "GET",
			url: "hapus/" + id,
			success: function(d) {
				var res = JSON.parse(d);
				var msg = "";
				if (res.status == 1) {
					toastr.success(res.desc);
					$("#frmKonfirm").modal("hide");
					drawTable();
				} else {
					toastr.error(res.desc + "[" + res.err + "]");
				}
				$(".btn").attr("disabled", false);
			},
			error: function(jqXHR, namaStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	});

	function get_kelas(id) {
		var id_ta = decodeURIComponent(id);
		$.get("get_kelas/" + id_ta, {}, function(data) {
			$("#kss_kls_id1").html(data);
		});
	}

	$('.tgl').daterangepicker({
		locale: {
			format: 'DD/MM/YYYY'
		},
		showDropdowns: true,
		singleDatePicker: true,
		"autoAplog": true,
		opens: 'left'
	});

	$('.select2').select2({
		className: "form-control"
	});

	$(document).ready(function() {
		drawTable();
	});
</script>