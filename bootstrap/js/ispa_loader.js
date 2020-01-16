$(document).ready(function(){	
	drop_down();tool_tip();	
})
generic_inits = function(){	
	drop_down();
	tool_tip();	
}
drop_down = function(){
	$('.dropdown-trigger').dropdown(
		{
			inDuration: 0,
      outDuration: 200,
		}
	);
}
tool_tip = function(){	
	$('.tooltipped').tooltip({delay: 50,html:true});
}
internet_error = function(){
	notify("Network error, check your connection and try again.",5000,"error");
}
loading = function(state = false,wid = false){			
	var loader = $(".main-loader");
	var loader_cover = $(".sms-loader");	
	if (state) {
		loader.show();	
	}else{		
		loader.hide();
	}
}
console_log = function(v){
	console.log(v);
}
notify = function(text = false,time = false,type = false,sound = false){
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
	/*setTimeout(function(){
		$("body").click(function(){
			$(".toast").hide();
		})
	},100)*/	
}
alert = function(text){
	notify(text);
}	
isMobile = function(){
	if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) 
	{
		return true;
	}
	else{
		return false;
	}	
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
get_menu = function(item = false, type = "client", callback = false){
	if (item && type) {
		loading(true);
		$.ajax({
			url:base_url+"menu_item",
			type:"POST",
			data:{item:item,type:type},
			complete:function(){
				loading(false);
				if ($(".menu").is(":visible")) {
					$(".in-menu-btn").click();
				}				
			},
			success:function(response){
				if (response.status) {					
					$(".app-content").html(response.m);
					if(item === "home"){
						home_tab();
					}else if (item == "notifications") {
						ispa_notifs();
						$('.n-indic').html("");
					}else if(item == "chats"){
						ispa_chats();
						if (callback) {
							get_chat(callback);
							chat_interval =  setInterval(get_chat,3000);
						}						
						$('.chat-notif').html("");
					}else if(item == "wallet"){
						ispa_wallet();
					}
					/*ispa_help();
					ispa_home();
					ispa_inits();
					explore_items();
					explore_t();
					ispa_new();
					ispa_appointment();
					next_appointment();
					bus_calendar();*/
				}else{					
					notify(response.m)
				}	
				$(".explore-body").html('<div class="flow-text center">Click on item to view shops</div>');					
			},
			error:function(){
				internet_error();
			}			
		})
	}
}
get_chat = function(item = false){
	if (!item) {
		item = $(".ispa-chat-go").attr("data-chat");
	}
	if (item) {
		if ($(".ispa-chat-go").attr("data-chat") == "") {
			loading(true);
		}
		$.ajax({
			url:base_url+"get_chat",
			type:"POST",
			data:{item:item},
			complete:function(){
				loading(false);
				if ($(".menu").is(":visible")) {
					/*$(".in-menu-btn").click();*/	
				}			
			},
			success:function(response){
				if (response.status) {
					$(".ispa-chat-list").hide();
					$(".ispa-chat-area").show();
					$(".ispa-chat-title").html(response.name);
					$(".ispa-chat-body").html(response.m);	
					$(".ispa-chat-go").attr("data-chat",item);
					$(".ispa-chat-body").scrollTop = $(".ispa-chat-body").scrollHeight;
					$(".ispa-help-chat").removeClass("active");
					if (item == "ispa") {
						$(".ispa-help-chat").addClass("active");
					}				
				}else{
					notify(response.m)
				}
			},
			error:function(){
				internet_error();
			}
		})
	}
}
top_up = function(code = false){
	if (code) {
		loading(true);
		$.ajax({
			url:base_url+"top_up",
			type:"POST",
			data:{code:code},
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {
					$(".top-up-code").val("");
					$(".top-up-cont").slideUp("fast");
					$(".account-balance").html(response.balance);
				}
				alert(response.m);
			},
			error:function(){
				internet_error();
			}
		})
	}
}
add_help = function(topic = false, content = false,edit = false){
	if (topic && content) {
		loading(true);
		$.ajax({
			url:base_url+"add_help",
			type:"POST",
			data:{topic:topic,content:content,edit:edit},
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {
					get_menu("help","client");
					$(".help-go").attr("data-edited","");
				}
				alert(response.m);
			},
			error:function(){
				internet_error();
			}
		})
	}
}
del_help = function(item = false){
	if (item) {
		loading(true);
		$.ajax({
			url:base_url+"del_help",
			type:"POST",
			data:{item:item},
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {
					$(".menu-item[data-item='help']").click();
				}
				alert(response.m);
			},
			error:function(){
				internet_error();
			}
		})
	}
}
search_help = function(key = false){
	if (key) {
		loading(true);
		$.ajax({
			url:base_url+"search_help",
			type:"POST",
			data:{key:key},
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {
					$(".ispa-help-body").html(response.m);
					help_click();	
				}else{
					alert(response.m);
				}				
			},
			error:function(){
				internet_error();
			}
		})
	}
}
read_notif =  function(item  = false){
	if (item) {
		$.ajax({
			url:base_url+"read_notif",
			type:"POST",
			data:{item:item}
		})
	}
}
send_chat = function(message = false , to = false){
	if (!message) {
		message = $(".ispa-chat-in").val();		
	}
	if (!to) {
		to = $(".ispa-chat-go").attr("data-chat");
	}

	if (message.length > 0 && to) {
		loading(true);
		$.ajax({
			url:base_url+"send_chat",
			type:"POST",
			data:{message:message,to:to},
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {					
					$(".ispa-chat-title").html(response.name);
					$(".ispa-chat-body").html(response.m);
					$(".ispa-chat-in").val("");						
				}else{
					alert(response.m);
				}				
			},
			error:function(){
				internet_error();
			}
		})
	}
}
sign_up = function(data = false){
	if (data) {
		$(".sign-load").show();
		$.ajax({
			url:base_url+"sign",
			type:"POST",
			data:data,
			complete:function(){
				$(".sign-load").hide();
				$(".sign-go").removeAttr("disabled");
			},
			success:function(response){
				if (response.status) {
					location.reload();
				}else{
					notify(response.m,5000,"error");
				}
			},
			error:function(){
				internet_error();
			}
		})
		return true;
	}else{
		return false;
	}
}
submit_shop = function(data = false){
	if (data) {
		loading(true);
		$.ajax({
			url:base_url+"submit_shop",
			type:"POST",
			data:data,
			complete:function(){
				$(".bus-go").removeAttr("disabled");
				loading(false);
			},
			success:function(response){
				if (response.status) {
					location.href = base_url+"business/"+response.m.bus;
				}else{
					notify(response.m);
				}
			},
			error:function(){
				internet_error();
			}
		})
	}
}
get_suggests = function(data = false){
	if (data) {
		$(".calendar-load-in").show();
		$.ajax({
			url:base_url+"get_suggests",
			type:"POST",
			data:data,
			complete:function(){
				$(".calendar-load-in").hide();
			},
			success:function(response){
				if (response.status) {
					$(".book-suggests").html(response.m);													
				}else{
					$(".book-suggests").html(response.m);
				}
				dur_sel();	
				tool_tip();
			},
			error:function(){
				internet_error();
			}
		})
	}
}
get_calendar = function(data){
	if (data) {
		$(".calendar-load-in").show();
		
		$(".calendar-dates").html("");
		$(".book-suggests").html("");
		$.ajax({
			url:base_url+"get_calendar",
			type:"POST",
			data:data,
			complete:function(){
				$(".calendar-load-in").hide();				
			},
			success:function(response){
				if (response.status) {
					$(".calendar-dates").html(response.m.calendar);
					$(".book-suggests").html('<div class="flow-text center">Click on date to view time slots available</div>');					
					$(".calendar").attr("data-month",response.m.month);
					$(".calendar").attr("data-year",response.m.year);
					$(".calendar-name").html(response.m.name);
					tool_tip();
				}else{
					$(".calendar-dates").html(response.m);
				}
				$(".calendar").show();
				dur_sel();
				date_sel();
			},
			error:function(){
				$(".booking-calendar").hide();
				internet_error();				
			}
		})
	}
}
appoint_bus = function(business  = false, sel = false, c = false){
	if (business) {		
		loading(true);
		$.ajax({
			url:base_url+"appoint_bus",
			type:"POST",
			data:{business:business, sel: sel},
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
submit_appointment =  function(data = false,editing = false){
	if (data) {		
		if (editing) {
			data.editing = true;
			data.edited = $("#ispa-appt").attr("data-edited");
		}
		loading(true);		
		$("#appt-go").attr("disabled","true");		
		$.ajax({
			url:base_url+"submit_appointment",
			type:"POST",
			data: data,
			complete:function(){
				loading(false);
				$("#appt-go").removeAttr("disabled");
			},
			success:function(response){
				if (response.status) {
					//location.reload();					
				}else{
					notify(response.m, 8000);
				}
			},
			error:function(){
				internet_error();
			}
		})
	}
}
get_explore = function(item = false, type ='list'){
	if (item && type) {
		loading(true);
		$.ajax({
			url:base_url+"get_explore",
			type:"POST",
			data:{type:type,item:item},
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {
					$(".explore-list-item").removeClass("active");
					$(".explore-list-item[data-item='"+item+"']").addClass("active");
					$(".explore-body").html(response.m)
					explore_items();
					booking();
				}else{
					alert(response.m);
				}
			},
			error:function(){
				internet_error();
			}
		})
	}
}
search_bus = function(key = false, c = false){
	if (key) {
		loading(true);
		$.ajax({
			url:base_url+"search_bus",
			type:"POST",
			data:{key:key},
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {					
					if (c) {
						c(response.m);
					}										
				}else{
					alert(response.m);
				}
			},
			error:function(){
				internet_error();
			}
		})
	}
}
bus_page = function(bus = false){
	if (bus) {		
		loading(true);
		$.ajax({
			url:base_url+"bus_page",
			type:"POST",
			data:{bus:bus},
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {
					$(".ispa-bs").show();
					$(".ispa-bs").attr("data-id",response.m.details.identifier);
					$(".bs-tab-cont.serv").html(response.m.services);
					$(".ispa-bs-title").html(response.m.details.name);
					$(".ispa-bs-loc").html(response.m.location.name.substr(0,30));
					$(".w-list").html(response.m.details.working_days);
					$(".c-phone > .c-val").html(response.m.details.phone);	
					if (response.m.rating.count == 1) {
						txt = "person";
					}else{
						txt = "people";
					}	
					$(".favorite > i").html("favorite_outline");
					if (response.m.favorite) {
						$(".favorite > i").html("favorite");
					}
					if (response.m.showcase.length > 0) {
						var list = response.m.showcase;
						var conf = {
							title : "image-date",
							img: "sl",
							prev: "sh-tool.prev",
							next: "sh-tool.next"
						}
						new Slider(list, conf);	
					}	
					$(".review-all").html(response.m.rating.rating +" - "+response.m.rating.count+" "+txt);
					$(".review-items").html(response.m.reviews);
					if (response.m.u_rating) {
						$(".rating-note").val("");
						$(".rating-note").val(response.m.u_rating.note);

						var u_rate = Number(response.m.u_rating.rating);
						$(".rater-btn").removeClass("open");
						for (var i = 1; i <= u_rate; i++) {							
							$(".rater-btn:nth-child("+i+")").addClass("open");
						}
					}
					bus_serv_list();					
				}else{
					notify(response.m,5000,"error");
				}
			}
		})
	}
}
send_rating = function(data = false){
	if (data && data.bus) {
		loading(true);
		$.ajax({
			url:base_url+"send_rating",
			type:"POST",
			data:data,
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {
					$(".rev-row").hide();
					$(".rating-note").val("");
					bus_page($(".ispa-business").attr("data-business"));
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
favorite = function(bus = false, target = false){
	if (bus && target) {
		loading(true);
		$.ajax({
			url:base_url+"favorites",
			type:"POST",
			data:{bus:bus},
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {	
					target(response);									
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

send_invite = function(email = false){
	if (email) {
		loading(true);
		$.ajax({
			url:base_url+"send_invite",
			type:"POST",
			data:{email:email},
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {
					$(".invite-email").val("");
					notify("Invite sent succesfully.");
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
change_pass = function(data = false){
	if (data) {
		$(".edit-load").show();
		$.ajax({
			url:base_url+"change_pass",
			type:"POST",
			data:data,
			complete:function(){
				$(".edit-load").hide();
			},
			success:function(response){
				if (response.status) {
					$(".edit-curr-pass").val("");
					$(".edit-new-pass").val("");
					$(".pass-change").hide();
					notify("Password changed succesfully.");
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
save_prof = function(data = false){
	if (data) {
		$(".edit-load").show();
		$(".appoint-loader").show();
		$.ajax({
			url:base_url+"save_prof",
			type:"POST",
			data:data,
			contentType: false,       
      cache: false,             
      processData:false,
			complete:function(){
				$(".edit-load").hide();
				$(".appoint-loader").hide();
			},
			success:function(response){
				if (response.status) {
					$("input.prof-change").val("");
					$("img.edit-prof").attr("src",response.m.src);
					$("span.edit-tool").html("camera");
					$("span.edit-tool").attr("data-tooltip","Change profile image");					
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
	$(".edit-load").show();
	$.ajax({
		url:base_url+"del_prof",
		type:"POST",			
		complete:function(){
			$(".edit-load").hide();
		},
		success:function(response){
			if (response.status) {
				$("input.prof-change").val("");
				$("img.edit-prof").attr("src",response.m.src);
				$("span.edit-tool").html("camera");
				$("span.edit-tool").attr("data-tooltip","Change profile image");					
			}else{
				alert(response.m,5000,"error");
			}
		},
		error:function(){
			internet_error();
		}
	})
}
save_edit = function(data){
	if (data) {
		$(".edit-load").show();
		$.ajax({
			url:base_url+"save_edit",
			type:"POST",
			data:data,			
			complete:function(){
				$(".edit-load").hide();
			},
			success:function(response){
				if (response.status) {
					location.reload();					
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
lookup_service = function(key = false){
	if (key) {
		loading(true);
	  $(".new-shop-services-items").html('<div class="flow-text center grey-text">Add services that your shop offer</div>');		
		$.ajax({
			url:base_url+"service_lookup",
			type:"POST",
			data:{key:key},			
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {
						$(".filled-items").html(response.m);
						$(".type-filler").show();
						fill_type();
				}else{
					$(".filled-items").html("");
					$(".type-filler").hide();
				}
			}
		})
	}
}
pre_services = function(id = false){
	if (id) {
		loading(true);
		$.ajax({
			url:base_url+"pre_services",
			type:"POST",
			data:{id:id},			
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {
						$(".new-shop-services-items").html(response.m);						
						book_sel();						
				}
			}			
		})
	}
}
get_appointment = function(item = false){
	if (item) {
		loading(true);
		$.ajax({
			url:base_url+"get_appointment",
			type:"POST",
			data:{item:item},			
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {
					$("#ispa-appt").show();		
					$("#ispa-appt").attr("data-editing",true);
					$("#ispa-appt").attr("data-business",response.m.business.identifier);
					$("#ispa-appt").attr("data-edited",item);
					$(".appt-shop").html(response.m.business.name);					
					$(".staff-sel").html(response.m.staff);
					$(".service-list").html(response.m.services);
					$(".date-sel").html(response.m.time);
					$(".payable").html(get_booked().amnt);					
					$("#appt-go").hide();
					$(".appt-bar").attr("class","app-bar appt-bar");

					$(".date-sel").addClass("editable");
					if (response.m.status == 0) {						
						$("#can-appt").removeClass("hidden");						
						if (response.m.confirmed == 0) {												
							$(".appt-bar").attr("class","app-bar appt-bar d-pend");
						}else if(response.m.confirmed == 1){
							$(".date-sel").removeClass("editable");
							$(".appt-bar").attr("class","app-bar appt-bar d-con");
						}else{	
							$(".date-sel").removeClass("editable");						
							$(".appt-bar").attr("class","app-bar appt-bar d-can");
						}
					}else{
						$(".date-sel").removeClass("editable");
						if (response.m.status == 1) {
							$(".appt-bar").attr("class","app-bar appt-bar d-done");
						}else{
							$(".appt-bar").attr("class","app-bar appt-bar d-can");
						}
					}				
				}else{
					notify(response.m);
				}
			},
			error:function(){
				internet_error();
			}		
		})
	}
}
rem_appointment = function(item = false){
	if (item && confirm("Cancel this appointment?")) {
		loading(true);
		$.ajax({
			url:base_url+"rem_apt",
			type:"POST",
			data:{item:item},			
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {
					location.reload()
				}else{
					notify(response.m,3000,"error");
				}
			},
			error:function(){
				internet_error();
			}			
		})
	}
}
get_day = function(day = false, type = "next"){
	if (day) {
		loading(true);
		$.ajax({
			url:base_url+"get_day",
			type:"POST",
			data:{day:day,type:type},			
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {
					$(".material-tooltip").hide();
					$(".cal-cur").html(response.m.active);
					$(".appointments-calendar").attr("data-day",response.m.date);
					$(".cal-dates").html(response.m.calendar);
					$(".day-appointments-body").html(response.m.appointments);
					$(".app-tot").html(response.m.app_tot);
					cal_dates();
					tool_tip();		
					day_func();			
				}else{
					notify(response.m,3000,"error");
				}
			},
			error:function(){
				internet_error();
			}			
		})
	}
}
bus_get = function(item = false){
	if (item) {
		loading(true);
		$(".bus-appointment").attr("data-user","");
		$(".bus-appointment").attr("data-appointment","");
		$.ajax({
			url:base_url+"get_appointment",
			type:"POST",
			data:{item:item},			
			complete:function(){
				loading(false);
			},
			success:function(response){
				if (response.status) {
					$(".bus-appointment").show();		
					$(".appoint-detail-name").html(response.m.user.name);
					$(".appoint-detail-loc").html(response.m.user.location);	
					$(".appoint-detail-phone").html(response.m.user.phone);
					$(".visits-count").html(response.m.user.count == 0 ? 1 : response.m.user.count);
					$(".table-body").html(response.m.s_table);
					$(".appoint-staff-name").html(response.m.staff_name);
					$(".appoint-pay-status").html(response.m.payment);
					$(".appoint-note").html(response.m.note == "" ? "No note": response.m.note);
					$(".bus-appointment").attr("data-user",response.m.user.id);
					$(".bus-appointment").attr("data-appointment",item);					
					if (response.m.confirmed != 0) {
						if (response.m.confirmed == 1) {
							$(".app-canc").attr("disabled",true);
							$(".app-canc").html("CONFIRMED");	
						}else{
							$(".app-canc").attr("disabled",true);
							$(".app-canc").html("CANCELLED");	
						}
					}else{
						$(".app-canc").html("CANCEL");
						$(".app-canc").removeAttr("disabled");
					}	
					$(".app-canc").show();	
					$(".app-conf").show();

					if (response.m.status == 1) {
						$(".checkout").hide();						
						$(".app-miss").hide();
						$(".app-conf").hide();	
						$(".app-canc").hide();												
					}else{
						if (response.m.past == 2) {
							$(".app-miss").show();
							$(".app-miss").html("CANCEL MISSED")
							$(".checkout").hide();	
							$(".app-canc").hide();
							$(".app-conf").hide();										
						}else if(response.m.past == 1){
							$(".app-miss").show();
							$(".app-miss").html("MISSED")
							$(".app-canc").hide();
							$(".app-conf").hide();							
						}else{
							$(".app-miss").hide();		
							$(".app-miss").html("MISSED");						
						}
						$(".checkout").show();						
					}														
					if (response.m.status == 0) {
						if (response.m.confirmed == 1) {						
							$(".app-conf").html("CONFIRMED");
							$(".app-conf").attr("disabled",true);										
						}else{											
							$(".app-conf").html("CONFIRM");
							$(".app-conf").removeAttr("disabled");
						}		
					}else{
						if (response.m.status == 2) {
							$(".app-conf").hide();
							$(".app-canc").hide();
						}else{	

							if (response.m.confirmed == 1) {						
								$(".app-conf").html("DONE");
								$(".app-conf").attr("disabled",true);										
							}else{											
								$(".app-conf").html("CANCELLED");
								$(".checkout").hide();
								$(".app-conf").attr("disabled",true);
							}								
						}
					}					
					tool_tip();
				}else{
					notify(response.m);
				}
			},
			error:function(){
				internet_error();
			}		
		})
	}
}
confirm_app = function(item = false){
	if (item) {
		$(".appoint-loader").show();
		$(".app-conf").attr("disabled",true);
		$.ajax({
			url:base_url+"confirm_app",
			type:"POST",
			data:{item:item},			
			complete:function(){
				$(".appoint-loader").hide();
				$(".app-conf").removeAttr("disabled");	
			},
			success:function(response){
				if (response.status) {					
					bus_get(item);			
				}else{
					notify(response.m,3000,"error");
				}
			},
			error:function(){
				internet_error();
			}			
		})
	}
}
cancel_app = function(item = false,note = false){
	if (item && note) {
		$(".appoint-loader").show();
		$(".app-canc").attr("disabled",true);
		$.ajax({
			url:base_url+"cancel_app",
			type:"POST",
			data:{item:item,note:note},			
			complete:function(){
				$(".appoint-loader").hide();
				$(".app-canc").removeAttr("disabled");	
			},
			success:function(response){
				if (response.status) {					
					bus_get(item);			
				}else{
					notify(response.m,3000,"error");
				}
			},
			error:function(){
				internet_error();
			}			
		})
	}
}
miss_app = function(item = false){
	if (item) {
		$(".appoint-loader").show();
		$(".app-miss").attr("disabled",true);
		$.ajax({
			url:base_url+"miss_app",
			type:"POST",
			data:{item:item},			
			complete:function(){
				$(".appoint-loader").hide();
				$(".app-miss").removeAttr("disabled");	
			},
			success:function(response){
				if (response.status) {					
					bus_get(item);			
				}else{
					notify(response.m,3000,"error");
				}
			},
			error:function(){
				internet_error();
			}			
		})
	}
}
checkout_get = function(item = false){
	if (item) {
		$(".appoint-loader").show();
		$(".ispa-checkout").attr("data-appointment","");		
		$.ajax({
			url:base_url+"get_appointment",
			type:"POST",
			data:{item:item,checkout:true},			
			complete:function(){							
				$(".appoint-loader").hide();				
			},
			success:function(response){
				if (response.status) {
						$(".checkout-total").val(response.m.total);					
						$(".ispa-checkout").show();
						$(".ispa-checkout").attr("data-appointment",item);
						$(".pay-name").html(response.m.pay_method);		
				}else{
					notify(response.m,3000,"error");
				}
			},
			error:function(){
				internet_error();
			}			
		})
	}
}
checkout = function(item = false, discount = 0){
	if (item) {
		$(".appoint-loader").show();		
		$.ajax({
			url:base_url+"checkout",
			type:"POST",
			data:{item:item,disc:discount},			
			complete:function(){							
				$(".appoint-loader").hide();				
			},
			success:function(response){
				if (response.status) {
						$(".ispa-checkout").attr("data-appointment","");	
						$(".checkout-total").val("");					
						$(".ispa-checkout").hide();						
						$(".pay-name").html("");
						$(".bus-appointment").hide();
						notify("Appointment complete",2000);
				}else{
					notify(response.m,3000,"error");
				}
			},
			error:function(){
				internet_error();
			}			
		})
	}
}
subscribe = function(sub = false){
	if (sub && (sub == "month" || sub == "year")) {
		loading(true);
		$.ajax({
			url:base_url+"subscribe",
			type:"POST",
			data:{sub:sub},			
			complete:function(){							
				loading(false);			
			},
			success:function(response){
				if (response.status) {
						location.reload();
				}else{
					notify(response.m,3000,"error");
				}
			},
			error:function(){
				internet_error();
			}			
		})
	}
}
edit_shop = function(data = false){
	if (data) {
		$(".appoint-loader").show();
		$.ajax({
			url:"submit_shop",
			type:"POST",
			data:data,
			complete:function(){
				$(".appoint-loader").hide();
			},
			success:function(response){
				if (response.status) {
					location.reload();
				}else{
					notify(response.m);
				}
			},
			error:function(){
				internet_error();
			}
		})
	}
}
update_staff = function(data = false){
	if (data) {
		$(".appoint-loader").show();
		$.ajax({
			url:"update_staff",
			type:"POST",
			data:data,
			complete:function(){
				$(".appoint-loader").hide();
			},
			success:function(response){
				if (response.status) {
					notify("Updated",2000);
				}else{
					notify(response.m);
				}
			},
			error:function(){
				internet_error();
			}
		})
	}
}
get_staff = function(data = false){
	if (data) {
		$(".appoint-loader").show();
		$.ajax({
			url:"get_staff",
			type:"POST",
			data:data,
			complete:function(){
				$(".appoint-loader").hide();
			},
			success:function(response){
				if (response.status) {
					$(".staff-more-item:first-child > .more-item-val").html(response.m.count);
					$(".staff-more-item:last-child > .more-item-val").html(response.m.amnt);
				}else{
					notify(response.m);
				}
			},
			error:function(){
				internet_error();
			}
		})
	}
}
suggest_staff = function(key = false){
	if (key) {
		$(".appoint-loader").show();
		$.ajax({
			url:base_url+"suggest_staff",
			type:"POST",
			data:{key:key},
			complete:function(){
				$(".appoint-loader").hide();
			},
			success:function(response){
				if (response.status) {
					$(".staff-suggest").slideDown(450);
					$(".suggest-body").html(response.m);
					suggest_func();
				}
			}
		})
	}
}
add_staff = function(data = false){
	if (data) {
		$(".appoint-loader").show();
		$.ajax({
			url:base_url+"add_staff",
			type:"POST",
			data:data,
			complete:function(){
				$(".appoint-loader").hide();
			},
			success:function(response){
				if (response.status) {
					$(".staff-suggest-in").attr("data-user","");
					$(".staff-suggest-in").val("");
					$(".staff-suggest-pass").val("");					
					$(".staff-list").append(response.m);
					var html = $(".staff-list").html();
					$(".staff-list").html(html);
					notify("Staff member added",3000);

					staff_func();
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
rem_staff = function(data = false){
	if (data) {
		$(".appoint-loader").show();
		$.ajax({
			url:base_url+"rem_staff",
			type:"POST",
			data:data,
			complete:function(){
				$(".appoint-loader").hide();
			},
			success:function(response){
				if (response.status) {
					$(".staff-item[data-item='"+data.staff+"']").slideUp(450/2);

					setTimeout(function(){
						$(".staff-item[data-item='"+data.staff+"']").remove();
					},450/2);

					notify("Member removed",3000);
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
get_showcase = function(bus  = false){	
	if (bus) {
		$(".appoint-loader").show();
		loading(true);
		$.ajax({
			url:base_url+"get_showcase",
			type:"POST",
			data:{shop:bus},
			complete:function(){
				$(".appoint-loader").hide();
				loading(false);
			},
			success:function(response){
				if (response.status) {
					$(".ispa_showcase").show();
					$(".showcase-list").html(response.m);
					$(".showcase-title").html(response.name+" - SHOWCASE");
					showcase_func();
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
add_sh = function(data = false){
  if (data) {
		$(".appoint-loader").show();
		loading(true);
		$.ajax({
			url:base_url+"add_showcase",
			type:"POST",
			data:data,
			contentType: false,       
      cache: false,             
      processData:false,
			complete:function(){
				$(".appoint-loader").hide();
				loading(false);
			},
			success:function(response){
				if (response.status) {
					get_showcase("online");
					$(".showcase-add").hide();
					$(".add-show").attr("src","");
					$(".sel_show").val("");
					$(".sh-tool").children("i").html("camera_alt");
					setTimeout(function(){
						$(".show-label").attr("for",data_for);
					},100)
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
del_showcase = function(item = false){
  if (item) {

		$(".appoint-loader").show();
		loading(true);
		$.ajax({
			url:base_url+"rm_showcase",
			type:"POST",
			data:{item:item},			
			complete:function(){
				$(".appoint-loader").hide();
				loading(false);
			},
			success:function(response){
				if (response.status) {
					get_showcase("online");
					$(".showcase-viewer").hide();
					$(".showcased").attr("src","");
					$(".showcased").attr("sh","");
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