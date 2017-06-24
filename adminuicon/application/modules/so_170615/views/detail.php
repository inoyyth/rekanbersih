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
            <h5 style="text-align: right;"><?=formatrp($so->cut_price);?></h5>
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
                <?=formatrp($cost->expedition_price);?>
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
                    }
                    if($so->status=="deliver"){
                        $open="";
                        $delivery="selected";
                        $close="";
                    }
                    if($so->status=="close"){
                        $open="";
                        $delivery="";
                        $close="selected";
                    }
                ?>
                <option value="open" <?=$open;?>>Open</option>
                <option value="deliver" <?=$delivery;?>>Deliver</option>
                <option value="close" <?=$close;?>>Close</option>
            </select>
        </div>
        <div class="form-group" id="tracker" style="display: none;">
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
<?php $this->load->view('combobox_autocomplete');?>
<script>
    $(document).ready(function(){
        $("#save-order-status").click(function(){
          var order_status=$("#order-status").val();
          var tracking = $("#tracking_number").val();
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
                        data: {id_so:id_so,order_status:order_status,id_user:id_user,tracking_number:tracking},
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
    });
    
    function send_mail(email,id_so){
        $('#myModalNewsletter').modal('show');
    }
</script>