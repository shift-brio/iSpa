<input type="file" onchange="read_prof(this)" name="edit-prof" id="edit-prof" accept="image/*" class="hidden">
<!-- prof pop up -->
<div class="prof-options">
	<div class="prof-list">
		<button class="click-btn prof-item change">
			<label for="edit-prof" class="edit-prof">
				Change profile picture
			</label>
		</button>
		<button class="click-btn prof-item rem">
			Remove profile picture
		</button>
		<button class="click-btn prof-item back">
			Back
		</button>
	</div>
</div>


<!-- profile preview -->
<div class="prof-preview">
	<div class="preview-cont">
		<div class="prev-body">
			<label for="edit-prof">
				<img class="pref-pre" src="">
			</label>
		</div>
		<div class="modal-tools">
			<button class="modal-tool left click-btn close close-prev">
				<i class="material-icons">arrow_back</i>
			</button>	
			<button class="modal-tool save-prof right click-btn">				
				Save Profile
			</button>	
		</div>
	</div>
</div>