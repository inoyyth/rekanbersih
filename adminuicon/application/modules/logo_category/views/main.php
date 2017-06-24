<ol class="breadcrumb">
    <li class="active"></i> Logo Category Management</li>
</ol>
<form method="post" action="<?=base_url();?>logo_category/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>logo/search');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel-group" id="accordion">
    <?php foreach($category as $categoryx){?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collaps<?=$categoryx->id;?>">
                  <?=$categoryx->product_category_name;?>
                </a><i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
            </h4>
        </div>
        <div id="collaps<?=$categoryx->id;?>" class="panel-collapse collapse in">
            <div class="panel-body">
                <div style="overflow-x: scroll;">
                    <table class="table table-bordered table-hover table-striped tablesorter">
                        <tr>
                            <input type="hidden" name="category[]" value="<?=$categoryx->id;?>"/>
                            <?php
                                foreach($logo as $logox){ 
                                $cat_idx=$categoryx->id.','.$logox->id;
                                $query=mysql_query("select SUBSTR(logo_id,4,2) as logo from category_logo WHERE logo_id='$cat_idx'");
                                $x=  mysql_fetch_array($query);
                                if($x['logo']==$logox->id){
                                    $cek="checked";
                                }else{
                                    $cek="";
                                }
                            ?>
                            <td style="border: 1px solid;">
                                <input type="checkbox" name="logo[]" value="<?=$categoryx->id;?>,<?=$logox->id;?>" <?=$cek;?>>
                                <img src="../userfiles/Image/logo/<?=$logox->logo_image;?>" height="100px" width="100px"/>
                            </td>
                            <?php } ?>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
</form>
<script type="text/javascript">
    function toggleChevron(e) {
    $(e.target)
        .prev('.panel-heading')
        .find("i.indicator")
        .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
    }
    $('#accordion').on('hidden.bs.collapse', toggleChevron);
    $('#accordion').on('shown.bs.collapse', toggleChevron);
    
</script>
