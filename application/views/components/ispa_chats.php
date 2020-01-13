<div class="ispa-chats">
	<div class="row ispa-row">
		<div class="col s12 m12 l12"></div>
		<div class="col s12 m12 l12 ispa-chat-cont">			
			<div class="ispa-chat-list">
				<div class="center notifications-head">Messages</div>
				<div class="ispa-chat-list-items">
					<?php 
						if (isset($_SESSION["user"])) {
						 	if (isset($_SESSION["business"])) {
						 		$user = $_SESSION["business"];
						 		$messages = $this->commonDatabase->get_cond("ispa_messages","receiver='$user' group by sender order by date_added DESC");
						 	}else{
						 		$user = $_SESSION["user"]->ispa_id;
						 		$messages = $this->commonDatabase->get_cond("ispa_messages","sender='$user' group by receiver order by date_added DESC");
						 	}
						}else{
							$user = "0";
						} 	
						
						if ($messages) {						
							foreach ($messages as $message) {
								if ($message["status"] == 1) {
									$class = "";
								}else{
									if ( $message["sender"] == $user) {
										$class = "";
									}else{
										$class = "active";
									}
									
								}
								$u = false;
								$name = "";
								$send = $message["sender"];
								$rec  = $message['receiver'];
								$prof = "";								
								if (isset($_SESSION["business"])) {
									/**/										
									$user = $this->commonDatabase->get_cond("ispa_users","ispa_id='$rec' or ispa_id='$send'");									
									if ($user) {
										$prof = base_url("uploads/profiles/".$user[0]["profile"]);
										$name = $user[0]["name"];
										$u = $user;
									}
								}else{									
									$bus = common::getBus($send);
									if (!$bus) {
										$bus = common::getBus($rec);
									}
									if ($bus) {										
										$prof = base_url("uploads/profiles/".$bus["profile"]);
										$name = $bus["name"];
										$u = $bus;
									}
								}
								if ($u) {
									if (isset($_SESSION["business"])) {
										$id = $message["sender"];
									}else{
										$id = $message["receiver"];
									}
									echo '
										<a>
											<div class="chat-item '.$class.'" data-item="'.$id.'">
												<img src="'.($prof).'" alt="" class="chat-img">
												<div class="chat-details">
													<div class="chat-user">
														'.$name.'
													</div>
													<div class="chat-info">
														'.timespan($message["date_added"],time(),1).'
													</div>
												</div>
											</div>
										</a>
									';
								}
							}
						}else{
							echo '<div class="flow-text center">No chats yet</div>';
						}
					 ?>
				</div>
			</div>
			<div class="ispa-chat-area">
				<div class="ispa-chat-head">
					<button data-tooltip="Back" data-position="right" class="chat-back tooltipped left material-icons click-btn">chevron_left</button>
					<div class="ispa-chat-title bus-head"></div>
				</div>
				<div class="ispa-chat-body">
					
				</div>
				<div class="ispa-chat-tools">
					<input placeholder="Type message here..." type="text" class="browser-default ispa-chat-in">
					<button data-tooltip="Send" data-position="top" class="click-btn tooltipped ispa-chat-go material-icons">send</button>
				</div>
			</div>
		</div>
		<div class="col s12 m12 l3"></div>
	</div>
</div>