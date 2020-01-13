<div class="ispa-notifs">
	<div class="notif-item click-btn">
		<div class="notif-title">
			Appointment confirmation
		</div>
		<div class="notif-date">
			<?php echo date("jS F Y"); ?>
		</div>
		<div class="notif-body">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit.
		</div>
	</div>
	<div class="notif-item click-btn active">
		<div class="notif-title">
			Appointment confirmation
		</div>
		<div class="notif-date">
			<?php echo date("jS F Y"); ?>
		</div>
		<div class="notif-body">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit.
		</div>
	</div>
</div>

<?php echo $this->load->view("components/row_holder",["p" => "open", "id" => "ispa-notif-view"], true); ?>	
	<div class="modal-body">		
		<div class="notif-title main">
			Appointment confirmation
		</div>
		<div class="notif-date main">
			<?php echo date("jS F Y"); ?>
		</div>
		<div class="notif-body main">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit.
		</div>
	</div>
	<div class="modal-tools">
		<button class="modal-tool left click-btn close">
			<i class="material-icons">arrow_back</i>
		</button>		
	</div>	
<?php echo $this->load->view("components/row_holder",["p" => "close"], true); ?>