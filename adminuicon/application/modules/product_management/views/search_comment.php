<ol class="breadcrumb">
    <li> Product Mgt.</li>
    <li class="active"></i> Product Comment</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">List Comment Product <b><?php echo $product->product_code;?> - <?php echo $product->product_name;?></b></div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
               <!-- <input type="button" class="btn btn-warning btn-xs" value=" Validation Stock " id="validation_stock" />-->
                <form method="post" action="<?=base_url();?>product_management/comment_search/<?php echo $product->id_product;?>" id="form1"/>
                    <select style="float: right;width: 50px;margin-top: -10px;" name="page_sr" onchange="coba('form1');"/>
                        <?php 
                        if($page_sr=="10"){
                            $pg10="selected";
                        }else{
                            $pg10="";
                        }
                        if($page_sr=="25"){
                            $pg25="selected";
                        }else{
                            $pg25="";
                        }
                        if($page_sr=="50"){
                            $pg50="selected";
                        }else{
                            $pg50="";
                        }
                        if($page_sr=="100"){
                            $pg100="selected";
                        }else{
                            $pg100="";
                        }
                        ?>
                        <option value="10" <?=$pg10;?>>10</option>
                        <option value="25" <?=$pg25;?>>25</option>
                        <option value="50" <?=$pg50;?>>50</option>
                        <option value="100" <?=$pg100;?>>100</option>
                    </select>
            </div>
            <i>
                Total Data: <?=$total_data;?>
            </i>
            <div class="table-responsive" style="font-size: 12px;">
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Customer Name <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Comment <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Status <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Action <i class="fa fa-sort"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      if(count($data)<1){
                          echo"<td colspan='10' align='center'>Data Not Found</td>";
                      }else{
                      $no=0;
                      foreach($data as $data){
                          $no++;
                    ?>
                        <tr>
                            <td style="text-align: left;"><?=$data->name;?></td><input type="hidden" id="id" name="id" value="<?=$data->id;?>"/>
                            <td style="text-align: left;"><?php echo $data->comment; ?></td>
                            <td style="text-align: center;"><?php echo status($data->status); ?></td>
                            <td style="text-align: center;width: 15%;">
<!--                                <button type="button" class="btn btn-success btn-xs"><i class="fa fa-desktop"> View</button></i></button>-->
                                <button id="update" onclick="updatex('<?=$data->id;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                                <button id="delete" onclick="deletex('<?=$data->id;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                            </td>
                        </tr>
                      <?php }} ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><input name="customer_sr" class="form-control" value="<?=$customer_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><input name="comment_sr" class="form-control" value="<?=$comment_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><select class="combo_search" name="status_sr" onchange="coba('form1');"/>
                                <?php if($status_sr=="Y"){
                                        $y="selected";
                                      }else{
                                        $y="";
                                      }
                                      if($status_sr=="N"){
                                          $n="selected";
                                      }else{
                                          $n="";
                                      }
                                ?>
                                <option value=""></option>
                                    <option value="Y" <?=$y?>>Active</option>
                                    <option value="N" <?=$n?>>Not Active</option>
                                </select>
                            </td>
                           <td style="text-align: center;padding-top: 1.5%;">
                                <button id="update" onclick="indexx();" type="button" class="btn btn-info btn-xs"><i class="fa fa-arrow-circle-left"> Clear Filter</button></i></button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
                <div class="pagination"><?=$halaman;?></div>
            </div>
        </div>
    </div>
    <div id="dialog_attr" title="Image Show">
        <img class="imgx" style="width: 100%;padding: 5%;">
        <div class="judul" style="text-align: center;margin-top:-16px;font-weight: bolder;"></div>
    </div>
<!--end attribute form-->
<?php $this->load->view('combobox_autocomplete');?>
<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/jquery-1.10.2.js"></script>
<script>
    $(document).ready(function (){
        var id=$("#id").val();
        $("#new").click(function(){
           window.location.replace("<?php echo base_url(); ?>product_management/add/<?=($this->uri->segment(3)!= "" ? $this->uri->segment(3) : 0 );?>");
        });
        $("#batch_import").click(function(){
           window.location.replace("<?php echo base_url(); ?>product_management/batchimport");
        });
        $("#validation_stock").click(function(){
           window.location.replace("<?php echo base_url(); ?>product_management/validation_stock");
        });
    });
    function updatex(id){
        window.location.replace("<?php echo base_url(); ?>product_management/comment_update/"+id+"/<?=($this->uri->segment(3)!= "" ? $this->uri->segment(3) : 0 );?>");
    }
     function deletex(id){
           if(confirm('Delete this record?')){
           window.location.replace("<?php echo base_url(); ?>product_management/comment_delete/"+id+"/<?=($this->uri->segment(3)!= "" ? $this->uri->segment(3) : 0 );?>");
            }else{

            }
        }
    function coba(tables){
        //alert("valuenya "+id+" fieldnya "+tables);
        document.getElementById(tables).submit();
    }
    function indexx(){
    window.location.replace("<?php echo base_url(); ?>product_management");
    }
    function comment(id){
    window.location.replace("<?php echo base_url(); ?>product_management/comment/"+id);
    }
</script>