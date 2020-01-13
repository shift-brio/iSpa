<div class="menu">
	<div class="menu-bar" data-menu="inactive">
		<button data-tooltip="close menu" data-position="right" class="in-menu-btn tooltipped click-btn material-icons">close</button>
		<div class="user-area">
			<?php 
				if (isset($_SESSION["user"])) {
					$user = $_SESSION["user"];
					$prof = base_url("uploads/profiles/".$user->profile);
					echo '						
						<img data-prof="'.$prof.'" src="'.$prof.'" alt="User" class="menu-profile user-profile">	
						<button data-tooltip="Account settings" data-position="right" class="material-icons tooltipped ac-tools click-btn">settings</button>
						<div class="user-name menu-user">'.$user->name.'</div>		
					';
				}else{
					echo '
						<img src="'.base_url("uploads/system/default_prof_white.png").'" alt="User" class="menu-profile user-profile">			
					';
				}
			 ?>
		</div>
		<div class="menu-list">
			<div data-item="home" class="menu-item active tooltipped" data-menu="home" data-tooltip="Home" data-position="top">
				<i class="material-icons menu-icon">home</i>			
				<div class="menu-name">Home</div>
			</div>		
			<?php 
				if (isset($_SESSION["user"])) {
					$user  = $_SESSION["user"]->ispa_id;
					$count_notifs = $this->commonDatabase->count("ispa_notifications","status",0,'user',$user);
					$count_chats = $this->commonDatabase->count("ispa_messages","receiver",$user,'status',0);
					if ($count_notifs && $count_notifs > 9) {
						$count_notifs = "9+";
					}else{
						if ($count_notifs) {
							$count_notifs = $count_notifs;
						}else{
							$count_notifs = "";
						}	
					}
					/**/
					if ($count_chats && $count_chats > 9) {
						$count_chats = "9+";
					}else{
						if ($count_chats) {
							$count_chats = $count_chats;
						}else{
							$count_chats = "";
						}	
					}
				}
			 ?>	
			<div class="menu-item  tooltipped" data-menu="appointments" data-tooltip="Appointments" data-item="appointments" data-position="top">
				<i class="material-icons menu-icon">today</i>
				<div class="menu-notifs"></div>
				<div class="menu-name">Appointments</div>
			</div>
			<div data-item="notifications" class="menu-item  tooltipped" data-menu="notifications" data-tooltip="Notifications" data-position="top">
				<i class="material-icons menu-icon">notifications</i>
				<div class="menu-notifs n-indic"><?php echo $count_notifs; ?></div>
				<div class="menu-name">Notifications</div>
			</div>					
			<div data-item="wallet" class="menu-item  tooltipped" data-menu="wallet" data-tooltip="My Wallet" data-position="top">
				<i class="material-icons menu-icon">credit_card</i>	
				<div class="menu-name">My Wallet</div>
			</div>
			<?php
				$hasBus = false; 
				if (isset($_SESSION["user"])) {
					$ch_bus = $this->commonDatabase->get_data("ispa_business",1,false,"created_by", $_SESSION["user"]->ispa_id);
					if (!$ch_bus) {
						$ch_bus = $this->commonDatabase->get_data("ispa_staff",1,false,"ispa_id", $_SESSION["user"]->ispa_id);
					}
					if ($ch_bus) {
						$hasBus = true;
					}
				}
				if ($hasBus) {
					echo '<a href="'.base_url("business").'">
							<div data-item="business" class="menu-item  tooltipped" data-menu="shops" data-tooltip="Business portal" data-position="top">
								<i class="material-icons menu-icon">work</i>	
								<div class="menu-name">Businesses portal</div>
							</div>
						</a>
					';
				}else{
					echo '
						<a class="add-bus">
							<div data-item="business" class="menu-item  tooltipped" data-menu="shops" data-tooltip="Business portal" data-position="top">
								<i class="material-icons menu-icon">add</i>	
								<div class="menu-name">Add a Shop/Business</div>
							</div>
						</a>
					';
				}
			 ?>
			<div data-item="chats" class="menu-item  tooltipped" data-menu="communication" data-tooltip="Chats" data-position="top">
				<i class="material-icons menu-icon">chat</i>
				<div class="menu-notifs chat-notif"><?php echo $count_chats; ?></div>	
				<div class="menu-name">Chats</div>
			</div>
			<div data-item="help" class="menu-item  tooltipped" data-menu="support" data-tooltip="Help" data-position="top">
				<i class="material-icons menu-icon">live_help</i>	
				<div class="menu-name">Help & Support</div>
			</div>
			<div class="ispa-menu-more">
				<a data-tooltip="Invite friends"  data-activates="share_list"  data-position="top" class="material-icons dropdown-trigger  tooltipped ispa-share-btn">share</a>
				<a href="<?php echo base_url("logout"); ?>"class="right log-out">
					<i class="material-icons">lock</i>
					Log out
				</a>
				<?php
					$fb = "http://www.facebook.com/sharer.php?u=".base_url("?p=fb");
					$tw = "http://twitter.com/intent/tweet?url=".base_url("?p=twitter")."&text=iSpa"; 
				 ?>
				<ul id="share_list" class="dropdown-content">			    
					<li class="share-with">
						<a class="" target="_blank" href="<?php echo $fb; ?>">Facebook</a>
					</li>
					<li>
						<a target="_blank" href="<?php echo $tw; ?>">Twitter</a>
					</li>
					<li class="copy-link">
						<a>Copy Link</a>
					</li>
				</ul>
			</div>					
			<a href="<?php echo base_url(); ?>">
				<div class="ispa-copy">&copy;iSpa&nbsp;<span class="ispa-year"><?php echo date('Y'); ?></span></div>
			</a>			
		</div>
	</div>
</div>