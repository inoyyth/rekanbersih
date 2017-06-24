<div style="margin-bottom: 5px;text-align: right;">
    <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>balance_request/search/<?=$posisi;?>');" class="btn btn-danger" value="Back" />
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Customer Information</h3>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Name</label>
                <input class="form-control small" value="<?=$detail->name;?>" readonly/>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input class="form-control" value="<?=$detail->adress;?>" readonly/>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" value="<?=$detail->email;?>" readonly/>
            </div>
            <div class="form-group">
                <label>Telephone</label>
                <input class="form-control" value="<?=$detail->tlp;?>" readonly/>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Account Name</label>
                <input class="form-control" value="<?=$detail->account_name;?>" readonly/>
            </div>
            <div class="form-group">
                <label>Bank Name</label>
                <input class="form-control" value="<?=$detail->bank_name;?>" readonly/>
            </div>
            <div class="form-group">
                <label>Rekening Number</label>
                <input class="form-control" value="<?=$detail->rekening;?>" readonly/>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Request Information</h3>
    </div>
    <div class="panel-body">
        <h4 style="text-align: center;">Rp. <?=formatrp($detail->balance_request);?></h4>
        <h5 style="text-align: center;">Status: <?=($detail->status=="N"?"Pending":"Transfered");?></h5>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Wallet Transfered</h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <label>Account Name</label>
            <input type="text" name="account_name" id="account_name" value="<?=$detail->transfer_account;?>" class="form-control">
            <input type="hidden" name="id_wallet" id="id_wallet" value="<?=$detail->id;?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Rekening</label>
            <input type="text" name="rekening" id="rekening" class="form-control" value="<?=$detail->transfer_rekening;?>">
        </div>
        <div class="form-group">
            <label>Date</label>
            <input type="text" name="date" id="date" class="form-control datepicker" value="<?=$detail->transfer_date;?>">
        </div>
        <div>
            <input type="button" value="Save" class="btn btn-primary" id="save-wallet"/>
        </div>
    </div>
</div>
<?php $this->load->view('combobox_autocomplete');?>
<script type="text/javascript">
    $(document).ready(function(){
        var status_request='<?=$detail->status;?>';
        if(status_request==="Y"){
            $("#save-wallet").attr('disabled','true');
        }else{
            $("#save-wallet").removeAttr('disabled');
        }
    $("#save-wallet").click(function(){
         var account_name=$("#account_name").val();
         var rekening=$("#rekening").val();
         var date=$("#date").val();
         var id_wallet=$("#id_wallet").val();
         if(account_name==="" || rekening==="" || date===""){
             alert('Please Fill All Textfield !!!');
         }else{
            if(confirm('Are sure to process ?')){
                $.ajax({
                    type:'post',
                    url:"<?=base_url();?>balance_request/update_wallet",
                    data: {id_wallet:id_wallet,account:account_name,rekening:rekening,date:date},
                    success: function(data){
                        location.reload();
                    }
                });
            }
         }
      }); 
});
</script>