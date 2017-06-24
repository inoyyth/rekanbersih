<form method="post" action="<?=base_url();?>menu/add_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>menu');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Add Menu </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="form-group">
            <label>Menu Name</label>
            <input type="text" class="form-control" name="menu_name" autocomplete="false"  required/>
        </div>
        <div class="form-group">
            <label>Menu Parent</label>
            <select class="form-control" name="menu_parent" required>
                <option value="0-0" selected>Parent Menu</option>
                <?php foreach($menu as $menux){?>
                <option value="<?="1-".$menux->id;?>"><?=$menux->menu_name;?></option>
                    <?php
                    $mid=$menux->id;
                    $sq=$this->db->query("select * from menu where menu_parent_id='$mid' order by menu_position asc");
                    foreach($sq->result_array() as $daty){?>
                    <option value="<?="2-".$daty['id'];?>"> - <?=$daty['menu_name'];?></option>
                        <?php
                        $sqx=$this->db->query("select * from menu where menu_parent_id='".$daty['id']."' order by menu_position asc");
                        foreach($sqx->result_array() as $datx){?>
                        <option value="<?="3-".$datx['id'];?>">  &nbsp;&nbsp; - - <?=$datx['menu_name'];?></option>
                            <?php
                            $sqc=$this->db->query("select * from menu where menu_parent_id='".$datx['id']."' order by menu_position asc");
                            foreach($sqc->result_array() as $datc){?>
                            <option value="<?="4-".$datc['id'];?>">  &nbsp;&nbsp; - - - <?=$datc['menu_name'];?></option>
                                <?php
                                $sqb=$this->db->query("select * from menu where menu_parent_id='".$datc['id']."' order by menu_position asc");
                                foreach($sqb->result_array() as $datb){?>
                                <option value="<?="5-".$datb['id'];?>">  &nbsp;&nbsp; - - - - <?=$datb['menu_name'];?></option>
                                    <?php
                                    $sqd=$this->db->query("select * from menu where menu_parent_id='".$datb['id']."' order by menu_position asc");
                                    foreach($sqd as $datd){?>
                                    <option value="<?="6-".$datd['id'];?>">  &nbsp;&nbsp; - - - - - <?=$datd['menu_name'];?></option>
                <?php }}}}}} ?>
            </select>
        </div>
        <div class="form-group" id="app">
            <label>Menu Type</label>
            <select name="menu_type" class="form-control" id="menu_type">
                <option value="">-select menu type-</option>
                <?php foreach($menu_type as $menu_typex){ ?>
                <option value="<?=$menu_typex->id;?>"><?=$menu_typex->menu_type;?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Menu Value</label>
            <input type="text" class="form-control" autocomplete="off" id="menu_value" name="menu_value" autocomplete="false"  required/><a href="#" id="linkx">Search</a>
            <input type="hidden" autocomplete="off" class="form-control" id="kodex" name="kodex"  required/>
        </div> 
        <div class="form-group">
            <label>Menu Open</label>
            <select name="menu_open" class="form-control" required>
                <option value="">-select-</option>
                <option value="0">Self Page</option>
                <option value="1">New Tab</option>
            </select>
        </div>
        <div class="form-group">
            <label>Menu Level</label>
            <select name="menu_level" class="form-control" required>
                <option value="0">Public</option>
                <option value="1">Registered</option>
            </select>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select class="combobox" style="width: 100%;font-size: 10px;" required name="status">
                <option value="">Set Status</option>
                <option value="Y">Active</option>
                <option value="N">Not Active</option>
            </select>
        </div>
    </div>
</div>
</form>
<?php $this->load->view('combobox_autocomplete');?>
<script>
$(document).ready(function(){
    $("#menu_value").attr('readonly','true');
    $("#linkx").hide();
    $("#menu_type").change(function(){
        $("#menu_value").val('');
        $("#kodex").val('');
        var param = this.value;
        var linkx="";
        if(param==="1"){
            var linkx = "'article'";  
            $("#linkx").attr('href','javascript:TampilModel('+linkx+')');
            $("#menu_value").attr('readonly','true');
            $("#linkx").show();
        }if(param==="2"){
            var linkx = "'category_article'";   
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
            var linkx = "'category_commerce'";   
            $("#linkx").attr('href','javascript:TampilModel('+linkx+')');
            $("#menu_value").attr('readonly','true');
            $("#linkx").show();
        }if(param==="7"){
            var linkx = "'brand_commerce'";   
            $("#linkx").attr('href','javascript:TampilModel('+linkx+')');
            $("#menu_value").attr('readonly','true');
            $("#linkx").show();
        }if(param==="8"){  
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
            var linkx = "'subcategory_article'";   
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