<div class="app">
	<div class="app-content">
		<?php $this->load->view("components/ispa_menu_home"); ?>
	</div>
	<nav class="bottom-nav">
		<button id="home" class="nav-tab click-btn active">
			<i class="material-icons tab-icon">home</i>
			<span class="tab-name">Home</span>				
		</button>
		<button id="history" class="nav-tab click-btn">
			<i class="material-icons tab-icon">history</i>
			<span class="tab-name">Bookings</span>				
		</button>
		<button id="notifications" class="nav-tab click-btn">
			<?php 
				echo common::pendingNotif() ? '<label class="tab-badge"></label>': ""; 
			 ?>			
			<i class="material-icons tab-icon">notifications</i>
			<span class="tab-name">Alerts</span>
		</button>
		<button id="account" class="nav-tab click-btn">
			<i class="material-icons tab-icon">account_circle</i>
			<span class="tab-name">Account</span>
		</button>
		<button id="more" class="nav-tab click-btn">
			<i class="material-icons tab-icon">more_vert</i>
			<span class="tab-name">More</span>
		</button>
	</nav>
</div>
<div class="menu-more">
	<div class="more-cont">
		<button id="business" class="more-item click-btn">
			<i class="material-icons left">launch</i>
			<span>Business Portal</span>
		</button>
		<button id="help" class="more-item click-btn">
			<i class="material-icons left">help_outline</i>
			<span>Help & Support</span>
		</button>
		<button id="about" class="more-item click-btn">
			<i class="material-icons left">info_outline</i>
			<span>About iSpa</span>
		</button>
		<button id="logout" class="more-item click-btn">
			<i class="material-icons left">exit_to_app</i>
			<span>Sign Out</span>
		</button>
	</div>
</div>
<div class="ispa-about">
	<div class="about-cont">
		<div class="about-body">
			<div class="about-text"></div>
			<img src="<?php echo base_url("uploads/logo/ispa.svg"); ?>" alt="ispa-logo" class="about-logo">
			<div class="about-title">&copy; 2019 iSpa Ltd.</div>			
		</div>
		<div class="modal-tools about-tools">
			<button class="modal-tool white-text left click-btn close-about close">
				<i class="material-icons">arrow_back</i>
			</button>
		</div>
	</div>
</div>

<?php $this->load->view("components/dialog_box"); ?>

<!-- help desk -->
<?php $this->load->view("components/ispa_help"); ?>

<!-- loader -->
<div class="app-cover main-loader">
	<div class="loader">
		<div class="loader-in"></div>
	</div>
</div>

<!-- appointment -->
<?php echo $this->load->view("components/row_holder",["p" => "open", "id" => "ispa-appt",], true); ?>
	<div class="modal-top">
		<button class="app-bar appt-bar"/>
	</div>
	<div class="modal-body">
		<div class="modal-title lato appt-title">
			Make Appointment
		</div>
		<div class="modal-content">
			<div class="appt-content">
				<div class="appt-in">
					<label class="input-label">Shop</label>
					<div class="input-content appt-shop">
						
					</div>
				</div>				
				<div class="appt-in">
					<label class="input-label">Services</label>
					<div class="input-content service-list">
						
					</div>
				</div>
				<div class="appt-in">
					<label class="input-label">Staff</label>
					<select class="input-content ispa-in browser-default staff-sel">
						
					</select>
				</div>
				<div class="appt-in">
					<label class="input-label">Date</label>
					<div class="input-content date-sel click-btn"></div>
				</div>
				<div class="appt-in">
					<label class="input-label">
						Payment
						<label class="right payable"></label>
					</label>
					<div class="input-content">
						Not paid
						<button class="pay-btn click-btn">
							Pay now	
							<i class="material-icons right">credit_card</i>		
						</button>
					</div>
				</div>
				<div class="appt-in">
					<br>
					<label class="input-label"></label>
					<div contenteditable="true" class="input-content book-note"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-tools appt-t">
		<button class="modal-tool close-appt left click-btn close">
			<i class="material-icons">arrow_back</i>
		</button>
		<div class="appt-tools in-f">
			<button id="can-appt" class="appt-tool hidden click-btn">
				<i class="material-icons">delete</i>
				<div class="tool-name">Delete</div>
			</button>			
			<!-- <button id="re-appt" class="appt-tool hidden click-btn">
				<i class="material-icons">refresh</i>
				<div class="tool-name">Rebook</div>
			</button> -->
			<button id="appt-go" class="appt-tool click-btn">
				<i class="material-icons">done</i>
				<div class="tool-name">Book now</div>
			</button>
			</div>
		</div>
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>
<?php $this->load->view("components/booking_calendar"); ?>


<!-- ispa pay -->
<?php echo $this->load->view("components/row_holder",["p" => "open", "id" => "ispa-pay"], true); ?>
	<div class="modal-top">	
	</div>
	<div class="modal-body">
		<div class="modal-title lato appt-title">
			Make payment
		</div>
		<div class="modal-content pay-details">
			<div class="appt-in">
				<div class="input-label tot-t">Total Amount</div>
				<div class="tot-a">
					
				</div>	
			</div>	
			<div class="pay-vendor">
				<?php $this->load->view("components/lipa_mpesa"); ?>
			</div>
		</div>
	</div>
	<div class="modal-tools pay-tools">
		<button class="modal-tool left click-btn close-pay close">
			<i class="material-icons">arrow_back</i>
		</button>
		<!-- <button class="modal-tool hidden right click-btn complete-pay">
			Complete payment
			<i class="material-icons right">done</i>
		</button> -->
		<div class="pay-status">
			<div class="pay-status-txt left">
				Checking for payment
			</div>
			<img src="<?php echo base_url("uploads/system/loading-ellipsis.gif"); ?>" alt="loading" class="pay-load right">
		</div>
	</div>	
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>