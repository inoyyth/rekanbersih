

<form method="post" action="<?= base_url(); ?>article2/update_proses" enctype="multipart/form-data" >
    <div style="margin-bottom: 5px;text-align: right;">       
        <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>article2/');" class="btn btn-success" value="Back" />
    </div>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"> Change Position Sub Article : <?php echo $article->article_title; ?></h3>
        </div>
        <div class="panel-body" id="panelx">
            <div class="form-group">
                
                
                
                
                
            </div>
            
            
            
        </div>
    </div>
</form>




<?php $this->load->view('combobox_autocomplete'); ?>
<script type="text/javascript" src="<?= base_url(); ?>assets/arkjs/basic.js"/></script>
<script type="text/javascript">

            
</script>