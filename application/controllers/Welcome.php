<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function index()
	{
		$data['error'] = null;
		$this->load->view('common/login', $data);
		
		//$this->check();
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

		$mail->setFrom('thang@dropshipplanner.com', 'ThangTGM');
		$mail->addAddress($recipient);   // Add a recipient

		$mail->isHTML(true);  // Set email format to HTML

		$bodyContent = $body;
		$mail->Subject = $title;
		$mail->Body    = $bodyContent;

		if(!$mail->send()) {
			// $msg_result = 'Message could not be sent. <br>';
			// $msg_result .= 'Mailer Error: ' . $mail->ErrorInfo;
			return false;
		} else {
			//$msg_result = 'Message has been sent';
			return true;
		}
		
	}
	
	public function check(){
		
		$this->load->model("supplier_model");
		
		// Check time
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
		
		$totalSupplier = $this->supplier_model->getTotalSupplier();
		
		foreach($totalSupplier as $supplier)
		{
			$userid = $supplier['user_id'];
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
	        	// If the response was loaded, parse it and build links
		        $this->load->model("user_model");
		        $this->load->model("admin_management_model");
		        
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
			    			//echo "Send mail to inform RRP > ERP";
			    			$title = "CombinedID ".$combinedid." has RRP > ERP";
			    			$recipient = $userConfig['config_announce_email'];
			    			$body = "CombinedID ".$combinedid." has RRP > ERP.";
			    			$this->sendMail($recipient, $title, $body);
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
		    			$title = "CombinedID ".$combinedid." - Item is out of stock";
			    		$recipient = $userConfig['config_announce_email'];
			    		$body =  "CombinedID ".$combinedid." - Item is out of stock.";
			    		$this->sendMail($recipient, $title, $body);
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
	        	$title = "CombinedID ".$combinedid." - AliExpress request error";
			    $recipient = $userConfig['config_announce_email'];
			    $body =  "CombinedID ".$combinedid." - AliExpress request error.";
			    $this->sendMail($recipient, $title, $body);
	        }
		}
	}
}
