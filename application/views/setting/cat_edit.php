<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <form class="form-inline" action="<?php echo base_url("setting/save_cat_edit/"); ?><?php echo $get_category->topic_cat_id; ?>" method="post" name="from_edit_topic">
                <input type="text" name="cat_edit" id="cat_edit" class="form-control" placeholder="Edit Category" value="<?php echo $get_category->topic_cat_name; ?>"/><br>
                
                <input type="submit" name="cat_edit_btn" id="cat_edit_btn" class="btn btn-primary btn-block" />
            </form>
            
        </div>
    </body>
</html>
