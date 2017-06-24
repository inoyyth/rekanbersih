<ol class="breadcrumb">
    <li class="active"></i> Faq</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">FAQ Management</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" />
            </div>
        <div class="table-responsive" style="font-size: 12px;">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Question <i class="fa fa-sort"></i></th>
                        <th>Answered <i class="fa fa-sort"></i></th>
                        <th>Status <i class="fa fa-sort"></i></th>
                        <th style="text-align: center;">Sortir <i class="fa fa-sort"></i></th>
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
                        <td><?php echo $data->question; ?></td>
                        <td><?php echo $data->answered; ?></td>
                        <td style="text-align: center;width: 8%;"><?php echo ($data->status=="Y"?"Active":"Not Active"); ?></td>
                        <td style="text-align: center;width: 7%;">
                            <?php 
                            if($data->position!=$min->min_pos){?>
                            <button class="btn btn-primary btn-xs" onclick="naik('<?=$data->id;?>','<?=$data->position;?>');"><i class="fa fa-angle-double-up"></i></button>
                            <?php
                            }
                            if($data->position!=$max->max_pos){?>
                           <button class="btn btn-primary btn-xs" onclick="turun('<?=$data->id;?>','<?=$data->position;?>');"><i class="fa fa-angle-double-down"></i></button>
                            <?php
                            }
                            ?>
                        </td>
                        <td style="text-align: center;width: 13%;">
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
           window.location.replace("<?php echo base_url(); ?>faq/add");
        });
        });
        function updatex(id){
        window.location.replace("<?php echo base_url(); ?>faq/update/"+id);
        }
        function deletex(id){
            if(confirm('Delete this record?')){
            window.location.replace("<?php echo base_url(); ?>faq/delete/"+id);
        }else{
        }
        }
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
        }
        function naik(id,position){
            //alert(menuparent+"-"+menuid);
            window.location.replace("<?php echo base_url(); ?>faq/naik/"+id+"/"+position);
        }
        function turun(id,position){
            //alert(menuparent+"-"+menuid);
            window.location.replace("<?php echo base_url(); ?>faq/turun/"+id+"/"+position);
        }
</script>