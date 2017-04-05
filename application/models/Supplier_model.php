<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function getSupplier($combined_id, $userid){
        $sql = "select * from supplier where combined_id = '$combined_id' and user_id = '$userid'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function getAllSupplier($userid){
        $sql = "select * from supplier where user_id = '$userid'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getTotalSupplier(){
        $sql = "select * from supplier";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getCheckSupplier(){
        $sql = "select * from check_supplier";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function updateCheckPoint($checkPoint)
    {
        $sql = "update check_supplier set check_point = '$checkPoint' ";
        $response = $this->db->query($sql);
        if($response){
            return true;
        }
        return false;
    }
    
    public function updateLastCheck($lastCheck)
    {
        $sql = "update check_supplier set last_check = '$lastCheck' ";
        $response = $this->db->query($sql);
        if($response){
            return true;
        }
        return false;
    }
    
    public function existCombinedID($combined_id, $userid){
        $sql = "select * from supplier where combined_id = '$combined_id' and user_id = '$userid'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return true;
        }
        else {
            return false;
        }
    }
    
    public function updateSupplier(
        $combined_id, 
        $eBay_id, 
        $eBay_name, 
        $eBay_fee, 
        $paypal_fee,
        $su_link,
        $su_id,
        $su_name,
        $cost,
        $rrp,
        $erp,
        $estimate_profit,
        $note,
        $userid
    )
    {
        $sql = "update supplier set eBay_id = '$eBay_id' ";
        $sql .= ",eBay_name = '$eBay_name' ";
        $sql .= ",eBay_fee = '$eBay_fee' ";
        $sql .= ",paypal_fee = '$paypal_fee' ";
        $sql .= ",su_url = '$su_link' ";
        $sql .= ",su_id = '$su_id' ";
        $sql .= ",su_name = '$su_name' ";
        $sql .= ",cost = '$cost' ";
        $sql .= ",rrp = '$rrp' ";
        $sql .= ",erp = '$erp' ";
        $sql .= ",estimate_profit = '$estimate_profit' ";
        $sql .= ",note = '$note' ";
        $sql .= "where combined_id = '$combined_id' and user_id = '$userid'";
        $response = $this->db->query($sql);
        if($response){
            return true;
        }
        return false;
    }
    
    public function insertSupplier(
        $combined_id, 
        $eBay_id, 
        $eBay_name, 
        $eBay_fee, 
        $paypal_fee,
        $su_link,
        $su_id,
        $su_name,
        $cost,
        $rrp,
        $erp,
        $estimate_profit,
        $note,
        $userid
    )
    {
        $sql = "insert into supplier(
        combined_id, 
        eBay_id,
        eBay_name,
        eBay_fee,
        paypal_fee,
        su_url,
        su_id,
        su_name,
        cost,
        rrp,
        erp,
        estimate_profit,
        note,
        eBay_ID_original,
        user_id
        ) 
        values(
        '$combined_id', 
        '$eBay_id', 
        '$eBay_name', 
        '$eBay_fee', 
        '$paypal_fee',
        '$su_link',
        '$su_id',
        '$su_name',
        '$cost',
        '$rrp',
        '$erp',
        '$estimate_profit',
        '$note',
        '$eBay_id',
        '$userid')";
        $this->db->query($sql);
        $result = $this->existCombinedID($combined_id, $userid);
        return $result;
    }
    
    public function update_RRP_status($userid, $combinedID, $status = 0)
    {
        $sql = "update supplier set rrp_status = '$status' where combined_id = '$combinedID' and user_id = '$userid'";
        $response = $this->db->query($sql);
        if($response){
            return true;
        }
        return false;
    }
    
    public function update_check_SU(
        $id, 
        $su_name,
        $cost,
        $rrp,
        $estimate_profit
    )
    {
        $sql = "update supplier set su_name = '$su_name' ";
        $sql .= ",cost = '$cost' ";
        $sql .= ",rrp = '$rrp' ";
        $sql .= ",estimate_profit = '$estimate_profit' ";
        $sql .= "where id = '$id'";
        $response = $this->db->query($sql);
        if($response){
            return true;
        }
        return false;
    }
}