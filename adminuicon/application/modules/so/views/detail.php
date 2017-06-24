<ol class="breadcrumb">
    <li> Report</li>
    <li> Sales Order</li>
    <li class="active"> Detail<li>
</ol>
<div style="margin-bottom: 5px;text-align: right;">
    <button onclick="send_mail('<?=$so->email;?>','<?=$so->id_so;?>');" class="btn btn-default"><i class="fa fa-envelope-o"></i>Send Email</button>
    <!--<input type="button" onclick="window.location.replace('<?php echo base_url(); ?>so/search/<?=$posisi;?>');" class="btn btn-primary" value="Save" /> -->
    <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>so/search/<?=$posisi;?>');" class="btn btn-danger" value="Back" />
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Customer Information</h3>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Id</label>
                <input class="form-control small" value="<?=$so->customer;?>" readonly/>
            </div>
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" value="<?=$so->name;?>" readonly/>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input class="form-control" value="<?=$so->adress;?>" readonly/>
            </div>
            <div class="form-group">
                <label>Province</label>
                <?php
                    $this->load->database('desalite',true);
                    $province=$this->db->query("select provinsi from provinsi where id='$so->province'")->row();
                ?>
                <input class="form-control" value="<?=$province->provinsi;?>" readonly/>
            </div>
            <div class="form-group">
                <label>City</label>
                <?php
                    $this->load->database('desalite',true);
                    $kabupaten=$this->db->query("select kabupaten from kabupaten where id='$so->city'")->row();
                ?>
                <input class="form-control" value="<?=$kabupaten->kabupaten;?>" readonly/>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Contact</label>
                <input class="form-control" value="<?=$so->contact;?>" readonly/>
            </div>
            <div class="form-group">
                <label>Telephone</label>
                <input class="form-control" value="<?=$so->tlp;?>" readonly/>
            </div>
            <div class="form-group">
                <label>Fax</label>
                <input class="form-control" value="<?=$so->fax;?>" readonly/>
            </div>
             <div class="form-group">
                <label>Email</label>
                <input class="form-control" value="<?=$so->email;?>" readonly/>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Pre Sales Order Detail <b>(<?=$so->so_number;?>)</b></h3>
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
        <?php foreach($pre_so_finish_product as $so_finish_productx){?>
        <div class="col-sm-4">
            <h5><?=$so_finish_productx->product_name;?></h5>
            <h6><?=$so_finish_productx->product_code;?></h6>
        </div>
        <div class="col-sm-2">
            <h5><?=$so_finish_productx->qty;?></h5>
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
            <h5 style="text-align: right;"><?=formatrp($pre_so->sub_total);?></h5>
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
            <h5 style="text-align: right;">(-) <?=formatrp($pre_so->cut_price);?></h5>
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
                    $cost=$this->db->query("select * from so_shipping where id_so='$pre_so->so'")->row();
                ?>
                (+) <?=formatrp($cost->expedition_price);?>
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
            <h5 style="text-align: right;"><?=formatrp($pre_so->total_price);?></h5>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Shipping Information</h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <label>Expedition Name</label>
            <input type="hidden" name="shipping_id" id="shipping_id" value="<?=$shipping_exp->id;?>"/>
            <input class="form-control" type="text" name="exp_name" id="exp_name" value="<?=$shipping_exp->expedition_name;?>"/>
        </div>
        <div class="form-group">
            <label>Expedition Service Name</label>
            <input class="form-control" type="text" name="exp_service_name" id="exp_service_name" value="<?=$shipping_exp->expedition_service;?>"/>
        </div>
        <div class="form-group">
            <label>Expedition Price</label>
            <input class="form-control rupiah" type="text" name="exp_price" id="exp_price" value="<?=formatrp($shipping_exp->expedition_price);?>"/>
            <input class="form-control" type="hidden" name="exp_price_before" id="exp_price_before" value="<?=$shipping_exp->expedition_price;?>"/>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" id="save_exp">Save</button>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Sales Order Detail <b>(<?=$so->so_number;?>)</b></h3>
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
            <select name="so_qty" id="so_qty" onchange="change_qty($(this).val(),'<?=$so_finish_productx->id_so_finish_product;?>','<?=$so_finish_productx->so;?>');">
                <?php
                    for($i=0;$i<=100;$i++){
                        if($i==$so_finish_productx->qty){
                            $cek="selected";
                        }else{
                            $cek="";
                        }
                ?>
                <option value="<?=$i;?>" <?=$cek;?>><?=$i;?></option>
                <?php } ?>
            </select>
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
            <h5 style="text-align: right;"><?=formatrp($so->total_price);?></h5>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Email Infromation</h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <textarea name="email_information" id="email_information" class="form-control"><?=$so->email_information;?></textarea>
        </div>
    </div>
</div>
<div style="padding-bottom: 5%;">
    <button class="btn btn-warning col-lg-12" id="send_email_confirmation">Send Email Confirmation</button>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Payment Status</h3>
    </div>
    <div class="panel-body">
        <?php
            if($payment_confirmation->num_rows() < 1){
        ?>
        <center>Not Payment Confirmed</center>
        <?php
            }else{
        ?>
        <center>Peyment confirmed with status <b><?php echo $payment_confirmation->row('status');?></b></center>
        <?php } ?>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Sales Order Status</h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <label>Order Status</label>
            <select class="form-control" id="order-status">
                <?php
                    if($so->status=="open"){
                        $open="selected";
                        $delivery="";
                        $close="";
                        $waiting="";
                        $confirmed="";
                    }
                    if($so->status=="deliver"){
                        $open="";
                        $delivery="selected";
                        $close="";
                        $waiting="";
                        $confirmed="";
                    }
                    if($so->status=="close"){
                        $open="";
                        $delivery="";
                        $close="selected";
                        $waiting="";
                        $confirmed="";
                    }
                    if($so->status=="waiting"){
                        $open="";
                        $delivery="";
                        $close="";
                        $waiting="selected";
                        $confirmed="";
                    }
                    if($so->status=="confirmed"){
                        $open="";
                        $delivery="";
                        $close="";
                        $waiting="";
                        $confirmed="selected";
                    }
                ?>
                <option value="open" <?=$open;?>>Open</option>
                <option value="confirmed" <?=$confirmed;?>>Confirmed</option>
                <option value="waiting" <?=$waiting;?>>Waiting</option>
                <?php 
                    if($payment_confirmation->num_rows() > 0){
                        if($payment_confirmation->row('status')=="validate"){
                ?>       
                <option value="deliver" <?=$delivery;?>>Deliver</option>
                <?php 
                        }
                    }
                ?>
                <option value="close" <?=$close;?>>Close</option>
            </select>
        </div>
        <div class="form-group" id="tracker" style="display: none;">
            <!--<label>PO Number</label>
            <input type="text" name="po_number" id="po_number" class="form-control" required>-->
            <label>Tracking Number</label>
            <input type="text" name="tracking_number" id="tracking_number" class="form-control" required>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" id="save-order-status">Save</button>
        </div>
    </div>
</div>
<div class="modal fade" id="myModalNewsletter">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                Thanks for Submit your email. Wait for our promotion's other to your email.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="myModalSOerror">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="myModalSOerror-header"></h4>
            </div>
            <div class="modal-body" id="myModalSOerror-body"></div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<?php $this->load->view('combobox_autocomplete');?>
<script>
    $(document).ready(function(){
        var status_pesanan="<?php echo $so->status;?>";
        if(status_pesanan === "deliver" || status_pesanan==="close" || status_pesanan==="confirmed"){
            $("#send_email_confirmation").attr('disabled','true');
        }
        $("#save-order-status").click(function(){
          var order_status=$("#order-status").val();
          var tracking = $("#tracking_number").val();
          var po_number=$("#po_number").val();
          var id_user = "<?=$so->customer;?>";
          var id_so="<?=$so->id_so;?>";
          if(confirm('Are You Sure To Update This Sales Order To '+order_status)){
            if(order_status==="deliver"){
                if(tracking===""){
                    alert('Please Fill Tracking Number');
                }else{
                    $.ajax({
                        type: 'post',
                        url: '<?= base_url(); ?>so/update_so_status',
                        data: {id_so:id_so,order_status:order_status,id_user:id_user,tracking_number:tracking,po_number:po_number},
                        cache: false,
                        success: function (data) {
                            window.location.reload();
                        }
                    });
                }
            }else{
                $.ajax({
                    type: 'post',
                    url: '<?= base_url(); ?>so/update_so_status',
                    data: {id_so:id_so,order_status:order_status,id_user:id_user,tracking_number:tracking},
                    cache: false,
                    success: function (data) {
                        window.location.reload();
                    }
                });
            }
          } 
        });
        $("#order-status").change(function(){
            var isi = $(this).val();
            if(isi==="deliver"){
                $("#tracker").show();
            }else{
                $("#tracker").hide();
            }
        });
        $("#save_exp").click(function(){
            var tanya=confirm('Are Your Sure Update This Expedition ?');
            if(tanya===true){
                var exp_price=$("#exp_price").val();
                var exp_service=$("#exp_service_name").val();
                var exp_name=$("#exp_name").val();
                var shipping_id=$("#shipping_id").val();
                var so_number="<?=$so->id_so;?>";
                var so_total_price="<?=$so->total_price;?>";
                var exp_price_before=$("#exp_price_before").val();
                if(exp_name==="" || exp_name==="manual"){
                    $("#myModalSOerror-header").text("Error");
                    $("#myModalSOerror-body").text("Please Fill or Change Expedition Name");
                    $("#myModalSOerror").modal('show');
                }else if(exp_service==="" || exp_service==="manual service"){
                    $("#myModalSOerror-header").text("Error");
                    $("#myModalSOerror-body").text("Please Fill or Change Expedition Service Name");
                    $("#myModalSOerror").modal('show');
                }else if(exp_price < 1){
                    $("#myModalSOerror-header").text("Error");
                    $("#myModalSOerror-body").text("Please Fill or Change Expedition Price");
                    $("#myModalSOerror").modal('show');
                }else{
                    $.ajax({
                    type: 'post',
                    url:  '<?= base_url(); ?>so/update_expedition',
                    data: {shipping_id:shipping_id,exp_price:exp_price,exp_name:exp_name,exp_service_name:exp_service,so_number:so_number,so_total_price:so_total_price,exp_price_before:exp_price_before},
                    cache: false,
                    success: function (data) {
                        window.location.reload();
                        }
                    });
                }
            }
        });
        $("#send_email_confirmation").click(function(){
            var email_information = $("#email_information").val();
            //alert(email_information);
            var id_so="<?=$so->id_so;?>";
            var customer="<?=$so->customer;?>";
            $.ajax({
                type: 'post',
                url:  '<?= base_url(); ?>so/send_email_confirmation',
                data: {email_information:email_information,id_so:id_so,customer:customer},
                cache: false,
                beforeSend: openloading(),
                success: function (data) {
                   // window.location.reload();
                },
                complete:function(){
                        closeloading();
                        window.location.reload();
                    }
            });
        });
    });
    
    function send_mail(email,id_so){
        $('#myModalNewsletter').modal('show');
    }
    
    function change_qty(jum,id_so_finish,so){
        var exp_price_before=$("#exp_price_before").val();
        $.ajax({
            type: 'post',
            url:  '<?= base_url(); ?>so/update_qty',
            data: {id_so_finish:id_so_finish,jum:jum,so:so,exp_price_before:exp_price_before},
            cache: false,
            success: function (data) {
                window.location.reload();
            }
        });
    }
    function openloading(){
            $("#bgx").show();
    }
    function closeloading(){
            $("#bgx").hide();
    }
</script>