<?php error_reporting(0);?>
<form method="post" action="<?=base_url();?>product_management/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>product_management/search/<?=$posisi;?>');" class="btn btn-danger" value="Cancel" />
</div>
<div class="tabs">
	<ul>
		<li><a href="#tabs-1">General Info</a></li>
		<li><a href="#tabs-2">Detail</a></li>
                <li><a href="#tabs-4">Other Information</a></li>
	</ul>
	<div id="tabs-1">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Product Name</label><input type="hidden" name="posisi" value="<?=$posisi;?>"/><input type="hidden" name="id" value="<?=$detail->id_product;?>"/>
                        <input class="form-control" name="product_name" value="<?=$detail->product_name;?>" required>
                    </div>
                    <div class="form-group">
                        <label>Product Code</label>
                        <input class="form-control" name="product_code" value="<?=$detail->product_code;?>" required>
                    </div>
                    <div class="form-group">
                        <label>Key Word</label>
                        <input class="form-control" name="keyword" value="<?=$detail->keyword;?>" placeholder="Ex: toko air, filter air, galon" required>
                    </div>
                    <div class="form-group">
                        <label>Product Type</label>
                        <select name="product_type" class="combobox" required>
                            <?php 
                                foreach($type as $typex){
                                    if($detail->type==$typex->id_type_material){
                                        $cek_type="selected";
                                    }else{
                                        $cek_type="";
                                    }
                            ?>
                            <option value="<?=$typex->id_type_material;?>" <?=$cek_type;?>><?=$typex->type_material;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Category</label>
                        <select name="product_category" class="combobox" required>
                            <?php 
                                foreach($category as $categoryx){
                                    if($detail->product_category==$categoryx->id_product_category){
                                        $cek_category="selected";
                                    }else{
                                        $cek_category="";
                                    }
                            ?>
                            <option value="<?=$categoryx->id_product_category;?>" <?=$cek_category;?>><?=$categoryx->product_category;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Merk</label>
                        <select name="product_merk" class="combobox" required>
                            <?php 
                                foreach($merk as $merkx){
                                    if($detail->merk==$merkx->id_merk){
                                        $cek_merk="selected";
                                    }else{
                                        $cek_merk="";
                                    }
                            ?>
                            <option value="<?=$merkx->id_merk;?>" <?=$cek_merk;?>><?=$merkx->name;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Description</label>
                        <textarea name="description" id="editor1" rows="10" cols="80"><?=$detail->description;?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Hot Product</label>
                        <select name="hot_product" class="combobox" required>
                            <?php 
                            if($detail->hot_product=="0"){
                                $hot_no="selected";
                                $hot_yes="";
                            }else{
                                $hot_no="";
                                $hot_yes="selected";
                            }
                            ?>
                            <option value="0" <?=$hot_no;?>>No</option>
                            <option value="1" <?=$hot_yes;?>>Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Exclusive Product</label>
                        <select name="exclusive_product" class="combobox" required>
                            <?php 
                            if($detail->exclusive_product=="0"){
                                $exc_no="selected";
                                $exc_yes="";
                            }else{
                                $exc_no="";
                                $exc_yes="selected";
                            }
                            ?>
                            <option value="0" <?=$exc_no;?>>No</option>
                            <option value="1" <?=$exc_yes;?>>Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Stock Status</label>
                        <select name="stock_status" class="combobox" required>
                            <?php
                                if($detail->stock_status=="1"){
                                    $ready="selected";
                                    $party="";
                                    $indent="";
                                }
                                if($detail->stock_status=="2"){
                                    $ready="";
                                    $party="selected";
                                    $indent="";
                                }
                                if($detail->stock_status=="2"){
                                    $ready="";
                                    $party="";
                                    $indent="selected";
                                }
                            ?>
                            <option value="1" <?=$ready;?>>Ready Stock</option>
                            <option value="2" <?=$party;?>>3thparty</option>
                            <option value="3" <?=$indent;?>>Indent</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Active</label>
                        <select name="product_active" class="combobox" required>
                            <?php
                                if($detail->is_active=="1"){
                                    $active_y="selected";
                                    $active_n="";
                                }else{
                                    $active_y="";
                                    $active_n="selected";
                                }
                            ?>
                            <option value="1" <?=$active_y;?>>Active</option>
                            <option value="0" <?=$active_n;?>>Not Active</option>
                        </select>
                    </div>
                </div>
            </div>
	</div>
	<div id="tabs-2">
            <div class="panel-body" id="panelx">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Normal Price</label>
                            <input type="text" class="form-control" onkeypress="return validate(event)" name="normal_price" value="<?=$detail->cost_price;?>" required>
                        </div>
                        <div class="form-group">
                            <label>Special Price</label>
                            <input type="text" class="form-control" onkeypress="return validate(event)" name="special_price" value="<?=$detail->special_price;?>" required>
                        </div>
                        <div class="form-group">
                            <label>Afiliasi Price</label>
                            <input type="text" class="form-control" name="afiliasi_price" value="<?=$detail->afiliasi_price;?>" onkeypress="return validate(event)" required>
                        </div>
                        <!--<div class="form-group">
                            <label>Resellser Minimum Quota</label>
                            <input type="text" class="form-control" name="reseller_quota" value="<?=$detail->reseller_quota;?>" onkeypress="return validate(event)" required>
                        </div>-->
                        <div class="form-group">
                            <label>Product Unit</label>
                            <select name="product_unit" class="combobox" required>
                                <?php 
                                    foreach($unit as $unitx){
                                        if($detail->unit==$unitx->id_unit_measure){
                                            $cek_unit="selected";
                                        }else{
                                            $cek_unit="";
                                        }
                                ?>
                                <option value="<?=$unitx->id_unit_measure;?>" <?=$cek_unit;?>><?=$unitx->name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Finish Product</label>
                            <select name="product_finish" class="combobox" required>
                                <?php
                                    if($detail->is_finis_product=="1"){
                                        $finish_y="selected";
                                        $finish_n="";
                                    }else{
                                        $finish_y="";
                                        $finish_n="selected";
                                    }
                                ?>
                                <option value="1" <?=$finish_y;?>>Yes</option>
                                <option value="0" <?=$finish_n;?>>Not</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Product Valuation</label>
                            <select name="product_valuation" class="combobox" required>
                                <?php
                                    if($detail->is_material_valuation=="1"){
                                        $valuation_y="selected";
                                        $valuation_n="";
                                    }else{
                                        $valuation_y="";
                                        $valuation_n="selected";
                                    }
                                ?>
                                <option value="1" <?=$valuation_y;?>>Yes</option>
                                <option value="0" <?=$valuation_n;?>>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Product Service</label>
                            <select name="product_service" class="combobox" required>
                                <?php
                                    if($detail->is_service=="1"){
                                        $service_y="selected";
                                        $service_n="";
                                    }else{
                                        $service_y="";
                                        $service_n="selected";
                                    }
                                ?>
                                <option value="1" <?=$service_y;?>>Yes</option>
                                <option value="0" <?=$service_n;?>>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Weight(Kg)</label>
                            <input class="form-control" name="product_weight" value="<?=$detail->weight;?>" placeholder="Weight (Kg)">
                        </div>
                        <div class="form-group">
                            <label>Volume(m3)</label>
                            <input class="form-control" name="product_volume" value="<?=$detail->volume;?>" placeholder="Volume">
                        </div>
                        <div class="form-group">
                            <label>Images</label>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped tablesorter">
                                    <tbody>
                                        <tr>
                                            <td>
                                               <div class="form-group">
                                                    <label>Image1</label>
                                                    <input type="text" class="form-control" id="image1" name="image1" value="<?=$image->product_image1;?>" readonly onclick="TampilModel('<?=base_url();?>product_management/image_browse/image1','image1');" required>
                                                    <div style="margin-top: 10px;text-align: center;">
                                                        <img src="<?=base_url();?>assets/elfinder/<?=$image->product_image1;?>" id="bimage1" width="130" height="100">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label>Image2</label>
                                                    <input type="text" class="form-control" id="image2" name="image2" value="<?=$image->product_image2;?>" readonly onclick="TampilModel('<?=base_url();?>product_management/image_browse/image2','image2');">
                                                    <div style="margin-top: 10px;text-align: center;">
                                                        <img src="<?=base_url();?>assets/elfinder/<?=$image->product_image2;?>" id="bimage2" width="130" height="100">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label>Image3</label>
                                                    <input type="text" class="form-control" id="image3" name="image3" value="<?=$image->product_image3;?>" readonly onclick="TampilModel('<?=base_url();?>product_management/image_browse/image3','image3');">
                                                    <div style="margin-top: 10px;text-align: center;">
                                                        <img src="<?=base_url();?>assets/elfinder/<?=$image->product_image3;?>" id="bimage3" width="130" height="100">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <div class="form-group">
                                                    <label>Image4</label>
                                                    <input type="text" class="form-control" id="image4" name="image4" value="<?=$image->product_image4;?>" readonly onclick="TampilModel('<?=base_url();?>product_management/image_browse/image4','image4');">
                                                    <div style="margin-top: 10px;text-align: center;">
                                                        <img src="<?=base_url();?>assets/elfinder/<?=$image->product_image4;?>" id="bimage4" width="130" height="100">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label>Image5</label>
                                                    <input type="text" class="form-control" id="image5" name="image5" value="<?=$image->product_image5;?>" readonly onclick="TampilModel('<?=base_url();?>product_management/image_browse/image5','image5');">
                                                    <div style="margin-top: 10px;text-align: center;">
                                                        <img src="<?=base_url();?>assets/elfinder/<?=$image->product_image5;?>" id="bimage5" width="130" height="100">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label>Image6</label>
                                                    <input type="text" class="form-control" id="image6" name="image6" value="<?=$image->product_image6;?>" readonly onclick="TampilModel('<?=base_url();?>product_management/image_browse/image6','image6');">
                                                    <div style="margin-top: 10px;text-align: center;">
                                                        <img src="<?=base_url();?>assets/elfinder/<?=$image->product_image6;?>" id="bimage6" width="130" height="100">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--<div style="margin-top: 10px;">
                                    <input type="button" class="btn btn-primary btn-xs" value=" + Images" />
                                </div>-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cash On Delivery</label>
                            <select name="cod" class="form-control">
                                <?php
                                    if($detail->cod=="Y"){
                                        $cod_y="selected";
                                        $cod_n="";
                                    }else{
                                        $cod_y="";
                                        $cod_n="selected";
                                    }
                                ?>
                                <option value="N" <?=$cod_n;?>>No</option>
                                <option value="Y" <?=$cod_y;?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>PPn 10% Included</label>
                            <?php
                                if($detail->ppn=="Y"){
                                    $ppn_y="selected";
                                    $ppn_n="";
                                }else{
                                    $ppn_y="";
                                    $ppn_n="selected";
                                }
                            ?>
                            <select name="ppn" class="form-control">
                                <option value="N" <?=$ppn_n;?>>No</option>
                                <option value="Y" <?=$ppn_y;?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Estimation Delivery Time</label>
                            <div class="input-group">
                                <input type="text" name="estimasi" value="<?=$detail->delivery_time;?>" class="form-control" placeholder="ex: 2 - 4 " aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2">Days</span>
                            </div>
                        </div>
                        <div>
                            <label>Guaranted</label>
                            <div class="input-group">
                                <input type="number" name="guaranted" value="<?=$detail->guaranted;?>" class="form-control" placeholder="ex: 12 " aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2">Month</span>
                            </div>
                        </div>
                        <div>
                            <label>Contact Product</label>
                            <input type="text" name="contact_product" class="form-control" value="<?=$detail->contact_product;?>">
                        </div>
                    </div>
                </div>
            </div>
	</div>
    <div id="tabs-4">
        <div class="row">
            <div class="form-group">
                <label>Popular Rate</label>
                <div>
                    <input type="radio" name="rating_popular" value="1" <?php echo ($detail->rating_popular=="1" ? "checked" : "");?>>
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png"> 
                    <input type="radio" name="rating_popular" value="2" style="margin-left: 30px;" <?php echo ($detail->rating_popular=="2" ? "checked" : "");?>>
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                    <input type="radio" name="rating_popular" value="3" style="margin-left: 30px;" <?php echo ($detail->rating_popular=="3" ? "checked" : "");?>>
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                    <input type="radio" name="rating_popular" value="4" style="margin-left: 30px;" <?php echo ($detail->rating_popular=="4" ? "checked" : "");?>>
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                    <input type="radio" name="rating_popular" value="5" style="margin-left: 30px;" <?php echo ($detail->rating_popular=="5" ? "checked" : "");?>>
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                </div>
            </div>
            <div class="form-group">
                <label>Price Rate</label>
                <div>
                    <input type="radio" name="rating_price" value="1" <?php echo ($detail->rating_price=="1" ? "checked" : "");?>>
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png"> 
                    <input type="radio" name="rating_price" value="2" style="margin-left: 30px;" <?php echo ($detail->rating_price=="2" ? "checked" : "");?>>
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                    <input type="radio" name="rating_price" value="3" style="margin-left: 30px;" <?php echo ($detail->rating_price=="3" ? "checked" : "");?>>
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                    <input type="radio" name="rating_price" value="4" style="margin-left: 30px;" <?php echo ($detail->rating_price=="4" ? "checked" : "");?>>
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                    <input type="radio" name="rating_price" value="5" style="margin-left: 30px;" <?php echo ($detail->rating_price=="5" ? "checked" : "");?>>
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                </div>
            </div>
            <div class="form-group">
                <label>Product Overview</label>
                <textarea name="overview" id="editor2" rows="10" cols="80"><?=$detail->overview;?></textarea>
            </div>
            <div class="form-group">
                <label>Product Specesification</label>
                <textarea name="spesifikasi" id="editor3" rows="10" cols="80"><?=$detail->spesifikasi;?></textarea>
            </div>
            <div class="form-group">
                <label>Product Other Information</label>
                <textarea name="other_information" id="editor4" rows="10" cols="80"><?=$detail->other_information;?></textarea>
            </div>
        </div>
    </div>
</div>
    </form>
<?php $this->load->view('combobox_autocomplete');?>
<?php $this->load->view('multitextbox');?>
<?php $this->load->view('ckeditor');?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
function TampilModel(file){
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=485,width=520').focus();
}
</script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
    CKEDITOR.replace( 'editor3' );
    CKEDITOR.replace( 'editor4' );
</script>