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
        if (check_pms_view != 1) {
            $('.result_pms').hide();
        }

        if ($('#check_user').val() !== $('#history_cpusername').val()) {
            $('#edit').hide();
        }

        if ($('#get_oldcp').val() == "") {
            $('#view_oldcp').hide();
        }







        /***********************INVESTIGATE PAGE********************************/
        var check_pms_inves = $('#check_dept_inves').val();
        if (check_pms_inves != 1) {
            $('.result_pms_inves').hide();
            $('#cp_detail_inves').prop("readonly", true);
            $('#cp_detail_inves_file').prop("readonly", true);
        }

        if ($('#cp_detail_inves').val() != "") {
            $('.result_pms_inves').hide();
            $('#cp_detail_inves').prop("readonly", true);
            $('#cp_detail_inves_file').prop("readonly", true);
            $('#cp_detail_inves_cost').prop("readonly", true);
        }

        if ($('.check_status').text() !== "Investigation Complete") {/*********Check Edit button**********/
            $('#btn_save_history').hide();
        }
        
        if($('#check_user').val()!== $('#cu').val()){/*********Check Edit button**********/
            $('#btn_save_history').hide();
        }

        
        
        if($('#cp_topic_cat').val() == "Safety" || $('#cp_topic_cat').val() == "Environment" || $('#cp_topic_cat').val() == "System"){
            $('#h_username').hide();
            $('#h_cusref').hide();
            $('#h_inv').hide();
            $('#h_procode').hide();
            $('#h_lotno').hide();
            $('#h_qty').hide();
           
        }



        /*************Summary section*************/
        if ($('#cp_detail_inves').val() == "") {
            $('#cp_sum_inves').prop("readonly", true);
            $('#cp_sum_inves_file').prop("readonly", true);
        }



        $('.conclusion').show();
        $('input[name="cp_sum"]').change(function () {
            if ($(this).val() == "no") {
                $('.conclusion').show();
            } else {
                $('.conclusion').hide();
            }
        });

        if ($('#check_qmr').val() != "QMR") {/**********CHECK QMR PERMISSION****************/
            $('.result_pms_sum_inves').hide();
            $('.result_pms_conclu').hide();
            $('#cp_conclu_detail').prop("readonly", true);
            $('#cp_conclu_detail_cost').prop("readonly", true);
            $('#cp_conclu_cost').prop("readonly", true);
            $('#cp_conclu_file').prop("readonly", true);

            $('#cp_sum_inves').prop("readonly", true);
            $('#cp_sum_inves_file').prop("readonly", true);

            $('#btn_cre_new').hide();
            $('#label_cre_new').hide();

        }

        if ($('#radio_check').val() == "yes") {/******Check radio button********/
            $('input[name="cp_sum"]').val("yes").prop("checked", true);
            $('.conclusion').hide();
        }
        if ($('#radio_check').val() == "no") {/******Check radio button********/
            $('#cp_sum_no').val("no").prop("checked", true);
        }

        if ($('#cp_sum_inves').val() != "") {
            $('#cp_sum_inves').prop("readonly", true);
            $('.result_pms_sum_inves').hide();
        }



        /************Conclusion of complaint section***************/
        if ($('#cp_sum_inves').val() == "") {
            $('#cp_conclu_detail').prop("readonly", true);
            $('#cp_conclu_costdetail').prop("readonly", true);
            $('#cp_conclu_cost').prop("readonly", true);
            $('#cp_conclu_file').prop("readonly", true);
            $('.result_pms_conclu').hide();
        }

        if ($('#cp_conclu_detail').val() != "") {
            $('#cp_conclu_detail').prop("readonly", true);
            $('#cp_conclu_costdetail').prop("readonly", true);
            $('#cp_conclu_cost_show').prop("readonly", true);
            $('.result_pms_conclu').hide();
        }


        /****************************ADD COMMA TO COST INPUT************************************/
        $('input#cp_conclu_cost').keyup(function (event) {/*****Comma function*******/

            // skip for arrow keys
            if (event.which >= 37 && event.which <= 40)
                return;

            // format number
            $(this).val(function (index, value) {
                return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                        ;
            });
        });


        // format number
        $('input#cp_conclu_cost_show').val(function (index, value) {
            return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                    ;
        });
        
        
        
//****************Quantity************

        $('input#cp_pro_qty').keyup(function (event) {/*****Comma function*******/

            // skip for arrow keys
            if (event.which >= 37 && event.which <= 40)
                return;

            // format number
            $(this).val(function (index, value) {
                return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                        ;
            });
        });
        
        
     //**********Quantity Show number+comma   
        function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
        
        $("#cp_pro_qty_show2").each(function() {
    var num = $(this).text();
    var commaNum = numberWithCommas(num);
    $(this).text(commaNum);
  });
     
 //****************Quantity************
 
 
// Conclusion of NC

$('input#nc_sec5cost').keyup(function (event) {/*****Comma function*******/

            // skip for arrow keys
            if (event.which >= 37 && event.which <= 40)
                return;

            // format number
            $(this).val(function (index, value) {
                return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                        ;
            });
        });
        
        // format number
        $('input#nc_sec5cost').val(function (index, value) {
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
        if ($('#nc_sec31').val() !== "") {
            $('#nc_sec31').prop("readonly", true);
            $('#nc_sec32').prop("readonly", true);
            $('#nc_sec32date').prop("readonly", true);
            $('#nc_sec32time').prop("readonly", true);
            $('#nc_sec33').prop("readonly", true);
            $('#nc_sec33date').prop("readonly", true);
            $('#nc_sec33time').prop("readonly", true);
            $('#sec3save').hide();
        } else {
            $('#btn_sec3edit').hide();
        }

        if ($('#check_permit').val() == 0) {
            $('#nc_sec31').prop("readonly", true);
            $('#nc_sec32').prop("readonly", true);
            $('#nc_sec32date').prop("readonly", true);
            $('#nc_sec32time').prop("readonly", true);
            $('#nc_sec33').prop("readonly", true);
            $('#nc_sec33date').prop("readonly", true);
            $('#nc_sec33time').prop("readonly", true);
            $('#sec3save').hide();
            $('#btn_sec3edit').hide();
            $('#datetime32').prop("readonly", true);
            $('#datetime33').prop("readonly", true);
        }

        if ($('#nc_sec31').val() !== "") {
            $('.showdate32').hide();
            $('#datetime32show').prop("readonly", true);
            $('.showdate33').hide();
            $('#datetime33show').prop("readonly", true);
        }

        if ($('#nc_sec31').val() == "") {
            $('#datetime32show').hide();
            $('#datetime33show').hide();
            $('#dateshow32').hide();
            $('#dateshow33').hide();
        }


        /************SEC3 Control***************/



        if ($('#check_qmr').val() !== "QMR") {/****************SEC4***CHECK**DEPT****************/
            $('#nc_sec4f1').prop("readonly", true);
            $('#nc_sec4f1_file').prop("readonly", true);
            $('#nc_sec4f1_date').prop("readonly", true);
            $('#nc_sec4f1_time').prop("readonly", true);
            $('#datetime41').prop("readonly", true);
            $('#btn_sec4f1').hide();

            $('#nc_sec4f2').prop("readonly", true);
            $('#nc_sec4f2_file').prop("readonly", true);
            $('#nc_sec4f2_date').prop("readonly", true);
            $('#nc_sec4f2_time').prop("readonly", true);
            $('#datetime42').prop("readonly", true);
            $('#btn_sec4f2').hide();

            $('#nc_sec4f3').prop("readonly", true);
            $('#nc_sec4f3_file').prop("readonly", true);
            $('#btn_sec4f3').hide();


        }


        /*******************CHECK SEC4*******************************/
        if ($('#nc_sec4f1').val() == "") {
            $('#nc_sec4f2').prop("readonly", true);
            $('#nc_sec4f2_file').prop("readonly", true);
            $('#nc_sec4f2_date').prop("readonly", true);
            $('#nc_sec4f2_time').prop("readonly", true);
            $('#btn_sec4f2').hide();

            $('#nc_sec4f3').prop("readonly", true);
            $('#nc_sec4f3_file').prop("readonly", true);
            $('#btn_sec4f3').hide();

            $('#datetime41show').hide();
            $('#dateshow41').hide();

            $('#datetime42').prop("readonly", true);

        } else {
            $('#btn_sec3edit').hide();
        }

        if ($('#nc_sec4f2').val() == "") {
            $('#nc_sec4f3').prop("readonly", true);
            $('#nc_sec4f3_file').prop("readonly", true);
            $('#btn_sec4f3').hide();
        }

        if ($('#nc_sec31').val() == "") {
            $('#nc_sec4f1').prop("readonly", true);
            $('#nc_sec4f1_file').prop("readonly", true);
            $('#nc_sec4f1_date').prop("readonly", true);
            $('#nc_sec4f1_time').prop("readonly", true);
            $('#btn_sec4f1').hide();
        }


        /*******************CHECK SEC4*******************************/
        /**************F1*********************/
        if ($('#nc_sec4f1').val() !== "") {/***********Check sec4f1 for use readonly*************/
            $('#nc_sec4f1_file').hide();
            $('#nc_sec4f1').prop("readonly", true);
            $('#nc_sec4f1_date').prop("readonly", true);
            $('#nc_sec4f1_time').prop("readonly", true);
            $('#btn_sec4f1').hide();

            $('.showdate41').hide();
            $('#datetime41show').prop("readonly", true);


        } else {
            $('#get_nc_sec4f1_file').hide();
            $('#nc_sec5').prop("readonly", true);
            $('#nc_sec5file').prop("readonly", true);
            $('#nc_sec5cost').prop("readonly", true);
            $('#btn_sec5').hide();
        }

        if ($('#nc_sec4f1_radiocheck').val() == "yes") {/******Check radio button***********/
            $('#nc_sec4f1_status_yes').prop("checked", true);

            $('#nc_sec4f2_file').hide();
            $('#nc_sec4f2').prop("readonly", true);
            $('#nc_sec4f2_date').prop("readonly", true);
            $('#nc_sec4f2_time').prop("readonly", true);
            $('#btn_sec4f2').hide();
            $('#datetime42').prop("readonly", true);

            $('#label4f1').hide();
            $('#datetime41show').hide();
            $('#dateshow41').hide();

        }
        if ($('#nc_sec4f1_radiocheck').val() == "no") {/******Check radio button***********/
            $('#nc_sec4f1_status_no').prop("checked", true);
        }
        /**************F1*********************/




        /**************F2*********************/
        if ($('#nc_sec4f2').val() !== "") {/***********Check sec4f2 for use readonly*************/
            $('#nc_sec4f2_file').hide();
            $('#nc_sec4f2').prop("readonly", true);
            $('#nc_sec4f2_date').prop("readonly", true);
            $('#nc_sec4f2_time').prop("readonly", true);
            $('#btn_sec4f2').hide();

            $('.showdate42').hide();
            $('#datetime42show').prop("readonly", true);

        } else {
            $('#get_nc_sec4f2_file').hide();

            $('#datetime42show').hide();
            $('#dateshow42').hide();
        }

        if ($('#nc_sec4f2_radiocheck').val() == "yes") {/******Check radio button***********/
            $('#nc_sec4f2_status_yes').prop("checked", true);

            $('#label4f2').hide();
            $('#datetime42show').hide();
            $('#dateshow42').hide();

            $('#nc_sec4f3_file').hide();
            $('#nc_sec4f3').prop("readonly", true);
            $('#btn_sec4f3').hide();

        }
        if ($('#nc_sec4f2_radiocheck').val() == "no") {/******Check radio button***********/
            $('#nc_sec4f2_status_no').prop("checked", true);
        }
        /**************F2*********************/




        /**************F3*********************/
        if ($('#nc_sec4f3').val() !== "") {/***********Check sec4f3 for use readonly*************/
            $('#nc_sec4f3_file').hide();
            $('#nc_sec4f3').prop("readonly", true);
            $('#btn_sec4f3').hide();

        } else {
            $('#get_nc_sec4f3_file').hide();
        }

        if ($('#nc_sec4f3_radiocheck').val() == "yes") {/******Check radio button***********/
            $('#nc_sec4f3_status_yes').prop("checked", true);
        }
        if ($('#nc_sec4f3_radiocheck').val() == "no") {/******Check radio button***********/
            $('#nc_sec4f3_status_no').prop("checked", true);
        }


        if ($('#checkstatus_failed').val() == "nc09") {
    $('#nc_sec5').prop("readonly",true);
    $('#nc_sec5file').prop("readonly",true);
    $('#nc_sec5cost').prop("readonly",true);
    $('#btn_sec5').hide();

        }

        if ($('#checkstatus_failed').val() !== "nc09") {
            $('#btn_cre_new').hide();
            $('#label_cre_new').hide();
        }


        /**************F3*********************/



        /*******************CHECK**SEC5******************************/
        if ($('#nc_sec4f1_radiocheck').val() == "no") {
//            $('#nc_sec5').prop("readonly", true);
//            $('#nc_sec5file').prop("readonly", true);
//            $('#nc_sec5cost').prop("readonly", true);
//            $('#btn_sec5').hide();
//            if ($('#nc_sec4f2_radiocheck').val() == "yes") {
//                $('#nc_sec5').removeProp("readonly");
//                $('#nc_sec5file').removeProp("readonly");
//                $('#nc_sec5cost').removeProp("readonly");
//                $('#btn_sec5').show();
//
//                $('#nc_sec4f3_file').hide();
//                $('#nc_sec4f3').prop("readonly", true);
//                $('#btn_sec4f3').hide();
//
//            }
        }

        if ($('#nc_sec4f3').val() !== "") {
//            $('#nc_sec5').removeProp("readonly");
//            $('#nc_sec5file').removeProp("readonly");
//            $('#nc_sec5cost').removeProp("readonly");
//            $('#btn_sec5').show();
        }
//$('#nc_sec5').prop("readonly",true);
//    $('#nc_sec5file').prop("readonly",true);
//    $('#nc_sec5cost').prop("readonly",true);
//    $('#btn_sec5').hide();

        if ($('#nc_sec5').val() !== "") {/***********Check sec5 for use readonly*************/
            $('#nc_sec5file').hide();
            $('#nc_sec5').prop("readonly", true);
            $('#btn_sec5').hide();
            $('#nc_sec5cost').prop("readonly", true);



        }

        if ($('#nc_sec31').val() == "") {
            $('#nc_sec5file').hide();
            $('#nc_sec5').prop("readonly", true);
            $('#btn_sec5').hide();
            $('#nc_sec5cost').prop("readonly", true);

            $('#datetime41').prop("readonly", true);
            $('#datetime42').prop("readonly", true);
        }

        /*************************CONTROL SEC5**************************************/

        if ($('#check_qmr').val() !== "QMR") {
            $('#nc_sec5').prop("readonly", true);
            $('#nc_sec5file').prop("readonly", true);
            $('#nc_sec5cost').prop("readonly", true);
            $('#btn_sec5').hide();
        }





        /**********************NAV*********************************/
        if ($('#check_numrow_cp').val() == "0") {
            $('.cpnew').hide();
        }
        if ($('#check_numrow_nc').val() == "0") {
            $('.ncnew').hide();
        }



        /*********************Check Upload File****************************************/
        $('input[type=file][name=file_add]').change(function () {/*********Add Page************/
            var ext = $('#file_add').val().split('.').pop().toLowerCase();
//Allowed file types
            if ($.inArray(ext, ['doc', 'docx', 'xls', 'xlsx', 'pdf']) == -1) {
                alert('The file type is invalid!');
                $('#file_add').val("");
            }
            if (this.files[0].size > 1048576) {
                alert("Maximum image size is 1MB !!");
                this.value = "";
                exit;
            }


        });




        $('input[type=file][name=cp_detail_inves_file]').change(function () {/*********Investigate Section************/
            var ext = $('#cp_detail_inves_file').val().split('.').pop().toLowerCase();
//Allowed file types
            if ($.inArray(ext, ['doc', 'docx', 'xls', 'xlsx', 'pdf']) == -1) {
                alert('The file type is invalid!');
                $('#cp_detail_inves_file').val("");
            }
            if (this.files[0].size > 1048576) {
                alert("Maximum image size is 1MB !!");
                this.value = "";
                exit;
            }


        });




        $('input[type=file][name=cp_sum_inves_file]').change(function () {/*********Summary Section************/
            var ext = $('#cp_sum_inves_file').val().split('.').pop().toLowerCase();
//Allowed file types
            if ($.inArray(ext, ['doc', 'docx', 'xls', 'xlsx', 'pdf']) == -1) {
                alert('The file type is invalid!');
                $('#cp_sum_inves_file').val("");
            }
            if (this.files[0].size > 1048576) {
                alert("Maximum image size is 1MB !!");
                this.value = "";
                exit;
            }


        });



        $('input[type=file][name=cp_conclu_file]').change(function () {/*********Conclusion Section************/
            var ext = $('#cp_conclu_file').val().split('.').pop().toLowerCase();
//Allowed file types
            if ($.inArray(ext, ['doc', 'docx', 'xls', 'xlsx', 'pdf']) == -1) {
                alert('The file type is invalid!');
                $('#cp_conclu_file').val("");

            }
            if (this.files[0].size > 1048576) {
                alert("Maximum image size is 1MB !!");
                this.value = "";
                exit;
            }



        });




        $('input[type=file][name=file_add_edit]').change(function () {/*********Edit Page************/
            var ext = $('#file_add_edit').val().split('.').pop().toLowerCase();
//Allowed file types
            if ($.inArray(ext, ['doc', 'docx', 'xls', 'xlsx', 'pdf']) == -1) {
                alert('The file type is invalid!');
                $('#file_add_edit').val("");

            }
            if (this.files[0].size > 1048576) {
                alert("Maximum image size is 1MB !!");
                this.value = "";
                exit;
            }



        });



        $('input[type=file][name=cp_detail_inves_file_edit]').change(function () {/*********Investigation Edit Page************/
            var ext = $('#cp_detail_inves_file_edit').val().split('.').pop().toLowerCase();
//Allowed file types
            if ($.inArray(ext, ['doc', 'docx', 'xls', 'xlsx', 'pdf']) == -1) {
                alert('The file type is invalid!');
                $('#cp_detail_inves_file_edit').val("");

            }
            if (this.files[0].size > 1048576) {
                alert("Maximum image size is 1MB !!");
                this.value = "";
                exit;
            }



        });




        $('input[type=file][name=nc_sec4f1_file]').change(function () {/*********NC 4f1************/
            var ext = $('#nc_sec4f1_file').val().split('.').pop().toLowerCase();
//Allowed file types
            if ($.inArray(ext, ['doc', 'docx', 'xls', 'xlsx', 'pdf']) == -1) {
                alert('The file type is invalid!');
                $('#nc_sec4f1_file').val("");

            }
            if (this.files[0].size > 1048576) {
                alert("Maximum image size is 1MB !!");
                this.value = "";
                exit;
            }



        });


        $('input[type=file][name=nc_sec4f2_file]').change(function () {/*********NC 4f2************/
            var ext = $('#nc_sec4f2_file').val().split('.').pop().toLowerCase();
//Allowed file types
            if ($.inArray(ext, ['doc', 'docx', 'xls', 'xlsx', 'pdf']) == -1) {
                alert('The file type is invalid!');
                $('#nc_sec4f2_file').val("");

            }
            if (this.files[0].size > 1048576) {
                alert("Maximum image size is 1MB !!");
                this.value = "";
                exit;
            }



        });



        $('input[type=file][name=nc_sec4f3_file]').change(function () {/*********NC 4f3************/
            var ext = $('#nc_sec4f3_file').val().split('.').pop().toLowerCase();
//Allowed file types
            if ($.inArray(ext, ['doc', 'docx', 'xls', 'xlsx', 'pdf']) == -1) {
                alert('The file type is invalid!');
                $('#nc_sec4f3_file').val("");

            }
            if (this.files[0].size > 1048576) {
                alert("Maximum image size is 1MB !!");
                this.value = "";
                exit;
            }



        });





        $('input[type=file][name=nc_sec5file]').change(function () {/*********NC sec5************/
            var ext = $('#nc_sec5file').val().split('.').pop().toLowerCase();
//Allowed file types
            if ($.inArray(ext, ['doc', 'docx', 'xls', 'xlsx', 'pdf']) == -1) {
                alert('The file type is invalid!');
                $('#nc_sec5file').val("");

            }
            if (this.files[0].size > 1048576) {
                alert("Maximum image size is 1MB !!");
                this.value = "";
                exit;
            }



        });







        /******* 102400 ** = 100KB********/
        /******* 1048576 *** = 1MB *******************/


        /*********************DASHBOARD**************************/

        /*********************DASHBOARD**************************/
        



        /*******************************************************/
//        $('#set_score').keyup(function (){
//            var total_score = $('#show_score').val();
//            var pri_score = $('#set_score').val();
//            var regExp = /^[0-9]*$/;
//            
//            if(total_score <= 0){
//                alert("The score not enough");
//                location.reload();
//            }else{
//                sum = total_score - pri_score ;
//                $('#show_score').val(sum);
//            }
//        });



/*************************SETTING****ZONE************************/

//if($('#check_posi').val() == 15){
//    $('.user_permission').hide(0);

/*************************SETTING****ZONE************************/









    });/********************END MAIN FUNCTION***********************/




</script>



