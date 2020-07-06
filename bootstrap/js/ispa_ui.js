$(document).ready(function(){
	drop_down();tool_tip();menu();explorer();ispa_new();ispa_bus();ispa_client_menu();
	ispa_notifs();ispa_chats();ispa_wallet();ispa_help();ispa_home();new_appointment();ispa_mapping();ispa_sign_up();
	ispa_business();copyng();account_settings();ispa_appointment();next_appointment();ispa_login();
	$(".ispa-help-chat").click(function(){
		get_menu("chats","client","ispa");
		$(".menu-item").removeClass("active");
		$(".menu-item[data-item='chats']").addClass("active");
		$(".ispa-business").hide();
	})
	clicker = function(){
		/*$(".click-btn").each(function(){
			$(this).click(function(){
				if (isMobile()) {
					$(".click")[0].pause();
					setTimeout(function(){
						$(".click")[0].play();
					},10)
					$(".click")[0].volume = 0.2;
				}
			})
		})*/
	}
	clicker();
})
$(".menu-item").each(function(){
	$(this).click(function(){
		$(".menu-item.active").removeClass("active");
		$(this).toggleClass("active");			
		btn.click();						
		if ($(this).attr("data-menu") == "explore") {
			$(".ispa-explorer").click();				
			$(".ispa-explorer").select();
		}else{
			$(".ispa-explore").hide();				
		}
	})
})
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
menu = function(){
	bar  = $(".menu-bar");
	btn  = $(".menu-btn");
	menu = $(".menu");
	in_btn = $(".in-menu-btn")

	btn.click(function(){
		if (bar.attr("data-menu") =="active") {
			$(this).html("menu");
			bar.attr("data-menu","inactive");
			$(".menu").hide();
			in_btn.html("menu")
		}else{
			$(this).html("close");
			in_btn.html("close")
			$(".menu").show();
			bar.attr("data-menu","active");
		}
	})
	in_btn.click(function(){
		if (bar.attr("data-menu") =="active") {
			$(this).html("menu");
			btn.html("menu")
			bar.attr("data-menu","inactive");
			$(".menu").hide();				
		}else{
			btn.html("close")
			$(".menu").show();		
			$(this).html("close");
			bar.attr("data-menu","active");
		}
	})
	menu.click(function(e){
		if ($(e.target).is(".menu")) {
			bar.attr("data-menu","inactive");
			$(".menu").hide();
			btn.html("menu");
			in_btn.html("menu");
		}
	})
	explorer = function(){
		explore_inp = $(".ispa-explorer");
		explore_cont = $(".ispa-explore");
		explore_close = $(".explore-close");
		explore_inp.click(function(){
			explore_cont.show();			
		})
		explore_cont.click(function(e){
			if ($(e.target).is(".ispa-explore")) {
				$(this).hide();
				close_explore();
			}
		})		
		close_explore = function(){
			if ($(".menu-item.active").attr("data-menu") == "explore") {				
				$(".in-menu-btn").click();
			}			
		}
		$("nav").click(function(e){
			if (!$(e.target).is(".ispa-explorer")&& !$(e.target).is(".menu-btn") && !$(e.target).is(".in-menu-btn")) {
				/*explore_cont.hide();
				close_explore();*/
			}
		})
		explore_close.click(function(){
			explore_cont.hide();
			close_explore();
			$(".menu-item.active").click();					
		})
		$(".explore-list-item").click(function(){
			var item = $(this).attr("data-item");
			if (item) {
				get_explore(item,'list');
			}
		})
		explore_inp.on("keyup",function(){
			var key = $(this).val();
			$(".explore-list-item").removeClass("active");
			if (key.length != "") {
				search_bus(key);
			}
		})
		explore_items = function(){
			$(".explore-item").each(function(){
				$(this).click(function(e){
					if ($(e.target).is(".explore-banner") || $(e.target).is(".explore-more") || $(e.target).is(".explore-details") || $(e.target).is(".explore-details > *") || $(e.target).is(".explore-service")) {					
						var bus = $(this).attr("data-item");
						if (bus) {
							bus_page(bus);
						}
					}
				})
			})
		}
		explore_items();
	}
	ispa_new = function(){
		new_btn = $(".ispa-new");
		new_list = $(".ad-cont");
		new_btn.click(function(){
			if (new_list.is(":visible")) {
				new_list.hide();
				$(this).css("transform","rotate(0deg)");
				$(this).attr("data-tooltip","Add new");
			}else{
				new_list.show();
				$(this).attr("data-tooltip","Close");
				$(this).css("transform","rotate(45deg)");
			}
			tool_tip();
		})
		$("body").click(function(e){
			if (!$(e.target).is(".ispa-new") && new_list.is(":visible")) {
				new_btn.click();
			}
		})		
	}
}
loading = function(state = false, loader = ".loader_indic"){
	var loader = $(".main-loader");
	var loader_cover = $(".sms-loader");	
	if (state) {
		loader.show();	
	}else{		
		loader.hide();
	}
}
ispa_bus = function(){
	$(".sub-review").click(function(){
		var rating = $(".raters").children(".open").length;
		var note = $(".rating-note").val();
		send_rating({rating:rating,note:note,bus:$(".ispa-business").attr("data-business")});		
	})
	$(".add-review").click(function(){
		$(".rev-row").show();
	})
	$(".close-bus").click(function(){
		$(".ispa-business").slideUp("fast");
	})
	$(".rev-row").click(function(e){
		if ($(e.target).is(".rev-row")) {
			$(this).hide();
		}
	})
	raters = function(){
		l = 5;
		$(".rater-btn").each(function(){
			$(this).click(function(){
				c = 0;
				for (var i = 1; i <= l; i++) {
					if($(this).is(":nth-child("+i+")")){
						c = i; 
					}
				}
				for (var i = 1; i <= c; i++) {
					$(".rater-btn:nth-child("+i+")").addClass("open");
				}
				for (var i = c + 1; i <= 5; i++) {
					$(".rater-btn:nth-child("+i+")").removeClass("open");
				}
			})
		})
		$(".can-rate").click(function(){
			$(".rev-row").hide();
		})		
	}
	raters();
	bus_serv_list = function(){
		$(".service-select").each(function(){
			$(this).click(function(){
				if ($(this).hasClass("active")) {
					$(this).children("i").html("");
					$(this).attr("value","false");
				}else{
					$(this).children("i").html("done");
					$(this).attr("value","true");
				}					
				$(this).toggleClass("active");
				trigg_book();
			})
		})
	}
	trigg_book = function(){
		var selected = 0;
		var total = 0;
		var tot_time = 0;
		var pre_services = [];
		$(".bus-service-item").each(function(){
			if ($(this).children(".service-select").hasClass("active")) {
				x = {
					item : $(this).attr("data-item") 
				}
				total += Number($(this).attr("data-amount"));
				tot_time += Number($(this).attr("data-duration"));
				selected += 1;
				pre_services.push(x);
			}
		})
		if (selected > 0) {
			$(".bus-service-book").show();
		}else{
			$(".bus-service-book").hide();
		}
		if (selected == 1) {
			txt = "Service";
		}else{
			txt = "Services";
		}
		$(".stat-count").html(selected+" "+txt);
		$(".stat-amount").html("Ksh. "+total);
		return pre_services;
	}	
	$(".book-go-i").click(function(){
		var sel = trigg_book();
		if (sel.length > 0) {
			appoint_bus($(".ispa-business").attr("data-business"),sel);
		}
	})
	$(".sub-item").each(function(){
		$(this).click(function(){
			$(".sub-item").removeClass("active");
			$(this).addClass("active");
			$(".details-item").hide();
			$(".details-item.details-"+$(this).attr("data-item")).show();
		})
	})
	$(".drop-chat").click(function(){
		var item = $(".ispa-business").attr("data-business");
		if (item) {			
			$(".menu-item").removeClass("active");
			$(".menu-item[data-item='chats']").addClass("active");
			$(".ispa-business").hide();
			get_menu("chats","client", item);
		} 
	})
}
ispa_client_menu = function(){
	$(".menu-item").each(function(){
		$(this).click(function(){
			$(".menu-item.active").removeClass("active");
			$(this).toggleClass("active");		
			var item = $(this).attr("data-item");
			if (item && item !== "business") {
				if (location.href == base_url) {
					get_menu(item,"client");
				}else{
					get_menu(item,"business");
				}
			}
		})
	})
}
ispa_notifs = function(){
	$(".ispa-notif-head").each(function(){
		$(this).click(function(e){			
			$(".notif-body").slideUp("fast");
			if (!$(this).parent().children(".notif-body").is(":visible")) {
				$(this).parent().children(".notif-body").slideDown("fast");
				item = $(this).parent().attr("data-item");
				if (item && $(this).parent().hasClass("active")) {
					read_notif(item);
				}
				$(this).parent().removeClass("active")
			}
		})
	})	
}
ispa_chats = function(){
	$(".ispa-chat-list-item").each(function(){
		$(this).click(function(){
			var item = $(this).attr("data-item");			
			get_chat(item);
			chat_interval =  setInterval(get_chat,3000);
		})
	})
	$(".chat-back").click(function(){		
		$(".menu-item.active").click();
		clearInterval(chat_interval);
		$(".ispa-chat-go").attr("data-chat","");
		$(".ispa-help-chat").removeClass("active");
		$(".material-tooltip").hide();
	})
	$(".ispa-chat-in").on("keyup",function(e){
		if (e.which == 13) {
			send_chat();
		}
	})
	$(".ispa-chat-go").click(function(){
		send_chat();
	})
}
ispa_wallet = function(){
	$(".top-up").click(function(){		
		$(".top-up-row").toggle();
		$(".top-up-code").click();
		$(".top-up-code").select();
	})
	$(document).click(function(e){
		if ($(e.target).is(".top-up-row")) {
			$(".top-up-row").slideUp("fast");
		}
	})
	$(".top-up-go").click(function(){
		var code = $(".top-up-code").val();
		if (code.length > 0) {
			top_up(code);
		}
	})
	$(".top-up-close").click(function(){
		$(".top-up-row").slideUp("fast");
	})
	$(".subscriber-section").each(function(){
		$(this).click(function(){
			var sub = $(this).parent().attr("data-subscribed");
			if (sub == "false" || sub == false) {
				$(".subscriber-section").removeClass("active");
				$(this).addClass("active");
			}
		})
	})
	$(".subscribe-go").click(function(){
		var sub = $(".subscriber-section.active").attr("data-sub");
		var s = $(".subscriber").attr("data-subscribed");				
		if (sub && (s == "false" || s == false)) {
			subscribe(sub);
		}else{
			notify("Kindly select a subscription plan.");
		}
	})
}
ispa_help = function(){
	$(".new-help-btn").click(function(){
		if ($(".new-help").is(":visible")) {
			$(".new-help").hide();
			$(".new-help-btn").css("transform","");
		}else{
			$(this).css("transform","rotate(-45deg)");
			$(".new-help").show();
		}
	})
	$(".new-help > .row").click(function(e){
		if ($(e.target).is(".new-help > .row")) {
			$(".new-help").hide();
			$(".new-help-btn").css("transform","");
		}
	})
	$(".help-go").click(function(){
		var topic  = $(".help-topic").val();
		var content =  CKEDITOR.instances["help-content"].getData();
		if (topic.length >= 5 && content.length >= 15) {
			if ($(this).attr("data-edited") != "") {
				add_help(topic,content,$(this).attr("data-edited"));
			}else{
				add_help(topic,content);
			}
		}else{
			notify("Invalid values");
		}
	})
	$(".help-search").on("keyup",function(){
		var key = $(this).val();		
		if (key.length > 0) {
			search_help(key);
		}
	})
	help_click = function(){
		$(".help-title").each(function(){
			$(this).click(function(){
				if ($(this).parent().children(".help-item-body").is(":visible")) {
					$(this).parent().children(".help-item-body").slideUp("fast");
				}else{
					$(this).parent().children(".help-item-body").slideDown("fast");
				}
			})
		})
		$(".rem-help").each(function(){
			$(this).click(function(){
				var item = $(this).parent().parent().attr("data-item");
				if (confirm("Delete this help item?")) {
					del_help(item);
				}
			})
		})	
		$(".edit-help").each(function(){
			$(this).click(function(){
				var item = $(this).parent().parent().attr("data-item");
				$(".new-help").show();
				$(".help-go").attr("data-edited",item);
				$(".help-topic").val($(this).parent().parent().children(".help-title").html());
				CKEDITOR.instances["help-content"].setData($(this).parent().parent().children(".help-item-body").html());
			})
		})	
	}
	help_click();	
}
ispa_home = function(){
	$(".app-drawer").click(function(){
		$(".next-app-list,.next-ap-drawer").toggle();
	})
	booking = function(){
		$(".explore-item-book").each(function(){
			$(this).click(function(){
				appoint_bus($(this).parent().parent().attr("data-item"));
				$(".new-appointment-area").css("transition","transform .25s ease-out");
				$(".new-appointment-area").css("transform","scale3d(1,1,1)");
			})
		})
		$(".explore-rate").each(function(){
			$(this).click(function(){
				var bus = $(this).parent().parent().attr("data-item");
				if (bus) {
					fovorite(bus, $(this));
				}
			})
		})
		tool_tip();
	}
	booking();
}
make_appointment = function(editing = false){
	var shop = $("#ispa-appt").attr("data-business");
	/*var location = $(".book-place").val();*/
	var services = get_booked();
	var staff = $(".staff-sel").val();
	var time = $(".date-sel").html();
	var note  = $(".book-note").html();	

	if (shop) {		
		if (services.items && services.items.length > 0) {
			if (staff) {
				if (time != "") {
					data = {
						shop: shop,						
						services:services,
						staff: staff,
						time: time,						
						note: note
					}							
					if (editing) {
						submit_appointment(data, true);
					}else{
						submit_appointment(data);
					}
				}else{
					notify("Kindly specify the appointment time.");
				}
			}else{
				notify("Kindly select a staff first");
			}
		}else{
			notify("Kindly select a service first");
		}		
	}else{
		notify("No shop selected.");
	}
}
new_appointment = function(){	
	$(".cancel-new-app").click(function(){
		$(".new-appointment").slideUp("fast");
		$(".book-time").val("");
	})
	$(".new-appointment").click(function(e){
		if ($(e.target).is(".new-appointment-row")) {
			$(this).hide();
			$(".book-time").val("");
		}
	})
	$(".book-time").click(function(){
		init_calendar($(".new-appointment").attr("data-business"));						
	})
	$(".booking-calendar").click(function(e){
		if ($(e.target).is(".booking-calendar-cont") || $(e.target).is(".close-calendar")) {
			$(".booking-calendar").hide();
		}
	})
	$(".book-go").click(function(){				
		make_appointment();
	})	

	staff_sel = function(){
		$(".book-staff").change(function(){
			$(".book-time").val("");
		})
	}
	staff_sel();	
}
ispa_mapping = function(){
	var selected_location = $(".selected-location");
	$(".location-picked").click(function(){		
		var for_ = $(this).attr("data-for");
		if (for_) {
			init_select(for_);
		}
	})	
	init_select = function(for_ = false){
		if (for_) {
			//$(".location-search").val("");
			//selected_location.html("No location selected");
			//selected_location.attr("data-location","");
			//selected_location.attr("data-location-name","");
			/*$("div[data-for]").html("Click to pick a location");*/
			$(".ispa-map-picker").show();
			$(".select-location").attr("data-for",for_);	
			if (map) {
				
			}else{
				initialize();
			}
			/*$('[data-ref="map-js"]').remove();*/		
			/*$(".ispa-map-picker-body").append(''+
			'<script data-ref="map-js" type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmTgK1EOZSTwsmBNnobBJ9tM4GZowxGm8&libraries=places&&callback=initialize"></script>');*/
		}
	}	
	$(".select-location").click(function(){	
		loc = get_selected();		
		if (loc) {
			title = loc.title;
			d_f = $(this).attr("data-for");
			$("div[data-for='"+d_f+"']").html(title);				
		}else{
			notify("No location selected");
		}
		$(".ispa-map-picker").hide();	
	})
	$(".ispa-map-picker").click(function(e){
		if ($(e.target).is(".ispa-row")) {
			$(".ispa-map-picker").hide();
		}
	})
	get_selected = function(){
		var location_name = selected_location.attr("data-location-name");
		var location_coord = selected_location.attr("data-location");
		var location_map = {
			lat:location_coord.split(",")[0],
			lng:location_coord.split(",")[1],
			title: location_name
		}
		if (location_map.lat && location_map.lng && location_map.title) {
			return location_map;
		}
		return false;
	}
}
ispa_sign_up = function(){	
	$(".folded-cover").click(function(){
		/*if (isMobile()) {
			
		}*/
		$(this).parent().toggleClass("sign-folded");
	})
	$(".sign-my").click(function(){
		$(".ispa-map-picker").show();
		$(".select-location").attr("data-for","sign");	
		initialize();
		$(".map-near").click();
	})
	$(".close-loc").click(function(){
		$(".ispa-map-picker").hide();
	})
	$(".sign-go").click(function(){
		var user_location = get_selected();
		if (!user_location) {
			user_location = {
				lat:0,
				lng:0,
				title: ""
			}
		}
		var user_name = $(".sign-name").val();
		var user_email = $(".sign-email").val();
		var user_phone = $(".sign-phone").val();
		var user_pass = $(".sign-pass").val();
		var terms = $("#terms").val();

		if (get_length(user_name) >= 3) {
			if (validateInput(user_phone,"phone")) {
				if (user_location) {
					if (user_pass.length >= 3) {
						if (terms == true || terms == "true") {
							if (validateInput(user_email)) {
								sign_up({
									name:user_name,
									pass:user_pass,
									email:user_email,
									location:user_location,
									phone:user_phone,
									terms:terms
								});
								$(this).attr("disabled","true");
							}else{
								notify("Kindly enter a valid email.")
							}
						}else{
							notify("Kindly agree to our terms of service before signing up.")
						}
					}else{
						notify("Kindly enter a valid password (atleast 3 characters).");
					}
				}else{
					notify("Kindly set your location before you can proceed.");
				}
			}else{
				notify("Kindly enter a valid phone.")
			}
		}else{
			notify("Kindly enter a valid name.")
		}
	})
}
ispa_business = function(){
	$(".new-shop-my").click(function(){
		$(".ispa-map-picker").show();
		$(".select-location").attr("data-for","new-shop");	
		initialize();
		$(".map-near").click();
	})

	$(".add-service").click(function(){
		var items = get_services_all();
		var sel_items = ""
		if (items.status) {
			for (var i = 0; i < items.length; i++) {
				var i_t = items[i];
				sel_items += '<div data-item="new-item" data-item-default="new" class="new-shop-services-item col s12 m12 l12">'+
				'<div class="indic material-icons active click-btn">'+i_t.text+'</div>'+
				'<input value="'+i_t.name+'" autofocus="true" placeholder="Service name" type="text" class="browser-default new-shop-services-item-name ispa-in">'+
				'<input value="'+i_t.duration+'" min="0" placeholder="Duration (minutes)" type="number" class="browser-default new-shop-services-item-duration ispa-in">'+
				'<input value="'+i_t.cost+'" min="0" placeholder="Cost (Ksh.)" type="number" class="browser-default new-shop-services-item-cost ispa-in">'+
				'<button data-tooltip="Remove item" data-position="left" class="tooltipped material-icons click-btn rem-service">close</button>'+
				'</div>';				
			}
		}
		var item = '<div data-item="new-item" data-item-default="new" class="new-shop-services-item col s12 m12 l12">'+
		'<div class="indic material-icons active click-btn">done</div>'+
		'<input autofocus="true" placeholder="Service name" type="text" class="browser-default new-shop-services-item-name ispa-in">'+
		'<input min="0" placeholder="Duration (minutes)" type="number" class="browser-default new-shop-services-item-duration ispa-in">'+
		'<input min="0" placeholder="Cost (Ksh.)" type="number" class="browser-default new-shop-services-item-cost ispa-in">'+
		'<button data-tooltip="Remove item" data-position="left" class="tooltipped material-icons click-btn rem-service">close</button>'+
		'</div>';				
		$(".new-shop-services-items").append(sel_items+item);
		services_func();
		$(".new-shop-services-item:last-child > .new-shop-services-item-name").click();
		$(".new-shop-services-item:last-child > .new-shop-services-item-name").select();
	})
	services_func = function(){
		$(".rem-service").each(function(){
			$(this).click(function(){
				$(this).parent().slideUp("fast");
				setTimeout(function(){
					$(this).parent().remove();
				},300)
			})
		})
		$(".new-shop-services-item > .indic").each(function(){
			$(this).click(function(){
				if ($(this).hasClass("active")) {
					$(this).toggleClass("active");
					$(this).html("");
				}else{
					$(this).toggleClass("active");
					$(this).html("done");
				}
			})
		})
	}
	services_func();
	serv_trig = function(){
		$(".new-shop-services-day > .indic").each(function(){
			$(this).click(function(){
				if ($(this).hasClass("active")) {
					$(this).toggleClass("active");
					$(this).html("");
				}else{
					$(this).toggleClass("active");
					$(this).html("done");
				}
			})
		})
	}
	serv_trig();
	$(".new-shop > .row").click(function(e){
		if ($(e.target).is(".new-shop > .row") || $(e.target).is(".bus-close")) {
			$(".new-shop").hide();
		}
	})
	$(".add-item:nth-child(2),.add-bus").click(function(){
		$(".menu-btn").click();
		$(".new-shop").show();
	})
	get_services_all = function(){
		var sel = [];	
		var r = {};	
		$(".new-shop-services-item > .indic").each(function(){
			var parent = $(this).parent();
			var in_  = parent.children(".new-shop-services-item-name");
			var dur  = parent.children(".new-shop-services-item-duration");
			var cost = parent.children(".new-shop-services-item-cost");
			if ($(this).hasClass("active")) {
				var text = "done";
			}else{
				var text = "";
			}
			var it = {
				name: in_.val(),
				duration: dur.val(),
				cost: cost.val(),
				text:text
			}
			sel.push(it);
		})

		if (sel.length > 0) {
			r = {
				status : true,
				m: sel
			}
		}else{
			r = {
				status: false,
				m: "No service"
			}
		}
		return r;
	}
	get_services = function(){
		var sel = [];	
		var r = {};	
		$(".new-shop-services-item > .indic.active").each(function(){
			var parent = $(this).parent();
			var in_  = parent.children(".new-shop-services-item-name");
			var dur  = parent.children(".new-shop-services-item-duration");
			var cost = parent.children(".new-shop-services-item-cost");
			var it = {
				name: in_.val(),
				duration: dur.val(),
				cost: cost.val(),
				default: parent.attr("data-item-default")
			}
			sel.push(it);
		})

		if (sel.length > 0) {
			var all_ver = true;
			for (var i = 0; i < sel.length; i++) {
				var it = sel[i];						
				if (!(get_length(it.name) > 0 && it.duration > 0 && it.cost >= 0)) {
					all_ver = false;					
				}				
			}
			if (all_ver) {
				r = {
					status : true,
					m: sel
				}
			}else{
				r = {
					status: false,
					m: "Check if all selected services' details are correct."
				}
			}
		}else{
			r = {
				status: false,
				m: "No service selected"
			}
		}
		return r;
	}
	$(".day-start,.day-end").each(function(){
		$(this).on("change",function(){
			$(this).parent().children(".indic").addClass("active");
			$(this).parent().children(".indic").html("done");
		})
	})
	get_working = function(){
		var days = [];
		var all_days = true;
		$(".new-shop-services-day > .indic.active").each(function(){
			var parent = $(this).parent();			
			var day = parent.attr("data-day");
			var start = parent.children(".day-start");
			var end = parent.children(".day-end");

			days.push({
				day:day,
				start: start.val(),
				end: end.val()
			});

		})
		if (days.length > 0) {
			for (var i = 0; i < days.length; i++) {
				day = days[i];

				if (!(day.day != "" && day.start != "" && day.end != "")) {
					all_days = false;
				}
			}
			if (all_days) {
				r = {
					status: true,
					m: days
				}
			}else{
				r = {
					status: false,
					m: "Check your business' working days details."
				}
			}
		}else{
			r = {
				status: false,
				m: "No days selected"
			}
		}
		return r;
	}
	submit_business = function(){
		var name = $(".add-shop-name").val();
		var phone = $(".add-shop-phone").val();
		var location = get_selected();
		var type = $(".add-shop-type").val();
		var services = get_services();
		var working_days = get_working();
		var type_curr = $(".add-shop-type").attr("data-curr");
		if ($(".new-shop").attr("data-editing") == true || $(".new-shop").attr("data-editing") == "true") {
			var editing = $(".new-shop").attr("data-shop");
		}else{
			editing = false;
		}

		if (get_length(name) > 0 ) {
			if (validateInput(phone,"phone")) {
				if (location) {
					if (get_length(type) > 0) {
						if (services.status) {
							if (working_days.status) {
								var data = {
									name: name,
									phone: phone,
									editing: editing,
									location: location,
									type : type,
									services : services.m,
									working_days: working_days.m,
									type_curr : type_curr
								};
								submit_shop(data);
								$(".bus-go").attr("disabled","true");
							}else{
								notify(working_days.m);
							}
						}else{
							notify(services.m);
						}
					}else{
						notify("Enter your business' type.")
					}
				}else{
					notify("Set your business' location.");
				}
			}else{
				notify("Enter a contact that your clients can reach you with.");
			}
		}else{
			notify("Enter your business' name.");
		}
	}
	fill_type = function(){
		$(".filled-item").each(function(){
			$(this).click(function(){
				var name = $(this).html();
				var id = $(this).attr("data-item");
				$(".add-shop-type").val(name);
				$(".add-shop-type").attr("data-curr",id);
				$(".type-filler").hide();
				$(".filled-items").html("");
				pre_services(id);
			})
		})		
	}
	fill_type();
	$(".add-shop-type").on("keyup",function(){
		var key = $(this).val();
		if (key.length > 0) {
			lookup_service(key);
		}else{
			$(".filled-items").html("");
			$(".type-filler").hide();
			$(".new-shop-services-items").html('<div class="flow-text center grey-text">Add services that your shop offer</div>');
		}
	})
	$(".bus-go").click(function(){
		submit_business();
	})
}
copyng = function(){
	/**/
	$(".change-app").click(function(){
		make_appointment(true);
	})
	$(".copy-link").click(function(){
		$(".ispa-copier").show();
	})
	$(".ispa-copier").click(function(e){
		if ($(e.target).is(".ispa-copier") || $(e.target).is(".cancel-copy")) {
			$(".ispa-copier").hide();
		}
	})
	$(".copy-go").click(function(){
		var clipboardText = "";

		clipboardText = $(".link-inp").val();
		l = $(".link-inp");	      
		l.select();
		document.execCommand("copy");
		notify("Copied");
		l.blur();
	})
	$(".inv-email").click(function(){		
		$(".copier-cont:first-child").hide();
		$(".email-invite").show();
		$(".invite-email").click();
		$(".invite-email").select();		
	})
	$(".cancel-invite").click(function(){
		$(".copier-cont:first-child").show();
		$(".email-invite").hide();		
	})
	$(".inv-go").click(function(){
		var email = validateInput($(".invite-email").val(),"email") ? $(".invite-email").val() : false;
		if (email) {
			send_invite(email);
		}else{
			notify("Kindly enter a valid email address");			
			$(".invite-email").select();
		}
	})
}
account_settings = function(){
	$(".edit-pass").click(function(){
		$(".pass-change").show();
	})
	$(".close-pass").click(function(){
		$(".pass-change").hide();
	})
	$(".close-settings").click(function(){
		$(".user-settings").hide();
	})
	$(".ac-tools").click(function(){
		$(".user-settings").show();
	})	
	$("input.prof-change").on("change",function(){		
		if ($(this).val() != "") {
			$("span.edit-tool").html("done");
			$("span.edit-tool").attr("data-tooltip","Save profile image");
			$(".del-prof").html("close");
			$(".del-prof").attr("data-tooltip","Remove selected image")
		}else{
			$(".del-prof").html("delete");
			$(".del-prof").attr("data-tooltip","Delete profile image")
			$(".edit-prof").attr("src",$(".edit-prof").attr("data-prof"));
			$("span.edit-tool").html("camera");
			$("span.edit-tool").attr("data-tooltip","Change profile image");
		}
		tool_tip();
	})	
	$(".del-prof").click(function(){
		if ($(this).html() == "delete") {
			if (confirm("Remove profile image?")) {
				del_prof();
			}
		}else{
			$(".edit-prof").attr("src",$(".edit-prof").attr("data-prof"));
			$("input.prof-change").val("");
			$(this).html("delete");
			$("span.edit-tool").html("camera");
		}
	})
	$(".edit-prof").click(function(){
		$(".prof-change").click();
	})
	$(".edit-prof").on("change",function(){
		if ($(this).val() == "") {
			$(this).attr("src",$(this).attr("data-prof"));
		}
	})	
	$(".user-settings").click(function(e){
		if ($(e.target).is(".user-settings")) {
			$(this).hide();
		}
	})
}
ispa_appointment = function(){
	$(".ispa-appointments-item").each(function(){
		$(this).click(function(e){
			target = $(e.target);
			var item = $(this).attr("data-item");
			if (item && !$(e.target).is(".rem-appointment")) {
				get_appointment(item);
			}
		})
	})
	$(".rem-appointment").each(function(){
		$(this).click(function(e){
			e.preventDefault();
			var item = $(this).parent().parent().attr("data-item");
			if (item) {				
				rem_appointment(item);
			}	
		})
	})	
	$(".appointment-timing").each(function(){
		$(this).click(function(){
			var item = $(this).parent().attr("data-item");
			if (item) {
				get_appointment(item);
			}
		})
	})	
}
next_appointment = function(){
	$(".ch-apt").click(function(){
		var item = $(".next-ap-item:nth-child(2)").attr("data-item");		
		if (item) {
			get_appointment(item);
		}
	})
	$(".del-apt").click(function(){
		var item = $(".next-ap-item:nth-child(2)").attr("data-item");		
		if (item) {
			rem_appointment(item);
		}
	})
}
bus_editor = function(){
	$(".bus-edit.row").click(function(e){
		if ($(e.target).is(".bus-edit") || $(e.target).is(".bus-edit-tool")) {
			$(this).hide();
		}
	})
	$(".bus-edit-tool").click(function(){
		$(".bus-edit").hide();
	})
	$(".ac-tools").click(function(){
		$(".in-menu-btn").click();
		$(".bus-edit").show();		
	})
	$(".bus-tab").each(function(){
		$(this).click(function(){
			$(".bus-edit-group").hide();
			$(".bus-tab").removeClass("active")
			$(".edit-"+$(this).attr("data-item")).show();
			$(this).addClass("active");
		})
	})
	get_prefs = function(){
		var prefs_ = [];
		$(".edit-pref").each(function(){
			var item = $(this).attr("data-item");
			var val = $(this).children(".pref-check").is(".active");
			prefs_.push({pref:item,val:val})
		})

		return prefs_;
	}
	$(".edit-pref").each(function(){
		$(this).click(function(){
			$(this).children(".pref-check").toggleClass("active");
		})
	})
	$(".save-bus").click(function(){
		update_shop();
	})
	update_shop = function(){
		var name = $(".edit-name").val();
		var phone = $(".edit-phone").val();
		var location = get_selected();
		var type = $(".edit-shop-type").val();
		var working = get_working();
		var services = get_services();
		var prefs = get_prefs();

		if (get_length(name) > 2) {
			if (type != "") {
				if (prefs.length > 0) {
					if (working) {
						data = {
							name: name,
							phone: phone,
							location: location,
							type: type,
							services: services.m,
							prefs: prefs,
							working_days: working.m,
							type_curr: false,
							editing: true
						}
						edit_shop(data);
						//console.log(data);
					}else{
						notify("Check working day details.");
					}
				}else{
					notify("Oops! Kindl' check preferences.")
				}
			}else{
				notify("Kindly set your sho type.")
			}
		}else{
			notify("Kindly enter your shop's name.")
		}
	}
}
ispa_staff = function(){
	$(".ispa-staff").click(function(e){
		if ($(e.target).is(".ispa-staff,.staff-close,.staff-close > *")) {
			$(".ispa-staff").hide();
		}
	})
	$(".staff-btn").click(function(){
		$(".ispa-staff").show();
	})
	staff_func = function(){
		$(".avail_p > label").each(function(){
			$(this).click(function(){
				btn = $(this);
				setTimeout(function(){
					var val = btn.parent().children("input").val();
					if (val) {
						staff = btn.parent().parent().parent().parent().attr("data-item");
						if (staff) {
							data = {
								staff: staff,
								available: val
							}
							update_staff(data);
						}
					}
				},100)
			})
		})
		$(".sel-month").each(function(){
			$(this).on("change",function(){
				var staff = $(this).parent().parent().parent().parent().attr("data-item");
				var month = $(this).val();
				get_staff({staff:staff,month:month});
			})
		})
		$(".del-staff").each(function(){
			$(this).click(function(){
				var staff = $(this).parent().parent().attr("data-item");
				if (staff && confirm("Remove staff member?")) {
					rem_staff({staff:staff});
				}
			})
		})
	}
	staff_func();
	$(".staff-add").click(function(){
		if ($(".add-staff").is(":visible")) {
			$(this).children("i").html("add");
			$(this).children("i").css("color","orange");
			$(".add-staff").slideUp((450/2));
		}else{
			$(this).children("i").css("color","red");
			$(this).children("i").html("close");
			$(".add-staff").slideDown(450);
		}
	})
	$(".staff-suggest-in").on("keyup",function(){
		var key = $(this).val();
		if (key != "") {	
			$(".staff-suggest-in").attr("data-user","");	
			suggest_staff(key);
		}else{			
			$(".staff-suggest").slideUp((450/2));
		}
	})
	$(".close-suggests").click(function(){
		$(".staff-suggest").slideUp((450/2));
	})
	suggest_func = function(){
		$(".suggested-staff").each(function(){
			$(this).click(function(){
				var name = $(this).attr("data-name");
				var item = $(this).attr("data-item");

				$(".staff-suggest-in").val(name);
				$(".staff-suggest-in").attr("data-user",item);

				$(".staff-suggest").slideUp((450/2));
				$(".suggest-body").html("");
			})
		})
	}
	$(".staff-go").click(function(){
		var staff = $(".staff-suggest-in").attr("data-user");
		var pass = $(".staff-suggest-pass").val();
		var avail = $(".staff_avail_add").val();
		if (staff) {
			if (pass != "") {
				add_staff({user:staff,avail:avail,pass:pass});
			}else{
				notify("Kindly let the user enter their password.");
			}
		}else{
			notify("No user selected.")
		}
	})
}
function read_show(input  = false){ 	
	var t = ".add-show";
	if (FileReader && input && input.files[0]) {
		var file = new FileReader();	     	
		file.onload = function () {	    	
			$(t).attr("src",file.result);
		}
		file.readAsDataURL(input.files[0]);
	}else{
		$(this).attr("src",$(this).attr("data-prof"));
	}
}
ispa_showcase = function(){
	$(".showcase-btn").click(function(){
		get_showcase("online");
	})
	$(".close-showcase").click(function(){
		$(".ispa_showcase").slideUp(450/2);
	})
	data_for = "sel_show";	
	$(".sel_show").on("change",function(){
		if ($(this).val() != "") {
			$(".sh-tool").children("i").html("close");
			$(".show-label").attr("for","");		
		}else{
			$(".sh-tool").children("i").html("camera_alt");
			$(".show-label").attr("for",data_for);
		}
	})
	$(".sh-tool").click(function(){
		if ($(this).children("i").html() == "close") {
			$(".add-show").attr("src","");
			$(".sel_show").val("");
			$(".sh-tool").children("i").html("camera_alt");
			setTimeout(function(){
				$(".show-label").attr("for",data_for);
			},100)
		}
	})	
	$(".close-sh").click(function(){
		$(".showcase-add").hide();
	})
	$(".add-sh").click(function(){
		var data = new FormData();
		inp = $("input.sel_show");
		if (inp.val()!='') {	    	
			jQuery.each(jQuery(inp)[0].files, function(i, file) {
				data.append('file-'+i, file);
			});
			add_sh(data);
		};	 
	})
	$(".add-showcase").click(function(){
		$(".showcase-add").show();
	})
	$(".showcase-add").click(function(e){
		if($(e.target).is(".showcase-add")){
			$(".showcase-add").hide();
		}
	})
	$(".close-viewer").click(function(){
		$(".showcase-viewer").hide();
		$(".showcased").attr("src","");
		$(".showcased").attr("sh","");
	})
	showcase_func = function(){
		$(".showcase-img").each(function(){
			$(this).click(function(){
				var src = $(this).attr("src");
				$(".showcase-viewer").show();
				$(".showcased").attr("src",src);
				$(".showcased").attr("sh",$(this).attr("data-sh"));
			})
		})
	}
	$(".remove-showcase").click(function(){
		var item = $(".showcased").attr("sh")
		if (item && confirm("Delete this image?")) {
			del_showcase(item);
		}
	})
}
ispa_login = function(){	
	$(".log-in").click(function(){
		ispa_login.prototype.test_login();
	})
	$(".login-pass").on("keydown", e =>{
		if (e.which == 13) {
			ispa_login.prototype.test_login();
		}
	})
	$(".forgot-a").click(function(){
		$(".ispa-forgot").show();		
	})
	$(".close-recovery").click(function(){
		$(".ispa-forgot").hide();
	})
	$(".switch-recovery").click(function(){
		if ($(".recovery-get").is(":visible")) {
			$(".recovery-get").hide();
			$(".recovery-change").show();
			$(".recovery-email").val($(".recovery-mail").val());
			$(this).html('Get code');
		}else{
			$(".recovery-get").show();
			$(".recovery-change").hide();			
			$(this).html('Reset');
		}
	})
	$(".recovery-go").click(function(){
		if ($(".recovery-get").is(":visible")) {
			ispa_login.prototype.get_code();
		}else{
			ispa_login.prototype.change_pass();			
		}		
	})
}
ispa_login.prototype = {
	constructor: ispa_login,
	login:function(){
		var pass = $(".login-pass").val();
		var email = $(".login-email").val();
		var remember = $(".spend-input.remember").attr("value");
		if (pass != "" && validateInput(email,"email")) {
			return {email:email,password:pass, remember:remember};
		}else{
			if (pass == "") {
				notify("Enter a valid password");
			}else{
				notify("Enter a valid email address")
			}
		}	
		return false;	
	},
	test_login:function(data = false){
		if (!data) {
			data = this.login();
		}
		if (data) {
			$(".login-load").show();
			$.ajax({
				type:"POST",
				url:base_url+"index.php/test_login",
				data:data,
				complete:function(){
					$(".login-load").hide();
				},
				success:function(response = false){
					if (response && response.status) {
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
	},
	get_code:function(){
		var email = $(".recovery-mail").val();
		if (validateInput(email,"email")) {
			loading(true,".appoint-loader");
			$.ajax({
				url:base_url+"get_recovery_code",
				type:"POST",
				data:{email:email},
				complete:function(){
					loading(false,".appoint-loader");
				},
				success:function(response = false){
					if(response && response.status) {
						$(".switch-recovery").click();
						notify(response.m,5000);
					}else{
						notify(response.m,3000,"warning");
					}
				},
				error:function(){
					internet_error();
				}
			})
		}else{
			notify("Enter a valid email address",3000,"warning");
		}
	},
	change_pass:function(){
		var email = $(".recovery-email").val();
		var code = $(".recovery-code").val();
		var pass = $(".recovery-pass").val();

		if (validateInput(email,"email")) {
			if (code.length == 6) {
				if (pass.length >= 3) {
					this.recover_pass({email:email,code:code,pass:pass});
				}else{
					notify("Password too short.");
				}
			}else{
				notify("Enter a valid recovery code.")
			}
		}else{
			notify("Enter a valid email address.")
		}
	},
	recover_pass:function(data = false){
		if (data) {
			loading(true,".appoint-loader");
			$.ajax({
				type:"POST",
				url:base_url+"recover_pass",
				data:data,
				complete:function(){
					loading(false,".appoint-loader");
				},
				success:function(response = false){
					if (response && response.status) {
						notify("Password recovery successfull");
						$(".recovery-email").val("");
						$(".recovery-code").val("");
						$(".recovery-pass").val("");
						$(".ispa-forgot").hide();
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
};

let bus_items = (item = "ispa-shop") =>{
	$(`.${item}`).each(function(){
		$(this).click(() =>{			
			var id = $(this).attr("data-id");
			bus_page(id);
		})
	})
}
let home_tab = ()=>{	
	$(".new-apt").click((x)=>{
		$(".search-area").show();
	})
	$(".search_dummy").click(() =>{
		$(".search-area").show();
		$(".search_dummy").blur();
		$(".search-input").focus();
		$(".search-input").select();
	})
	$(".search-tools").click(() =>{
		$(".search-area").hide();
	})	
	$(".bs-tool.close").click(function(){
		$(".ispa-bs").hide();
	})
	$(".ispa-bs-tab").each(function(){
		$(this).click(function(){
			$(".ispa-bs-tab").removeClass("active");
			$(this).addClass("active");
			if ($(this).is(":first-child")) {
				$(".bs-tab-cont.serv").show();
				$(".bs-tab-cont.serv").addClass("active");

				$(".bs-tab-cont.det").hide();
				$(".bs-tab-cont.det").removeClass("active");
			}else{
				$(".bs-tab-cont.serv").hide();
				$(".bs-tab-cont.serv").removeClass("active");
				$(".bs-tab-cont.det").show();
				$(".bs-tab-cont.det").addClass("active");
			}
		})
	})
	bus_items();	
	$(".sl").click(() =>{
		$(".gallery").show();
	})
	$(".close-g").click(() =>{
		$(".gallery").hide();
	})
	$(".favorite").click(function(){
		var item = $(".ispa-bs").attr("data-id");
		if (item) {
			favorite(item, (res = false) =>{
				if (res) {
					if (res.m == "added") {
						$(".favorite > i").html("favorite");
						var s = "to";
					}else{
						$(".favorite > i").html("favorite_outline");
						var s = "from";
					}
					notify(`${res.shop} has been ${res.m} ${s} your favorites`);
				}
			});
		}
	})
	$(".search-input").on("keyup",function(){
		var key = $(this).val();		
		if (key.length != "") {
			$(".search-list").html("");
			search_bus(key, (res = false) =>{
				$(".search-list").html(res);
				$(".search-list > .ispa-shop").each(function(){
					$(this).click(function(){
						var id = $(this).attr("data-id");
						bus_page(id);
					})
				})
			});
		}
	})
	$(".bs-book").click(function(){
		var sel = bus_book();
		appoint_bus($(".ispa-bs").attr("data-id"),sel, (res = false) =>{
			if (res) {				
				$("#ispa-appt").show();
				clear_appt();
				$("#ispa-appt").attr("data-business",$(".ispa-bs").attr("data-id"));
				$(".service-list").html(res.m);	
				$(".staff-sel").html(res.staff);
				$(".appt-shop").html(res.name);										
				$(".can-appt, .re-appt").hide();												
				book_sel();	
				$(".payable").html(get_booked().amnt);
			}
		});
	})	
}
let apt_funcs = function(){	
	$(".ispa-appt > div.modal-tools > button.close").click(() =>{
		$("#ispa-appt").hide();
	})
	$(".pay-btn").click(() =>{
		$(".tot-a").html("");
		var {amnt} = get_booked();
		if (amnt > 0) {
			$("#ispa-pay").show();
			$(".tot-a").html(`Ksh. ${amnt}`);
		}else{
			notify("Kindly select a service first.");
		}
	})
	$(".mpesa-trig").click(function(){
		$(".pay-status").show();
		setTimeout( () =>{
			notify("An error occured, try again later.")
			$(".pay-status").hide();
		}, 2000);
	})
	$(".copy-ac").click(function(){
		copyText("acc-no", "Till Number copied successfully.");
	})
	$(".close-pay").click((e) =>{			
		$("#ispa-pay").hide();
	})
	$(".date-sel").click(function(){
		if (!$("#ispa-appt").attr("data-editing")) {
			init_calendar($("#ispa-appt").attr("data-business"));
		}
	})
	$(".staff-sel").on("change",() =>{
		if ($("#ispa-appt").attr("data-editing") == "") {
			$(".date-sel").html("");
		}
	})
	$("#appt-go").click(function(){				
		make_appointment();
	})
	$("#can-appt").click(function(){
		var item = $("#ispa-appt").attr("data-edited");
		if (item) {
			prompt(true,"Are you sure you want to delete this appointment?", (res = false) =>{
				if (res) {
					fetch({item: item}, {url: "rem_apt"}, (res = false) =>{
						if (res) {
							clear_appt();
							$("#ispa-appt").hide();
							$(".nav-tab.active").click();
						}
					})
				}else{
					prompt(false);
				}
			}, 
			{n: "Cancel", p: "Delete"});			
		}
	})
}
book_sel = function(){
	$(".service-list .bs-service-item > .service-select").each(function(){
		$(this).click(function(){
			if ($(this).hasClass("active")) {
				$(this).children("i").html("");
			}else{
				$(this).children("i").html("done");
			}
			$(this).toggleClass("active");				
			$(".payable").html(get_booked().amnt);
			$(".date-sel").html("");			
		})
	})
}
let clear_appt = function(){
	$("#ispa-appt").removeAttr("data-editing");
	$("#ispa-appt").removeAttr("data-edited");
	$(".date-sel").html("");
	$(".staff-sel").html("");
	$(".appt-shop").html("");
	$(".service-list").html("");
	$(".payable").html("");
	$(".appt-bar").attr("class","app-bar appt-bar");
	$(".date-sel::after").attr("content", "Click to change date");
	$(".date-sel").addClass("editable");
	$(".book-note").show();
	$(".pay-btn").show();
	$("#appt-go").removeClass("hidden");
	$("#can-appt").addClass("hidden");
}
calendar = function(){
	init_calendar = function(bus = false, month = false, year = false){
		if (bus) {
			var selected_sevices = get_booked();
			if (selected_sevices.dur > 0) {
				var data = {
					dur: selected_sevices.dur,
					business: bus,
					month:month,
					year: year
				}
				get_calendar(data);				
			}else{
				notify("Kindly select services you want to book an appointment for first.")
			}
		}
	}
	date_sel = function(){
		$(".calendar-date:not(.past)").each(function(){
			$(this).click(function(){
				var day = $(this).attr("data-day");
				var business = "";
				var month = $(".calendar").attr("data-month");
				var year = $(".calendar").attr("data-year");
				$(".calendar-date.active").removeClass("active");
				$(this).addClass("active");
				var data = {
					day: day,
					business: $("#ispa-appt").attr("data-business"),
					month:month,
					year: year,
					dur: get_booked().dur,
					staff: $(".staff-sel").val()
				}
				get_suggests(data);
			})
		})
	}	
	dur_sel = function(){
		$(".book-suggestion").each(function(){
			$(this).click(function(){
				$(".book-suggestion.active").removeClass("active");
				$(this).addClass("active");
				var sel_date = $(this).attr("data-tooltip");
				$(".date-sel").html(sel_date);
				$(".booking-calendar").hide();
			})
		})
	}	
	$(".next-month").click(function(){	
		init_calendar($("#ispa-appt").attr("data-business"), (Number($(".calendar").attr("data-month")) + 1), Number($(".calendar").attr("data-year")));
	})
	$(".prev-month").click(function(){
		init_calendar($("#ispa-appt").attr("data-business"), (Number($(".calendar").attr("data-month")) - 1), Number($(".calendar").attr("data-year")));
	})
}

function apts() {
	$(".ispa-appointments-item").each(function(){
		$(this).click(function(){
			var id = $(this).attr("data-item");
			get_appointment(id);
		})
	})
}
apts();
get_booked = function(){
	var booked = {};
	var booked_items = [];
	var booked_dur = 0;
	var booked_amnt = 0;
	$(".service-list > .bs-service-item").each(function(){
		if ($(this).children(".service-select").hasClass("active")) {
			var b = {
				dur: Number($(this).attr("data-duration")),
				amnt: Number($(this).attr("data-amount")),
				id: Number($(this).attr("data-item"))
			}
			booked_dur += b.dur;
			booked_amnt += b.amnt;
			booked_items.push(b);
		}
	})

	booked= {
		items: booked_items,
		dur: booked_dur,
		amnt: booked_amnt
	};
	return booked;
}
bus_book = function(){
	var selected = 0;
	var total = 0;
	var tot_time = 0;
	var pre_services = [];

	$(".serv > .bs-service-item").each(function(){
		if ($(this).children(".service-select").hasClass("active")) {
			x = {
				item : $(this).attr("data-item") 
			}
			total += Number($(this).attr("data-amount"));
			tot_time += Number($(this).attr("data-duration"));
			selected += 1;
			pre_services.push(x);
		}
	})
	if (selected > 0) {
		$(".bus-service-book").show();
	}else{
		$(".bus-service-book").hide();
	}
	if (selected == 1) {
		txt = "Service";
	}else{
		txt = "Services";
	}
	$(".stat-count").html(selected+" "+txt);
	$(".stat-amount").html("Ksh. "+total);
	return pre_services;
}	
let active_menu = "home";
class system {
	constructor(){
		this.menuManager();
		$(".menu-more").click(function(e){
			if ($(e.target).is(".menu-more")) {
				$(".menu-more").hide();
				$(`.nav-tab#more`).removeClass("active");
				$(`.nav-tab#${active_menu}`).addClass("active");
			}
		})
	}	
	menuManager() {
		$(".nav-tab").each((x,y) =>{						
			$(y).click((x) =>{
				let obj = null;
				var id = "home";
				$(".nav-tab").removeClass("active");
				if ($(x.target).is(".material-icons, .tab-name") ) {
					var id = $(x.target).parent().attr("id");
					obj = $(x.target).parent();
				}else{
					var id = $(x.target).attr("id");
					obj = $(x.target);
				}
				if (obj) {
					obj.addClass("active");
				}
				if (id != "more") {
					active_menu = id;
					get_menu(id,"client");
				}else{
					$(".menu-more").show();
				}				
			})
		})
		menu_more();		
	}
}

let acct = function(){
	$(".settings").click(function(){
		$(".setting-cont").show();
	})
	$(".setting-cont").click(function(e){
		if ($(e.target).is(".setting-cont")) {
			$(".setting-cont").hide();
		}
	})
	$(".setting-item").each(function(){
		$(this).click(function(){
			$(".setting-cont").hide();
			var id = $(this).attr("id");
			if (id === "edit") {
				$("#edit-details").show();
			}else if(id === "pass"){
				$(".update-pass").show();
			}
		})
	})

	/* edit profile */
	$(".edit-cam").click(function(){
		$(".prof-options").show();
	})
	$(".prof-options, .prof-item.back").click(function(e){
		if ($(e.target).is(".prof-options, .back")) {
			$(".prof-options").hide();
		}
	})
	$(".close-prev, .prof-preview").click(function(e){
		if ($(e.target).is(".prof-preview, .close-prev")) {
			$(".prof-preview").hide();
			$(".pref-pre").attr("src", "");
		}
	})
	$(".prof-item.rem").click(function(){
		prompt(true,"Remove your profile picture?", (res = false) =>{
			if (res) {
				del_prof();
			}else{
				prompt(false);
			}
		}, 
		{n: "Cancel", p: "Remove"});
	})
	$(".save-prof").click(function(){
		if ($("#edit-prof").val() != "") {
			var data = new FormData();
			inp = $("input#edit-prof");
			if (inp.val()!='') {	    	
				jQuery.each(jQuery(inp)[0].files, function(i, file) {
					data.append('file-'+i, file);
				});
				save_prof(data);
			};	 
		}
	})
	$(".close-edit").click(function(){
		$("#edit-details").hide();
	})
	$(".update-go").click(function(){
		var name = $(".edit-name").html();
		var email = $(".edit-email").html();
		var phone = $(".edit-phone").html();
		/*var location = get_selected();*/		

		if (get_length(name) >= 2) {
			if (validateInput(email,"email")) {
				if (phone == "" || validateInput(phone,"phone")) {
					if (pass != "") {
						var data = {
							name: name,
							email: email,
							phone: phone,
							location: false,							
						};
						save_edit(data);
					}else{
						notify("Kindly enter your password before you can save your details.");
					}
				}else{
					notify("Enter a valid phone number");
				}
			}else{
				notify("Enter a valid email");
			}
		}else{
			notify("Enter a valid name");
		}
	})

	/* change pass */
	$(".close-pass").click(function(){
		$(".update-pass").hide();
	})
	$(".save-pass").click(function(){
		var curr = $(".curr-pass").val();
		var new_pass = $(".new-pass").val();
		if (curr != "") {
			if (get_length(new_pass) >= 3) {
				change_pass({curr:curr,new_pass:new_pass});
			}else{
				notify("Enter a valid new password, at least 3 characters long",2000);
			}
		}else{
			notify("Enter your current passord.");
		}
	})
}
let notif = () =>{
	$(".notif-item").each(function(){
		$(this).click(function(){
			var item = $(this).attr("data-item");
			if (item) {
				read_notif(item, (res = false) =>{
					if (res) {
						$("#ispa-notif-view").show();
						$(".notif-title").html(res.m.item.title);
						$(".notif-date").html(res.m.item.date);
						$(".notif-body").html(res.m.item.content);
						$(`.notif-item[data-item="${item}"]`).removeClass("active");
						notif_indic(res.m.pending);
					}
				});
			}
		})
	})
	$(".close-n").click(function(){
		$("#ispa-notif-view").hide();
		$(".notif-title.main").html("");
		$(".notif-date.main").html("");
		$(".notif-body.main").html("");
	})
}
let notif_indic = function(state){
	if (state) {
		$(".nav-tab#notifications").prepend('<label class="tab-badge"></label>');
	}else{
		$(".nav-tab#notifications > label").remove();
	}
}
let menu_more = function(){
	$(".more-item").each(function(){
		$(this).click(function(){
			var item = $(this).attr("id");
			if (item === "logout") {
				location.href = base_url+"logout";
			}else if(item === "business"){
				location.href = base_url+"business";
			}else if(item === "help"){
				$(".ispa-help").show();
				$(".menu-more").click();
			}else if(item === "about"){
				$(".ispa-about").show();
				$(".menu-more").click();
			}
		})
	})
	$(".close-help").click(() =>{
		$(".ispa-help").hide();
	})
	$(".close-about").click(function(){
		$(".ispa-about").hide();
	})
}
function read_prof(input = false){ 	
	var t = ".pref-pre";
	if (FileReader && input && input.files[0]) {
		var file = new FileReader();	     	
		file.onload = function () {	    	
			$(t).attr("src",file.result);
			$(".prof-preview").show();
		}
		file.readAsDataURL(input.files[0]);
	}else{
		$(this).attr("src",$(this).attr("data-prof"));
	}
}
$(document).ready(() =>{
	home_tab();
	new system();
	calendar();	
	apt_funcs();		
})