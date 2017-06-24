<script src="<?php echo base_url(); ?>themes/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<h2>Pembersihan Utama</h2>
<hr>
<form method="post" id="form-inquiry-utama" action="<?php echo site_url();?>product/save_pembersihan_utama">
<div class="row">
	<div class="col-lg-6">
		<div class="form-group">
			<label>Nama*</label>
			<input class="form-control" type="text" name="nama" required="true">
		</div>
		<div class="form-group">
			<label>No Handphone*</label>
			<input class="form-control" type="text" name="handphone" required="true">
		</div>
		<div class="form-group">
			<label>Tanggal*</label>
			<input class="form-control datepicker" name="tanggal" readonly="true" type="text" required="true">
		</div>
	</div>
	<div class="col-lg-6">
		<div class="form-group">
			<label>Email*</label>
			<input class="form-control" type="email" name="email" required="true">
		</div>
		<div class="form-group">
			<label>Pilih Durasi Paket*</label>
			<select class="form-control" name="durasi_paket">
				<option value="" disabled selected>- Pilih Durasi Paket -</option>
				<?php foreach($durasi_paket as $k=>$v) {?>
					<option value="<?php echo $v['id'];?>"><?php echo $v['durasi_paket'];?></option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group">
			<label>Kota*</label>
			<select class="form-control" name="kota">
				<option value="" disabled selected>- Pilih Kota Tinggal Anda -</option>
				<?php foreach($kota as $k=>$v) {?>
					<option value="<?php echo $v['id'];?>"><?php echo $v['kota'];?></option>
				<?php } ?>
			</select>
		</div>
	</div>
</div> 
<div class="row">
	<div class="col-lg-6">
		<div class="form-group">
			<label>Alamat*</label>
			<textarea class="form-control" name="alamat"></textarea>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="form-group">
			<label>Catatan*</label>
			<textarea class="form-control" name="catatan"></textarea>
		</div>
		<button id="submit-utama" type="submit" class="btn btn-success">Kirim Permintaan</button>
	</div>
</div>
<br>
<div class="row">
	<div class="col-lg-12">
		<div id="sendmessage" class="utama-success">Terima kasih telah mengisi form booking, kami akan segera menghubungi Anda.</div>
		<div id="errormessage" class="utama-error">Maaf sedang ada gangguan teknis di system kami. Terima Kasih.</div>
	</div>
</div>
<script>
	$(document).ready(function (){
		$('#form-inquiry-utama')[0].reset();
		$('.datepicker').datepicker({
			format: "yyyy-mm-dd",
			autoclose: true,
			minViewMode:0,
			startDate: new Date()
		});
		
		$("#form-inquiry-utama").submit(function(e) {
			var $btn = $("#submit-utama").button('loading');
			var url = $(this).attr('action');
			$.ajax({
				   type: "POST",
				   dataType:"json",
				   url: url,
				   data: $("#form-inquiry-utama").serialize(), // serializes the form's elements.
				   success: function(e){
					   if(e.code === 200) {
						   $(".utama-success").show();
						   setTimeout(function(){ $(".utama-success").hide(1000); }, 5000);
						   $btn.button('reset');
						   $('#form-inquiry-utama')[0].reset();
					   } else {
						   $(".utama-error").show();
						   setTimeout(function(){ $(".utama-error").hide(1000); }, 5000);
						   $btn.button('reset');
					   }
					   //alert(data); // show response from the php script.
				   },
				   error: function(e){
					   $(".utama-error").show();
					   setTimeout(function(){ $(".utama-error").hide(1000); }, 5000);
					   $btn.button('reset');
				   }
				 });
			e.preventDefault(); // avoid to execute the actual submit of the form.
		});
	});
</script>