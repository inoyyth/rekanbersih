<ol class="breadcrumb">
    <li> Category Mgt.</li>
    <li class="active"> Material<li>
</ol>
<div style="margin-bottom: 1%;">
    <button type="button" onclick="window.location.replace('<?php echo base_url(); ?>category_management');" class="btn btn-default" style="margin-left: 2px;">Category</button>
    <button type="button" onclick="window.location.replace('<?php echo base_url(); ?>merk');" class="btn btn-default" style="margin-left: 2px;">Material</button>
    <button type="button" class="btn btn-primary disabled" style="margin-left: 2px;">Material</button>
    <button type="button" onclick="window.location.replace('<?php echo base_url(); ?>unit_measure');" class="btn btn-default" style="margin-left: 2px;">Unit</button>
</div>
<div class="panel panel-default">
    <div class="panel-heading">Material Management</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" />
                <form method="post" action="<?=base_url();?>type_material/search" id="form1"/>
                    <select style="float: right;width: 50px;margin-top: -19px;" name="page_sr" onchange="coba('form1');"/>
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
                            <th style="text-align: center;">ID <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Name <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Abbreviation <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Actions <i class="fa fa-sort"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      if(count($data) < 1){
                          echo"<td align='center' colspan='10'>Data Not Found</td>";
                      }else{
                      $no=0;
                      foreach($data as $data){
                          $id_brand=$data->id_type_material;
                          $no++;
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $data->id_type_material; ?></td>
                            <td style="text-align: center;"><?php echo $data->type_material; ?></td>
                            <td style="text-align: center;"><?php echo $data->abbreviation; ?></td>
                            <td style="text-align: center;">
                                <button id="update" onclick="updatex('<?=$data->id_type_material;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                                <button id="delete" onclick="deletex('<?=$data->id_type_material;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                            </td>
                        </tr>
                    <?php }} ?>
                        <tr>
                            <td><input name="id_sr" class="form-control" value="<?=$id_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><input name="name_sr" class="form-control" value="<?=$name_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><input name="abbreviation_sr" class="form-control" value="<?=$abbreviation_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td style="text-align: center;padding-top: 1.5%;">
                                <button onclick="indexx();" type="button" class="btn btn-info btn-xs"><i class="fa fa-arrow-circle-left"> Clear Filter</button></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
                <div class="pagination"><?=$halaman;?></div>
            </div>
        </div>
    </div>
<!--end attribute form-->
<?php $this->load->view('combobox_autocomplete');?>
<script type="text/javascript">
    $(document).ready(function (){
        $("#new").click(function(){
           window.location.replace("<?php echo base_url(); ?>type_material/add");
        });
        });
        function indexx(){
        window.location.replace("<?php echo base_url(); ?>type_material");
        }
        function updatex(id){
        window.location.replace("<?php echo base_url(); ?>type_material/update/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
        }
         function deletex(id){
               if(confirm('Delete this record?')){
               window.location.replace("<?php echo base_url(); ?>type_material/delete/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
                }else{

                }
            }
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
        }
</script>