<div class="ispa-home">
	<div class="row ispa-home-row">
		<div class="col s12 m4 l3">
			<button class="new-apt click-btn">Book Appointment</button>
			<?php $this->load->view("components/next_appointment"); ?>
		</div>
		<div class="col s12 m8 l9 ispa-home-body">
			<div class="home-list">
				Favourites & Recent
			</div>
			<div class="ispa-home-content">
				<?php 
					$u = isset($_SESSION['user']->ispa_id) ? $_SESSION["user"]->ispa_id : null;
					$items = $this->commonDatabase->get_data("ispa_favorites",false,false,"user",$u);
					if ($items) {
						foreach ($items as $item) {
							echo common::renderExplore($item);
						}
					}else{
						echo '<div class="flow-text cetnter explore-none">You have not added any shop to your favorites yet.</div>';
					}
				 ?>
			</div>
		</div>					
	</div>
</div>
<button data-tooltip="Add new" data-position="left" class="ispa-new material-icons tooltipped click-btn">add</button>