<ol class="breadcrumb">
    <li> Customer Inquiry</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">Customer Inquiry</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                <!--<input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" />-->
                <form method="post" action="<?=base_url();?>customer_inquiry/search" id="form1"/>
                    <select style="float: right;width: 50px;margin-top: -19px;" name="page_sr" onchange="coba('form1');"/>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
            </div>
            <i>
                Total Data: <?=$total_data;?>
            </i>
            <div class="table-responsive" style="font-size: 12px;">
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                        <tr>
                            <th>Name <i class="fa fa-sort"></i></th>
							<th>Email <i class="fa fa-sort"></i></th>
							<th>Phone <i class="fa fa-sort"></i></th>
							<th>Address <i class="fa fa-sort"></i></th>
							<th>Message <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Status <i class="fa fa-sort"></i></th>
							<th>Description <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;width:150px;">Actions <i class="fa fa-sort"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
					  $status = array('','Waiting','Follow Up','Done');
                      if(count($data)<1){
                          echo"<td colspan='10' align='center'>Data Not Found</td>";
                      }else{
                      $no=0;
                      foreach($data as $data){
                          $id_cat=$data->id;
                          $no++;
                    ?>
                        <tr>
                            <td><?php echo $data->inquiry_name; ?></td>
							<td><?php echo $data->inquiry_email; ?></td>
							<td><?php echo $data->inquiry_phone; ?></td>
							<td><?php echo $data->inquiry_address; ?></td>
							<td><?php echo $data->inquiry_message; ?></td>
                            <td style="text-align: center;"><?php echo $status[$data->status]; ?></td>
							<td><?php echo $data->description; ?></td>
                            <td style="text-align: center;">
                                <button id="update" onclick="updatex('<?=$data->id;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                                <!--<button id="delete" onclick="deletex('<?=$data->id;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>-->
                            </td>
                        </tr>
                      <?php }} ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><input name="name_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><input name="email_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
							<td><input name="phone_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
							<td><input name="address_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td></td>
							<td><select class="combo_search" name="status_sr" onchange="coba('form1');"/>
                                    <option value=""></option>
                                    <option value="1">Waiting</option>
                                    <option value="2">Follow Up</option>
									<option value="3">Done</option>
                                </select>
                            </td>
                            <td></td>
							<td></td>
                        </tr>
                    </tfoot>
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
           window.location.replace("<?php echo base_url(); ?>customer_inquiry/add");
        });
        });
        function updatex(id){
        window.location.replace("<?php echo base_url(); ?>customer_inquiry/update/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
        }
         function deletex(id){
               if(confirm('Delete this record?')){
               window.location.replace("<?php echo base_url(); ?>customer_inquiry/delete/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
                }else{

                }
            }
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
        }
</script>