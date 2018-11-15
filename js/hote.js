window.onload = function () {
/*  var f = document.getElementById('finscription');
  var boutons = f.getElementsByTagName('input');
  for (var i=0;i<boutons.length;i++) {
    if (cssjs("check", boutons[i], "img")) {    
      boutons[i].onmouseover = function(){roll(this);};
      boutons[i].onmouseout = function(){roll(this);};
    }
  }*/
	bandeauResize();
	Event.observe(window, "resize", bandeauResize);
}
function roll(img)
{
	// get the src of the image, and find out the file extension
		var src = img.src;
		var ftype = src.substring(src.lastIndexOf('.'), src.length);
	// check if the src already has an -over and delete it, if that is the case 
		if(/-over/.test(src))
		{
			var newsrc = src.replace('-over','');
		}else{
	// else, add the -over to the src 
			var newsrc = src.replace(ftype, '-over'+ftype);
		}
		img.src=newsrc;
}