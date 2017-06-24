<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/themes/panel/data-tables/media/css/jquery.dataTables.css">
<style type="text/css" title="currentStyle">
        @import "<?=base_url();?>assets/themes/panel/data-tables/js/demo_page.css";
        @import "<?=base_url();?>assets/themes/panel/data-tables/js/demo_table.css";
        @import "<?=base_url();?>assets/themes/panel/data-tables/js/TableTools.css";
</style>
<h2>Store Locator Management</h2>
<div class="tabs">
	<ul>
		<li><a href="#tabs-1">City List</a></li>
		<li><a href="#tabs-2">Store List</a></li>
	</ul>
        <div id="tabs-1">
             <div style="margin-bottom: 5px;">
                <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new_city" />
            </div>
            <div class="table-responsive" style="font-size: 12px;">
                <table class="table table-striped table-bordered table-hover" id="example">
                    <thead>
                        <tr>
                            <th style="text-align: center;">ID <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">City <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Status <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Actions <i class="fa fa-sort"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      $no=0;
                      foreach($list_city as $data){
                          $no++;
                    ?>
                        <tr class="odd_gradeX">
                            <td style="text-align: center;"><?php echo $data->id;?></td>
                            <td><?php echo $data->city; ?></td>
                            <td style="text-align: center;"><?php echo status($data->status); ?></td>
                            <td style="text-align: center;">
                                <button id="update" onclick="updatex('<?=$data->id;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                                <button id="delete" onclick="deletex('<?=$data->id;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                            </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
	<div id="tabs-2">
            <div style="margin-bottom: 5px;">
                <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new_locator" />
            </div>
            <div class="table-responsive" style="font-size: 12px;">
                <table class="table table-bordered table-hover table-striped tablesorter" id="example2">
                    <thead>
                        <tr>
                            <th style="text-align: center;">ID <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">City <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Address <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Status <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Actions <i class="fa fa-sort"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      $no=0;
                      foreach($list_locator as $data){
                          $no++;
                          $panjang=$hasil1=strlen($data->address);
                          if($panjang > 100){
                              $addres =  substr($data->address, 0,100)."...";
                          }else{
                              $addres = $data->address;
                          }
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $data->id; ?></td>
                            <td><?php echo $data->city; ?></td>
                            <td><?php echo $addres; ?></td>
                            <td style="text-align: center;"><?php echo status($data->status); ?></td>
                            <td style="text-align: center;">
                                <button type="button" onclick="viewy('<?=$data->id;?>');" class="btn btn-success btn-xs"><i class="fa fa-desktop"> View</i></button>
                                <button id="update" onclick="updatey('<?=$data->id;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                                <button id="delete" onclick="deletey('<?=$data->id;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                            </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/jquery-1.10.2.js"></script>
<script>
    $(document).ready(function (){
        $("#tabs").tabs({ selected: 1 });
        $("#new_city").click(function(){
           window.location.replace("<?php echo base_url(); ?>locator_management/add_city");
        });
        $("#new_locator").click(function(){
           window.location.replace("<?php echo base_url(); ?>locator_management/add_locator");
        });
    });
    function updatex(id){
        window.location.replace("<?php echo base_url(); ?>locator_management/update_city/"+id);
    }
     function deletex(id){
           if(confirm('Delete this record?')){
           window.location.replace("<?php echo base_url(); ?>locator_management/delete_city/"+id);
            }else{

            }
        }
        
    function viewy(id){
        window.location.replace("<?php echo base_url(); ?>locator_management/view_locator/"+id);
    }    
    function updatey(id){
        window.location.replace("<?php echo base_url(); ?>locator_management/update_locator/"+id);
    }
     function deletey(id){
           if(confirm('Delete this record?')){
           window.location.replace("<?php echo base_url(); ?>locator_management/delete_locator/"+id);
            }else{

            }
        }
</script>
<script type="text/javascript" charset="utf-8">
    $(document).ready( function () {
            $('#example').dataTable( {
                "pagingType": "simple_numbers",
                "oLanguage": {
        "sEmptyTable": "No incompleted albums found!", //when empty
                    "sSearch": "<span>Filter records:</span> _INPUT_", //search
                    "sLengthMenu": "<span>Show entries:</span> _MENU_" //label
                    //"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" } //pagination
            }
            } );
    } );
</script>
<script type="text/javascript" charset="utf-8">
    $(document).ready( function () {
            $('#example2').dataTable( {
                "pagingType": "simple_numbers",
                "oLanguage": {
        "sEmptyTable": "No incompleted albums found!", //when empty
                    "sSearch": "<span>Filter records:</span> _INPUT_", //search
                    "sLengthMenu": "<span>Show entries:</span> _MENU_" //label
                    //"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" } //pagination
            }
            } );
    } );
</script>