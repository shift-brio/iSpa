<div class="switch-head">
	<a href="<?php echo base_url(); ?>" class="portal-back click-btn">
		<i class="material-icons">chevron_left</i>
	</a>
	BUSINESS PORTAL 
	<div>Select account to manage</div>
</div>
<div class="ispa-business-switch row">	
	<div class="col s12 m3 l3"></div>
	<div class="col s12 m6 l6 switch-cont">
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
					$url = base_url("index.php/business/open/".$bus["identifier"]);
					echo '<a href="'.$url.'">
							<div class="switch-item">
								'.$bus["name"].'
							</div>
						</a>';
				}								
			}
			if (sizeof($staff) > 0) {
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
	<div class="col s12 m3 l3"></div>
</div>