$(document).ready(function(){
    const articleid = $('#articleidParam').val();

    getArticlefulldata(articleid);

    function getArticlefulldata(articleid)
    {
        if(articleid != ""){
            axios.post(url+'noticeinfo/getArticlefulldata' , {
                action:"getArticlefulldata",
                articleid:articleid
            }).then(res=>{
                console.log(res.data);
                if(res.data.status == "Select Data Success"){
                    let result = res.data.result;
                    let embedHtml = `
                        <embed src="`+url+`assets/files/`+result.noticeart_file+`" type="application/pdf" width="100%" height="500px" />
                    `;
                    $('#embedshow').html(embedHtml);


                    let downloadHtml = `
                        <a href="`+url+`assets/files/`+result.noticeart_file+`" download><button class="btn btn-success">Download PDF File</button></a>
                    `;
                    $('#downloadshow').html(downloadHtml);

                    let noticeartTitle = `<label><b>หัวข้อ : </b>`+result.noticeart_title+`</label>`;
                    $('#noticeartTitleshow').html(noticeartTitle);

                    let noticeartDetail = `<label><b>รายละเอียด : </b>`+result.noticeart_detail+`</label>`;
                    $('#noticeartDetailshow').html(noticeartDetail);
                    $('#categoryNameShow').html('<a href="'+url+'noticeinfo">'+result.noticecat_name+'</a> / <a href="'+url+'noticeinfo/noticeArticleList/'+result.noticeart_cat+'">'+result.noticecat_name+' แสดงรายการ</a>');
                }
            });
        }
    }

});