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

if($('.check_user').text()!== $('#history_cpusername').val()){
    $('#edit').hide();
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
    $('.btn_edit').hide();
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
   }
   
   if($('#radio_check').val() == "yes"){
       $('input[name="cp_sum"]').val("yes").prop("checked",true);
       $('.conclusion').hide();
   }
   if($('#radio_check').val() == "no"){
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



















        
        
        
    });/********************END MAIN FUNCTION***********************/
    
    
    
    
</script>



