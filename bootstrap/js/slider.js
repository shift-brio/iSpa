base_url = $("base").attr("href");
class Slider {			
	constructor(list, config) {
		this.c_i = 0;
		this.list = list;
		this.config = config;								
		this.init();			
	}	
	init(){		
		if (this.config.prev) {			
			$(`.${this.config.prev}`).click(() => {
				this.prev();
			});
		}
		if (this.config.next) {
			$(`.${this.config.next}`).click(() =>{
				this.next();
			});
		}	

		$(`.${this.config.title}`).html(this.list[this.c_i].title)
		$(`.${this.config.img}`).attr("src", this.list[this.c_i].img);
		$(`.${this.config.prev}`).hide();
	}
	prev(){		
		if (this.c_i > 0) {			
			this.c_i -= 1;
			this.update();
			if (this.c_i == (this.list.length - 1) || this.c_i == 0) {
				if (this.c_i == (this.list.length - 1)) {
					$(`.${this.config.next}`).hide();
					$(`.${this.config.prev}`).show();
				}else{
					$(`.${this.config.next}`).show();
					$(`.${this.config.prev}`).hide();
				}
			}else{
				$(`.${this.config.next}`).show();
				$(`.${this.config.prev}`).show();
			}
		}
	}
	next(){					
		if (this.c_i < (this.list.length - 1)) {			
			this.c_i += 1;
			this.update();
			if (this.c_i == (this.list.length - 1) || this.c_i == 0) {
				if (this.c_i == (this.list.length - 1)) {
					$(`.${this.config.next}`).hide();
					$(`.${this.config.prev}`).show();
				}else{
					$(`.${this.config.next}`).show();
					$(`.${this.config.prev}`).hide();
				}
			}else{
				$(`.${this.config.next}`).show();
				$(`.${this.config.prev}`).show();
			}
		}
	}
	update(){		
		$(`.${this.config.title}`).html(this.list[this.c_i].title)
		$(`.${this.config.img}`).attr("src", this.list[this.c_i].img);		
	}
};

let lst = [
	{
		title: "Schedule appointments with your favorite shop ahead of time to avoid queues",
		img: `${base_url}uploads/onboarding/schedule.svg`
	},
	{
		title: "Make payments for appointments prior to the appointment",
		img: `${base_url}uploads/onboarding/payment.svg`
	},
	{
		title: "Manage your shop staff and monitor their performance",
		img: `${base_url}uploads/onboarding/teams.svg`
	}
]; 

let cfg = {

	title : "onb-title",
	img: "onb-img",
	prev: "onb-control.back",
	next: "onb-control.next"
}