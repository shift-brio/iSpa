<div class="app">
	<div class="app-content">
		<?php $this->load->view("components/ispa_menu_home"); ?>
	</div>
	<nav class="bottom-nav">
		<button id="home" class="nav-tab click-btn">
			<i class="material-icons tab-icon">home</i>
			<span class="tab-name">Home</span>				
		</button>
		<button id="history" class="nav-tab click-btn">
			<i class="material-icons tab-icon">history</i>
			<span class="tab-name">History</span>				
		</button>
		<button id="notifications" class="nav-tab click-btn">
			<label class="tab-badge"></label>
			<i class="material-icons tab-icon">notifications</i>
			<span class="tab-name">Alerts</span>
		</button>
		<button id="account" class="nav-tab click-btn active">
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

<!-- dialog box -->
<div class="ispa-dialog">
	<div class="dialog-cont">
		<div class="dialog-body">
			Remove your profile image?
		</div>
		<div class="dialog-tools">
			<button class="click-btn dialog-tool negative">
				Cancel
			</button>
			<button class="click-btn dialog-tool positive right">
				Ok
			</button>
		</div>
	</div>
</div>

<!-- help desk -->
<?php $this->load->view("components/ispa_help"); ?>

<!-- loader -->
<div class="app-cover main-loader">
	<div class="loader">
		<div class="loader-in"></div>
	</div>
</div>