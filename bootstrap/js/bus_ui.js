const menu = () =>{
	let trigger_menu = (state = "open") =>{
		if (state === "close") {
			$(".menu").hide();
		}else{
			$(".menu").show();
		}
	}
	$(".menu-btn").click(() =>{
		trigger_menu();
	})
	$(".menu").click((e) =>{
		if ($(e.target).is(".menu")) {
			trigger_menu("close");
		}
	})
	$(".menu-item").each(function(){
		$(this).click(function(){
			var item = $(this).attr("data-menu");
			if (item && item != "clients") {				
				var data = {item: item, type: "business"};
				trigger_menu("close");	
				fetch(data, {url: "menu_item"}, (res = false) =>{
					if (res) {
						$(`.menu-item`).removeClass("active");
						$(`.menu-item[data-menu="${item}"]`).addClass("active");

						$(".ispa-area").html(res);
						if (item === "appointments") {
							bus_appointment();
							bus_calendar();
							appt_func();
							bus_appt();
						}else if(item === "notifications"){
							notif();
						}
					}
				});
			} 
		})
	})
	$(".manage-ac").click(function(){
		$(".bus-manage").show();
	})
	bus_manage();	
}

let profile = function(){
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
		prompt(true,"Remove profile picture?", (res = false) =>{
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
		$("#edit-bus-det").hide();
	})
	$(".update-go").click(function(){
		var name = $(".edit-name").val();
		var email = $(".edit-email").val();
		var phone = $(".edit-phone").val();
		var location = $(".edit-loc").val();

		if (get_length(name) >= 2) {
			if (validateInput(email,"email") || email == "") {
				if (phone == "" || validateInput(phone,"phone")) {
					var data = {
						name: name,
						email: email,
						phone: phone,
						loc: location,							
					};
					fetch(data, {url: "update_shop"}, res =>{
						if (res) {
							notify("Shop details updated succesfully.")
						}
					});
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
	
}

save_show = function(data = false){
	if (data) {
		loading(true);
		$.ajax({
			url:base_url+"save_show",
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
					c_g_add();
					$(".g-list").html(response.m.list);
					$(".g-add").hide();
					g_items();
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

let read_prof = (input = false) =>{ 	
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
let bus_manage = () =>{
	$(".manage-item").each(function(){
		$(this).click(function(){
			var id = $(this).attr("data-id");			
			if (id) {
				$(`#${id}`).show();
			}
		})
	})
	$(".close-sv").click(function(){
		$("#manage-servs").hide();
	})

	$(".close-wds").click(function(){
		$("#wds").hide();
	})
	$(".cl-list").click(function(){
		$(".bus-manage").hide();
	})
	$(".cls-prefs").click(function(){
		$("#prefs").hide();
	})

	$(".cls-stf").click(function(){
		$("#staff-m").hide();
	})

	profile();
	mg_s();	
	wds();
	prefs();	
	showc();
	staff();
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

/* manage services*/
let editing_item = false;
let mg_s = () =>{
	$(".add-serv").click(function(){
		$(".new-serv").show();
	})
	$(".new-serv, .close-ns").click(function(e){
		if ($(e.target).is(".new-serv, .close-ns, .close-ns > *")) {
			$(".new-serv").hide();
			serv_cont({});
		}
	})

	$(".save-serv").bind("click", add_serv);

	serv_funcs();
}
function serv_funcs(){
	$(".edit-serv").each(function(){
		$(this).click(function(){
			editing_item = $(this).parent().parent().attr("data-item");
			fetch({item: editing_item}, {url: "get_service"}, (res = false) =>{
				if (res) {					
					serv_cont(res);
					//serv_cont({name: res.name, desc: res.desc, cost: res.cost, avail: res.avail});
					$(".new-serv").show();
					$(".ns-t").html("Update Service");
					$(".serv-go").removeClass("save-serv").addClass("update-serv").html("Update service");

					/* handel update */
					$(".serv-go").unbind().bind("click", update_s);					
				}
			});
		})
	})
	$(".del-serv").each(function(){
		$(this).click(function(){
			var item = $(this).parent().parent().attr("data-item");
			var elem = $(this).parent().parent();			
			if (item) {
				prompt(true, "Delete this service?", (res = false) =>{
					if (res) {						
						fetch({item: item},{url: "del_service"}, (res = false) =>{
							notify("Service removed succesfully");
							$(elem).slideUp();
							setTimeout(() =>{
								$(elem).remove();
							}, 1000);
						});
					}									
				},
				{n: "Cancel", p:"Ok"});
			}			
		})
		elem = false;
	})
}
let add_serv = () =>{
	var serv_details = get_serv();

	let { name, desc, cost, dur, avail } = serv_details;
	
	if (get_length(name) > 3) {
		if (dur > 0) {				
			fetch(serv_details, {url: "add_service"}, (res = false) =>{
				if (res) {
					serv_cont({});						
					notify("Service has been added succesfully");
					$(".s-list").html(res.services);
					serv_funcs();
				}
			});
		}else{
			notify("Kindly set service duration");
		}
	}else{
		notify("Kindly enter a valid service name : at least 3 characters long");
	}	
}

let update_s = () =>{
	var serv_details = get_serv();

	let { name, desc, cost, dur, avail } = serv_details;
	serv_details.editing = editing_item;
	
	if (get_length(name) > 3) {
		if (dur > 0) {				
			fetch(serv_details, {url: "update_service"}, (res = false) =>{
				if (res) {
					serv_cont({});						
					notify("Service has been updated succesfully");
					editing_item = false;
					$(".s-list").html(res.services);
					serv_funcs();
				}
			});
		}else{
			notify("Kindly set service duration");
		}
	}else{
		notify("Kindly enter a valid service name : at least 3 characters long");
	}	
}
let wds = ()=>{
	$(".wd-ind").each(function(){
		$(this).click(function(){
			var day = $(this).parent().parent().attr("data-day");
			if ($(this).hasClass("active")) {
				fetch({day: day, action: "remove"}, {url: "wdys"}, (res = false) =>{
					$(`.wd[data-day="${day}"] > div > .wd-ind`).removeClass("active");
					$(`.wd[data-day="${day}"] > div > .wd-hrs`).html(" - ");
				});
			}else{
				$(".wd-settings").attr("data-day", day);
				$(".wd-settings").show();

				$(".save-wds").unbind();
				$(".save-wds").bind("click", s_wds);
			}
		})
	})
	$(".close-wd-settings").click(function(){
		$(".cls-h").val("");
		$(".cls-h").val("");
		$(".wd-settings").removeAttr("data-day");
		$(".wd-settings").hide();
	})
}
let s_wds = ()=>{
	var start = $(".opn-h").val();
	var end = $(".cls-h").val();
	var day = $(".wd-settings").attr("data-day");

	if (start != "") {
		if (end != "") {
			if (day) {
				fetch({day: day, action: "add", start: start, end: end}, {url: "wdys"}, ({hours}) =>{
					if (hours) {
						$(".cls-h").val("");
						$(".cls-h").val("");
						$(".wd-settings").removeAttr("data-day");
						$(".wd-settings").hide();
						$(`.wd[data-day="${day}"] > div > .wd-ind`).addClass("active");
						$(`.wd[data-day="${day}"] > div > .wd-hrs`).html(hours);
					}
				});
			}
		}else{
			notify("Kindly select closing hours.")
		}
	}else{
		notify("Kindly select opening hours.")
	}
}
let staff = () =>{	
	$(".add-stf").click(function(){		
		$(".staff-add").show();
	})
	$(".cls-stf-add, .staff-add").click(function(e){
		if ($(e.target).is(".cls-stf-add, .cls-stf-add > i, .staff-add")) {
			$(".staff-add").hide();
		}
	})
	$(".save-staff").click(function(){
		var email = $(".staff-add-in").val();
		if (validateInput(email, "email")) {
			fetch({email: email}, {url: "add_staff"}, res => {
				if (res) {
					$(".stf-list").html(res);
					$(".staff-add").hide();
					(".staff-add-in").val("")
				}
			})
		}else{
			notify("Enter a valid email address");
		}
	})
}
let showc = () =>{
	$(".cls-shwc").click(function(){
		$("#show-im").hide();
	})
	$(".close-g").click(function(){
		$(".gallery").hide();
		$(".sl.main").attr("src", "");		
	})
	$(".gallery-pop").click(function(e){
		if ($(e.target).is(".gallery-pop")) {
			$(this).hide();
		}
	})
	g_items();
	$(".g-pop-i").each(function(){
		$(this).click(function(){
			var action = $(this).attr("id");
			var item = $(".gallery-pop").attr("data-item");
			if (action && item) {
				if (action == "view") {
					$(".gallery").show();
					$(".sl.main").attr("src", $(`.g-item[data-item='${item}'] > img`).attr("src"));
				}else if(action == "delete"){
					prompt(true,"Parmanently delete image from shop gallery?", res =>{
						if (res) {
							fetch({item: item}, {url: "del_gallery"}, res =>{
								if (res) {
									g_pop(false);
									$(".g-list").html(res.list);
								}
							});
						}
					}, cfg = {n: "Cancel", p:"Delete"});
				}else{
					$(".sl.main").attr("src", "");
					g_pop(false);
				}
				g_pop(false);
			}
		})
	})
	$(".add-g").click(function(){
		$(".g-add").show();
	})
	g_add();
}
let g_items = () =>{
	$(".g-item").each(function(){
		$(this).click(function(e){
			if ($(e.target).is(".g-item, .g-item > img")) {
				var item = $(this).attr("data-item");				
				g_pop(item);
			}
		})
	})
}

let g_pop = i =>{
	if (i) {
		$(".gallery-pop").show();
		$(".gallery-pop").attr("data-item", i);
	}else{
		$(".gallery-pop").hide();
		$(".gallery-pop").removeAttr("data-item");
	}
}

function g_add(){
	$(".cls-g-add").click(function(){
		$(".g-add").hide();
		c_g_add();
	})
	c_g_add = () =>{
		$("#show-in").val("");
		$(".g-add-img").attr("src", `${base_url}uploads/logo/ispa.svg`);
	}
	$(".rm-img").click(function(){
		c_g_add();
	})
	$(".sw-img").click(function(){
		$(".g-add-img").click();
	})

	$(".save-g").click(function(){
		if ($(".show-in").val() != "") {
			var data = new FormData();
			var inp = $("input#show-in");
			jQuery.each($(inp)[0].files, function(i, file) {
				data.append('file-'+i, file);
			});
			save_show(data); 
		}else{
			notify("No image selected.");
		}
	})
}

let read_show = (input = false) =>{ 	
	var t = ".g-add-img";
	if (FileReader && input && input.files[0]) {
		var file = new FileReader();	     	
		file.onload = function () {	    	
			$(t).attr("src", file.result);			
		}
		file.readAsDataURL(input.files[0]);
	}else{
		$(this).attr("src", `${base_url}uploads/logo/ispa.svg`);
	}
}

let serv_cont =  ({ name = "", desc = "", cost = "", dur = "", avail = false })=>{
	$(".service-name").val(name);
	$(".service-desc").val(desc);
	$(".service-cost").val(cost);
	$(".service-dur").val(dur);
	$(".service-avail").val(avail);	
	if (avail == false || avail == "false") {
		$(".service-avail").removeAttr("checked");		
	}else{
		$(".service-avail").parent().children("label").click();
		$(".service-avail").attr("checked", "checked");
	}	

	$(".ns-t").html("New Service");
	$(".serv-go").removeClass("update-serv").addClass("save-serv").html("Save service");
	$(".serv-go").unbind().bind("click", add_serv)
}

let get_serv = () =>{
	var name  = $(".service-name").val();
	var desc  = $(".service-desc").val();
	var cost  = $(".service-cost").val();
	var dur 	 = $(".service-dur").val();
	var avail = $(".service-avail").val();

	return {name, desc, cost, dur, avail};
}

let prefs = () =>{
	$(".pre-sw").each(function(){
		$(this).on("change", function(){
			var it = $(this);
			var item = $(this).parent().parent().parent().parent().attr("id");
			var val = $(this).val();
			fetch({item: item, value: val}, {url: "save_pref"}, (res) =>{
				if (res != "Invalid access" && res) {
					notify("Settings saved succesfully.");
				}else{
					if (val == "false" || val == false) {
						$(it).val(true);						
						$(it).attr("checked", "checked");										
					}else{
						$(it).val(false);		
						$(it).removeAttr("checked");
						notify("Invalid preference selected.");
					}					
				}
			})
		})
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
						//notif_indic(res.m.pending);
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

bus_calendar = function(){
	$(".cal-more").click(function(){
		if ($(".cal").is(":visible")) {
			$(".cal").slideUp("fast");
			$(this).children("i").html("expand_more");
		}else{
			$(".cal").slideDown("fast");
			$(this).children("i").html("expand_less");
		}
	})
	function close_cal(){
		$(".cal").slideUp("fast");
		$(".cal-more > i").html("expand_more");
		$(".day-appointments").addClass("more");
		/*$(".cal-draw").show();*/
	}
	function expand_cal(){
		$(".cal").slideDown("fast");
		$(".cal-more > i").html("expand_less");
		$(".day-appointments").removeClass("more");			
		/*$(".cal-draw").hide();*/
	}
	$(".cal-cur").click(function(){
		close_cal();
	})
	$(".cal-next").click(function(){
		var cur_date = $(".appointments-calendar").attr("data-day");
		if (cur_date) {
			get_day(cur_date,"next");			
		}
	})
	$(".cal-prev").click(function(){
		var cur_date = $(".appointments-calendar").attr("data-day");
		if (cur_date) {
			get_day(cur_date,"prev");
		}
	})
	$(".cal-draw").click(function(){
		if ($(".cal").is(":visible")) {
			close_cal();
		}else{
			expand_cal();
		}
	})
	cal_dates = function(){
		$(".cal-date:not(.past)").each(function(){
			$(this).click(function(){
				date = $(this).attr("data-date");
				if (date) {
					get_day(date,"cur");					
				}
			})
		})
	}
	cal_dates();	
}
let get_day = function(day = false, type = "next"){
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
					appt_func();
					/*$(".cal-cur").click();*/
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
bus_appointment = function(){
	$(".bus-appoint-back").click(function(){
		$(".bus-appointment").hide();
	})
	day_func = function(){
		/*$(".day-group").each(function(){
			$(this).click(function(){
				var item = $(this).attr("data-item");
				if (item) {
					bus_get(item);
				}
			})
		})*/
	}
	day_func();
	$(".appoint-sms").click(function(){
		item = $(".bus-appointment").attr("data-user");
		if (item) {			
			get_menu("chats","client",item);
			$(".material-tooltip").hide();
		}
	})
	$(".app-conf").click(function(){
		item = $(".bus-appointment").attr("data-appointment");
		if (item && confirm("Confirm this appointment?")) {
			confirm_app(item);
			$(".material-tooltip").hide();
		}
	})
	$(".app-canc").click(function(){
		note = "";
		note = prompt("Cancel this appointment?\nLeave a note for your client");
		item = $(".bus-appointment").attr("data-appointment");		
		if (get_length(note) >= 3 && item) {
			cancel_app(item,note);
			$(".material-tooltip").hide();
		}else{
			notify("Kindly let the client know why the appointment is being cancelled.")
		}
	})
	$(".app-miss").click(function(){		
		item = $(".bus-appointment").attr("data-appointment");		
		if (item) {
			miss_app(item);
			$(".material-tooltip").hide();
		}
		
	})	
	$(".cls-bs-appt").click(function(){
		clear_appt();
	})
	$(".walk-in").click(function(){
		$("#ispa-walk").show();
		$(".walk-list").html("");
		var bus = $("meta[name='bus']").attr("value") || false;
		appoint_bus(bus, false, ({m}) => {			
			$(".walk-list").html(m);
			walk_sel();
		});
	})
	$(".cls-walk").click(() => {
		$("#ispa-walk").hide();
		$(".walk-list").html("");
	})
	$("#walk-done").click(function(){
		var {items} = walk_booked() || false;
		if (items.length > 0) {
			var paid = $(".walk-paid").val();
			if (paid === true || paid === "true") {
				console.log(items);
				fetch({items: items, paid: paid}, {url:"walk_in"}, res => {
					if (res) {
						notify("Sale added succesfully.")
						$("#ispa-walk").hide();
						$(".walk-list").html("");

						/* clear */
						$("#ispa-appt-b").hide();
						$("#ispa-appt-b").attr("data-item", "");
						$(".appt-user").html("");
						$(".date-sel").html('');
						$(".service-list").html('');
						$(".appt-payable").html(0.00);
						$(".appt-payment").html("");
					}
				});
			}else{
				notify("The services have not been paid for yet.");
			}
		}else{
			notify("Kindly select a service.")
		}
	})
	$("#appt-more").click(function(){
		$(".more-tools").show();
	})
	$(".close-more").click(function(){		
		clear_appt();
	})

	ispa_checkout();
}

function clear_appt(){
	$("#ispa-appt-b").attr("data-item", "");
	$(".appt-user").html("");
	$(".date-sel").html("");
	$(".service-list").html("");
	$(".appt-payable").html("");
	$(".appt-payment").html("");
	$(".appt-bar").attr("class","app-bar appt-bar");
	$(".more-tools").hide();
	$("#ispa-appt-b").hide();
	$("#appt-done").show();	
}

function appt_func(){	
	$(".day-group").each(function(){
		$(this).click(function(){
			var item =  $(this).attr("data-item");
			$("#ispa-appt-b").attr("data-item", "");
			if (item) {
				fetch({item: item}, {url: "get_appointment"}, ({ user = {}, time = "", services = "", payment = false, total = 0.00, confirmed = 0, status = 0 }) =>{
					$("#ispa-appt-b").show();
					$("#ispa-appt-b").attr("data-item", item);
					$(".appt-user").html(user.name || "");
					$(".date-sel").html(time);
					$(".service-list").html(services);
					$(".appt-payable").html(total);
					$("#appt-paid").val(payment);
					
					if (payment) {						
						$("#appt-paid").prop("checked", true);
					}else{						
						$("#appt-paid").prop("checked", false);
					}

					$("#appt-done").hide();
					$(".more-tools").hide();

					if (confirmed == 1) {
						if (!status) {
							$("#appt-done").show();
						}
					}else {
						if (confirmed == 0) {
							$(".more-tools").show();
						}
					}

					/* bar color */
					if (status === 0) {																	
						if (confirmed == 0) {												
							$(".appt-bar").attr("class","app-bar appt-bar d-pend");
						}else if(confirmed == 1){							
							$(".appt-bar").attr("class","app-bar appt-bar d-con");
						}else{							
							$(".appt-bar").attr("class","app-bar appt-bar d-can");
						}
					}else{										
						if (status == 1) {
							$(".appt-bar").attr("class","app-bar appt-bar d-done");
						}else{
							$(".appt-bar").attr("class","app-bar appt-bar d-can");
						}
					}	
				});
			}
		})
	});	
}

bus_appt = function(){
	$("#appt-con").click(function(){
		var item = $("#ispa-appt-b").attr("data-item");
		if (item) {
			fetch({item: item}, {url: "confirm_app"}, res =>{
				if (res) {
					notify("Appointment confirmed succesfully.");
					clear_appt();
					$(".cal-date.active").click();
				}
			})
		}else{
			notify("No appointment selected.");
		}
	})
	$("#appt-can").click(function(){
		var item = $("#ispa-appt-b").attr("data-item");
		if (item) {
			prompt(true, "You will not be able to undo this action.<br>Cancel this appointment?", res => {
				if (res) {
					fetch({item: item}, {url: "cancel_app"}, res =>{
						if (res) {
							notify("Appointment cancelled.");
							$(".cal-date.active").click();
							clear_appt();							
						}
					});
				}
			}, cfg = {n: "Back", p:"Proceed"});
		}else{
			notify("No appointment selected.");
		}
	})
	$("#appt-done").click(function(){
		var item = $("#ispa-appt-b").attr("data-item");
		var paid = $(".appt-paid").val();		
		if (item) {
			if (paid == true || paid == "true") {
				fetch({item: item}, {url: "checkout"}, res =>{
					if (res) {
						notify("Appointment completed.");
						$(".cal-date.active").click();
						clear_appt();							
					}
				});
			}else{
				notify("Payment not made yet")
			}
		}
	})
}

walk_sel = function(){
	$(".walk-list > .bs-service-item > .service-select").each(function(){
		$(this).click(function(){
			if ($(this).hasClass("active")) {
				$(this).children("i").html("");
			}else{
				$(this).children("i").html("done");
			}
			$(this).toggleClass("active");				
			$(".payable").html(walk_booked().amnt);
			$(".date-sel").html("");			
		})
	})
}
walk_booked = function(){
	var booked = {};
	var booked_items = [];
	var booked_dur = 0;
	var booked_amnt = 0;
	$(".walk-list > .bs-service-item").each(function(){
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
	
	return {
				items: booked_items,
				dur: booked_dur,
				amnt: booked_amnt
			};
}
ispa_checkout = function(){
	$(".checkout").click(function(){		
		item = $(".bus-appointment").attr("data-appointment");		
		if (item) {
			checkout_get(item);
			$(".material-tooltip").hide();
		}
	})
	$(".checkout-close").click(function(){
		$(".ispa-checkout").hide();
	})
	$(".checkout-go").click(function(){
		var item = $(".ispa-checkout").attr("data-appointment");
		var disc = Number($(".checkout-disc").val());		
		if (item && disc == 0) {
			checkout(item,disc)
		}
	})
}

let long_press = (el = false) =>{
	let p = false;
	$(el).on("mouseup", function(){
		console.log("doown");
	})
}

/* ispa-switcher */
function switcher(){
	$(".new-bus-btn").click(function(){
		$(".add-bus").show();
	})
	$(".cls-add-bs").click(function(){
		$(".add-bus").hide();
	})
	$(".add-bs-go").click(function(){
		var name = $(".bs-name").val();
		var email = $(".bs-email").val();
		var phone = $(".bs-phone").val();
		var loc = $(".bs-loc").val();

		if (get_length(name) > 2) {
			if (validateInput(email, "email") || email == "") {
				if (validateInput(phone, "phone")) {
					var data = {
						name: name,
						email: email,
						phone: phone,
						loc: loc
					};
					fetch(data, {url: "submit_shop"}, res => {
						if (res && res.identifier) {
							location.href = `${base_url}business/open/${res.identifier}`;
						}else{
							notify("Oops! An error occurred. Try again.")
						}
					});
				}else{
					notify("Enter a valid phone number");
				}
			}else{
				notify("Enter a valid email")
			}
		}else{
			notify("Enter a valid shop name");
		}
	})
}
class Staff{
	constructor(){
		$(".stf-info").click(function(){
			$(".staff-info").show();			
		})
		$(".staff-info").click(function(e){
			if ($(e.target).is(".staff-info")) {
				$(".staff-info").hide();
			}
		})
		$(".cls-m-stf").click(function(){
			$(".m-staff").hide();
			$(".staff-img").attr("src", `${base_url}uploads/profiles/profile.svg`);
			$(".stf-name").html("");
			$(".stf-date").html("");
			$(".stf-info-phone").html("");
			$(".stf-info-loc").html("");
			$("#stf-avail").val(false);
			$("#stf-avail").removeAttr("checked");
			$(".stf-serv-list").html("");
			$(".m-staff").attr("data-item", "");
		})
		$(".o-stf-servs").click(function(){
			$(".stf-services").show();
		})
		$(".cls-stf-servs").click(function(){
			$(".stf-services").hide();
		})
		$(".rm-stf-m").click(function(){
			let item = $(".m-staff").attr("data-item");
			prompt(true, "Remove this staff member from shop?", (res = false) =>{
				if (res) {					
					fetch({staff: item}, {url: "del_staff"}, res => {
						if (res) {							
							$(".cls-m-stf").click();
							$(`.staff[data-item="${item}"]`).slideUp();
							setTimeout(() => {
								$(`.staff[data-item="${item}"]`).remove();
							}, 450);
						}
					});
				}else{
					prompt(false);
				}
			}, 
			{n: "Cancel", p: "Remove"});
		})
		$(".staff").each(function(){
			$(this).click(() =>{
				var item = $(this).attr("data-item");
				$(".sl-h-t, .stf-n-s").html("");
				fetch({stf: item}, {url: "get_stf"}, ({res = false, details = {}, servs = []}) => {
					if (res) {
						$(".m-staff").show();
						$(".staff-img").attr("src", details.profile);
						$(".stf-name").html(details.name);
						$(".stf-date").html(details.date);
						$(".stf-info-phone").html(details.phone);
						$(".stf-info-loc").html(details.loc);
						$("#stf-avail").val(details.avail);
						details.avail ? $("#stf-avail").prop("checked", "checked"): $("#stf-avail").removeAttr("checked");
						details.admin ? $("#stf-admin").prop("checked", "checked"): $("#stf-admin").removeAttr("checked");
						$(".stf-serv-list").html(servs);
						$(".m-staff").attr("data-item", details.id);
						$(".sl-h-t").html(`${details.name} sales history`);
						$(".stf-n-s").html(details.name);
						let s_list = "";	
						var tot_servs = 0;					
						if (servs.length > 0) {
							for (var i = 0 ; i < servs.length; i++) {
								var s = servs[i]
								var val = s.sel ? 1: 0;
								s.sel ? tot_servs += 1: "";
								var cls = s.sel ? "active": "";
								s_list +=`
										<div class="bs-service-item click-btn" data-amount="${s.serv.cost}" data-duration="${s.serv.dur}" data-item="${s.serv.id}">
											<div class="service-item-name">
												<div class="service-item-name-box">
													${s.serv.name}
												</div>
											</div>
											<div class="service-item-detail">
												<div class="service-item-detail-item">
													Ksh. ${s.serv.cost}
												</div>
												<div class="service-item-detail-item">
													${s.serv.dur} Min
												</div>									
											</div>
											<div value="${val}" class="service-select ${cls}">
												<i class="material-icons">done</i>
											</div>
										</div>
								`
								$(".serv-cnt").html(tot_servs);
							}
						}						
						$(".stf-serv-list").html(s_list);
						$(".stf-serv-list > .bs-service-item > .service-select").each(function(){
							$(this).click(function(){
								var item = $(this).parent().attr("data-item");
								if ($(this).attr("value") === 0 || $(this).attr("value") === "0" ) {
									$(this).attr("value", 1);
									$(this).addClass("active");
								}else{
									$(this).attr("value", 0);
									$(this).removeClass("active");
								}
							})
						})	
						staff_stats();					
					}
				});
			})
		})
		$(".stf-avail, .stf-admin").on("change", function(){
			var sel = $(this).val() || false;
			var stf = $(".m-staff").attr("data-item") || false;
			var type = $(this).is(".stf-avail") ? "avail" : "admin";
			var mes = sel == false ? "Declare staff member as unavailable? They will not be able to be booked." : "Declare this staff member as available for booking.?";
			if (type == "admin") {
				var mes = sel == false ? "Make this member an administrator? The member will be able to access funtionalities like managing shop data." : "Remove administrative privileges of this staff member?";				
			}			

			/*prompt(true, mes, (res = false) =>{
				if (res) {
					
				}else{
					$(this).is(".stf-avail") ? $(`[for="stf-avail"]`).click() : $(`[for="stf-admin"]`).click();
					prompt(false);
				}
			}, 
			{n: "Cancel", p: "Proceed"});*/

			/* confirmation prompt */
			fetch({sel: sel, staff: stf, type: type}, {url: "stf_edit"}, res => {
				if (res) {
					notify("Setting updated");
				}
			});
		})				
		$(".stf-stats").click(function(){			
			$(".sl-h").show();			
		})		
		$(".close-sl-h").click(function(){
			$(".sl-h").hide();
		})
		$(".u-stf-serv").click(function(){			
			var servs = [];
			var staff = $(".m-staff").attr("data-item");
			$(".stf-serv-list > .bs-service-item").each(function(){
				var val = Number($(this).children(".service-select ").attr("value"));
				var item = $(this).attr("data-item");
				if (val) {
					servs.push({
						s: item,
						a: val
					});					
				}
			})			
			if (staff) {
				fetch({servs: servs, staff: staff, type: "servs"}, {url: "stf_edit"}, res => {
					if (res) {
						notify("Staff services updated");
						$(".stf-services").hide();
						$(".serv-cnt").html(servs.length);
					}
				});
			}else{
				notify("Staff not found");
			}
		})
		$(".sl-h-year, .sl-h-mon").on("change", () =>{			
			staff_stats();
		});
	}
}
function staff_stats(){
	var m = $(".sl-h-mon").val();
	var y = $(".sl-h-year").val();
	var stf = $(".m-staff").attr("data-item");
	if (m && y) {
		fetch({month:m, year:y, staff: stf}, {url: "staff_stats"}, ({total = 0.00, customers = 0.00}) => {
			$(".sl-h-amnt").html(`${total}`);
			$(".sl-h-cus").html(`${customers}`);
		});
	}else{
		notify("Kindly select a valid year and month.");
	}
}
let s;
$(document).ready(() =>{
	menu();
	bus_calendar();
	bus_appointment();
	appt_func();	
	switcher();
	bus_appt();
	s = new Staff();
})