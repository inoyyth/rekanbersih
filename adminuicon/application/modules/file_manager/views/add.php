<form method="post" action="<?= base_url(); ?>article2/add_proses" enctype="multipart/form-data" >
    
    <?php
    
    if(!empty($parent_id)) {
        echo "<input type='hidden' name='parent_id' value='$parent_id' />";
    }
    
    ?>
    
    <div style="margin-bottom: 5px;text-align: right;">
        <input type="submit" class="btn btn-primary" value="Save" /> 
        <?php
        
        $set_hidden = null;
        if($parent_id == 'none' || empty($parent_id)) {
            $set_hidden = 'hidden';
        }
        
        if(!empty($parent_id)) {
            $set_hidden = 'hidden';
        }
        
        ?>
        <input type="submit" name="submit_new_section" class="btn btn-primary new_section <?php echo $set_hidden;?>" value="Save and Create New Section" />
        <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>article2');" class="btn btn-danger" value="Cancel" />
    </div>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"> 
                <?php
                if(!empty($parent_id)) {
                    echo 'Add Sub Article';
                } else {
                    echo 'Add Article';
                }
                ?>
            </h3>
        </div>
        
        <div class="panel-body" id="panelx">
            
            <?php
            if(empty($parent_id)) {
            ?>
            <div class="form-group">
                <label>Category</label>
                <select class="combo_search" style="width: 100%;font-size: 15px;" required name="category" id="category">
                    <option value="">--select category--</option>
                    <?php
                    foreach ($list_category as $category) {
                        echo"<option value='$category->id'>$category->article_category_name</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group" id="app">
                <label>Sub Category</label>
                <select class="combobox" style="width: 100%;font-size: 10px;" required name="subcategory" id="subcategory">
                    <option value="">--select category--</option>
                </select>
            </div>
            
            <div class="form-group"  id="app">
                <label>Section</label>
                <select class="form-control" style="width: 100%;font-size: 10px;" required name="section_type" id="section_type">
                    <option value="none">Single Post</option>
                    <option value="multiple_pagination">Multiple Page with Pagination</option>
                    <option value="multiple_one">Multiple Page in One Page</option>
                </select>
            </div>
            <?php
            }
            ?>
            
            
            <div class="row" style="font-size: 12px;">
                <div class="col-lg-12">
                    <?php
                    if(empty($parent_id)) {
                    ?>
                    <div class="form-group">
                        <label>Article Name</label>
                        <input type="text" class="form-control" name="article"  required/>
                    </div>
                    <?php
                    } else {
                    ?>
                    <div class="form-group">
                        <label>Sub Article Name</label>
                        <input type="text" class="form-control" name="article_" disabled="disabled" value="<?php echo $article_title; ?>" />
                    </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label>Article Template</label>
                        <table>
                            <tr>
                                <?php
                                // Cuma temporary
                                for ($i = 1; $i <= 6; $i++) {

                                    $tmp_x_name = 'article_template_' . $i;
                                    ?>
                                    <td  valign="top" align="center" style="padding:10px;border:1px solid #ddd;">
                                        <?php
                                        $data = Array(
                                            'name' => 'article_template',
                                            'id' => $tmp_x_name,
                                        );

                                        if ($i == 1) {
                                            $data['checked'] = 'checked';
                                        }

                                        echo form_radio($data, $i);
                                        ?>
                                        <label for="<?php echo $tmp_x_name; ?>">
                                            <img width="40%" src="<?php echo base_url() . 'assets/article_thumbs/' . $i . '.gif'; ?>" alt="<?php echo 'Template ' . $i; ?>" title="<?php echo 'Template ' . $i; ?>"/>
                                        </label>
                                    </td>
                                    <?php
                                }
                                ?>

                            </tr>
                        </table>
                    </div>


                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>


                    <div class="form-group">
                        <label>Image</label>
                        <span>
                            Image 1 : 
                            <?php
                            echo form_upload(Array(
                                'name' => 'image_1',
                                'id' => 'image_1',
                                'data-img_id' => 'image_preview_1'
                            ));
                            ?>
                            <br/>
                            <div style="margin-top: 10px;">
                                <img src="#" id="image_preview_1" height="100px" width="100px" style="border: solid;">
                            </div>
                            <br/>
                        </span>
                        <span>
                            Image 2 : 
                            <?php
                            echo form_upload(Array(
                                'name' => 'image_2',
                                'id' => 'image_2',
                                'data-img_id' => 'image_preview_2'
                            ));
                            ?>
                            <br/>
                            <div style="margin-top: 10px;">
                                <img src="#" id="image_preview_2" height="100px" width="100px" style="border: solid;">
                            </div>
                            <br/>
                        </span>
                    </div>


                    <div class="form-group">
                        <label>Status</label>
                        <select class="combobox" style="width: 100%;font-size: 10px;" required name="status">
                            <option value="">Set Status</option>
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Products Showcase</label>
                        <input type="text" class="form-control" name="article_product_showcase" id="article_product_showcase" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $this->load->view('combobox_autocomplete'); ?>
<script type="text/javascript" src="<?= base_url(); ?>tinymce/tinymce.min.js"/></script>
<?php $this->load->view('tinyfck'); ?>
<?php $this->load->view('combobox_autocomplete'); ?>
<?php $this->load->view('multitextbox'); ?>
<script type="text/javascript" src="<?= base_url(); ?>assets/arkjs/basic.js"/></script>
<script type="text/javascript">





            $(document).ready(function () {

                $("#image_1").change(function () {
                    get_base64_img(this);
                });

                $("#image_2").change(function () {
                    get_base64_img(this);
                });
            });

            var $j = jQuery.noConflict();
            $j(document).ready(function () {
                $j("#article_product_showcase").tokenInput("<?= base_url(); ?>coupon/listproduct", {
                    theme: "facebook",
                    preventDuplicates: true
                });
            });

            $(document).ready(function () {

                var app = '<select class="combobox" style="width: 100%;font-size: 10px;" required name="subcategory" id="subcategory"></select>';
                $("#category").change(function () {
                    $("#subcategory").remove();
                    $("#app").append("<select name='subcategory' class='combobox' id='subcategory'></select>");
                    $("#subcategory").combobox();
                    var id = $("#category").val();
                    $.ajax({
                        type: 'post',
                        url: "<?= base_url(); ?>article2/get_subcategory",
                        data: "id=" + id,
                        success: function (data) {
                            $("#subcategory").html(data);
                        }
                    });
                });
            });
</script>