<?php
class getfn{
    public $ci;

    function __construct()
    {
        $this->ci = &get_instance();
        date_default_timezone_set("Asia/Bangkok");
    }

    public function gci()
    {
        return $this->ci;
    }
}


function getuser()
{
	$obj = new getfn();
	
	// รองรับทั้ง ecode (SSO) และ username (legacy)
	$ecode = $obj->gci()->session->userdata('ecode');
	$username = $obj->gci()->session->userdata('username');
	
	if(!empty($ecode)){
		// ใช้ ecode จาก SSO (แนะนำ)
		$obj->gci()->db->where("ecode", $ecode);
	}elseif(!empty($username)){
		// fallback ใช้ username (legacy support)
		$obj->gci()->db->where("username", $username);
	}else{
		// ไม่มี session - return null
		return null;
	}
	
	$query = $obj->gci()->db->get("member");
	
	if($query->num_rows() > 0){
		return $query->row();
	}
	
	return null;
}

?>
