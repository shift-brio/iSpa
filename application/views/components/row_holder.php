<?php 
	isset($p) ? "": exit("Kindly specify section to be returned.");

	if ($p == "open") {
		echo '
			<div class="row ispa-modal" id="'.(isset($id) ? $id: "").'">
			 <div class="col s12 m4 l3"></div>
			 <div class="col s12 m4 l6 modal-column '.(isset($id) ? $id: "").'">
		';
	}
   else
	echo '  </div>
			<div class="col s12 m4 l3"></div>
 		</div>'

 ?> 	