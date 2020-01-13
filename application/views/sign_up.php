<?php $this->load->view("components/ispa_map_picker"); ?>
<div class="ispa-sign-up">
	<div class="ispa-row row">
		<div class="col s12 m12 l3" ></div>
		<div class="col s12 m12 l6 ispa-sign-up-cont">
			<div class="ispa-name">
				<img src="<?php echo base_url("uploads/logo/ispa.png"); ?>" alt="" class="ispa-logo">
				<div>Sign up for iSpa</div>
			</div>
			<div class="ispa-sign-up-body">
				<div class="ispa-group">
					<label class="ispa-label">Full Name</label>
					<input placeholder="Full name eg. John Doe" type="text" class="ispa-in sign-name browser-default">
				</div>
				<div class="ispa-group">
					<label class="ispa-label">Email address <small>(optional)</small></label>
					<input placeholder="Email address" type="email" class="ispa-in browser-default sign-email ">
				</div>
				<div class="ispa-group">
					<label class="ispa-label">Phone number</small></label>
					<input placeholder="Phone number format ~ +2547xxxxxxxx" type="tel" class="ispa-in sign-phone browser-default">
				</div>
				<div class="ispa-group">
					<label class="ispa-label">Password</small></label>
					<input placeholder="Password"  type="password" class="ispa-in browser-default sign-pass">
				</div>
				<div class="ispa-group">
					<label class="ispa-label">My location</small></label>
					<div  type="password" class="ispa-in ispa-loc browser-default">
						<div data-for="sign" class="location-picked">Click to pick a location</div>
						<button data-tooltip="Current location" data-position="left" class="material-icons tooltipped sign-my click-btn">location_on</button>
					</div>
				</div>
				<div class="ispa-group">
					<p class="check_p">
				      <input value="false" type="checkbox" class="filled-in terms_check" id="terms">
				      <label for="terms">I Accept <a target="_blank" href="<?php echo base_url("legal/terms"); ?>">Terms of Service</a></label>
				    </p>
				</div>
				<div class="ispa-group center">
					<button class="sign-go click-btn">
						Create Account
					</button>
				</div>
				<div class="divider"></div>
				<div class="center">
					<a href="<?php echo base_url(); ?>">
						<button class="click-btn jumper sign-j">Sign In</button>
					</a>
				</div>
			</div>
		</div>		
		<div class="col s12 m12 l3"></div>
	</div>
</div>