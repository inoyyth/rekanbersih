<ol class="breadcrumb">
    <li> Sales Order</li>
    <li class="active"></i> Sales Order</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">Sales Order</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                <!-- <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" />-->
                    <form method="post" action="<?=base_url();?>sales_order/search" id="form2"/>
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
                           <th style="text-align: center;">ID <i class="fa fa-sort"></i></th>
                            <th>Nama <i class="fa fa-sort"></i></th>
                            <th>Handphone <i class="fa fa-sort"></i></th>
                            <th>Email <i class="fa fa-sort"></i></th>
							<th>Tanggal <i class="fa fa-sort"></i></th>
							<th>Tipe <i class="fa fa-sort"></i></th>
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
						  if ($data->status == 1) {
							  $status = "Waiting";
						  } else if ($data->status == 2) {
							  $status = "Follow Up";
						  } else if ($data->status == 3) {
							  $status = "Not Response";
						  } else {
							  $status = "Done";
						  }
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $data->id; ?></td>
                            <td><?php echo $data->nama; ?></td>
                            <td><?php echo $data->handphone; ?></td>
                            <td><?php echo $data->email; ?></td>
							<td><?php echo $data->tanggal; ?></td>
							<td style="text-transform: capitalize;"><?php echo $data->tipe_paket; ?></td>
							<td style="text-transform: capitalize;"><?php echo $status; ?></td>
                            <td style="text-align: center;">
                                <button id="update" onclick="updatex('<?=$data->id;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Detail</button></i></button> 
                                <!--<button id="delete" onclick="deletex('<?=$data->id;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>-->
                            </td>
                        </tr>
                      <?php }} ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <form method="post" action="<?=base_url();?>sales_order/search" id="form1"/>
                                <td><input name="id_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="name_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="handphone_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="email_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="tanggal_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
								<td><input name="tipe_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
								<td><select class="combo_search" name="status_sr" onchange="coba('form1');"/>
                                    <option value=""></option>
                                    <option value="1">Waiting</option>
                                    <option value="2">Follow Up</option>
									<option value="3">Not Response</option>
									<option value="4">Done</option>
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
    $(document).ready(function (){
        $("#new").click(function(){
           window.location.replace("<?php echo base_url(); ?>sales_order/add");
        });
        });
        function updatex(id){
        window.location.replace("<?php echo base_url(); ?>sales_order/update/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
        }
         function deletex(id){
               if(confirm('Delete this record?')){
               window.location.replace("<?php echo base_url(); ?>sales_order/delete/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
                }else{

                }
            }
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
        }
</script>