<ol class="breadcrumb">
    <li class="active"> Slider</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">Slider Management</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" />
            </div>
            <i>
                Total Data: <?=$total_data;?>
            </i>
            <input type="hidden" id="min_pos" value="<?=$position->minix;?>">
            <input type="hidden" id="max_pos" value="<?=$position->maxi;?>">
            <div class="table-responsive" style="font-size: 12px;">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <td style="text-align: center;">Title</td>
                            <td style="text-align: center;">Status</td>
                            <td style="text-align: center;">Ordered</td>
                            <td style="text-align: center;">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      if(count($data)<1){
                          echo"<td colspan='10' align='center'>Data Not Found</td>";
                      }else{
                      $no=0;
                      foreach($data as $data){
                          if($data->position==$position->minix){
                              $displayup="none";
                          }else{
                              $displayup="";
                          }
                          if($data->position==$position->maxi){
                              $displaybot="none";
                          }else{
                              $displaybot="";
                          }
                          $id_cat=$data->id;
                          $no++;
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $data->title; ?></td>
                            <td style="text-align: center;"><?php echo status($data->status); ?></td>
                            <td style="text-align: center;width: 15%;">
                                <button type="button" class="btn btn-default btn-xs down" style="display: <?=$displaybot;?>" id="up<?=$data->position;?>" onclick="to_down('<?=$data->position;?>');">
                                    <span class="fa fa-angle-down"></span>
                                </button>
                                <button type="button" class="btn btn-default btn-xs up" style="display: <?=$displayup;?>" id="down<?=$data->position;?>" onclick="to_up('<?=$data->position;?>');">
                                    <span class="fa fa-angle-up"></span>
                                </button>
                            </td>
                            <td style="text-align: center;width: 20%;">
<!--                                <button id="update" onclick="viewy('<?=$data->id;?>');" type="button" class="btn btn-success btn-xs"><i class="fa fa-edit"> View</button></i></button> -->
                                <button id="update" onclick="updatex('<?=$data->id;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                                <button id="delete" onclick="deletex('<?=$data->id;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                            </td>
                        </tr>
                      <?php }} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $this->load->view('combobox_autocomplete');?>
<script type="text/javascript">
    $(document).ready(function (){
        $("#new").click(function(){
           window.location.replace("<?php echo base_url(); ?>slider/add");
        });
        });
        function viewy(id){
        window.location.replace("<?php echo base_url(); ?>store_management/view_locator/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
        }  
        function updatex(id){
        window.location.replace("<?php echo base_url(); ?>slider/update/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
        }
         function deletex(id){
               if(confirm('Delete this record?')){
               window.location.replace("<?php echo base_url(); ?>slider/delete/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
                }else{

                }
            }
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
        }
</script>
<script type="text/javascript">
//    $(document).ready(function(){
//
//        $("table tbody tr:first .up").hide();
//        $("table tbody tr:last .down").hide();
//
//    $(".up,.down,.top,.bottom").click(function(){
//        var row = $(this).parents("tr:first");
//        if ($(this).is(".up")) {
//            row.insertBefore(row.prev());
//        } else if ($(this).is(".down")) {
//            row.insertAfter(row.next());
//        } else if ($(this).is(".top")) {
//            //row.insertAfter($("table tr:first"));
//            row.insertBefore($("table tr:first"));
//        }else {
//            row.insertAfter($("table tr:last"));
//        }
//    });
//});

function to_up(id){
    $.ajax({
         type:'post',
         url:"<?=base_url();?>slider/to_up",
         data: "id="+id,
         success: function(){
             window.location.replace("<?=base_url();?>slider");
         }
     });
}
function to_down(id){
    $.ajax({
         type:'post',
         url:"<?=base_url();?>slider/to_down",
         data: "id="+id,
         success: function(){
             window.location.replace("<?=base_url();?>slider");
         }
     });
}
</script>