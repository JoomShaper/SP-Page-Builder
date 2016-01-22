/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

jQuery(function($) {

  $('*[data-group_parent]*').each(function(){

    var $this = $(this);
    var parent = $(this).data('group_parent');
    var depend = $(this).data('depend');

    if( $('[data-attrname="'+ parent +'"]').val() != depend ) {
      $(this).hide();
    }

    $(document).on('change', '#field_' + parent, function(event) {

      var val = $(this).val();
      var $child = $('[data-group_parent="' + $(this).data('attrname') + '"]');

      if($child.length) {
        $child.each(function() {
          if($(this).data('depend') == val) {
            $(this).fadeIn();
          } else {
            $(this).hide();
          }
        });
      }
    });
  });
});