<div class="bus-edit row">
	<div class="col s12 l4 m6 bus-edit-cont">
		<div class="bus-edit-head">
			<button class="bus-edit-tool  click-btn">
				<i class="material-icons">chevron_left</i>
			</button>
			<div class="bus-edit-title">SHOP DETAILS</div>
		</div>
		<?php 
		$bus = common::getBus($_SESSION["business"]);
		$loc = common::busLoc($_SESSION["business"]);
		$type = $this->commonDatabase->get_data("ispa_business_types",1,false,"identifier",$_SESSION["business"]);		
		?>
		<div class="bus-editing">			
			<div class="bus-prof">	
				<?php 
					if ($bus) {
						$prof = base_url("uploads/profiles/".$bus["profile"]);
						echo '<img data-prof="'.$prof.'" src="'.$prof.'" alt="" class="edit-prof edit-prof-bus">';
					}
				 ?>					
				<div class="edit-tools">
					<button class="click-btn bus-more staff-btn left">STAFF</button>		
					<input onchange="read_prof(this)" type="file"  id="prof-change" class="prof-change hidden">
					<label for="prof-change">
						<span data-tooltip="Change profile picture" class="tooltipped material-icons click-btn edit-tool">camera</span>					
					</label>
					<button data-tooltip="Delete profile picture" class="tooltipped material-icons click-btn edit-tool del-prof red-text">delete
					</button>	
					<button data-tooltip="Showcase" class="tooltipped material-icons click-btn edit-tool showcase-btn">collections
					</button>
					<button class="click-btn bus-more right green save-bus">UPDATE</button>	
				</div>				
			</div>
			<div class="bus-tabs">
				<button data-item="general" class="bus-tab click-btn active">GENERAL</button>
				<button data-item="services" class="bus-tab click-btn">SERVICES</button>
				<button data-item="working" class="bus-tab click-btn">W. DAYS</button>
				<button data-item="prefs" class="bus-tab click-btn material-icons">settings</button>
			</div>
			<div class="bus-edit-body">
				<div class="bus-edit-group edit-general">
					<div class="spa-group">
						<label class="ispa-label">Name</label>
						<input type="text" value="<?php echo $bus["name"]; ?>" placeholder="Name" class="ispa-in browser-default edit-name">
					</div>				
					<div class="spa-group">
						<label class="ispa-label">Phone</label>
						<input type="text" value="<?php echo $bus["phone"]; ?>" placeholder="Phone" class="ispa-in browser-default edit-phone">
					</div>
					<div class="ispa-group">
						<label class="ispa-label">Location</small></label>
						<div  type="password" class="ispa-in ispa-loc browser-default">
							<div data-for="edit-prof" class="location-picked"><?php echo $loc->name; ?></div>
							<button data-tooltip="Current location" data-position="left" class="material-icons tooltipped new-shop-my click-btn">location_on</button>
						</div>
					</div>
					<div class="ispa-group">
						<label class="ispa-label">Business type</label>
						<input type="tel" value="<?php echo $type ? $type[0]["name"] : ""; ?>" data-curr="" placeholder="Business type eg barbershop" class="browser-default edit-shop-type ispa-in">
						<div class="type-filler row">
							<div class="col s12 m12 l12 filled-items">
								
							</div>
						</div>
					</div>
				</div>
				<div class="bus-edit-group edit-services new-shop-services" service-for="edit">
					<table style="text-align: right;">
						<thead>
							<tr>
								<th class="edit-h"></th>														
								<th class="edit-h">Name</th>							
								<th class="edit-h">Duration</th>
								<th class="edit-h">Cost</th>							
								<th class="edit-h">
									<button data-tooltip="New service" data-position="left" class="material-icons tooltipped click-btn add-service">add</button>
								</th>
							</tr>
						</thead>
					</table>
					<div class="new-shop-services-items" data-item-default="new">
					<?php
						$services = $this->commonDatabase->get_data("ispa_services",false,false,"added_by",$_SESSION["business"]);					
						if ($services) {
							foreach ($services as $service) {
								echo '								
										<div data-item="new-item"  data-item-default="'.$service["id"].'" class="new-shop-services-item col s12 m12 l12">
											<div class="indic material-icons active click-btn">done</div>
											<input placeholder="Service name" value="'.$service["name"].'" class="browser-default  new-shop-services-item-name ispa-in" type="text">
											<input min="0" value="'.$service["duration"].'" placeholder="Duration (minutes)" class="browser-default new-shop-services-item-duration ispa-in" type="number">
											<input min="0" value="'.$service["cost"].'"  placeholder="Cost (Ksh.)" class="browser-default new-shop-services-item-cost ispa-in" type="number">
											<button data-tooltip="Delete service" data-position="left" class="tooltipped click-btn rem-service">
												<i class="material-icons">delete</i>
											</button>
										</div>								
								';
							}
						}else{
							echo '<div class="flow-text center">No services added yet</div>';
						}
					 ?>
					</div>
				</div>
				<div class="bus-edit-group edit-working">
					<div class="edit-pref-head  center">Working days</div>
					<?php 
						$week = $this->config->item("days");
						$working = json_decode($bus["working"]);
						$wd = $working;					
						$days = [];
						foreach ($working as $day) {
							array_push($days, strtolower($day->day));
						}
						$working = $days;
						if ($working && is_array($working)) {
							foreach ($week as $wk) {
								$d = json_decode(json_encode(["format" => date("D",strtotime($wk)),"day" => date("l",strtotime($wk)),"start"=>"","end" => ""]));
								$is_working = false;
								foreach ($wd as $day) {								
									if (strtolower($day->day) == strtolower($wk)) {									
										$d = json_decode(json_encode(["format"=> date("D",strtotime($day->day)),"day" => date("l",strtotime($day->day)),"start"=>$day->start,"end" => $day->end]));
										$is_working = true;
									}
								}							
								if ($is_working) {
									echo '
										<div data-day="'.$d->format.'" class="new-shop-services-day col s12 m12 l12">
											<div class="indic material-icons active click-btn">done</div>
											<div class="browser-default new-shop-services-item-name ispa-in">'.$d->day.'</div>
											<input type="time" value="'.$d->start.'"   class="browser-default new-shop-services-item-duration day-start ispa-in">
											<div class="time-to">to</div>
											<input type="time" value="'.$d->end.'" class="browser-default new-shop-services-item-cost day-end ispa-in">
										</div>
									';
								}else{
									echo '
										<div data-day="'.$d->format.'" class="new-shop-services-day col s12 m12 l12">
											<div class="indic material-icons click-btn"></div>
											<div class="browser-default new-shop-services-item-name ispa-in">'.$d->day.'</div>
											<input type="time" value=""   class="browser-default new-shop-services-item-duration day-start ispa-in">
											<div class="time-to">to</div>
											<input type="time" value="" class="browser-default new-shop-services-item-cost day-end ispa-in">
										</div>
									';
								}
	 						}
						}
					 ?>				
				</div>
				<div class="bus-edit-group edit-prefs">
					<div class="edit-pref-head  center">Preferences</div>
					<?php 
						$prefs = $this->commonDatabase->get_data("ispa_bus_prefs",1,false,"business",$_SESSION["business"]);
						if ($prefs) {
							$prefs = $prefs[0];
						}					
					 ?>
					<div class="edit-pref" data-item="app_con">
						<div class="edit-pref-details">
							<div class="pref-name">
							Automatic appointment confirmation
							</div>
							<div class="edit-pref-desc">
								Appointments will be confirmed automatically upon booking
							</div>
						</div>
						<div class="pref-check click-btn <?php echo $prefs ? $prefs["app_con"] ? "active" :"":""; ?>">
							<i class="material-icons">done</i>
						</div>
					</div>
					<div class="edit-pref" data-item="app_cash">
						<div class="edit-pref-details">
							<div class="pref-name">
							Allow cash payments
							</div>
							<div class="edit-pref-desc">
								Enable cash payments by clients
							</div>
						</div>
						<div class="pref-check <?php echo $prefs ? $prefs["app_cash"] ? "active" :"":""; ?> click-btn">
							<i class="material-icons">done</i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>