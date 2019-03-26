<?php
class Test_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function active_email(){
        
    }
    
    public function deactive_email(){
        
    }
    
    public function send_email(){
        /*  -------------------------SEND--EMAIL------------------------------------------   */
        $sqlEmail = "SELECT email FROM maillist WHERE cp_mail_active = 1 "; //1=it , 2=sales , 3=cs
        $query = $this->db->query($sqlEmail);
        
        foreach ($query->result_array() as $fetch) {

           echo $fetch['email']."<br>";
           
           
           
        }
        

    }
    
}

?>