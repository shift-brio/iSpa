<div class="ispa-body">	
	<div class="ispa">		
		<?php $this->load->view("components/ispa_explore"); ?>		
		<?php $this->load->view("components/new_appointment"); ?>		
		<?php $this->load->view("components/ispa_nav"); ?>
		<?php $this->load->view("components/ispa_client_menu"); ?>
		<div class="ispa-area">
			<?php $this->load->view("components/ispa_home"); ?>
		</div>		
		<div class="ad-cont">
			<div class="add-list">
				<div class="add-item click-btn">
					<i class="add-item-icon material-icons">today</i>
					<div class="right add-item-name">Appointment</div>
				</div>
				<div class="add-item click-btn">
					<i class="add-item-icon material-icons">work</i>
					<div class="right add-item-name">Business</div>
				</div>
			</div>			
		</div>
	<?php $this->load->view("components/ispa_business"); ?>			
	</div>		
</div>
<?php $this->load->view("components/ispa_map_picker"); ?>	
<?php $this->load->view("components/new_shop"); ?>
<?php $this->load->view("components/ispa_copier"); ?>
<?php isset($_SESSION['user']) ? $this->load->view("components/user_settings") : ""; ?>
<?php $this->load->view("ispa_showcase"); ?>