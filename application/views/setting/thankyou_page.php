<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Status Page</title>
        
        <script>
            $(document).ready(function () {
                
            $('#btn_close').click( function(){
                window.close();
                window.opener.location.reload();
                
            });
        
        
            });
            
            
        </script>
    </head>
    <body>
        <div class="container">
            <h2 style="text-align: center;">Edit Topic Success</h2><br>
            <button id="btn_close" class="btn btn-warning btn-block">ปิดหน้าต่างนี้</button>
        </div>
        
    </body>
</html>
