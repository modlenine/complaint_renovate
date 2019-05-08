<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
header("Content-type: application/vnd.ms-excel");
// header('Content-type: application/csv'); //*** CSV ***//
header("Content-Disposition: attachment; filename=testing.xls");
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Export data.</title>
    </head>
    <body>
        <?php $this->load->view("head/nav"); ?>
        
        <div class="container">
            <h1>Export Data.</h1>
            
            <table width="600" border="1">
                <tr>
                    <th>ทดสอบ1</th>
                    <th>ทดสอบ1</th>
                    <th>ทดสอบ1</th>
                    <th>ทดสอบ1</th>
                    <th>ทดสอบ1</th>
                    <th>ทดสอบ1</th>
                    <th>ทดสอบ1</th>
                    <th>ทดสอบ1</th>
                    <th>ทดสอบ1</th>
                </tr>
                
                <tr>
                    <td>ทดสอบ2</td>
                    <td>ทดสอบ2</td>
                    <td>ทดสอบ2</td>
                    <td>ทดสอบ2</td>
                    <td>ทดสอบ2</td>
                    <td>ทดสอบ2</td>
                    <td>ทดสอบ2</td>
                    <td>ทดสอบ2</td>
                    <td>ทดสอบ2</td>
                </tr>
            </table>
            
        </div>
        
        
    </body>
</html>
