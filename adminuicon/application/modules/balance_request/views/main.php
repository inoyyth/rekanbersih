<ol class="breadcrumb">
    <li> Report</li>
    <li class="active"></i> Wallet Request</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">Wallet Request</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                    <form method="post" action="<?=base_url();?>balance_request/search" id="form2"/>
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
                           <th style="text-align: center;">Request Number <i class="fa fa-sort"></i></th>
                            <th>Customer <i class="fa fa-sort"></i></th>
                            <th>Balance Before <i class="fa fa-sort"></i></th>
                            <th>Balance Request <i class="fa fa-sort"></i></th>
                            <th>Status  <i class="fa fa-sort"></i></th>
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
                            <td style="text-align: center;"><?php echo $data->request_number; ?></td>
                            <td><?php echo $data->name; ?></td>
                            <td><?php echo formatrp($data->balance_before); ?></td>
                            <td><?php echo formatrp($data->balance_request); ?></td>
                            <td style="text-align: center;"><?php echo status($data->status); ?></td>
                            <td style="text-align: center;">
                                <button id="update" onclick="updatex('<?=$data->id;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Update</button></i></button> 
                            </td>
                        </tr>
                      <?php }} ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <form method="post" action="<?=base_url();?>balance_request/search" id="form1"/>
                                <td><input name="request_number_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="name_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="before_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="request_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><select class="combo_search" name="status_sr" onchange="coba('form1');"/>
                                        <option value=""></option>
                                        <option value="Y">Active</option>
                                        <option value="N">Not Active</option>
                                    </select>
                                </td>
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
<script type="text/javascript">
        function updatex(id){
        window.location.replace("<?php echo base_url(); ?>balance_request/update/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
        }
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
        }
</script>