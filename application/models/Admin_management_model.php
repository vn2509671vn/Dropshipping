<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_management_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function getAllInfo(){
        $sql = "select * from admin_management";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function getAllUserInfo(){
        $sql = "select * from users where user_role = 0";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getAllUserNonFree(){
        $sql = "select * from users where user_role = 0 and user_free_acc = 0";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function updateAllInfo($info)
    {
        $sql = "update admin_management set
        pp = ".$info['pp'].",
        ep1 = ".$info['ep1'].",
        ep2 = ".$info['ep2'].",
        f = ".$info['f'].",
        fee = ".$info['fee'].",
        advertisement_1 = '".$info['advertisement_1']."',
        advertisement_2 = '".$info['advertisement_2']."',
        advertisement_3 = '".$info['advertisement_3']."'";
        $query = $this->db->query($sql);
    }
    
    public function getFeeHistory(){
        $sql = "select fee_history.*, users.user_name, users.user_email, CONCAT(fee_history.month,'-',fee_history.year) as date from fee_history, users where users.user_id = fee_history.user_id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function existFeeHistory($userID, $month, $year){
        $sql = "select * from fee_history where user_id = '$userID' and month = '$month' and year = '$year'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return true;
        }
        else {
            return false;
        }
    }
    
    public function insertFeeHistory($userID, $month, $year, $fee){
        $sql = "insert into fee_history(user_id, fee, status, month, year) values('$userID', '$fee', 0, '$month', '$year')";
        $query = $this->db->query($sql);
        $result = $this->existFeeHistory($userID, $month, $year);
        return $result;
    }
    
    public function updateFeeHistory($userID, $month, $year, $status){
        $sql = "update fee_history set status = '$status' where user_id = '$userID' and month = '$month' and year = '$year'";
        $query = $this->db->query($sql);
        if($query){
            return true;
        }
        return false;
    }
	
	public function auto_check_price(){
	    $sql = "insert into test_cronjob(szTime) values(NOW())";
	    $this->db->query($sql);
	}
}