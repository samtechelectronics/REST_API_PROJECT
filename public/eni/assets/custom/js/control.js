var side_bar_is_minimized = false;		

window.addEventListener("DOMContentLoaded", ()=>{
	var date = new Date();
	var side_trigger = document.getElementById('side-trigger-button');
	var connect_status_disp = document.getElementsByClassName('connect-stats')[0];
	var time_picker_config = {"container":".fill-parent",
							  "twelveHour":false,
							 };

	var date_picker_config = {"container": document.getElementsByClassName("fill-parent")[0],
							  "defaultDate": date,
							  "setDefaultDate":true,
							  "yearRange": [date.getYear()+1900, date.getYear()+1905],
							 }

	

	side_trigger.addEventListener('click', ()=>{
		side_bar_is_minimized = min_side_panel((side_bar_is_minimized)?false:true);
	});
	document.getElementsByClassName('custom-toast-wrapper')[0].addEventListener('click', ()=>{
		hide_toast();
	});

	// connect_status_disp.addEventListener('click', ()=>{
	// 	var counter =1;
	// 	connect_status_disp.style.opacity = 1;
	// 	console.log(connect_status_disp.style.opacity);
	// 	var interval = setInterval(()=>{
	// 		if(counter*5 > 500){
	// 			clearInterval(interval);
	// 			connect_status_disp.style.display= "none";
	// 		}else{
	// 			connect_status_disp.style.opacity -= 0.01;
	// 		}
	// 		counter+= 1;
	// 	},5);
	// });

	setTimeout(()=>{
		console.log("(-_-):=> hello there this is home page");
	}, 3000);

	var elems = document.querySelectorAll('.modal');
    var instances_modal = M.Modal.init(elems);

    var drop_trigger_menu = document.querySelectorAll('.dropdown-trigger');
	var instance_dropdown = M.Dropdown.init(drop_trigger_menu, {constrainWidth: false});

	var slide_history_show = document.querySelectorAll('.sidenav');
	var instances_history_slide = M.Sidenav.init(slide_history_show, {'edge':'right', 'draggable':false});

    var schedule_date_picker = document.querySelectorAll('.datepicker');
    var date_picker_instances = M.Datepicker.init(schedule_date_picker, date_picker_config);

    var schedule_time_picker = document.querySelectorAll('.timepicker');
    var time_picker_instances = M.Timepicker.init(schedule_time_picker, time_picker_config);

    setTimeout(()=>{
		set_toast_text("(-_-) you are now online");
	},2000);
	
});


function min_side_panel(state){
	var side_bar = document.getElementsByClassName('side-panel')[0];
	var side_avatar_badge = document.getElementsByClassName('avatar-badge')[0];
	var content_panel = document.getElementsByClassName('main-content-wrapper')[0];
	var side_panel_title = document.getElementById('side-panel-title');
	var side_panel_trig_wrapper = document.getElementById('side-panel-trig-wrapper');
	var side_panel_avatar= document.getElementById('side-panel-avatar');
	var user_email= document.getElementById('user-email');
	var user_email_icon= document.getElementById('user-email-icon');
	
	if (state) {
		side_bar.className = ' fill-parent col l1  z-depth-3 side-panel ';
		content_panel.className = 'col l11 s12 main-content-wrapper';
		side_panel_title.style.display = 'none';
		side_panel_trig_wrapper.className = "col l12"
		side_panel_avatar.style.transform = 'scale(0.5)';
		side_panel_avatar.style.margin = '-25px';
		side_avatar_badge.style.left='-22px'
		side_avatar_badge.style.bottom='10px';
		user_email.style.display="none";
		user_email_icon.style.display="none";

	}else{
		side_bar.className = ' fill-parent col l3  z-depth-3 side-panel ';
		content_panel.className = 'col l9 s12 main-content-wrapper';
		side_panel_title.style.display = 'block';
		side_panel_trig_wrapper.className = "col l3"
		side_panel_avatar.style.transform = 'scale(1)';
		side_panel_avatar.style.margin = '';
		side_avatar_badge.style.left='50px'
		side_avatar_badge.style.bottom='10px'
		user_email.style.display="inline";
		user_email_icon.style.display="inline";
	}
	return state;
}

var hide_toast = function(){
	var ele = document.getElementById('toast-trig');
	ele.checked = true;
} 
var show_toast = function(){
	var ele = document.getElementById('toast-trig');
	ele.checked = false;
} 
var set_toast_text = function(inText){
	var ele = document.getElementById('custom-toast-content');
	ele.innerHTML = inText;
}