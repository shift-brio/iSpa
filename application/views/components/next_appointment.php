<div class="next-appointment">
	<div class="next-appointment-head">
		Next Appointment
		<button class="next-ap-tool app-drawer material-icons click-btn">fullscreen</button>
	</div>
	<div class="next-appointment-body">
		<?php 
			$user = $_SESSION["user"]->ispa_id;
			$time = time();
			$allowance = time() - (10 * 60);
			$appointment = $this->commonDatabase->get_cond("ispa_appointments","status = '0' AND confirmed='1' AND app_time >= '$time' AND user='$user' order by app_time ASC limit 1");			
			if ($appointment) {
				$bus = $this->commonDatabase->get_data("ispa_business",1,false,"identifier",$appointment[sizeof($appointment) - 1]["shop"]);
				$apt = $appointment[0];
				if ($bus) {
					echo '
					<div  class="next-ap-drawer flow-text">
						'.(timespan(time(),$apt["app_time"],1)).'<br>
						<small>'.$bus[0]["name"].'</small>							
					</div>
					<div class="next-ap-item" data-item="'.$apt["identifier"].'">
							<i class="material-icons">access_time</i>
							<div class="next-ap-item-desc flow-text">'.(date('d-m-Y H:i:s A',$apt["app_time"])).'</div>
						</div>
						<div class="next-ap-item">
							<i class="material-icons">location_on</i>
							<div class="next-ap-item-desc">'.$bus[0]["name"].'</div>
						</div>
						<div class="next-ap-item">
							<div class="next-ap-item-list">'.(common::appList($apt["identifier"],"fixed")).'</div>
						</div>
						<div class="next-ap-item">
							<div class="next-ap-tools">
								<button data-tooltip="Change appointment time" data-position="top" class="tooltipped click-btn next-ap-tool ch-apt material-icons">more_horiz</button>
								<button data-tooltip="Cancel appointment" data-position="top" class="tooltipped click-btn red-text del-apt next-ap-tool material-icons">delete</button>
								<button data-tooltip="New appointment" data-position="top" class="tooltipped click-btn green-text next-ap-tool material-icons">add</button>
							</div>
						</div>
					';
				}
			}else{
				echo '
						<div style="display:none;" class="next-ap-drawer flow-text">
							No upcoming	appointment
						</div>
						<div style="display:block;" class="next-app-list">
							<div class="next-ap-item">								
								<div class="white-text center flow-text">No upcoming appointment</div>
							</div>
								<div class="next-ap-item">
									<div class="next-ap-tools">										
										<button data-tooltip="New appointment" data-position="top" class="tooltipped click-btn green-text next-ap-tool material-icons">add</button>
									</div>
								</div>			
						</div>
				';
			}
		 ?>					
	</div>
</div>