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
function get_length(val){
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