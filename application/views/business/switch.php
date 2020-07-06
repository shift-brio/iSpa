<div class="ispa-business-switch row">	
	<div class="col s12 m3 l3"></div>
	<div class="col s12 m6 l6 switch-cont">
		<div class="switch-head">	
			BUSINESS PORTAL 
			<div>Select an account to manage</div>
		</div>
		<div class="switch-list">
			<?php 
				$user = $_SESSION["user"]->ispa_id;
				$business = $this->commonDatabase->get_data("ispa_business",false,false,"created_by",$user);
				$staff = $this->commonDatabase->get_data("ispa_staff",1,false,"ispa_id",$user);
				$st_list = [];
				if ($business) {
					foreach ($business as $bus) {
						if ($staff) {
							foreach ($staff as $st) {
								if ($st["business"] == $bus["identifier"]) {
									array_push($st_list, $bus["identifier"]);
								}
							}
						}					
						$url = base_url("business/open/".$bus["identifier"]);
						echo '<a href="'.$url.'">
								<div class="switch-item">
									'.$bus["name"].'
								</div>
							</a>';
					}								
				}
				if (is_array($staff) && sizeof($staff) > 0) {
					foreach($staff as $st) {
						if (!in_array($st["business"], $st_list)) {
							$url = base_url("business/open/".$st["business"]);
							$bus = common::getBus($st["business"]);
							if ($bus) {
								echo '<a href="'.$url.'">
									<div class="switch-item">
										'.$bus["name"].'
									</div>
								</a>';
							}
						}
					}
				}
			 ?>
		</div>
		 <div class="switch-tools">
		 	<a href="<?php echo base_url(); ?>" class="portal-back click-btn">
				<i class="material-icons">arrow_back</i>
			</a>
		 	<button class="click-btn new-bus-btn right">
		 		ACCOUNTS
		 		<i class="material-icons right">add_circle_outline</i>
		 	</button>
		 </div>		
	</div>
	<div class="col s12 m3 l3"></div>
</div>

<div class="add-bus">
	<div class="add-bus-cont">
		<div class="add-bus-body">
			<div class="modal-title app-color app-title">
				Add your shop
			</div>
			<div class="add-cont">
				<div class="appt-in">
					<label class="input-label active">Shop Name</label>
					<input type="text" placeholder="Shop name"  class="browser-default ispa-in bs-name">				
				</div>
				<div class="appt-in">
					<label class="input-label active">Email</label>
					<input type="text" placeholder="Shop email"  class="browser-default ispa-in bs-email">				
				</div>
				<div class="appt-in">
					<label class="input-label active">Phone Number</label>
					<input type="text" placeholder="Shop phone Number"  class="browser-default ispa-in bs-phone">				
				</div>
				<div class="appt-in">
					<label class="input-label active">Shop Location</label>
					<input type="text" placeholder="Shop location"  class="browser-default ispa-in bs-loc">				
				</div>
			</div>
		</div>
		<div class="modal-tools">
			<button class="modal-tool left click-btn close cls-add-bs">
				<i class="material-icons">arrow_back</i>
			</button>
			<button class="right click-btn add-bs-go">
				Proceed
				<i class="material-icons right">arrow_forward</i>
			</button>		
		</div>
	</div>
</div>

<!-- loader -->
<div class="app-cover main-loader">
	<div class="loader">
		<div class="loader-in"></div>
	</div>
</div>