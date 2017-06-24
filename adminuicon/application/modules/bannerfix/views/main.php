<ol class="breadcrumb">
    <li> Banner </li>
    <li class="active"></i> Banner Management</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">Banner</div>
    <div class="panel-body">
        <div style="margin-bottom: 5px;">
            <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" />
        </div>
        <div class="table-responsive" style="font-size: 12px;">
            <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                    <tr>
                        <th style="text-align: center;">No. <i class="fa fa-sort"></i></th>
                        <th>Title <i class="fa fa-sort"></i></th>
                        <th>Title Link <i class="fa fa-sort"></i></th>
                        <th>URL <i class="fa fa-sort"></i></th>
                        <th style="text-align: center;">Actions <i class="fa fa-sort"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($data) < 1) {
                        echo"<td colspan='10' align='center'>Data Not Found</td>";
                    } else {
                        $no = 0;
                        foreach ($data as $data) {
                            $id_cat = $data->bannerfix_id;
                            $no++;
                            ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $no; ?></td>
                                <td><?php echo $data->bannerfix_title; ?></td>
                                <td><?php echo $data->bannerfix_title_link; ?></td>
                                <td><?php echo $data->bannerfix_url; ?></td>
                                <td style="text-align: center;">
                                    <button id="update" onclick="updatex('<?= $data->bannerfix_id; ?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                                    <button id="delete" onclick="deletex('<?= $data->bannerfix_id; ?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                                </td>
                            </tr>
                            <img scr="<?=base_url();?>assets/foto/bannerfix/<?=$data->bannerfix_image?>">
                        <?php }
                    } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<?php $this->load->view('combobox_autocomplete');?>


<script type="text/javascript">
    $(document).ready(function () {
        $("#new").click(function () {
            window.location.replace("<?php echo base_url(); ?>bannerfix/add");
        });
    });
    function updatex(id) {
        window.location.replace("<?php echo base_url(); ?>bannerfix/update/" + id + "/<?= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; ?>");
    }
    function deletex(id) {
        if (confirm('Delete this record?')) {
            window.location.replace("<?php echo base_url(); ?>bannerfix/delete/" + id + "/<?= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; ?>");
        } else {

        }
    }
    function coba(tables) {
        //alert("valuenya "+id+" fieldnya "+tables);
        document.getElementById(tables).submit();
    }
</script>