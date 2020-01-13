<?php 
	 	 			if (isset($_SESSION["business"])) {
	 	 				$bus = $_SESSION["business"];
	 	 				$wallet = wallet::status($bus);	 	 				
	 	 				if ($wallet) {
	 	 					if ($wallet->sub) {	 	 						
	 	 						echo '
	 	 							<div class="subscriber" data-subscribed="true">';
	 	 							$subs = $this->config->item("subs");
					 	 			for ($i=0; $i < sizeof($subs); $i++) { 	 				
					 	 				if ($subs[$i] == $wallet->m) {
					 	 					$cl = "active";
					 	 				}else{
					 	 					$cl = "";
					 	 				}
					 	 				if ($subs[$i] == "month") {
					 	 					$subs[$i] = "Monthly";
					 	 				}elseif($subs[$i] == "year"){
					 	 					$subs[$i] = "Annually";
					 	 				}
					 	 				$amnt = $this->config->item("subs_amounts")[$i];
					 	 				echo '
					 	 					<div class="subscriber-section '.$cl.'" data-sub="month">
						 	 				<div class="subscriber-section-head">
						 	 					'.$subs[$i].'
						 	 				</div>
						 	 				<div class="sect-details">
						 	 					Ksh. '.number_format($amnt,2).'
						 	 				</div>
						 	 			</div>						 	 			
					 	 				';
					 	 			}
					 	 			echo'
					 	 			<div style="background:#f2f2f2;" class="subscriber-control  active" data-sub="">
					 	 				<div class="subscriber-section-head">
					 	 					You have an active subscription
					 	 				</div>
					 	 				<div class="sect-details green-text">
					 	 				<div class="divider"></div>
					 	 					Due<br>'.date("jS F Y",$wallet->end).' 
					 	 				</div>
					 	 			</div>
					 	 		</div>
	 	 						';
	 	 					}else{
	 	 						echo '
	 	 							<div class="subscriber" data-subscribed="false">';
	 	 							$subs = $this->config->item("subs");
					 	 			for ($i=0; $i < sizeof($subs); $i++) { 
					 	 				if ($subs[$i] == "month") {
					 	 					$subs[$i] = "Monthly";
					 	 				}elseif($subs[$i] == "year"){
					 	 					$subs[$i] = "Annually";
					 	 				}
					 	 				$amnt = $this->config->item("subs_amounts")[$i];
					 	 				echo '
					 	 					<div class="subscriber-section" data-sub="month">
						 	 				<div class="subscriber-section-head">
						 	 					'.$subs[$i].'
						 	 				</div>
						 	 				<div class="sect-details">
						 	 					Ksh. '.number_format($amnt,2).'
						 	 				</div>
						 	 			</div>						 	 			
					 	 				';
					 	 			}
					 	 			echo'<div class="subscriber-control">
					 	 				<div class="subscriber-text flow-text center due">
					 	 					Subscription due
					 	 				</div>
					 	 				<button class="subscribe-go click-btn">SUBSCRIBE</button>
					 	 			</div>
					 	 		</div>
	 	 						';
	 	 					}
	 	 				}
	 	 			}
	 	 		 ?>