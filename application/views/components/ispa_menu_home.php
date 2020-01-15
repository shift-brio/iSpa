<div class="home-page">
	<div class="home-content">
		<div class="home-top">
			<input placeholder="Find shops" class="click-btn search_dummy" type="text" />
			<div class="home-header upcoming-t">Upcoming appointment</div>
			<div class="upc-conr">
				<?php $this->load->view("components/next_appointment"); ?>
			</div>
			<div class="home-header res-h">Recents & Favorites</div>	
		</div>
		<div class="recents">			
			<?php 
				$favs = $this->commonDatabase->get_data("ispa_favorites",false,false,"user", $_SESSION["user"]->ispa_id);
				if ($favs) {
					foreach ($favs as $fav) {						
						echo common::renderExplore(["shop" => $fav["shop"]]);
					}
				}
			 ?>		
		</div>
	</div>		
	<div class="home-tools">
		<button class="new-apt click-btn">
			Make Appointment
			<i class="material-icons right">add_circle_outline</i>
		</button>
	</div>
</div>
<div class="ispa-bs app-cover">
	<div class="ipsa-bs-cont">
		<div class="ispa-bs-details">
			<div class="ispa-bs-name app-title">
				<div class="ispa-bs-title">
					
				</div>
				<button class="click-btn favorite">
					<i class="material-icons">favorite_outline</i>
				</button>
			</div>
			<div class="ispa-bs-loc">
				
			</div>
		</div>
		<div class="ispa-bs-body">
			<div class="shop-images">
				<div class="image-date"><?php echo date("jS F Y");?></div>
				<div class="image-slider main">		
					<div class="slider-img">
						<img class="sl" src="<?php echo base_url("uploads/logo/ispa.png"); ?>">
					</div>
					<div class="slider-control">
						<button class="click-btn sh-tool prev left">
							<i class="material-icons">keyboard_arrow_left</i>
						</button>		
						<button class="click-btn sh-tool next right">
							<i class="material-icons">keyboard_arrow_right</i>
						</button>
					</div>
				</div>
			</div>
			<div class="ispa-bs-tabs">
				<button class="ispa-bs-tab click-btn active">
					Services
				</button>
				<button class="ispa-bs-tab click-btn">
					Details
				</button>
			</div>
			<div class="bs-tab-cont serv active">
				
			</div>
			<div class="bs-tab-cont det">
				<div class="app-title det-t">Working Days</div>
				<div class="w-list">
					
				</div>
				<div class="app-title det-t">Contacts</div>
				<div class="c-item c-phone">
					<div class="c-title">Phone</div>
					<div class="c-val"></div>
				</div>
			</div>
		</div>
		<div class="ispa-bs-tools">
			<button class="bs-tool click-btn close">
				<i class="material-icons">arrow_back</i>
			</button>
			<button class="bs-tool click-btn right bs-book">
				Book appointment
				<i class="material-icons right">add_circle_outline</i>
			</button>
		</div>
	</div>
</div>

<div class="gallery">
	<div class="image-date"><?php echo date("jS F Y");?></div>
	<div class="image-slider">		
		<div class="slider-img">
			<img class="sl" src="<?php echo base_url("uploads/showcase/jm_barbers.jpeg"); ?>">
		</div>
		<div class="slider-control">
			<button class="click-btn sh-tool prev left">
				<i class="material-icons">keyboard_arrow_left</i>
			</button>		
			<button class="click-btn sh-tool next right">
				<i class="material-icons">keyboard_arrow_right</i>
			</button>
		</div>
	</div>
	<button class="close-g click-btn">
		<i class="material-icons">close</i>
	</button>
</div>

<div class="app-cover search-area">
	<div class="search-cont">
		<div class="search-top">
			<input type="text" placeholder="Find shops" class="search-input"/>
			<button class="search-go click-btn right">
				<i class="material-icons">arrow_forward</i>
			</button>
		</div>
		<div class="search-body">
			<div class="search-recents">
				<div class="recent-t">Recents & Favorites</div>
				<div class="recent-list">
					
				</div>
			</div>
			<div class="search-res">
				<div class="search-res-t">Search results</div>
				<div class="search-list">

				</div>
			</div>
		</div>
		<div class="search-tools tools">
			<button class="tool click-btn left close">
				<i class="material-icons">arrow_back</i>
			</button>
			<img class="right search-load" src="<?php echo base_url("uploads/system/loaders/loader-1.svg"); ?>" />
		</div>
	</div>
</div>

<?php echo $this->load->view("components/row_holder",["p" => "open", "id" => "ispa-appt",], true); ?>
	<div class="modal-top">
		<button class="app-bar d-pend"/>
	</div>
	<div class="modal-body">
		<div class="modal-title lato appt-title">
			Make Appointment
		</div>
		<div class="modal-content">
			<div class="appt-content">
				<div class="appt-in">
					<label class="input-label">Shop</label>
					<div class="input-content appt-shop">
						
					</div>
				</div>				
				<div class="appt-in">
					<label class="input-label">Services</label>
					<div class="input-content service-list">
						
					</div>
				</div>
				<div class="appt-in">
					<label class="input-label">Staff</label>
					<select class="input-content browser-default staff-sel">
						
					</select>
				</div>
				<div class="appt-in">
					<label class="input-label">Date</label>
					<div class="input-content date-sel click-btn"></div>
				</div>
				<div class="appt-in">
					<label class="input-label">
						Payment
						<label class="right payable"></label>
					</label>
					<div class="input-content">
						Not paid
						<button class="pay-btn click-btn">
							Pay now	
							<i class="material-icons right">credit_card</i>		
						</button>
					</div>
				</div>
				<div class="appt-in">
					<br>
					<label class="input-label"></label>
					<div contenteditable="true" class="input-content book-note"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-tools appt-t">
		<button class="modal-tool close-appt left click-btn close">
			<i class="material-icons">arrow_back</i>
		</button>
		<div class="appt-tools in-f">
			<button id="can-appt" class="appt-tool hidden click-btn">
				<i class="material-icons">delete</i>
				<div class="tool-name">Delete</div>
			</button>			
			<button id="re-appt" class="appt-tool hidden click-btn">
				<i class="material-icons">refresh</i>
				<div class="tool-name">Rebook</div>
			</button>
			<button id="appt-go" class="appt-tool click-btn">
				<i class="material-icons">done</i>
				<div class="tool-name">Book now</div>
			</button>
			</div>
		</div>
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>
<?php $this->load->view("components/booking_calendar"); ?>


<!-- ispa pay -->
<?php echo $this->load->view("components/row_holder",["p" => "open", "id" => "ispa-pay"], true); ?>
	<div class="modal-top">	
	</div>
	<div class="modal-body">
		<div class="modal-title lato appt-title">
			Make payment
		</div>
		<div class="modal-content pay-details">
			<div class="appt-in">
				<div class="input-label tot-t">Total Amount</div>
				<div class="tot-a">
					Ksh. 400.00
				</div>	
			</div>	
			<div class="pay-vendor">
				<?php $this->load->view("components/lipa_mpesa"); ?>
			</div>
		</div>
	</div>
	<div class="modal-tools">
		<button class="modal-tool left click-btn close-pay close">
			<i class="material-icons">arrow_back</i>
		</button>
		<button class="modal-tool right click-btn complete-pay">
			Complete payment
			<i class="material-icons right">done</i>
		</button>
	</div>	
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>