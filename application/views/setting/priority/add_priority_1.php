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

            <!-- Code สำหรับการ ตัดคำที่ดึงมา 2 Value และคั่นด้วย | -->                                   
            <script language="JavaScript">
                function resutNamePri(strCusName)
                {
                    frmMainPri.show_id.value = strCusName.split("|")[0];
                    frmMainPri.show_name.value = strCusName.split("|")[1];
                    frmMainPri.show_score.value = strCusName.split("|")[2];
                }
            </script>
            <!-- Code สำหรับการ ตัดคำที่ดึงมา 2 Value และคั่นด้วย | --> 

            <form name="frmMainPri" id="frmMainPri" action="<?php echo base_url("setting/save_priority/"); ?>" method="post">
                <div class="input-group">
                    <span class="input-group-addon">Category :</span>
                    <select class="form-control" name="priority_cat" id="priority_cat" OnChange="resutNamePri(this.value);">
                        <option>กรุณาเลือกหมวดหมู่ที่จะเพิ่ม</option>
                        <?php foreach ($get_pri_catadd->result_array() as $gpric): ?>
                            <option value="<?php echo $gpric['pricat_id']; ?>|<?php echo $gpric['pricat_name']; ?>|<?php echo $gpric['pricat_score']; ?>"><?php echo $gpric['pricat_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>

                <input type="text" name="show_id" id="show_id" hidden=""/>
                <input type="text" name="show_name" id="show_name" hidden=""/>

                <div class="input-group">
                    <span class="input-group-addon">Score :</span>
                    <input readonly="" type="number" name="show_score" id="show_score" class="form-control" placeholder="Score" />
                    <input readonly="" type="number" name="show_scoreN" id="show_scoreN" class="form-control" placeholder="Score" />
                    <span class="input-group-addon">%</span>
                </div><hr>
                

                <div class="input-group">
                    <span class="input-group-addon">Priority Name :</span>
                    <input type="text" name="priority_name" id="priority_name" class="form-control" placeholder="priority_name"/>
                </div><br>
                
                <div class="input-group">
                    <span class="input-group-addon">Set Score :</span>
                    <input type="number" name="set_score" id="set_score" class="form-control cal" placeholder="set_score"/>
                    <span class="input-group-addon">%</span>
                </div><br>


                <input type="submit" name="btn_add_priname" id="btn_add_priname" class="btn btn-primary btn-block"/>

            </form>
            
<script>
	$(document).ready(function(){
            //****************CODE**ลบตัวเลข**พร้อมเช็คไม่ให้เลขติดลบ*****************************//
$('#show_scoreN').hide();
		//iterate through each textboxes and add keyup
		//handler to trigger sum event
		$(".cal").each(function() {

			$(this).keyup(function(){
                            if($(this)==""){
                                $('#show_scoreN').hide();
                            }else{
                                $('#show_scoreN').show();
                                $('#show_score').hide();
                            }
				calculateSum();
                                
                            if($("#show_scoreN").val() < 0){
                                alert("The score not enough");
                                location.reload();
                            }
			});
		});

	});

	function calculateSum() {

		var sum = parseInt($("#show_score").val());
		//iterate through each textboxes and add the values
		$(".cal").each(function() {

			//add only if the value is number
			if(!isNaN(this.value) && this.value.length!=0) {
				sum = sum - parseInt(this.value);
			}

		});
		//.toFixed() method will roundoff the final sum to 2 decimal places
		$("#show_scoreN").val(sum);
	}
        //****************CODE**ลบตัวเลข**พร้อมเช็คไม่ให้เลขติดลบ*****************************//
</script>



        </div>
    </body>
</html>
