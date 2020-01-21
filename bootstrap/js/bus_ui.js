const menu = () =>{
	$(".menu-btn").click(() =>{
		$(".menu").show();
	})
	$(".menu").click((e) =>{
		if ($(e.target).is(".menu")) {
			$(".menu").hide();
		}
	})
}

let loading = function(state = false,wid = false){			
	var loader = $(".main-loader");
	var loader_cover = $(".sms-loader");	
	if (state) {
		loader.show();	
	}else{		
		loader.hide();
	}
}
let notify = function(text = false,time = false,type = false,sound = false){
	var t = 5000;
	var cls = "info";
	if (text) {		
		if (type == 'warning') {
			var cls = "warning";
		}else if(type == 'error'){
			var cls = "error";
		}else{
			var cls = ""
		}				
		if (time) {
			t = time;
		}else{
			t = 5000;
		}
		Materialize.toast(text,t,cls)
	}
	if (sound) {

	}		
}
let fetch = (data = {}, config = {type: "POST", process: false}, callback = (res) =>{}) =>{
	loading(true);
	$.ajax({
		url:base_url+"save_prof",
		type:"POST",
		data:data,
		contentType: false,       
		cache: false,             
		processData:false,
		complete:function(){
			loading(false);
		},
		success:function(response){
			if (response.status) {
				$(".prof-preview").hide();
				$(".prof-options").hide();
				$("#edit-prof").val("");
				$(".account-image").attr("src",response.m.src);								
			}else{
				alert(response.m,5000,"error");
			}
		},
		error:function(){
			internet_error();
		}
	})
}
$(document).ready(() =>{
	menu();
})