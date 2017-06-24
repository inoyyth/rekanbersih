<ol class="breadcrumb">
    <li> Editorpick</li>
    <li class="active"></i> Editorpick</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">Editorpick Management</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" />
                    <form method="post" action="<?=base_url();?>editorpick/search" id="form2"/>
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
                            <th>Theme <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Image <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Status <i class="fa fa-sort"></i></th>
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
                            <td style="text-align: center;width: 8%"><?php echo $data->id; ?></td>
                            <td><?php echo $data->theme_name; ?></td>
                            <td style="text-align: center;"><img onclick="opener_add('<?php echo $data->theme_images; ?>','<?php echo $data->theme_name; ?>');" src="../userfiles/Image/editorpick/<?php echo $data->theme_images; ?>" width="50px" height="30px"></td>
                            <td style="text-align: center;"><?php echo status($data->status); ?></td>
                            <td style="text-align: center;width: 25%;">
                                <button type="button" onclick="viewy('<?=$data->id;?>');" class="btn btn-success btn-xs"><i class="fa fa-desktop"> View</i></button>
                                <button id="update" onclick="updatex('<?=$data->id;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                                <button id="delete" onclick="deletex('<?=$data->id;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                            </td>
                        </tr>
                    </tbody>
                      <?php }} ?>
                    <tfoot>
                        <tr>
                            <form method="post" action="<?=base_url();?>editorpick/search" id="form1"/>
                                <td><input name="id_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="name_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td></td>
                                <td><select class="combo_search" name="status_sr" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/>
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
    <div id="dialog_attr" title="Image Show">
        <img class="imgx" style="width: 100%;padding: 5%;">
        <div class="judul" style="text-align: center;margin-top:-16px;font-weight: bolder;"></div>
    </div>
<!--end attribute form-->
<?php $this->load->view('combobox_autocomplete');?>
<script type="text/javascript">
    $(document).ready(function (){
        $("#new").click(function(){
           window.location.replace("<?php echo base_url(); ?>editorpick/add");
        });
        
        $( "#dialog_attr" ).dialog({
			autoOpen: false,
                        modal: true,
                        width: '400',
			show: {
				effect: "blind",
				duration: 5000
			},
			hide: {
				effect: "explode",
				duration: 5000
			}
		});
        });
        
        function opener_add(id,title){
                    $(".imgx").attr("src","../userfiles/Image/editorpick/"+id);
                    $(".judul").html(title);
                    $( "#dialog_attr" ).dialog( "open" );
                    $( ".closex" ).click(function() {
			$( "#dialog_attr" ).dialog("close");
                     });
                }
                
        function updatex(id){
        window.location.replace("<?php echo base_url(); ?>editorpick/update/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
        }
         function deletex(id){
               if(confirm('Delete this record?')){
               window.location.replace("<?php echo base_url(); ?>editorpick/delete/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
                }else{

                }
            }
            function viewy(id){
        window.location.replace("<?php echo base_url(); ?>editorpick/view/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
    }   
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
        }
</script>