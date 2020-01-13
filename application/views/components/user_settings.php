<div class="user-settings row">
	<div class="col s12 m6 l4 user-settings-cont">
		<div class="pass-change col s12 m6 l4">
			<div class="settings-head">
				<button data-tooltip="Close" data-position="right"  class="left material-icons click-btn close-pass tooltipped">close</button>
				CHANGE PASSWORD
				<button data-tooltip="Close" data-position="left"  class="right click-btn edit-positive change-go tooltipped">Change</button>
			</div>
			<div class="change-ins">
				<div class="spa-group">
					<label class="ispa-label">Current Password</label>
					<input type="password"  placeholder="Current Password" class="ispa-in browser-default edit-curr-pass">
				</div>
				<div class="spa-group">
					<label class="ispa-label">New Password</label>
					<input type="password"  placeholder="New Password" class="ispa-in browser-default edit-new-pass">
				</div>
			</div>
		</div>
		<div class="settings-head">
			<button data-tooltip="Back" data-position="right"  class="left material-icons click-btn close-settings tooltipped">chevron_left</button>
			ACCOUNT SETTINGS
			<button data-tooltip="Close" data-position="left"  class="right click-btn edit-positive edit-go tooltipped">Save Details</button>
		</div>
		<div class="profile-edit">
			<img src="<?php echo base_url("uploads/profiles/".$_SESSION['user']->profile); ?>" alt="" class="edit-prof">
			<div class="edit-tools">
				<input onchange="read_prof(this)" type="file"  id="prof-change" class="prof-change hidden">
				<label for="prof-change">
					<span data-tooltip="Change profile image" class="tooltipped material-icons click-btn edit-tool">camera</span>					
				</label>
				<button data-tooltip="Delete profile image" class="tooltipped material-icons click-btn edit-tool del-prof red-text">delete</button>
				<button data-tooltip="Change password" class="tooltipped material-icons click-btn edit-tool edit-pass">lock</button>
			</div>	
			<img src="<?php echo base_url("uploads/system/load.svg"); ?>" alt="" class="edit-load right">		
		</div>
		<div class="edit-details">
				<?php 
					$user = $_SESSION["user"];
				 ?>
				<div class="spa-group">
					<label class="ispa-label">Name</label>
					<input type="text" value="<?php echo $user->name; ?>" placeholder="Name" class="ispa-in browser-default edit-name">
				</div>
				<div class="spa-group">
					<label class="ispa-label">Email</label>
					<input type="text" value="<?php echo $user->email; ?>" placeholder="Email" class="ispa-in browser-default edit-email">
				</div>
				<div class="spa-group">
					<label class="ispa-label">Phone</label>
					<input type="text" value="<?php echo $user->phone; ?>" placeholder="Phone" class="ispa-in browser-default edit-phone">
				</div>
				<div class="ispa-group">
					<label class="ispa-label">Location</small></label>
					<div  type="password" class="ispa-in ispa-loc browser-default">
						<div data-for="edit-prof" class="location-picked"><?php echo $user->location->title; ?></div>
						<button data-tooltip="Current location" data-position="left" class="material-icons tooltipped new-shop-my click-btn">location_on</button>
					</div>
				</div>
				<div class="devider"></div>
				<div class="spa-group">
					<label class="ispa-label">Enter your password</label>
					<input type="password"  placeholder="Enter your password" class="ispa-in browser-default edit-prof-pass">
				</div>
		</div>
	</div>
	<div class="col s12 m3 l4"></div>
	<div class="col s12 m3 l4"></div>
</div>