<div class="new-shop" data-editing="false" data-shop="null">
	<div class="ispa-row row">
		<div class="col s12 m8 l3"></div>
		<div class="col s12 m8 l6 new-shop-cont">
			<div class="new-shop-title center">
				ADD SHOP/BUSINESS
			</div>
			<div class="new-shop-body">
				<div class="ispa-group">
					<label class="ispa-label">Business name</label>
					<input type="text" placeholder="Business name" class="browser-default add-shop-name ispa-in">
				</div>
				<div class="ispa-group">
					<label class="ispa-label">Phone Number</label>
					<input type="tel" placeholder="Business contact phone" class="browser-default ispa-in add-shop-phone">
				</div>
				<div class="ispa-group">
					<label class="ispa-label">Business location</small></label>
					<div  type="password" class="ispa-in ispa-loc browser-default">
						<div data-for="new-shop" class="location-picked">Click to pick a location</div>
						<button data-tooltip="Current location" data-position="left" class="material-icons tooltipped new-shop-my click-btn">location_on</button>
					</div>
				</div>
				<div class="ispa-group">
					<label class="ispa-label">Business type</label>
					<input type="text" data-curr="" placeholder="Business type eg barbershop" class="browser-default add-shop-type ispa-in">
					<div class="type-filler row">
						<div class="col s12 m12 l12 filled-items">
							
						</div>
					</div>
				</div>
				<div class="ispa-group">
					<label class="ispa-label">Services offered</label>
					<div class="browser-default new-shop-services ispa-in" service-for="new-bus">
						<div class="new-shop-services-title">
							Select/Add services that your business offer <small>eg Hair cut, Manicure</small>
							<button data-tooltip="New service" data-position="left" class="material-icons tooltipped click-btn add-service">add</button>
						</div>						
						<div class="new-shop-services-items row" data-item-default="new">
							<div class="flow-text center grey-text">Add services that your shop offer</div>						
						</div>
					</div>					
				</div>
				<div class="ispa-group">
					<label class="ispa-label">Working days</label>
					<div class="browser-default new-shop-services ispa-in" service-for="new-bus">
						<div class="new-shop-services-title">
							Select days that your business is open							
						</div>						
						<div class="new-shop-services-days row">
							<div data-day="sun" class="new-shop-services-day col s12 m12 l12">
								<div class="indic material-icons click-btn"></div>
								<div class="browser-default new-shop-services-item-name ispa-in">Sunday</div>
								<input type="time" class="browser-default new-shop-services-item-duration day-start ispa-in">
								<div class="time-to">to</div>
								<input type="time" class="browser-default new-shop-services-item-cost day-end ispa-in">
							</div>
							<div data-day="mon" class="new-shop-services-day col s12 m12 l12">
								<div class="indic material-icons active click-btn">done</div>
								<div class="browser-default new-shop-services-item-name ispa-in">Monday</div>
								<input type="time" value="08:00"   class="browser-default new-shop-services-item-duration day-start ispa-in">
								<div class="time-to">to</div>
								<input type="time" value="17:00" class="browser-default new-shop-services-item-cost day-end ispa-in">
							</div>
							<div data-day="tue" class="new-shop-services-day col s12 m12 l12">
								<div class="indic material-icons active click-btn">done</div>
								<div class="browser-default new-shop-services-item-name ispa-in">Tuesday</div>
								<input type="time" value="08:00"   class="browser-default new-shop-services-item-duration day-start ispa-in">
								<div class="time-to">to</div>
								<input type="time" value="17:00" class="browser-default new-shop-services-item-cost day-end ispa-in">
							</div>	
							<div data-day="wed" class="new-shop-services-day col s12 m12 l12">
								<div class="indic material-icons active click-btn">done</div>
								<div class="browser-default new-shop-services-item-name ispa-in">Wednesday</div>
								<input type="time" value="08:00"   class="browser-default new-shop-services-item-duration day-start ispa-in">
								<div class="time-to">to</div>
								<input type="time" value="17:00" class="browser-default new-shop-services-item-cost day-end ispa-in">
							</div>	
							<div data-day="thu" class="new-shop-services-day col s12 m12 l12">
								<div class="indic material-icons active click-btn">done</div>
								<div class="browser-default new-shop-services-item-name ispa-in">Thursday</div>
								<input type="time" value="08:00"   class="browser-default new-shop-services-item-duration day-start ispa-in">
								<div class="time-to">to</div>
								<input type="time" value="17:00" class="browser-default new-shop-services-item-cost day-end ispa-in">
							</div>
							<div data-day="fri" class="new-shop-services-day col s12 m12 l12">
								<div class="indic material-icons active click-btn">done</div>
								<div class="browser-default new-shop-services-item-name ispa-in">Friday</div>
								<input type="time" value="08:00"   class="browser-default new-shop-services-item-duration day-start ispa-in">
								<div class="time-to">to</div>
								<input type="time" value="17:00" class="browser-default new-shop-services-item-cost day-end ispa-in">
							</div>
							<div data-day="sat" class="new-shop-services-day col s12 m12 l12">
								<div class="indic material-icons click-btn"></div>
								<div class="browser-default new-shop-services-item-name ispa-in">Saturday</div>
								<input type="time" class="browser-default new-shop-services-item-duration day-start ispa-in">
								<div class="time-to">to</div>
								<input type="time" class="browser-default new-shop-services-item-cost day-end ispa-in">
							</div>
						</div>
					</div>
				</div>
				<button class="right click-btn bus-go bus-tool">Add Business</button>
			</div>
			<div class="new-shop-tools">
				<button class="left click-btn red-text black bus-close bus-tool">Cancel</button>		
			</div>
		</div>
		<div class="col s12 m8 l3"></div>
	</div>
</div>
<!-- barbershop
hair salon
nail salon
beauty salon
eyebrows & lashes 
massage
makeup artist
tattoo shops
day spa
personal trainer
piercing -->
