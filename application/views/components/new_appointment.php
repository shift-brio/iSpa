<div class="new-appointment" data-business="">
	<div class="new-appointment-head">
		<!-- BOOK AN  -->APPOINTMENT
	</div>
	<div class="row new-appointment-row">
		<div class="col s12 m2 l3"></div>
		<div class="col s12 m8 l5 new-appointment-area">			
			<div class="new-appointment-body">
				<div class="ispa-group">
					<label  class="ispa-label">Appointment with:</label>
					<input disabled="true" value="iSpa" type="text" class="ispa-in book-shop browser-default">
				</div>
				<div class="ispa-group">
					<label  class="ispa-label">Service location</label>
					<select class="ispa-in browser-default book-place">
						<option value="shop">Shop</option>
						<option value="home">Home service</option>
					</select>
				</div>
				<div class="ispa-group">
					<label  class="ispa-label">Service(s) booked</label>
					<div class="appointment-services">
						<div class="flow-text center">This shop does not offer any services yet.</div>
					</div>
				</div>
				<div class="ispa-group">
					<label  class="ispa-label">Staff booked</label>
					<select class="ispa-in browser-default book-staff">
						<option value="">No staff</option>						
					</select>
				</div>
				<div class="ispa-group">
					<label  class="ispa-label">Appointment time</label>
					<input readonly="true" placeholder="Set time and date of appointment" type="text" class="ispa-in browser-default book-time">
				</div>
				<div class="ispa-group">
					<label  class="ispa-label">Payment 
						<small class="service-total">Total: Ksh. 
							<span class="service-tot-val">0.00</span>
						</small>
					</label>
					<select class="ispa-in browser-default book-payment">
						<option value="wallet">Wallet - balance Ksh. <?php echo number_format(wallet::balance()->balance,2); ?></option>
						<option value="cash">Cash</option>												
					</select>
				</div>	
				<div class="ispa-group">
					<label  class="ispa-label">Leave a note</label>
					<textarea placeholder="Leave a note" class="ispa-in book-note ispa-textarea browser-default"></textarea>
				</div>			
			</div>
			<div class="new-appointment-tools">
				<button data-position="top" data-tooltip="Cancel appointment" class="left click-btn tooltipped cancel-new-app  new-appointment-tool">
					<i class="material-icons">close</i>
				</button>
				<div class="appointment-more">
					<button data-position="top" data-tooltip="Book appointment" class="click-btn tooltipped change-app green new-appointment-tool">Change Details</button>					
				</div>
				<button data-position="top" data-tooltip="Book appointment" class="right click-btn tooltipped green book-go new-appointment-tool">Book</button>
			</div>			
		</div>
		<div class="col s12 m2 l4"></div>
	</div>
	<?php $this->load->view("components/booking_calendar") ?>
</div>