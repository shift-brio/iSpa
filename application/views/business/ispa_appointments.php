<div class="ispa_bus_appointments row">
	<div class="col s12 m2 l3"></div>
	<div class="col s12 m8 l6 appointments_cont">
		<?php 
			$bus = $_SESSION["business"];
			$yesterday = strtotime(date("d-m-Y")) - (60 * 60 * 24);
			$day = common::getWorking($yesterday,"next",$bus);
			$this->load->view("business/appointments_calendar",["date" => date("d-m-Y")]);			
		  $time = strtotime($day);
		  $next_day = $time + (60 * 60 *24) - 1;		  
		  $appointments = $this->commonDatabase->get_cond("ispa_appointments","shop='$bus' AND app_time >= '$time' AND app_time <= '$next_day' order by app_time ASC");
		  $app_tot = $appointments && sizeof($appointments) > 0 ? sizeof($appointments) : "";
		 ?>
		<div class="day-appointments">
			<div class="day-appointments-head">
				<small class="app-tot"><?php echo $app_tot; ?></small> APPOINTMENTS
			</div>
			<div class="day-appointments-body">
				<?php				  
				  if ($appointments) {
				  	foreach ($appointments as $app) {
				  		echo common::renderDay($app,$day,$bus);
				  	}
				  }else{
				  	if (strtotime("d-m-Y",$day) == strtotime("d-m-Y")) {
				  		echo '<div class="flow-text center">No appointments today yet</div>';
				  	}else{
				  		echo '<div class="flow-text center">No appointments yet</div>';
				  	}
				  }
				 ?>
			</div>
			<div class="appointment-bottom">
				<button class="walk-in click-btn">
					New sale
					<i class="material-icons right">add_circle_outline</i>
				</button>
			</div>
		</div>
	</div>
	<div class="col s12 m2 l3"></div>
</div>
<?php $this->load->view("business/ispa_business_appointment");  ?>
<div class="appoint-loader">
	<div class="appoint-loader-in"></div>
</div>

<?php echo $this->load->view("components/row_holder",["p" => "open", "id" => "ispa-appt-b"], true); ?>
	<div class="modal-top">
		<button disabled="disabled" class="app-bar"/>
	</div>
	<div class="modal-body bus-appt-body">
		<div class="modal-title lato appt-title">
			Client Appointment
		</div>
		<div class="modal-content">
			<div class="appt-content">
				<div class="appt-in">
					<label class="input-label">Client Name</label>
					<div class="input-content">
						Brian Oriwo
					</div>
				</div>				
				<div class="appt-in">
					<label class="input-label">Date</label>
					<div class="input-content date-sel click-btn">
						<?php echo date("jS F Y"); ?> , 10:30 AM
					</div>
				</div>
				<div class="appt-in">
					<label class="input-label">Services booked</label>
					<div class="input-content service-list">
						<div class="bs-service-item click-btn" data-amount="150" data-duration="20" data-item="1">		
							<div class="service-item-name">
								<div class="service-item-name-box">
									Manicure
								</div>
							</div>
							<div class="service-item-detail">
								<div class="service-item-detail-item">
									Ksh. 150.00
								</div>
								<div class="service-item-detail-item">
									20 Min
								</div>									
							</div>
							<div value="false" class="service-select active">
								<i class="material-icons">done</i>
							</div>
						</div>
						<div class="bs-service-item click-btn" data-amount="150" data-duration="20" data-item="1">		
							<div class="service-item-name">
								<div class="service-item-name-box">
									Manicure
								</div>
							</div>
							<div class="service-item-detail">
								<div class="service-item-detail-item">
									Ksh. 150.00
								</div>
								<div class="service-item-detail-item">
									20 Min
								</div>									
							</div>
							<div value="false" class="service-select active">
								<i class="material-icons">done</i>
							</div>
						</div>
					</div>
				</div>
				<div class="appt-in">
					<label class="input-label">
						Payment
						<label class="right payable">Ksh. 300.00</label>
					</label>
					<div class="input-content">
						Cash, Not paid						
					</div>
				</div>
				<div class="appt-in">
					<br>
					<label class="input-label"></label>
					<div class="input-content">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit.
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-tools">
		<button class="modal-tool left click-btn close">
			<i class="material-icons">arrow_back</i>
		</button>
		<div class="appt-tools in-f">			
			<button id="appt-done" class="bus-appt-tool click-btn">
				Complete
				<i class="material-icons right">done</i>				
			</button>
			<button id="appt-more" class="bus-appt-tool click-btn">
				More
				<i class="material-icons right">expand_less</i>				
			</button>
		</div>
		<div class="more-tools">
			<button class="left click-btn close-more">
				<i class="material-icons">expand_more</i>
			</button>
			<button id="appt-can" class="more-tool click-btn">
				Cancel
				<i class="material-icons right">close</i>
			</button>
			<button id="appt-con" class="more-tool click-btn">
				Confirm
				<i class="material-icons right">done</i>	
			</button>
		</div>
	</div>
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>

<!-- walk-in client -->
<?php echo $this->load->view("components/row_holder",["p" => "open", "id" => "ispa-walk"], true); ?>	
	<div class="modal-body walk-body">
		<div class="modal-title lato appt-title">
			New walk-in client
		</div>
		<div class="modal-content">
			<div class="appt-content">											
				<div class="appt-in">
					<label class="input-label">Services offered</label>
					<div class="input-content service-list">
						<div class="bs-service-item click-btn" data-amount="150" data-duration="20" data-item="1">		
							<div class="service-item-name">
								<div class="service-item-name-box">
									Manicure
								</div>
							</div>
							<div class="service-item-detail">
								<div class="service-item-detail-item">
									Ksh. 150.00
								</div>
								<div class="service-item-detail-item">
									20 Min
								</div>									
							</div>
							<div value="false" class="service-select active">
								<i class="material-icons">done</i>
							</div>
						</div>
						<div class="bs-service-item click-btn" data-amount="150" data-duration="20" data-item="1">		
							<div class="service-item-name">
								<div class="service-item-name-box">
									Manicure
								</div>
							</div>
							<div class="service-item-detail">
								<div class="service-item-detail-item">
									Ksh. 150.00
								</div>
								<div class="service-item-detail-item">
									20 Min
								</div>									
							</div>
							<div value="false" class="service-select active">
								<i class="material-icons">done</i>
							</div>
						</div>
					</div>
				</div>
				<div class="appt-in">
					<label class="input-label">
						Total
						<label class="right payable">Ksh. 300.00</label>
					</label>					
				</div>				
			</div>
		</div>
	</div>
	<div class="modal-tools">
		<button class="modal-tool left click-btn close">
			<i class="material-icons">arrow_back</i>
		</button>
		<div class="appt-tools in-f">			
			<button id="appt-done" class="bus-appt-tool click-btn">
				Complete
				<i class="material-icons right">done</i>				
			</button>			
		</div>		
	</div>
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>