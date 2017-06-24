

<form method="post" action="<?= base_url(); ?>article2/update_proses" enctype="multipart/form-data" >
    <div style="margin-bottom: 5px;text-align: right;">
        <input type="submit" class="btn btn-primary" value="Save" />
        
        <?php
        
        if(!empty($list_detail->article_parent_id)) {
            echo "<input type='hidden' name='parent_id' value='".$list_detail->article_parent_id."' />";
        }
        
        $set_hidden = null;
        if($list_detail->article_section == 'none' || empty($list_detail->article_section)) {
            $set_hidden = 'hidden';
        }
        
        if(!empty($list_detail->article_parent_id)) {
            $set_hidden = 'hidden';
        }
        
        ?>
        <input type="submit" name="submit_new_section" class="btn btn-primary new_section <?php echo $set_hidden;?>" value="Save and Create New Section" />
        
        <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>article2/search/<?= $posisi; ?>');" class="btn btn-danger" value="Cancel" />
    </div>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"> Update Article </h3>
        </div>
        <div class="panel-body" id="panelx">
            <div class="form-group">
                
                <div class="form-group">
                    <label>ID</label><input type="hidden" name="posisi" value="<?= $posisi; ?>"/>
                    <input class="form-control" type="text" name="id" value="<?= $list_detail->article_id; ?>" readonly/>
                </div>
                
                <?php
                if(!empty($list_detail->article_parent_id)) {
                ?>
                <div class="form-group">
                    <label>Sub Article Name</label>
                    <input class="form-control" type="text" name="id" value="<?= $article_parent->article_title; ?>" disabled="disabled"/>
                </div>
                <?php
                }
                
                if(empty($list_detail->article_parent_id)) {
                ?>
                <label>Category</label>
                <select class="combo_search" style="width: 100%;font-size: 15px;" required name="category" id="category">
                    <option value="">--select category--</option>
                    <?php
                    $id_sub = $list_detail->subcategory_id;
                    $sql = mysql_query("select * from article_subcategory where id='$id_sub'");
                    $datax = mysql_fetch_assoc($sql);
                    foreach ($list_category as $category) {
                        if ($category->id == $datax['id_category']) {
                            $select = "selected";
                        } else {
                            $select = "";
                        }
                        echo"<option value='$category->id' $select>$category->article_category_name</option>";
                    }
                    ?>
                </select>
                <?php
                }
                ?>
                
                
                
            </div>
            
            <?php
            if(empty($list_detail->article_parent_id)) {
            ?>
            <div class="form-group"  id="app">
                <label>Sub Category</label>
                <input type="hidden" id="cat_hidden" value="<?= $datax['id_category']; ?>">
                <input type="hidden" id="sub_hidden" value="<?= $list_detail->subcategory_id; ?>">
                <select class="combobox" style="width: 100%;font-size: 10px;" required name="subcategory" id="subcategory">
                    <option value="<?= $list_detail->subcategory_id; ?>" selected><?= $list_detail->article_subcategory_name; ?></option>
                </select>
            </div>
            <?php
            }
            ?>
            
            <?php
            if(empty($list_detail->article_parent_id)) {
            ?>
            <div class="form-group"  id="app">
                <label>Section</label>
                <select class="form-control" style="width: 100%;font-size: 10px;" required name="section_type" id="section_type">
                    <option value="none" <?php echo ($list_detail->article_section == 'none' || empty($list_detail->article_section)) ? 'selected' : null; ?>>Single Post</option>
                    <option value="multiple_pagination" <?php echo ($list_detail->article_section == 'multiple_pagination') ? 'selected' : null; ?>>Multiple Page with Pagination</option>
                    <option value="multiple_one" <?php echo ($list_detail->article_section == 'multiple_one') ? 'selected' : null; ?>>Multiple Page in One Page</option>
                </select>
            </div>
            <?php
            }
            ?>
            
            <div class="row" style="font-size: 12px;">
                <div class="col-lg-12">
                    
                    <?php
                    if(empty($list_detail->article_parent_id)) {
                    ?>
                    <div class="form-group">
                        <label>Article Name</label>
                        <input type="text" class="form-control" name="article" value="<?= $list_detail->article_title; ?>"  required/>
                    </div>
                    <?php
                    }
                    ?>

                    <div class="form-group">
                        <label>Article Template</label>
                        <table>
                            <tr>
                                <?php
                                for ($i = 1; $i <= 6; $i++) {

                                    $tmp_x_name = 'article_template_' . $i;
                                    ?>
                                    <td  valign="top" align="center" style="padding:10px;border:1px solid #ddd;">
                                        <?php
                                        $data = Array(
                                            'name' => 'article_template',
                                            'id' => $tmp_x_name,
                                        );


                                        if ($list_detail->article_template == $i) {
                                            $data['checked'] = 'checked';
                                        } else {
                                            unset($data['checked']);
                                        }

                                        if (empty($list_detail->article_template) && $i == 1) {
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
                        <textarea class="form-control" name="description"><?= $list_detail->article_description; ?></textarea>
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
                                <img src="<?php echo base_url() . '../userfiles/Image/article/'.$list_detail->article_image_1; ?>"  id="image_preview_1" height="100px" width="100px" style="border: solid;">
                                <?php
                                if(!empty($list_detail->article_image_1)) {
                                ?>
                                <a onclick="javascript:window.open('<?php echo base_url().'article2/setting_image/'.$list_detail->article_id.'/1'; ?>','atur gambar','width=auto,height=auto,scrollbars=yes')" class="btn btn-primary btn_set_image_preview_1">Setting Image Tagging</a>
                                <?php
                                }
                                ?>
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
                                <img src="<?php echo base_url() . '../userfiles/Image/article/'.$list_detail->article_image_2; ?>" id="image_preview_2" height="100px" width="100px" style="border: solid;">
                                <?php
                                if(!empty($list_detail->article_image_2)) {
                                ?>
                                <a onclick="javascript:window.open('<?php echo base_url().'article2/setting_image/'.$list_detail->article_id.'/2'; ?>','atur gambar','width=auto,height=auto,scrollbars=yes')" class="btn btn-primary btn_set_image_preview_2">Setting Image Tagging</a>
                                <?php
                                }
                                ?>
                            </div>
                            <br/>
                        </span>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="combobox" style="width: 100%;font-size: 10px;" name="status" required>
                            <?php
                            if ($list_detail->article_is_active == 1) {
                                $a = "selected";
                            } else {
                                $a = "";
                            }

                            if ($list_detail->article_is_active == 0) {
                                $b = "selected";
                            } else {
                                $b = "";
                            }
                            ?>
                            <option value="1" <?= $a; ?>/>Active</option>
                            <option value="0" <?= $b; ?>/>Not Active</option>
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

            var $j = jQuery.noConflict();
            $j(document).ready(function () {
                $j("#article_product_showcase").tokenInput("<?= base_url(); ?>coupon/listproduct", {
                    theme: "facebook",
                    preventDuplicates: true,
                    prePopulate: [
                    <?php
                    $dc = explode(",", $list_detail->article_product_showcase);
                    foreach ($dc as $cd) {
                        $dt = $this->db->query("select id,product_name as name from product_general where id='$cd'")->row();
                        if(!empty($dt)) {
                            echo '{id: ' . $dt->id . ', name: "' . $dt->name . '"},';
                        }
                    }
                    ?>
                    ]

                });
            });

            $(document).ready(function () {

                $("#image_1").change(function () {
                    get_base64_img(this);
                });

                $("#image_2").change(function () {
                    get_base64_img(this);
                });
            });

            $(document).ready(function () {

                var cat = $("#cat_hidden").val();
                var sub = $("#sub_hidden").val();
                $.ajax({
                    type: 'post',
                    url: "<?=base_url();?>article2/get_subcategory_update",
                    data: "cat=" + cat + "&sub=" + sub,
                    success: function (data) {
                        $("#subcategory").text("sdsd");
                        $("#subcategory").html(data);
                    }
                });
                $("#category").change(function () {
                    $("#subcategory").remove();
                    $("#app").append("<select name='subcategory' class='combobox' id='subcategory'></select>");
                    $("#subcategory").combobox();
                    var id = $("#category").val();
                    $.ajax({
                        type: 'post',
                        url: "<?=base_url();?>article2/get_subcategory",
                        data: "id=" + id,
                        success: function (data) {
                            $("#subcategory").html(data);
                        }
                    });
                });
            });
</script>