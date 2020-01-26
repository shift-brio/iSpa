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
		}else{
			$(this).val("false");
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
					alert(response.m,5000,"error");
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

$(document).ready(() =>{
	check_box();
})