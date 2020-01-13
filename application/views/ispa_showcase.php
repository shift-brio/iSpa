<div class="ispa_showcase">
	<div class="showcase-head">
		<button class="close-showcase showcase-tool click-btn">
			<i class="material-icons">close</i>
		</button>
		<div class="showcase-title">
			JM Barbers - SHOWCASE
		</div>
		<?php 
			if (isset($_SESSION["business"])) {
				echo '
				<button class="add-showcase right showcase-tool click-btn">
					<i class="material-icons">camera</i>
				</button>	';
			}
		 ?>	
	</div>
	<div class="showcase-list row">
						
	</div>
</div>
<div class="showcase-viewer">
	<div class="showcase-head">
		<button class="close-viewer showcase-tool click-btn">
			<i class="material-icons">close</i>
		</button>
		<div class="showcase-title">			
		</div>
		<?php 
			if (isset($_SESSION["business"])) {
				echo '
					<button class="remove-showcase right showcase-tool click-btn">
						<i class="material-icons">delete</i>
					</button>
				';
			}
		 ?>		
	</div>
	<div class="viewer-body">
		<img src="" alt="" class="showcased">
	</div>
</div>
<div class="showcase-add row">
	<div class="col s12 m6 l4 showcase-add-cont">
		<div class="sh-add-title">
			Add an image to showcase your workplace
		</div>
		<div class="sh-add-body">
			<div class="sh-cont">
				<label class="show-label" for="sel_show">
					<img src="" alt="Click on camera to select image" class="add-show">
				</label>
			</div>
			<div class="sh-tools">				
				<label class="show-label" for="sel_show">
					<span type="input" class="click-btn sh-tool">
						<i class="material-icons">camera_alt</i>
					</span>
				</label>
				<input onchange="read_show(this)"  type="file" id="sel_show" name="sel_show" class="sel_show hidden">
			</div>
		</div>
		<div class="sh-add-tools">
			<button class="left click-btn close-sh sh-add-tool">
				<i class="material-icons">close</i>
			</button>
			<button class="right click-btn add-sh sh-add-tool">
				SAVE PICTURE
			</button>
		</div>
	</div>
</div>