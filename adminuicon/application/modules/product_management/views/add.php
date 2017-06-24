<?php error_reporting(0);?>
<form method="post" action="<?=base_url();?>product_management/add_proses" enctype="multipart/form-data" >
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
                        <label>Product Name</label><input type="hidden" name="posisi" value="<?=$posisi;?>"/>
                        <input class="form-control" name="product_name" required>
                    </div>
                    <div class="form-group">
                        <label>Product Code</label>
                        <input class="form-control" name="product_code" required>
                    </div>
                    <div class="form-group">
                        <label>Key Word</label>
                        <input class="form-control" name="keyword" value="<?=$detail->product_code;?>" placeholder="Ex: toko air, filter air, galon" required>
                    </div>
                    <div class="form-group">
                        <label>Product Type</label>
                        <select name="product_type" class="combobox" required>
                            <?php 
                                foreach($type as $typex){
                            ?>
                            <option value="<?=$typex->id_type_material;?>"><?=$typex->type_material;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Category</label>
                        <select name="product_category" class="combobox" required>
                            <?php 
                                foreach($category as $categoryx){
                            ?>
                            <option value="<?=$categoryx->id_product_category;?>"><?=$categoryx->product_category;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Merk</label>
                        <select name="product_merk" class="combobox" required>
                            <?php 
                                foreach($merk as $merkx){
                            ?>
                            <option value="<?=$merkx->id_merk;?>"><?=$merkx->name;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Description</label>
                        <textarea name="description" id="editor1" rows="10" cols="80"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Hot Product</label>
                        <select name="hot_product" class="combobox" required>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Exclusive Product</label>
                        <select name="exclusive_product" class="combobox" required>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Stock Status</label>
                        <select name="stock_status" class="combobox" required>
                            <option value="1">Ready Stock</option>
                            <option value="2">3thparty</option>
                            <option value="3">Indent</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Active</label>
                        <select name="product_active" class="combobox" required>
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>
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
                            <input type="text" class="form-control" onkeypress="return validate(event)" name="normal_price" required>
                        </div>
                        <div class="form-group">
                            <label>Special Price</label>
                            <input type="text" class="form-control" onkeypress="return validate(event)" name="special_price" required>
                        </div>
                        <div class="form-group">
                            <label>Afiliasi Price</label>
                            <input type="text" class="form-control" name="afiliasi_price" onkeypress="return validate(event)" required>
                        </div>
                        <!--<div class="form-group">
                            <label>Reseller Minimum Quota</label>
                            <input type="text" class="form-control" name="reseller_quota" onkeypress="return validate(event)" required>
                        </div>-->
                        <div class="form-group">
                            <label>Product Unit</label>
                            <select name="product_unit" class="combobox" required>
                                <?php 
                                    foreach($unit as $unitx){
                                ?>
                                <option value="<?=$unitx->id_unit_measure;?>"><?=$unitx->name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Finish Product</label>
                            <select name="product_finish" class="combobox" required>
                                <option value="1">Yes</option>
                                <option value="0">Not</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Product Valuation</label>
                            <select name="product_valuation" class="combobox" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Product Service</label>
                            <select name="product_service" class="combobox" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Weight(Kg)</label>
                            <input class="form-control" name="product_weight" placeholder="Weight(Kg)">
                        </div>
                        <div class="form-group">
                            <label>Volume(m3)</label>
                            <input class="form-control" name="product_volume" placeholder="Volume">
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
                                                    <input type="text" class="form-control" id="image1" name="image1" readonly onclick="TampilModel('<?=base_url();?>product_management/image_browse/image1','image1');" required>
                                                    <div style="margin-top: 10px;text-align: center;">
                                                        <img src="" id="bimage1" width="130" height="100">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label>Image2</label>
                                                    <input type="text" class="form-control" id="image2" name="image2" readonly onclick="TampilModel('<?=base_url();?>product_management/image_browse/image2','image2');">
                                                    <div style="margin-top: 10px;text-align: center;">
                                                        <img src="" id="bimage2" width="130" height="100">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label>Image3</label>
                                                    <input type="text" class="form-control" id="image3" name="image3" readonly onclick="TampilModel('<?=base_url();?>product_management/image_browse/image3','image3');">
                                                    <div style="margin-top: 10px;text-align: center;">
                                                        <img src="" id="bimage3" width="130" height="100">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <div class="form-group">
                                                    <label>Image4</label>
                                                    <input type="text" class="form-control" id="image4" name="image4" readonly onclick="TampilModel('<?=base_url();?>product_management/image_browse/image4','image4');">
                                                    <div style="margin-top: 10px;text-align: center;">
                                                        <img src="" id="bimage4" width="130" height="100">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label>Image5</label>
                                                    <input type="text" class="form-control" id="image5" name="image5" readonly onclick="TampilModel('<?=base_url();?>product_management/image_browse/image5','image5');">
                                                    <div style="margin-top: 10px;text-align: center;">
                                                        <img src="" id="bimage5" width="130" height="100">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label>Image6</label>
                                                    <input type="text" class="form-control" id="image6" name="image6" readonly onclick="TampilModel('<?=base_url();?>product_management/image_browse/image6','image6');">
                                                    <div style="margin-top: 10px;text-align: center;">
                                                        <img src="" id="bimage6" width="130" height="100">
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
                                <option value="N">No</option>
                                <option value="Y">Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>PPn 10% Included</label>
                            <select name="ppn" class="form-control">
                                <option value="N">No</option>
                                <option value="Y">Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Estimation Delivery Time</label>
                            <div class="input-group">
                                <input type="text" name="estimasi" class="form-control" placeholder="ex: 2 - 4 " aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2">Days</span>
                            </div>
                        </div>
                        <div>
                            <label>Guaranted</label>
                            <div class="input-group">
                                <input type="number" name="guaranted" class="form-control" placeholder="ex: 12 " aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2">Month</span>
                            </div>
                        </div>
                        <div>
                            <label>Contact Product</label>
                            <input type="text" name="contact_product" class="form-control">
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
                    <input type="radio" name="rating_popular" value="1" checked>
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png"> 
                    <input type="radio" name="rating_popular" value="2" style="margin-left: 30px;">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                    <input type="radio" name="rating_popular" value="3" style="margin-left: 30px;">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                    <input type="radio" name="rating_popular" value="4" style="margin-left: 30px;">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                    <input type="radio" name="rating_popular" value="5" style="margin-left: 30px;">
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
                    <input type="radio" name="rating_price" value="1" checked>
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png"> 
                    <input type="radio" name="rating_price" value="2" style="margin-left: 30px;">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                    <input type="radio" name="rating_price" value="3" style="margin-left: 30px;">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                    <input type="radio" name="rating_price" value="4" style="margin-left: 30px;">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                    <input type="radio" name="rating_price" value="5" style="margin-left: 30px;">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                        <img style="width: 16px;" src="<?=base_url();?>assets/themes/bintang.png">
                </div>
            </div>
            <div class="form-group">
                <label>Product Overview</label>
                <textarea name="overview" id="editor2" rows="10" cols="80"></textarea>
            </div>
            <div class="form-group">
                <label>Product Specesification</label>
                <textarea name="spesifikasi" id="editor3" rows="10" cols="80"></textarea>
            </div>
            <div class="form-group">
                <label>Product Other Information</label>
                <textarea name="other_information" id="editor4" rows="10" cols="80"></textarea>
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
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=420,width=520').focus();
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