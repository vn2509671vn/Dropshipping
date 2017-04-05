<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ebay extends CI_Controller {

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
	      //load validation library
        $this->load->library('form_validation');
        $this->form_validation->set_rules('search_entered','keywords','required');
        
        //run and check the validations
        if($this->form_validation->run())
        {
            //Input success
            $search = $this->input->post('search_entered');
            $posOne     = strrpos($search, '/') + 1;
            $resultPosOne = substr($search, $posOne);
            $posTwo = strrpos($resultPosOne, '?');
            $resultPosTwo = substr($resultPosOne, 0, $posTwo);
            $id      = $resultPosTwo;
            
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
              $results = '';
              // If the response was loaded, parse it and build links
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
                $results .= "<tr>
                                <td><img src=\"$pic\"></td>
                                <td><a href=\"$link\">$title</a></td>
                                <td>Price: $$price</td>
                                <td>Shipping Cost: $$shippingprice</td>
                                <td>Total Cost: $$totalprice</td>
                            </tr>";
              }
            }
            // If the response does not indicate 'Success,' print an error
            else {
              $results  = "<h3>The request was not successful.</h3>" .$search;
            }
            
            $data['title'] = 'Search result';
            $data['arrHTML'] = $results;
            $this->load->view('client/search_result',$data);
        }
        else
        {
            $data['title'] = "Test Ebay";
            $data['template'] = "client/test_ebay";
            $this->load->view('master_view',$data);
        }
	}
}
