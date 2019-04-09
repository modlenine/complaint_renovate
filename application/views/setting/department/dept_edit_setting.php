<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Department</title>
    </head>
    <body>
        <div class="container">
            <form name="frm_edit_department" method="post" action="<?php echo base_url(); ?>setting/save_dept_edit_setting/<?php echo $get_dept_edit->cp_dept_main_id;  ?>" >
                <input type="text" name="edit_deptcode" id="edit_deptcode" value="<?php echo $get_dept_edit->cp_dept_main_code; ?>" placeholder="Edit Department Code" class="form-control"/><br>
                <input type="text" name="edit_deptname" id="edit_deptname" value="<?php echo $get_dept_edit->cp_dept_main_name; ?>" placeholder="Edit Department Name" class="form-control" /><br>
                <input type="submit" name="btn_saveedit_dept" id="btn_saveedit_dept" value="Update" class="btn btn-primary btn-block"/>
            </form>
        </div>
    </body>
</html>
