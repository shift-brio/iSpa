<div class="vendor">
	<div class="v-details">
		<div class="vendor-name">
			Lipa na M-Pesa
		</div>
		<div class="payment-type">
			Till Number
		</div>
		<input type="text" readonly="true" data-value="<?php echo $this->config->item("till"); ?>" value="<?php echo $this->config->item("till"); ?>" class="acc-no browser-default">
	</div>
	<div class="v-logo">
		<img src="<?php echo base_url("uploads/system/mpesa.png"); ?>" alt="mpesa-logo" class="v-image">
	</div>
</div>
<button class="click-btn mpesa-trig">
	Proceed to M-Pesa
	<i class="material-icons right">arrow_forward</i>
</button>
<br><br>
<div class="nb">	
	Use your iSpa registered phone number for payments
</div>