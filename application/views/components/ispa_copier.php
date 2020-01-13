<div class="ispa-copier row">
	<div class="col s12 m2 l4"></div>
	<div class="col s12 m8 l5">
		<div class="copier-cont">
			<input type="text" readonly="" value="<?php echo base_url(); ?>" class="ispa-in browser-default link-inp">
			<div class="copy-instr">Copy this link and share with your friends or your specialist</div>
			<div class="ispa-group">
				<button class="material-icons click-btn copy-tool cancel-copy">close</button>			
				<button data-tooltip="Copy link" data-position="left" class="material-icons tooltipped click-btn copy-tool right copy-go">link</button>
				<button data-tooltip="Invite via email" data-position="left"  class="material-icons click-btn right copy-tool tooltipped inv-email">email</button>
			</div>
		</div>
		<div class="email-invite">
			<div class="copy-instr">Enter email address to invite</div>
			<input type="email" placeholder="Email address" class="ispa-in browser-default invite-email">			
			<div class="ispa-group inv-tools">
				<button class="material-icons click-btn copy-tool cancel-invite">close</button>	
				<button data-tooltip="Send" data-position="left"  class="material-icons click-btn right copy-tool tooltipped inv-go">send</button>
			</div>
		</div>
	</div>
	<div class="col s12 m2 l3"></div>
</div>