<div class="ispa-body">	
	<div class="ispa">								
		<?php $this->load->view("components/new_appointment"); ?>						
		<?php $this->load->view("components/ispa_bus_menu"); ?>
		<button data-tooltip="open menu" data-position="right" class="menu-btn tooltipped click-btn material-icons">menu</button>	
		<div class="ispa-area">
			<?php $this->load->view("business/ispa_appointments"); ?>						
		</div>
		<?php $this->load->view("business/ispa_checkout"); ?>
		<?php $this->load->view("business/bus_edit"); ?>
		<?php $this->load->view("business/ispa_staff"); ?>				
		<div class="ad-cont">
			<div class="add-list">
				<div class="add-item click-btn">
					<i class="add-item-icon material-icons">today</i>
					<div class="right add-item-name">Appointment</div>
				</div>
				<div class="add-item click-btn">
					<i class="add-item-icon material-icons">work</i>
					<div class="right add-item-name">Business</div>
				</div>
			</div>			
		</div>		
	</div>	
	<!-- loader -->
	<div class="app-cover main-loader">
		<div class="loader">
			<div class="loader-in"></div>
		</div>
	</div>	
</div>
<?php 
	$this->load->view("components/ispa_map_picker");
	$this->load->view("ispa_showcase");
?>

<!-- manage list -->
<div class="bus-manage">
	<div class="bus-manage-cont">
		<div class="manage-head modal-title">
			Manage shop
		</div>
		<div class="manage-body">
			<button class="manage-item click-btn">
				Edit details
				<i class="material-icons right">edit</i>
			</button>
			<button class="manage-item click-btn">
				Manage Services
				<i class="material-icons right">list</i>
			</button>
			<button class="manage-item click-btn">
				Working Days
				<i class="material-icons right">done_all</i>
			</button>
			<button class="manage-item click-btn">
				Staff Members
				<i class="material-icons right">group</i>
			</button>
			<button class="manage-item click-btn">
				Showcase Images
				<i class="material-icons right">photo_album</i>
			</button>
			<button class="manage-item click-btn">
				Preferences
				<i class="material-icons right">keyboard_arrow_right</i>
			</button>
		</div>
		<div class="manage-tools modal-tools">
			<button class="modal-tool left click-btn close">
				<i class="material-icons">arrow_back</i>
			</button>
		</div>
	</div>
</div>

<!-- edit-bus-details -->
<?php echo $this->load->view("components/row_holder",["p" => "open", "id" => "edit-bus-det"], true); ?>	
	<div class="modal-body manage-mod-b">
		<div class="modal-title">
			Edit Shop Details
		</div>
		<div class="modal-content">
			<div class="user-img">
				<img class="account-image" src="<?php echo base_url("uploads/logo/ispa.png"); ?>">
				<div>
					<button class="click-btn edit-cam">
						<i class="material-icons">camera_alt</i>
					</button>
				</div>
			</div>
			<div class="appt-in">
				<label class="input-label">Shop Name</label>
				<div contenteditable="true" class="input-content ed-in edit-name">JM Barbers</div>
			</div>
			<div class="appt-in">
				<label class="input-label">Email</label>
				<div contenteditable="true" class="input-content ed-in edit-email">briochieng97@gmail.com</div>
			</div>
			<div class="appt-in">
				<label class="input-label">Phone number</label>
				<div contenteditable="true" class="input-content ed-in edit-phone">+254718457135</div>
			</div>
			<div class="appt-in">
				<label class="input-label">Location</label>
				<div contenteditable="true" class="input-content ed-in edit-loc">Not set</div>
			</div>
		</div>
	</div>
	<div class="modal-tools">
		<button class="modal-tool left click-btn close">
			<i class="material-icons">arrow_back</i>
		</button>
		<button  class="save-bus click-btn right">
			Update details
			<i class="material-icons right">done</i>				
		</button>
	</div>
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>

<!-- manage-services -->
<?php echo $this->load->view("components/row_holder",["p" => "open", "id" => "manage-servs"], true); ?>	
	<div class="modal-body manage-mod-b">
		<div class="modal-title">
			Manage Services
		</div>
		<div class="modal-content">
			
		</div>
		<button class="click-btn add-serv">
			New service
			<i class="material-icons right">add_circle_outline</i>
		</button>
	</div>
	<div class="modal-tools">
		<button class="modal-tool left click-btn close">
			<i class="material-icons">arrow_back</i>
		</button>		
	</div>

	<!-- new service -->
	<div class="new-serv">
		<div class="new-serv-cont">
			<div class="modal-title">
				New Service
			</div>
			<div class="new-serv-body">
				<div class="appt-in">
					<label class="input-label">Service name</label>
					<input type="text" placeholder="Name" class="ispa-in browser-default serv-name">					
				</div>
				<div class="appt-in">
					<label class="input-label">Service description</label>
					<input type="text" placeholder="Description" class="ispa-in browser-default serv-desc">
				</div>
				<div class="appt-in">
					<label class="input-label">Cost of service <small>(Ksh.)</small></label>
					<input type="number" placeholder="Cost" class="ispa-in browser-default serv-cost">
				</div>
				<div class="appt-in">
					<label class="input-label">Duration <small>(minutes)</small></label>
					<input type="number" placeholder="Duration" class="ispa-in browser-default serv-dur">
				</div>
				<div class="ispa-group avail-g">               
					<p>
						<input  data-field="avail" checked="checked" value="true" type="checkbox" class="spend-input  avail filled-in" id="avail" />
						<label for="avail">Available for booking?</label>
					</p>               
				</div>
			</div>
			<div class="modal-tools">
				<button class="modal-tool left click-btn close red-text">
					Cancel
				</button>	
				<button class="right click-btn save-serv">Add service</button>	
			</div>
		</div>	
	</div>			
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>

<!-- manage-services -->
<?php echo $this->load->view("components/row_holder",["p" => "open", "id" => "wds"], true); ?>	
	<div class="modal-body manage-mod-b">
		<div class="modal-title">
			Working Days
		</div>
		<div class="modal-content">
			
		</div>
	</div>
	<div class="modal-tools">
		<button class="modal-tool left click-btn close">
			<i class="material-icons">arrow_back</i>
		</button>		
	</div>
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>

<!-- staff members -->
<?php echo $this->load->view("components/row_holder",["p" => "open", "id" => "staff-m"], true); ?>	
	<div class="modal-body manage-mod-b">
		<div class="modal-title">
			Staff Members
		</div>
		<div class="modal-content">
			
		</div>
	</div>
	<div class="modal-tools">
		<button class="modal-tool left click-btn close">
			<i class="material-icons">arrow_back</i>
		</button>		
	</div>
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>

<!-- showcase images -->
<?php echo $this->load->view("components/row_holder",["p" => "open", "id" => "show-im"], true); ?>	
	<div class="modal-body manage-mod-b">
		<div class="modal-title">
			Showcase Images
		</div>
		<div class="modal-content">
			
		</div>
	</div>
	<div class="modal-tools">
		<button class="modal-tool left click-btn close">
			<i class="material-icons">arrow_back</i>
		</button>		
	</div>
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>

<!-- preferences -->
<?php echo $this->load->view("components/row_holder",["p" => "open", "id" => "prefs"], true); ?>	
	<div class="modal-body manage-mod-b">
		<div class="modal-title">
			Account Preferences
		</div>
		<div class="modal-content">
			
		</div>
	</div>
	<div class="modal-tools">
		<button class="modal-tool left click-btn close">
			<i class="material-icons">arrow_back</i>
		</button>		
	</div>
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>