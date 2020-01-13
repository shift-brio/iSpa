<div class="ispa-explore">
	<dis class="row">
		<di class="col xs12 s12 m6 l5 ispa-explore-cont">
			<div class="explore-head">
				<div class="explore-head-name">Type shop name,location,type</div>
				<button data-tooltip="Close" data-position="left"  class="right click-btn tooltipped explore-close material-icons">close</button>
				<button data-tooltip="Near me" data-position="left"  class="right click-btn tooltipped explore-near hidden material-icons">near_me</button>
			</div>
			<div class="explore-services">
				<div class="explore-in">
					<a data-item='favorites' class="explore-list-item active click-btn">Favorites</a>
					<?php 
						$types = common::busTypes();
						if ($types) {
							foreach ($types as $type) {
								echo  common::renderType($type);
							}
						}
					 ?>
				</div>
			</div>
			<div class="explore-body">				
				<?php 
					$u = isset($_SESSION['user']->ispa_id) ? $_SESSION["user"]->ispa_id : false;
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
		</dis>
	</div>
</di>