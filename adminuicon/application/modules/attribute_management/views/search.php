<ol class="breadcrumb">
    <li> Category Mgt.</li>
    <li class="active"> Attributes</li>
</ol>
<div style="margin-bottom: 1%;">
    <button type="button" onclick="window.location.replace('<?php echo base_url(); ?>category_management');" class="btn btn-default" style="margin-left: 2px;">Category</button>
    <button type="button" onclick="window.location.replace('<?php echo base_url(); ?>brand_management');" class="btn btn-default" style="margin-left: 2px;">Brands</button>
    <button type="button" class="btn btn-primary disabled" style="margin-left: 2px;">Attributes</button>
    <button type="button" onclick="window.location.replace('<?php echo base_url(); ?>value_management');" class="btn btn-default" style="margin-left: 2px;">Value</button>
    <button type="button" onclick="window.location.replace('<?php echo base_url(); ?>filter_category');" class="btn btn-default" style="margin-left: 2px;">Filter Category</button>
</div>
<div class="panel panel-default">
    <div class="panel-heading">Attributes Management</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" />
                    <form method="post" action="<?=base_url();?>attribute_management/search" id="form2"/>
                        <select style="float: right;width: 50px;margin-top: -19px;" name="page_sr" onchange="coba('form2');"/>
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
                    </form>
            </div>
            <i>
                Total Data: <?=$total_data;?>
            </i>
            <div class="table-responsive" style="font-size: 12px;">
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                        <tr>
                            <th style="text-align: center;">ID <i class="fa fa-sort"></i></th>
                            <th>Name <i class="fa fa-sort"></i></th>
                            <th>Status <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Actions <i class="fa fa-sort"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      if(count($data)<1){
                          echo"<td colspan='10' align='center'>Data Not Found</td>";
                      }else{
                      $no=0;
                      foreach($data as $data){
                          $id_cat=$data->id;
                          $no++;
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $data->id; ?></td>
                            <td><?php echo $data->attributes_name; ?></td>
                            <td><?php echo status($data->status); ?></td>
                            <td style="text-align: center;">
                                <button id="update" onclick="updatex('<?=$data->id;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                                <button id="delete" onclick="deletex('<?=$data->id;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                            </td>
                        </tr>
                      <?php }} ?>
                        <tr>
                            <form method="post" action="<?=base_url();?>attribute_management/search" id="form1"/>
                                <td><input name="id_sr" class="form-control" value="<?=$id_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="name_sr" class="form-control" value="<?=$name_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><select class="combo_search" name="status_sr" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/>
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
                            </form>
                        </tr>
                    </tbody>
                </table>
                <div class="pagination"><?=$halaman;?></div>
            </div>
        </div>
    </div>
<!--end attribute form-->
<?php $this->load->view('combobox_autocomplete');?>
<script type="text/javascript">
    $(document).ready(function (){
        $("#new").click(function(){
           window.location.replace("<?php echo base_url(); ?>attribute_management/add");
        });
        });
        function indexx(){
        window.location.replace("<?php echo base_url(); ?>attribute_management");
        }
        function updatex(id){
        window.location.replace("<?php echo base_url(); ?>attribute_management/update/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
        }
         function deletex(id){
               if(confirm('Delete this record?')){
               window.location.replace("<?php echo base_url(); ?>attribute_management/delete/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
                }else{

                }
            }
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
        }
</script>