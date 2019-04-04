<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        
        
                <!-- Latest compiled and minified CSS -->
<!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">-->
<!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->
                
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
        
        
<!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/paper/bootstrap.min.css" />-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdn.rawgit.com/mladenplavsic/bootstrap-navbar-sidebar/3bd282bd/docs/navbar-fixed-right.min.css">
  <link rel="stylesheet" href="https://cdn.rawgit.com/mladenplavsic/bootstrap-navbar-sidebar/3bd282bd/docs/navbar-fixed-left.min.css">
  <link rel="stylesheet" href="https://cdn.rawgit.com/mladenplavsic/bootstrap-navbar-sidebar/3bd282bd/docs/docs.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdn.rawgit.com/mladenplavsic/bootstrap-navbar-sidebar/3bd282bd/docs/docs.js"></script>
  
  
  
        

  <style>
      /******************Main**********************/
      .dataTables_filter {
display: none; 
}
      body{
          min-height:100vh;
      }
      label{
          font-weight: 400;
      }
      .navbar-header{
          width:100%;
          background-color: #2196f3;
      }
      .bg_new{
          background-color:#FFCC00;
          font-size:10px;
      }
      .form-control{
    
      }
      .navbar-inverse{
          background-color: #2196f3;
          color:#ffffff;
          border-color: #2196f3;
      }
      .navbar-inverse .navbar-nav>li>a{
          color:#E6E6FA;
      }
      .navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:focus, .navbar-inverse .navbar-nav>.open>a:hover{
          background-color: #337ab7;
      }
      .navbar-inverse .navbar-brand{
          color:#ffffff;
      }
      .panel-primary>.panel-heading{
          background-color: #2196f3;
          
      }
      .panel-danger>.panel-heading{
          background-color: #CC0000;
          color:white;
          
      }
      .panel-danger{
          border-color:#CC0000;
      }
      .panel-warning>.panel-heading{
          background-color:#FFD700;
          
      }
      .panel-warning{
          border-color:#FFD700;
      }
      .btn-primary{
          background-color: #2196f3;
          border-color: #2196f3;
      }
      .panel-default>.panel-heading{
          background-color:#a2a2a2;
      }
      .panel-default{
          border-color:#a2a2a2;
      }

      
/********************VIEW Page**********************/
/**********Main************/
      .h1_view{
          text-align: center;
      }
      .btn_start_inves{
          padding: 15px;
      }
      .head_list_cp{
          text-align: center;
      }

/**********Mobile+Tablet***********/
@media screen and (max-width: 600px) {/******Mobile*******/
    .m_pri{
        background-color:#afeeeeb0;
        padding: 10px;
        margin-bottom: 5px;
    }
}
@media screen and (max-width: 900px) {/******Tablet*****/
    .m_pri{
        background-color:#afeeeeb0;
        padding: 10px;
        margin-bottom: 5px;
    }
}


/********************Add Page**********************/
/***********Main**************/
.h1_add{
    text-align: center;
}
.btn_back{
    margin-bottom:5px;
}
.pri{
    margin-bottom: 10px;
}
/**********Mobile+Tablet***********/
@media screen and (max-width: 600px) {/******Mobile*******/
.pri{
    margin-bottom: 20px;
}
}
@media screen and (max-width: 900px) {/******Tablet*****/

}


/**************INVESTIGATE PAGE*****************/
/********Main*********/
.sum_text{
    color:red;
    font-weight:600;
}

.editlayout{
    margin: -10px 20px 20px 20px;
}
.form_inves{
    display:none;
}




/********************NAV************************/
.logout_btn{
    position: absolute;
    right:20px;
    top:50px;
    color:#E6E6FA;
}
.navbar-inverse .navbar-toggle{
    border-color: #E6E6FA;
}
.navbar-inverse .navbar-toggle:focus, .navbar-inverse .navbar-toggle:hover{
    background-color: #E6E6FA;
}
.navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form{
    border-color: #E6E6FA;
}
@media screen and (max-width: 600px) {
    .logout_btn{
    position: relative;
    top:0;
    right:0;
    }
    .navbar-inverse .navbar-nav .open .dropdown-menu>li>a{
     color:#E6E6FA;
    }
}








/*************************START**NC***>>>>>>>>>>>************************/


/**********MAIN***********/
.head_text{
    text-align: center;
}

.ncmain_s1_label{
    font-weight: 600;
}

.sec4label{
    color:red;
    font-size: 12px;
}
.showdate3text{
    color:red;
    
}























      
      
  </style>        
  <?php  date_default_timezone_set('Asia/Bangkok'); ?>
</head>

</html>
