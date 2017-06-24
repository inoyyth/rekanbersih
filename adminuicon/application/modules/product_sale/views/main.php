<ol class="breadcrumb">
    <li> Product Mgt.</li>
    <li class="active"></i> Product Mgt.</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">Product Management</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" />  
                <!--<input type="button" class="btn btn-warning btn-xs" value=" Validation Stock " id="validation_stock" />-->
                    <form method="post" action="<?=base_url();?>product_sale/search" id="form2"/>
                        <select style="float: right;width: 50px;margin-top: -19px;" name="page_sr" onchange="coba('form2');"/>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </form>
            </div>
            <i>
                Total Data: <?=$total_data;?>
            </i>
            <div class="table-responsive" style="font-size: 12px;">
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Product Code <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Product Name <i class="fa fa-sort"></i></th>
                            <th>Category <i class="fa fa-sort"></i></th>
                            <th>Merk <i class="fa fa-sort"></i></th>
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
                            <td style="text-align: center;"><?=$data->product_code;?></td><input type="hidden" id="id" name="id" value="<?=$data->id_product;?>"/>
                            <td style="text-align: center;"><?php echo $data->product_name; ?></td>
                            <td><?php echo $data->product_category; ?></td>
                            <td><?php echo $data->name; ?></td>
                            <td style="text-align: center;width: 15%;">
<!--                                <button type="button" class="btn btn-success btn-xs"><i class="fa fa-desktop"> View</button></i></button>-->
                                <button id="update" onclick="updatex('<?=$data->id_product;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                                <button id="delete" onclick="deletex('<?=$data->id_product;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                            </td>
                        </tr>
                      <?php }} ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <form method="post" action="<?=base_url();?>product_sale/search" id="form1"/>
                                <td><input name="product_code_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="product_name_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="category_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="merk_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td></td>
                            </form>
                        </tr>
                    </tfoot>
                </table>
                <div class="pagination"><?=$halaman;?></div>
            </div>
        </div>
    </div>
<!--end attribute form-->
<?php $this->load->view('combobox_autocomplete');?>
<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/jquery-1.10.2.js"></script>
<script>
    $(document).ready(function (){
        var id=$("#id").val();
        $("#new").click(function(){
           window.location.replace("<?php echo base_url(); ?>product_sale/add/<?=($this->uri->segment(3)!= "" ? $this->uri->segment(3) : 0 );?>");
        });
        $("#batch_import").click(function(){
           window.location.replace("<?php echo base_url(); ?>product_sale/batchimport");
        });
        $("#validation_stock").click(function(){
           window.location.replace("<?php echo base_url(); ?>product_sale/validation_stock");
        });
    });
    function updatex(id){
        window.location.replace("<?php echo base_url(); ?>product_sale/update/"+id+"/<?=($this->uri->segment(3)!= "" ? $this->uri->segment(3) : 0 );?>");
    }
     function deletex(id){
           if(confirm('Delete this record?')){
           window.location.replace("<?php echo base_url(); ?>product_sale/delete/"+id+"/<?=($this->uri->segment(3)!= "" ? $this->uri->segment(3) : 0 );?>");
            }else{

            }
        }
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
        }
</script>