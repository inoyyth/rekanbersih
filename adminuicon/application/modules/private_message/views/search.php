<ol class="breadcrumb">
    <li class="active"></i> Private Message</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">Private Message</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                <form method="post" action="<?=base_url();?>private_message/search" id="form1"/>
                    <select style="float: right;width: 50px;margin-top: -5px;" name="page_sr" onchange="coba('form1');"/>
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
                           <th style="text-align: center;">Customer <i class="fa fa-sort"></i></th>
                            <th>Product <i class="fa fa-sort"></i></th>
                            <th>Question <i class="fa fa-sort"></i></th>
                            <th>Answered <i class="fa fa-sort"></i></th>
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
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $data->name; ?></td>
                            <td><?php echo $data->product_name; ?></td>
                            <td><?php echo $data->question; ?></td>
                            <td><?php echo $data->answered; ?></td>
                            <td style="text-align: center;"><?php echo status($data->status); ?></td>
                            <td style="text-align: center;">
                                <button id="update" onclick="updatex('<?=$data->id;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Update</button></i></button> 
                            </td>
                        </tr>
                      <?php }} ?>
                        <tr>
                            <td><input name="customer_sr" class="form-control" value="<?=$customer_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><input name="product_sr" class="form-control" value="<?=$product_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><input name="question_sr" class="form-control" value="<?=$question_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><input name="answered_sr" class="form-control" value="<?=$answered_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
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
        function indexx(){
        window.location.replace("<?php echo base_url(); ?>private_message");
        }
        function updatex(id){
        window.location.replace("<?php echo base_url(); ?>private_message/update/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
        }
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
        }
</script>