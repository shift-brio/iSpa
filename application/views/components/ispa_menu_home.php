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
	<!-- <div class="home-tools">
		<button class="new-apt click-btn">
			Make Appointment
			<i class="material-icons right">add_circle_outline</i>
		</button>
	</div> -->
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
	<div class="image-date"></div>
	<div class="image-slider">		
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