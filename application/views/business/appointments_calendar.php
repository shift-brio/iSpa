<div class="appointments-calendar" data-day="<?php echo $date; ?>">
	<div class="appointments_calendar_head">				
		<div class="cal-cur"><?php echo date("jS F Y",strtotime($date)); ?></div>
		<div class="cal-btns">	
			<button data-tooltip="Previous day" data-position="right" class="tooltipped click-btn cal-prev">
				<i class="material-icons">chevron_left</i>
			</button>				
			<button data-tooltip="Next day" data-position="left" class="tooltipped cal-next cal-btn click-btn">
				<i class="material-icons">chevron_right</i>
			</button>			
		</div>			
	</div>
	<div class="cal">
		<div class="cal-body">
			<div class="cal-days">
				<div class="calendar-days">
					<div class="cal-day">SUN</div>
					<div class="cal-day">MON</div>
					<div class="cal-day">TUE</div>
					<div class="cal-day">WED</div>
					<div class="cal-day">THUR</div>
					<div class="cal-day">FRI</div>
					<div class="cal-day">SAT</div>
				</div>			
			</div>
			<div class="cal-dates">			
				<?php 
					echo common::bus_calendar(false,false,false,$_SESSION["business"]); 
				?>
			</div>
		</div>
	</div>
</div>