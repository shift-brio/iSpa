<?php 
 class Common{
 	
 	public function __construct() {
		$CI = & get_instance();      
		$CI->load->library('session');
		$CI->load->helper('form');		    
		$CI->load->library('user_agent');
		$CI->load->helper('url_helper');
		$CI->load->helper('date'); 
		$CI->load->model("commonDatabase");		           
	}
	static function getPass($pass = ""){
	    return md5(sha1($pass));
	}
	static function isKenya($loc = false){
		$CI = &get_instance();		
		if ($loc && $loc["lat"] < $CI->config->item("kenya_bounds")->lat && $loc["lng"] < $CI->config->item("kenya_bounds")->lng) {
			return true;
		}
		return false;
	}
	static function h_cypher_encode($k = ""){
		if (common::h_cypher_chars($k)) {
			return common::h_cypher_chars($k)->code;
		}
		return $k;
	}
	static function h_cypher_decode($k = ""){
		if (common::h_cypher_chars($k)) {
			return common::h_cypher_chars($k)->char;
		}
		return " ";
	}
	static function h_cypher_chars($r = false){
		$chars = [
			"a" => ["char" => "a", "code"=> 0],
			"b" => ["char" => "b", "code"=> 1],
			"c" => ["char" => "c", "code"=> 2],
			"d" => ["char" => "d", "code"=> 3],
			"e" => ["char" => "e", "code"=> 4],
			"f" => ["char" => "f", "code"=> 5],
			"g" => ["char" => "g", "code"=> 6],
			"h" => ["char" => "h", "code"=> 7],
			"i" => ["char" => "i", "code"=> 8],
			"j" => ["char" => "j", "code"=> 9],
			"k" => ["char" => "k", "code"=> .1],
			"l" => ["char" => "l", "code"=> .2],
			"m" => ["char" => "m", "code"=> .3],
			"n" => ["char" => "n", "code"=> .4],
			"o" => ["char" => "o", "code"=> .5],
			"p" => ["char" => "p", "code"=> .6],
			"q" => ["char" => "q", "code"=> .7],
			"r" => ["char" => "r", "code"=> .8],
			"s" => ["char" => "s", "code"=> .9],
			"t" => ["char" => "t", "code"=> .01],
			"u" => ["char" => "u", "code"=> .02],	
			"v" => ["char" => "v", "code"=> .03],	
			"w" => ["char" => "w", "code"=> .04],
			"x" => ["char" => "x", "code"=> .05],	
			"y" => ["char" => "y", "code"=> .06],
			"z" => ["char" => "z", "code"=> .07],
		];
		if ($r) {
			foreach ($chars as $char) {
				$ch_checked = false;
				if ($char["char"] == $r) {
					$ch_checked = $char;
				}

				return json_decode(json_encode($ch_checked));
			}
		}
		return json_decode(json_encode($chars));
	}
	static function check_name($name = false){
		if ($name) {
			$regex = "/[a-zA-Z\-0-9]|\~|\_|\-|\./"; 
			$name = str_split($name);
			for ($i=0; $i < sizeof($name); $i++) { 
				if (!preg_match($regex, $name[$i]) && $name[$i] != " ") {
					return false;
				}
			}
		}else{
			return false;
		}
		return true;
	}
	static function update_user_session($ispa_id = false){
		if ($ispa_id) {
			$CI = &get_instance();
			$user = $CI->commonDatabase->get_data('ispa_users',1,false,'ispa_id',$ispa_id);
			if ($user) {
				$user = $user[0];								
				$user = [
		          'id'      => $user['id'],
		          'email'   => $user['email'],
		          'name' => $user["name"],
		          'ispa_id' => $user["ispa_id"],
		          "profile" => $user["profile"],
		          "location" => json_decode($user["location"]),
		          "phone" => $user["phone"]
		        ];
		    $_SESSION['user'] = json_decode(json_encode($user));
			}
		}
	}
	static function emitData($val){
		header("Content-type:application/json");
		echo json_encode($val);
		exit();
	}
	static function getTime(){
		$CI = &get_instance();
		if ((time() - strtotime($CI->config->item("updated_at"))) < (60 * 60 * 24)) {
			$data['time'] = '?'.time();	
		}else{
			$data['time'] = '';	
		}
		return $data['time'];
	}
	static function get_404(){
		redirect(base_url("404"));
	}
	static function format_number($num = false){
		if ($num) {
			if ($num >=0 && $num < 1000) {
				$text = $num;
			}
			elseif ($num > 999 && $num < 1000000) {
	          $text = number_format(($num/1000),1)."K";
	        }
	        elseif($num > 999999 && $num < 1000000000){
	          $text = number_format(($num/1000000),1)."M";
	        }elseif ($num > 999999999 && $num < 1000000000000) {
	          $text = number_format(($num/1000000),1)."B";
	        }
	        return $text;
		}
		return false;
	}
	static function cmp($a,$b){
    if ($a['count'] == $b['count']) {
      return 0;
    }
    return ($a['count'] < $b['count']) ? -1 : 1;
  }
  static function acmp($a,$b){
    if ($a['count'] == $b['count']) {
      return 0;
    }
    return ($a['count'] > $b['count']) ? -1 : 1;
  }
  static function sorter($arr){  
    $CI = & get_instance();       
    usort($arr, ['common','cmp']);
    return $arr;
  } 
  static function asorter($arr){            
    usort($arr, ['common','acmp']);
    return $arr;
  }
  static function isAdmin($ispa_id = false){
  	$CI = & get_instance();
  	if (!$ispa_id && isset($_SESSION["user"])) {
  		$ispa_id = $_SESSION["user"]->ispa_id;
  	}
  	if ($ispa_id && in_array($ispa_id, $CI->config->item("admin"))) {
  		return true;
  	}else{
  		return false;
  	}
  }
  static function renderHelp($item = false){
  	if ($item) {
  		if (isset($_SESSION["user"]) && isset($_SESSION["user"]->ispa_id) &&  common::isAdmin($_SESSION["user"]->ispa_id)) {
				$tools = '
							<div class="help-item-tools">
								<button data-tooltip="Delete help item." data-position="left" class="material-icons click-btn tooltipped help-item-tool red-text rem-help">delete</button>
								<button data-tooltip="Edit help item." data-position="left" class="material-icons click-btn tooltipped help-item-tool edit-help">edit</button>
							</div>
				';
			}else{
				$tools = "";
			}
  		$item = '		
		 				<div class="help-item" data-item="'.$item["id"].'">
							<div class="help-title flow-text">'.$item["topic"].'</div>
							<div class="help-item-body">
								'.$item["content"].'
							</div>
							'.$tools.'
						</div>		 		
  		';
  	}
  	return $item;
  }  
  static function renderNotif($notification = false){
  	if($notification){
  		if ($notification["status"] == 1) {
			$class = "";
		}else{
			$class = "active";
		}
		echo '
			<div class="notif-item click-btn '.$class.'" data-item="'.$notification["id"].'">
				<div class="notif-title">
					'.(mb_substr($notification["title"], 0,100)).'
				</div>
				<div class="notif-date">
					'.(date("d-m-Y",$notification["date_added"])).'
				</div>
				<div class="notif-body">
					'.(mb_substr($notification["content"], 0, 150)).'
				</div>
			</div>			
		';
  	}
  	return false;
  }
  static function pendingNotif(){
  	$CI = &get_instance();
  	if (isset($_SESSION["user"])) {
  		$ch_items = $CI ->commonDatabase->get_data("ispa_notifications",1,false,"status",0,"user",$_SESSION["user"]->ispa_id);

  		return $ch_items ? true : false;
  	}
  	return false;
  }
  static function renderMessage($message = "", $cur_user = false){
  	$CI = &get_instance();
  	if ($cur_user && $message != "" && isset($_SESSION["user"])) {
  		if (isset($_SESSION["business"])) {
  			if ($message["sender"] == $_SESSION["business"]) {
  				$class = "ispa-message-out";  				
  			}else{
  				$class = "ispa-message-in";
  			}
  		}else{
  			if ($message["sender"] == $_SESSION["user"]->ispa_id) {
  				$class = "ispa-message-out";  				
  			}else{
  				$class = "ispa-message-in";
  			}
  		}
	 		$m = "";
	 		$m .= '
	 			<div class="'.$class.'">
					'.$message["message"].'
					<div class="chat-time">'.timespan($message["date_added"],time(),1).'</div>
				</div>
	 		';
	 		$message = $m;		
  	}
  	return $message;
  }
  static function appList($appointment = false,$mode = "fixed"){
  	if ($appointment) {
  		$CI = &get_instance();
  		$services = $CI->commonDatabase->get_data("ispa_appointment_services",false,false,"appointment_id",$appointment);
  		if ($services) {
  			$list = "";
  			foreach ($services as $service) {
  				$item = $CI->commonDatabase->get_data("ispa_services",false,false,"id",$service["service_id"]);
  				/*add something on business session up |^|*/
  				if ($item) {
  					if ($service != $services[sizeof($services) - 1]) {
  						if (sizeof($services) > 0) {
  							$list .= $item[0]["name"].",";
  						}else{
  							$list .= $item[0]["name"];
  						}
  					}else{
  						$list .= $item[0]["name"];
  					}
  				}
  			}
  			return $mode == "fixed" ? strlen($list) > 15 ? mb_substr($list, 0,15)." ...": $list: $list;
  		}else{
  			return "";
  		}
  	}else{
  		return "";
  	}
	}
	static function bus_calendar($year = false, $month = false,$day = false,$shop = false){
		$year  =  $year ? $year : date("Y");
		$month =  $month ? $month : date("m");
		$day   =  $day ? $day : date("d");
		$CI = &get_instance();
		$cur_week = 1;


		$days  =  cal_days_in_month(CAL_GREGORIAN,(Int)$month,(Int)$year);
		$cur_week = 1;
		$month_days = [];		
		$start_date = strtotime("01-".$month."-".$year);	
		$start_day  = ((Int)date("w",$start_date));						
		$month_data = "";
		$m_days = [];

		if ($start_day > 0) {
			for ($i=0; $i < $start_day; $i++) { 
				$v = [						
					"day" => ""
				];
				array_push($m_days, $v);
			}	
		}
		for ($i = 1; $i <= $days; $i++) { 
			$v = [					
				"day" => $i
			];
			array_push($m_days, $v);				
		}

		for ($i=0; $i < sizeof($m_days); $i++) {
			$v  = [
				"day" => $m_days[$i]["day"],
				"week" => $cur_week
			];	
			array_push($month_days, $v);					 
			if ($i == 6 || $i == 13 || $i == 20 || $i == 27 || $i == 34) {
				$cur_week += 1;
			}
		}

		$shop = common::getBus($shop);
		$working = json_decode($shop["working"]);

		if ($shop && sizeof($month_days) > 1 && $working) {	
			for ($i=1; $i <= $cur_week; $i++) { 										
				$month_data .= '<div class="cal-week" data-week="'.$i.'">';		
				foreach ($month_days as $date) {	
					$t_date = strtotime($date["day"]."-".$month."-".$year);
					$txt = "";
					if ($date["week"] == $i) {
						$tooltip = "";
						if ($date["day"] != "") {
							$is_working = false;	
							foreach ($working as $wd) {							
								if (strtolower($wd->day) == strtolower(date("D",$t_date))) {
									$is_working = true;
								}
							}					
							if ($is_working) {
								$tooltip = date("jS F Y",$t_date);								
								$class = "tooltipped";
								if (date("d-m-Y",$t_date) == date("d-m-Y",strtotime($day."-".$month."-".$year))) {
									$class = "tooltipped  active";															
								}						
							}else{
								$class = "past";						
							}
						}else{
							$class = "past";
						}	
						if ($date["day"] == 1 || $date["day"] == 01) {
							$class .= " ist-day";
							$txt = "<br>".strtoupper(date("M",$t_date));
						}
						$x_day = $t_date + (60 * 60 * 24);
						$a_time = strtotime(date("d-m-Y",$t_date));

						$appointments = false;
						if ($date["day"] != "") {
							$appointments = $CI->commonDatabase->get_cond("ispa_appointments","app_time >='$a_time' AND app_time < '$x_day'");
						}						
						if ($appointments) {
							$ap_cl = "seld";
						}	else{
							$ap_cl = "";
						}		
						$month_data .= '
							<div data-tooltip="'.$tooltip.'" data-position="bottom" class="'.$ap_cl.' '.$class.' cal-date" data-day="'.$day.'" data-date="'.date("d-m-Y",$t_date).'" data-month="'.$month.'" data-year="'.$year.'">'.($date["day"] == "" ? "&bull;": $date["day"]).''.$txt.'</div>
						';		
					}		
				}
				$month_data .= '</div>';
			}			
			return $month_data;
		}else{
			return false;
		}
	}
	static function monthCalendar($month = false,$year = false,$business = false,$dur = false){
		if ($month && $year) {
			$days = cal_days_in_month(CAL_GREGORIAN,(Int)$month,(Int)$year);
			$cur_week = 1;
			$month_days = [];		
			$start_date = strtotime("01-".$month."-".$year);	
			$start_day = ((Int)date("w",$start_date));						
			$month_data = "";
			$m_days = [];
			if ($start_day > 0) {
				for ($i=0; $i < $start_day; $i++) { 
					$v = [						
						"day" => ""
					];
					array_push($m_days, $v);
				}	
			}
			for ($i = 1; $i <= $days; $i++) { 
				$v = [					
					"day" => $i
				];
				array_push($m_days, $v);				
			}

			for ($i=0; $i < sizeof($m_days); $i++) {
				$v  = [
					"day" => $m_days[$i]["day"],
					"week" => $cur_week
				];	
				array_push($month_days, $v);					 
				if ($i == 6 || $i == 13 || $i == 20 || $i == 27 || $i == 34) {
					$cur_week += 1;
				}
			}
			for ($i=1; $i <= $cur_week; $i++) { 										
				$month_data .= '<div class="week" data-week="'.$i.'">';
				foreach ($month_days as $day) {
					if ($day["week"] == $i) {
						$d = (Int)$day["day"];
						$class = "";
						if ($day["day"] != "") {							
							$today = strtotime(date("d-m-Y"));
							$full_day = strtotime($d."-".$month."-".$year);
							if ($full_day >= $today) {
								if ($business && common::getBus($business)) {
									$avail = common::checkAvail($full_day,$business,$dur);									
									if ($avail) {
										/*if ($full_day == date("d-m-Y")) {
											if ($business) {
												$bus = common::getBus($business);
												if ($bus) {
													$working = json_decode($bus[0]["working"]);
													$end = $working->end;
													if (time() > startotime(date("d-m-Y H:i",strtotime(date("d-m-Y ").$working->end)))) {
														$past = true;
														$class = "past";
													}else{
														$class = "avail  tooltipped";
													}
												}else{
													$class = "past";
												}
											}else{
												$class = "avail  tooltipped";
											}
										}else{
											$class = "avail  tooltipped";
										}*/
										$class = "avail  tooltipped";										
									}else{
										$class = "past";
									}
								}else{
									$class = "avail  tooltipped";
								}						
							}else{
								$class = "past";
								$d = "";
							}
						}else{
							$class = "past";
						}
						if ($d."-".$month."-".$year == date("d-m-Y") && !isset($past)) {
							$cl = "";
						}else{
							$cl = "";
						}
						$month_data .= '
							<div data-tooltip="'.date("jS F Y",strtotime($d."-".$month."-".$year)).'" data-position="bottom" class="calendar-day '.$class.' '.$cl.' calendar-date" data-day="'.$d.'">'.($day["day"] == "" ? "&bull;": $day["day"]).'</div>
						';
						unset($past);
					}
				}
				$month_data .= '</div>';
			}
			return $month_data;	
		}else{
			return false;
		}
	}
	static function checkAvail($day = false,$business = false, $dur = false,$staff = false){
		if ($day && $business) {			
			$CI = &get_instance();
			$bus = common::getBus($business);
			if ($bus) {
				$slots = [];
				$days = json_decode($bus["working"]);				
				$is_working = false;							
				if (is_array($days)) {
					foreach ($days as $d) {											
						if (strtolower($d->day) == strtolower(date("D",$day))) {
							$is_working = true;
							$working_day = [$d->start,$d->end];
						}
					}
				}else{
					$days = false;
				}				
				if ($is_working && $days) {
					$start_day = strtotime(date("d-m-Y", $day)." ".$working_day[0]);
					$end_day = strtotime(date("d-m-Y", $day)." ".$working_day[1]);
					$appointments = common::getAppointments($day,$business,"bus",$staff,1);
					if ($appointments) {						
						$app_today = [];
						foreach ($appointments as $app) {
							$app_items = $CI->commonDatabase->get_data("ispa_appointment_services",false,false,"appointment_id",$app["identifier"]);
							$app_dur = 0;
							if ($app_items) {
								foreach ($app_items as $item) {
									$it = $CI->commonDatabase->get_data("ispa_services",1,false,"id",$item["service_id"]);
									if ($it) {
										$app_dur += (Int)$it[0]["duration"];
									}
								}								
							}							
							$v = [
								"start_time" => $app["app_time"],
								"dur" => ($app_dur * 60),
								"end_time" => $app["app_time"] + ($app_dur * 60) 
							];							
							array_push($app_today, $v);
						}

						$ch_dur = false;
						if (sizeof($app_today) > 0) {							
							$slots = [];
							for ($i=0; $i < sizeof($app_today); $i++) { 
								if (sizeof($app_today) > 1 && $i != (sizeof($app_today) - 1)) {						
									if (isset($end_slot) && $app_today[$i]["start_time"] - $end_slot > 0) {
										$s = [
											"dur" => $app_today[$i]["start_time"] - $end_slot,
											"start" => $end_slot,
											"end" => $app_today[$i]["start_time"] 
										];
										array_push($slots, $s);
									}
									$end_slot = $app_today[$i]["end_time"];
									$ch_dur = true;
								}else{
										$slots = [];										
										/*if ($app_today["start_time"] > $start_day) {
											array_push($slots, common::getSlots($start_day, $app_today[$i]["end_time"], (60 * $dur)));
										}else{
											$st = $app_today[$i]["start_time"] + (60 * $dur);
											$en = $end_day;																											
											array_push($slots,common::getSlots($st, $en, (60 * $dur))); 
										}	

										if ($app_today["end_time"] < $end_day) {
											array_push($slots,common::getSlots($app_today[$i]["end_time"], $end_day, (60 * $dur))); 
										}
										var_dump($appointments)			;
										exit();*/
								}
							}
							if (sizeof($slots) > 0) {
								if ($ch_dur) {
									$s_overflow = 0;
									$sl = [];
									foreach ($slots as $slot) {
										if ($slot["dur"] >= ($dur * 60)) {
											$s = [
												"dur" => $dur * 30,
												"start" => $slot["start"],
												"end" => $slot["start"] + $dur * 60
											];
											array_push($sl, $s);
										}
									}									
									$sll = [];
									foreach ($sl as $slot) {
										if (strtotime(date("d-m-Y h:i A",$slot["start"])) >= strtotime( date("d-m-Y ",$slot["start"])."12:00 PM")) {
											$s = "Afternoon";
										}	else{
											$s = "Morning";
										}			
										$v = [
											"start" => date("h:i A",$slot["start"]),
											"title"=> date("jS F Y",$slot["start"])." | ".date("h:i A",$slot["start"])." - ".date("H:i A",$slot["end"]),
											"date" => $slot["start"], 
											"end" => date("h:i A",$slot["end"]),
											"position" => $s						
										];
										array_push($sll, $v);										
									}
									$slots = $sll;
								}						
							}					
						}else{							
							$slots = common::getSlots($start_day, $end_day, ($dur * 60));
						}
						//
					}else{
						$slots = common::getSlots($start_day, $end_day, ($dur * 60));						
					}					
				}else{
					//not a working day
				}
			}
			return $slots;
		}		
		return false;
	}
	static function getSlots($start_time = false, $end_time = false, $dur = false){
		if ($start_time && $end_time && $dur) {
				$x = $start_time;
				$slots = [];				
				while ($x < $end_time) {						
					if (strtotime(date("d-m-Y h:i A", $x)) >= strtotime( date("d-m-Y ", $x)."12:00 PM")) {
						$s = "Afternoon";
					}	else{
						$s = "Morning";
					}			
					$v = [
						"start" => date("h:i A",$x),
						"date" => $x, 
						"title"=> date("jS F Y",$x)." | ".date("h:i A",$x)." - ".date("H:i A",$x + $dur),
						"end" => date("h:i A",$x + $dur),
						"position" => $s						
					];
					array_push($slots, $v);
					$x += $dur;
				}				
				return $slots;
		}
		return false;
	}
	static function renderSlots($slots = false,$sl_data = []){		
		if ($slots && is_array($slots) && sizeof($slots) > 0) {			
			$slot_data = "";
			$slot_data .= '
				<div class="suggest-group">
								<div class="suggest-title">Morning Hours</div>
								<div class="suggest-items row">
			';
			foreach ($slots as $slot) {
				$is_avail = false;				
				if ($slot["sl_data"]['dur'] && $slot["sl_data"]['staff'] && $slot["sl_data"]['shop'] && $slot["sl_data"]["start_time"]) {	

						$is_avail = common::checkSlot($slot["date"], $slot["sl_data"]['dur'],$slot["sl_data"]['staff'],$slot["sl_data"]['shop']);							
				}
				else{
					$is_avail = true;
				}									
				if (strtolower($slot["position"]) == "morning" && $is_avail) {					
					if (date("d-m-Y",$slot["date"]) == date("d-m-Y")) {
						if (strtotime(date("d-m-Y ",$slot["date"]).$slot["start"]) > time(date("d-m-Y H:i A"))) {							
							$slot_data .= '
									<div data-from="'.$slot["start"].'" data-tooltip="'.$slot['title'].'" class="book-suggestion tooltipped col s12 m6 l6">
										'.$slot["start"].' - '.$slot["end"].'
									</div>																								
						';
						}
					}else{						
						$slot_data .= '
								<div data-from="'.$slot["start"].'" data-tooltip="'.$slot['title'].'" class="book-suggestion tooltipped col s12 m6 l6">
									'.$slot["start"].' - '.$slot["end"].'
								</div>';								
					}
				}else{
					$af = "";					

				}
			}
			$slot_data .= '
			    </div>
				</div>
			';
			/*afternoon*/
			if (isset($af)) {
				$slot_data .= '
					<div class="suggest-group">
									<div class="suggest-title">Afternoon</div>
									<div class="suggest-items row">
				';				
				foreach ($slots as $slot) {
					$is_avail = false;
					if ($slot["sl_data"]['dur'] && $slot["sl_data"]['staff'] && $slot["sl_data"]['shop'] && $slot["sl_data"]["start_time"]) {
							$is_avail = common::checkSlot($slot["date"],$slot["sl_data"]['dur'],$slot["sl_data"]['staff'],$slot["sl_data"]['shop']);						
					}
					else{
						$is_avail = true;
					}					
					if (strtolower($slot["position"]) == "afternoon" && $is_avail) {
						if (date("d-m-Y",$slot["date"]) == date("d-m-Y")) {							
							if (strtotime(date("d-m-Y ",$slot["date"]).$slot["start"]) > time()) {
								$slot_data .= '
										<div data-from="'.$slot["start"].'" data-tooltip="'.$slot['title'].'" class="book-suggestion tooltipped col s12 m6 l6">
											'.$slot["start"].' - '.$slot["end"].'
										</div>																								
							';
							}
						}else{
							$slot_data .= '
									<div data-from="'.$slot["start"].'" data-tooltip="'.$slot['title'].'" class="book-suggestion tooltipped col s12 m6 l6">
										'.$slot["start"].' - '.$slot["end"].'
									</div>';	
						}
					}else{
						$af = "";
					}
				}	
			}	
			return $slot_data;	
		}
		else{
			return false;
		}			
	}
	static function dateString($string = false){
		if ($string) {
			$date = mb_split(" ", $_POST["time"]);
			if (sizeof($date) == 9) {
				return $date;
			}else{
				return false;
			}
		}
		return $string;
	}
	static function busServices($bus = false){
		if ($bus) {
			$CI = &get_instance();
			$services = $CI->commonDatabase->get_data("ispa_services",false,false,"added_by",$bus,"status", 1, "avail", 1);
			$sl = "";
			if ($services) {				
				foreach ($services as $service) {
					if (sizeof($services) == 1) {
						$sl .= $service["name"];
					}
					elseif($service["id"] != $services[sizeof($services) - 1]["id"]) {
						$sl .= $service["name"].", ";
					}else{
						$sl .= $service["name"];
					}
				}
			}
			return $sl;
		}
		return false;
	}
	static function busDur($bus = false, $appointment = false){
		if ($bus) {
			$CI = &get_instance();
			$appointments = $CI->commonDatabase->get_data("ispa_appointments",1,false,"identifier",$appointment);
			$serv_tot = 0;
			if ($appointments) {
				$services = $CI->commonDatabase->get_data("ispa_appointment_services",false,false,"appointment_id",$appointment);
				if ($services) {					
					foreach ($services as $serv) {
						$s = $CI->commonDatabase->get_data("ispa_services",1,false,"id",$serv["service_id"]);
						if ($s) {
							$serv_tot += $s[0]["duration"];
						}
					}
				}
			}
			$sl = $serv_tot;			
			return $sl;
		}
		return false;
	}
	static function busRating($bus = false){
		$tot_rate = 0;
		$rate_count = 0;
		if ($bus) {
			$CI = &get_instance();
			$ratings = $CI->commonDatabase->get_data("ispa_favorites",1,false,"shop",$bus);
			if ($ratings) {				
				foreach ($ratings as $rating) {
					/*$tot_rate += $rating["rating"];*/
					$rate_count += 1;
				}
			}
		}
		if ($rate_count > 0) {
			$r = number_format(($rate_count/$rate_count),1);
		}else{
			$r = 0;
		}
		$rating = [
			"rating" => $r,
			"count" => common::format_number($rate_count, 1)
		];
		return json_decode(json_encode($rating));
	}
	static function busTypes(){
		$CI = &get_instance();
		$types = $CI->commonDatabase->get_cond("ispa_business_types","1 group by name order by id ASC");
		$tp = [];
		if ($types) {
			foreach ($types as $type) {
				array_push($tp, ["name" => $type["name"],"id" => $type['id']]);
			}
		}
		return $tp;
	}
	static function renderType($type = false){
		if ($type) {
			return '<a class="explore-list-item click-btn" data-item="'.$type["id"].'">'.$type["name"].'</a>';
		}
	}
	static function renderExplore($item = false){		
		if ($item) {			
			$CI = &get_instance();
			$bus = common::getBus($item["shop"]);
			$loc = common::busLoc($item["shop"]);			
			$rating = common::busRating($item["shop"]);
			$services = common::busServices($item["shop"]);
			if ($rating->count == 1) {
				$txt = "person";
			}else{
				$txt = "people";
			}
			$fav = "";
			if (isset($_SESSION["user"])) {				
				$user = $_SESSION["user"]->ispa_id;
				$shop = $item["shop"];
				$ch_f = $CI->commonDatabase->get_data("ispa_favorites",1,false,"user", $user,"shop",$shop);
				$logo = base_url()."uploads/profiles/".$bus["profile"];
				if ($ch_f) {
					$fav = "favorite";
				}else{
					$fav = "favorite_outline";
				}
			}			
			if ($services && $bus && $loc && $rating) {				
				return '
					<div data-id="'.$item["shop"].'" class="ispa-shop click-btn">
						<div class="shop-body">
							<div class="shop-details">
								<div class="shop-name">
									'.$bus["name"].'
								</div>
								<div class="shop-loc">
									'.(strlen($loc->name) > 30 ? mb_substr($loc->name, 0,30)." ...": $loc->name).'
								</div>
								<div class="shop-servs">
									<div class="serves-title">
										Services
									</div>
									<div class="servs-list">
										'.(mb_substr($services, 0, 100)).'
									</div>
								</div>
							</div>
							<img class="shop-img" src="'.$logo.'">
						</div>
						<div class="shop-tools">
							<button class="click-btn shop-tool right">
								'.$rating->count.'
								<i class="material-icons right">'.$fav.'</i>
							</button>
						</div>
					</div>					
				';
			}
		}
	}
	static function busLoc($identifier = false){
		if ($identifier) {
			$CI = &get_instance();
			$loc = $CI->commonDatabase->get_data("ispa_business_locations",1,false,"business",$identifier);
			if ($loc) {
				return json_decode(json_encode($loc[0]));
			}else{
				return json_decode(json_encode([
							"lat" => 0,
							"lng" => 0,
							"name" => ""
						]));
			}
			return false;
		}
	}
	static function getBus($identifier = false){
		if ($identifier) {
			$CI = &get_instance();
			$bus = $CI->commonDatabase->get_data("ispa_business",1,false,"identifier",$identifier);			
			if ($bus) {
				$loc = $CI->commonDatabase->get_data("ispa_business_locations",1,false,"business",$identifier);
				if ($loc) {
					$bus[0]["loc"] = $loc[0]["name"];
				}else{
					$bus[0]["loc"] = "";
				}
				return $bus[0];
			}
			return false;
		}
		return false;
	}
	static function ci(){
		$CI = &get_instance();
		return $CI;
	}
	static function getAppointments($date = false, $user= false, $type = "bus",$staff = false,$status = 0){
		$CI = &get_instance();
		if ($date && $user) {			
			$d = $date;
			$date = strtotime($date); 
			if (date("d-m-Y",$date) == "01-01-1970") {
				$date = $d;				
			}
			$date_end = strtotime(date("d-m-Y",$date)) + (60 * 60 * 24);
			if ($type == "bus") {
				if ($staff) {
					$appointments = $CI->commonDatabase->get_cond("ispa_appointments","shop='$user' AND app_time >= '$date' AND app_time <= '$date_end' AND status='$status' AND staff_id='$staff' order by app_time ASC");
				}else{
					$appointments = $CI->commonDatabase->get_cond("ispa_appointments","shop='$user' AND app_time >= '$date' AND app_time <= '$date_end'  AND status='$status' order by app_time ASC");
				}											
			}else{
				$appointments = $CI->commonDatabase->get_cond("ispa_appointments","user='$user' AND app_time >= '$date' AND app_time <= '$date_end' AND status='0' order by app_time ASC");
			}
			if ($appointments) {				
				return $appointments;				
			}
			return false;
		}
		return false;
	}	
	static function renderService($service = false,$type = "client", $selected = false){
		if ($service) {
			$serv = $service;
			if ($type == "client") {
				if ($selected) {
					$cl = 'active';
					$txt = "done";
					$vl = true;
				}else{
					$cl = "";
					$txt = "";
					$vl = false;
				}
				return '
						<div class="bs-service-item click-btn" data-amount="'.$serv["cost"].'" data-amount="'.$serv["cost"].'" data-duration="'.$serv["duration"].'" data-item="'.$serv["id"].'">
							<div class="service-item-name">
								<div class="service-item-name-box">
									'.$serv["name"].'
								</div>
							</div>
							<div class="service-item-detail">
								<div class="service-item-detail-item">
									Ksh. '.(number_format((Int)$serv["cost"],2)).'
								</div>
								<div class="service-item-detail-item">
									'.$serv["duration"].' Min
								</div>									
							</div>
							<div value="'.$vl.'" class="service-select '.$cl.'">
								<i class="material-icons">done</i>
							</div>
						</div>				
					';
			}else{
				if ($service["avail"] == 1) {
					$av = "Available";
				}else{
					$av = "Not available";
				}

				return '
					<div class="bs-serv" data-item="'.$serv["id"].'">
						<div class="serv-dets">
							<div class="serv-n">
								'.$serv["name"].'
							</div>
							<div class="serv-cost">
								Ksh. '.(number_format((Int)$serv["cost"],2)).'
							</div>
							<div class="serv-dur">
								'.$serv["duration"].' Min
							</div>
							<div class="serv-av">
								'.$av.' for booking
							</div>
						</div>
						<div class="serv-tools">
							<button class="click-btn serv-tool edit-serv">
								<i class="material-icons">settings</i>
							</button>
							<button class="click-btn serv-tool del-serv">
								<i class="material-icons">delete</i>
							</button>
						</div>
					</div>
				';
			}
		}
		return false;
	}
	static function checkSlot($day = false, $dur = false, $staff = false,$business = false,$editing = false){	
		if ($day && $dur && $staff && $business) {

			$CI = &get_instance();
			$ch_staff = $CI->commonDatabase->get_data("ispa_staff",1,false,"ispa_id",$staff,"business",$business,'availability',1);			
			if ($staff) {
				$slot_booked = false;
				$appointments = common::getAppointments($day,$business,"bus",$staff);				
				if ($appointments) {
				 	foreach ($appointments as $apt) {
				 		$ap_dur = 0;
				 		$app_items = $CI->commonDatabase->get_data("ispa_appointment_services",false,false,"appointment_id",$apt["identifier"]);
				 		if ($app_items) {
				 			foreach ($app_items as $item) {
				 				$service = $CI->commonDatabase->get_data("ispa_services",1,false,"id",$item["service_id"],"added_by",$business);
				 				if ($service) {
				 					$ap_dur += (Int)$service[0]["duration"];
				 				}
				 			}
				 		}
				 		$end  = $apt["app_time"] + ($ap_dur * 60);
				 		
				 		if (((int)$apt["app_time"] >= $day && $end <= ($day + ($ap_dur * 60))) || $day < time() || ($apt["identifier"] == $editing)) {
				 			$slot_booked = true;
				 		}
				 	}
				 	return $slot_booked;
				}else{					
					return true;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	static function getServices($shop = false){
		if ($shop) {
			$CI = &get_instance();
			$services = $CI->commonDatabase->get_data("ispa_services", false, false, "added_by", $shop, "status", 1);
			if ($services) {
				$s_list = "";
				foreach ($services as $serv) {
					$s_list .= common::renderService($serv,"bus");
				}

				return $s_list;
			}
			return [];
		}
		return false;
	}
	static function busServ($serv = false){
		$s = "";
		if ($serv) {
			$s .= '
				<div class="bs-service-item click-btn" data-amount="'.$serv["cost"].'" data-amount="'.$serv["cost"].'" data-duration="'.$serv["duration"].'" data-item="'.$serv["id"].'">
					<div class="service-item-name">
						<div class="service-item-name-box">
							'.$serv["name"].'
						</div>
					</div>
					<div class="service-item-detail">
						<div class="service-item-detail-item">
							Ksh. '.(number_format((Int)$serv["cost"],2)).'
						</div>
						<div class="service-item-detail-item">
							'.$serv["duration"].' Min
						</div>									
					</div>
					<div value="false" class="service-select">
						<i class="material-icons">done</i>
					</div>
				</div>				
			';
		}
		return $s;
	}
	static function checkPay($user = false, $amount = false){
		if ($user && $amount) {
			$CI = &get_instance();
			/* implement mpesa */
		}
		return false;
	}
	static function renderReview($rev = false){
		if ($rev) {
			$CI = &get_instance();
			if ($rev["note"] != "") {
				$u = $rev["user"];
				$user = $CI->commonDatabase->get_cond("ispa_users","ispa_id='$u' or email='$u' limit 1");
				if ($user) {
					$user = $user[0];
					return '
						<div class="review-item">
							<img src="'.base_url("uploads/profiles/".$user["profile"]).'" alt="" class="rev-profile">
							<div class="rating-more">
								<div class="user-details">
									<div class="review-name">'.$user["name"].'</div>
									<div class="rating-date">'.timespan($rev["date_added"],time(),1).'</div>
									<div class="rating-rated">'.$rev["rating"].'</div>
								</div>
								<div class="rating-comment">
									'.$rev["note"].'
								</div>
							</div>								
						</div>
					';
				}
			}
		}
	}	
	static function renderLookup($lookup = false){
		if ($lookup) {
			return '<div class="filled-item" data-item="'.$lookup["id"].'">'.$lookup["name"].'</div>';
		}

		return $lookup;
	}

	static function renderAppointment($appointment = false){
		if ($appointment) {
			$CI = &get_instance();
			$time = time();
			$class = "";
			$cancel = "";			
			$c_btn = '<button data-tooltip="Cancel appointment" data-position="left" class="appointment-tool rem-appointment tooltipped  click-btn">
								<i class="material-icons">delete</i>
							</button>';
			if ($appointment["status"] == 1) {
				$status = "DONE";
				$text =  "d-done";
				$class = "hidden";
				$s_class = "s-done";
			}else{									
				if ($appointment["status"] == 2) {
					$text = "d-can";
					$class = "hidden";
					$s_class = "s-can";
					$status = "MISSED";
				}else{
					if ($appointment["confirmed"] == 1) {
						$text = "d-con";
						$status = "CONFIRMED";
						$class = ""; 
						$cancel = $c_btn;
						$s_class = "s-con";
					}else{
						if ($appointment["confirmed"] == 2) {
							$text = "d-can";
							$status = "CANCELLED";
							$class = "";
							$cancel = $c_btn;
							$s_class = "s-can";								
						}else{
							$text = "d-pend";
							$status = "PENDING CONFIRMATION";
							$class = "";
							$cancel = $c_btn;
							$s_class = "s-pend";
						}
					}
				}
			}
			$s_ = $text;
			$text = $status;
			$status = $s_;

			$shop = $CI->commonDatabase->get_data("ispa_business",1,false,"identifier",$appointment["shop"]);
			if (!$shop) {
				return false;
			}
			$shop = $shop[0]["name"];
			$services = $CI->commonDatabase->get_data("ispa_appointment_services",false,false,"appointment_id",$appointment["identifier"]);
			if (!$services) {
				return false;
			}
			$ss = "";
			foreach ($services as $serv) {
				$s = $CI->commonDatabase->get_data("ispa_services",1,false,"id", $serv["service_id"]);
				$s = $s[0];
				$ss .= sizeof($services) == 1 ? $s["name"] : $serv["service_id"] == $services[sizeof($services) -1]["service_id"] ? $s["name"] : $s["name"].", ";
			}			
			return '
					<div class="ispa-appointments-item click-btn '.$status.'" data-item="'.$appointment["identifier"].'">
						<div class="appointment-timing">
							<div class="timing-item">'.date("M",$appointment["app_time"]).'</div>
							<div class="timing-item">'.date("jS",$appointment["app_time"]).'</div>
							<div class="timing-item">'.date("H:i",$appointment["app_time"]).'</div>
						</div>
						<div class="appointment-details">
							<div class="appointment-shop">
								'.$shop.'
							</div>
							<div class="appointment-status '.$status.'">
								'.$text.'
							</div>					
							<div class="appointment-servs">
								'.(mb_strlen($ss) > 25 ? mb_substr($ss, 0, 25)." ...": $ss).'
							</div>
						</div>
						<div class="appointment-tools">
							<button data-tooltip="View appointment" data-position="left" class="appointment-tool tooltipped click-btn">
								<i class="material-icons">more_horiz</i>
							</button>							
						</div>
					</div>			
					';

		}
		return $appointment;
	}	
	static function getWorking($day = false, $type = "next",$bus = false){
	 	if ($day && $bus) {
	 		if ($type == "next" || $type == "cur") {
	 			$n_day = $day + (60 * 60 * 24);
	 		}else{
	 			$n_day = $day - (60 * 60 * 24);
	 		}

	 		$shop = common::getBus($bus);
	 		$working = json_decode($shop["working"]);			
			$is_working = false;
			foreach ($working as $wk) {
				if (strtolower($wk->day) == strtolower(date("D",$day))) {
					$is_working = true;
				}
			}
			if ($is_working) {
				return $day;
			}else{
				 return common::getWorking($n_day,$type,$bus);
			}
	 	}
	 	return false;
	}
	static function renderDay($app = false,$day = false,$bus = false){
		if ($app && $day && $bus) {
			$CI = &get_instance();
			$services =  $CI->commonDatabase->get_data("ispa_appointment_services",false,false,"appointment_id",$app["identifier"]);
			$time = strtotime($day);
			$next_day = $time + (60 * 60 *24) - 1;
			$servs = "";			
			if ($services) {
				foreach ($services as $service) {
					$s = $CI->commonDatabase->get_data("ispa_services",1,false,"id",$service["service_id"]);
					if ($s) {
						if (sizeof($services) == 1) {
							$servs .= $s[0]["name"];
						}
						elseif($s[0]["id"] != $services[sizeof($services) - 1]["service_id"]) {
							$servs .= $s[0]["name"].", ";
						}else{
							$servs .= $s[0]["name"];
						}
					}
				}
			}
			$services = $servs;
			$user = $CI->commonDatabase->get_data("ispa_users",false,false,"ispa_id",$app["user"]);				  		
			$dur = common::busDur($bus,$app["identifier"]) * 60;
			$staff = $CI->commonDatabase->get_data("ispa_staff", 1, false, "ispa_id", $app["staff_id"]);

			if ($staff) {
				$u = $CI->commonDatabase->get_data("ispa_users", 1, false, "ispa_id", $staff[0]["ispa_id"]);
				if ($u) {
					$staff = "<span class='staff-ind'>&raquo; </span>".$u[0]["name"];
				}else{
					$staff = "";
				}
			}else{
				$staff = "";
			}
			$s_ = "";	
			$start = date("h:i A",$app["app_time"]);
			$end  = date("h:i A",$app["app_time"] + $dur);
			$class = "";								
			$appointment = $app;
			$time = time();
			$btns = '';
			$s_class = '';
			$text = "";
			if ($user) {				
				if ($appointment["status"] == 1) {
					$status = "DONE";
					$text =  "d-done";
					$class = "hidden";
					$s_class = "s-done";
				}else{									
					if ($appointment["status"] == 2) {
						$text = "d-can";
						$class = "hidden";
						$s_class = "s-can";
						$status = "MISSED";
					}else{
						if ($appointment["confirmed"] == 1) {
							$text = "d-con";
							$status = "CONFIRMED";
							$class = "";
							$s_class = "s-con";
						}else{
							if ($appointment["confirmed"] == 2) {
								$text = "d-can";
								$status = "CANCELLED";
								$class = "";
								$s_class = "s-can";								
							}else{
								$text = "d-pend";
								$status = "PENDING CONFIRMATION";
								$class = "";
								$s_class = "s-pend";
							}
						}
					}
				}
				$s_ = $text;
				$text = $status;
				$status = $s_;
			}			
			return '
				<div class="day-group '.$s_.'" data-item="'.$app["identifier"].'">
					<div class="day-times">
						<div class="day-start">'.$start.'</div>
						<div class="day-margin"></div>
						<div class="day-end">'.$end.'</div>
					</div>
					<div class="day-detail">
						<div class="day-detail-item">'.$user[0]["name"].'  <small class="day-status '.$s_class.'">'.$text.'</small></div>
						<div class="day-detail-item detail-serv">'.$services.'</div>
						<div class="day-tools">											
							'.$staff.'
						</div>
					</div>
				</div>
			';
		}
		return false;
	}	
	static function checkout($user = false,$transaction = false,$disc = 0){
		$CI = &get_instance();
		$u = $CI->commonDatabase->get_data("ispa_users",1,false,"ispa_id",$user);
		if ($user && $transaction) {
			$wallet = wallet::balance($user);
			$bus_wal = wallet::balance($transaction["paid"]);
			$bus = common::getBus($transaction["paid"]);			
			if ($wallet && $bus_wal && $bus && $u) {				
				$total = ($transaction["amount"] - $disc);
				$bal = $wallet->balance += $disc;				

				$u_wal = [
					"balance" => $bal,					
				];

				$s_wal = [
					"balance" => $bus_wal->balance + $total,					
				];

				$t_data = [
					"disc" => $disc,
					"amount" => $total,
					"state" => 1
				];

				$CI->commonDatabase->update("ispa_wallet",$u_wal,"account",$user);
				$CI->commonDatabase->update("ispa_wallet",$s_wal,"account",$transaction["paid"]);
				$CI->commonDatabase->update("ispa_transactions",$t_data,"id",$transaction["id"]);

									
				common::notify($bus["identifier"],"Confirmed Ksh. ".$total." Received from ".$u[0]["name"],"Payment");
				common::notify($user,"Confirmed Ksh. ".$total." Paid to ".$bus["name"],"Payment");
				return true;
			}
		}
		return false;
	}
	static function notify($user = false, $notif = false,$title = false){
		$CI = &get_instance();
		if ($user && $notif && $title) {
			$not_data = [
				"user" => $user,
				"title" => $title,
				"content" => $notif,
				"date_added" => time(),
				"status" => 0
			];				
			$CI->commonDatabase->add("ispa_notifications",$not_data);
		}
	}
	static function refund($pp = false){
		$CI = &get_instance();
		if ($app) {
			$appointment = $CI->commonDatabase->get_data("ispa_appointments",1,false,"identifier",$app);
			if ($appointment) {
				$transaction = $CI->commonDatabase->get_data("ispa_transactions",1,false,"appointment_id",$app,"state",0);
				if ($transaction) {
					$amount = $transaction[0]["amount"];
					$bal = wallet::balance($appointment[0]["user"]);
					if ($bal) {
						$bal = $bal + $amount;
						$data = ["balance" => $bal];
						$CI->commonDatabase->update("ispa_wallet",$data,"account",$appointment[0]["user"]);
						$data = ["state" => 2];
						$CI->commonDatabase->update("ispa_transactions",$data,"id",$transaction[0]["id"]);
					}					
				}
			}
		}
	}
	static function isPOST($method = false){     
      if ($method == 'POST') {
         return true;
      }
      return false;
  }
  static function staffCount($appointments = false){
  	$r = ["count" => 0, "amnt" => 0];
  	if ($appointments) {
  		$CI = &get_instance();
  		foreach ($appointments as $appointment) {
				$txn = $CI->commonDatabase->get_data("ispa_transactions",1,false,"appointment_id",$appointment["identifier"]);
				$r["count"] += 1;
				if ($txn) {  					
					$r["amnt"] += $txn[0]["amount"];
				}
			}
  	}
  	return json_decode(json_encode($r));
  }
  static function renderStaff($staff = false){
  	$st = $staff;
  	$CI = &get_instance();
  	if ($staff && isset($_SESSION['business'])) {
  		$bus = $_SESSION["business"];
  		$appointments = $CI->commonDatabase->get_data("ispa_appointments",false,false,"staff_id",$staff["ispa_id"],"shop",$bus,"status",1);
  		$bus   = common::getBus($bus);
  		$count = 0;
  		$amnt  = 0;
  		if ($appointments) {
  			$staff_count = common::staffCount($appointments);
  			$count =  $staff_count->count;
  			$amnt  =  $staff_count->amnt;  			
  		}
  		$user = $CI->commonDatabase->get_data("ispa_users",1,false,"ispa_id",$staff["ispa_id"]);
  		if ($user && $bus) {
  			 $txt = "";
  			 $btn = '<button class="right click-btn del-staff">
									<i class="material-icons">delete</i>
								</button>';
  			if ($bus["created_by"] == $staff["ispa_id"]) {
  				$txt = " - Account Owner";
  				$btn = "";
  			}
  			$sel = '
  				<select class="browser-default ispa-in sel-month">
  					<option selected value="all-time">All time</option>';						
						$s = 1;
						while ($s < 13) {
						 	if ($s == date("m")) {
						 		$sel .= '<option value="'.date("M",strtotime("01-".$s."-".date("Y"))).'">'.date("F",strtotime("01-".$s."-".date("Y"))).'</option>';
						 	}else{
						 		$sel .= '<option value="'.date("M",strtotime("01-".$s."-".date("Y"))).'">'.date("F",strtotime("01-".$s."-".date("Y"))).'</option>';
						 	}
						 	$s += 1;
						 } 						 
					$sel .= '</select>
  			';
  			if ($staff["availability"] == 1) {
  				$attr = "checked='true'";
  				$val = "true";
  			}else{
  				$val = "false";
  				$attr = "";
  			}
  			return '
  				<div class="staff click-btn" data-item="'.$staff["ispa_id"].'">
					<div class="staf-img">
						<img src="'.base_url("uploads/profiles/".$user[0]["profile"]).'" alt="user-profile" class="stf-prof">
					</div>
					<div class="stf-content">
						'.$user[0]["name"].$txt.'
					</div>
				</div>  				
  			';
  		}
  	}
  	return $st;
  }
  static function isStaff($user = false, $bus = false, $role = "normal"){
  	if ($user && $bus) {
  		$CI  = &get_instance();
  		$bus = common::getBus($bus);
  		if ($bus) {
  			$staff = $CI->commonDatabase->get_data("ispa_staff",1,false,"ispa_id",$user,"business",$bus["identifier"]);
  			if ($staff) {
  				if ($role == "admin") {
  					if ($user == $bus["created_by"]) {
  						return true;
  					}
  				}else{
  					return true;
  				}
  			}else{
  				if ($user == $bus["created_by"]) {
					return true;
				}
  			}
  		}
  	}
  	return false;
  }
  static function renderSt($user = false){
  	$r = '';
  	if ($user) {
  		$prof = base_url("uploads/profiles/".$user["profile"]);
  		return '
				<div data-name="'.$user["name"].'" class="suggested-staff" data-item="'.$user["id"].'">
					<img src="'.$prof.'" alt="" class="suggested-staff-img">
					<div class="suggested-staff-details">'.$user["name"].'</div>
				</div>
  		';
  	}
  	return $r;
  }
  static function renderShowcase($img = false){
  	if ($img) {
  		$date = date("jS F Y",$img["date_added"]);
  		$link = base_url("uploads/showcase/".$img["link"]);
  		return '
  				<div data-item="'.$img["id"].'"  data-caption="'.$img["notes"].'" data-date="'.$date.'" class="g-item click-btn col s6 m6 l4">
					<div class="g-ind click-btn"><i class="material-icons">done</i></div>
					<img src="'.$link.'" alt="'.(mb_strlen($img["notes"]) > 1 ? $img["notes"]: "gallery-image").'" class="g-img">
				</div>  				
  		';  		
  	}
  	return false;
  }
 }
 ?>