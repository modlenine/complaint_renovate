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
            <form class="form-inline" action="<?php echo base_url("setting/save_topic_edit/"); ?><?php echo $getedit_topic->topic_id; ?>" method="post" name="from_edit_topic">
                <input type="text" name="topic_edit" id="topic_edit" class="form-control" placeholder="Edit Topic" value="<?php echo $getedit_topic->topic_name; ?>"/><br>
                <select class="form-control" name="cateshow_edit" id="cateshow_edit">
                    <option value="<?php echo $getedit_topic->topic_cat_id; ?>"><?php echo $getedit_topic->topic_cat_name; ?></option>
                    
                    <?php foreach ($get_topiccat as $get_top): ?>
                    <option value="<?php echo $get_top['topic_cat_id']; ?>"><?php echo $get_top['topic_cat_name']; ?> | <?php echo $get_top['topic_cat_id']; ?></option>
                    <?php endforeach; ?>
                    
                </select> <br>
                
                <input type="submit" name="topic_edit_btn" id="topic_edit_btn" class="btn btn-primary btn-block" />
            </form>
            
        </div>
    </body>
</html>
