<div class="ispa-notifications">
	<div class="center notifications-head bus-head">Notifications</div>
	<div class="row ispa-row">
		<div class="col s12 m12 l3"></div>
		<div class="col s12 m12 l6 ispa-notif-cont">			
			<div class="notif-items">
				<?php
					if (isset($_SESSION["user"])) {
					 	if (isset($_SESSION["business"])) {
					 		$user = $_SESSION["business"];
					 	}else{
					 		$user = $_SESSION["user"]->ispa_id;
					 	}
					}else{
						$user = "0";
					} 				
					$nots = $this->commonDatabase->get_cond("ispa_notifications","user='$user' order by id DESC");				
					if ($nots) {
						foreach ($nots as $notification) {
							common::renderNotif($notification);						
						}
					}else{
						echo '<div class="flow-text center no-fav">No notifications yet</div>';
					}
				 ?>
			</div>
		</div>
		<div class="col s12 m12 l3"></div>
	</div>
</div>
<?php echo $this->load->view("components/row_holder",["p" => "open", "id" => "ispa-notif-view"], true); ?>	
	<div class="modal-body">		
		<div class="notif-title main">
			
		</div>
		<div class="notif-date main">
			
		</div>
		<div class="notif-body main">
			
		</div>
	</div>
	<div class="modal-tools">
		<button class="modal-tool close-n left click-btn close">
			<i class="material-icons">arrow_back</i>
		</button>		
	</div>	
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>