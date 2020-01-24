<?php 
	$user = $_SESSION["user"];
 ?>
<div class="ispa-account">
	<div class="ac-top">
		<button class="click-btn right settings">
			<i class="material-icons">settings</i>
		</button>
	</div>
	<div class="user-img">
		<img class="account-image" src="<?php echo base_url("uploads/profiles/".$user->profile); ?>">
	</div>
	<div class="ac-name">
		<?php echo $user->name; ?>
	</div>
	<div class="ac-title">
		Account details
	</div>
	<div class="appt-in">
		<label class="input-label">
			Email			
		</label>
		<div class="input-content">
			<?php echo $user->email; ?>			
		</div>
	</div>
	<div class="appt-in">
		<label class="input-label">
			Phone number			
		</label>
		<div class="input-content">
			<?php echo $user->phone; ?>	
		</div>
	</div>
	<div class="appt-in hidden">
		<label class="input-label">
			Location		
		</label>
		<div class="input-content">
			Not set		
		</div>
	</div>
</div>

<!-- settings list -->
<div class="setting-cont">
	<div class="setting-list">
		<button id="edit" class="click-btn setting-item">
			<i class="material-icons left">edit</i>
			Edit account details
		</button>
		<button  id="pass" class="click-btn setting-item">
			<i class="material-icons left">security</i>
			Change password
		</button>
	</div>
</div>

<!-- edit details -->
<?php echo $this->load->view("components/row_holder",["p" => "open", "id" => "edit-details"], true); ?>	
	<div class="modal-body">	
		<div class="modal-title lato">
			Edit account details
		</div>	
		<div class="user-img">
			<img class="account-image aci-edit" src="<?php echo base_url("uploads/profiles/".$user->profile); ?>">
			<div>
				<button class="click-btn edit-cam">
					<i class="material-icons">camera_alt</i>
				</button>
			</div>
		</div>
		<div class="edit-d">
			<div class="appt-in">
				<label class="input-label">Name</label>
				<div contenteditable="true" class="input-content ispa-in ed-in edit-name"><?php echo $user->name; ?></div>
			</div>
			<div class="appt-in">
				<label class="input-label">Email</label>
				<div contenteditable="true" class="input-content ed-in edit-email"><?php echo $user->email; ?></div>
			</div>
			<div class="appt-in">
				<label class="input-label">Phone number</label>
				<div contenteditable="true" class="input-content ed-in edit-phone"><?php echo $user->phone; ?></div>
			</div>
			<div class="appt-in hidden">
				<label class="input-label">Location</label>
				<div contenteditable="true" class="input-content ed-in edit-loc">Not set</div>
			</div>
		</div>
	</div>
	<div class="modal-tools">
		<button class="modal-tool left click-btn close close-edit">
			<i class="material-icons">arrow_back</i>
		</button>	
		<button class="modal-tool update-go right click-btn">
			<i class="material-icons right">done</i>
			Update details
		</button>	
	</div>	
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>

<?php $this->load->view("components/prof_manager"); ?>

<!-- update password -->
<div class="update-pass row">
	<div class="col s12 m4 l3"></div>
	<div class="col s12 m4 l6 update-cont">
		<div class="pass-body">
			<div class="modal-title lato">
				Change password
			</div>
			<div class="pass-content">
				<div class="appt-in">
					<label class="input-label">
						Current password			
					</label>
					<input type="password" name="curr-pass" class="ispa-in curr-pass browser-default" placeholder="Enter current password">
				</div>
				<div class="appt-in">
					<label class="input-label">
						New password			
					</label>
					<input type="password" name="new-pass" class="ispa-in new-pass browser-default" placeholder="Enter new password">
				</div>
			</div>
		</div>
		<div class="modal-tools">
			<button class="modal-tool left click-btn close close-pass">
				<i class="material-icons">arrow_back</i>
			</button>	
			<button class="modal-tool save-pass right click-btn">				
				Save password
			</button>	
		</div>
	</div>
	<div class="col s12 m4 l3"></div>
</div>