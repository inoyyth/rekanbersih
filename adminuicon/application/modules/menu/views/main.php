<ol class="breadcrumb">
    <li> Menu</li>
    <li class="active"></i> Main Menu</li>
</ol>
<input type="button" class="btn btn-primary btn-xs" style="margin-bottom: 5px;" value="Main Menu" disabled />
<input type="button" class="btn btn-primary btn-xs" style="margin-bottom: 5px;" value="Top Menu" onclick="window.location.replace('<?=base_url();?>menu_top');" />
<input type="button" class="btn btn-primary btn-xs" style="margin-bottom: 5px;" value="Bottom Menu" onclick="window.location.replace('<?=base_url();?>menu_bottom');" />
<input type="button" class="btn btn-primary btn-xs" style="margin-bottom: 5px;" value="Other Menu" onclick="window.location.replace('<?=base_url();?>menu_other');" />
<div class="panel panel-default">
    <div class="panel-heading">Main Menu Management</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" />
            </div>
        <div class="table-responsive" style="font-size: 12px;">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th style="text-align: center;">ID <i class="fa fa-sort"></i></th>
                        <th>Parrent ID <i class="fa fa-sort"></i></th>
                        <th>Menu <i class="fa fa-sort"></i></th>
                        <th>Menu Type <i class="fa fa-sort"></i></th>
                        <th>Menu Level <i class="fa fa-sort"></i></th>
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
                        <td style="text-align: center;"><?php echo $data->id; ?></td>
                        <td><?php echo $data->menu_parent_id; ?></td>
                        <td><?php echo $data->menu_name; ?></td>
                        <td><?php echo $data->menu_typex; ?></td>
                        <td><?php echo ($data->menu_level=="0"?"Public":"Registered"); ?></td>
                        <td style="text-align: center;"><?php echo status($data->menu_status); ?></td>
                        <td style="text-align: center;">
                            <?php 
                            if($data->menu_position!=$min->min_pos){?>
                            <button class="btn btn-primary btn-xs" onclick="naik('<?=$data->id;?>','<?=$data->menu_parent_id;?>','<?=$data->menu_position;?>');"><i class="fa fa-angle-double-up"></i></button>
                            <?php
                            }
                            if($data->menu_position!=$max->max_pos){?>
                           <button class="btn btn-primary btn-xs" onclick="turun('<?=$data->id;?>','<?=$data->menu_parent_id;?>','<?=$data->menu_position;?>');"><i class="fa fa-angle-double-down"></i></button>
                            <?php
                            }
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <button id="update" onclick="updatex('<?=$data->id;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                            <button id="delete" onclick="deletex('<?=$data->id;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                        </td>
                    </tr>
                  <?php
                    $idx1=$data->id;
                    //data sub menu 1
                    $sql1=$this->db->query("select a.*,b.menu_type as menu_typex from menu a left join menu_type b on a.menu_type=b.id where a.menu_parent_id='$idx1' and a.menu_index='1' order by a.menu_position asc");
                    $max1=$this->db->query("select max(menu_position) as max_pos from menu where menu_parent_id='$idx1' and menu_index='1'");
                    $min1=$this->db->query("select min(menu_position) as min_pos from menu where menu_parent_id='$idx1' and menu_index='1'");
                    $dmax1= $max1->row_array();
                    $dmin1= $min1->row_array();
                    foreach($sql1->result_array() as $data1){
                  ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $data1['id']; ?></td>
                        <td><?php echo $data1['menu_parent_id']; ?></td>
                        <td> -> <?php echo $data1['menu_name']; ?></td>
                        <td><?php echo $data1['menu_typex']; ?></td>
                        <td><?php echo ( $data1['menu_level']=="0"?"Public":"Registered"); ?></td>
                        <td style="text-align: center;"><?php echo status($data1['menu_status']); ?></td>
                        <td style="text-align: center;">
                            <?php 
                            if($data1['menu_position']!=$dmax1['max_pos']){?>
                            <button class="btn btn-warning btn-xs" onclick="turun('<?=$data1['id'];?>','<?=$data1['menu_parent_id'];?>','<?=$data1['menu_position'];?>');"><i class="fa fa-angle-double-down"></i></button>
                            <?php
                            }
                            if($data1['menu_position']!=$dmin1['min_pos']){?>
                           <button class="btn btn-warning btn-xs" onclick="naik('<?=$data1['id'];?>','<?=$data1['menu_parent_id'];?>','<?=$data1['menu_position'];?>');"><i class="fa fa-angle-double-up"></i></button>
                            <?php
                            }
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <button id="update" onclick="updatex('<?=$data1['id'];?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                            <button id="delete" onclick="deletex('<?=$data1['id'];?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                        </td>
                    </tr>
                    <?php
                    $idx2=$data1['id'];
                    //data sub menu 1
                    $sql2=$this->db->query("select a.*,b.menu_type as menu_typex from menu a left join menu_type b on a.menu_type=b.id where a.menu_parent_id='$idx2' and a.menu_index='2' order by a.menu_position asc");
                    $max2=$this->db->query("select max(menu_position) as max_pos from menu where menu_parent_id='$idx2' and menu_index='2'");
                    $min2=$this->db->query("select min(menu_position) as min_pos from menu where menu_parent_id='$idx2' and menu_index='2'");
                    $dmax2= $max2->row_array();
                    $dmin2= $min2->row_array();
                    foreach($sql2->result_array() as $data2){
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $data2['id']; ?></td>
                        <td><?php echo $data2['menu_parent_id']; ?></td>
                        <td> -> -> <?php echo $data2['menu_name']; ?></td>
                        <td><?php echo $data2['menu_typex'];?></td>
                        <td><?php echo ( $data2['menu_level']=="0"?"Public":"Registered"); ?></td>
                        <td style="text-align: center;"><?php echo status($data2['menu_status']); ?></td>
                        <td style="text-align: center;">
                            <?php 
                            if($data2['menu_position']!=$dmax2['max_pos']){?>
                            <button class="btn btn-danger btn-xs" onclick="turun('<?=$data2['id'];?>','<?=$data2['menu_parent_id'];?>','<?=$data2['menu_position'];?>');"><i class="fa fa-angle-double-down"></i></button>
                            <?php
                            }
                            if($data2['menu_position']!=$dmin2['min_pos']){?>
                           <button class="btn btn-danger btn-xs" onclick="naik('<?=$data2['id'];?>','<?=$data2['menu_parent_id'];?>','<?=$data2['menu_position'];?>');"><i class="fa fa-angle-double-up"></i></button>
                            <?php
                            }
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <button id="update" onclick="updatex('<?=$data2['id'];?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                            <button id="delete" onclick="deletex('<?=$data2['id'];?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                        </td>
                    </tr>
                    <?php
                    $idx3=$data2['id'];
                    //data sub menu 1
                    $sql3=$this->db->query("select a.*,b.menu_type as menu_typex from menu a left join menu_type b on a.menu_type=b.id where a.menu_parent_id='$idx3' and a.menu_index='3' order by a.menu_position asc");
                    $max3=$this->db->query("select max(menu_position) as max_pos from menu where menu_parent_id='$idx3' and menu_index='3'");
                    $min3=$this->db->query("select min(menu_position) as min_pos from menu where menu_parent_id='$idx3' and menu_index='3'");
                    $dmax3= $max3->row_array();
                    $dmin3= $min3->row_array();
                        foreach($sql3->result_array() as $data3){
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $data3['id']; ?></td>
                        <td><?php echo $data3['menu_parent_id']; ?></td>
                        <td> -> -> -> <?php echo $data3['menu_name']; ?></td>
                        <td><?php echo $data3['menu_typex'];?></td>
                        <td><?php echo ( $data3['menu_level']=="0"?"Public":"Registered"); ?></td>
                        <td style="text-align: center;"><?php echo status($data3['menu_status']); ?></td>
                        <td style="text-align: center;">
                            <?php 
                            if($data3['menu_position']!=$dmax3['max_pos']){?>
                            <button class="btn btn-default btn-xs" onclick="turun('<?=$data3['id'];?>','<?=$data3['menu_parent_id'];?>','<?=$data3['menu_position'];?>');"><i class="fa fa-angle-double-down"></i></button>
                            <?php
                            }
                            if($data3['menu_position']!=$dmin3['min_pos']){?>
                           <button class="btn btn-default btn-xs" onclick="naik('<?=$data3['id'];?>','<?=$data3['menu_parent_id'];?>','<?=$data3['menu_position'];?>');"><i class="fa fa-angle-double-up"></i></button>
                            <?php
                            }
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <button id="update" onclick="updatex('<?=$data3['id'];?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                            <button id="delete" onclick="deletex('<?=$data3['id'];?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                        </td>
                    </tr>
                    <?php
                    $idx4=$data3['id'];
                    //data sub menu 1
                    $sql4=$this->db->query("select a.*,b.menu_type as menu_typex from menu a left join menu_type b on a.menu_type=b.id where a.menu_parent_id='$idx4' and a.menu_index='4' order by a.menu_position asc");
                    $max4=$this->db->query("select max(menu_position) as max_pos from menu where menu_parent_id='$idx4' and menu_index='4'");
                    $min4=$this->db->query("select min(menu_position) as min_pos from menu where menu_parent_id='$idx4' and menu_index='4'");
                    $dmax4= $max4->row_array();
                    $dmin4= $min4->row_array();
                    foreach($sql4->result_array() as $data4){
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $data4['id']; ?></td>
                        <td><?php echo $data4['menu_parent_id']; ?></td>
                        <td> -> -> -> -> <?php echo $data4['menu_name']; ?></td>
                        <td><?php echo $data4['menu_typex'];?></td>
                        <td><?php echo ( $data4['menu_level']=="0"?"Public":"Registered"); ?></td>
                        <td style="text-align: center;"><?php echo status($data4['menu_status']); ?></td>
                        <td style="text-align: center;">
                            <?php 
                            if($data4['menu_position']!=$dmax4['max_pos']){?>
                            <button class="btn btn-success btn-xs" onclick="turun('<?=$data4['id'];?>','<?=$data4['menu_parent_id'];?>','<?=$data4['menu_position'];?>');"><i class="fa fa-angle-double-down"></i></button>
                            <?php
                            }
                            if($data4['menu_position']!=$dmin4['min_pos']){?>
                           <button class="btn btn-success btn-xs" onclick="naik('<?=$data4['id'];?>','<?=$data4['menu_parent_id'];?>','<?=$data4['menu_position'];?>');"><i class="fa fa-angle-double-up"></i></button>
                            <?php
                            }
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <button id="update" onclick="updatex('<?=$data4['id'];?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                            <button id="delete" onclick="deletex('<?=$data4['id'];?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                        </td>
                    </tr>
                    <?php
                    $idx5=$data4['id'];
                    //data sub menu 1
                    $sql5=$this->db->query("select a.*,b.menu_type as menu_typex from menu a left join menu_type b on a.menu_type=b.id where a.menu_parent_id='$idx5' and a.menu_index='5' order by a.menu_position asc");
                    $max5=$this->db->query("select max(menu_position) as max_pos from menu where menu_parent_id='$idx5' and menu_index='5'");
                    $min5=$this->db->query("select min(menu_position) as min_pos from menu where menu_parent_id='$idx5' and menu_index='5'");
                    $dmax5= $max5->row_array();
                    $dmin5= $min5->row_array();
                    foreach($sql5->result_array() as $data5){
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $data5['id']; ?></td>
                        <td><?php echo $data5['menu_parent_id']; ?></td>
                        <td> -> -> -> -> -> <?php echo $data5['menu_name']; ?></td>
                        <td><?php echo $data['menu_typex'];?></td>
                        <td><?php echo ( $data5['menu_level']=="0"?"Public":"Registered"); ?></td>
                        <td style="text-align: center;"><?php echo status($data5['menu_status']); ?></td>
                        <td style="text-align: center;">
                            <?php 
                            if($data5['menu_position']!=$dmax5['max_pos']){?>
                            <button class="btn btn-default btn-xs" onclick="turun('<?=$data5['id'];?>','<?=$data5['menu_parent_id'];?>','<?=$data5['menu_position'];?>');"><i class="fa fa-angle-double-down"></i></button>
                            <?php
                            }
                            if($data5['menu_position']!=$dmin5['min_pos']){?>
                           <button class="btn btn-default btn-xs" onclick="naik('<?=$data5['id'];?>','<?=$data5['menu_parent_id'];?>','<?=$data5['menu_position'];?>');"><i class="fa fa-angle-double-up"></i></button>
                            <?php
                            }
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <button id="update" onclick="updatex('<?=$data5['id'];?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                            <button id="delete" onclick="deletex('<?=$data5['id'];?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                        </td>
                    </tr>
                  <?php }}}}}}} ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('combobox_autocomplete');?>
<script type="text/javascript">
    $(document).ready(function (){
        $("#new").click(function(){
           window.location.replace("<?php echo base_url(); ?>menu/add");
        });
        });
        function updatex(id){
        window.location.replace("<?php echo base_url(); ?>menu/update/"+id);
        }
        function deletex(id){
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>menu/cek_delete",
                data: "id="+id,
                success: function (dt) {
                    if(dt==="1"){
                        if(confirm('This Menu Have Children, Delete This Menu ?')){
                        window.location.replace("<?php echo base_url(); ?>menu/delete/"+id);
                        }
                    }else{
                        if(confirm('Delete This Menu ?')){
                        window.location.replace("<?php echo base_url(); ?>menu/delete/"+id);
                        }
                    }
                }
            });
        }
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
        }
        function naik(menuparent,menuid,menuposition){
            //alert(menuparent+"-"+menuid);
            window.location.replace("<?php echo base_url(); ?>menu/naik/"+menuparent+"/"+menuid+"/"+menuposition);
        }
        function turun(menuparent,menuid,menuposition){
            //alert(menuparent+"-"+menuid);
            window.location.replace("<?php echo base_url(); ?>menu/turun/"+menuparent+"/"+menuid+"/"+menuposition);
        }
</script>