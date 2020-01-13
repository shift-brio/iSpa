<div class="ispa-appointments">
	<div class="ispa-appointments-head">
		<div class="appointments-title">MY APPOINTMENTS</div>		
	</div>
	<div class="ispa-appointments-body row">
		<div class="col s12 m2 l3"></div>
		<div class="col s12 m8 l6 ispa-appointments-cont">			
				<?php
					if (isset($_SESSION["user"])) {
						$user = $_SESSION["user"]->ispa_id;
						$appointments = $this->commonDatabase->get_cond("ispa_appointments","user = '$user' order by app_time ASC");
						if ($appointments) {
							echo '<div class="ispa-appointments-group">
											<div class="ispa-appointments-group-title">
												UPCOMING
											</div>
											<div class="ispa-appointments-group-body">';
							foreach ($appointments as $appointment) {
								if ($appointment["app_time"] > time()) {
									echo common::renderAppointment($appointment);
								}
							}
							echo 		'</div>
										</div>	';

							echo '<div class="ispa-appointments-group">
											<div class="ispa-appointments-group-title">
												PAST
											</div>
											<div class="ispa-appointments-group-body">';

							$appointments = $this->commonDatabase->get_cond("ispa_appointments","user = '$user' order by app_time DESC");											
							foreach ($appointments as $appointment) {
								if ($appointment["app_time"] <= time()) {
									echo common::renderAppointment($appointment);
								}
							}
							echo 		'</div>
										</div>	';
						}else{
							echo '<div class="flow-text center white-text">You haven'."'".'t made any appointments yet</div>';
						}
					}
				 ?>				 							
		</div>
		<div class="col s12 m2 l3"></div>
	</div>
</div>