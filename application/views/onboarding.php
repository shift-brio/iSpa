<?php 
	$this->load->view("templates/base_header");
?>
	<div class="onboarding">
		<div class="onb-body">
			<div class="onb-controls">
				<button class="onb-control click-btn back">
					<i class="material-icons">keyboard_arrow_left</i>
				</button>
			</div>		
			<div class="onb-switcher">
				<p class="onb-title center app-title">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut.
				</p>
				<img class="onb-img" src="<?php echo base_url("uploads/onboarding/teams.svg"); ?>">
			</div>
			<div class="onb-controls">
				<button class="onb-control click-btn next">
					<i class="material-icons">keyboard_arrow_right</i>
				</button>
			</div>	
		</div>
		<div class="onb-tools">
			<button class="register left click-btn onb-tool">
				Create account
				<i class="material-icons right">person_add</i>
			</button>
			<button class="sign-in right click-btn onb-tool">
				Sign In
				<i class="material-icons right">lock_open</i>
			</button>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url('bootstrap/js/slider.js')."?".time(); ?>">
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			let onboard = new Slider(lst, cfg);
			$(".register").click(() =>{
				location.href = base_url+"sign_up";
			})
			$(".sign-in").click(() =>{
				location.href = base_url;
			})
		})
	</script>	