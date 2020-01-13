<div class="ispa-staff ispa-row row">
	<div class="col s12 l4 m6 staff-cont">
		<div class="staff-head">
			<button class="staff-tool click-btn left staff-close">
				<i class="material-icons">chevron_left</i>
			</button>
			<div class="staff-title">
				STAFF
			</div>
			<button data-tooltip="Add staff member" data-position="left" class="staff-tool tooltipped click-btn left staff-add">
				<i class="material-icons">add</i>
			</button>
		</div>
		<div class="staff-body">
			<div class="add-staff">
				<div class="add-staff-title">
					ADD A STAFF MEMBER
				</div>
				<div class="add-staff-body">
					<div class="ispa-group">
						<label  class="ispa-label">Name 
							<small>(name registered with iSpa)</small>
						</label>
						<input type="text" placeholder="Type user name here" class="ispa-in staff-suggest-in browser-default">
					</div>
					<div class="ispa-group">
						<label  class="ispa-label">Password 
							<small>(Let the user enter their password)</small>
						</label>
						<input type="password" placeholder="Password" class="ispa-in staff-suggest-pass browser-default">
					</div>
					<div class="staff-suggest">
						<div class="suggest-head">
							<div class="suggest-title">Select user from suggestions below</div>
							<button class="right click-btn close-suggests">
								<i class="material-icons">close</i>
							</button>
						</div>
						<div class="suggest-body">
														
						</div>						
					</div>
					<div class="ispa-group">
						<p class="">
					      <input  value="true" checked type="checkbox" class="filled-in staff_avail_add" id="staff_avail_add">
					      <label for="staff_avail_add" class="avail-label-add">Available for booking</label>
					    </p>
					</div>
					<div class="ispa-group">
						<button class="click-btn staff-go">
							<i class="material-icons">person_add</i> 
							<div class="right staff-go-desc">Add</div>
						</button>
					</div>
				</div>
			</div>
			<div class="staff-list">
				<?php
				$user = $_SESSION["user"]->ispa_id;
				$bus = $_SESSION["business"];
				$bus = common::getBus($bus);
				if ($bus) {
					$staff = $this->commonDatabase->get_data("ispa_staff",false,false,"business",$bus["identifier"]);
					if ($staff) {
						foreach ($staff as $st) {								
							echo common::renderStaff($st);
						}
					}else{
						echo 'No staff yet';
					}
				}			

			 ?>	
			</div>		
		</div>
	</div>
</div>