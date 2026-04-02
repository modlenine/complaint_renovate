function getCategory_menu(url , userType , deptcode)
{
    axios.post(url+'main/getCategory_menu' , {
        usertype:userType,
        action:"getdatahead"
    }).then(res=>{
        console.log(res.data);
        if(res.data.status == "Select Data Success"){
            let result = res.data.result;
            let html = `
                <li>
                    <a href="`+url+`" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-house1"></span><span class="mtext">Hompage</span>
                    </a>
                </li> 
            `;
            for(let i = 0;i<result.length;i++){
                html +=`
                    <li>
						<div class="dropdown-divider"></div>
					</li>
                    <li>
						<div class="sidebar-small-cap">`+result[i].mainCategory+`</div>
					</li>
                `;
                for(let j = 0; j < result[i].mainMenu.length; j++){

                    let notifyactiveIcon = '';
                    if(result[i].mainMenu[j].menu_name == "Credit Request Form"){
                        notifyactiveIcon = `<i class="ion-android-notifications activenotifyLeft"></i>`;
                    }else if(result[i].mainMenu[j].menu_name == "ใบขอเบิกจ่าย ( New )"){
                        notifyactiveIcon = `<i class="ion-android-notifications activenotifyLeft"></i>`;
                    }else if(result[i].mainMenu[j].menu_name == "CSRO"){
                        notifyactiveIcon = `<i class="ion-android-notifications activenotifyLeft"></i>`;
                    }else if(result[i].mainMenu[j].menu_name == "IT Asset"){
                        notifyactiveIcon = `<i class="ion-android-notifications activenotifyLeft"></i>`;
                    }else if(result[i].mainMenu[j].menu_name == "HRMS"){
                        notifyactiveIcon = `<i class="ion-android-notifications activenotifyLeft"></i>`;
                    }else if(result[i].mainMenu[j].menu_name == "Safety System Online"){
                        notifyactiveIcon = `<i class="ion-android-notifications activenotifyLeft"></i>`;
                    }else if(result[i].mainMenu[j].menu_name == "Complaint [New]"){
                        notifyactiveIcon = `<i class="ion-clock progressnotifyLeft"></i>`;
                    }else if(result[i].mainMenu[j].menu_name == "RAO"){
                        notifyactiveIcon = `<i class="ion-clock progressnotifyLeft"></i>`;
                    }else if(result[i].mainMenu[j].menu_name == "Lab System"){
                        notifyactiveIcon = `<i class="ion-clock progressnotifyLeft"></i>`;
                    }

                    html += `
                    <li>
						<a href="`+result[i].mainMenu[j].menu_link+`" target="_blank" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-right-arrow-1"></span><span class="mtext">`+result[i].mainMenu[j].menu_name+`</span>
                            `+notifyactiveIcon+`
						</a>
					</li>
                    `;
                }
            }

            if(userType == "member" && deptcode == "1002"){
                html +=`
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <div class="sidebar-small-cap">Setting</div>
                </li>
                <li>
                    <a href="calendar.html" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-right-arrow-1"></span><span class="mtext">ตั้งค่าเมนู</span>
                    </a>
                </li>
                `;
            }
                html +=`
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <div class="sidebar-small-cap">Login</div>
                    </li>

                    <li>
                        <a href="`+url+`login" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-user-13"></span><span class="mtext">Login</span>
                        </a>
                    </li>    
                `;

            $('.cate_menu').html(html);
        }else{
            location.href = "/intranet/main/pagenotfound";
        }
    });
}