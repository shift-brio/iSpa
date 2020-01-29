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
							bus_calendar();
							appt_func();
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

	profile();
	mg_s();	
	wds();
	prefs();	
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
				prompt(true, "Delete this service", (res = false) =>{
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
		$(".cal-draw").show();
	}
	function expand_cal(){
		$(".cal").slideDown("fast");
		$(".cal-more > i").html("expand_less");			
		$(".cal-draw").hide();
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
		expand_cal();		
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
	bus_appointment();
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
					day_func();	
					appt_func();
					$(".cal-cur").click();					
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
	$("#appt-con").click(function(){
		var item = $("#ispa-appt-b").attr("data-item");
		if (item) {
			fetch({item: item}, {"url": "confirm_app"}, res =>{
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
					fetch({item: item}, {"url": "cancel_app"}, res =>{
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

	booked= {
		items: booked_items,
		dur: booked_dur,
		amnt: booked_amnt
	};
	return booked;
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

$(document).ready(() =>{
	menu();
	bus_calendar();
	appt_func();	
})