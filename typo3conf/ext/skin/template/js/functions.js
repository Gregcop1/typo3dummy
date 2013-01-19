//jQuery's noConflict mode
jQuery.noConflict();
//extension de Jquery pour trouver les positions d'un élément.
jQuery.fn.extend({
  findPos : function() {
       var obj = jQuery(this).get(0);
       var curleft = obj.offsetLeft || 0;
       var curtop = obj.offsetTop || 0;
       while (obj = obj.offsetParent) {
     curleft += obj.offsetLeft
         curtop += obj.offsetTop
       }
       return {x:curleft,y:curtop};
  }
});


jQuery(document).ready(function(){
	//initialisation du menu principal
	initMainMenu();
	
	// fonctions génériques
	jQuery('.hover').hover(hoverIn,hoverOut);
	jQuery('.hideMe').each(hideMe);
	jQuery('.emptyMe').focus(emptyMe);
	jQuery('.emptyMe').blur(fullMe);
});


/*****
****** Fonctions  pour gérer le second niveau du menu principal
*****/
function initMainMenu() {
  if(jQuery('#mainNav .second').html()) {
  	jQuery('#mainNav .second').addClass('absolute');
  	
  	jQuery('#mainNav li').hover(mainMenuOver, mainMenuOut);
  }
}
function mainMenuOver() { jQuery(this).children('.second').show(); }
function mainMenuOut() { jQuery(this).children('.second').hide(); }


/*****
****** Fonctions  Génériques qui gère  le hover des images de class '.hover'
*****/
function hoverIn(){
   if(!jQuery(this).hasClass('active')){
      var srcName = jQuery(this).attr('src');
    srcName = srcName.replace('off','over');
    jQuery(this).attr({src:srcName});
   }
}

function hoverOut(){
   if(!jQuery(this).hasClass('active')){
    var srcName = jQuery(this).attr('src');
    srcName = srcName.replace('over','off');
    jQuery(this).attr({src:srcName});
   }
}


/*****
****** Fonction  Générique qui cache les champs
*****/
function hideMe(){
   jQuery(this).hide();
}


/*****
****** Fonctions  Génériques qui vide et reremplit les éléments de formulaire
*****/
var tmp_empty='';
function emptyMe(){
   tmp_empty = jQuery(this).val();
  jQuery(this).val('')
}
function fullMe(){
   if(jQuery(this).val()=='')
      jQuery(this).val(tmp_empty);
}
