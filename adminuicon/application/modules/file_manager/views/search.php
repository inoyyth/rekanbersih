<ol class="breadcrumb">
    <li> Article</li>
    <li class="active"></i> Article</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">Article</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" />
                    <form method="post" action="<?=base_url();?>article2/search" id="form2"/>
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
                            <th>Sub Category <i class="fa fa-sort"></i></th>
                            <th>Article <i class="fa fa-sort"></i></th>
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
                          $id_cat=$data->article_id;
                          $no++;
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $data->article_id; ?></td>
                            <td><?php echo $data->article_subcategory_name; ?></td>
                            <td><?php echo $data->article_title; ?></td>
                            <td><?php echo status($data->article_is_active); ?></td>
                            <td style="text-align: center;">
                                <button id="update" onclick="updatex('<?=$data->article_id;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                                <button id="delete" onclick="deletex('<?=$data->article_id;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                            </td>
                        </tr>
                      <?php }} ?>
                        <tr>
                            <form method="post" action="<?=base_url();?>article2/search" id="form1"/>
                                <td><input name="id_sr" class="form-control" value="<?=$id_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="subcategoryname_sr" class="form-control" value="<?=$subcategoryname_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="name_sr" class="form-control" value="<?=$name_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><select class="combo_search" name="status_sr" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/>
                                    <?php if($status_sr==1){
                                            $y="selected";
                                          }else{
                                            $y="";
                                          }
                                          if($status_sr==0){
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
           window.location.replace("<?php echo base_url(); ?>article2/add");
        });
        });
        function indexx(){
        window.location.replace("<?php echo base_url(); ?>article2");
        }
        function updatex(id){
        window.location.replace("<?php echo base_url(); ?>article2/update/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
        }
         function deletex(id){
               if(confirm('Delete this record?')){
               window.location.replace("<?php echo base_url(); ?>article2/delete/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
                }else{

                }
            }
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
        }
</script>