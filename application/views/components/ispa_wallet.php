<div class="ispa-wallet">
	<div class="wallet-head bus-head">
		<?php echo !isset($_SESSION["business"]) ? "MY&nbsp;&nbsp;": ""; ?>Subscription
	</div>
	<div class="wallet-details row">
		<?php
			if (isset($_SESSION["user"])) {
			 	if (isset($_SESSION["business"])) {
			 		$type = "bus";
			 		$id = $_SESSION["business"];
			 		$name = $_SESSION["business_name"];
			 		$wallet = wallet::balance($id);
			 	}else{
			 		if (isset($_SESSION["user"])) {
			 			$type = "user";
				 		$name = $_SESSION["user"]->name;
				 		$id = $_SESSION["user"]->ispa_id;
				 		$wallet = wallet::balance($id);
			 		}else{
			 			$name = "";
			 		}
			 	}
			 	
			} 
		 ?>	
		 <div class="col s12 m12 l12"></div>
		 <div class="col s12 m12 l12 wallet-cont">
		 		<div class="sub-status">
		 			<div class="sub-text">
		 				You have an active subscription
		 			</div>
		 			<div class="sub-due">
		 				Due on <?php echo date("jS F Y"); ?>
		 			</div>
		 		</div>		
		 		<div class="plans">
		 			Our plans
		 		</div> 	 			 	 		
	 	 		<div class="row subs">
	 	 			<div class="col s12 m12 l4 sub-item">
	 	 				<div class="sub-inner active">
	 	 					<div class="sub-content">
	 	 						<div class="sub-title mon">
	 	 							MONTHLY <small>(active)</small>
	 	 						</div>
	 	 						<div class="sub-data">
	 	 							Ksh. 5,000.00
	 	 						</div>
	 	 					</div>
	 	 					<button disabled="disabled" class="sub-go mon click-btn">
	 	 						SUBSCRIBE NOW
	 	 						<i class="material-icons right">shopping_cart</i>
	 	 					</button>
	 	 				</div>
	 	 			</div>
	 	 			<div class="col s12 m12 l4 sub-item">
	 	 				<div class="sub-inner">
	 	 					<div class="sub-content">
	 	 						<div class="sub-title semi">
	 	 							SEMI-ANNUALLY
	 	 						</div>
	 	 						<div class="sub-data">
	 	 							Ksh. 9,000.00
	 	 						</div>
	 	 					</div>
	 	 					<button class="sub-go semi click-btn">
	 	 						SUBSCRIBE NOW
	 	 						<i class="material-icons right">shopping_cart</i>
	 	 					</button>
	 	 				</div>
	 	 			</div>
	 	 			<div class="col s12 m12 l4 sub-item">
	 	 				<div class="sub-inner">
	 	 					<div class="sub-content">
	 	 						<div class="sub-title an">
	 	 							ANNUALLY
	 	 						</div>
	 	 						<div class="sub-data">
	 	 							Ksh. 14,000.00
	 	 						</div>
	 	 					</div>
	 	 					<button  class="sub-go an click-btn">
	 	 						SUBSCRIBE NOW
	 	 						<i class="material-icons right">shopping_cart</i>
	 	 					</button>
	 	 				</div>
	 	 			</div>
	 	 		</div>
	 	 </div>
		 <div class="col s12 m12 l12"></div>	 
	</div>
	<div class="top-up-row row">
		<div class="col s12 m3 l4"></div>
		<div class="col s12 m6 l4">
			<div class="top-up-cont">
			<div class="top-up-cont-head">
				<input autofocus="true" type="text" placeholder="Enter mpesa code here" class="browser-default top-up-code ispa-in">
			</div>
			<div class="top-up-steps">
				<ul  style="list-style: disc;text-align: left;">
					<li><strong>&#x2713;&nbsp;Go to M-PESA</strong></li>
					<li><strong>&#x2713;&nbsp;Select Lipa na M-PESA</strong></li>
					<li><strong>&#x2713;&nbsp;Select Buy Goods and Services</strong></li>
					<li><strong>&#x2713;&nbsp;Enter till no - <span class="green-text"><?php echo $this->config->item("till"); ?></span></strong></li>
					<li><strong>&#x2713;&nbsp;Enter amount<span class="amount-hold"></span></strong></li>
					<li><strong>&#x2713;&nbsp;Enter M-PESA code above</strong></li>
					<li class="divider"></li>
					<li><strong style="font-weight: 800;color:#79D20C;">&#9997;&nbsp;The amount will be deposited to iSpa.</strong></li>
				</ul>
			</div>
			<button class="left click-btn top-up-close">
				<i class="material-icons">close</i>
			</button>
			<button class="click-btn top-up-go">
				Top Up
			</button>
		</div>
		</div>
		<div class="col s12 m3 l4"></div>
	</div>
</div>

<!-- ispa subscribe -->
<?php echo $this->load->view("components/row_holder",["p" => "open", "id" => "ispa-subscribe"], true); ?>
	<div class="modal-top">	
		<button disabled="disabled" class="app-bar disabled"/>
	</div>
	<div class="modal-body">
		<div class="modal-title lato appt-title">
			Complete subscription
		</div>
		<div class="modal-content pay-details">
			<div class="appt-in center">
				<div class="input-label tot-t">Total Amount</div>
				<div class="tot-a">
					Ksh. 400.00
				</div>	
			</div>	
			<div class="ispa-group mpesa-code">
				<label class="ispa-label">Enter M-Pesa Code here</label>
				<input placeholder="M-Pesa Code" type="text" class="ispa-in m-code browser-default">
			</div>
			<div class="pay-vendor">
				<?php $this->load->view("components/lipa_mpesa"); ?>
			</div>
		</div>		
	</div>
	<div class="modal-tools">
		<button class="modal-tool left click-btn close">
			<i class="material-icons">arrow_back</i>
		</button>
		<button class="modal-tool right click-btn complete-pay">
			Complete
			<i class="material-icons right">done</i>
		</button>
	</div>	
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>