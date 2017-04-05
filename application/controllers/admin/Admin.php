<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function manager(){
	    if($this->session->has_userdata('userInfo')){
			$data['title'] = "Manager | Drop Ship Planner";
            $data['template'] = "admin/manager";
	        $data['userInfo'] = $this->session->userdata('userInfo');
	        
	        $this->load->model("admin_management_model");
	        $data['adminInfo'] = $this->admin_management_model->getAllInfo();
	    	$this->load->view('master_view',$data);
		}
		else {
			redirect(base_url());
		}
	}
	
	public function display_user(){
	    if($this->session->has_userdata('userInfo')){
			$data['title'] = "Manager | Drop Ship Planner";
            $data['template'] = "admin/display_user";
            
            $this->load->model("admin_management_model");
            $data['listUser'] = $this->admin_management_model->getAllUserInfo();
	        $data['userInfo'] = $this->session->userdata('userInfo');
	    	$this->load->view('master_view',$data);
		}
		else {
			redirect(base_url());
		}
	}
	
	public function adminlogin($user_id)
	{
		//load model
		$this->load->model("user_model");
		
		$userData = $this->user_model->getUserDetailById($user_id);
		
		$email = $userData['user_email'];
		$pwd = $userData['user_password'];
		
		$logSuccess = $this->user_model->loginUser($email, $pwd);
		if($logSuccess){
			$userData = $this->user_model->getUserDetail($email);
			if(isset($userData)){
				$this->session->set_userdata('userInfo', $userData);
			}
			
			$data['userInfo'] = $this->session->userdata('userInfo');
			$data['title'] = "Profile | Drop Ship Planner";
        	$data['template'] = "client/profile";
    		$this->load->view('master_view', $data);
		}
		else {
			$this->session->set_flashdata('msg','Login failed!!!');
		}
	}
	
	public function lockaccount($user_id){
		if($user_id > 0)
		{
			$this->load->model("user_model");
			$lock_user = $this->user_model->change_status($user_id, 0);
			if($lock_user)
			{
				$this->session->set_flashdata('msg','Lock account successful!!!');
			}
			else
			{
				$this->session->set_flashdata('msg','Lock account unsuccessful!!!');
			}
		}
		
		redirect(base_url('admin-displayuser'));
	}
	
	public function unlockaccount($user_id){
		if($user_id > 0)
		{
			$this->load->model("user_model");
			$lock_user = $this->user_model->change_status($user_id, 1);
			if($lock_user)
			{
				$this->session->set_flashdata('msg','UnLock account successful!!!');
			}
			else
			{
				$this->session->set_flashdata('msg','UnLock account unsuccessful!!!');
			}
		}
		
		redirect(base_url('admin-displayuser'));
	}
	
	public function paidaccount($user_id){
		if($user_id > 0)
		{
			$this->load->model("user_model");
			$change_type = $this->user_model->change_type($user_id, 0);
			if($change_type)
			{
				$this->session->set_flashdata('msg','Account type is changed to Paid.');
			}
			else
			{
				$this->session->set_flashdata('msg','Change account type unsuccessful!!!');
			}
		}
		
		redirect(base_url('admin-displayuser'));
	}
	
	public function freeaccount($user_id){
		if($user_id > 0)
		{
			$this->load->model("user_model");
			$change_type = $this->user_model->change_type($user_id, 1);
			if($change_type)
			{
				$this->session->set_flashdata('msg','Account type is changed to Free.');
			}
			else
			{
				$this->session->set_flashdata('msg','Change account type unsuccessful!!!');
			}
		}
		
		redirect(base_url('admin-displayuser'));
	}
	
	public function update_manager(){
		
		$data = null;
		
		// load model
		$this->load->model("admin_management_model");
		
		if($this->input->post()){
			
			$pp = $this->input->post('pp');
			$ep1 = $this->input->post('ep1');
			$ep2 = $this->input->post('ep2');
			$f = $this->input->post('f');
			$fee = $this->input->post('fee');
			$advertisement_1 = $this->input->post('advertisement_1');
			$advertisement_2 = $this->input->post('advertisement_2');
			$advertisement_3 = $this->input->post('advertisement_3');
			
			$info['pp'] = $pp;
			$info['ep1'] = $ep1;
			$info['ep2'] = $ep2;
			$info['f'] = $f;
			$info['fee'] = $fee;
			$info['advertisement_1'] = $advertisement_1;
			$info['advertisement_2'] = $advertisement_2;
			$info['advertisement_3'] = $advertisement_3;
			
			$this->admin_management_model->updateAllInfo($info);
			
			$data['title'] = "Manager | Drop Ship Planner";
            $data['template'] = "admin/manager";
	        $data['userInfo'] = $this->session->userdata('userInfo');
	        $data['adminInfo'] = $this->admin_management_model->getAllInfo();
		
	        $data['msg'] = "Update successful!!!";
	        
	    	$this->load->view('master_view',$data);
		}
	}
	
	public function save_supplier(){
		if($this->session->has_userdata('userInfo')){
			
			$userInfo = $this->session->userdata('userInfo');
			
			// load model
			$this->load->model("supplier_model");
			$result = "";
			if($this->input->post()){
				$CombinedID = $this->input->post('CombinedID');
				$EBayID = $this->input->post('EBayID');
				$EBayName = $this->input->post('EBayName');
				$EBayFee = $this->input->post('EBayFee');
				$PaypalFee = $this->input->post('PaypalFee');
				$SULink = $this->input->post('SULink');
				$SUID = $this->input->post('SUID');
				$SUName = $this->input->post('SUName');
				$SUCost = $this->input->post('SUCost');
				$RRP = $this->input->post('RRP');
				$ERP = $this->input->post('ERP');
				$EstimateProfit = $this->input->post('EstimateProfit');
				$Note = $this->input->post('Note');
				
				$existCombinedID = $this->supplier_model->existCombinedID($CombinedID, $userInfo['user_id']);
				if ($existCombinedID)
				{
					if (!$this->supplier_model->updateSupplier($CombinedID,
	                 $EBayID,
	                 $EBayName,
	                 $EBayFee,
	                 $PaypalFee,
	                 $SULink,
	                 $SUID,
	                 $SUName,
	                 $SUCost,
	                 $RRP,
	                 $ERP,
	                 $EstimateProfit,
	                 $Note,
	                 $userInfo['user_id']))
	                 {
	                 	$result = "Update unsuccessful !";
	                 }
	                 else {
	                 	$result = "Update successful !";
	                 }
				}
				else
				{
					if (!$this->supplier_model->insertSupplier($CombinedID,
		                 $EBayID,
		                 $EBayName,
		                 $EBayFee,
		                 $PaypalFee,
		                 $SULink,
		                 $SUID,
		                 $SUName,
		                 $SUCost,
		                 $RRP,
		                 $ERP,
		                 $EstimateProfit,
		                 $Note,
		                 $userInfo['user_id']))
		                 {
		                 	$result = "Save unsuccessful !";
		                 }
		                 else {
		                 	$result = "Save successful !";
		                 }
				}
			}
			echo $result;
		}
	}
	
	public function fee_history_list(){
		$this->load->model("admin_management_model");
		$data['title'] = "Fee History | Drop Ship Planner";
		$data['template'] = "admin/fee_history";
		$data['userInfo'] = $this->session->userdata('userInfo');
		$data['history_list'] = $this->admin_management_model->getFeeHistory();
	    $this->load->view('master_view',$data);
	}
	
	public function computeFeeHistory(){
		$this->load->model("admin_management_model");
		$userList = $this->admin_management_model->getAllUserNonFree();
		$adminConfig = $this->admin_management_model->getAllInfo();
		$curMonth = date("m");
		$curYear = date("Y");
		$fee = $adminConfig['fee'];
		$result = true;
		foreach($userList as $userDetail){
			$date = new DateTime($userDetail['user_create_date']);
            $date = $date->format('Y-m-d');
            $date = strtotime($date);
            $month = date("m", $date);
            $year = date("Y", $date);
            if($month != $curMonth){
            	$exist = $this->admin_management_model->existFeeHistory($userDetail['user_id'], $curMonth, $curYear);
				if(!$exist){
					$tmpResult = $this->admin_management_model->insertFeeHistory($userDetail['user_id'], $curMonth, $curYear, $fee);
					if(!$tmpResult){
						$result = false;
					}
					else {
						// Send mail
						$body = "Dear ".$userDetail['user_name'].",<br>";
						$body .= "Your billing in this month is ready to pay for, please login to your Dropshipplanner account https://account.dropshipplanner.com/ <br>";
						$body .= "You should pay for the bill before [".($curMonth+1)."-".$curYear."] to continue using our service. <br>";
						$body .= "Regards, <br>";
						$this->sendMail($userDetail['user_email'], 'Billing From Dropshipplanner', $body);
					}
				}
            }
		}
		
		echo $result;
	}
	
	public function updateFeeHistory(){
		$this->load->model("admin_management_model");
		$user_id = $this->input->post('user_id');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$status = $this->input->post('status');
		$reuslt = false;
		$reuslt = $this->admin_management_model->updateFeeHistory($user_id, $month, $year, $status);
		echo $reuslt;
	}
	
	/*
	Note: $body contains HTML code
	*/
	public function sendMail($recipient, $title, $body){
		$this->load->library('My_PHPMailer');
		$mail = new PHPMailer();

		$mail->isSMTP();                                   // Set mailer to use SMTP
		$mail->Host = 'dropshipplanner.com';                    // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                            // Enable SMTP authentication
		$mail->Username = 'thang@dropshipplanner.com';          // SMTP username
		$mail->Password = '123456789'; // SMTP password
		$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                 // TCP port to connect to

		$mail->setFrom('thang@dropshipplanner.com', 'Dropshipplanner Team');
		$mail->addAddress($recipient);   // Add a recipient

		$mail->isHTML(true);  // Set email format to HTML

		$bodyContent = $body;
		$footer = "<h3 style='color:red;text-align: center;'>Dropshipplanner Team.<h3>";
		$mail->Subject = $title;
		$mail->Body    = $bodyContent.$footer;
		
		if(!$mail->send()) {
			// $msg_result = 'Message could not be sent. <br>';
			// $msg_result .= 'Mailer Error: ' . $mail->ErrorInfo;
			return false;
		} else {
			//$msg_result = 'Message has been sent';
			return true;
		}
		
	}
	
	public function auto_check_price(){
		// If the response was loaded, parse it and build links
		$this->load->model("user_model");
		$this->load->model("admin_management_model");
		$this->load->model("supplier_model");
		
		// Check time
		/*
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$currentDate = date("Y-m-d H:i:s");
		
		$checkInfo = $this->supplier_model->getCheckSupplier();
		
		if ($currentDate > $checkInfo['check_point'] &&
		$checkInfo['last_check'] < $checkInfo['check_point'])
		{
			$checkPoint = $checkInfo['check_point'];
			while ($currentDate > $checkPoint)
			{
				$date = strtotime($checkPoint." +".$checkInfo['check_range']." hours");
				$checkPoint = date("Y-m-d H:i:s", $date);
			}
			
			$this->supplier_model->updateCheckPoint($checkPoint);
			$this->supplier_model->updateLastCheck($currentDate);
		}
		else
		{
			return;
		}
		*/
		
		$totalSupplier = $this->supplier_model->getTotalSupplier();
		
		foreach($totalSupplier as $supplier)
		{
			$userid = $supplier['user_id'];
			$userData = $this->user_model->getUserDetailById($userid);
			$combinedid = $supplier['combined_id'];
	        $suid = $supplier['su_id'];
	        $ERP = $supplier['erp'];
	        
	        $appKey = "60796";
	        $field = "productId,productTitle,salePrice,lotNum";
	        
	        $url = "http://gw.api.alibaba.com/openapi/param2/2/portals.open/api.getPromotionProductDetail/".$appKey."?fields=".$field."&productId=".$suid;
	        
	        $apiUrl = 'http://gw.api.alibaba.com/openapi/param2/2/portals.open/api.getPromotionProductDetail/'.$appKey;
			$params = array();
			$params['fields'] = $field;
			$params['productId'] = $suid;
			
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $apiUrl);
	        curl_setopt($ch, CURLOPT_POST, 1);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
	        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(
	                $params));
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	
	        $responce = curl_exec($ch);
	        $content = json_decode($responce);
	        curl_close($ch);
	        
	        $total = count((array)$content);
	        if ($total > 1)
	        {
		        if ($this->user_model->existConfig($userid))
		        {
		        	$remainItem = $content->result->lotNum;
		    		if ($remainItem > 0)
		    		{
			    		$userConfig = $this->user_model->getUserConfig($userid);
				        $adminConfig = $this->admin_management_model->getAllInfo();
				        
				        $ep = 0;
				        $pp = 0;
				        $f = 0;
				        $M = 0;
				        $N = 0;
				        $a = 0;
				        if($userConfig['config_ep'] == "ep1"){
				        	$ep = $adminConfig['ep1'];
				        }
				        else {
				        	$ep = $adminConfig['ep2'];
				        }
				        $pp = $adminConfig['pp'];
				        $f = $adminConfig['f'];
				        $M = $userConfig['config_currency_unit_paypal_value'];
				        $N = $userConfig['config_currency_unit_su_value'];
				        $a = $userConfig['config_min_profit_per'];
			    		$suCost = substr($content->result->salePrice, 4);
			    		$RRP = round(($suCost*$N/$M+$f)/(1-$a/100-$ep-$pp), 2); //RRP = (Cost*N/M+F)/(1-a/100-ep–pp)
			    		
			    		if ($RRP > $ERP)
			    		{
			    			$recipient = $userData['user_email'];
				    		$body = "Hurry up! <br>";
				    		$body .=  "Our system detected a problem on [".$combinedid."] ID. Please login to your account to fix it now!!!<br>";
				    		$body .= "Your sincerely,<br>";
				    		$this->sendMail($recipient, "Alert!!! We found a problem on your account", $body);
			    		}
			    		
			    		$old_RRP = $supplier['rrp'];
			    		if ($RRP > $old_RRP)
			    		{
			    			$this->supplier_model->update_RRP_status($userid, $combinedid, 1);
			    		}
			    		
			    		if ($RRP < $old_RRP)
			    		{
			    			$this->supplier_model->update_RRP_status($userid, $combinedid, -1);
			    		}
			    		
			    		if ($RRP == $old_RRP)
			    		{
			    			$this->supplier_model->update_RRP_status($userid, $combinedid, 0);
			    		}
			    		
			    		$estProfit = $M*$ERP*(1-$ep-$pp)-$f*$M-$N*$suCost; //Estimate Profit = M*ERP*(1-ep–pp)-F*M–N*Cost
			    		
			    		$suName = $content->result->productTitle;
			    		if (!$this->supplier_model->update_check_SU($supplier['id'], $suName, $suCost, $RRP, $estProfit))
			                 {
			                 	//echo "Update unsuccessful !";
			                 }
			                 else {
			                 	//echo "Update successful !";
			                 }
		    		}
		    		else
		    		{
		    			//echo "Send mail to inform item is out of stock";
			    		$recipient = $userData['user_email'];
				    	$body = "Hurry up! <br>";
				    	$body .=  "Our system detected a problem on [".$combinedid."] ID. Please login to your account to fix it now!!! <br>";
				    	$body .= "Your sincerely, <br>";
				    	$this->sendMail($recipient, "Alert!!! We found a problem on your account", $body);
		    		}
		        }
		        else
		        {
		        	//echo "User has not config information !";
		        }
	        }
	        else
	        {
	        	//echo "Send mail to inform Aliexpress request error !";
	        	$recipient = $userData['user_email'];
				$body = "Hurry up! <br>";
				$body .= "Our system detected a problem on [".$combinedid."] ID. Please login to your account to fix it now!!! <br>";
				$body .= "Your sincerely, <br>";
				$this->sendMail($recipient, "Alert!!! We found a problem on your account", $body);
	        }
		}
	}
}
