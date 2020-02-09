<div class="booking-calendar">
	<div class="booking-calendar-cont row">
		<div class="col s12 m12 l3"></div>
		<div class="col s12 m12 l5 booking-calendar-body">	
			<div class="calendar-details n-d">					
				<div class="calendar-name center"><?php echo date("F Y") ?></div>		
			</div>						
			<div class="calendar" data-month="<?php echo date("m") ?>" data-year="<?php echo date("Y") ?>">							
				<div class="calendar-days">
					<div class="calendar-day">SUN</div>
					<div class="calendar-day">MON</div>
					<div class="calendar-day">TUE</div>
					<div class="calendar-day">WED</div>
					<div class="calendar-day">THUR</div>
					<div class="calendar-day">FRI</div>
					<div class="calendar-day">SAT</div>
				</div>
				<div class="calendar-dates">
					<?php 									
					$month_data = common::monthCalendar(date("m"),date("Y"));	
					echo $month_data;				
					?>								 
				</div>
			</div>			
			<div class="book-suggests">
				
			</div>	
			<div class="calendar-details">
				<button data-tooltip="Cancel" data-position="right" class=" material-icons tooltipped cal-tool close-calendar click-btn left">arrow_back</button>

				<div class="calendar-title">Select date and time</div>									
				<button data-tooltip="Previous month" data-position="right" class=" material-icons tooltipped cal-tool click-btn prev-month">chevron_left</button>			
				<button data-tooltip="Next month" data-position="left" class=" material-icons tooltipped cal-tool click-btn next-month">chevron_right</button>					
			</div>					
		</div>
		<div class="col s12 m12 l4"></div>
	</div>
</div>