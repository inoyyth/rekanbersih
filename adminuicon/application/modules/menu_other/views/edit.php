<form method="post" action="<?=base_url();?>menu_other/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>menu_other');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Add Menu </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="form-group">
            <label>Menu Name</label>
            <input type="text" class="form-control" name="menu_name" value="<?=$list->menu_name;?>"  required/>
            <input type="hidden" class="form-control" name="id" value="<?=$list->id;?>"/>
        </div>
        <div class="form-group">
            <label>Menu Parent</label>
            <select class="form-control" name="menu_parent" required>
                <?php if($list->menu_parent_id=="0"){$cek0="selected";}else{$cek0="";}?>
                <option style="color: #005702;" value="0-0" <?=$cek0;?>>Parent Menu</option>
                <?php foreach($menu as $menux){ if($list->menu_parent_id==$menux->id){$cek1="selected";}else{$cek1="";}?>
                <option style="color: #000;" value="<?="1-".$menux->id;?>" <?=$cek1;?>><?=$menux->menu_name;?></option>
                    <?php
                    $mid=$menux->id;
                    $idx=$list->menu_parent_id;
                    $idx2=$list->id;
                    //echo $mid."<br>".$idx;
                    $sq=mysql_query("select * from menu_other where menu_parent_id='$mid' and id not in ($idx2) order by menu_position asc");
                    while($daty=  mysql_fetch_array($sq)){ if($idx==$daty['id']){$cek2="selected";}else{$cek2="";}?>
                    <option style="color: #0063DC;" value="<?="2-".$daty['id'];?>" <?=$cek2;?>> - <?=$daty['menu_name'];?></option>
                        <?php
                        $sqx=mysql_query("select * from menu_other where menu_parent_id='".$daty['id']."' and id not in ($idx2) order by menu_position asc");
                        while($datx=  mysql_fetch_array($sqx)){ if($idx==$datx['id']){$cek3="selected";}else{$cek3="";}?>
                        <option style="color: #86d5f8;" value="<?="3-".$datx['id'];?>" <?=$cek3;?>>  &nbsp;&nbsp; - - <?=$datx['menu_name'];?></option>
                            <?php
                            $sqc=mysql_query("select * from menu_other where menu_parent_id='".$datx['id']."' and id not in ($idx2) order by menu_position asc");
                            while($datc=  mysql_fetch_array($sqc)){ if($idx==$datc['id']){$cek4="selected";}else{$cek4="";}?>
                            <option style="color: #800;" value="<?="4-".$datc['id'];?>" <?=$cek4;?>>  &nbsp;&nbsp; - - - <?=$datc['menu_name'];?></option>
                                <?php
                                $sqb=mysql_query("select * from menu_other where menu_parent_id='".$datc['id']."' and id not in ($idx2) order by menu_position asc");
                                while($datb=  mysql_fetch_array($sqb)){ if($idx==$datb['id']){$cek5="selected";}else{$cek5="";}?>?>
                                <option style="color: #f0ad4e;" value="<?="5-".$datb['id'];?>" <?=$cek5;?>>  &nbsp;&nbsp; - - - - <?=$datb['menu_name'];?></option>
                                    <?php
                                    $sqd=mysql_query("select * from menu_other where menu_parent_id='".$datb['id']."' and id not in ($idx2) order by menu_position asc");
                                    while($datd=  mysql_fetch_array($sqd)){ if($idx==$datd['id']){$cek6="selected";}else{$cek6="";}?>?>
                                    <option style="color: yellow;" value="<?="6-".$datd['id'];?>" <?=$cek6;?>>  &nbsp;&nbsp; - - - - - <?=$datd['menu_name'];?></option>
                <?php }}}}}} ?>
            </select>
        </div>
        <div class="form-group" id="app">
            <label>Menu Type</label>
            <select name="menu_type" class="form-control" id="menu_type">
                <option value="">-select menu type-</option>
                <?php foreach($menu_type as $menu_typex){ 
                    if($list->menu_type==$menu_typex->id){
                        $cek="selected";
                    }else{
                        $cek="";
                    }
                ?>
                <option value="<?=$menu_typex->id;?>" <?=$cek;?>><?=$menu_typex->menu_type;?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Menu Value</label>
            <input type="text" autocomplete="off" class="form-control" id="menu_value" name="menu_value"  required/><a href="#" id="linkx">Search</a>
            <input type="hidden" autocomplete="off" class="form-control" id="kodex" name="kodex" value="<?=$list->menu_link;?>" required/>
        </div> 
        <div class="form-group">
            <label>Menu Open</label>
            <select name="menu_open" class="form-control" required>
                <?php
                    if($list->menu_open=="0"){
                        $self="selected";
                    }else{
                        $self="";
                    }
                    if($list->menu_open=="1"){
                        $new="selected";
                    }else{
                        $new="";
                    }
                ?>
                <option value="">-select-</option>
                <option value="0" <?=$self;?>>Self Page</option>
                <option value="1" <?=$new;?>>New Tab</option>
            </select>
        </div>
        <div class="form-group">
            <label>Menu Level</label>
            <select name="menu_level" class="form-control" required>
                <?php
                    if($list->menu_level=="0"){
                        $public="selected";
                    }else{
                        $public="";
                    }
                    if($list->menu_level=="1"){
                        $register="selected";
                    }else{
                        $register="";
                    }
                ?>
                <option value="0" <?=$public;?>>Public</option>
                <option value="1" <?=$register;?>>Registered</option>
            </select>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select class="combobox" style="width: 100%;font-size: 10px;" required name="status">
                <?php
                    if($list->menu_status=="Y"){
                        $y="selected";
                    }else{
                        $y="";
                    }
                    if($list->menu_status=="N"){
                        $n="selected";
                    }else{
                        $n="";
                    }
                ?>
                <option value="">Set Status</option>
                <option value="Y" <?=$y;?>>Active</option>
                <option value="N" <?=$n;?>>Not Active</option>
            </select>
        </div>
    </div>
</div>
</form>
<?php $this->load->view('combobox_autocomplete');?>
<script>
$(document).ready(function(){
    var kodex="<?=$list->menu_link;?>";
    var menu_type="<?=$list->menu_type;?>";
    var menu_desc="<?=$list->menu_description;?>";
    if(menu_type==="1"){
        var linkx = "'<?=base_url();?>menu/article'";  
        $("#linkx").attr('href','javascript:TampilModel('+linkx+')');
        $("#menu_value").attr('readonly','true');
        $("#kodex").val(kodex);
        $("#menu_value").val(menu_desc);
        $("#linkx").show();
    }if(menu_type==="2"){
        var linkx = "'<?=base_url();?>menu/category_article'";   
        $("#linkx").attr('href','javascript:TampilModel('+linkx+')');
        $("#menu_value").attr('readonly','true');
        $("#kodex").val(kodex);
        $("#menu_value").val(menu_desc);
        $("#linkx").show();
    }if(menu_type==="3"){
        $("#menu_value").attr('readonly','true');
        $("#menu_value").val('-');
        $("#linkx").hide();
    }if(menu_type==="4"){
        $("#menu_value").removeAttr('readonly');
        $("#kodex").val(kodex);
        $("#menu_value").val(menu_desc);
        $("#menu_value").focusout(function(){
            var isi =  $("#menu_value").val();
            $("#kodex").val(isi);
        });
        $("#linkx").hide();
    }if(menu_type==="5"){
        $("#menu_value").attr('readonly','true');
        $("#menu_value").val('-');
        $("#kodex").val("product");
        $("#linkx").hide();
    }if(menu_type==="6"){
        var linkx = "'<?=base_url();?>menu/category_commerce'";   
        $("#linkx").attr('href','javascript:TampilModel('+linkx+')');
        $("#menu_value").attr('readonly','true');
        $("#kodex").val(kodex);
        $("#menu_value").val(menu_desc);
        $("#linkx").show();
    }if(menu_type==="7"){
        var linkx = "'<?=base_url();?>menu/brand_commerce'";   
        $("#linkx").attr('href','javascript:TampilModel('+linkx+')');
        $("#menu_value").attr('readonly','true');
        $("#kodex").val(kodex);
        $("#menu_value").val(menu_desc);
        $("#linkx").show();
    }if(menu_type==="8"){
        $("#menu_value").attr('readonly','true');
        $("#menu_value").val('-');
        $("#kodex").val("home");
        $("#linkx").hide();
    }if(menu_type==="9"){
        $("#menu_value").attr('readonly','true');
        $("#menu_value").val('-');
        $("#kodex").val("latest_product");
        $("#linkx").hide();
    }if(menu_type==="10"){
        $("#menu_value").attr('readonly','true');
        $("#menu_value").val('-');
        $("#kodex").val("popular_product");
        $("#linkx").hide();
    }if(menu_type==="11"){
        $("#menu_value").attr('readonly','true');
        $("#menu_value").val('-');
        $("#kodex").val("contact_us");
        $("#linkx").hide();
    }if(menu_type==="12"){
        var linkx = "'<?=base_url();?>menu/subcategory_article'";   
        $("#linkx").attr('href','javascript:TampilModel('+linkx+')');
        $("#menu_value").attr('readonly','true');
        $("#kodex").val(kodex);
        $("#menu_value").val(menu_desc);
        $("#linkx").show();
    }if(menu_type==="13"){
        $("#menu_value").attr('readonly','true');
        $("#menu_value").val('-');
        $("#linkx").hide();
    }if(menu_type==="14"){
        $("#menu_value").attr('readonly','true');
        $("#menu_value").val('-');
        $("#linkx").hide();
    }if(menu_type==="15"){
        $("#menu_value").attr('readonly','true');
        $("#menu_value").val('-');
        $("#linkx").hide();
    }if(menu_type==="16"){
        $("#menu_value").attr('readonly','true');
        $("#menu_value").val('-');
        $("#kodex").val("hot_product");
        $("#linkx").hide();
    }if(menu_type==="17"){
        $("#menu_value").attr('readonly','true');
        $("#menu_value").val('-');
        $("#kodex").val("exclusive_product");
        $("#linkx").hide();
    }if(menu_type==="18"){
        $("#menu_value").attr('readonly','true');
        $("#menu_value").val('-');
        $("#kodex").val("tracking_order");
        $("#linkx").hide();
    }if(param==="19"){
            $("#menu_value").attr('readonly','true');
            $("#menu_value").val('-');
            $("#kodex").val("payment_confirmation");
            $("#linkx").hide();
    }if(menu_type==="20"){
        $("#menu_value").attr('readonly','true');
        $("#menu_value").val('-');
        $("#kodex").val("faq");
        $("#linkx").hide();
    }
    
    $("#menu_type").change(function(){
        $("#menu_value").val('');
        $("#kodex").val('');
        var param = this.value;
        var linkx="";
        if(param==="1"){
            var linkx = "'<?=base_url();?>menu/article'";  
            $("#linkx").attr('href','javascript:TampilModel('+linkx+')');
            $("#menu_value").attr('readonly','true');
            $("#linkx").show();
        }if(param==="2"){
            var linkx = "'<?=base_url();?>menu/category_article'";   
            $("#linkx").attr('href','javascript:TampilModel('+linkx+')');
            $("#menu_value").attr('readonly','true');
            $("#linkx").show();
        }if(param==="3"){
            $("#menu_value").attr('readonly','true');
            $("#menu_value").val('-');
            $("#kodex").val("article_list_category");
            $("#linkx").hide();
        }if(param==="4"){ 
            $("#menu_value").removeAttr('readonly');
            $("#menu_value").focusout(function(){
                var isi =  $("#menu_value").val();
                $("#kodex").val(isi);
            });
            $("#linkx").hide();
        }if(param==="5"){
            $("#menu_value").attr('readonly','true');
            $("#menu_value").val('-');
            $("#kodex").val("product");
            $("#linkx").hide();
        }if(param==="6"){
            var linkx = "'<?=base_url();?>menu/category_commerce'";   
            $("#linkx").attr('href','javascript:TampilModel('+linkx+')');
            $("#menu_value").attr('readonly','true');
            $("#linkx").show();
        }if(param==="7"){
            var linkx = "'<?=base_url();?>menu/brand_commerce'";   
            $("#linkx").attr('href','javascript:TampilModel('+linkx+')');
            $("#menu_value").attr('readonly','true');
            $("#linkx").show();
        }if(param==="8"){  
            $("#linkx").attr('href','javascript:TampilModel('+linkx+')');
            $("#menu_value").attr('readonly','true');
            $("#menu_value").val('-');
            $("#kodex").val("home");
            $("#linkx").hide();
        }if(param==="9"){  
            $("#menu_value").attr('readonly','true');
            $("#menu_value").val('-');
            $("#kodex").val("latest_product");
            $("#linkx").hide();
        }if(param==="10"){  
            $("#menu_value").attr('readonly','true');
            $("#menu_value").val('-');
            $("#kodex").val("popular_product");
            $("#linkx").hide();
        }if(param==="11"){  
            $("#menu_value").attr('readonly','true');
            $("#menu_value").val('-');
            $("#kodex").val("contact_us");
            $("#linkx").hide();
        }if(param==="12"){
            var linkx = "'<?=base_url();?>menu/subcategory_article'";   
            $("#linkx").attr('href','javascript:TampilModel('+linkx+')');
            $("#menu_value").attr('readonly','true');
            $("#linkx").show();
        }if(param==="13"){
            $("#menu_value").attr('readonly','true');
            $("#menu_value").val('-');
            $("#kodex").val("article_list_subcategory");
            $("#linkx").hide();
        }if(param==="14"){
            $("#menu_value").attr('readonly','true');
            $("#menu_value").val('-');
            $("#kodex").val("register");
            $("#linkx").hide();
        }if(param==="15"){
            $("#menu_value").attr('readonly','true');
            $("#menu_value").val('-');
            $("#kodex").val("sign_in");
            $("#linkx").hide();
        }if(param==="16"){
            $("#menu_value").attr('readonly','true');
            $("#menu_value").val('-');
            $("#kodex").val("hot_product");
            $("#linkx").hide();
        }if(param==="17"){
            $("#menu_value").attr('readonly','true');
            $("#menu_value").val('-');
            $("#kodex").val("exclusive_product");
            $("#linkx").hide();
        }if(param==="18"){
            $("#menu_value").attr('readonly','true');
            $("#menu_value").val('-');
            $("#kodex").val("tracking_order");
            $("#linkx").hide();
        }if(param==="19"){
            $("#menu_value").attr('readonly','true');
            $("#menu_value").val('-');
            $("#kodex").val("payment_confirmation");
            $("#linkx").hide();
        }if(param==="20"){
            $("#menu_value").attr('readonly','true');
            $("#menu_value").val('-');
            $("#kodex").val("faq");
            $("#linkx").hide();
        }
    });
});
function TampilModel(file){
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=400,width=700').focus();
}
function bersih(){
    $("#menu_value").attr('readonly','true');
}
</script>