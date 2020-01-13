<div class="bus-appointment row">
	<div class="bus-appointment-head">
		<button data-tooltip="Close" data-position="right" class="bus-appoint-back tooltipped click-btn">
			<i class="material-icons">close</i>
		</button>
		<div class="bus-appointment-name">
			APPOINTMENT			
		</div>
		<button class="checkout click-btn">CHECKOUT</button>
	</div>
	<div class="col s12 m2 l3"></div>
	<div class="col s12 m8 l6 bus-appointment-cont">
		<div class="bus-appointment-cont-body">
			<div class="appoint-user">
				<div class="appoint-prof">
					<img src="<?php echo base_url("uploads/system/default_prof_white.png"); ?>" alt="" class="appoint-img">
				</div>
				<div class="appoint-user-details">
					<div class="appoint-detail-name">						
					</div>
					<div class="appoint-detail-loc">						
					</div>
					<div class="appoint-detail-phone">						
					</div>
				</div>
				<div class="appoint-visits">
					<div class="visits-head">VISITS</div>
					<div class="visits-count"></div>
				</div>
			</div>
			<div class="appoint-services">
				<div class="appoint-services-head">
					SERVICES
				</div>
				<div class="appoint-services-body">
					<table class="service-table bordered centered">						
						<tbody class="table-body">
							
						</tbody>
					</table>
				</div>
			</div>
			<div class="appoint-staff">
				<div class="appoint-staff-head">STAFF</div>
				<div class="appoint-staff-name"></div>
			</div>
			<div class="appoint-staff">
				<div class="appoint-staff-head">PAYMENT</div>
				<div class="appoint-pay-status"></div>
			</div>
			<div class="appoint-staff">
				<div class="appoint-staff-head">Note</div>
				<div class="appoint-note flow-text center">
					Not note
				</div>
			</div>
			<button data-tooltip="Send client a message" data-position="left" class="right tooltipped click-btn appoint-sms">
				<i class="material-icons">message</i>
			</button>
		</div>
		<div class="bus-appointment-tools">
			<button data-tooltip="Cancel appointment" data-position="top" class="bus-appointment-tool app-canc left tooltipped click-btn">CANCEL</button>
			<button data-tooltip="Missed appointment" data-position="top" class="bus-appointment-tool  app-miss tooltipped click-btn">MISSED</button>
			<button data-tooltip="Confirm appointment" data-position="top" class="bus-appointment-tool right app-conf tooltipped click-btn">CONFIRM</button>
		</div>
	</div>
	<div class="col s12 m2 l3"></div>	
</div>