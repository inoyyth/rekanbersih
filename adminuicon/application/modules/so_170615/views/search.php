<ol class="breadcrumb">
    <li> Report</li>
    <li class="active"> Sales Order<li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">Sales Order</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" />
                <form method="post" action="<?=base_url();?>so/search" id="form1"/>
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
                            <th style="text-align: center;">SO Number <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Customer <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Total Price <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Status <i class="fa fa-sort"></i></th>
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
                          $id_brand=$data->id_so;
                          $no++;
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $data->so_number; ?></td>
                            <td style="text-align: center;"><?php echo $data->name; ?></td>
                            <td style="text-align: center;"><?php echo formatrp($data->total_price); ?></td>
                            <td style="text-align: center;"><?php echo $data->status; ?></td>
                            <td style="text-align: center;">
                                <button id="update" onclick="updatex('<?=$data->id_so;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Detail</button></i></button> 
                                <!--<button id="delete" onclick="deletex('<?=$data->id_so;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>-->
                            </td>
                        </tr>
                    <?php }} ?>
                        <tr>
                            <td><input name="so_sr" class="form-control" value="<?=$so_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><input name="customer_sr" class="form-control" value="<?=$customer_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><input name="status_sr" class="form-control" value="<?=$status_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><input name="price_sr" class="form-control" value="<?=$price_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
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
           window.location.replace("<?php echo base_url(); ?>so/add");
        });
        });
        function indexx(){
        window.location.replace("<?php echo base_url(); ?>so");
        }
        function updatex(id){
        window.location.replace("<?php echo base_url(); ?>so/detail/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
        }
         function deletex(id){
               if(confirm('Delete this record?')){
               window.location.replace("<?php echo base_url(); ?>so/delete/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
                }else{

                }
            }
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
        }
</script>