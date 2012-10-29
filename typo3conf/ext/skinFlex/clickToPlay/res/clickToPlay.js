jQuery(document).ready(function(){
	jQuery('.clickToPlayBloc .infos .play').click(function() {
    var player = jQuery(this).parent().parent().siblings('.player');
    player.attr('src',player.attr('future_src'));
    player.show()
  })
});