<div class="ispa-help">
	<div class="row">
		<div class="col s12 m12 l3"></div>
		<div class="col s12 m12 l6 ispa-help-cont">
			<div class="ispa-help-head">				
				<input type="text" placeholder="Search for help topics" class="browser-default ispa-in help-search">
				<button class="click-btn right close-help">
					<i class="material-icons">close</i>
				</button>
			</div>
			<div class="ispa-help-body">
				<?php
					$help = $this->commonDatabase->get_data("ispa_help",false,10,"visible",1);					
					if ($help) {
					 	foreach ($help as $item) {
					 		echo common::renderHelp($item);
					 	}
					}else{
						echo '<div class="flow-text">No help data</div>';
					} 
				 ?>				
			</div>
		</div>
		<div class="col s12 m12 l3"></div>
	</div>	
	<?php if(common::isAdmin()){
		echo '<div class="new-help">		
					<div class="ispa-row row">
						<div class="col s12 m8 l5 new-help-area">
							<div class="help-editor-head">
								New help item
							</div>
							<div class="help-editor-body">
								<div class="ispa-group">
									<label class="ispa-label">Help topic</label>
									<input placeholder="Help item topic" type="text" class="browser-default appt-input ispa-in help-topic">
								</div>
								<div class="ispa-group">
									<label class="ispa-label">Help content</label>
									<textarea name="help-content" id="help-content" class="help-content"></textarea>
									<script type="text/javascript">
										CKEDITOR.replace("help-content");
									</script>
								</div>
							</div>
							<div class="help-editor-tools">
								<button class="left click-btn help-go">Done</button>
							</div>
						</div>
					</div>
				</div>
				<button data-tooltip="New help item" data-position="right" class="new-help-btn tooltipped material-icons click-btn">add</button>';
		} 
	?>
</div>