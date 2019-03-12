<?php
class Dashboard_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function plus_number($a,$b){
        $c = $a+ $b;
        return $c;
    }
    
    
    
    
    
}


?>