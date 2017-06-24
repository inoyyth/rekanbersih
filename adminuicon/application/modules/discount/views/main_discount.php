<ol class="breadcrumb">
    <li> Discount</li>
    <li class="active"></i> List Discount</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">List Discount</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" /> 
                <input type="button" class="btn btn-primary btn-xs" value="Discount" id="discount"/> 
                <input type="button" class="btn btn-warning btn-xs" value=" Sale Page Setting" id="sale_page" /> 
                <?php if($page_status->status=="Y"){ ?>
                    <i class="fa fa-check-square-o"></i> active
                <?php }else{ ?>
                    <i class="fa fa-times"></i> not active
                <?php } ?>
                <form method="post" action="<?=base_url();?>discount/search_main_discount" id="form2"/>
                    <select style="float: right;width: 50px;margin-top: -10px;" name="page_sr" onchange="coba('form2');"/>
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
                            <th style="text-align: center;">Name <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Discount Type <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Min Value <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Status <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Action <i class="fa fa-sort"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      if(count($data)<1){
                          echo"<td colspan='10' align='center'>Data Not Found</td>";
                      }else{
                      $no=0;
                      foreach($data as $data){?>
                        <tr>
                            <td style="text-align: center;width: 20%;"><?php echo $data->discount_name; ?></td>
                            <td style="text-align: center;width: 20%;"><?php echo $data->parameter_discount; ?></td>
                            <td style="text-align: center;"><?php echo formatrp($data->minimum_value); ?></td>
                            <td style="text-align: center;"><?php echo status($data->status); ?></td>
                            <td style="text-align: center;width: 15%;">
                                <button id="update" onclick="updatex('<?=$data->id;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                                <button id="delete" onclick="deletex('<?=$data->id;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                            </td>
                        </tr>
                      <?php }} ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <form method="post" action="<?=base_url();?>discount/search_main_discount" id="form1"/>
                                <td><input name="name_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="parameter_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="minimum_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td>
                                    <select class="combo_search" name="status_sr" onchange="coba('form1');"/>
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
    $(document).ready(function (){
        $("#new").click(function(){
           window.location.replace("<?php echo base_url(); ?>discount/add_main_discount");
        });
        $("#discount").click(function(){
           window.location.replace("<?php echo base_url(); ?>discount/index");
        });
    $("#sale_page").click(function(){
           window.location.replace("<?php echo base_url(); ?>discount/sale_page");
        });
    });
         function updatex(id){
        window.location.replace("<?php echo base_url(); ?>discount/update_main_discount/"+id);
        }
         function deletex(id){
               if(confirm('Delete this record?')){
               window.location.replace("<?php echo base_url(); ?>discount/delete_main_discount/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
                }else{

                }
            }
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
        }
</script>
<script>
$(function() {
$( "#from" ).datepicker({
defaultDate: "+1w",
changeMonth: true,
dateFormat: "yy-mm-dd",
//numberOfMonths: 3,
onClose: function( selectedDate ) {
$( "#to" ).datepicker( "option", "minDate", selectedDate );
}
});
$( "#to" ).datepicker({
defaultDate: "+1w",
changeMonth: true,
dateFormat: "yy-mm-dd",
//numberOfMonths: 3,
onClose: function( selectedDate ) {
$( "#from" ).datepicker( "option", "maxDate", selectedDate );
}
});
});
</script>