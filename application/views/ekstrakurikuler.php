<input type="hidden" id="pd_id" value="<?= $pd_id; ?>">
<div class="inner">
	<div class="row">
		<div class="col-md-2 col-xs-12">
			<div class="form-group">
				<a href="javascript:tambah()" class="btn btn-success btn-block"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp; Tambah</a>
			</div>
		</div>
		<div class="col-md-2 col-xs-12">
			<div class="form-group">
				<a href="javascript:drawTable()" class="btn btn-success btn-block"><i class="fa fa-sync-alt"></i> &nbsp;&nbsp;&nbsp; Refresh</a>
			</div>
		</div>
		<div class="col-md-2 col-xs-12">
			<div class="form-group">
				<a href="javascript:window.history.back()" class="btn btn-success btn-block"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp;&nbsp; Kembali</a>
			</div>
		</div>
	</div>
	<div class="row" id="isidata">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Kegiatan Ekstrakurikuler
				</div>
				<div class="card-body table-responsive">
					<table class="table table-striped table-bordered table-hover" id="tabel-ekstrakurikuler" width="100%" style="font-size:120%;">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Peserta Didik</th>
								<th>Nama Kegiatan</th>
								<th>Minat</th>
								<th>Kesungguhan</th>
								<th>Kreativitas</th>
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
<div class="modal fade" id="modal_ekstrakurikuler" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"><i class="glyphicon glyphicon-info"></i> Form Ekstrakurikuler</h3>
			</div>
			<form role="form col-lg" name="Ekstrakurikuler" id="frm_ekstrakurikuler">
				<div class="modal-body form">
					<div class="row">
						<input type="hidden" id="eks_id" name="eks_id" value="">
						<input type="hidden" id="eks_pd_id" name="eks_pd_id" value="<?= $pd_id ?>">

						<div class="col-lg-6">
							<div class="form-group">
								<label>Nama Kegiatan</label>
								<input type="text" class="form-control" name="eks_nama" id="eks_nama" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Minat</label>
								<input type="number" min="0" class="form-control" name="eks_minat" id="eks_minat">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Kesungguhan</label>
								<input type="number" min="0" class="form-control" name="eks_kesungguhan" id="eks_kesungguhan">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Kreativitas</label>
								<input type="number" min="0" class="form-control" name="eks_kreativitas" id="eks_kreativitas">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="eks_simpan" class="btn btn-success">Simpan</button>
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
		$('#tabel-ekstrakurikuler').DataTable({
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
				"url": "../ajax_list_ekstrakurikuler/" + pd_id,
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
		$("#eks_id").val(0);
		$("frm_ekstrakurikuler").trigger("reset");
		$('#modal_ekstrakurikuler').modal({
			show: true,
			keyboard: false,
			backdrop: 'static'
		});
	}

	$("#frm_ekstrakurikuler").submit(function(e) {
		e.preventDefault();
		$("#eks_simpan").html("Menyimpan...");
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
					$("#modal_ekstrakurikuler").modal("hide");
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

	function hapus_ekstrakurikuler(id) {
		event.preventDefault();
		$("#eks_id").val(id);
		$("#jdlKonfirm").html("Konfirmasi hapus data");
		$("#isiKonfirm").html("Yakin ingin menghapus data ini ?");
		$("#frmKonfirm").modal({
			show: true,
			keyboard: false,
			backdrop: 'static'
		});
	}

	function ubah_ekstrakurikuler(id) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "../cari",
			data: "eks_id=" + id,
			dataType: "json",
			success: function(data) {
				var obj = Object.entries(data);
				obj.map((dt) => {
					$("#" + dt[0]).val(dt[1]);
				});
				$(".inputan").attr("disabled", false);
				$("#modal_ekstrakurikuler").modal({
					show: true,
					keyboard: false,
					backdrop: 'static'
				});
				return false;
			}
		});
	}

	function reset_form() {
		$("#eks_id").val(0);
		$("#frm_ekstrakurikuler")[0].reset();
	}

	$("#yaKonfirm").click(function() {
		var id = $("#eks_id").val();

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