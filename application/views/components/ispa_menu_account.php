<div class="ispa-account">
	<div class="ac-top">
		<button class="click-btn right settings">
			<i class="material-icons">settings</i>
		</button>
	</div>
	<div class="user-img">
		<img class="account-image" src="<?php echo base_url("uploads/profiles/profile.svg"); ?>">
	</div>
	<div class="ac-name">
		Brian Ochieng Oriwo
	</div>
	<div class="ac-title">
		Account details
	</div>
	<div class="appt-in">
		<label class="input-label">
			Email			
		</label>
		<div class="input-content">
			briochieng97@gmail.com			
		</div>
	</div>
	<div class="appt-in">
		<label class="input-label">
			Phone number			
		</label>
		<div class="input-content">
			+254718457135	
		</div>
	</div>
	<div class="appt-in">
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
		<button class="click-btn setting-item">
			<i class="material-icons left">edit</i>
			Edit account details
		</button>
		<button class="click-btn setting-item">
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
			<img class="account-image" src="<?php echo base_url("uploads/profiles/a245030c161807079ffdff4a780663f3.jpg"); ?>">
			<div>
				<button class="click-btn edit-cam">
					<i class="material-icons">camera_alt</i>
				</button>
			</div>
		</div>
		<div class="edit-d">
			<div class="appt-in">
				<label class="input-label">Name</label>
				<div contenteditable="true" class="input-content ed-in edit-name">Brian Ochieng Oriwo</div>
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
		<button class="modal-tool update-go right click-btn">
			<i class="material-icons right">done</i>
			Update details
		</button>	
	</div>	
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>

<!-- prof pop up -->
<div class="prof-options">
	<div class="prof-list">
		<button class="click-btn prof-item">
			Change profile image
		</button>
		<button class="click-btn prof-item rem">
			Remove profile image
		</button>
		<button class="click-btn prof-item">
			Back
		</button>
	</div>
</div>

<!-- profile preview -->
<div class="prof-preview">
	<div class="preview-cont">
		<div class="prev-body">
			<img class="pref-pre" src="<?php echo base_url("uploads/profiles/2be29249f1d69423fe20d37ae89d0d79.png"); ?>">
		</div>
		<div class="modal-tools">
			<button class="modal-tool left click-btn close">
				<i class="material-icons">arrow_back</i>
			</button>	
			<button class="modal-tool save-prof right click-btn">				
				Save Profile
			</button>	
		</div>
	</div>
</div>

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
			<button class="modal-tool left click-btn close">
				Cancel
			</button>	
			<button class="modal-tool save-pass right click-btn">				
				Save password
			</button>	
		</div>
	</div>
	<div class="col s12 m4 l3"></div>
</div>