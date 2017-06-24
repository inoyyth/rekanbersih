<ol class="breadcrumb">
    <li class="active"></i> Backup Database</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">Backup Database Management</div>
    <div class="panel-body">
        <div style="margin-bottom: 5px;">
            <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" />
            <form method="post" action="<?=base_url();?>backup_db/index" id="form2"/>
                <select style="float: right;width: 50px;margin-top: -19px;" name="page_sr" onchange="coba('form2');"/>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </form>
        </div>
        <div class="table-responsive" style="font-size: 12px;">
            <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                    <tr>
                        <th>File Name <i class="fa fa-sort"></i></th>
                        <th>Date <i class="fa fa-sort"></i></th>
                        <th style="text-align: center;width: 20%;">Download <i class="fa fa-sort"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($data) < 1) {
                        echo"<td colspan='10' align='center'>Data Not Found</td>";
                    } else {
                        $no = 0;
                        foreach ($data as $data) {
                            $no++;
                            ?>
                            <tr>
                                <td><?php echo $data->filename; ?></td>
                                <td><?php echo $data->date; ?></td>
                                <td style="text-align: center;">
                                    <button id="update" onclick="updatex('<?= $data->filename; ?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Download</button></i></button> 
                                    <button id="delete" onclick="deletex('<?= $data->id; ?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                                </td>
                            </tr>
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
            window.location.replace("<?php echo base_url(); ?>backup_db/backup");
        });
    });
    function updatex(id) {
        window.location.replace("<?php echo base_url(); ?>assets/backup_db/"+id);
    }
    function deletex(id) {
        if (confirm('Delete this record?')) {
            window.location.replace("<?php echo base_url(); ?>backup_db/delete/" + id + "/<?= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; ?>");
        } else {

        }
    }
    function coba(tables) {
        //alert("valuenya "+id+" fieldnya "+tables);
        document.getElementById(tables).submit();
    }
</script>