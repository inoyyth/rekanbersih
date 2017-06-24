
<script>
    var i = <?=count($list_sale);?>; 
    function tambah(){
      i++;
      var add_sale = '<div id="content-product-sale'+i+'">\n\
                    <div class="form-group col-lg-6">\n\
                        <label>Quota</label>\n\
                        <select class="form-control" style="width: 100%;font-size: 15px;" required name="quota[]">\n\
                            <?php for($x=1;$x<=200;$x++){ ?>\n\
                                <option value="<?=$x;?>"> <?=$x;?> </option>\n\
                            <?php } ?>\n\
                        </select>\n\
                    </div>\n\
                    <div class="form-group col-lg-6">\n\
                        <label>Price</label>\n\
                        <input type="number" onkeypress="return validate(event)" class="form-control" name="price[]" required="true"/>\n\
                    </div>\n\
                    <div><div class="clearfix"></div>';
      $("#content-product-sale").append(add_sale);
    };

    function kurang() {
      if(i>0){
        $("#content-product-sale"+i).remove();
        i--;
      } else {
        i = 1;
      }
    };
</script>
<form method="post" action="<?=base_url();?>product_sale/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>product_sale/search/<?=$posisi;?>');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Update Product Sale </h3>
    </div>
    <div class="panel-body" id="content-product-sale">
        <div class="col-lg-12 pull-left">
            <input type="button" class="btn btn-warning" value=" + " onclick="tambah()"/> 
            <input type="button" class="btn btn-warning" value=" - " onclick="kurang()"/>
            <input type="button" class="btn btn-danger" value="Reload" onclick="location.reload()"/>
        </div>
        <div class="form-group col-lg-12">
            <label>Product</label> <input type="hidden" name="posisi" value="<?=$posisi;?>"/>
            <select class="combobox" style="width: 100%;font-size: 15px;" required name="product">
                <option value="">--select product--</option>
                <?php
                    $d=1;
                    foreach($list_product as $list_productx){
                        if($id_product==$list_productx->id_product){
                            $cek="selected";
                        }else{
                            $cek="";
                        }
                        echo"<option value='$list_productx->id_product' $cek>$list_productx->product_name</option>";
                    }
                ?>
            </select>
        </div>
        <?php foreach($list_sale as $list_salex){?>
        <div id="content-product-sale<?=$d;?>">
            <div class="form-group col-lg-6">
                <label>Quota</label>
                <select class="form-control" style="width: 100%;font-size: 15px;" required name="quota[]">
                    <?php
                        for($i=1;$i<=200;$i++){
                            if($list_salex->kuota==$i){
                                $cek_quota="selected";
                            }else{
                                $cek_quota="";
                            }
                            echo"<option value='$i' $cek_quota> $i </option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label>Price</label>
                <input type="number" value="<?=$list_salex->kuota_price;?>" onkeypress="return validate(event)" class="form-control" name="price[]" required="true">
            </div>
        </div>
        <div class="clearfix"></div>
        <?php $d++; } ?>
    </div>
</div>
</form>
<?php $this->load->view('combobox_autocomplete'); ?>