<div class="inner">
	<div class="row">
		<div class="col-md-2 col-xs-12">
			<div class="form-group">
				<a href="javascript:drawTable()" class="btn btn-info btn-block"><i class="fa fa-sync-alt"></i> &nbsp;&nbsp;&nbsp; Refresh</a>
			</div>
		</div>
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
		<!-- <?php if ($this->session->userdata('level') > 2) { ?>
			<div class="col-md-2 col-xs-12">
				<div class="form-group">
					<select id="filter_mapel" onChange="drawTable()" class="form-control">
						<option value="">== Filter Mapel ==</option>
						<?php foreach ($filtermapel as $m) { ?>
							<option value="<?= $m->gmp_mapel ?>"><?= $t->gmp_mapel ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		<?php } ?> -->
	</div>
	<div class="row" id="isidata">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Nilai Mata Pelajaran
				</div>
				<div class="card-body table-responsive">
					<table class="table table-striped table-bordered table-hover" id="tabel-rapor" width="100%" style="font-size:120%;">
						<thead>
							<tr>
								<th>No</th>
								<th>NISN</th>
								<th>Nama</th>
								<th>Kelas</th>
								<th>Mata Pelajaran</th>
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
<div class="modal fade" id="modal_hasil_belajar" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"><i class="glyphicon glyphicon-info"></i> Input Nilai</h3>
			</div>
			<form role="form col-lg-6" name="HasilBelajar" id="frm_hasil_belajar">
				<div class="modal-body form">
					<div class="card-body">
						<div class="row">
							<input type="hidden" id="rpr_id" name="rpr_id" value="">
							<input type="hidden" id="rpr_pd_id" name="rpr_pd_id" value="">
							<input type="hidden" id="rpr_ta_id" name="rpr_ta_id" value="">
							<input type="hidden" id="rpr_mpl_id" name="rpr_mpl_id" value="">
							<input type="hidden" id="rpr_kls_id" name="rpr_kls_id" value="">
							<div class="col-lg-6">
								<label>Penilaian Harian</label>
							</div>
							<div class="col-lg-2">
								<input type="number" min="0" class="form-control" id="rpr_ph1" name="rpr_ph1" placeholder="PH 1">
							</div>
							<div class="col-lg-2">
								<input type="number" min="0" class="form-control" id="rpr_ph2" name="rpr_ph2" placeholder="PH 2">
							</div>
							<div class="col-lg-2">
								<input type="number" min="0" class="form-control" id="rpr_ph3" name="rpr_ph3" placeholder="PH 3">
							</div>
							<br><br>
							<div class="col-lg-6">
								<label>Tugas</label>
							</div>
							<div class="col-lg-2">
								<input type="number" min="0" class="form-control" id="rpr_tgs1" name="rpr_tgs1" placeholder="Tugas 1">
							</div>
							<div class="col-lg-2">
								<input type="number" min="0" class="form-control" id="rpr_tgs2" name="rpr_tgs2" placeholder="Tugas 2">
							</div>
							<div class="col-lg-2">
								<input type="number" min="0" class="form-control" id="rpr_tgs3" name="rpr_tgs3" placeholder="Tugas 3">
							</div>
							<br><br>
							<div class="col-lg-6">
								<label>Penilaian Tengah Semester</label>
							</div>
							<div class="col-lg-2">
								<input type="number" min="0" class="form-control" id="rpr_pts" name="rpr_pts" placeholder="PTS">
							</div>
							<br><br>
							<div class="col-lg-6">
								<label>Penilaian Akhir Semester</label>
							</div>
							<div class="col-lg-2">
								<input type="number" min="0" class="form-control" id="rpr_pas" name="rpr_pas" placeholder="PAS">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" id="nhb_simpan" class="btn btn-info">Simpan</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="reset_form()">Batal</button>
					</div>
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
		var filter_mapel = $("#filter_mapel").val();
		if (!filter_mapel) filter_mapel = null;
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
				"url": "ajax_list_peserta_didik/" + filter_kelas + "/" + filter_mapel,
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

	function nilai_hasil_belajar(id, ta, kls, mpl) {
		$("#rpr_pd_id").val(id);
		$("#rpr_ta_id").val(ta);
		$("#rpr_mpl_id").val(mpl);
		$("#rpr_kls_id").val(kls);
		$("frm_hasil_belajar").trigger("reset");
		$('#modal_hasil_belajar').modal({
			show: true,
			keyboard: false,
			backdrop: 'static'
		});
	}

	function edit_nilai_hasil_belajar(id, mpl_id) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "cari",
			// data: "rpr_pd_id=" + id + "/" + mpl_id,
			data: {
				rpr_pd_id: id,
				rpr_mpl_id: mpl_id,
			},
			dataType: "json",
			success: function(data) {
				var obj = Object.entries(data);
				obj.map((dt) => {
					$("#" + dt[0]).val(dt[1]);
				});
				$(".inputan").attr("disabled", false);
				$("#modal_hasil_belajar").modal({
					show: true,
					keyboard: false,
					backdrop: 'static'
				});
				return false;
			}
		});
	}

	$("#frm_hasil_belajar").submit(function(e) {
		e.preventDefault();
		$("#nhb_simpan").html("Menyimpan...");
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
					$("#modal_hasil_belajar").modal("hide");
				} else {
					toastr.error(res.desc);
				}
				$("#nhb_simpan").html("Simpan");
				$(".btn").attr("disabled", false);
			},
			error: function(jqXHR, namaStatus, errorThrown) {
				$("#nhb_simpan").html("Simpan");
				$(".btn").attr("disabled", false);
				alert('Error get data from ajax');
			}
		});
	});

	function reset_form() {
		$("#rpr_id").val(0);
		$("#frm_hasil_belajar")[0].reset();
	}

	$(document).ready(function() {
		drawTable();
	});
</script>