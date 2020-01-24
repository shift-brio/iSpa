<?php 
	$shop = $_SESSION["business"];
 ?>
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
	$this->load->view("components/dialog_box");
?>

<!-- manage list -->
<div class="bus-manage">
	<div class="bus-manage-cont">
		<div class="manage-head modal-title">
			Manage shop
		</div>
		<div class="manage-body">
			<button data-id="edit-bus-det" class="manage-item click-btn">
				Edit Details
				<i class="material-icons right">edit</i>
			</button>
			<button data-id="manage-servs" class="manage-item click-btn">
				Manage Services
				<i class="material-icons right">list</i>
			</button>
			<button data-id="wds" class="manage-item click-btn">
				Working Days
				<i class="material-icons right">done_all</i>
			</button>
			<button data-id="staff-m" class="manage-item click-btn">
				Staff Members
				<i class="material-icons right">group</i>
			</button>
			<button data-id="show-im" class="manage-item click-btn">
				Showcase Images
				<i class="material-icons right">photo_album</i>
			</button>
			<button data-id="prefs" class="manage-item click-btn">
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
		<button class="modal-tool left click-btn close close-edit">
			<i class="material-icons">arrow_back</i>
		</button>
		<button  class="save-bus click-btn right update-go">
			Update details
			<i class="material-icons right">done</i>				
		</button>
	</div>
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>

<?php $this->load->view("components/prof_manager"); ?>

<!-- manage-services -->
<?php echo $this->load->view("components/row_holder",["p" => "open", "id" => "manage-servs"], true); ?>	
	<div class="modal-body manage-mod-b">
		<div class="modal-title">
			Manage Services
		</div>
		<div class="modal-content">
			<?php 
				$servs = $this->commonDatabase->get_data("ispa_services", false, false, "added_by", $shop);

				if ($servs) {
					foreach ($servs as $serv) {
						echo common::renderService($serv,$type = "bus");
					}
				}else{
					echo '<div class="flow-text center no-fav">No services added yet</div>';
				}
			 ?>
		</div>
		<button class="click-btn add-serv">
			New service
			<i class="material-icons right">add_circle_outline</i>
		</button>
	</div>
	<div class="modal-tools">
		<button class="modal-tool left click-btn close close-sv">
			<i class="material-icons">arrow_back</i>
		</button>		
	</div>

	<!-- new service -->
	<div class="new-serv">
		<div class="new-serv-cont">
			<div class="modal-title ns-t">
				New Service
			</div>
			<div class="new-serv-body">
				<div class="appt-in">
					<label class="input-label">Service name</label>
					<input type="text" placeholder="Name" class="ispa-in browser-default service-name">					
				</div>
				<div class="appt-in">
					<label class="input-label">Service description</label>
					<input type="text" placeholder="Description" class="ispa-in browser-default service-desc">
				</div>
				<div class="appt-in">
					<label class="input-label">Cost of service <small>(Ksh.)</small></label>
					<input type="number" placeholder="Cost" class="ispa-in browser-default service-cost">
				</div>
				<div class="appt-in">
					<label class="input-label">Duration <small>(minutes)</small></label>
					<input type="number" placeholder="Duration" class="ispa-in browser-default service-dur">
				</div>
				<div class="ispa-group avail-g">               
					<p>
						<input  data-field="avail" checked="checked" value="true" type="checkbox" class="spend-input avail filled-in service-avail" id="avail" />
						<label for="avail">Available for booking?</label>
					</p>               
				</div>
			</div>
			<div class="modal-tools">
				<button class="modal-tool left click-btn close red-text close-ns">
					<i class="material-icons">arrow_back</i>
				</button>	
				<button class="right click-btn serv-go save-serv">Add service</button>	
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