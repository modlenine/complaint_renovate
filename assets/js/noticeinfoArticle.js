$(document).ready(function(){
    const catid = $('#catidParam').val();
    getNoticeArticleList(catid);

    function getNoticeArticleList(catid)
    {
        if(catid != ""){
            let thid = 1;
            $('#tbl_noticeinfoArticle_list thead th').each(function() {
                var title = $(this).text();
                $(this).html(title + ' <input type="text" id="tbl_noticeinfoArticle_list'+thid+'" class="col-search-input" placeholder="Search ' + title + '" />');
                thid++;
            });
        
            $('#tbl_noticeinfoArticle_list').DataTable().destroy();
        
            let table = $('#tbl_noticeinfoArticle_list').DataTable({
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
                            "url":url+'noticeinfo/getNoticeArticleList/'+catid,
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
    }

    $(document).on('click' , '#btn-addArticle' , function(){
        $('#addArticle_modal').modal('show')
    });

    $(document).on('click' , '#btn-saveArticle' ,function(){
        if(document.getElementById('addArticlename').value == ""){
            swal({
                title: 'กรุราระบุชื่อรายการ',
                type: 'error',
                showConfirmButton: false,
                timer:1000
            });
        }else if(document.getElementById('addArticleDetail').value == ""){
            swal({
                title: 'กรุราระบุรายละเอียด',
                type: 'error',
                showConfirmButton: false,
                timer:1000
            });
        }else{
            saveArticle();
        }
    });

    function saveArticle() {
        const fileInput = document.getElementById('addArticleFile');
        const file = fileInput.files[0];
        const allowedTypes = ['application/pdf'];
        const otherData = {
            artname: document.getElementById('addArticlename').value,
            artdetail: document.getElementById('addArticleDetail').value,
            artorder: document.getElementById('addArticleorder').value,
            artcatid: document.getElementById('catidParam').value
        };
    
        if (file && allowedTypes.includes(file.type)) { // ตรวจสอบว่าไฟล์เป็น PDF และมีประเภทที่ยอมรับหรือไม่
            const formData = new FormData();
            formData.append('file', file);

            for(const key in otherData){
                formData.append(key , otherData[key]);
            }
    
            axios.post(url+'noticeinfo/saveArticle', formData)
                .then(res => {
                    console.log(res.data);
                    // Handle success
                    if(res.data.status == "Insert Data Success"){
                        swal({
                            title: 'บันทึกข้อมูลสำเร็จ',
                            type: 'success',
                            showConfirmButton: false,
                            timer:1000
                        }).then(function(){
                            document.getElementById("closeAddArticle").click();
                            $('#tbl_noticeinfoArticle_list').DataTable().ajax.reload();
                        });
                    }
                })
                .catch(error => {
                    console.error(error);
                    // Handle error
                });
        } else {
            alert('Please select a PDF file.');
        }
    }

    $(document).on('click' , '.delArticle' , function(){
        const data_artid = $(this).attr("data_artid");
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
              axios.post(url+'noticeinfo/deleteArticle' , {
                artid:data_artid,
                action:"deleteArticle"
              }).then(res=>{
                console.log(res.data);
                if(res.data.status == "Delete Data Success"){
                    swal({
                        title: 'ลบข้อมูลสำเร็จ',
                        type: 'success',
                        showConfirmButton: false,
                        timer:1000
                    }).then(function(){
                        $('#tbl_noticeinfoArticle_list').DataTable().ajax.reload();
                    });
                }
              });
            }
        });
    });

    $(document).on('click' , '.editArticle' , function(){
        $('#editArticle_modal').modal('show');
        const articleid = $(this).attr("data_artid");
        axios.post(url+'noticeinfo/getArticlefulldata' ,{
            action:"getArticlefulldata",
            articleid:articleid
        }).then(res=>{
            console.log(res.data);
            if(res.data.status == "Select Data Success"){
                let result = res.data.result;
                $('#editArticlename').val(result.noticeart_title);
                $('#editArticleorder').val(result.noticeart_order);
                $('#editArticleDetail').val(result.noticeart_detail);
                $('#editArticleFileShow').val(result.noticeart_file);
                const preview = document.getElementById('previewOld');
                preview.innerHTML = `<embed src="${url}assets/files/${result.noticeart_file}" width="100%" height="300" />`;
                document.getElementById("btn-saveEditArticle").setAttribute('data_articleId' , articleid);
            }
        });
    });

    $(document).on('click' , '#btn-saveEditArticle' , function(){
        if(document.getElementById('editArticlename').value == ""){
            swal({
                title: 'กรุราระบุชื่อรายการ',
                type: 'error',
                showConfirmButton: false,
                timer:1000
            });
        }else if(document.getElementById('editArticleDetail').value == ""){
            swal({
                title: 'กรุราระบุรายละเอียด',
                type: 'error',
                showConfirmButton: false,
                timer:1000
            });
        }else{
            saveEditArticle();
        }
    });

    function saveEditArticle() {
        const fileInput = document.getElementById('editArticleFile');
        const file = fileInput.files[0];
        const allowedTypes = ['application/pdf'];
        const otherData = {
            artname: document.getElementById('editArticlename').value,
            artdetail: document.getElementById('editArticleDetail').value,
            artorder: document.getElementById('editArticleorder').value,
            artcatid: document.getElementById('catidParam').value,
            artid: document.getElementById("btn-saveEditArticle").getAttribute("data_articleId")
        };
    
        if (file && allowedTypes.includes(file.type)) { // ตรวจสอบว่าไฟล์เป็น PDF และมีประเภทที่ยอมรับหรือไม่
            const formData = new FormData();
            formData.append('file', file);
            for(const key in otherData){
                formData.append(key , otherData[key]);
            }
            axios.post(url+'noticeinfo/saveEditArticle', formData)
                .then(res => {
                    console.log(res.data);
                    // Handle success
                    if(res.data.status == "Update Data Success"){
                        swal({
                            title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
                            type: 'success',
                            showConfirmButton: false,
                            timer:1000
                        }).then(function(){
                            document.getElementById("closeEditArticle").click();
                            $('#tbl_noticeinfoArticle_list').DataTable().ajax.reload();
                        });
                    }
                })
                .catch(error => {
                    console.error(error);
                    // Handle error
                });
        } else {
            const formData = new FormData()
            for(const key in otherData){
                formData.append(key , otherData[key]);
            }
            axios.post(url+'noticeinfo/saveEditArticle', formData)
                .then(res => {
                    console.log(res.data);
                    // Handle success
                    if(res.data.status == "Update Data Success"){
                        swal({
                            title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
                            type: 'success',
                            showConfirmButton: false,
                            timer:1000
                        }).then(function(){
                            document.getElementById("closeEditArticle").click();
                            $('#tbl_noticeinfoArticle_list').DataTable().ajax.reload();
                        });
                    }
                })
                .catch(error => {
                    console.error(error);
                    // Handle error
                });
        }
    }
});