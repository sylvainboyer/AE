window.onload = function (){
	//bandeauResize();
	//Event.observe(window, "resize", bandeauResize);
	// # map #
	var els = $$('li');
	for (var i = 0, l = els.length; i < l; ++i) {
		els[i].observe('mouseover', function(){
				surligneLi(this.id);
			});
		els[i].observe('click', function(){
				selectligneLi(this.id);
				map(this.id);
			});
		els[i].observe('mouseout', function(){
				deSurligneLi(this.id);
			});
		$('map').observe('click', function(){
				deSelectTout(this.id);
				showMap('mcache');
			});
  	}
	preload();
	// # fin map #
	// # début scroll top icon #
	$('scroll-bar').observe('click', scrollup);
	if(document.viewport.getScrollOffsets()[1] >= 250)
		$('scroll-bar').appear({ duration: 0.5 });
	document.observe('scroll', function(){
			if(document.viewport.getScrollOffsets()[1] >= 250){
				$('scroll-bar').appear({ duration: 0.5 });
			}else{
				$('scroll-bar').fade({ duration: 0.5 });
			}
		});
	// # fin scroll top icon #
}