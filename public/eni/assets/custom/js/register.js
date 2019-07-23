window.addEventListener("DOMContentLoaded", ()=>{

	var wrapper = document.getElementsByClassName('main-content-wrapper')[0];
	var page_title = document.getElementsByClassName('page-heading')[0];
	var to_bottom_btn = document.getElementById('to-down');

	wrapper.addEventListener("scroll", (event)=>{
		var scroll_pos = event.srcElement.scrollTop;
		// console.log(scroll_pos);
		if(scroll_pos >= 64){
			// page_title.style.position = "fixed";
			// page_title.style.top ="-10px";
			// page_title.style.left="43%";
		}
		to_bottom_btn.style.display = (scroll_pos == 0)?'block':'none'
	});
	to_bottom_btn.addEventListener("click", (event)=>{
		animate_scroll_bar(wrapper.scrollTop, wrapper.scrollHeight, 1000);
		to_bottom_btn.style.display= 'none';
	});

	function animate_scroll_bar(from, to, duration){
		var counter =1;
		wrapper.scrollTop = from
		var interval = setInterval(()=>{
			if(5*counter>= duration){
				clearInterval(interval);
			}else{
				wrapper.scrollTop+= ((to-from)/duration)*5;
			}
			counter+= 1;
		},5);
	}

	setTimeout(()=>{
		console.log("(-_-):=> hello there");
	}, 3000)
	
});