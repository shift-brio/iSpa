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
	}
	prev(){		
		if (this.c_i > 0) {			
			this.c_i -= 1;
			this.update();
		}
	}
	next(){					
		if (this.c_i < (this.list.length - 1)) {			
			this.c_i += 1;
			this.update();
		}
	}
	update(){		
		$(`.${this.config.title}`).html(this.list[this.c_i].title)
		$(`.${this.config.img}`).attr("src", this.list[this.c_i].img);
	}
};

let lst = [
	{
		title: "First title",
		img: `${base_url}uploads/onboarding/payment.svg`
	},
	{
		title: "Second title",
		img: `${base_url}uploads/onboarding/schedule.svg`
	},
	{
		title: "Third title",
		img: `${base_url}uploads/onboarding/teams.svg`
	}
]; 

let cfg = {

	title : "onb-title",
	img: "onb-img",
	prev: "onb-control.back",
	next: "onb-control.next"
}