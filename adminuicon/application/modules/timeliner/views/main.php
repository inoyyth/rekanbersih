<ol class="breadcrumb">
    <li class="active"></i> Timeliner</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">Timeliner Management</div>
       <div class="panel-body">
            <div style="margin-bottom: 5px;">
                <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" />
                    <form method="post" action="<?=base_url();?>timeliner/search" id="form2"/>
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
                            <th>Content <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Year <i class="fa fa-sort"></i></th>
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
                            <td style="text-align: center;"><?php echo $data->id; ?></td>
                            <td><?php echo "<b>".$data->title."</b><br>".wordlimitx(strip_tags($data->content)); ?></td>
                            <td style="text-align: center;"><?php echo $data->year; ?></td>
                            <td style="text-align: center;"><?php echo status($data->status); ?></td>
                            <td style="text-align: center;">
                                <button id="update" onclick="updatex('<?=$data->id;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                                <button id="delete" onclick="deletex('<?=$data->id;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                            </td>
                        </tr>
                      <?php }} ?>
                        <tr>
                            <form method="post" action="<?=base_url();?>timeliner/search" id="form1"/>
                                <td><input name="id_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="content_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="year_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><select class="combo_search" name="status_sr" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/>
                                        <option value=""></option>
                                        <option value="Y">Active</option>
                                        <option value="N">Not Active</option>
                                    </select>
                                </td>
                                <td></td>
                            </form>
                        </tr>
                    </tbody>
                </table>
                <div class="pagination"><?=$halaman;?></div>
            </div>
        </div>
    </div>
    <div id="visualization"></div>
<!--<iframe src='http://cdn.knightlab.com/libs/timeline/latest/embed/index.html?source=0Au3YnVrTAeu8dERhbzdMTkdvUERzOU1ERWV1SWxURkE&font=Bevan-PotanoSans&maptype=toner&lang=en&height=650' width='100%' height='650' frameborder='0'></iframe>-->
<!--<div id="dialog_attr" title="Image Show">
    <img class="imgx" style="width: 100%;padding: 5%;">
    <div class="judul" style="text-align: center;margin-top:-16px;font-weight: bolder;"></div>
</div>-->
<!--end attribute form-->
<?php $this->load->view('combobox_autocomplete');?>
<script src="<?=base_url();?>assets/dist/vis.js"></script>
<link href="<?=base_url();?>assets/dist/vis.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    $(document).ready(function (){
        $("#new").click(function(){
           window.location.replace("<?php echo base_url(); ?>timeliner/add");
        });
        });
        function updatex(id){
        window.location.replace("<?php echo base_url(); ?>timeliner/update/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
        }
         function deletex(id){
               if(confirm('Delete this record?')){
               window.location.replace("<?php echo base_url(); ?>timeliner/delete/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
                }else{

                }
            }
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
        }
</script>
<!--<script type="text/javascript">
  // DOM element where the Timeline will be attached
  var container = document.getElementById('visualization');

  // Create a DataSet (allows two way data-binding)
  var items = new vis.DataSet([
//    {id: 1, content: 'item 1', start: '2014-04-20'},
//    {id: 2, content: 'item 2', start: '2014-04-14'},
//    {id: 3, content: 'item 3', start: '2014-04-18'},
//    {id: 4, content: 'item 4', start: '2014-04-16 20:00:00', end: '2014-04-19 21:00:00'},
//    {id: 5, content: 'item 5', start: '2014-04-25'},
//    {id: 6, content: 'item 6', start: '2014-04-27', type: 'point'}
 <?php
    $sql=mysql_query("select * from timeliner order by start_date");
    while($datay=  mysql_fetch_array($sql)){
        echo "{id: ".$datay['id'].", content: '".$datay['title']."', start: '".$datay['start_date']."', end: '".$datay['end_date']."'},";
    }
    ?>
  ]);

  // Configuration for the Timeline
  var options = {};

  // Create a Timeline
  var timeline = new vis.Timeline(container, items, options);
</script>-->
