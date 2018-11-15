// Effet perso intégré à Script.aculo.us
Effect.BadMail = function(id) {
	var element = $(id);
	var stralert = ' *** adresse email incorrecte ***';
	if (stralert != element.value) {
		var valeur = element.value;
		var fond = element.style.backgroundColor;
		var couleur = element.style.color;
		var graisse = element.style.fontWeight;
		element.value = stralert;
		element.style.backgroundColor = '#ffff00';
		element.style.color = '#ff0000';
		element.style.fontWeight = 'bold';
		window.setTimeout(function(valeur, fond){
			this.value = valeur;
			this.style.backgroundColor = fond;
			this.style.color = couleur;
			this.style.fontWeight = graisse;
			//Field.focus(this);
		}.bind(element, valeur, fond, couleur, graisse), 1500);
	}
}