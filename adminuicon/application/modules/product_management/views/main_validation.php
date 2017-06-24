<ol class="breadcrumb">
    <li> Product Mgt.</li>
    <li class="active"> Validation Stock<li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">Export & Import</div>
    <div class="panel-body">
        <form method="post" id="f_validation_stock" action="<?=base_url();?>product_management/validation_stock_proses" enctype="multipart/form-data" role="form">
        <div class="form-group">
            <label>Please Choose Your Excel file</label>
            <input type="file" class="form-control" name="import" required>
        </div>
        <div class="form-group">
            <label></label>
            <input type="submit" class="btn btn-primary" name="submit" value="Validation"> 
            <input type="button" class="btn btn-warning" name="down" value="Download Sample" id="down" >
        </div>
    </div>
</div>
<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/jquery-1.10.2.js"></script>
<script>
    $(document).ready(function (){
        $("#down").click(function(){
          window.location.replace("<?=base_url();?>assets/excel_template/validation_stock_template.xlsx");
        });
        $("#f_product").submit(function(){
            $("#f_validation_stock").show();
        });
    });
</script>