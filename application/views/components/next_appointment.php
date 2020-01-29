<?php 
	$user = $_SESSION["user"]->ispa_id;
	$time = time();
	$allowance = time() - (10 * 60);
	$appointment = $this->commonDatabase->get_cond("ispa_appointments","status = '0' AND (confirmed = '0' or confirmed = '1') AND app_time >= '$time' AND user='$user' order by app_time DESC limit 1");	
	$no_img = base_url("uploads/system/cal3.png");
	if ($appointment) {		
		$apt = $appointment[0];		
		echo common::renderAppointment($apt);
	}else{
		echo '<div class="c-sche">
					<img src="'.$no_img.'" alt="no upcoming" class="upc-img">
				</div>
		';
	}
?>		