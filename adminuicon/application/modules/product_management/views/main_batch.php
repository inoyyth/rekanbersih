<ol class="breadcrumb">
    <li> Product Mgt.</li>
    <li class="active"> Batch Import<li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">Export & Import</div>
        <div class="panel-body">
            <div class="table-responsive col-lg-6" style="font-size: 12px;">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Table Name</th>
                            <th style="text-align: center;width: 40%;">Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Product</td>
                            <td style="text-align: center;">
                                <input type="button" class="btn btn-primary btn-xs" value="Download" id="d_product" />
                                <input type="button" class="btn btn-warning btn-xs" value="Template" id="t_product" />
                            </td>
                        </tr>
                        <tr>
                            <td>Product Category</td>
                            <td style="text-align: center;">
                                <input type="button" class="btn btn-primary btn-xs" value="Download" id="d_category" />
                                <input type="button" class="btn btn-warning btn-xs" value="Template" id="t_category" />
                            </td>
                        </tr>
                        <tr>
                            <td>Product Brand</td>
                            <td style="text-align: center;">
                                <input type="button" class="btn btn-primary btn-xs" value="Download" id="d_brand" />
                                <input type="button" class="btn btn-warning btn-xs" value="Template" id="t_brand" />
                            </td>
                        </tr>
                        <tr>
                            <td>Pick Editor</td>
                            <td style="text-align: center;">
                                <input type="button" class="btn btn-primary btn-xs" value="Download" id="d_pick" />
                                <input type="button" class="btn btn-warning btn-xs" value="Template" id="t_pick" />
                            </td>
                        </tr>
                        <tr>
                            <td>Band Material</td>
                            <td style="text-align: center;">
                                <input type="button" class="btn btn-primary btn-xs" value="Download" id="d_material" />
                                <input type="button" class="btn btn-warning btn-xs" value="Template" id="t_material" />
                            </td>
                        </tr>
                        <tr>
                            <td>Dial Type</td>
                            <td style="text-align: center;">
                                <input type="button" class="btn btn-primary btn-xs" value="Download" id="d_type" />
                                <input type="button" class="btn btn-warning btn-xs" value="Template" id="t_type" />
                            </td>
                        </tr>
                        <tr>
                            <td>Colour</td>
                            <td style="text-align: center;">
                                <input type="button" class="btn btn-primary btn-xs" value="Download" id="d_colour" />
                                <input type="button" class="btn btn-warning btn-xs" value="Template" id="t_colour" />
                            </td>
                        </tr>
                        <tr>
                            <td>Exterior Material</td>
                            <td style="text-align: center;">
                                <input type="button" class="btn btn-primary btn-xs" value="Download" id="d_exterior" />
                                <input type="button" class="btn btn-warning btn-xs" value="Template" id="t_exterior" />
                            </td>
                        </tr>
                        <tr>
                            <td>Shop by Filter</td>
                            <td style="text-align: center;">
                                <input type="button" class="btn btn-primary btn-xs" value="Download" id="d_shop" />
                                <input type="button" class="btn btn-warning btn-xs" value="Template" id="t_shop" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive col-lg-6" style="font-size: 12px;">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Table Name</th>
                            <th style="text-align: center;width: 60%;">Upload</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Product</td>
                            <td style="text-align: center;">
                                <form id="f_product" action="<?php echo site_url('product_management/u_product/')?>" method="post" enctype="multipart/form-data" role="form">
                                    <input type="file" id="import" name="import" required>
                                    <input type="submit" value="Import" name="save" class="submitx" />
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>Product Category</td>
                            <td style="text-align: center;">
                                <form id="f_category" action="<?php echo site_url('product_management/u_category/')?>" method="post" enctype="multipart/form-data" role="form">
                                    <input type="file" id="import" name="import" required>
                                    <input type="submit" value="Import" name="save" class="submitx" />
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>Product Brand</td>
                            <td style="text-align: center;">
                                <form id="f_brand" action="<?php echo site_url('product_management/u_brand/')?>" method="post" enctype="multipart/form-data" role="form">
                                    <input type="file" id="import" name="import" required>
                                    <input type="submit" value="Import" name="save" class="submitx" />
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</div>
<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/jquery-1.10.2.js"></script>
<script>
    $(document).ready(function (){
        $("#f_product").submit(function(){
            $("#bgx").show();
        });
         $("#f_category").submit(function(){
            $("#bgx").show();
        })
         $("#f_brand").submit(function(){
            $("#bgx").show();
        })
        $("#d_product").click(function(){
           window.location.replace("<?php echo base_url(); ?>product_management/d_product");
        });
        $("#t_product").click(function(){
           window.location.replace("http://urbanicon.co.id/urbanfront/admin/assets/excel_template/Urbanicon_product_template.xls");
        });
        $("#d_category").click(function(){
           window.location.replace("<?php echo base_url(); ?>product_management/d_category");
        });
        $("#t_category").click(function(){
           window.location.replace("http://urbanicon.co.id/urbanfront/admin/assets/excel_template/Urbanicon_product_category_template.xls");
        });
        $("#d_brand").click(function(){
           window.location.replace("<?php echo base_url(); ?>product_management/d_brand");
        });
         $("#t_brand").click(function(){
           window.location.replace("http://urbanicon.co.id/urbanfront/admin/assets/excel_template/Urbanicon_product_brand_template.xls");
        });
        $("#d_pick").click(function(){
           window.location.replace("<?php echo base_url(); ?>product_management/d_pick");
        });
         $("#t_pick").click(function(){
           window.location.replace("http://urbanicon.co.id/urbanfront/admin/assets/excel_template/Urbanicon_editor_pick_template.xls");
        });
        $("#d_material").click(function(){
           window.location.replace("<?php echo base_url(); ?>product_management/d_material");
        });
         $("#t_material").click(function(){
           window.location.replace("http://urbanicon.co.id/urbanfront/admin/assets/excel_template/Urbanicon_band_material_template.xls");
        });
        $("#d_type").click(function(){
           window.location.replace("<?php echo base_url(); ?>product_management/d_type");
        });
         $("#t_type").click(function(){
           window.location.replace("http://urbanicon.co.id/urbanfront/admin/assets/excel_template/Urbanicon_dial_type_template.xls");
        });
        $("#d_colour").click(function(){
           window.location.replace("<?php echo base_url(); ?>product_management/d_colour");
        });
        $("#t_colour").click(function(){
           window.location.replace("http://urbanicon.co.id/urbanfront/admin/assets/excel_template/Urbanicon_colour_template.xls");
        });
        $("#d_exterior").click(function(){
           window.location.replace("<?php echo base_url(); ?>product_management/d_exterior");
        });
        $("#t_exterior").click(function(){
           window.location.replace("http://urbanicon.co.id/urbanfront/admin/assets/excel_template/Urbanicon_exteriormaterial_template.xls");
        });
        $("#d_shop").click(function(){
           window.location.replace("<?php echo base_url(); ?>product_management/d_shop");
        });
        $("#t_shop").click(function(){
           window.location.replace("http://urbanicon.co.id/urbanfront/admin/assets/excel_template/Urbanicon_shop_by_template.xls");
        });
    });
</script>