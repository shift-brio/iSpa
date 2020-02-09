base_url = $("base").attr("href");
chat_interval = false;
drop_down = function(){
	$('.dropdown-trigger').each(function(){
		$(this).dropdown(
		{
			inDuration: 0,
			outDuration: 200,
		}
		);
	})
}

tool_tip = function(){	
	$('.tooltipped').tooltip({delay: 50,html:true});
}

ispa_inits = function(){
	drop_down();tool_tip();
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
	$(".toast").click(function(){
		$(this).hide();
	})
}
function get_length(val = ""){
	return val.replace(/\s/g, '').length;
}
function validateInput(input,type = 'email'){
	if (type === 'phone') {
		var exp = /[+]+[0-9]+[0-9]+[0-9]+[7]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]/;
		var exp1 = /[0]+[7]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]/;

		if (exp.test(input) || exp1.test(input)) {
			return true;
		}else{
			return false;
		}
	} else if(type === 'email'){
		var exp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	}else{
		return false;
	}

	return exp.test(input);
}
in_array = function(item = '',array = []){
	for (var i = 0; i < array.length; i++) {
		if (item == array[i]) {
			return true;
		}
		return false
	}
}

internet_error = function(){
	notify("Network error, check your connection and try again.",5000,"error");
}

let prompt = (open = false, message = "", c = false, cfg = {n: "Cancel", p:"Ok"}) =>{
	$(".dialog-tool.negative, .dialog-tool.positive").unbind();
	$(".dialog-body").html("");
	$(".dialog-tool.negative").html(cfg.n);
	$(".dialog-tool.positive").html(cfg.p);
	
	if (open) {
		if (message != "" && c) {
			$(".ispa-dialog").show();			
			$(".dialog-body").html(message);

			$(".dialog-tool.negative").click(function(){
				c(false);
				prompt(false);
			})
			$(".dialog-tool.positive").click(function(){
				c(true);
				prompt(false);
			})
		}
	}else{
		$(".ispa-dialog").hide();
	}	
}
check_box = (el = '[type="checkbox"]') =>{
	$(`${el}`).click(function(){
		if ($(this).val() == "false" || $(this).val() == false) {
			$(this).val("true");
			$(this).prop("checked", true);
		}else{
			$(this).val("false");
			$(this).prop("checked", false);
		}
	})
}
let fetch = (data = {}, config = {type: "POST", process: false, url : ""}, callback = (res = false) =>{ console.log(res);}) =>{	
	if (config.url != "") {		
		let extra = {};
		if (!config.type) {
			config.type = "POST";
		}				
		if (config.process != undefined && !config.process) {
			extra = {
				contentType: false,       
				cache: false,             
				processData: false
			};
		}	
		loading(true);
		$.ajax({
			url: config.url,
			type: config.type,
			data: data,	
			extra,		
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {
					callback(response.m);							
				}else{
					notify(response.m,5000,"error");
				}
			},
			error:function(){
				internet_error();
			}
		})
	}
}
const copyText = (ele, m) => {  
  $(`.${ele}`).select();
  document.execCommand('copy');
  $(`.${ele}`).blur();
  
  if (get_length(m) > 0) {
  	notify(m);
  }
};

read_notif =  function(item  = false, c = false){
	if (item) {
		loading(true);
		$.ajax({
			url:base_url+"read_notif",
			type:"POST",
			data:{item:item},
			complete: function(){
				loading(false);
			},
			success: function(res){
				if (c) {
					c(res);
				}
			},
			error: function(){
				internet_error();
			}
		})
	}
}
x = res =>{
	res ? console.log(res) : "";
}
appoint_bus = function(business  = false, sel = false, c = false){
	if (business) {		
		loading(true);
		$.ajax({
			url:base_url+"appoint_bus",
			type:"POST",
			data: {business:business, sel: sel},
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {
					if (c) {
						c(response);
					}
				}else{
					notify(response.m,10000);
				}
			},
			error:function(){
				internet_error();
			}
		})
	}
}

save_prof = function(data = false){
	if (data) {
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
					$(".account-image, .account-img").attr("src",response.m.src);								
				}else{
					alert(response.m,5000,"error");
				}
			},
			error:function(){
				internet_error();
			}
		})
	}
}
del_prof = function(){
	loading(true);
	$.ajax({
		url:base_url+"del_prof",
		type:"POST",			
		complete:function(){
			loading(false);
		},
		success:function(response){
			if (response.status) {				
				$("img.account-image, .account-img").attr("src",response.m.src);
				$(".prof-options").hide();							
			}else{
				alert(response.m,5000,"error");
			}
		},
		error:function(){
			internet_error();
		}
	})
}
let slider_play = x =>{

}
$(document).ready(() =>{
	check_box();
})