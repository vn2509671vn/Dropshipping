<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    // Returns a single result row. 
    public function getUserDetail($email){
        $sql = "select * from users where user_email = '$email'";
        $query = $this->db->query($sql);
        return $query->row_array(); // it returns an array
    }
    
        public function getUserDetailById($id){
        $sql = "select * from users where user_id = '$id'";
        $query = $this->db->query($sql);
        return $query->row_array(); // it returns an array
    }
    
    public function loginUser($email, $pwd){
        $sql = "select * from users where user_email = '$email' and user_password = '$pwd' and user_status = 1";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return true;
        }
        else {
            return false;
        }
    }
    
    public function existMail($email){
        $sql = "select * from users where user_email = '$email'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return true;
        }
        else {
            return false;
        }
    }
    
    public function getUserByEmail($email){
        $sql = "select * from users where user_email = '$email'";
        $query = $this->db->query($sql);
        return $query->row_array(); 
    }
    
    public function getAdminConfig(){
        $sql = "select * from admin_management";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function insertUser($fullname, $phonenumber, $birthday, $gender, $address, $country, $email, $password, $status){
        $sql = "insert into users(user_name, user_phone, user_birthday, user_gender, user_address, user_country, user_email, user_password, user_status, user_create_date) ";
        $sql .= "values(N'$fullname', '$phonenumber', '$birthday', '$gender', N'$address', N'$country', '$email', '$password', $status, CURDATE())";
        $this->db->query($sql);
    }
    
    public function registerUser($fullname, $phonenumber, $birthday, $gender, $address, $country, $email, $password, $status){
        $existMail = $this->existMail($email);
        if($existMail){
            return false;
        }
        else {
            $this->insertUser($fullname, $phonenumber, $birthday, $gender, $address, $country, $email, $password, $status);
            $success = $this->existMail($email);
            if($success){
                // Compute fee
                $userInfo = $this->getUserByEmail($email);
                $adminConfig = $this->getAdminConfig();
                $date = new DateTime($userInfo['user_create_date']);
                $date->modify('+6 day'); // free 5 days for using
                $date = $date->format('Y-m-d');
                $date = strtotime($date);
                $day = date("d", $date);
                $month = date("m", $date);
                $year = date("Y", $date);
                $totalDay = cal_days_in_month(CAL_GREGORIAN,$month,$year);
                $fee = (($totalDay - $day)*$adminConfig['fee'])/$totalDay;
                $this->load->model('admin_management_model');
                $tmpResult = $this->admin_management_model->insertFeeHistory($userInfo['user_id'], $month, $year, $fee);
            }
            return $success;
        }
    }
    
    public function changeInfo($fullname, $phonenumber, $birthday, $gender, $address, $country, $email){
        $sql = "update users set user_name = N'$fullname', user_phone = '$phonenumber', user_birthday = '$birthday', user_gender = '$gender', user_address = N'$address', user_country = N'$country' ";
        $sql .= "where user_email = '$email'";
        $this->db->query($sql);
    }
    
    public function changePass($new_pwd, $email){
        $sql = "update users set user_password = '$new_pwd' ";
        $sql .= "where user_email = '$email'";
        $this->db->query($sql);
        
        $sql_check_success = "select * from users where user_email = '$email' and user_password = '$new_pwd'";
        $query = $this->db->query($sql_check_success);
        if($query->num_rows() > 0){
            return true;
        }
        else {
            return false;
        }
    }
    
    public function change_status($user_id, $status = 0)
    {
        $sql = "update users set user_status = '$status' where user_id = '$user_id'";
        $response = $this->db->query($sql);
        if($response){
            return true;
        }
        return false;
    }
    
    public function change_type($user_id, $type = 0)
    {
        $sql = "update users set user_free_acc = '$type' where user_id = '$user_id'";
        $response = $this->db->query($sql);
        if($response){
            return true;
        }
        return false;
    }
    
    public function getUserConfig($user_id){
        $sql = "select * from config where config_user = '$user_id'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function existConfig($user_id){
        $sql = "select * from config where config_user = '$user_id'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return true;
        }
        else {
            return false;
        }
    }
    
    public function updateConfig(
        $user_id, 
        $config_ep, 
        $config_currency_unit_paypal, 
        $config_currency_unit_su, 
        $config_currency_unit_paypal_su, 
        $config_currency_unit_paypal_value,
        $config_currency_unit_su_value,
        $config_min_profit_per,
        $config_announce_email
    )
    {
        $sql = "update config set config_ep = '$config_ep' ";
        $sql .= ",config_currency_unit_paypal = '$config_currency_unit_paypal' ";
        $sql .= ",config_currency_unit_su = '$config_currency_unit_su' ";
        $sql .= ",config_currency_unit_paypal_su = '$config_currency_unit_paypal_su' ";
        $sql .= ",config_currency_unit_paypal_value = '$config_currency_unit_paypal_value' ";
        $sql .= ",config_currency_unit_su_value = '$config_currency_unit_su_value' ";
        $sql .= ",config_min_profit_per = '$config_min_profit_per' ";
        $sql .= ",config_announce_email = '$config_announce_email' ";
        $sql .= "where config_user = '$user_id'";
        $response = $this->db->query($sql);
        if($response){
            return true;
        }
        return false;
    }
    
    public function insertConfig(
        $user_id, 
        $config_ep, 
        $config_currency_unit_paypal, 
        $config_currency_unit_su, 
        $config_currency_unit_paypal_su, 
        $config_currency_unit_paypal_value,
        $config_currency_unit_su_value,
        $config_min_profit_per,
        $config_announce_email
    )
    {
        $sql = "insert into config(
        config_user, 
        config_ep,
        config_currency_unit_paypal,
        config_currency_unit_su,
        config_currency_unit_paypal_su,
        config_currency_unit_paypal_value,
        config_currency_unit_su_value,
        config_min_profit_per,
        config_announce_email
        ) 
        values(
            '$user_id',
            '$config_ep',
            '$config_currency_unit_paypal',
            '$config_currency_unit_su',
            '$config_currency_unit_paypal_su',
            '$config_currency_unit_paypal_value',
            '$config_currency_unit_su_value',
            '$config_min_profit_per',
            '$config_announce_email')";
        $this->db->query($sql);
        $result = $this->existConfig($user_id);
        return $result;
    }
    
    public function totalFeeByUser($user_id){
        $sql = "select sum(fee) as totalFee from fee_history where user_id = '$user_id' and status = 0";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
}