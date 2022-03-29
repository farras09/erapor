<input type="hidden" id="pd_id" value="<?= $pd_id; ?>">
<div class="inner">
	<div class="row" id="isidata">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<a href="javascript:tambah()" class="btn btn-info btn-block"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp; Tambah Wali / Edit Ortu</a>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<a href="javascript:window.history.back()" class="btn btn-info btn-block"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp;&nbsp; Kembali</a>
							</div>
						</div>
					</div>
					Data Orang Tua / Wali
				</div>
				<div class="card-body table-responsive">
					<table class="table table-striped table-bordered table-hover" id="tabel-ortu_wali" width="100%" style="font-size:120%;">
						<thead>
							<tr>
								<th>No</th>
								<th>Status</th>
								<th>Nama</th>
								<th>Tahun Lahir</th>
								<th>Pekerjaan</th>
								<th>Alamat</th>
								<th>No HP</th>
								<th>Agama</th>
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
<div class="modal fade" id="modal_ortu_wali" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"><i class="glyphicon glyphicon-info"></i> Form OrangTua / Wali</h3>
			</div>
			<form role="form col-lg" name="OrtuWali" id="frm_ortu_wali">
				<div class="modal-body form">
					<div class="row">
						<input type="hidden" id="otw_id" name="otw_id" value="">
						<input type="hidden" id="otw_pd_id" name="otw_pd_id" value="<?= $pd_id ?>">
						<div class="col-lg-6" id="jenis">
							<div class="form-group">
								<label>Status</label>
								<select class="form-control" name="otw_jenis" id="otw_jenis" onChange="get_data(this.value, <?= $pd_id ?>)" required>
									<option value="">== Pilih ==</option>
									<option value="1">Ayah</option>
									<option value="2">Ibu</option>
									<option value="3">Wali</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Nama</label>
								<input type="text" class="form-control" name="otw_nama" id="otw_nama" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Tahun Lahir</label>
								<input type="number" min="0" class="form-control" name="otw_thn_lahir" id="otw_thn_lahir" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Pekerjaan</label>
								<input type="text" class="form-control" name="otw_pekerjaan" id="otw_pekerjaan">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Alamat</label>
								<input type="text" class="form-control" name="otw_alamat" id="otw_alamat">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Nomor HP</label>
								<input type="number" min="0" class="form-control" name="otw_nohp" id="otw_nohp">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Agama</label>
								<select class="form-control" name="otw_agama" id="otw_agama">
									<option value="">== Pilih ==</option>
									<option value="Islam">Islam</option>
									<option value="Protestan">Protestas</option>
									<option value="Katholik">Katholik</option>
									<option value="Hindu">Hindu</option>
									<option value="Buddha">Buddha</option>
									<option value="Konghucu">Konghucu</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="otw_simpan" class="btn btn-info">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="reset_form()">Batal</button>
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
	var pd_id = $("#pd_id").val();

	function drawTable() {
		$('#tabel-ortu_wali').DataTable({
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
				"url": "../ajax_list_ortu_wali/" + pd_id,
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
		// $("#otw_id").val(0);
		$("frm_ortu_wali").trigger("reset");
		$('#modal_ortu_wali').modal({
			show: true,
			keyboard: false,
			backdrop: 'static'
		});
	}

	$("#frm_ortu_wali").submit(function(e) {
		e.preventDefault();
		$("#otw_simpan").html("Menyimpan...");
		$(".btn").attr("disabled", true);
		$.ajax({
			type: "POST",
			url: "../simpan",
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
					$("#modal_ortu_wali").modal("hide");
				} else {
					toastr.error(res.desc);
				}
				$("#otw_simpan").html("Simpan");
				$(".btn").attr("disabled", false);
			},
			error: function(jqXHR, namaStatus, errorThrown) {
				$("#otw_simpan").html("Simpan");
				$(".btn").attr("disabled", false);
				alert('Error get data from ajax');
			}
		});

	});

	function hapus_ortu_wali(id) {
		event.preventDefault();
		$("#otw_id").val(id);
		$("#jdlKonfirm").html("Konfirmasi hapus data");
		$("#isiKonfirm").html("Yakin ingin menghapus data ini ?");
		$("#frmKonfirm").modal({
			show: true,
			keyboard: false,
			backdrop: 'static'
		});
	}

	function get_data(jenis, pd_id) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "../cari",
			data: "otw_pd_id=" + pd_id + "&otw_jenis=" + jenis,
			dataType: "json",
			success: function(data) {
				if (data == null || jenis > 2) {
					$("#otw_id").val(0);
					$("#otw_nik").val(null);
					$("#otw_nama").val(null);
					$("#otw_thn_lahir").val(null);
					$("#otw_pendidikan").val(null);
					$("#otw_pekerjaan").val(null);
					$("#otw_penghasilan").val(null);
				} else {
					var obj = Object.entries(data);
					obj.map((dt) => {
						$("#" + dt[0]).val(dt[1]);
					});
				}
				$(".inputan").attr("disabled", false);
				$("#modal_ortu_wali").modal({
					show: true,
					keyboard: false,
					backdrop: 'static'
				});
				return false;
			}
		});
	}

	function ubah_wali(id) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "../cari_wali",
			data: "otw_id=" + id,
			dataType: "json",
			success: function(data) {
				var obj = Object.entries(data);
				obj.map((dt) => {
					$("#jenis").hide();
					$("#" + dt[0]).val(dt[1]);
				});
				$(".inputan").attr("disabled", false);
				$("#modal_ortu_wali").modal({
					show: true,
					keyboard: false,
					backdrop: 'static'
				});
				return false;
			}
		});
	}

	function reset_form() {
		$("#otw_id").val(0);
		$("#frm_ortu_wali")[0].reset();
	}

	$("#yaKonfirm").click(function() {
		var id = $("#otw_id").val();

		$("#isiKonfirm").html("Sedang menghapus data...");
		$(".btn").attr("disabled", true);
		$.ajax({
			type: "GET",
			url: "../hapus/" + id,
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