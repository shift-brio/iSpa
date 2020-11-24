<div class="row log-row">
	<div class="col s12 m2 l3"></div>
	<div class="col s12 m8 l6 log-col">
		<div class="ispa-login">
			<div class="login-top">
				<div class="ispa-descript center">
					<img src="<?php echo base_url("uploads/logo/ispa_white.png"); ?>" alt="" class="ispa-logo">
					<div class="ispa-name">Sign In</div>
				</div>		
			</div>
			<div class="login-bottom">
				<div class="login-area">
					<div class="ispa-group">
						<label class="ispa-label">Email</label>
						<input type="email" value="<?php echo isset($_SESSION["remember"]) ? $_SESSION["remember"] ? $_SESSION["remember"]: "":""; ?>" placeholder="Email" class="browser-default login-email ispa-in login-in">
					</div>
					<div class="ispa-group">
						<label class="ispa-label">Password</label>
						<input type="password" placeholder="Password" class="browser-default login-pass ispa-in login-in">
					</div>
					<div class="ispa-group">               
						<p>
							<input  data-field="remember" checked="checked" value="true" type="checkbox" class="spend-input  remember filled-in" id="remember" />
							<label for="remember">Remember me</label>
						</p>               
					</div>
					<div class="ispa-group">
						<div class="center">
							<img src="<?php echo base_url("uploads/system/loaders/loader-1.svg"); ?>" alt="login-load" class="login-load">	<br>
							<button class="click-btn log-in">
								Log In
								<i class="material-icons right">arrow_forward</i>														
							</button><br>
							<a class="forgot-a">Forgot password?</a>	
						</div>				
					</div><br>
					<div class="divider"></div>
					<div class="center">
						<a href="<?php echo base_url("sign_up"); ?>">
							<button class="click-btn jumper"><br>Sign up now</button>
						</a>
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>
	<div class="col s12 m2 l3"></div>
</div>
<div class="ispa-forgot">
	<div class="ispa-forgot-cont row">
		<div class="col s12 m3 l3"></div>
		<div class="col s12 m6 l6 forgot-body">
			<div class="recovery-header">
				Recover account password
			</div>
			<div class="recovery-body">
				<div class="recovery-get">
					<div class="ispa-group">
						<label for="" class="ispa-label">Email 
							<small>(Enter email to recover password for)</small>
						</label>
						<input type="email" placeholder="Email" class="ispa-in browser-default recovery-mail login-in">
					</div>
				</div>
				<div class="recovery-change">
					<div class="ispa-group">
						<label for="" class="ispa-label">Email</label>
						<input type="email" placeholder="Email" class="ispa-in browser-default recovery-email login-in">
					</div>
					<div class="ispa-group">
						<label for="" class="ispa-label">Recovery code</label>
						<input type="text" placeholder="Recovery code" class="ispa-in browser-default recovery-code login-in">
					</div>
					<div class="ispa-group">
						<label for="" class="ispa-label">New Password</label>
						<input type="password" placeholder="Recovery password" class="ispa-in browser-default recovery-pass login-in">
					</div>
				</div>
			</div>
			<div class="recovery-tools">
				<button class="click-btn recovery-tool left close-recovery">
					<i class="material-icons">close</i>
				</button>
				<button class="click-btn recovery-tool left switch-recovery">
					Reset
				</button>
				<button class="click-btn recovery-tool right recovery-go">
					Submit
					<i class="material-icons right">lock_open</i>
				</button>
			</div>			
		</div>
		<div class="col s12 m3 l3"></div>
	</div>
</div>
<div class="appoint-loader">
	<div class="appoint-loader-in"></div>
</div>