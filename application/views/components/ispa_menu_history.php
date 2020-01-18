<?php 
	$user = $_SESSION["user"]->ispa_id;
	$time = time();
	$allowance = time() - (10 * 60);
	$appts = $this->commonDatabase->get_cond("ispa_appointments","user='$user' order by app_time ASC limit 1");	
	$no_img = base_url("uploads/system/cal1.png");	
?>		
<div class="history">
	<div class="hist-top">
		<div aria-label="Upcoming appointments" class="modal-title upcoming">
			Upcoming
		</div>
		<div class="hist-list">
			<?php 
				$upc = 0;
				if ($appts) {					
					foreach ($appts as $apt) {
						if ($apt["app_time"] >= time()) {							
							echo common::renderAppointment($apt);
						}
					}
				}

				if ($upc == 0) {
					echo '<div class="c-sche">
								<img src="'.$no_img.'" alt="no upcoming" class="upc-img">
							</div>
					';
				}
			?>
		</div>
	</div>
	<div class="hist-bottom">
		<div aria-label="Upcoming appointments" class="modal-title past">
			Past
		</div>
		<div class="hist-list">
			<?php 
				if ($appts) {					
					foreach ($appts as $apt) {
						if ($apt["app_time"] < time()) {							
							echo common::renderAppointment($apt);
						}
					}
				}else{
					if ($upc == 0 ) {
						echo "<div class='flow-text center no-fav'>You have not made any appointments yet</div>";
					}
				}
			?>
		</div>
	</div>
</div>