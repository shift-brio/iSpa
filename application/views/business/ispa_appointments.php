<div class="ispa_bus_appointments row">
	<div class="col s12 m2 l3"></div>
	<div class="col s12 m8 l6 appointments_cont">
		<?php 
			$bus = $_SESSION["business"];
			$yesterday = strtotime(date("d-m-Y")) - (60 * 60 * 24);
			$day = common::getWorking($yesterday,"cur",$bus);
				$this->load->view("business/appointments_calendar",["date" => date("d-m-Y")]);			
			$time = strtotime(date("d-m-Y"), $day);
			$next_day = $time + (60 * 60 *24) - 1;		  
			$appointments = $this->commonDatabase->get_cond("ispa_appointments","shop='$bus' AND app_time >= '$time' AND app_time <= '$next_day' order by app_time DESC");
			$app_tot = $appointments && sizeof($appointments) > 0 ? sizeof($appointments) : 0;
		 ?>
		<div class="day-appointments">
			<div class="day-appointments-head">
				<span class="app-tot badge new"><?php echo $app_tot; ?></span> APPOINTMENTS
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
					Walk In Client
					<i class="material-icons right">add_circle_outline</i>
				</button>
				<button class="cal-draw click-btn">
					<i class="material-icons">swap_vert</i>
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
		<button disabled="disabled" class="app-bar appt-bar"/>
	</div>
	<div class="modal-body bus-appt-body">
		<div class="modal-title lato appt-title">
			Client Appointment
		</div>
		<div class="modal-content">
			<div class="appt-content">
				<div class="appt-in">
					<label class="input-label">Client Name</label>
					<div class="input-content appt-user">
						
					</div>
				</div>				
				<div class="appt-in">
					<label class="input-label">Date</label>
					<div class="input-content date-sel click-btn">
						
					</div>
				</div>
				<div class="appt-in">
					<label class="input-label">Services booked</label>
					<div class="input-content service-list">
						
					</div>
				</div>
				<div class="appt-in">
					<label class="input-label">
						Payment
						<label class="right payable appt-payable"></label>
					</label>
					<div class="appt-in">  					
						<p>
							<input  data-field="appt-paid" checked="checked" value="true" type="checkbox" class="spend-input filled-in appt-paid" id="appt-paid" />
							<label for="appt-paid">Payment made?</label>
						</p>               
					</div>
				</div>				
				<div class="appt-in">
					<br>
					<label class="input-label"></label>
					<div class="input-content">
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-tools">
		<button class="modal-tool left click-btn close cls-bs-appt">
			<i class="material-icons">arrow_back</i>
		</button>
		<div class="appt-tools in-f">			
			<button id="appt-done" class="bus-appt-tool click-btn">
				Complete
				<i class="material-icons right">done</i>				
			</button>			
		</div>
		<div class="more-tools">
			<button class="left click-btn close-more">
				<i class="material-icons">arrow_back</i>
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
					<div class="input-content service-list walk-list">
						
					</div>
				</div>
				<div class="appt-in">
					<label class="input-label">
						Total
						<label class="right payable wlk-p"></label>
					</label>					
				</div>
				<div class="divider"></div>
				<div class="appt-in">  					
					<p class="center">
						<input  data-field="walk-paid" checked="checked" value="true" type="checkbox" class="spend-input filled-in walk-paid" id="walk-paid" />
						<label for="walk-paid">Services paid for?</label>
					</p>               
				</div>				
			</div>
		</div>
	</div>
	<div class="modal-tools">
		<button class="modal-tool left click-btn close cls-walk">
			<i class="material-icons">arrow_back</i>
		</button>
		<div class="appt-tools in-f">			
			<button id="walk-done" class="bus-appt-tool click-btn">
				Complete
				<i class="material-icons right">done</i>				
			</button>			
		</div>		
	</div>
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>