window.addEventListener("DOMContentLoaded", ()=>{

	var pre_loader = document.getElementsByClassName('pre-loader')[0];
	var wrapper = document.getElementsByClassName('main-content-wrapper')[0];
	var page_title = document.getElementsByClassName('page-heading')[0];
	var to_bottom_btn = document.getElementById('to-down');

	setTimeout(()=>{
		console.log("(-_-):=> hello there");
		pre_loader.style.display = 'none';
	}, 3000)
	
	var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);

});