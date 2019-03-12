<script type="text/javascript">
    
    
    
    $(document).ready(function () {
        

        
/********************Add page***************************/
        /********************************Use In add Controller***************************/
        $("#cp_topic").change(function () {
            var value = $("#cp_topic_cat").val();
            if (value == "Safety" || value == "System" || value == "Environment") {

                $('#h_username').hide();
                $('#cp_cus_name').val("Saleecolour");
                $('#h_cusref').hide();
                $('#h_inv').hide();
                $('#h_procode').hide();
                $('#h_lotno').hide();
                $('#h_qty').hide();
            } else {
                $('#h_username').show();
                $('#h_cusref').show();
                $('#h_inv').show();
                $('#h_procode').show();
                $('#h_lotno').show();
                $('#h_qty').show();
            }
        });
        
        
/***********************************Text area 2000 char*****************************************/
$('#characterLeft').text('2000 characters left');
        $('#message').keydown(function () {
            var max = 2000;
            var len = $(this).val().length;
            if (len >= max) {
                $('#characterLeft').text('You have reached the limit');
                $('#characterLeft').addClass('red');
                $('#btnSubmit').addClass('disabled');
            } else {
                var ch = max - len;
                $('#characterLeft').text(ch + ' characters left');
                $('#btnSubmit').removeClass('disabled');
                $('#characterLeft').removeClass('red');
            }
        });
  
  
  
/************************VIEW PAGE***********************************************/
/*****Check Permission for Start Investigation******/
var check_pms_view = $('#check_dept_view').val();
if(check_pms_view != 1){
    $('.result_pms').hide();
}

if($('#check_user').val()!== $('#history_cpusername').val()){
    $('#edit').hide();
}

if($('#get_oldcp').val() == ""){
    $('#view_oldcp').hide();
}







/***********************INVESTIGATE PAGE********************************/  
var check_pms_inves = $('#check_dept_inves').val();
if(check_pms_inves != 1){
    $('.result_pms_inves').hide();
    $('#cp_detail_inves').prop("readonly",true);
    $('#cp_detail_inves_file').prop("readonly",true);
}

if($('#cp_detail_inves').val() != ""){
    $('.result_pms_inves').hide();
    $('#cp_detail_inves').prop("readonly",true);
    $('#cp_detail_inves_file').prop("readonly",true);
    $('#cp_detail_inves_cost').prop("readonly",true);
}

if($('.check_status').text()!== "Investigation Complete"){/*********Check Edit button**********/
    $('#btn_save_history').hide();
}

if($('#check_user').val()!== $('#cp_detail_inves_signature').val()){
    $('#btn_save_history').hide();
}



    /*************Summary section*************/
    if($('#cp_detail_inves').val() == ""){
        $('#cp_sum_inves').prop("readonly",true);
        $('#cp_sum_inves_file').prop("readonly",true);
    }
    
    
    
    $('.conclusion').show();
   $('input[name="cp_sum"]').change(function(){
        if($(this).val()=="no"){
            $('.conclusion').show();
        }else{
            $('.conclusion').hide();
        }
   });
   
   if($('#check_qmr').val() != "QMR"){/**********CHECK QMR PERMISSION****************/
       $('.result_pms_sum_inves').hide();
       $('.result_pms_conclu').hide();
       $('#cp_conclu_detail').prop("readonly",true);
       $('#cp_conclu_detail_cost').prop("readonly",true);
       $('#cp_conclu_cost').prop("readonly",true);
       $('#cp_conclu_file').prop("readonly",true);
       
       $('#cp_sum_inves').prop("readonly",true);
        $('#cp_sum_inves_file').prop("readonly",true);
        
        $('#btn_cre_new').hide();
        $('#label_cre_new').hide();
       
   }
   
   if($('#radio_check').val() == "yes"){/******Check radio button********/
       $('input[name="cp_sum"]').val("yes").prop("checked",true);
       $('.conclusion').hide();
   }
   if($('#radio_check').val() == "no"){/******Check radio button********/
       $('#cp_sum_no').val("no").prop("checked",true);
   }
   
   if($('#cp_sum_inves').val() != ""){
       $('#cp_sum_inves').prop("readonly",true);
       $('.result_pms_sum_inves').hide();
   }
   
   
   
   /************Conclusion of complaint section***************/
   if($('#cp_sum_inves').val()==""){
       $('#cp_conclu_detail').prop("readonly",true);
       $('#cp_conclu_costdetail').prop("readonly",true);
       $('#cp_conclu_cost').prop("readonly",true);
       $('#cp_conclu_file').prop("readonly",true);
       $('.result_pms_conclu').hide();
   }
   
   if($('#cp_conclu_detail').val()!= ""){
       $('#cp_conclu_detail').prop("readonly",true);
       $('#cp_conclu_costdetail').prop("readonly",true);
       $('#cp_conclu_cost_show').prop("readonly",true);
       $('.result_pms_conclu').hide();
   }


/****************************ADD COMMA TO COST INPUT************************************/
$('input#cp_conclu_cost').keyup(function(event) {/*****Comma function*******/

  // skip for arrow keys
  if(event.which >= 37 && event.which <= 40) return;

  // format number
  $(this).val(function(index, value) {
    return value
    .replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    ;
  });
});


  // format number
  $('input#cp_conclu_cost_show').val(function(index, value) {
    return value
    .replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    ;
  });



/*********************ADD MORE COST SECTION*****************************/

        
        
/*********************EDIT PAGE AND DATA************************/
/**********INVESTIGATE SECTION***********/






/*****************************NC***************************************/
/************SEC3 Control***************/
if($('#nc_sec31').val()!==""){
    $('#nc_sec31').prop("readonly",true);
    $('#nc_sec32').prop("readonly",true);
    $('#nc_sec32date').prop("readonly",true);
    $('#nc_sec32time').prop("readonly",true);
    $('#nc_sec33').prop("readonly",true);
    $('#nc_sec33date').prop("readonly",true);
    $('#nc_sec33time').prop("readonly",true);
    $('#sec3save').hide();
}else{
    $('#btn_sec3edit').hide();
}

if($('#check_permit').val()==0){
    $('#nc_sec31').prop("readonly",true);
    $('#nc_sec32').prop("readonly",true);
    $('#nc_sec32date').prop("readonly",true);
    $('#nc_sec32time').prop("readonly",true);
    $('#nc_sec33').prop("readonly",true);
    $('#nc_sec33date').prop("readonly",true);
    $('#nc_sec33time').prop("readonly",true);
    $('#sec3save').hide();
    $('#btn_sec3edit').hide();
    $('#datetime32').prop("readonly",true);
    $('#datetime33').prop("readonly",true);
}
    
if($('#nc_sec31').val()!==""){
    $('.showdate32').hide();
    $('#datetime32show').prop("readonly",true);
    $('.showdate33').hide();
    $('#datetime33show').prop("readonly",true);
}

if($('#nc_sec31').val()==""){
    $('#datetime32show').hide();
    $('#datetime33show').hide();
    $('#dateshow32').hide();
    $('#dateshow33').hide();
}


/************SEC3 Control***************/



if($('#check_dept').val()!== "QMR"){/****************SEC4***CHECK**DEPT****************/
    $('#nc_sec4f1').prop("readonly",true);
    $('#nc_sec4f1_file').prop("readonly",true);
    $('#nc_sec4f1_date').prop("readonly",true);
    $('#nc_sec4f1_time').prop("readonly",true);
    $('#btn_sec4f1').hide();
    
    $('#nc_sec4f2').prop("readonly",true);
    $('#nc_sec4f2_file').prop("readonly",true);
    $('#nc_sec4f2_date').prop("readonly",true);
    $('#nc_sec4f2_time').prop("readonly",true);
    $('#btn_sec4f2').hide();
    
    $('#nc_sec4f3').prop("readonly",true);
    $('#nc_sec4f3_file').prop("readonly",true);
    $('#btn_sec4f3').hide();
    
    $('#nc_sec5').prop("readonly",true);
    $('#nc_sec5file').prop("readonly",true);
    $('#nc_sec5cost').prop("readonly",true);
    $('#btn_sec5').hide();
}


/*******************CHECK SEC4*******************************/
if($('#nc_sec4f1').val()==""){
    $('#nc_sec4f2').prop("readonly",true);
    $('#nc_sec4f2_file').prop("readonly",true);
    $('#nc_sec4f2_date').prop("readonly",true);
    $('#nc_sec4f2_time').prop("readonly",true);
    $('#btn_sec4f2').hide();
    
    $('#nc_sec4f3').prop("readonly",true);
    $('#nc_sec4f3_file').prop("readonly",true);
    $('#btn_sec4f3').hide();
}

if($('#nc_sec4f2').val()==""){
    $('#nc_sec4f3').prop("readonly",true);
    $('#nc_sec4f3_file').prop("readonly",true);
    $('#btn_sec4f3').hide();
}

if($('#nc_sec31').val()==""){
    $('#nc_sec4f1').prop("readonly",true);
    $('#nc_sec4f1_file').prop("readonly",true);
    $('#nc_sec4f1_date').prop("readonly",true);
    $('#nc_sec4f1_time').prop("readonly",true);
    $('#btn_sec4f1').hide();
}
/*******************CHECK SEC4*******************************/
/**************F1*********************/
if($('#nc_sec4f1').val()!==""){/***********Check sec4f1 for use readonly*************/
    $('#nc_sec4f1_file').hide();
    $('#nc_sec4f1').prop("readonly",true);
    $('#nc_sec4f1_date').prop("readonly",true);
    $('#nc_sec4f1_time').prop("readonly",true);
    $('#btn_sec4f1').hide();
    
}else{
    $('#get_nc_sec4f1_file').hide();
}

if($('#nc_sec4f1_radiocheck').val() == "yes"){/******Check radio button***********/
    $('#nc_sec4f1_status_yes').prop("checked",true);
}
if($('#nc_sec4f1_radiocheck').val() == "no"){/******Check radio button***********/
    $('#nc_sec4f1_status_no').prop("checked",true);
}
/**************F1*********************/




/**************F2*********************/
if($('#nc_sec4f2').val()!==""){/***********Check sec4f2 for use readonly*************/
    $('#nc_sec4f2_file').hide();
    $('#nc_sec4f2').prop("readonly",true);
    $('#nc_sec4f2_date').prop("readonly",true);
    $('#nc_sec4f2_time').prop("readonly",true);
    $('#btn_sec4f2').hide();
    
}else{
    $('#get_nc_sec4f2_file').hide();
}

if($('#nc_sec4f2_radiocheck').val() == "yes"){/******Check radio button***********/
    $('#nc_sec4f2_status_yes').prop("checked",true);
}
if($('#nc_sec4f2_radiocheck').val() == "no"){/******Check radio button***********/
    $('#nc_sec4f2_status_no').prop("checked",true);
}
/**************F2*********************/




/**************F3*********************/
if($('#nc_sec4f3').val()!==""){/***********Check sec4f3 for use readonly*************/
    $('#nc_sec4f3_file').hide();
    $('#nc_sec4f3').prop("readonly",true);
    $('#btn_sec4f3').hide();
    
}else{
    $('#get_nc_sec4f3_file').hide();
}

if($('#nc_sec4f3_radiocheck').val() == "yes"){/******Check radio button***********/
    $('#nc_sec4f3_status_yes').prop("checked",true);
}
if($('#nc_sec4f3_radiocheck').val() == "no"){/******Check radio button***********/
    $('#nc_sec4f3_status_no').prop("checked",true);
}


if($('#checkstatus_failed').val()=="NC Failed"){
    $('#nc_sec5').prop("readonly",true);
    $('#nc_sec5file').prop("readonly",true);
    $('#nc_sec5cost').prop("readonly",true);
    $('#btn_sec5').hide();

}

if($('#checkstatus_failed').val()!=="NC Failed"){
    $('#btn_cre_new').hide();
    $('#label_cre_new').hide();
}


/**************F3*********************/



/*******************CHECK**SEC5******************************/
if($('#nc_sec4f3').val()==""){
    $('#nc_sec5').prop("readonly",true);
    $('#nc_sec5file').prop("readonly",true);
    $('#nc_sec5cost').prop("readonly",true);
    $('#btn_sec5').hide();
}

if($('#nc_sec5').val()!==""){/***********Check sec5 for use readonly*************/
    $('#nc_sec5file').hide();
    $('#nc_sec5').prop("readonly",true);
    $('#btn_sec5').hide();
    $('#nc_sec5cost').prop("readonly",true);
    
}


// Set the date we're counting down to
//var countDownDate = new Date("2019-03-12 09:37:25").getTime();
var countDownDate = new Date($('#datetime32').val()).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("dateshow32").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("dateshow32").innerHTML = "EXPIRED";
  }
  if($('#nc_sec4f1_radiocheck').val()=="yes"){
      clearInterval(x);
      document.getElementById("dateshow32").innerHTML = "DONE";
  }
  
  
}, 1000);


// Set the date we're counting down to
//var countDownDate = new Date("2019-03-12 09:37:25").getTime();
var countDownDate2 = new Date($('#datetime33').val()).getTime();

// Update the count down every 1 second
var x2 = setInterval(function() {

  // Get todays date and time
  var now2 = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance2 = countDownDate2 - now2;
    
  // Time calculations for days, hours, minutes and seconds
  var days2 = Math.floor(distance2 / (1000 * 60 * 60 * 24));
  var hours2 = Math.floor((distance2 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes2 = Math.floor((distance2 % (1000 * 60 * 60)) / (1000 * 60));
  var seconds2 = Math.floor((distance2 % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("dateshow33").innerHTML = days2 + "d " + hours2 + "h "
  + minutes2 + "m " + seconds2 + "s ";
    
  // If the count down is over, write some text
  if (distance2 < 0) {
    clearInterval(x2);
    document.getElementById("dateshow33").innerHTML = "EXPIRED";
  }
  
  if($('#nc_sec4f1_radiocheck').val()=="yes"){
      clearInterval(x2);
      document.getElementById("dateshow33").innerHTML = "DONE";
  }
  
  
}, 1000);


$(function() {
  $('#datetimepicker32').datetimepicker({
            format: 'YYYY/MM/DD HH:mm'
  });
  
  $('#datetimepicker33').datetimepicker({
            format: 'YYYY/MM/DD HH:mm'
  });
  
});








/*********************DASHBOARD**************************/

/*********************DASHBOARD**************************/










        
        
        
    });/********************END MAIN FUNCTION***********************/
    
    
    
    
</script>



