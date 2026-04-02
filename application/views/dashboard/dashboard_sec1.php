<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <div class="row">
        <h3 style="text-align: center;">View by Status</h3>
        <div class="col-md-6">
        <div class="list-group">
        <a href="#" class="list-group-item active">
            Complaint
        </a>
            <?php foreach ($get_cpstatus->result_array() as $gcp): ?>
            <a href="<?php echo base_url("dashboard/viewcpby_status/"); ?><?php echo $gcp['cp_status_code']; ?>" class="list-group-item"><?php echo $gcp['cp_status_name']; ?><span class="badge"><?php echo $gcp['sum']; ?></span></a>
        <?php endforeach; ?>

    </div>
    </div>

    <div class="col-md-6">
        <div class="list-group">
        <a href="#" class="list-group-item active">
            NC
        </a>
        <?php foreach($get_ncstatus->result_array() as $gnc): ?>
        <a href="<?php echo base_url("dashboard/viewncby_status/"); ?><?php echo $gnc['nc_status_code']; ?>" class="list-group-item"><?php echo $gnc['cp_status_name']; ?><span class="badge"><?php echo $gnc['sum']; ?></span></a>
        <?php endforeach; ?>

    </div>
    </div>
    </div><hr>

    <div class="row">

        <div class="col-md-4">
            <h3 style="text-align: center;">View by User</h3>
            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fas fa-caret-right"></i>&nbsp;Complaint / NC</div>
                <div class="panel-body">
                    <table id="viewByUser" class="table  table-hover dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Count</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($getby_username->result_array() as $gbuser) { ?>
                                <tr>
                                    <td><a href="<?php echo base_url("dashboard/viewby_user/"); ?><?php echo $gbuser['cp_user_name']; ?>"><?php echo $gbuser['cp_user_name']; ?></td>
                                    <td><span class="badge"><?php echo $gbuser['num_user']; ?></span></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div class="list-group">
        <a href="#" class="list-group-item active">
            Complaint / NC
        </a>
        <?php foreach ($getby_username->result_array() as $gbuser): ?>
        <a href="<?php echo base_url("dashboard/viewby_user/"); ?><?php echo $gbuser['cp_user_name']; ?>" class="list-group-item"><?php echo $gbuser['cp_user_name']; ?><span class="badge"><?php echo $gbuser['num_user']; ?></span></a>
        <?php endforeach; ?>

            </div> -->
        </div>

        <div class="col-md-4">
            <h3 style="text-align: center;">View by Department</h3>
            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fas fa-caret-right"></i>&nbsp;Complaint / NC</div>
                <div class="panel-body">
                    <table id="viewByDept" class="table  table-hover dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>Department</th>
                                <th>Count</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($getby_dept->result_array() as $gbdept) { ?>
                                <tr>
                                    <td><a href="<?php echo base_url("dashboard/viewby_dept/"); ?><?php echo $gbdept['cp_user_dept']; ?>"><?php echo $gbdept['cp_user_dept']; ?></a></td>
                                    <td><span class="badge"><?php echo $gbdept['num_dept']; ?></span></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div class="list-group">
        <a href="#" class="list-group-item active">
            Complaint / NC
        </a>
        <?php foreach ($getby_dept->result_array() as $gbdept): ?>
        <a href="<?php echo base_url("dashboard/viewby_dept/"); ?><?php echo $gbdept['cp_user_dept']; ?>" class="list-group-item"><?php echo $gbdept['cp_user_dept']; ?><span class="badge"><?php echo $gbdept['num_dept']; ?></span></a>
        <?php endforeach; ?>

            </div> -->
        </div>

        <div class="col-md-4">
            <h3 style="text-align: center;">View by Topic Category</h3>
            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fas fa-caret-right"></i>&nbsp;Complaint / NC</div>
                <div class="panel-body">
                    <table id="viewByTopic" class="table  table-hover dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>Topic Category</th>
                                <th>Count</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($getby_topic_cat->result_array() as $gbt) { ?>
                                <tr>
                                    <td><a href="<?php echo base_url("dashboard/viewby_topic_cat/"); ?><?php echo $gbt['cp_topic_cat']; ?>"><?php echo $gbt['topic_cat_name']; ?></a></td>
                                    <td><span class="badge"><?php echo $gbt['cat_num']; ?></span></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div class="list-group">
        <a href="#" class="list-group-item active">
            Complaint / NC
        </a>
        <?php foreach ($getby_topic_cat->result_array() as $gbt): ?>
        <a href="<?php echo base_url("dashboard/viewby_topic_cat/"); ?><?php echo $gbt['cp_topic_cat']; ?>" class="list-group-item"><?php echo $gbt['topic_cat_name']; ?><span class="badge"><?php echo $gbt['cat_num']; ?></span></a>
        <?php endforeach; ?>

            </div> -->
        </div>



    </div>
  </body>
</html>

<script type="text/javascript">
    $(document).ready(function() {


        $('#viewByUser').DataTable({
            "columnDefs": [{
                "width": "5%",
                "targets": 1
            }],
            "order": [
                [1, "desc"]
            ]
        });


        $('#viewByDept').DataTable({
            "columnDefs": [{
                "width": "5%",
                "targets": 1
            }],
            "order": [
                [1, "desc"]
            ]
        });


        $('#viewByTopic').DataTable({
            "columnDefs": [{
                "width": "5%",
                "targets": 1
            }],
            "order": [
                [1, "desc"]
            ]
        });


    });
</script>
