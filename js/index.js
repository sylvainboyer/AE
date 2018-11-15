window.onload = function () {
	//bandeauResize();
	//Event.observe(window, "resize", bandeauResize);
	var nav = $('hotes');
	var a = nav.getElementsByTagName('a');
	var f = $('fphoto');
	var boutons = f.getElementsByTagName('input');
	var btnName;
	var btnTab;
	var reg=new RegExp("[a-z]+", "gi");
	var regg=new RegExp("show", "gi");
	var nb_hotes = $('nb_hotes').innerHTML;
	var div_carte = $('carte');
	var i = 0,
		l = 0;
	var btn;
	for (i = 0, l = a.length ; i < l; ++i) {
		if (cssjs("check", a[i], "savoir_plus")) {
			a[i].observe('click', function(){mouseGoesOver(this.parentNode);});
		}
	}
	for (i = 0, l = boutons.length; i < l; ++i) {
		switch (boutons[i].name) {
			case "close":
				boutons[i].observe('click', function(){setBouton("close");});
				break;
			case "next":
				boutons[i].observe('click', function(){setBouton("next");});
				break;
			case "prev":
				boutons[i].observe('click', function(){setBouton("prev");});
				break;
			default:
				//alert("aa : "+boutons[i].name.search(regg)+" : " +boutons[i].name);
				break;
		}
		boutons[i].onmouseover = function(){roll(this);};
		boutons[i].onmouseout = function(){roll(this);};
	}
	for (i = 1, l = nb_hotes; i <= l; ++i){
		btn = $('show' + i);
		if (btn != null){
			btn.observe('click', respondToClick);
		}
	}
	var aels = $$('a.blog_ext');
	for (i = 0, l = aels.length; i < l; ++i){
		aels[i].target = "_blank";
	}
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
	
	carte.observe('click', function(){carte_click(this);});
}

function respondToClick(event) {
	var element = event.element();
	var id = element.id.substring(4);
	setIdx(id);
}

function mouseGoesOver(d) {
	var i = 0,
		l = 0;
	var divs = $$('div.visible');
	for (i = 0, l = divs.length; i < l; ++i) {
		cssjs('add',divs[i],"cache");
		cssjs('remove',divs[i],"visible");
	}
	divs = d.getElementsByTagName('div');
	for (i = 0, l = divs.length; i < l; ++i) {
		if (cssjs("check", divs[i], "description")) {
			if (cssjs("check", divs[i], "cache")) {
				cssjs('remove',divs[i],"cache");
				cssjs('add',divs[i],"visible");
			}else{
				cssjs('add',divs[i],"cache");
				cssjs('remove',divs[i],"visible");
			}
			divs[i].observe('click', function(){mouseGoesOut(this.parentNode);});
		}
	}
}

function mouseGoesOut(d) {
	var divs = d.getElementsByTagName('div');
	for (var i=0;i<divs.length;i++) {
		if (cssjs("check", divs[i], "description")) {
			cssjs('add',divs[i],"cache");
			cssjs('remove',divs[i],"visible");
			divs[i].stopObserving('click', function(){mouseGoesOut(this.parentNode);});
		}
	}
}

function carte_click(divcarte) {
	if (cssjs("check", divcarte, "carte_th")) {
			cssjs('add',divcarte,"carte_full");
			cssjs('remove',divcarte,"carte_th");
			$('carte_img').src = "gfx/map/carte2016.png";
			$('carte_img').title = "Cliquez pour réduire la carte";
			$('titre_carte_th').textContent = "Cliquez pour réduire";
	}else{
			cssjs('add',divcarte,"carte_th");
			cssjs('remove',divcarte,"carte_full");
			$('carte_img').src = "gfx/map/carte2016_th.gif";
			$('carte_img').title = "Cliquez pour agrandir la carte";
			$('titre_carte_th').textContent = "La carte";
	}
	/*if(divcarte.hasClassName('carte_th')){
		divcarte.classNames = 'carte_full';
	}else{
		divcarte.classNames = 'carte_th';
	}*/
}

/*function mouseClick(d) {
  var a = d.getElementsByTagName('a');
  for (var i=0, l=a.length; i<l; ++i) {
    if (cssjs("check", a[i], "description")) {
      cssjs('remove',divs[i],"cache");
      cssjs('add',divs[i],"visible");
    }
  }
}*/

function photo(frm, year) {
	var f = $('photo');
	switch (frm.elements.bouton.value) {
		case "close":
			cssjs("remove", f, "mvisible")
			cssjs("add", f, "cache")
			var img = $('pchantier');
			img.src = "";
			break;
		
		case "show":
			cssjs("add", f, "mvisible")
			var idx = frm.elements.idx.value - 1;
			f.style.top = (176.5*(parseInt(idx, 10))+400)+"px";
			var s_img = getPhoto(idx);
			var s_prop = getNomHote(idx);
			var i_nbImg = getNbPhoto(idx);
			var s_legImg = "";
			var img = $('pchantier');
			img.src = 'gfx/photos/' + s_img + '-1.jpg';
			img.alt = 'chantier ' + s_img;
			if (i_nbImg == 1) {
				$('prev').src = 'gfx/pto-prev-off.gif';
				$('prev').disabled = true;
				$('prev').style.cursor = "not-allowed";
				$('next').src = 'gfx/pto-next-off.gif';
				$('next').disabled = true;
				$('next').style.cursor = "not-allowed";
				s_legImg = getLegendePhoto(idx, 0);
				$('legende').innerHTML = s_legImg;
				$('prop').innerHTML = s_prop + " - " + i_nbImg + " photo";
			} else {
				$('prev').src = 'gfx/pto-prev.gif';
				$('prev').disabled = false;
				$('prev').style.cursor = "pointer";
				$('next').src = 'gfx/pto-next.gif';
				$('next').disabled = false;
				$('next').style.cursor = "pointer";
				var src = img.src;
				var res = src.match(/[0-9]+/gi);
				var idxPto = res[res.length - 1];
				s_legImg = getLegendePhoto(idx, idxPto-1);
				$('legende').innerHTML = s_legImg;
				$('prop').innerHTML = s_prop + " - photo " + idxPto + "/" + i_nbImg;
			}
			break;
		
		case "next":
			var idx = frm.elements.idx.value - 1;
			var s_img = getPhoto(idx);
			var s_prop = getNomHote(idx);
			var i_nbImg = getNbPhoto(idx);
			var s_legImg = "";
			var img = $('pchantier');
			var src = img.src;
			var res = src.match(/[0-9]+/gi);
			var idxPto = parseInt(res[res.length - 1], 10) + 1;
			if (idxPto > i_nbImg) {
				idxPto = 1;
			}
			s_legImg = getLegendePhoto(idx, idxPto-1);
			$('legende').innerHTML = s_legImg;
			if (i_nbImg > 1) {
				img.src = 'gfx/photos/' + s_img + '-' + idxPto + '.jpg';
				$('prop').innerHTML = s_prop + " - photo " + idxPto + "/" + i_nbImg;
			}
			break;
		
		case "prev":
			var idx = frm.elements.idx.value - 1;
			var s_img = getPhoto(idx);
			var s_prop = getNomHote(idx);
			var i_nbImg = getNbPhoto(idx);
			var s_legImg = "";
			var img = $('pchantier');
			var src = img.src;
			var res = src.match(/[0-9]+/gi);
			var idxPto = parseInt(res[res.length-1], 10) - 1;
			if (idxPto < 1) {
				idxPto = i_nbImg;
			}
			s_legImg = getLegendePhoto(idx, idxPto-1);
			$('legende').innerHTML = s_legImg;
			if (i_nbImg > 1) {
				img.src = 'gfx/photos/' + s_img + '-' + idxPto + '.jpg';
				$('prop').innerHTML = s_prop + " - photo " + idxPto + "/" + i_nbImg;
			}
			break;
		
		default:
			break;
	}
	img=$("pchantier");
	if(img.height > img.width){
		img.removeClassName('pchantierL');
		img.removeClassName('pchantierLA');
		img.removeClassName('pchantierC');
		img.addClassName('pchantierP');
	}else if(img.height < img.width){
		img.removeClassName('pchantierP');
		img.removeClassName('pchantierC');
		if(parseInt(img.height, 10) > 430){
			img.removeClassName('pchantierL');
			img.addClassName('pchantierLA');
		}else{
			img.removeClassName('pchantierLA');
			img.addClassName('pchantierL');
		}
	}else{ // ==
		img.removeClassName('pchantierP');
		img.removeClassName('pchantierL');
		img.removeClassName('pchantierLA');
		img.addClassName('pchantierC');
	}
	return false;
}

function setBouton(btStr) {
	var bt = $('bouton');
	bt.value = btStr;
}

function setIdx(btStr) {
	document.getElementById('bouton').value="show";
	var bt = document.getElementById('idx');
	bt.value = btStr;
}

function roll(img) {
	// get the src of the image, and find out the file extension
	var src = img.src;
	var ftype = src.substring(src.lastIndexOf('.'), src.length);
	// check if the src already has an -over and delete it, if that is the case
	if(/-over/.test(src)) {
		var newsrc = src.replace('-over','');
	} else { // else, add the -over to the src
		var newsrc = src.replace(ftype, '-over' + ftype);
	}
	img.src=newsrc;
}

function showLib(o)	{	// met en evidence
	cssjs('addorremove', o.parentNode, 'important');
}
