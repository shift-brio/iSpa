<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('user_agent');
		$this->load->helper('url_helper');
		$this->load->library('common'); 
		$this->load->library('wallet'); 
		$this->load->model("commonDatabase");   
	}
    public function onboard(){
    	$data["data"]["title"] = "Welcome to iSpa";
    	$this->load->view("templates/base_header",json_decode(json_encode($data)));
    	$this->load->view("onboarding");
    }
	public function index(){
		//common::update_user_session("e28e4aa330278e84680778081028e3bb");		
		unset($_SESSION["business"]);
		unset($_SESSION["business_name"]);	
		if (isset($_SESSION["user"])) {
			common::update_user_session($_SESSION["user"]->ispa_id);	
			$data['title'] = "iSpa";						
			$data['page'] = "home";		
			$data['data'] = json_decode(json_encode($data));	
			$this->load->view("templates/base_header",$data);
			$this->load->view("home",$data);
		}else{
			$data['title'] = "iSpa - Log in";
			$data['data'] = json_decode(json_encode($data));	
			$this->load->view("templates/base_header",$data);
			$this->load->view("login",$data);
		}
	}	
	public function h_cypher($k = "", $decode = false){
		if ($k != "") {
			$k = strtolower($k);
			$str = "";
			if ($decode) {
				$str_arr = [];
				$x = mb_split("", $k);
				for ($i=0; $i < sizeof($x); $i++) { 
					$str .= common::h_cypher_decode($k);
				}
			}else{
				$str_arr = [];
				$x = mb_split("", $k);
				for ($i=0; $i < sizeof($x); $i++) { 
					$str .= common::h_cypher_encode($k);
				}
			}
		}
		$k = $str;
		echo  common::h_cypher_encode($k);;
	}
	public function menu_item(){
		if (isset($_POST["item"]) && isset($_POST['type'])) {
			if ($_POST['type'] == "client" && in_array($_POST["item"], $this->config->item("client_tabs"))) {
				$r['status'] = true;
				$r['m'] = $this->load->view("components/ispa_menu_".$_POST["item"],$data = "",true);
			}elseif($_POST['type'] == "business" && in_array($_POST["item"], $this->config->item("business_tabs")) && isset($_SESSION["business"])){
				$r['status'] = true;
				if (wallet::status($_SESSION["business"])->sub || !wallet::status($_SESSION["business"])->sub) {
					if ($_POST["item"] == "appointments") {
					$r['m'] = $this->load->view("business/ispa_".$_POST["item"],$data = "",true);
					}else{
						$r['m'] = $this->load->view("components/ispa_".$_POST["item"],$data = "",true);
					}
				}else{
					$r['m'] = $this->load->view("components/ispa_wallet",$data = "",true);
				}
			}else{
				$r['status'] = false;
				$r['m'] = "Invalid access.";
			}	
		}else{
			$r['status'] = false;
			$r['m'] = "Invalid access.";
		}
		common::emitData($r);
	}
	public function add_help(){		
		if (common::isAdmin($_SESSION["user"]->ispa_id) && isset($_POST["edit"]) && isset($_POST["topic"]) && isset($_POST["content"])) {
			$edit = $_POST["edit"];
			$topic = $_POST["topic"];
			$content = $_POST["content"];

			$data = [
				"topic" => $topic,
				"content" => $content,								
			];
			if ($edit == "false" || $edit == false) {
				$data["added_by"] = $_SESSION["user"]->ispa_id;
				$data["date_added"] = time();
				$this->commonDatabase->add("ispa_help",$data);
				$r['status'] = true;
				$r['m'] = "added";
			}else{
				$get_item = $this->commonDatabase->get_data("ispa_help",1,false,"id",$edit,"visible",1);
				if ($get_item) {
					$this->commonDatabase->update("ispa_help",$data,"id",$edit);
					$r['status'] = true;
					$r['m'] = "udated.";
				}else{
					$r['status'] = false;
					$r['m'] = "Help item not found.";
				}
			}
		}else{
			$r['status'] = false;
			$r['m'] = "Invalid access.";
		}
		common::emitData($r);
	}
	public function del_help(){
		if (common::isAdmin($_SESSION["user"]->ispa_id) && isset($_POST["item"])) {
			$get_item = $this->commonDatabase->get_data("ispa_help",1,false,"id",$_POST["item"],"visible",1);
			if ($get_item) {
				$data = ["visible" => 0];
				$this->commonDatabase->update("ispa_help",$data,"id",$_POST["item"]);
				$r['status'] = true;
				$r['m'] = "Deleted";
			}else{
				$r['status'] = false;
				$r['m'] = "Item not found";
			}
		}else{
			$r['status'] = false;
			$r['m'] = "Invalid access.";
		}
		common::emitData($r);
	}
	public function search_help(){
		if (isset($_POST["key"])) {
			$key = $_POST["key"];
			$items = $this->commonDatabase->get_cond("ispa_help","visible='1' AND (topic like '%$key%' or content like '%$key%') order by id DESC");
			if ($items) {
				$r['m'] = '';
				$r['status'] = true;
				foreach ($items as $item) {
					$r['m'] .= common::renderHelp($item);
				}
			}else{
				$r['status'] = true;
				$r['m'] = '<div class="flow-text">No topics match key word.</div>';
			}
		}else{
			$r['status'] = false;
			$r['m'] = "Invalid access.";
		}
		common::emitData($r);
	}
	public function read_notif(){
		if (isset($_SESSION["user"]) && isset($_POST["item"])) {
			if (isset($_SESSION["business"])) {
				$user = $_SESSION["business"];
			}else{
				$user = $_SESSION["user"]->ispa_id;
			}
			$ch_item = $this->commonDatabase->get_data("ispa_notifications",1,false,"id",$_POST["item"],"user",$user);
			if ($ch_item) {
				$data = ["status"=>1];
				$this->commonDatabase->update("ispa_notifications",$data,"id",$_POST["item"]);

				$ch_items = $this->commonDatabase->get_data("ispa_notifications",1,false,"status",0,"user",$user);

				$r["status"] = true;
				$r["m"] = [
					"pending" => $ch_items ? true: false,
					"item" => [
						"title" => $ch_item[0]["title"],
						"date" => date("d-m-Y", $ch_item[0]["date_added"]),
						"content" => $ch_item[0]["content"]
					]
				];

			}else{
				$r['status'] = false;
				$r['m'] = "Notification could not be found.";
			}
		}else{
			$r['status'] = false;
			$r['m'] = "Invalid access.";
		}
		common::emitData($r);
	}
	public function get_chat(){
		if (isset($_SESSION["user"]) && isset($_POST["item"])) {
			if (isset($_SESSION["business"])) {
				$user = $_SESSION["business"];
			}else{
				$user = $_SESSION["user"]->ispa_id;
			}
			$item = $_POST['item'];
			$messages = $this->commonDatabase->get_cond("ispa_messages","(sender='$user' AND receiver='$item') or (sender='$item' AND receiver='$user') order by id ASC");

			$up_data  = [
				"status" => 1
			];
			$this->commonDatabase->update("ispa_messages",$up_data,"sender",$item,"receiver",$user);
			$sender = "";
			$name = "";
			$prof = "";
			$u = false;
			if ($item != "ispa") {
				$u = false;
				$bus = false;
				$bus = common::getBus($user);
				if (!$bus) {						
					$bus = common::getBus($item);
				}
				if ($bus) {						
					$name = $bus["name"];
					$prof = base_url("uploads/profiles/".$bus["profile"]);
				}	
				$u = $this->commonDatabase->get_cond("ispa_users","ispa_id='$user' or ispa_id='$item'");
				if (isset($_SESSION["business"])) {					 										
					if ($u) {
						$name = $u[0]["name"];
						$prof = base_url("uploads/profiles/".$u[0]["profile"]);
					}									
				}		
			}else{
				$name = "iSpa Support";					
			}
			$r["name"] = $name;
			$r['status'] = true;
			$r['m'] = "";
			if ($messages && $u) {
				foreach ($messages as $message) {
					if (isset($_SESSION["business"])) {
						$r['m'] .= common::renderMessage($message,$u);
					}else{
						$r['m'] .= common::renderMessage($message,$bus);
					}
				}
			}
			if ($r['m'] === "") {
				  $r['m'] = '<div class="flow-text center">No messages yet</div>';
			}
		}else{
			$r['status'] = false;
			$r['m'] = "Invalid access.";
		}
		common::emitData($r);
	}
	public function send_chat(){
		if (isset($_SESSION["user"]) && isset($_POST['to']) && isset($_POST["message"])) {
			if (isset($_SESSION["business"])) {
				$user = $_SESSION["business"];
			}else{
				$user = $_SESSION["user"]->ispa_id;
			}

			$data = [
				"sender" => $user,
				"receiver" => $_POST["to"],
				"message" => $_POST["message"],
				"date_added" => time()
			];
			$this->commonDatabase->add("ispa_messages",$data);
			$item = $_POST["to"];
			$messages = $this->commonDatabase->get_cond("ispa_messages","(sender='$user' AND receiver='$item') or (sender='$item' AND receiver='$user') order by id ASC");

			if ($messages) {
				$up_data  = [
					"status" => 1
				];
				$this->commonDatabase->update("ispa_messages",$up_data,"sender",$item,"receiver",$user);
				$sender = "";
				if ($item != "ispa") {
					$sender = $this->commonDatabase->get_data("ispa_business",1,false,"identifier",$item);
					if ($sender) {
						$sn = $sender[0];
						$sender = $sender[0]["name"];
						$prof = base_url("uploads/profiles/".$sn["profile"]);
					}
				}else{
					$sender = "iSpa Support";					
				}
				$r["name"] = $sender;
				$r['status'] = true;
				$r['m'] = "";
				foreach ($messages as $message) {
					$r['m'] .= common::renderMessage($message,$user);
				}
			}else{
				$r['status'] = false;
				$r['m'] = "No messages yet.";
			}
		}else{
			$r['status'] = false;
			$r['m'] = "Invalid access.";
		}
		common::emitData($r);
	}	
	public function submit_appointment(){
		if (isset($_POST["shop"]) && isset($_SESSION["user"]) && isset($_POST["note"]) && isset($_POST["services"]) && is_array($_POST["services"]) && isset($_POST["services"]["items"]) && isset($_POST["staff"]) && isset($_POST["time"]) && common::getBus($_POST["shop"])) {
			
			$shop = $_POST["shop"];
			$note = $_POST["note"];
			$services = $_POST["services"];
			$location = "shop";
			$service_items = isset($_POST["services"]["items"]) && is_array($_POST["services"]["items"]) ? $_POST["services"]["items"] : false;
			$staff = $_POST["staff"];
			$payment = $_POST['payment'];

			
			$time = common::dateString($_POST["time"]);
			$editing = false;
			if (isset($_POST["editing"]) && ($_POST["editing"] == true || $_POST["editing"] == "true") && isset($_POST["edited"])) {
				$editing = $_POST["edited"];				
			}
			if (sizeof($time) == 9) {
				$start_time = $time[4]." ".$time[5];
				$end_time = $time[7]." ".$time[8];
				$app_day  = $time[0]." ".$time[1]." ".$time[2]." ".$start_time;
				$dur = 0;
				$amnt = 0;
				$all_services_available = true;
				$serv_data = [];

				$ap_identifier = md5(sha1($staff.$app_day.$shop.$note).time());
				if ($editing) {
					$ap_identifier = $editing;
				}
				foreach ($service_items as $item) {					
					$service = $this->commonDatabase->get_data("ispa_services",1,false,"id",$item["id"],"added_by",$shop, "status", 1,"avail", 1);
					if (!$service) {
						$all_services_available = false;
					}else{
						$dur  +=  $service[0]["duration"] * 60;
						$amnt += $service[0]["cost"];
						array_push($serv_data, ["service_id" => $item["id"],"appointment_id" => $ap_identifier]);
					}
				}
				$slot = common::checkSlot($app_day,$dur,$staff,$shop,$editing);
				if ($slot) {
					$user = $_SESSION["user"]->ispa_id;					
					if ($all_services_available) {
						$wallet = wallet::balance($user);
						if ($wallet->balance >= $amnt) {
							$avail = true;
						}else{
							if ($payment == "cash") {
								$avail = true;
							}else{
								$avail = false;
							}
						}
						if ($avail) {							
							if (wallet::chargeApp($user,$amnt,$ap_identifier,$shop,$editing) || $payment =="cash") {
								if (!$editing) {
									$sett = $this->commonDatabase->get_data("ispa_bus_prefs",1,false,"business",$shop);
									$confirmed = 0;
									if ($sett && $sett[0]["app_con"] == 1) {
										$confirmed = 1;
									}
									$ap_data = [
										"user" => $user,
										"staff_id" => $staff,
										"shop" => $shop,
										"identifier" => $ap_identifier,
										"app_time" => strtotime($app_day),
										"date_added" => time(),
										"payment_status" => 0,
										"payment_method" => $payment,
										"place" => $location,
										"status" => 0,
										"confirmed" => $confirmed
									];
									if ($payment == "cash" && $sett[0]["app_cash"] == 0) {
										$r['status'] = false;
										$r["m"] = "This shop does not allow cash payment.";
									}else{
										$this->commonDatabase->add("ispa_appointments",$ap_data);
										$r['status'] = true;
										$r["m"] = "Appointment made.";
										/*handle notifiations*/
										foreach ($serv_data as $sd) {
											$this->commonDatabase->add("ispa_appointment_services",$sd);
										}
									}									
								}else{
									$ch_ap = $this->commonDatabase->get_data("ispa_appointments",1,false,"identifier",$editing,"status",0,"confirmed",0);
									if ($ch_ap) {
										$ap_data = [										
											"staff_id" => $staff,										
											"app_time" => strtotime($app_day),
											"date_added" => time(),
											"payment_status" => $payment == "cash" ? 0 : 1,
											"payment_method" => $payment,
											"place" => $location,
											"status" => 0,
											"confirmed" => 0
										];
										$this->commonDatabase->update("ispa_appointments",$ap_data,"identifier",$editing);
										$r['status'] = true;
										$r["m"] = "Updated.";
										$this->commonDatabase->delete("ispa_appointment_services","appointment_id",$editing);
										foreach ($serv_data as $sd) {
											$this->commonDatabase->add("ispa_appointment_services",$sd);
										}
									}else{
										$r['status'] = false;
										$r['m'] = "Appointment not found.";
									}
								}
							}else{
								$r['status'] = false;
								$r['m'] = "An error occured while processing payment.";
							}
						}else{
							$r['status'] = false;
							$r['m'] = "You do not have enough balance in your wallet to complete this transaction";
						}
					}else{
						$r['status'] = false;
						$r['m'] = "Some services you booked are unavailable.";
					}
				}else{
					$r['status'] = false;
					$r['m'] = "The time selected has already been booked.";
				}
			}else{
				$r['status'] = false;
				$r['m'] = "Invalid time format.";
			}
		}else{
			$r['status'] = false;
			$r['m'] = "Invalid access.";
		}
		common::emitData($r);
	}
	public function send_invite(){
		if (isset($_SESSION["user"]) && isset($_POST["email"])) {
			$ch_user = $this->commonDatabase->get_data("ispa_users",1,false,"email",$_POST["email"]);
			if (!$ch_user) {
				/*common::invite($_POST["email"])*/
				$r["status"] = true;
			}else{
				$r['status'] = false;
				$r['m'] = "Email has alredy been registered.";
			}
		}else{
			$r['status'] = false;
			$r['m'] = "Invalid access.";
		}
		common::emitData($r);
	}
	public function rem_apt(){
		if (isset($_SESSION["user"]) && isset($_POST["item"])) {
			$user = $_SESSION["user"]->ispa_id;
			$item = $_POST["item"];
			$ch_item = $this->commonDatabase->get_data("ispa_appointments",1,false,"identifier",$item,"user",$user,"status",0);
			if ($ch_item) {
				$this->commonDatabase->delete("ispa_appointments","identifier",$item);
				$this->commonDatabase->delete("ispa_appointment_services","appointment_id",$item);
				$r["status"] = true;
			}else{
				$r['status'] = false;
				$r['m'] = "Appointment not found.";
			}
		}else{
			$r['status'] = false;
			$r['m'] = "Invalid access.";
		}
		common::emitData($r);
	}
}