<ol class="breadcrumb">
    <li></i> Editorpick</li>
    <li class="active"></i> View
    </li>
</ol>
<div style="margin-bottom: 5px;text-align: right;">
   <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>editorpick');" class="btn btn-danger" value="Back" />
</div>
<div class="bs-example">
    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
      <li class="active"><a href="#home" data-toggle="tab">Theme Detail</a></li>
      <li><a href="#profile" data-toggle="tab">Theme Product List</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="home">
          <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>ID</label>
                    <input type="text" class="form-control" name="id" value="<?=$detail->id;?>"  readonly/>
                </div>
                <div class="form-group">
                    <label>Theme Name</label>
                    <input type="text" class="form-control" name="theme_name" value="<?=$detail->theme_name;?>" readonly/>
                </div>
                <div class="form-group">
                    <label>Theme Description</label>
                    <input type="text" class="form-control" name="theme_name" value="<?=$detail->theme_description;?>"  readonly/>
                </div>
                <div class="form-group">
                    <label>Theme Image</label>
                    <div>
                        <img src="../../../../userfiles/Image/editorpick/<?=$detail->theme_images;?>"/>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="tab-pane fade" id="profile">
            <div class="table-responsive" style="font-size: 12px;">
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                        <tr>
                            <th style="text-align: center;">ID <i class="fa fa-sort"></i></th>
                            <th>Product Name <i class="fa fa-sort"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      if(count($list_barang)<1){
                          echo"<td colspan='10' align='center'>Data Not Found</td>";
                      }else{
                      $no=0;
                      foreach($list_barang as $data){
                          $no++;
                    ?>
                        <tr>
                            <td style="text-align: center;width: 8%"><?php echo $data->id; ?></td>
                            <td><?php echo $data->product_name; ?></td>
                        </tr>
                      <?php }} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>