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
					Data Guru
				</div>
				<div class="card-body table-responsive">
					<table class="table table-striped table-bordered table-hover" id="tabel-guru" width="100%" style="font-size:120%;">
						<thead>
							<tr>
								<th>No</th>
								<th>Foto</th>
								<th>NIP</th>
								<th>Nama Guru</th>
								<th>Jenis Kelamin</th>
								<th>No Hp</th>
								<th>Alamat</th>
								<th>Status</th>
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
<div class="modal fade" id="modal_guru" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"><i class="glyphicon glyphicon-info"></i> Form guru</h3>
			</div>
			<form role="form  col-lg" name="guru" id="frm_guru">
				<div class="modal-body form">
					<div class="row">
						<input type="hidden" id="gru_id" name="gru_id" value="">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Nomor Induk Pegawai</label>
								<input type="text" class="form-control" name="gru_nip" id="gru_nip" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Nama guru</label>
								<input type="text" class="form-control" name="gru_nama" id="gru_nama" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Jenis Kelamin</label>
								<select class="form-control" name="gru_jk" id="gru_jk" required>
									<option value="1">Laki - Laki</option>
									<option value="2">Perempuan</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Tempat Lahir</label>
								<input type="text" class="form-control" name="gru_tpt_lahir" id="gru_tpt_lahir" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Tanggal Lahir</label>
								<input type="text" class="form-control tgl" name="gru_tgl_lahir" id="gru_tgl_lahir" value="<?= date("d/m/Y"); ?>" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Alamat</label>
								<input type="text" class="form-control" name="gru_alamat" id="gru_alamat" required>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>No HP</label>
								<input type="number" min="0" class="form-control" name="gru_nohp" id="gru_nohp">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" name="gru_email" id="gru_email" required>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Agama</label>
								<select class="form-control" name="gru_agama" id="gru_agama" required>
									<option value="">== Pilih ==</option>
									<option value="Islam">Islam</option>
									<option value="Kristen Protestan">Kristen Protestan</option>
									<option value="Kristen Katholik">Kristen Katholik</option>
									<option value="Hindu">Hindu</option>
									<option value="Buddha">Buddha</option>
									<option value="Konghucu">Konghucu</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Status Pegawai</label>
								<select class="form-control" name="gru_status" id="gru_status" required>
									<option value="1">Aktif</option>
									<option value="0">Sudah Berhenti</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Foto</label>
								<div class="row">
									<div class="col-md-4">
										<img class="img-thumbnail img-preview" src="<?= base_url("assets/dist/img/no-image.jpg"); ?>">
									</div>
									<div class="col-md-2">
										<input type="file" class="filestyle" id="gru_foto" name="gru_foto" data-buttonname="btn-white" onchange="previewImg()">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="gru_simpan" class="btn btn-info">Simpan</button>
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

	function previewImg() {
		const foto = document.querySelector('#gru_foto');
		const imgPreview = document.querySelector('.img-preview');

		const fileFoto = new FileReader();
		fileFoto.readAsDataURL(foto.files[0]);

		fileFoto.onload = function(e) {
			imgPreview.src = e.target.result;
		}
	}

	function drawTable() {
		$('#tabel-guru').DataTable({
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
				"url": "ajax_list_guru/",
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
		$("#gru_id").val(0);
		$("frm_guru").trigger("reset");
		$('#modal_guru').modal({
			show: true,
			keyboard: false,
			backdrop: 'static'
		});
	}

	$("#frm_guru").submit(function(e) {
		e.preventDefault();
		$("#gru_simpan").html("Menyimpan...");
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
					$("#modal_guru").modal("hide");
				} else {
					toastr.error(res.desc);
				}
				$("#gru_simpan").html("Simpan");
				$(".btn").attr("disabled", false);
			},
			error: function(jqXHR, namaStatus, errorThrown) {
				$("#gru_simpan").html("Simpan");
				$(".btn").attr("disabled", false);
				alert('Error get data from ajax');
			}
		});
	});

	function hapus_guru(id) {
		event.preventDefault();
		$("#gru_id").val(id);
		$("#jdlKonfirm").html("Konfirmasi hapus data");
		$("#isiKonfirm").html("Yakin ingin menghapus data ini ?");
		$("#frmKonfirm").modal({
			show: true,
			keyboard: false,
			backdrop: 'static'
		});
	}

	function ubah_guru(id) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "cari",
			data: "gru_id=" + id,
			dataType: "json",
			success: function(data) {
				var obj = Object.entries(data);
				obj.map((dt) => {
					if (dt[0] == "gru_foto") {
						$(".img-preview").attr("src", "<?= base_url('assets/files/guru/') ?>" + dt[1]);
					} else {
						if (dt[0] == "gru_tgl_lahir") {
							let tgl = dt[1].split("-");
							$("#" + dt[0]).val(tgl[2] + "/" + tgl[1] + "/" + tgl[0]);
						} else {
							$("#" + dt[0]).val(dt[1]);
						}
					}
				});
				$(".inputan").attr("disabled", false);
				$("#modal_guru").modal({
					show: true,
					keyboard: false,
					backdrop: 'static'
				});
				return false;
			}
		});
	}

	function reset_form() {
		$("#gru_id").val(0);
		$("#frm_guru")[0].reset();
	}

	$("#yaKonfirm").click(function() {
		var id = $("#gru_id").val();

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