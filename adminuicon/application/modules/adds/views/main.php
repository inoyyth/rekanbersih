<ol class="breadcrumb">
    <li> Adds</li>
    <li class="active"></i> Adds</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">Adds Management</div>
    <div class="panel-body">
        <div style="margin-bottom: 5px;">
            <input type="button" class="btn btn-primary btn-xs" value=" + New" id="new" />
            <form method="post" action="<?=base_url();?>adds/search" id="form2"/>
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
                        <th>ID <i class="fa fa-sort"></i></th>
                        <th>Title <i class="fa fa-sort"></i></th>
                        <th>URL <i class="fa fa-sort"></i></th>
                        <th>Status <i class="fa fa-sort"></i></th>
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
                            $no++;
                            ?>
                            <tr>
                                <td><?php echo $data->id; ?></td>
                                <td><?php echo $data->adds_name; ?></td>
                                <td><?php echo $data->adds_url; ?></td>
                                <td><?php echo $data->status; ?></td>
                                <td style="text-align: center;">
                                    <button id="update" onclick="updatex('<?= $data->id; ?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
                                    <button id="delete" onclick="deletex('<?= $data->id; ?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <form method="post" action="<?=base_url();?>adds/search" id="form1"/>
                            <td><input name="id_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><input name="name_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><input name="url_sr" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                            <td><select class="combo_search" name="status_sr" onchange="coba('form1');"/>
                                    <option value=""></option>
                                    <option value="Y">Active</option>
                                    <option value="N">Not Active</option>
                                </select>
                            </td>
                            <td></td>
                        </form>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


<?php $this->load->view('combobox_autocomplete');?>


<script type="text/javascript">
    $(document).ready(function () {
        $("#new").click(function () {
            window.location.replace("<?php echo base_url(); ?>adds/add");
        });
    });
    function updatex(id) {
        window.location.replace("<?php echo base_url(); ?>adds/update/" + id + "/<?= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; ?>");
    }
    function deletex(id) {
        if (confirm('Delete this record?')) {
            window.location.replace("<?php echo base_url(); ?>adds/delete/" + id + "/<?= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; ?>");
        } else {

        }
    }
    function coba(tables) {
        //alert("valuenya "+id+" fieldnya "+tables);
        document.getElementById(tables).submit();
    }
</script>