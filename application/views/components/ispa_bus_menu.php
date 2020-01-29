<?php
	$prof = base_url("uploads/profiles/"); 
	$bus = common::getBus($_SESSION["business"]);				
	if ($bus) {
		$bus["profile"] = $bus["profile"] == "default_bus_prof.png" ? "default_bus_prof_white.png": $bus["profile"];
		$prof = base_url("uploads/profiles/".$bus["profile"]);				
	}
	?>
<div class="menu">
	<div class="menu-bar" data-menu="active">
		<div class="user-area" style="">	
			<img class="account-img" src="<?php echo $prof."?".time(); ?>">								
			<div class="menu-user"><?php echo  $bus ? $bus["name"] :"";  ?></div>
			<button class="click-btn manage-ac">
				<i class="material-icons left">settings</i>
				Manage
			</button>
		</div>
		<div class="menu-list">			
			<?php 
				if (isset($_SESSION["business"])) {
					$user  = $_SESSION["business"];
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
			<div class="menu-item  tooltipped active" data-menu="appointments" data-tooltip="Appointments" data-item="appointments" data-position="top">
				<i class="material-icons menu-icon">today</i>
				<div class="menu-notifs"></div>
				<div class="menu-name">Appointments</div>
			</div>
			<div data-item="notifications" class="menu-item  tooltipped" data-menu="notifications" data-tooltip="Notifications" data-position="top">
				<i class="material-icons menu-icon">notifications</i>
				<div class="menu-notifs n-indic"><?php echo $count_notifs; ?></div>
				<div class="menu-name">Notifications</div>
			</div>			
			<a href="<?php echo base_url(""); ?>">
				<div data-item="business" class="menu-item  tooltipped" data-menu="clients" data-tooltip="Business portal" data-position="top">
					<i class="material-icons menu-icon">arrow_back</i>	
					<div class="menu-name">Client account</div>
				</div>
			</a>	
			<a href="<?php echo base_url(); ?>">
				<div data-item="business" class="menu-item  tooltipped" data-menu="shops" data-tooltip="Notifications" data-position="top">
					<i class="material-icons menu-icon">lock</i>	
					<div class="menu-name">Log out</div>
				</div>
			</a>						
		</div>
	</div>
</div>