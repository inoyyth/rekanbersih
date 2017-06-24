<ol class="breadcrumb">
    <li></i> Report</li>
    <li class="active"></i> Update Payment Confirmation</li>
</ol>
<div style="margin-bottom: 5px;text-align: right;">
   <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>payment_confirmation');" class="btn btn-danger btn-sm" value="Back" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Sales Order </h3>
    </div>
    <div class="panel-body">
            <div class="col-sm-4">
                <h5 style="border-bottom: 1px solid;">Product Name</h5>
            </div>
            <div class="col-sm-2">
                <h5 style="border-bottom: 1px solid;">Qty</h5>
            </div>
            <div class="col-sm-3">
                <h5 style="border-bottom: 1px solid;">Price</h5>
            </div>
            <div class="col-sm-3">
                <h5 style="border-bottom: 1px solid;">Total Price</h5>
            </div>

            <div class="clearfix"></div>
            <?php foreach($so_finish_product as $so_finish_productx){?>
            <div class="col-sm-4">
                <h5><?=$so_finish_productx->product_name;?></h5>
                <h6><?=$so_finish_productx->product_code;?></h6>
            </div>
            <div class="col-sm-2">
                <?php echo $so_finish_productx->qty;?>
            </div>
            <div class="col-sm-3">
                <h5 style="text-align: right;"><?=formatrp($so_finish_productx->unit_price);?></h5>
            </div>
            <div class="col-sm-3">
                <h5 style="text-align: right;"><?=formatrp($so_finish_productx->total_price);?></h5>
            </div>
            <div class="clearfix"></div>
            <?php } ?>

            <div class="clearfix"></div>

            <div class="col-sm-4">

            </div>
            <div class="col-sm-2">

            </div>
            <div class="col-sm-3">

            </div>
            <div class="col-sm-3">
                <h5 style="border-bottom: 1px solid;text-align: right;"> + </h5>
            </div>

            <div class="clearfix"></div>

            <div class="col-sm-4">

            </div>
            <div class="col-sm-2">

            </div>
            <div class="col-sm-3">
                <h5 style="text-align: right;">Sub Total:</h5>
            </div>
            <div class="col-sm-3">
                <h5 style="text-align: right;"><?=formatrp($so->sub_total);?></h5>
            </div>

            <div class="clearfix"></div>

             <div class="col-sm-4">

            </div>
            <div class="col-sm-2">

            </div>
            <div class="col-sm-3">
                <h5 style="text-align: right;">From Wallet:</h5>
            </div>
            <div class="col-sm-3">
                <h5 style="text-align: right;">(-) <?=formatrp($so->cut_price);?></h5>
            </div>

            <div class="clearfix"></div>

             <div class="col-sm-4">

            </div>
            <div class="col-sm-2">

            </div>
            <div class="col-sm-3">
                <h5 style="text-align: right;">Shipping Price:</h5>
            </div>
            <div class="col-sm-3">
                <h5 style="text-align: right;">
                    <?php
                        $this->load->database('desalite',true);
                        $cost=$this->db->query("select * from so_shipping where id_so='$so->id_so'")->row();
                    ?>
                    (+) <?=formatrp($cost->expedition_price);?>
                    <input type="hidden" name="so_price" id="so_price" value="<?=$cost->expedition_price;?>"/>
                </h5>
            </div>
        
            <div class="clearfix"></div>

             <div class="col-sm-4">

            </div>
            <div class="col-sm-2">

            </div>
            <div class="col-sm-3">
                <h5 style="text-align: right;">Total:</h5>
            </div>
            <div class="col-sm-3">
                <h5 style="text-align: right;"><b><?=formatrp($so->total_price);?></b></h5>
            </div>
    </div>
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Payment Confirmation </h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <label>SO Number</label>
            <input class="form-control" type="text" value="<?=$payment_confirmation->so_number;?>" readonly/>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" type="text" value="<?=$payment_confirmation->name;?>" readonly/>
        </div>
        <div class="form-group">
            <label>Bank Name</label>
            <input class="form-control" type="text" value="<?=$payment_confirmation->bank_name;?>" readonly/>
        </div>
        <div class="form-group">
            <label>Account Name</label>
            <input class="form-control" type="text" value="<?=$payment_confirmation->account_name;?>" readonly/>
        </div>
        <div class="form-group">
            <label>Refrence Number</label>
            <input class="form-control" type="text" value="<?=$payment_confirmation->refrence_number;?>" readonly/>
        </div>
        <div class="form-group">
            <label>Transfer Date</label>
            <input class="form-control" type="text" value="<?=tgl_indo($payment_confirmation->transfer_date);?>" readonly/>
        </div>
        <div class="form-group">
            <label>Total Amount</label>
            <input class="form-control" type="text" value="<?=$payment_confirmation->total_amount;?>" readonly/>
        </div>
    </div>
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Payment Confirmation Status </h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <label>Status</label>
            <select name="status" id="status" class="form-control">
            <?php
                if($payment_confirmation->status=="not cek"){
                    $not_cek="selected";
                    $validate="";
                    $failed="";
                }
                if($payment_confirmation->status=="validate"){
                    $not_cek="";
                    $validate="selected";
                    $failed="";
                }
                if($payment_confirmation->status=="failed"){
                    $not_cek="";
                    $validate="";
                    $failed="selected";
                }
            ?>
            <option value="not cek" <?=$not_cek;?>>Not Check</option>
            <option value="validate" <?=$validate;?>>Validate</option>
            <option value="failed" <?=$failed;?>>Failed</option>
        </select>
    </div>
</div>
<?php $this->load->view('combobox_autocomplete');?>
<script>
    $(document).ready(function(){
        $("#status").change(function(){
           var tanya = confirm("Are you sure to change 'status' to "+$("#status").val()); 
           if(tanya){
               var so="<?php echo $payment_confirmation->so_number;?>";
               var status = $("#status").val();
               $.ajax({
                    type: 'post',
                    url: '<?= base_url(); ?>payment_confirmation/update_status',
                    data: {so:so,status:status},
                    cache: false,
                    beforeSend: openloading(),
                    success: function (data) {
                        
                    },
                    complete:function(){
                        closeloading();
                    }
               });
           }else{
            $("#status").val("<?php echo $payment_confirmation->status;?>");   
           }
        });
    });
    function openloading(){
            $("#bgx").show();
    }
    function closeloading(){
            $("#bgx").hide();
    }
</script>