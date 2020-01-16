<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Business extends CI_Controller {
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
	public function index(){
		if (isset($_SESSION['business']) && $_SESSION["user"]) {
			$data['title'] = "iSpa - Business Portal";
			$data['page'] = "home";		
			$data['data'] = json_decode(json_encode($data));	
			$this->load->view("templates/base_header",$data);
			$this->load->view("business",$data);			
		}else{
			if (isset($_SESSION["user"])) {
				$data['title'] = "iSpa - Business Portal";
				$data['page'] = "home";		
				$data['data'] = json_decode(json_encode($data));	
				$this->load->view("templates/base_header",$data);
				$this->load->view("business/switch",$data);
			}else{
				redirect(base_url());
			}
		}		
	}
	public function open($bus = false){
		if ($bus && isset($_SESSION["user"])) {
			$user = $_SESSION["user"]->ispa_id;
			$ch_bus = $this->commonDatabase->get_data("ispa_business",1,false,"created_by",$user,"identifier",$bus);
			if (!$ch_bus) {
				$ch_bus = $this->commonDatabase->get_data("ispa_staff",1,false,"ispa_id",$user,"business",$bus);
				if ($ch_bus) {
					$ch_bus = common::getBus($bus);
				}
			}else{
				$ch_bus = $ch_bus[0];
			}
			if ($ch_bus) {
				$_SESSION["business"] = $bus;
				$_SESSION["business_name"] = $ch_bus["name"];
				redirect(base_url("business"));
			}else{
				show_404();
			}
		}else{
			redirect(base_url());
		}
	}
	public function submit_shop(){
		if (isset($_SESSION["user"]) && isset($_POST["editing"]) && isset($_POST["location"]) && isset($_POST["name"]) && isset($_POST["phone"]) && isset($_POST["services"]) && is_array($_POST["services"]) && isset($_POST["type"]) && isset($_POST["type_curr"]) && isset($_POST["working_days"]) && is_array($_POST["working_days"])) {

			$editing = $_POST["editing"] == false || $_POST["editing"] == "false" || $_POST["editing"] == "" ? false : $_POST["editing"];
			$location = $_POST["location"];
			$name = $_POST["name"];
			$phone = $_POST["phone"];
			$services = $_POST["services"];
			$type = $_POST["type"];
			$type_curr = $_POST["type_curr"];
			$working_days = $_POST["working_days"];


			if (!(mb_substr($phone, 0,4) == +254 || mb_substr($phone, 0,4) == "+254")) {
        if ($phone != "") {
        	if (mb_substr($phone, 0,1) == 0 || mb_substr($phone, 0,1) == "0") {
	          $phone = "+254".mb_substr($phone,1,strlen($phone));
	        }else{
	          $phone = "+254".$phone;
	        }
        }else{
        	$phone = "";
        }
      }
			
			$ch_services = true;
			$ch_working  = true;
			$time = time();
			if (($editing && isset($_SESSION["business"])) || ($location && isset($location["lat"]) && isset($location["lng"]) && isset($location["title"]) && common::isKenya($location))) {				
					if ($editing == "false" || $editing == false || $editing == "") {
						$identifier = md5(sha1($time.$name.$location["title"]));
					}else{
						$identifier = $_SESSION["business"];
					}
					foreach ($services as $service) {
						if (!((isset($service["name"]) && $service["name"]) != "" && isset($service["duration"]) &&  $service["duration"] != "" && isset($service["default"]) && isset($service["cost"]) && $service["cost"])) {
							$ch_services = false;
						}						
					}

					foreach ($working_days as $day) {									
						if (!(isset($day["day"]) && isset($day["start"]) && isset($day["end"])) && (in_array($day["day"], $this->config->item("days")) && $day["start"] != "" && $day["end"]) != "") {
							$ch_working = false;
						}						
					}
					if ($ch_services) {
						if ($ch_working) {
								$ch_type = true;
								if ($type_curr != false && $type_curr != "false") {
									$type_curr = $this->commonDatabase->get_data("ispa_business_types",1,false,"identifier",$type_curr);									
								}else{
									$type_id =  md5(sha1($type.$type.$type_curr));
									$t_data = [
										"name" => $type,
										"identifier" => $type_id,
										"date_added" => $time
									];
									$this->commonDatabase->add("ispa_business_types",$t_data);
								}
								$ch_phone = $this->commonDatabase->get_data("ispa_business",false,false,"phone",$phone);
								if ($ch_type) {	
									$r['status'] = true;																		
									if ($location != false && $location != "false") {										
										$loc_data = [
											"business" => $identifier,
											"lat" => $location["lat"],
											"lng" => $location["lng"],
											"type" => "business",
											"name" => $location["title"]
										];
									}																																
									if ($editing && ($location != false && $location != "false" && common::isKenya($location))) {
									 				
										if ($location != false && $location != "false") {
											//$bloc = common::busLoc($_SESSION["business"]);
											if ($location) {												
												$loc_data = [												
													"lat" => $location["lat"],
													"lng" => $location["lng"],												
													"name" => $location["title"]
												];
												$this->commonDatabase->update("ispa_business_locations",$loc_data,"business",$_SESSION["business"]);
											}
										}										
									}										
									if ($editing && (!$ch_phone || ($ch_phone && $ch_phone[0]["identifier"] == $identifier))) {
										if (common::isStaff($_SESSION["user"]->ispa_id,$_SESSION["business"],"admin")) {
											foreach ($services as $service) {	
												$s_data = [
													"name" => $service["name"],												
													"duration" => $service["duration"],
													"cost" => $service["cost"],											
												];																			
												if ($service["default"] != "new") {
													$ch_service = $this->commonDatabase->get_data("ispa_services",1,false,"id",$service["default"],"added_by",$identifier);
													if ($ch_service) {
														$s_data = [
															"name" => $service["name"],														
															"duration" => $service["duration"],
															"cost" => $service["cost"],														
														];
														$this->commonDatabase->update("ispa_services",$s_data,"id",$service["default"],"added_by",$identifier);
													}else{													
														$this->commonDatabase->add("ispa_services",$s_data);
													}
												}else{												
													$this->commonDatabase->add("ispa_services",$s_data);
												}
											}																			
											$data = [											
												"name" => $name,											
												"working" => json_encode($working_days),
												"phone" => $phone,																				
											];
																					
											$this->commonDatabase->update("ispa_business",$data,"identifier",$identifier);
											if ($_POST["type"] != "") {
												$data = ["name" => $_POST["type"]];
												$this->commonDatabase->update("ispa_business_types",$data,"identifier",$identifier);
											}
											$p_data = [];
											if (isset($_POST["prefs"]) && is_array($_POST["prefs"])) {
												foreach ($_POST["prefs"] as $pref) {
													if ($pref["pref"] == "app_con") {													
														$p_data["app_con"] = $pref["val"] == "false" || $pref["val"] == false ? 0: 1;
													}elseif($pref["pref"] == "app_cash"){
														$p_data["app_cash"] = $pref["val"] == "false" || $pref["val"] == false ? 0: 1;
													}
												}
											}

											$this->commonDatabase->update("ispa_bus_prefs",$p_data,"business",$identifier);

											$r['m'] = "updated";
										}else{
											$r["status"] = false;
											$r["m"] = "Invalid access";
										}
										
									}else{
										if (!$ch_phone) {
											foreach ($services as $service) {											
												if ($service["name"] != "") {
													$s_data = [
														"name" => $service["name"],	
														"added_by" => $identifier,													
														"duration" => $service["duration"],
														"cost" => $service["cost"],														
													];
													$this->commonDatabase->add("ispa_services",$s_data);
												}
											}
											$data = [
												"created_by" => $_SESSION["user"]->ispa_id,
												"name" => $name,
												"phone" => $phone,
												"identifier" => $identifier,
												"profile" => "default_bus_prof.png",
												"date_added" => $time,
												"last_login" => $time,
												"working" => json_encode($working_days)										
											];
											$this->commonDatabase->add("ispa_business",$data);				
											$this->commonDatabase->add("ispa_business_locations",$loc_data);
											$r['m'] = "added";
										}else{
											$r["status"] = false;
											$r['m'] = "Phone number has already been registered with another business.";
										}
									}																
								}else{
									$r['status'] = false;
   								$r["m"] = "Invalid business type.";
								}
						}else{
							$r['status'] = false;
   						$r["m"] = "Check your business' working days data.";
						}	
					}else{
						$r['status'] = false;
   					$r["m"] = "Check your business' services details.";
					}
			}else{
				$r['status'] = false;
     		$r["m"] = "Invalid location details";
			}
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}	
	public function get_calendar(){
		if (isset($_SESSION["user"]) && isset($_POST["dur"]) && $_POST["dur"] >= 0 && isset($_POST["business"]) && isset($_POST["month"]) && isset($_POST["year"])) {
			$r["status"] = false;
			$r["m"] = [];

			$get_bus = common::getBus($_POST["business"]);
			if ($get_bus) {
				$r['status'] = true;
				$dur = $_POST["dur"];
				$bus = $_POST["business"];
				$month = $_POST["month"] == false || $_POST["month"] == "false" ? date("m"): $_POST["month"];
				$year = $_POST["year"] == false || $_POST["year"] == "false" ? date("Y"): $_POST["year"];	
				if ($month > 12) {
					$month = 1;
					$year = $year + 1;
				}
				if ($month < 1) {
					$month = 1;
					$year = $year - 1;
				}	
				if ($month < date("m")) {
					$month = date("m");
				}		
				$calendar = common::monthCalendar($month, $year,$bus,$dur);				
				$r['m']["calendar"] = $calendar;
				$r["m"]["month"] = $month;
				$r["m"]["year"] = $year;
				$r["m"]["name"] = date("F Y",strtotime("01-".$month."-".$year));
				$bus_today = common::getAppointments(date("d-m-Y"),"bus");
			}else{				
      	$r["m"] = "Shop has not been found.";
			}
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	} 
	public function get_suggests(){
		if (isset($_POST["dur"])&& isset($_SESSION["user"]) && isset($_POST['day']) && isset($_POST["month"]) && isset($_POST["business"]) && isset($_POST["year"]) && isset($_POST["staff"])) {
			$dur = $_POST["dur"];
			$day = $_POST["day"];			
			$bus = $business = $_POST["business"];
			$month = $_POST["month"] == false || $_POST["month"] == "false" ? date("m"): $_POST["month"];
			$year = $_POST["year"] == false || $_POST["year"] == "false" ? date("Y"): $_POST["year"];				

			if ($month > 12) {
				$month = 1;
				$year = $year + 1;
			}
			if ($month < 1) {
				$month = 1;
				$year = $year - 1;
			}	
			if ($month < date("m")) {
				$month = date("m");
			}
			$days = cal_days_in_month(CAL_GREGORIAN,(Int)$month,(Int)$year);
			if ($day > $days || $day == "" || !is_numeric($day)) {
				$day = 01;
			}
			$d_ay = (Int)$day."-".(Int)$month."-".(Int)$year;
			$staff = $_POST["staff"];
			$day = strtotime((Int)$day."-".(Int)$month."-".(Int)$year);			
			$avail = common::checkAvail($day,$business, $dur,$staff);			
			$dur = (Int)$_POST["dur"] * 60;			
			if ($avail) {
				if (!is_array($avail)) {
					$slots = [];
					$bus = common::getBus($business);
					$wd = json_decode($bus["working"]);
					$d = date("D");
					$w_start =  strtotime($d_ay." "."08:00");
					$w_end = strtotime($d_ay." "."17:00");
					if ($bus && $wd && is_array($wd)) {
						for ($i=0; $i < sizeof($wd); $i++) { 
							if ($d == $wd[$i]->day) {
								$w_start = strtotime($d_ay." ".$wd[$i]->start);
								$w_end =  strtotime($d_ay." ".$wd[$i]->end); 
							}
						}											
						$slots = common::getSlots($w_start, $w_end, $dur);												
					}else{
						$r['status'] = false;
						$r["m"] = '<div class="flow-text center">Shop not found.</div>';
					}
				}else{
					$slots = $avail;							
				}				
				if (!isset($r)) {								
					for ($i=0; $i < sizeof($slots); $i++) {						
						$slots[$i]["sl_data"] = [
							"staff" => $staff,
							"dur" => $slots[$i]["start"]." - ".$slots[$i]["end"],
							"start_time" => $slots[$i]["start"],
							"date" => $slots[$i]["start"], 
							"shop" => $business
						];
					}					
					$r["m"] = common::renderSlots($slots);
					$r["slots"] = $slots;					
				}
			}else{
				$r['status'] = false;
      	$r["m"] = '<div class="flow-text center">There is no available time slot on the selected day with the selected staff member</div>';
			}
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function appoint_bus(){
		if (isset($_SESSION["user"]) && isset($_POST["business"])) {
			$bus = common::getBus($_POST["business"]);
			$sel = isset($_POST["sel"]) ? $_POST["sel"] : [];
			if ($bus) {
				$identifier = $_POST["business"];
				$services = $this->commonDatabase->get_cond("ispa_services","added_by='$identifier' AND status='1' order by id DESC");
				if ($services) {
					$serv = "";
					foreach ($services as $service) {	
					  $is_sel = false;					
						if (is_array($sel)) {													
							foreach ($sel as $s) {								
								if ((Int)$s["item"] == (Int)$service["id"]) {
									$is_sel = true;
								}
							}							
						}
						if ($is_sel) {
							$serv .= common::renderService($service,"client",true);
						}else{
							$serv .= common::renderService($service,"client");
						}
					}
					$staff = $this->commonDatabase->get_data("ispa_staff",false,false,"business",$identifier,"availability",1);
					if ($staff) {
						$r['staff'] = "";
						foreach ($staff as $s) {
							$st  = $this->commonDatabase->get_data("ispa_users",1,false,"ispa_id",$s["ispa_id"]);
							if ($st) {
								$r["staff"] .= "<option value='".$s["ispa_id"]."'>".$st[0]["name"]."</option>";
							}

						}
					}else{
						$r['staff'] = "<option value=''>No staff</option>";
					}
					$r['status'] = true;
					$r["name"] = $bus["name"]/*." | ".common::busLoc($identifier)->name*/;
					$r['m'] = $serv;
				}else{
					$r['status'] = false;
      		$r["m"] = '<div class="flow-text center">This shop does not seem to offer any services yet.</div>';
				}
			}else{
				$r['status'] = false;
      	$r["m"] = "Shop not found";
			}
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function get_explore(){
		if (isset($_POST["type"]) && isset($_POST["item"])) {
			$type = $_POST["type"];
			if ($type == "list") {
				$r["status"] = true;
				$r["m"] = "";
				if ($_POST["item"] == "favorites" && isset($_SESSION["user"])) {					
					$u = isset($_SESSION['user']->ispa_id) ? $_SESSION["user"]->ispa_id : false;
					$items = $this->commonDatabase->get_data("ispa_favorites",false,false,"user",$u);
					if ($items) {
						foreach ($items as $item) {
							$r["m"] .= common::renderExplore($item);
						}
					}else{
						$r["m"] .= '<div class="flow-text cetnter explore-none">You have not added any shop to your favorites yet.</div>';
					}
				}elseif($_POST["item"] != "near"){
					$item = $this->commonDatabase->get_data("ispa_business_types",1,false,"id",$_POST["item"]);
					if ($item) {
						$n = $item[0]["name"];
						$items = $this->commonDatabase->get_cond("ispa_business_types","name='$n' order by id ASC");
						foreach ($items as $item) {
							$k = ["shop" => $item["identifier"]];
							$r["m"] .= common::renderExplore($k);
						}
					}else{
						$r["m"] .= '<div class="flow-text cetnter explore-none">No shops</div>';
					}
				}else{
					/*handle near me*/
					$r['status'] = false;
      		$r["m"] = "Invalid access";
				}
			}else{
				$r['status'] = false;
      	$r["m"] = "Invalid access";
			}
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function search_bus(){
		if (isset($_POST["key"]) && isset($_SESSION["user"])) {
			$r['status'] = true;
			$r["m"] = "";
			$key = $_POST["key"];
			$searched = [];
			$bus_names = $this->commonDatabase->get_cond("ispa_business","name like '%$key%' or phone like '%$key%'");
			if ($bus_names) {
				foreach ($bus_names as $item) {
					array_push($searched, ["shop" => $item["identifier"]]);
				}
			}
			$bus_locs = $this->commonDatabase->get_cond("ispa_business_locations","name like '%$key%'");
			if ($bus_locs) {
				foreach ($bus_locs as $item) {
					if (!in_array($item["business"], $searched)) {
						array_push($searched, ["shop" => $item["business"]]);
					}
				}
			}
			$bus_types = $this->commonDatabase->get_cond("ispa_business_types","name like '%$key%'");
			if ($bus_types) {
				foreach ($bus_types as $item) {
					if (!in_array($item["identifier"], $searched)) {
						array_push($searched, ["shop" => $item["identifier"]]);
					}					
				}
			}			
			if (sizeof($searched) > 0) {
				foreach ($searched as $item) {					
					$r["m"] .= common::renderExplore($item);
				}
			}else{
				$r["m"] .= '<div class="flow-text center explore-none">No shops found</div>';
			}
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function bus_page(){
		if (isset($_POST["bus"])) {
			$bus = common::getBus($_POST["bus"]);
			if ($bus) {
				$identifier = $bus["identifier"];
				$loc     = common::busLoc($identifier);
				$rating  = common::busRating($identifier);
				$reviews = $this->commonDatabase->get_data("ispa_ratings",false,false,"shop", $identifier);
				$user  = isset($_SESSION["user"]) ? $_SESSION["user"]->ispa_id:false;
				$r["m"]["u_rating"] = false;
				if ($user) {
					$rat = $this->commonDatabase->get_data("ispa_ratings",1,false,"user",$user,"shop",$identifier);
					if ($rat) {
						$r["m"]["u_rating"] = [
							"rating" => $rat[0]["rating"],
							"note" => $rat[0]["note"]
						];
					}
				}
				$revs = "";
				if ($reviews) {
					foreach ($reviews as $review) {
						$revs .= common::renderReview($review);
					}
				}
				$services = $this->commonDatabase->get_data("ispa_services",false,false,"added_by",$identifier);
				$serv = "";				
				if ($services) {
					foreach ($services as $service) {
						$serv .= common::busServ($service);
					}
				}
				if ($revs == "") {
					$revs = '<div class="flow-text cetnter explore-none">No reviews yet</div>';
				}
				$r["status"] = true;
				$working = json_decode($bus["working"]);
				$w = "";
				if (is_array($working)) {
					foreach ($working as $day) {
						$w .= '
							<div class="w-item">
								<div class="w-name">'.date("l",strtotime($day->day)).'</div>				
								<div class="w-hours">'.date("h:i A",strtotime($day->start)).' - '.date("h:i A",strtotime($day->end)).'</div>							
							</div>
						';
					}
				}	
				$shc = [];
				$sh_list 	= $this->commonDatabase->get_data("ispa_showcase",false,false,"shop",$identifier);	
				if ($sh_list) {
					for ($i=0; $i < sizeof($sh_list); $i++) { 
						$s = [
							'img' => base_url()."uploads/showcase/".$sh_list[$i]["link"],
							'title' => date("jS F Y", $sh_list[$i]["date_added"])
						];
						array_push($shc, $s);
					}
				}
				$ch_f = $this->commonDatabase->get_data("ispa_favorites",1,false,"user", $user,"shop",$identifier);
				$r["m"] = [
					"details" => [
						"name" => $bus["name"],
						"identifier" => $bus["identifier"],
						"phone" => $bus["phone"],
						"profile" => $bus["profile"],
						"working_days" => $w
					],
					"favorite" => $ch_f ? true: false,
					"location" => [
						"lat" => $loc->lat,
						"lng" => $loc->lng,
						"name" => $loc->name
					],
					"showcase" => $shc,
					"rating" => $rating,
					"reviews" => $revs,
					"services" => $serv,
					"u_rating" => $r["m"]["u_rating"]
				];
			}else{
				$r['status'] = false;
      	$r["m"] = "Shop not found";
			}
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function send_rating(){
		if (isset($_SESSION["user"]) && isset($_POST["rating"]) && is_numeric($_POST["rating"]) && isset($_POST["note"]) && isset($_POST["item"])) {
			$user = $_SESSION["user"]->ispa_id;
			$identifier = $_POST["bus"];
			$rating = $_POST["rating"] >= 1 && $_POST["rating"] <= 5 ? $_POST["rating"] : 1;
			$note  = $_POST["note"];
			$bus = common::getBus($identifier);
			if ($bus) {
				$r["status"] = true;
				$r["m"] = "Rated";
				$ch_rating = $this->commonDatabase->get_data("ispa_ratings",1,false,"user",$user,"shop",$identifier);
				if ($ch_rating) {
					$data = [												
						"rating" => $rating,
						"note" => $note,
						"last_edit" => time()						
					];
					$this->commonDatabase->update("ispa_ratings",$data,"user",$user,"shop",$identifier);
				}else{
					$data = [
						"user" => $user,
						"shop" => $identifier,
						"rating" => $rating,
						"note" => $note,
						"date_added" => time(),
					];
					$this->commonDatabase->add($data);
				}
			}else{
				$r['status'] = false;
      	$r["m"] = "Shop not found";
			}
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function favorites(){
		if (isset($_SESSION["user"]) && isset($_POST["bus"])) {
			$bus = $_POST["bus"];
			$shop = common::getBus($bus);
			if ($shop) {
				$user = $_SESSION["user"]->ispa_id;
				$ch_f = $this->commonDatabase->get_data("ispa_favorites",1,false,"user", $user,"shop",$bus);
				$r["shop"] = $shop["name"];
				if ($ch_f) {
					$this->commonDatabase->delete("ispa_favorites","user", $user,"shop",$bus);
					$r["m"] = "removed";
				}else{
					$data = [
						"user" => $user,
						"shop" => $bus,
						"date_added" => time(),
					];
					$this->commonDatabase->add("ispa_favorites",$data);
					$r["m"] = "added";
				}
				$r["status"] = true;
			}else{
				$r['status'] = false;
	      		$r["m"] = "Shop not found";
			}
		}else{
	      $r['status'] = false;
	      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function service_lookup(){
		if (isset($_POST["key"]) && isset($_SESSION["user"])) {
			$key = $_POST["key"];
			$lookups = $this->commonDatabase->get_cond("ispa_business_types","name like '%$key%' group by name");			
			$r["status"] = true;
			$r["m"] = "";
			if ($lookups) {
				foreach ($lookups as $lookup) {
					$r["m"] .= common::renderLookup($lookup);
				}
			}else{
				$r['status'] = false;
      	$r["m"] = "No results";
			}
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function pre_services(){
		if (isset($_POST["id"]) && is_numeric($_POST["id"])) {
			$id = $_POST["id"];
			$r["status"] = false;
			$r["m"] = "";
			$bus = $this->commonDatabase->get_data("ispa_business_types",1,false,"id",$id);
			if ($bus) {
				$n = $bus[0]["name"];
				$more=$this->commonDatabase->get_cond("ispa_business_types","name like '%$n%'");
				if ($more) {
					$more_ors = " ";
					foreach ($more as $m) {
						$ii = $m["identifier"];
						if (sizeof($more) > 1) {
							if($m["identifier"] == $more[0]["identifier"]) {
								$more_ors .= " added_by='$ii' ";
							}else{
								$more_ors .= " or added_by='$ii' ";
							}
						}else{
							$more_ors .= " added_by='$ii' ";
						}						
					}					
					$servs = $this->commonDatabase->get_cond("ispa_services",$more_ors." group by name limit 5");
					foreach ($servs as $serv) {
						$r["m"] .= common::renderService($serv);
					}
					if ($r["m"] != "") {
						$r["status"] = true;
					}
				}
			}
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function get_appointment(){
		if (isset($_SESSION["user"]) && isset($_POST["item"])) {
			$user = $_SESSION["user"]->ispa_id;
			$item = $_POST["item"];
			if (isset($_SESSION["business"])) {
				if (isset($_POST["checkout"])) {
					$appointment = $this->commonDatabase->get_data("ispa_appointments",1,false,"shop",$_SESSION["business"],"identifier",$item,"status",0);
				}else{
					$appointment = $this->commonDatabase->get_data("ispa_appointments",1,false,"shop",$_SESSION["business"],"identifier",$item);
				}
			}else{
				$appointment = $this->commonDatabase->get_data("ispa_appointments",1,false,"user",$user,"identifier",$item);
			}			
			if ($appointment) {				
				$appointment = $appointment[0];
				$user = $appointment["user"];
				$shop = common::getBus($appointment["shop"]);
				$serv_list = "";
				if ($shop) {
					$ap_services = $this->commonDatabase->get_data("ispa_appointment_services",false,false,"appointment_id",$item);
					$servs = "";
					$app_time = 0;					
					$serv_amnt = 0;					
					foreach ($ap_services as $ap_service) {
						$serv  = $this->commonDatabase->get_data("ispa_services",1,false,"id",$ap_service["service_id"]);						
						if ($serv) {														
							$app_time += $serv[0]["duration"]; 
							$serv_amnt += $serv[0]["cost"];
							$servs .= common::renderService($serv[0],"client",true);
							$serv_list .= '<tr><td>'.$serv[0]["name"].'</td><td>Ksh. '.number_format($serv[0]["cost"],2).'</td></tr>';							
						}						
					}
					
					$serv_list .= '<tr>
													<td class="t-total">Total</td>
													<td class="t-total">Ksh. '.number_format($serv_amnt,2) .'</td>
												</tr>';
					$staff = $this->commonDatabase->get_data("ispa_staff",false,false,"business",$shop["identifier"]);
					$ap_staff = "";
					$staff_name = "";
					if ($staff) {						
						foreach ($staff as $staff) {
							$u = $this->commonDatabase->get_data("ispa_users",1,false,"ispa_id",$staff["ispa_id"]);
							if ($u) {
								if ($staff["ispa_id"] == $appointment["staff_id"]) {
									$ap_staff .= '<option selected value="'.$appointment["staff_id"].'">'.$u[0]["name"].'</option>';
									$staff_name = $u[0]["name"];
								}else{
									$ap_staff .= '<option value="'.$appointment["staff_id"].'">'.$u[0]["name"].'</option>';
								}
							}							
						}
					}
					if ($appointment["payment_method"] == "wallet") {					
						$pay = true;
					}else{						
						$pay = false;
					}
					$bus_loc = common::busLoc($shop["identifier"]) ? common::busLoc($shop["identifier"])->name : "";
					$t = date("jS F Y",$appointment["app_time"])." | ".date("h:i A",$appointment["app_time"])." - ".date("h:i A",$appointment["app_time"] + ($app_time * 60));
					$r["status"] = true;
					$app_user = $this->commonDatabase->get_data("ispa_users",1,false,"ispa_id",$appointment["user"]);
					if ($app_user) {
						$count = $this->commonDatabase->count("ispa_appointments","user",$user,"confirmed",1);					
						if (!isset($_SESSION["business"])) {
								$serv_list = "";
						}						
						if ($appointment["app_time"] < time()) {
							if ($appointment["status"] == 2) {
								$past = 2;
							}else{
								$past = 1;
							}
						}else{
							$past = 0;
						}
						$r["m"] = [
							"business" => [
								"name" => $shop["name"]." | ".$bus_loc,	
								"identifier" => $shop["identifier"]						 
							],
							"services" => $servs,
							"time"  => /*$appointment["app_time"] > time() ? $t : ""*/ $t,
							"editable" => $appointment["app_time"] > time(),
							"place" => $appointment["place"],
							"staff" => $ap_staff,
							"total" => number_format($serv_amnt,2),						
							"payment" => $pay,
							"s_table" => $serv_list,
							"staff_name" => $staff_name,
							"user" => [
								"name" => $app_user[0]["name"],
								"location" => mb_substr(json_decode($app_user[0]["location"])->title, 0,10)." ...",
								"phone" => $app_user[0]["phone"],
								"count" => $count,
								"id" => $app_user[0]["ispa_id"],
							],
							"note" => $appointment["note"],
							"confirmed" => $appointment["confirmed"],
							"status" => (Int)$appointment["status"] ,
							"past" => $past 
						];
					}
				}else{
					$r['status'] = false;
		      $r["m"] = "Shop not found.";
				}
			}else{
	      $r['status'] = false;
	      $r["m"] = "Appointment not found.";
	    }
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function get_day(){
		if (isset($_SESSION["business"]) && isset($_POST["day"]) && isset($_POST["type"])) {
			if ($_POST["type"] == "next") {
				$day = strtotime(date("d-m-Y",(strtotime($_POST["day"]) + (60 * 60 * 24))));
			}else{
				if($_POST["type"] == "cur"){
					$day = strtotime(date("d-m-Y",strtotime($_POST["day"])));
				}else{
					$day = strtotime(date("d-m-Y",(strtotime($_POST["day"]) - (60 * 60 * 24))));
				}
			}
			$bus = $_SESSION["business"];
			$shop = common::getBus($bus);
			if ($shop) {
				$working = json_decode($shop["working"]);
				$is_working = false;
				foreach ($working as $wk) {
					if ($wk->day == date("D",$day)) {
						$is_working = true;
					}
				}
				$day = common::getWorking($day,$_POST["type"],$bus);
				if ($is_working || $day) {
					$day = common::getWorking($day,$_POST["type"],$bus);
					if ($day) {
						$cal= common::bus_calendar(date("Y",$day),date("m",$day),date("d",$day),$bus);
						$r["status"] = true;

						$d = date("d-m-Y",$day);
					  $t = strtotime($d);
					  $ispa_id = $_SESSION["user"]->ispa_id;
					  $next_day = $t + (60 * 60 *24) - 1;					  
					  if ($shop["created_by"] == $ispa_id) {
					  	$appointments = $this->commonDatabase->get_cond("ispa_appointments","shop='$bus' AND app_time >= '$t' AND app_time <= '$next_day' order by app_time ASC");
					  }else{
					  	$appointments = $this->commonDatabase->get_cond("ispa_appointments","shop='$bus' AND app_time >= '$t' AND app_time <= '$next_day' AND staff_id='$ispa_id' order by app_time ASC");
					  }
					  $apps = "";
					  if ($appointments) {
					  	foreach ($appointments as $app) {
					  		$apps .= common::renderDay($app,$d,$bus);
					  	}
					  }else{
					  	$apps .= '<div class="flow-text center">No appointments yet</div>';
					  }
						$r["m"] = [
							"calendar" => $cal,
							"active" => date("jS F Y",$day),	
							"date" => date("d-m-Y",$day),
							"appointments" => $apps,
							"app_tot" => $appointments && sizeof($appointments) > 0 ? sizeof($appointments): ""
						];
					}else{
						$r['status'] = false;
      			$r["m"] = "Oops! An error occurred.";
					}
				}else{
					$r['status'] = false;
      			$r["m"] = "Oops! An error occurred.";
				}			
			}else{
				$r['status'] = false;
      	$r["m"] = "Shop not found";
			}
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function confirm_app(){
		if (isset($_SESSION["business"]) && isset($_POST["item"])) {
			$app = $this->commonDatabase->get_data("ispa_appointments",1,false,"identifier",$_POST["item"],"confirmed",0);
			if ($app) {
				$data = ["confirmed" => 1];
				$this->commonDatabase->update("ispa_appointments",$data,"identifier",$_POST["item"]);
				$shop = common::getBus($app[0]["shop"]);
				$not_data = [
					"user" => $app[0]["user"],
					"title" => "Appointment confirmation",
					"content" => "Your appointment for ".date("jS F Y",$app[0]["app_time"])." with ".$shop['name']." has been confirmed.",
					"date_added" => time(),
					"status" => 0
				];
				$this->commonDatabase->add("ispa_notifications",$not_data);
				$r["status"] = true;				
			}else{
				$r['status'] = false;
      	$r["m"] = "Appointment not found";
			}
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function cancel_app(){
		if (isset($_SESSION["business"]) && isset($_POST["item"]) && isset($_POST["note"]) && $_POST["note"] != "") {
			$app = $this->commonDatabase->get_data("ispa_appointments",1,false,"identifier",$_POST["item"],"status",0);
			if ($app) {
				$data = ["confirmed" => 2];
				$this->commonDatabase->update("ispa_appointments",$data,"identifier",$_POST["item"]);
				$shop = common::getBus($app[0]["shop"]);
				if ($_POST["note"] != "") {
					$reason = '<br>"'.$_POST["note"].'"';
				}else{
					$reason = "";
				}
				$not_data = [
					"user" => $app[0]["user"],
					"title" => "Appointment cancellation",
					"content" => "Your appointment for ".date("jS F Y",$app[0]["app_time"])." with ".$shop['name']." has been cancelled.".$reason,
					"date_added" => time(),
					"status" => 0
				];
				common::refund($_POST["item"]);
				$this->commonDatabase->add("ispa_notifications",$not_data);
				$r["status"] = true;				
			}else{
				$r['status'] = false;
      	$r["m"] = "Appointment not found";
			}
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function miss_app(){
		if (isset($_SESSION["business"]) && isset($_POST["item"])) {
			$a = $_POST["item"];
			$t = time();
			$app = $this->commonDatabase->get_cond("ispa_appointments","identifier='$a' AND app_time < '$t' AND confirmed != '2' limit 1");
			if ($app) {
				if ($app[0]["status"] == 2) {
					$data = ["status" => 1,"confirmed" => 3];
					$st = 0;
				}else{
					$t = 2;
					$data = ["status" => 2];
				}
				$this->commonDatabase->update("ispa_appointments",$data,"identifier",$_POST["item"]);
				$shop = common::getBus($app[0]["shop"]);				
				if ($t == 2) {
					$not_data = [
						"user" => $app[0]["user"],
						"title" => "Appointment cancellation",
						"content" => "Your appointment for ".date("jS F Y",$app[0]["app_time"])." with ".$shop['name']." has been marked as not missed.",
						"date_added" => time(),
						"status" => 0
					];
				}else{
					$not_data = [
						"user" => $app[0]["user"],
						"title" => "Appointment cancellation",
						"content" => "Your appointment for ".date("jS F Y",$app[0]["app_time"])." with ".$shop['name']." has been marked as missed.",
						"date_added" => time(),
						"status" => 0
					];
				}
				$this->commonDatabase->add("ispa_notifications",$not_data);
				$r["status"] = true;				
			}else{
				$r['status'] = false;
      	$r["m"] = "Appointment not found";
			}
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function checkout(){
		if (isset($_POST["item"]) && isset($_POST["disc"]) && isset($_SESSION["business"])) {
			$apt = $_POST["item"];
			$bus = $_SESSION["business"];			
			$user = $_SESSION["user"]->ispa_id;
			$staff = $this->commonDatabase->get_data("ispa_staff",1,false,"ispa_id",$user);
			$discount = $_POST["disc"];
			$time = time();
			$appointment = $this->commonDatabase->get_data("ispa_appointments",1,false,"identifier",$apt,"status",0);
			$transaction = true;			
			if ($appointment && $staff && $appointment[0]["app_time"] <= $time) {

				$appointment = $appointment[0];
				$services = $this->commonDatabase->get_data("ispa_appointment_services",false,false,"appointment_id",$apt);
				if ($services) {
					$total = 0;
					$transaction = $this->commonDatabase->get_data("ispa_transactions",1,false,"appointment_id",$apt,"state",0);
					$checked = true;
					if ($transaction) {
						$checked = common::checkout($appointment["user"],$transaction[0],$discount);
					}
					if ($checked) {
						$data = ["status" => 1,"payment_status" => 1,"confirmed" => 1];
						$this->commonDatabase->update("ispa_appointments",$data,"identifier",$apt);
						$r["status"] = true;
					}else{
						$r['status'] = false;
	      		$r["m"] = "Oops! An error occurred.";
					}
				}else{
					$r['status'] = false;
	      	$r["m"] = "Appointment not found";
				}
			}else{
				$r['status'] = false;
      	$r["m"] = "Oops! something went wrong.";
			}
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function update_staff(){
		if (isset($_SESSION["business"]) && isset($_SESSION["user"]) && common::isStaff($_SESSION["user"]->ispa_id,$_SESSION["business"],"admin") && isset($_POST["staff"]) && isset($_POST["available"])) {

			$avail = $_POST["available"] == "false" || $_POST["available"] == false ? 0 : 1;

			$ch_staff = common::isStaff($_POST["staff"],$_SESSION["business"]);
			if ($ch_staff) {
				$data = ["availability" => $avail];
				$this->commonDatabase->update("ispa_staff",$data,"ispa_id",$_POST["staff"]);
				$r["status"] = true;
			}else{
				$r['status'] = false;
      	$r["m"] = "Staff not found.";
			}
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function get_staff(){
		if (isset($_SESSION["business"]) && isset($_SESSION["user"]) && common::isStaff($_SESSION["user"]->ispa_id,$_SESSION["business"],"admin") && isset($_POST["staff"]) && isset($_POST["month"])) {			
			$is_month = false;
			for ($i=1; $i < 12; $i++) { 
				if (date("M",strtotime("01-".$i."-2019")) == $_POST["month"]) {
					$is_month = true;
				}
			}
			$ch_staff = common::isStaff($_POST["staff"],$_SESSION["business"]);
			if ($ch_staff && $is_month || $_POST["month"] == "all-time") {
				$bus = $_SESSION["business"];
				$staff = $_POST["staff"];
				$st = $staff;
				$month = $_POST["month"];
				$year = date("Y");

				if ($month != "all-time") {
					$month = date("m",strtotime($_POST["month"]));					
					$days = cal_days_in_month(CAL_GREGORIAN,(Int)$month,(Int)$year);		
					$start = strtotime("01-".$month."-".$year);
					$end  = strtotime($days."-".$month."-".$year);
				}else{
					$staff = $this->commonDatabase->get_data("ispa_staff",1,false,"ispa_id",$staff);
					$month = date("m");

					$start = $staff[0]["date_added"];
					$end  = time();
				}
				$appointments = $this->commonDatabase->get_cond("ispa_appointments","staff_id='$st' AND shop='$bus' AND app_time >= '$start' AND app_time <= '$end' AND status = '1'");
				if ($appointments) {
					$staff_count = common::staffCount($appointments);
					$r["status"] = true;
					$r["m"] = [
						"count" => $staff_count->count,
						"amnt" => "Ksh. ".number_format($staff_count->amnt,2)
					];
				}else{
					$r["status"] = true;
					$r["m"] = [
						"count" => 0,
						"amnt" => "Ksh. 0.00"
					];
				}
			}else{
				$r['status'] = false;
      	$r["m"] = "Staff not found.";
			}
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function suggest_staff(){
		if (isset($_SESSION["user"]) && isset($_SESSION["business"]) && isset($_POST["key"])  && common::isStaff($_SESSION["user"]->ispa_id,$_SESSION["business"],"admin")) {
			$key = $_POST["key"];
			$bus = $_SESSION["business"];
			$suggests = $this->commonDatabase->get_cond("ispa_users","name like '%$key%' or email like '%$key%' or phone like '%$key%' limit 10");
			if ($suggests) {
				$s_list = [];
				foreach ($suggests as $s) {
					if (!common::isStaff($s["ispa_id"],$bus)) {
						array_push($s_list, $s);
					}
				}
				if (sizeof($s_list) > 0) {
					$r["status"] = true;
					$r["m"] = "";
					foreach ($s_list as $user) {
						$r["m"] .= common::renderSt($user);
					}
				}else{
					$r['status'] = false;
      		$r["m"] = "";
				}
			}else{
				$r['status'] = false;
      	$r["m"] = "";
			}			
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function add_staff(){
		if (isset($_SESSION["user"]) && isset($_SESSION["business"]) && isset($_POST["user"])  && common::isStaff($_SESSION["user"]->ispa_id,$_SESSION["business"],"admin") && isset($_POST["avail"]) && isset($_POST["pass"])) {

			$user = $_POST["user"];
			$bus = $_SESSION["business"];
			$pass = md5(sha1($_POST["pass"]));
			$b = common::getBus($bus);

			$u = $this->commonDatabase->get_cond("ispa_users","id='$user' AND pass='$pass'  limit 1");
			if ($u && $b) {				
				if (!common::isStaff($u[0]["ispa_id"],$bus)) {
					$r["status"] = true;
					$data = [
						"ispa_id" => $u[0]["ispa_id"],
						"business" => $bus,
						"availability" => $_POST["avail"] == false || $_POST["avail"] == "false" ? 0: 1,
						"date_added" => time()
					];
					$this->commonDatabase->add("ispa_staff",$data);
					$data["id"] = time();
					common::notify($u[0]["ispa_id"], $b["name"]." Added you as their staff member. You can access the business portal by clicking on the Business Portal menu item." ,$b["name"]);
					$r["m"] = common::renderStaff($data);
				}else{
					$r['status'] = false;
      		$r["m"] = "User is already a staff member.";
				}				
			}else{
				$r['status'] = false;
      	$r["m"] = "User not found or Invalid password.";
			}			
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function rem_staff(){
		if (isset($_SESSION["user"]) && isset($_SESSION["business"]) && isset($_POST["staff"])  && common::isStaff($_SESSION["user"]->ispa_id,$_SESSION["business"],"admin")) {

			$staff = $_POST["staff"];
			$bus = $_SESSION["business"];			
			$b = common::getBus($bus);		
			if (common::isStaff($staff,$bus) && $b && !common::isStaff($staff,$bus,"admin")) {

				$r["status"] = true;		
		
				$this->commonDatabase->delete("ispa_staff","ispa_id",$staff);
				common::notify($staff, "You are no longer a staff member of ".$b["name"]."." ,"iSpa");
			}else{
				$r['status'] = false;
    		$r["m"] = "Staff member not found.";
			}				
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
	public function add_showcase(){
		if (isset($_SESSION["user"]) && isset($_SESSION["business"]) && isset($_FILES)  && common::isStaff($_SESSION["user"]->ispa_id,$_SESSION["business"],"admin")) {
			if (isset($_FILES['file-0'])) { 
        $filename = md5(sha1($_SESSION["business"].time()));

        $config['upload_path']          = './uploads/showcase/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = $filename;
        $config['max_size']             = 160000;
        $this->load->library('upload', $config);  

        if (!$this->upload->do_upload('file-0'))
        {
          $r["status"] = false;
          $error = array('error' => $this->upload->display_errors());             
          $r['m'] = $error['error'];          
        } 
        else{
          $data = [
            "link" => $filename.$this->upload->data('file_ext'),
            "shop" => $_SESSION["business"],
            "date_added" => time(),
            "notes" => "",
            "added_by" => $_SESSION["user"]->ispa_id,
          ];
    			$this->commonDatabase->add("ispa_showcase",$data);
          $r['status'] = true;                
        }
      }else{
        $r['status'] = false;
        $r['m'] = "Invalid file";
      }
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid image";
    }
    common::emitData($r);
	}
	public function rm_showcase(){
		if (isset($_SESSION["user"]) && isset($_SESSION["business"]) && isset($_POST["item"])  && common::isStaff($_SESSION["user"]->ispa_id,$_SESSION["business"])) {
			$r["status"] = true;
			$this->commonDatabase->delete("ispa_showcase","id",$_POST["item"],"shop",$_SESSION["business"]);
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid image";
    }
    common::emitData($r);
	}
	public function get_showcase(){
		if (isset($_POST["shop"]) && (common::getBus($_POST["shop"]) || $_POST["shop"] == "online")) {			
			if ($_POST["shop"] == "online" && isset($_SESSION["business"])) {
				$_POST["shop"] = $_SESSION["business"];
			}
			else{
				$_POST["shop"] = "";
			}
			$shop = common::getBus($_POST["shop"]);
			$get_showcase = $this->commonDatabase->get_data("ispa_showcase",false,false,"shop",$_POST["shop"]);
			$r["name"] = $shop["name"];
			if ($get_showcase) {
				$r["status"] = true;
				$r["m"] = "";				
				foreach ($get_showcase as $img) {
					$r["m"] .= common::renderShowcase($img);
				}
			}else{
				$r['status'] = true;
    		$r["m"] = '<div class="flow-text center white-text">No pictures added yet</div>';
			}	
		}else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
	}
}