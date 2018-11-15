/*
 * cssjs
 * écrit par Christian Heilmann (http://icant.co.uk)
 * pour faciliter l'application dynamique de classes CSS via le DOM
 * paramètres: action a, object o and class names c1 and c2 (c2 optional)
 * actions: swap exchanges c1 and c2 in object o
 *			add adds class c1 to object o
 *			remove removes class c1 from object o
 *			check tests if class c1 is applied to object o
 * exemple:	cssjs('swap',document.getElementById('foo'),'bar','baz');
 */

function cssjs(a, o, c1, c2){
	switch (a){
		case 'swap':
			o.className = !cssjs('check', o, c1) ? o.className.replace(c2, c1) : o.className.replace(c1, c2);
			break;
		
		case 'addorremove':
			if(!cssjs('check',o,c1)){
				cssjs('add',o,c1);
			}else{
		    	cssjs('remove',o,c1);
			}
			break;
		
		case 'add':
			if(!cssjs('check',o,c1)){
				o.className += o.className ? ' ' + c1 : c1;
			}
			break;
		
		case 'set':
			o.className = c1;
			break;
			
		case 'remove':
			var rep = o.className.match(' ' + c1) ? ' ' + c1 : c1;
			o.className = o.className.replace(rep, '');
			break;
			
		case 'check':
			return new RegExp('\\b' + c1 + '\\b').test(o.className);
			break;
		case 'checkname':
		default:
			return new RegExp('\\b'+c1+'\\b').test(o.name);
		break;
	}
}

/*function bandeauResize(){
	var viewWidth = parseInt(document.viewport.getWidth(), 10);
	var minVW = 962;
	if(viewWidth <= minVW){
		$('img_bandeauG').style.width = 0;
		$('img_bandeauD').style.width = 0;
	}else{
		$('img_bandeauG').style.width = (viewWidth - 962 - (viewWidth/100)) / 2 + "px";
		$('img_bandeauD').style.width = (viewWidth - 962 - (viewWidth/100)) / 2 + "px";
	}
	$('img_bandeauG').style.height = "150px";
	$('img_bandeauD').style.height = "150px";
}*/


// Fonction qui scroll vers le haut de la page
function scrollup(){
	new Effect.ScrollTo($("bandeau"), { duration:'0.5' });
	$('scroll-bar').fade({ duration: 0.5 });
} // scrollup