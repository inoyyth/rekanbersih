<ol class="breadcrumb">
    <li> User Management</li>
    <li class="active"> List User Management<li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">User Management</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" />
                <form method="post" action="<?=base_url();?>user_management/search" id="form1"/>
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
                Total Data: <?=$total_data;?> <?php echo $active_sr;?>
            </i>
            <div class="table-responsive" style="font-size: 12px;">
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                        <tr>
                            <th style="text-align: center;">ID <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Username <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">First Name <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Last Name <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Email <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Active <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;width: 15%;">Action <i class="fa fa-sort"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      if(count($data) < 1){
                          echo"<td align='center' colspan='10'>Data Not Found</td>";
                      }else{
                      $no=0;
                      foreach($data as $data){
                          $no++;
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $data->user_id; ?></td>
                            <td style="text-align: center;"><?php echo $data->username; ?></td>
                            <td style="text-align: center;"><?php echo $data->first_name; ?></td>
                            <td style="text-align: center;"><?php echo $data->last_name; ?></td>
                            <td style="text-align: center;"><?php echo $data->email; ?></td>
                            <td style="text-align: center;"><?php echo ($data->active=="Y" ? "Yes" : "No"); ?></td>
                            <td style="text-align: center;">
                                <button id="update" onclick="updatex('<?=$data->user_id;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                                <button id="delete" onclick="deletex('<?=$data->user_id;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                            </td>
                        </tr>
                    <?php }} ?>
                        <tr>
                            <td><input name="id_sr" class="form-control" value="<?=$id_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><input name="username_sr" class="form-control" value="<?=$username_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><input name="firstname_sr" class="form-control" value="<?=$firstname_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><input name="lastname_sr" class="form-control" value="<?=$lastname_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><input name="email_sr" class="form-control" value="<?=$email_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td>
                                <select name="active_sr" class="form-control" style="width: 100%;" onchange="coba('form1');">
                                    <?php 
                                        if($active_sr=="Y"){
                                            $y="selected";
                                        }else{
                                            $y="";
                                        }
                                        if($active_sr=="N"){
                                            $n="selected";
                                        }else{
                                            $n="";
                                        }
                                ?>
                                    <option value=""> - </option>
                                    <option value="Y" <?=$y;?>>Yes</option>
                                    <option value="N" <?=$n;?>>No</option>
                                </select>
                            </td>
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
           window.location.replace("<?php echo base_url(); ?>user_management/add");
        });
        });
        function indexx(){
        window.location.replace("<?php echo base_url(); ?>user_management");
        }
        function updatex(id){
        window.location.replace("<?php echo base_url(); ?>user_management/update/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
        }
         function deletex(id){
               if(confirm('Delete this record?')){
               window.location.replace("<?php echo base_url(); ?>user_management/delete/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
                }else{

                }
            }
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
        }
</script>