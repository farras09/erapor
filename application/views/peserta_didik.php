<div class="inner">
	<div class="row" id="isidata">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<div class="col-md-2 pl-0">
						<div class="form-group">
							<a href="javascript:tambah()" class="btn btn-info btn-block"><i class="fa fa-plus-circle"></i> &nbsp;&nbsp;&nbsp; Tambah</a>
						</div>
					</div>
					Data Siswa
				</div>
				<div class="card-body table-responsive">
					<table class="table table-striped table-bordered table-hover" id="tabel-peserta_didik" width="100%" style="font-size:120%;">
						<thead>
							<tr>
								<th>No</th>
								<th>NISN</th>
								<th>Nama</th>
								<th>Jenis Kelamin</th>
								<th>Tempat, Tanggal Lahir</th>
								<th>No. Handphone</th>
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
<div class="modal fade" id="modal_peserta_didik" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"><i class="glyphicon glyphicon-info"></i> Form Peserta Didik</h3>
			</div>
			<form role="form col-lg" name="Peserta_didik" id="frm_peserta_didik" enctype="multipart/form-data">
				<div class="modal-body form">
					<div class="row">
						<input type="hidden" id="pd_id" name="pd_id" value="">
						<div class="col-lg-6">
							<div class="form-group">
								<label>NISN</label>
								<input type="number" min="0" class="form-control" name="pd_nisn" id="pd_nisn" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>NIK</label>
								<input type="number" min="0" class="form-control" name="pd_nik" id="pd_nik" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Nama</label>
								<input type="text" class="form-control" name="pd_nama" id="pd_nama" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Jenis Kelamin</label>
								<select class="form-control" name="pd_jk" id="pd_jk" required>
									<option value="1">Laki-laki</option>
									<option value="2">Perempuan</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Tempat Lahir</label>
								<input type="text" class="form-control" name="pd_tpt_lahir" id="pd_tpt_lahir" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Tanggal Lahir</label>
								<input type="text" class="form-control tgl" name="pd_tgl_lahir" id="pd_tgl_lahir" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Nomor handphone</label>
								<input type="number" min="0" class="form-control" name="pd_hp" id="pd_hp" placeholder="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Agama</label>
								<select class="form-control" name="pd_agama" id="pd_agama" placeholder="">
									<option value="">== Pilih ==</option>
									<option value="Islam">Islam</option>
									<option value="Katholik">Katholik</option>
									<option value="Protestan">Protestan</option>
									<option value="Hindu">Hindu</option>
									<option value="Buddha">Buddha</option>
									<option value="Konghucu">Konghucu</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Anak Ke -</label>
								<input type="number" min="0" class="form-control" name="pd_anak_ke" id="pd_anak_ke">
							</div>
						</div>
						<div class="col-lg">
							<div class="form-group">
								<label>Status dalam Keluarga</label>
								<select class="form-control" name="pd_status" id="pd_status">
									<option value="1">Anak Kandung</option>
									<option value="3">Anak Tiri</option>
									<option value="3">Anak Angkat</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Foto</label>
								<input type="file" class="form-control form-control-sm" style="height:37px;" accept=".jpg, .png, .jpeg" name="pd_foto" id="pd_foto" />
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="pd_simpan" class="btn btn-info">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="reset_form()">Batal</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_lihat_pd" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"><i class="glyphicon glyphicon-info"></i> Info Peserta Didik</h3>
			</div>
			<div class="modal-body form">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<span id="pd_foto2"></span>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>NISN</label>
							<input type="number" min="0" class="form-control" name="pd_nisn" id="pd_nisn2" readonly>
						</div>
						<div class="form-group">
							<label>NIK</label>
							<input type="number" min="0" class="form-control" name="pd_nik" id="pd_nik2" readonly>
						</div>
						<div class="form-group">
							<label>Nama</label>
							<input type="text" class="form-control" name="pd_nama" id="pd_nama2" readonly>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label>Jenis Kelamin</label>
							<input type="text" class="form-control" name="pd_jk" id="pd_jk2" readonly>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>Agama</label>
							<input type="text" class="form-control" name="pd_agama" id="pd_agama2" readonly>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>Tempat Lahir</label>
							<input type="text" class="form-control" name="pd_tpt_lahir" id="pd_tpt_lahir2" readonly>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>Tanggal Lahir</label>
							<input type="text" class="form-control tgl" name="pd_tgl_lahir" id="pd_tgl_lahir2" readonly>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>Nomor handphone</label>
							<input type="number" min="0" class="form-control" name="pd_hp" id="pd_hp2" readonly>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>Anak Ke -</label>
							<input type="number" min="0" class="form-control" name="pd_anak_ke" id="pd_anak_ke2" readonly>
						</div>
					</div>
					<div class="col-lg">
						<div class="form-group">
							<label>Status dalam Keluarga</label>
							<input type="text" class="form-control" name="pd_status" id="pd_status2" readonly>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal" onclick="reset_form()">Kembali</button>
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
<script src="<?= base_url("assets"); ?>/plugins/select2/select2.js"></script>

<!-- Toastr -->
<script src="<?= base_url("assets"); ?>/plugins/toastr/toastr.min.js"></script>

<script>
	var save_method; //for save method string
	var table;

	function drawTable() {
		$('#tabel-peserta_didik').DataTable({
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
				"url": "ajax_list_peserta_didik/",
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

	function tambah() {
		$("#pd_id").val(0);
		$("frm_peserta_didik").trigger("reset");
		$('#modal_peserta_didik').modal({
			show: true,
			keyboard: false,
			backdrop: 'static'
		});
	}

	$("#frm_peserta_didik").submit(function(e) {
		e.preventDefault();
		$("#pd_simpan").html("Menyimpan...");
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
					reset_form();
					$("#modal_peserta_didik").modal("hide");
				} else {
					toastr.error(res.desc);
				}
				$("#pd_simpan").html("Simpan");
				$(".btn").attr("disabled", false);
			},
			error: function(jqXHR, namaStatus, errorThrown) {
				$("#pd_simpan").html("Simpan");
				$(".btn").attr("disabled", false);
				alert('Error get data from ajax');
			}
		});
	});

	function hapus_peserta_didik(id) {
		event.preventDefault();
		$("#pd_id").val(id);
		$("#jdlKonfirm").html("Konfirmasi hapus data");
		$("#isiKonfirm").html("Yakin ingin menghapus data ini ?");
		$("#frmKonfirm").modal({
			show: true,
			keyboard: false,
			backdrop: 'static'
		});
	}

	function ubah_peserta_didik(id) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "cari",
			data: "pd_id=" + id,
			dataType: "json",
			success: function(data) {
				var obj = Object.entries(data);
				obj.map((dt) => {
					if (dt[0] == "pd_tgl_lahir") {
						var tgl = dt[1].split("-");
						$("#" + dt[0]).val(tgl[2] + "/" + tgl[1] + "/" + tgl[0]);
					} else if (dt[0] == "pd_foto") {
						$("#" + dt[0]).val(null);
					} else {
						$("#" + dt[0]).val(dt[1]);
					}
				});
				$(".inputan").attr("disabled", false);
				$("#modal_peserta_didik").modal({
					show: true,
					keyboard: false,
					backdrop: 'static'
				});
				return false;
			}
		});
	}

	function lihat_peserta_didik(id) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "cari",
			data: "pd_id=" + id,
			dataType: "json",
			success: function(data) {
				var obj = Object.entries(data);
				obj.map((dt) => {
					if (dt[0] == "pd_foto") {
						var foto = "<img src='<?= base_url('assets/files/siswa/') ?>" + dt[1] + "' height='250px'>";
						$("#" + dt[0] + "2").html(foto);
					} else if (dt[0] == "pd_jk") {
						if (dt[1] == 1) {
							$("#" + dt[0] + "2").val("Laki-laki");
						} else {
							$("#" + dt[0] + "2").val("Perempuan");
						}
					} else if (dt[0] == "pd_status") {
						if (dt[1] == 1) {
							$("#" + dt[0] + "2").val("Anak Kandung");
						} else if (dt[0] == 2) {
							$("#" + dt[0] + "2").val("Anak Tiri");
						} else if (dt[0] == 3) {
							$("#" + dt[0] + "2").val("Anak Angkat");
						} else {
							$("#" + dt[0] + "2").val("");
						}
					} else {
						$("#" + dt[0] + "2").val(dt[1]);
					}
				});
				$(".inputan").attr("disabled", false);
				$("#modal_lihat_pd").modal({
					show: true,
					keyboard: false,
					backdrop: 'static'
				});
				return false;
			}
		});
	}

	function reset_form() {
		$("#pd_id").val(0);
		$("#frm_peserta_didik")[0].reset();
	}

	$("#yaKonfirm").click(function() {
		var id = $("#pd_id").val();

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

	$('.tgl').daterangepicker({
		locale: {
			format: 'DD/MM/YYYY'
		},
		showDropdowns: true,
		singleDatePicker: true,
		"autoAplog": true,
		opens: 'left'
	});

	$(document).ready(function() {
		drawTable();
	});
</script>