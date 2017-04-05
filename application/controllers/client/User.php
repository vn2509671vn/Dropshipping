<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
	
	public function login(){
		//load model
		$this->load->model("user_model");
		
		$email = $this->input->post('email');
		$pwd = $this->input->post('password');
		
		$logSuccess = $this->user_model->loginUser($email, $pwd);
		if($logSuccess){
			$userData = $this->user_model->getUserDetail($email);
			if(isset($userData)){
				$this->session->set_userdata('userInfo', $userData);
			}
			
			$totalFee = $this->user_model->totalFeeByUser($userData['user_id']);
			if($totalFee['totalFee'] != ""){
				$data['totalFee'] = $totalFee['totalFee'];
			}
			
			$data['userInfo'] = $this->session->userdata('userInfo');
			$data['title'] = "Profile | Drop Ship Planner";
        	$data['template'] = "client/profile";
    		$this->load->view('master_view', $data);
		}
		else {
			$data['error'] = "Login failed!!!";
			$this->load->view('common/login', $data);
		}
	}
	
	public function logout(){
		$this->session->unset_userdata('userInfo');
		redirect(base_url());
	}
	
	public function register()
	{
		// create message
		$data = null;
		
		// load model
		$this->load->model("user_model");
		
		// load validation library
		$this->load->library('My_PHPMailer');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fullname','Full name','trim|required');
        $this->form_validation->set_rules('phonenumber','Phone number','numeric|max_length[11]|min_length[10]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_emails');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('confirm_password', 'Password', 'trim|required');
        
	    if($this->form_validation->run() == true){
			$fullname = $this->input->post('fullname');
			$phonenumber = $this->input->post('phonenumber');
			$birthday = $this->input->post('birthday');
			$gender = $this->input->post('gender');
			$address = $this->input->post('address');
			$country = $this->input->post('country');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$confirm_password = $this->input->post('confirm_password');
			$status = 1;
			
			if($password == $confirm_password){
				$success = $this->user_model->registerUser($fullname, $phonenumber, $birthday, $gender, $address, $country, $email, $password, $status);
				if($success){
					$data['msg'] = "Register successful!!!";
					
					// Send mail
					$body = "Dear ".$fullname.",<br>";
					$body .= "Thanks for creating a Dropshipplanner account. <br>";
					$body .= "To continue, please login to your account by clicking this link https://account.dropshipplanner.com/ <br>";
					$body .= "You have 5 days trial to use our service. <br>";
					$body .= "Hope that you will succeed! <br>";
					$body .= "Regards, <br>";
					$this->sendMail($email, 'Welcome to Dropshipplanner', $body);
				}
				else {
					$data['msg'] = "Email is exist!!!";
				}
			}
			else {
				$data['msg'] = "Passwords do not match.";
			}
	    }
	    $this->load->view("common/register", $data);
	}
	
	public function profile(){
		if($this->session->has_userdata('userInfo')){
			// load model
			$this->load->model("user_model");
			$userData = $this->session->userdata('userInfo');
			$totalFee = $this->user_model->totalFeeByUser($userData['user_id']);
			if($totalFee['totalFee'] != ""){
				$data['totalFee'] = $totalFee['totalFee'];
			}
			$data['title'] = "Profile | Drop Ship Planner";
	        $data['template'] = "client/profile";
	        $data['userInfo'] = $this->session->userdata('userInfo');
	    	$this->load->view('master_view',$data);
		}
		else {
			redirect(base_url());
		}
	}
	
	public function supplier(){
		if($this->session->has_userdata('userInfo')){	        
	        $this->load->model("supplier_model");
	        $this->load->model("user_model");
	        $userInfo = $this->session->userdata('userInfo');
	        $existConfig = $this->user_model->existConfig($userInfo['user_id']);
			if(!$existConfig){
				redirect(base_url(configuration));
			}
			
			$userConfig = $this->user_model->getUserConfig($userInfo['user_id']);
			$data['title'] = "Supplier | Drop Ship Planner";
	        $data['template'] = "client/supplier";
	        $data['userInfo'] = $this->session->userdata('userInfo');
	        $data['supplierInfo'] = $this->supplier_model->getAllSupplier($userInfo['user_id']);
	        $data['curUnit_3'] = $userConfig['config_currency_unit_paypal_su'];
	        
	    	$this->load->view('master_view',$data);
		}
		else {
			redirect(base_url());
		}
	}
	
	public function configuration(){
		if($this->session->has_userdata('userInfo')){
			//Load model
			$this->load->model("user_model");
			$userInfo = $this->session->userdata('userInfo');
			
			$data['title'] = "General Configuration | Drop Ship Planner";
			$data['template'] = "client/configuration";
			$data['userInfo'] = $this->session->userdata('userInfo');
			$data['userConfig'] = $this->user_model->getUserConfig($userInfo['user_id']);
	    	$this->load->view('master_view',$data);
		}
		else {
			redirect(base_url());
		}
	}
	
	public function changeConfig(){
		// create message
		$data = null;
		
		// load model
		$this->load->model("user_model");
		
		if($this->input->post()){
			if($this->session->has_userdata('userInfo')){
				$userInfo = $this->session->userdata('userInfo');
			}
			else {
				redirect(base_url());
			}
			
			$config_user = $userInfo['user_id'];
			$epOption = $this->input->post('epOption');
			$paypalUnit = $this->input->post('paypalUnit');
			$mValue = $this->input->post('mValue');
			$mUnit = $this->input->post('mUnit');
			$suUnit = $this->input->post('suUnit');
			$nValue = $this->input->post('nValue');
			$min_profit_per = $this->input->post('min_profit_per');
			$announce_email = $this->input->post('announce_email');
			
			$existConfig = $this->user_model->existConfig($config_user);
			if($existConfig){
				$result = $this->user_model->updateConfig($config_user, $epOption, $paypalUnit, $suUnit, $mUnit, $mValue, $nValue, $min_profit_per, $announce_email);
			}
			else {
				$result = $this->user_model->insertConfig($config_user, $epOption, $paypalUnit, $suUnit, $mUnit, $mValue, $nValue, $min_profit_per, $announce_email);
			}
			
			$data['title'] = "General Configuration | Drop Ship Planner";
			$data['template'] = "client/configuration";
	        $data['userInfo'] = $this->session->userdata('userInfo');
	        $data['userConfig'] = $this->user_model->getUserConfig($userInfo['user_id']);
	        if($result){
	        	$data['msg'] = "Update configuration successful!!!";
	        }
	        else {
	        	$data['msg'] = "Update configuration unsuccessful!!!";
	        }
	        
	    	$this->load->view('master_view',$data);
		}
	}
	
	public function changeInfo(){
		// create message
		$data = null;
		
		// load model
		$this->load->model("user_model");
		
		if($this->input->post()){
			if($this->session->has_userdata('userInfo')){
				$userInfo = $this->session->userdata('userInfo');
			}
			else {
				redirect(base_url());
			}
			
			$fullname = $this->input->post('fullname');
			$phonenumber = $this->input->post('phonenumber');
			$birthday = $this->input->post('birthday');
			$gender = $this->input->post('gender');
			$address = $this->input->post('address');
			$country = $this->input->post('country');
			
			$this->user_model->changeInfo($fullname, $phonenumber, $birthday, $gender, $address, $country, $userInfo['user_email']);
			$userData = $this->user_model->getUserDetail($userInfo['user_email']);
			if(isset($userData)){
				$this->session->set_userdata('userInfo', $userData);
			}
			
			$data['title'] = "Profile | Drop Ship Planner";
	        $data['template'] = "client/profile";
	        $data['userInfo'] = $this->session->userdata('userInfo');
	        $data['msg'] = "Update information successful!!!";
	        
	    	$this->load->view('master_view',$data);
		}
	}
	
	public function changePass(){
		$result = false;
		
		// load model
		$this->load->model("user_model");
		
		if($this->input->post()){
			if($this->session->has_userdata('userInfo')){
				$userInfo = $this->session->userdata('userInfo');
			}
			else {
				redirect(base_url());
			}
			
			$old_pwd = $this->input->post('old_pwd');
			$new_pwd = $this->input->post('new_pwd');
			if($old_pwd == $userInfo['user_password']){
				$result = $this->user_model->changePass($new_pwd, $userInfo['user_email']);
			}
		}
		
		if($result){
			echo "Update password successful!!!";
		}
		else {
			echo "Old password is wrong!!!";
		}
	}
	
	public function changeResetPass(){
		$result = false;
		
		// load model
		$this->load->model("user_model");
		
		if($this->input->post()){
			$email = $this->input->post('email');
			$pwd = $this->input->post('password');
			$result = $this->user_model->changePass($pwd, $email);
		}
		
		if($result){
        	$data['error'] = "Change password successful!!!";
        	$data['email'] = $email;
    		$this->load->view('common/reset', $data);
		}
		else {
			$data['error'] = "Change password unsuccessful!!!";
			$data['email'] = $email;
			$this->load->view('common/reset', $data);
		}
	}
	
	public function forgotPassword($email){
		$isSuccess = false;
		//load model
		$this->load->model("user_model");
		$decoded_mail = base64_decode($email);
		$userDetail = $this->user_model->getUserDetail($decoded_mail);
		
		if($userDetail){
			$encoded_mail = $email;
			$userName = $userDetail['user_name'];
			$bodyMail = "Dear " . $userName . ",<br>";
			$bodyMail .= "We have received a request to change password from you. You can click to this link to change your password. <br>";
			$bodyMail .= "<a href='https://account.dropshipplanner.com/reset-pwd/".$encoded_mail."'>Click here to change password.</a> <br>";
			$bodyMail .= "Regards, <br>";
			$isSuccess = $this->sendMail($decoded_mail, 'Password Reset', $bodyMail);
		}
		
		$data['success'] = $isSuccess;
		$this->load->view('common/login', $data);
	}
	
	public function resetPass($email){
		$decoded_mail = base64_decode($email);
		$data['email'] = $decoded_mail;
		$this->load->view('common/reset', $data);
	}
	
	function getItemForEbay(){
		$ebayURL = $_POST["ebayURL"];
		$suCost = $_POST["SUCost"];
		//Input success
        // $search = $ebayURL;
        // $posOne     = strrpos($search, '/') + 1;
        // $resultPosOne = substr($search, $posOne);
        // $posTwo = strrpos($resultPosOne, '?');
        // $resultPosTwo = substr($resultPosOne, 0, $posTwo);
        $id      = $ebayURL;
            
        // API request variables
        $endpoint = 'http://svcs.ebay.com/services/search/FindingService/v1';  // URL to call
        $version = '1.0.0';  // API version supported by your application
        $appid = 'TranThan-Dropship-PRD-545f6444c-dad0f4ac';  // Replace with your own AppID
        $globalid = 'EBAY-US';  // Global ID of the eBay site you want to search (e.g., EBAY-DE)
        $query = "$id";  // You may want to supply your own query
        $safequery = urlencode($query);  // Make the query URL-friendly
            
        // Construct the findItemsByKeywords HTTP GET call
        $apicall = "$endpoint?";
        $apicall .= "OPERATION-NAME=findItemsByKeywords";
        $apicall .= "&SERVICE-VERSION=$version";
        $apicall .= "&SECURITY-APPNAME=$appid";
        $apicall .= "&GLOBAL-ID=$globalid";
        $apicall .= "&keywords=$safequery";
        $apicall .= "&paginationInput.entriesPerPage=10";
            
            
        // Load the call and capture the document returned by eBay API
        $resp = simplexml_load_file($apicall);
            
        // Check to see if the request was successful, else print an error
        if ($resp->ack == "Success") {
	        $results = array();
	        // If the response was loaded, parse it and build links
	        $this->load->model("user_model");
	        $this->load->model("admin_management_model");
			$userInfo = $this->session->userdata('userInfo');
			$userConfig = $this->user_model->getUserConfig($userInfo['user_id']);
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
	        
	        foreach($resp->searchResult->item as $item) {
	            $pic   = $item->galleryURL;
	            $link  = $item->viewItemURL;
	            $title = $item->title;
	            $price=  $item->sellingStatus->currentPrice;
	            $shippingprice= $item->shippingInfo->shippingServiceCost;
	            
	            $price= (float)$price;
	                
	            $shippingprice= (float)$shippingprice;
	                
	            $shippingprice= number_format($shippingprice, 2);
	                
	            $totalprice= $price +$shippingprice;
	                
	            $totalprice= (float)$totalprice;
	                
	            $totalprice= number_format($totalprice, 2);
	            
	            
	            // For each SearchResultItem node, build a link and append it to $results
	        	$results["id"] = $id;
	            $results["name"] = $title;
	            $results["ebayPrice"] = $price;
	            $results["ebayFee"] = $price*$ep;
	            $results["paypalFee"] = $price*$pp + $f;
	            $results["estProfit"] = $M*$price*(1-$ep-$pp)-$f*$M-$N*$suCost; //Estimate Profit = M*ERP*(1-ep–pp)-F*M–N*Cost
	            
	            break;
	        }
        }
        header('Content-Type: application/json');
    	echo json_encode($results); // return value of $result
	}
	
	function getItemForAliExpress(){
		
		$SUurl = $_POST["SUurl"];
		$ERP = $_POST["ERP"];
		//Input success
        $search = $SUurl;
        $posOne     = strrpos($search, '/') + 1;
        $resultPosOne = substr($search, $posOne);
        $posTwo = strpos($resultPosOne, '.html');
        $resultPosTwo = substr($resultPosOne, 0, $posTwo);
        $id      = $resultPosTwo;
        
        $appKey = "60796";
        $field = "productId,productTitle,salePrice";
        
        $url = "http://gw.api.alibaba.com/openapi/param2/2/portals.open/api.getPromotionProductDetail/".$appKey."?fields=".$field."&productId=".$id;
        
        $apiUrl = 'http://gw.api.alibaba.com/openapi/param2/2/portals.open/api.getPromotionProductDetail/'.$appKey;
		$params = array();
		$params['fields'] = $field;
		$params['productId'] = $id;
		
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
			$userInfo = $this->session->userdata('userInfo');
			$userConfig = $this->user_model->getUserConfig($userInfo['user_id']);
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
    		$result["id"] = $id;
    		$result["name"] = $content->result->productTitle;
    		$price = $content->result->salePrice;
    		$result["price"] = substr($price, 4);
    		$suCost = $result["price"];
    		$result["RRP"] = round(($suCost*$N/$M+$f)/(1-$a/100-$ep-$pp), 2); //RRP = (Cost*N/M+F)/(1-a/100-ep–pp)
    		$result["estProfit"] = $M*$ERP*(1-$ep-$pp)-$f*$M-$N*$suCost; //Estimate Profit = M*ERP*(1-ep–pp)-F*M–N*Cost
        }
        else {
        	$result["id"] = $id;
    		$result["name"] = "";
    		$result["price"] = "";
    		$result["RRP"] = "";
    		$result["estProfit"] = "";
        }
        header('Content-Type: application/json');
    	echo json_encode($result); // return value of $result
    	
	}
}
