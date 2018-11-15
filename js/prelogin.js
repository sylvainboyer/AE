window.onload = function (){
	//bandeauResize();
	//Event.observe(window, "resize", bandeauResize);
	$('retour').observe('click', function(){
		document.location.href="index.php";
	});
	$('m').observe('blur',checkMailAsync);
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
	Field.focus($('m'));
}
// ##############################################
// Fonction asynchrone qui vérifie l'email (onblur)
function checkMailAsync(event){
	var inp = $(Event.element(event));
	if ("" != inp.value) {
		var ajaxcheck = new Ajax.Request('checkmail.php', {
			method: 'post',
			async: true,
			parameters: 'mail='+inp.value,
			onSuccess: function(ajaxcheck){
				if (eval(ajaxcheck.responseText)) {
					if(!$('imgMailOK')){
						var img = document.createElement('img')
						img.setAttribute("id", "imgMailOK");
						img.setAttribute("src", "gfx/ok.png");
						inp.parentNode.appendChild(img);
					}
				} else {
					Effect.Pulsate(inp.id, { pulses: 5, duration: 1.3 });
					Effect.BadMail(inp.id);
					if($('imgMailOK'))
						$('imgMailOK').remove();
				}
			}
		});
	}
} // checkMailAsync
// ##############################################
// Fonction synchrone qui vérifie l'email téléchargement
function checkMail(){
	var inp = $('m');
	var ajaxpi = new Ajax.Request('checkmail.php', {
		method: 'post',
		async: false,
		parameters: 'mail='+inp.value,
		onSuccess: function(ajaxpi){
			if (eval(ajaxpi.responseText)) {
				envoiFormulaire('fpinscription');
			} else {
				alert('chkmail   '+eval(ajaxpi.responseText));
				Effect.Pulsate('m', { pulses: 5, duration: 1.3 });
				Effect.BadMail('m');
			}
		}
	});
} // checkMailDl
// ##############################################
// Fonction qui poste le formulaire dont l'id est passé en paramètre (synchrone)
function envoiFormulaire(id){
	var params = "";
	var urlreq = "";
	var inptgtid = "";
	if (id == 'fpinscription') {
		params = 'action='+$F('action')+'&email='+$F('m');
		urlreq = 'preinsc.php';
		inptgtid = 'm';
	} /*else if (id == 'formcontact') {
		params = 'action='+$F('action')+'&email='+$F('inptxtMail_Req')+'&subject='+$F('subject')+'&version='+$F('version')+'&lang='+$F('lang')+'&msg='+$F('inptxtMsg');
		urlreq = '../mail.php';
		inptgtid = 'inptxtMail_Req';
	}*/
	var ajaxdl = new Ajax.Request(urlreq, {
		method: 'post',
		async: false,
		parameters: params,
		onSuccess: function(ajaxdl){
			if (-1 != ajaxdl.responseText.indexOf('OK')) {
				Element.replace(id, ajaxdl.responseText);
			} else {
				Effect.Pulsate(inptgtid, { pulses: 5, duration: 1.3 });
				Effect.BadMail(inptgtid);
			}
		},
		onFailure: function(ajaxdl){
			Element.replace(id, 'Une erreur est survenue, veillez reessayer.');
		}
	});
} // envoiFormulaire
// ##############################################
// Fonction qui alerte l'utilisateur si le champ 'courriel' est vide
function valider(frm){
  if(frm.elements['n'].value == "") {
      alert("Saisissez votre nom pour vous pre-inscrire.");
      return false;
  }
  if(frm.elements['p'].value == "") {
      alert("Saisissez votre prénom pour vous pre-inscrire.");
      return false;
  }
  if(frm.elements['m'].value == "") {
      alert("Saisissez votre adresse email pour vous pre-inscrire.");
      return false;
  }
  //checkMail();
}
