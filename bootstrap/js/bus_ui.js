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
			if (item) {				
				var data = {item: item, type: "business"};
				trigger_menu("close");	
				fetch(data, {url: "menu_item"}, (res = false) =>{
					if (res) {
						$(`.menu-item`).removeClass("active");
						$(`.menu-item[data-menu="${item}"]`).addClass("active");

						$(".ispa-area").html(res);
						if (item === "appointments") {

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

	profile();
	mg_s();	
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

let fetch = (data = {}, config = {type: "POST", process: false, url : ""}, callback = (res = false) =>{ console.log(res);}) =>{
	if (config.url != "") {
		loading(true);
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

/* manage services*/
let editing_item = false;
let mg_s = () =>{
	$(".add-serv").click(function(){
		$(".new-serv").show();
	})
	$(".new-serv, .close-ns").click(function(e){
		if ($(e.target).is(".new-serv, .close-ns, .close-ns > *")) {
			$(".new-serv").hide();
			serv_cont({ name: "", desc: "", cost: "", dur: "", avail: "" });
		}
	})

	$(".save-serv").bind("click", add_serv)

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
}
let add_serv = () =>{
	var serv_details = get_serv();

	let { name, desc, cost, dur, avail } = serv_details;
	
	if (get_length(name) > 3) {
		if (dur > 0) {				
			fetch(serv_details, {url: "add_service"}, (res = false) =>{
				if (res) {
					serv_cont({ name: "", desc: "", cost: "", dur: "", avail: "" });						
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
					serv_cont({ name: "", desc: "", cost: "", dur: "", avail: "" });						
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
let serv_cont =  ({ name, desc, cost, dur, avail })=>{
	$(".service-name").val(name);
	$(".service-desc").val(desc);
	$(".service-cost").val(cost);
	$(".service-dur").val(dur);	
	$(".service-avail").val(avail);

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

$(document).ready(() =>{
	menu();
})