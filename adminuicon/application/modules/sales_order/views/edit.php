<form method="post" action="<?=base_url();?>sales_order/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>sales_order/search/<?=$posisi;?>');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Update Sales Order </h3>
    </div>
    <div class="panel-body" id="panelx">
		<div class="col-lg-6">
			<div class="form-group">
				<label>ID</label><input type="hidden" name="posisi" value="<?=$posisi;?>"/>
				<input class="form-control" type="text" name="id" value="<?=$list_detail->id;?>" readonly/>
			</div>
			<div class="form-group">
				<label>Nama</label>
				<input type="text" class="form-control" value="<?php echo $list_detail->nama;?>" readonly="true">
			</div>
			<div class="form-group">
				<label>Handphone</label>
				<input type="text" class="form-control" value="<?php echo $list_detail->handphone;?>" readonly="true">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="text" class="form-control" value="<?php echo $list_detail->email;?>" readonly="true">
			</div>
			<div class="form-group">
				<label>Tanggal</label>
				<input type="text" class="form-control" value="<?php echo $list_detail->tanggal;?>" readonly="true">
			</div>
			<div class="form-group">
				<label>Kota</label>
				<input type="text" class="form-control" value="<?php echo $list_detail->kota;?>" readonly="true">
			</div>
			<div class="form-group">
				<label>Tipe Paket</label>
				<input type="text" class="form-control" style="text-transform: capitalize;" value="<?php echo $list_detail->tipe_paket;?>" readonly="true">
			</div>
		</div>
		<div class="col-lg-6">
			<?php if($list_detail->tipe_paket == "utama") { ?>
			<div class="form-group">
				<label>Durasi Paket</label>
				<input type="text" class="form-control" style="text-transform: capitalize;" value="<?php echo $list_detail->durasi_paket;?>" readonly="true">
			</div>
			<?php } else if ($list_detail->tipe_paket == "berkala") { ?>
			<div class="form-group">
				<label>Schedule Kunjungan</label>
				<input type="text" class="form-control" style="text-transform: capitalize;" value="<?php echo $list_detail->schedule_visit;?>" readonly="true">
			</div>
			<?php } else { ?>
			<div class="form-group">
				<label>Tipe Service</label>
				<input type="text" class="form-control" style="text-transform: capitalize;" value="<?php echo $list_detail->service_type;?>" readonly="true">
			</div>
			<?php } ?>
			<div class="form-group">
				<label>Alamat</label>
				<textarea class="form-control" readonly="true"><?php echo $list_detail->alamat;?></textarea>
			</div>
			<div class="form-group">
				<label>Note</label>
				<textarea class="form-control" readonly="true"><?php echo $list_detail->catatan;?></textarea>
			</div>
			<div class="form-group">
				<label>Status</label>
				<select name="status" class="form-control">
					<option value="1" <?php echo ($list_detail->status==1?'selected':'');?>>Waiting</option>
					<option value="2" <?php echo ($list_detail->status==2?'selected':'');?>>Follow Up</option>
					<option value="3" <?php echo ($list_detail->status==3?'selected':'');?>>Not Response</option>
					<option value="4" <?php echo ($list_detail->status==4?'selected':'');?>>Done</option>
				</select>
			</div>
			<div class="form-group">
				<label>Remark</label>
				<textarea class="form-control" name="remark"><?php echo $list_detail->remark;?></textarea>
			</div>
		</div>
</div>
    </div>
</form>
<?php $this->load->view('combobox_autocomplete');?>
<?php $this->load->view('combo2');?>
<?php $this->load->view('ckeditor');?>
<script type="text/javascript">
    $(document).ready(function(){
		$("#category").change(function(){
			 var id = $("#category").val();
			 $.ajax({
				 type:'post',
				 url:"<?=base_url();?>sales_order/get_subcategory",
				 data: "id="+id,
				 success: function(data){
					 $("#subcategory").html(data);
				}
			});
		}); 
});

function TampilModel(file){
	$('#filetree-modal').modal('show');
	$('#filetree-content').load(file);
}
</script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'editor1',
    {
        filebrowserBrowseUrl: '<?php echo base_url();?>assets/elfinder-2.1.24/elfinder.html',
        filebrowserUploadUrl: '<?php echo base_url();?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });
</script>