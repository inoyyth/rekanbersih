<ol class="breadcrumb">
    <li class="active"></i> Logo Management</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">Logo Management</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" />
                    <form method="post" action="<?=base_url();?>logo/search" id="form2"/>
                        <select style="float: right;width: 50px;margin-top: -19px;" name="page_sr" onchange="coba('form2');"/>
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
                            <th>Logo Title <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Status <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Date</th>
                            <th style="text-align: center;">Image <i class="fa fa-sort"></i></th>
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
                            <td style="text-align: center;"><?php echo $data->id; ?></td>
                            <td><?php echo $data->logo_title; ?></td>
                            <td style="text-align: center;"><?php echo status($data->status); ?></td>
                            <td style="text-align: center;"><?php echo tgl_indo($data->sys_create_date); ?></td>
                            <td style="text-align: center;"><img onclick="opener_add('<?php echo $data->logo_image; ?>','<?php echo $data->logo_title; ?>');" src="<?=base_url();?>../userfiles/Image/logo/<?php echo $data->logo_image; ?>" width="50px" height="30px"></td>
                            <td style="text-align: center;">
                                <button id="update" onclick="updatex('<?=$data->id;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                                <button id="delete" onclick="deletex('<?=$data->id;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                            </td>
                        </tr>
                      <?php }} ?>
                        <tr>
                            <form method="post" action="<?=base_url();?>logo/search" id="form1"/>
                                <td><input name="id_sr" class="form-control" value="<?=$id_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="name_sr" class="form-control" value="<?=$name_sr;?>" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><select class="combo_search" name="status_sr" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/>
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
                                <td></td>
                                <td></td>
                                <td style="text-align: center;padding-top: 1.5%;">
                                    <button id="update" onclick="indexx();" type="button" class="btn btn-info btn-xs"><i class="fa fa-arrow-circle-left"> Clear Filter</button></i></button>
                                </td>
                            </form>
                        </tr>
                    </tbody>
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
           window.location.replace("<?php echo base_url(); ?>logo/add");
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
                    $(".imgx").attr("src","<?=base_url();?>../userfiles/Image/logo/"+id);
                    $(".judul").html(title);
                    $( "#dialog_attr" ).dialog( "open" );
                    $( ".closex" ).click(function() {
			$( "#dialog_attr" ).dialog("close");
                     });
                }
        function indexx(){
        window.location.replace("<?php echo base_url(); ?>logo");
        }
        function updatex(id){
        window.location.replace("<?php echo base_url(); ?>logo/update/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
        }
         function deletex(id){
               if(confirm('Delete this record?')){
               window.location.replace("<?php echo base_url(); ?>logo/delete/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
                }else{

                }
            }
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
        }
</script>