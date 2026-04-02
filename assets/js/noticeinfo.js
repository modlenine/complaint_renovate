$(document).ready(function(){
    getNoticeinfoList(url);

    $(document).on('click' , '.editCate' , function(){
        const data_catid = $(this).attr("data_catid");
        const data_catname = $(this).attr('data_catname');
        const data_catorder = $(this).attr('data_catorder');
        console.log(data_catid);
        $('#editCategory_modal').modal("show");
        $('#editCatname').val(data_catname);
        $('#editCatorder').val(data_catorder);
        $('#btn-saveEditCat').attr({
            "data_catid" : data_catid,
        });

    });

    $(document).on('click' , '.delCate' , function(){
        const data_catid = $(this).attr("data_catid");
        console.log(data_catid);
        swal({
            title: 'ต้องการลบรายการที่เลือก ใช่หรือไม่',
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText:'ยกเลิก'
        }).then((result)=> {
            if(result.value == true){
              axios.post(url+'noticeinfo/deleteCat' , {
                catid:data_catid,
                action:"deleteCat"
              }).then(res=>{
                console.log(res.data);
                if(res.data.status == "Delete Data Success"){
                    swal({
                        title: 'ลบข้อมูลสำเร็จ',
                        type: 'success',
                        showConfirmButton: false,
                        timer:1000
                    }).then(function(){
                        $('#tbl_noticeinfo_list').DataTable().ajax.reload();
                    });
                }else if(res.data.status == "Can not Delete Data"){
                    swal({
                        title: 'ไม่สามารถลบข้อมูลได้ เนื่องจากมีบทความออนไลน์อยู่',
                        type: 'error',
                        showConfirmButton: false,
                        timer:1000
                    });
                }
              });
            }
        });
    });

    $(document).on('click' , '#btn-saveEditCat' , function(){
        // check data null
        if($('#editCatname').val() != ""){
            axios.post(url+'noticeinfo/saveEditCat' , {
                action:"saveEditCat",
                catid:$('#btn-saveEditCat').attr("data_catid"),
                catname:$('#editCatname').val(),
                catorder:$('#editCatorder').val()
            }).then(res=>{
                console.log(res.data);
                if(res.data.status == "Update Data Success"){
                    swal({
                        title: 'อัพเดตข้อมูลสำเร็จ',
                        type: 'success',
                        showConfirmButton: false,
                        timer:1000
                    }).then(function(){
                        document.getElementById("closeEditCat").click();
                        $('#tbl_noticeinfo_list').DataTable().ajax.reload();
                    });
                }
            });
        }else{
            swal({
                title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                type: 'error',
                showConfirmButton: false,
                timer:1000
            });
        }
    });

    $(document).on('click' , '#btn-addCategory' , function(){
        $('#addCategory_modal').modal('show');
    });

    $(document).on('click' , '#btn-saveCat' , function(){
        // Check Data Null
        if($('#addCatname').val() != ""){
            axios.post(url+'noticeinfo/saveCategory' , {
                action:"saveCategory",
                catname:$('#addCatname').val(),
                catorder:$('#addCatorder').val()
            }).then(res=>{
                console.log(res.data);
                if(res.data.status == "Insert Data Success"){
                    swal({
                        title: 'บันทึกข้อมูลสำเร็จ',
                        type: 'success',
                        showConfirmButton: false,
                        timer:1000
                    }).then(function(){
                        document.getElementById("closeAddCat").click();
                        $('#tbl_noticeinfo_list').DataTable().ajax.reload();
                    });
                }
            });
        }
    });
});


function getNoticeinfoList(url)
{

    let thid = 1;
    $('#tbl_noticeinfo_list thead th').each(function() {
        var title = $(this).text();
        $(this).html(title + ' <input type="text" id="tbl_noticeinfo_list'+thid+'" class="col-search-input" placeholder="Search ' + title + '" />');
        thid++;
    });

    $('#tbl_noticeinfo_list').DataTable().destroy();

    let table = $('#tbl_noticeinfo_list').DataTable({
                "scrollX": true,
                "processing": true,
                "serverSide": true,
                "stateSave": true,
                "pageLength":25,
                stateLoadParams: function(settings, data) {
                    for (i = 0; i < data.columns["length"]; i++) {
                        let col_search_val = data.columns[i].search.search;
                        if (col_search_val !== "") {
                            $("input", $("#tbl_noticeinfo_list thead th")[i]).val(col_search_val);
                        }
                    }
                },
                "ajax": {
                    "url":url+'noticeinfo/noticeCategoryList',
                },
                order: [
                    [0, 'desc']
                ],
                columnDefs: [{
                        targets: "_all",
                        orderable: false
                    },
                ],
    });

    // $('#tbl_noticeinfo_list tbody').on('click', 'tr', function() {
    //     let data = table.row(this).data();
    //     alert('You clicked on row: ' + data[0]);
    // });

    table.columns().every(function() {
        var table = this;
        $('input', this.header()).on('keyup change', function() {
            if (table.search() !== this.value) {
                table.search(this.value).draw();
            }
        });
    });

    table.on('order.dt search.dt', function () {
        table.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    // $('#normal_list6 , #normal_list2').prop('readonly' , true).css({
    //     'background-color':'#F5F5F5',
    //     'cursor':'no-drop'
    // });
}


