/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

jQuery(function($) {

  // Init dropdown
  $(document).on('click', '.fontawesome-icon-input', function(event) {
    event.preventDefault();
    $(this).closest('.fontawesome-icon-chooser').toggleClass('open');

    if($(this).closest('.fontawesome-icon-chooser').hasClass('open')) {
      $(this).closest('.fontawesome-icon-chooser').find('input[type="text"]').focus();
    }
  });

  // Select Icon
  $(document).on('click', '.fa-list-icon', function(event) {
    event.preventDefault();
    var $this = $(this);
    var parent = $this.closest('.fontawesome-icon-chooser')
    var fa_icons = $(this).closest('ul').find('>li');
    
    fa_icons.removeClass('active');
    $this.addClass('active');
    
    parent.find('.fontawesome-icon-input>span').html('<i class="fa '+ $this.data('fontawesome_icon') +'"></i> ' + $this.data('fontawesome_icon_name'));
    parent.find('.addon-input-fa').val($this.data('fontawesome_icon'));
    parent.addClass('has-fa-icon').removeClass('open');
  });

  // Search Icon
  $(document).on('keyup', '.fontawesome-dropdown input[type="text"]', function(){
    var value = $(this).val();
    var exp = new RegExp('.*?' + value + '.*?', 'i');

    $(this).next('.fontawesome-icons').children().each(function() {
      var isMatch = exp.test($('span', this).text());
      $(this).toggle(isMatch);
    });
  });

  // Remove Icon
  $(document).on('click', '.remove-fa-icon', function(event) {
    event.stopPropagation();
    event.preventDefault();
    var $this = $(this);
    var parent = $this.closest('.fontawesome-icon-chooser');

    parent.removeClass('has-fa-icon');
    parent.find('.fontawesome-icon-input>span').html('--' + Joomla.JText._('COM_SPPAGEBUILDER_ADDON_ICON_SELECT') + '--');
    parent.find('.fontawesome-icons>li').removeClass('active');
    parent.find('.addon-input-fa').val('');
  });
});