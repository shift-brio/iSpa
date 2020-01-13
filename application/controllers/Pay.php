<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pay extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('user_agent');
		$this->load->helper('url_helper'); 
		$this->load->library("common");   
		$this->load->library("wallet");
		$this->load->database("commonDatabase");     
	}
	public function subscribe(){
		if (isset($_SESSION["user"]) && isset($_SESSION["business"]) && isset($_POST['sub']) && in_array($_POST["sub"], $this->config->item("subs"))) {
			$sub = $_POST["sub"];
			$bus = $_SESSION["business"];
			/*$bus = common::getBus($_SESSION["business"])*/
			$amnt = 0;
			for ($i=0; $i < sizeof($this->config->item("subs")); $i++) { 
				$s = $this->config->item("subs")[$i];
				if ($s == $sub) {
					$amnt = $this->config->item("subs_amounts")[$i];
					$type = $i;
				}
			}
			$wallet = wallet::balance($bus);
			if ($wallet->balance >= $amnt) {
				$s = wallet::subscribe($bus,$sub,$amnt,$type);				
				if ($s) {
					if (isset($s->status)) {
						$r["status"] = false;
						$r["m"] = $s->m;
					}else{
						$r["status"] = true;
						$r["m"] = "Subscription successful";
					}
				}else{
					$r["status"] = false;
					$r["m"] = $s->m;
				}
			}else{
				$r['status'] = false;
				$r['m'] = "You do not have enough fund in your account to complete this transaction.";
			}
		}else{
			$r['status'] = false;
			$r['m'] = "Invalid access.";
		}
		common::emitData($r);
	}  
	public function savePayment(){                     
      if(common::isPOST($_SERVER['REQUEST_METHOD'])){
        if (!isset($_POST['account_number'])) {
            $_POST['account_number'] = "";
        }
        foreach ($this->keys('fields') as $field) {
           if (!isset($_POST[$field])) {
               $r['status'] = '03';
               $r['description'] = "Unauthorized access";
               $r["subscriber_message"] =  false;            
               $this->emitData($r);
               exit();
           }
        }
        $signature = $_POST['signature'];
        $symentricKey = $this->keys('accessKey');         
        $base_string = "";
        $fields = $this->keys('fields');
        for ($i=0; $i < (sizeof($this->keys('fields')) - 1); $i++) { 
           if ($i === (sizeof($this->keys('fields'))) - 2) {
              $base_string .= $fields[$i]."=".$_POST[$fields[$i]];
           }else{
              $base_string .= $fields[$i]."=".$_POST[$fields[$i]]."&";
           }
        } 
        $sig  =  base64_encode(hash_hmac('sha1', $base_string, $symentricKey));
        //var_dump($sig ."<br>".$_POST['signature']);        
        $mpesa_code = $_POST['transaction_reference'];
        $payment = $this->commonDatabase->get_data('ispa_mpesa_data',1,false,'transaction_reference',$mpesa_code);
        if (!$payment) {
           $data['referer'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "not-set";
           for ($i=0; $i < (sizeof($fields) - 1); $i++) { 
              if ($i != (sizeof($fields) - 2)) {
                  $data[$fields[$i]]  = $_POST[$fields[$i]];
              }
           }
           $this->commonDatabase->add('ispa_mpesa_data',$data);
           $r['status'] = '01';
           $r['description'] = "Accepted";   
           $r["subscriber_message"] =  "Payment successful";
           //$this->deposit($mpesa_code);
        }else{
         $r['status'] = '03';
         $r['description'] = "Declined";   
         $r["subscriber_message"] =  "Duplicate payment code";         
        }
      }else{
         $r['status'] = '03';
         $r['description'] = "Unauthorized access";
         $r["subscriber_message"] =  false; 
      }
      $this->emitData($r);
   }  
   public function top_up(){
      if (isset($_SESSION['user']) && isset($_POST['code'])) {
         $code = $_POST['code'];
         $c = $this->commonDatabase->get_data("ispa_mpesa_data",1,false,'transaction_reference',$code);
         if ($c && $c[0]["status"] == 0) {
            if (isset($_SESSION["business"])) {
            	$ac = $_SESSION["business"];
            }else{
            	$ac = $_SESSION["user"]->ispa_id;
            }
            if ($ac) {
              $x = wallet::deposit($code,$ac);
              if ($x) {
                $r['status'] = true;
                $r['m'] = 'Success';
                $r['amount']  = $x['amount'];
                $r['balance'] = $x['balance'];
              }else{
                $r['status'] = $x['status'];
                $r['m'] = $x['m'];
              }
            }else{
              $r['status'] = false;
              $r['m'] = "An error occurred";
            }
         }else{
         	if (!$c) {
         		$r['status'] = false;
            $r['m'] = "Transaction code not found.";
         	}else{
            $r['status'] = false;
            $r['m'] = "Transaction code has already been used.";
         	}
        }
      }else{
         $r['status'] = false;
         $r['m'] = "Invalid access";
      }
      common::emitData($r);
   }   
   protected function keys($val){
      $ref        = '544974994';
      $accessKey  = 'a06fd40926114dc12146fc7170e3997f6acaff6e';
      $username   = 'spendtrack-payment';
      $postFields = ["service_name", "business_number", "transaction_reference", "internal_transaction_id", "transaction_timestamp" , "transaction_type" ,"account_number" ,"sender_phone" , "first_name" , "middle_name" , "last_name" , "amount" ,"currency" , "signature"];

      if ($val == 'accessKey') {
         return $accessKey;
      }elseif($val == 'username'){
         return $username;
      }elseif($val == 'fields'){
         return $postFields;
      }elseif($val == 'reference'){
         return $ref;
      }else{
         return false;
      }
   }        
}