/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

(function ($) {

	//Remove Chosen
	$.fn.rowSortable = function(){
		$(this).sortable({
			placeholder: "ui-state-highlight",
			forcePlaceholderSize: true,
			axis: 'x',
			opacity: 0.8,
			tolerance: 'pointer',

			start: function(event, ui) {
				$( ".pagebuilder-section > .row" ).find('.ui-state-highlight').addClass( $(ui.item).attr('class') );
				$( ".pagebuilder-section > .row" ).find('.ui-state-highlight').css( 'height', $(ui.item).outerHeight() );
			}

		}).disableSelection();
	};

	//Column Sortable
	$.fn.columnSortable = function() {
		//Sorting items
		$(this).sortable({
			connectWith: this,
			items: ".generated",
			placeholder: "ui-state-highlight",
			forcePlaceholderSize: true,
			opacity: 0.8,
			dropOnEmpty: true,
			distance: 0.5,
			tolerance: 'pointer',
			/* start: function(event, ui) {

				if ($(ui.item).parent().find('.generated').length===1)
				{
					$(ui.item).parent().addClass('column-empty');
				}

			},
			stop: function(event, ui) {
				$(ui.item).parent().removeClass('column-empty');
			} */

		}).disableSelection();

		return $(this);
	};

	//elementEdit
	$.fn.elementEdit = function(){

		$('#modal-addons').spmodal('hide');

		$('#modal-addon').find('.sp-modal-body').empty();

		var $clone 	= $(this).clone();
		
		$clone.find('.sppb-color').each(function(){
			$(this).addClass('minicolors');
		});

		$clone 		= $clone.appendTo($('#modal-addon').find('.sp-modal-body'));
		//initialize color picker
		$clone.find('.minicolors').each(function() {
			$(this).minicolors({
				control: 'hue',
				position: 'bottom',
				theme: 'bootstrap'
			});
		});

		$clone.randomIds();

		//Modal Title
		$('#modal-addon').find('.sp-modal-title').text( $clone.find('h3').text() );

		$('#modal-addon .accordion .addon-title').each(function(){
			$(this).closest('.accordion-group').find('.accordion-toggle').text( $(this).val() );
		});

		$().sortableRepeatble();
		$clone.find('select').chosen({allow_single_deselect:true});

		$('#modal-addon').spmodal('show');

		//Editor
		$('#modal-addon').find('.sppb-editor').each(function(){
			var $id = $(this).attr('id');
			tinymce.execCommand('mceAddEditor', false, $id);
		});
	}

	$.fn.cloneRepeatable = function()
	{

		var $that = $(this);

		$(this).find('.sppb-editor').each(function(){
			var $id = $(this).attr('id');
			tinymce.execCommand('mceRemoveEditor', false, $id);
		});

		//Destroy Chosen
		$(this).find('select').chosen('destroy');

		var $clone = $(this).clone();
		$clone.find('.accordion-body').removeAttr('style');

		$clone = $clone.hide().appendTo( $(this).closest('.accordion') ).fadeIn(500).find('.collapse').removeClass('in');
		$clone.closest('.repeatable-items').randomIds();

		//Chosen
		$clone.find('select').chosen({allow_single_deselect:true});
		$(this).find('select').chosen({allow_single_deselect:true});

		//Editor
		$clone.find('.sppb-editor').each(function(){
			var $id = $(this).attr('id');
			tinymce.execCommand('mceAddEditor', false, $id);
		});
		$(this).find('.sppb-editor').each(function(){
			var $id = $(this).attr('id');
			tinymce.execCommand('mceAddEditor', false, $id);
		});

		$().sortableRepeatble();

	}


	$.fn.sortableRepeatble = function(){
		//Sortable
		$('#modal-addon .accordion').sortable({
			handle: '.action-move',
			placeholder: "ui-state-highlight",
			axis: 'y',
			opacity: 0.8,
			tolerance: 'pointer',

			start: function(event, ui){

				$(ui.item).find('.sppb-editor').each(function(){
					var $id = $(this).attr('id');
					tinymce.execCommand('mceRemoveEditor', false, $id);
				});
				
			},
	        stop: function(event, ui){

	        	$(ui.item).find('.sppb-editor').each(function(){
					var $id = $(this).attr('id');
					tinymce.execCommand('mceAddEditor', false, $id);
				});

	    	}

		});
	}

	//Random number
	function random_number() {
		return randomFromInterval(1, 1e6)
	}

	function randomFromInterval(e, t) {
		return Math.floor(Math.random() * (t - e + 1) + e)
	}

	$.fn.randomIds = function()
	{

		//Accordion
		$(this).find('.accordion').attr('id', 'accordion-repeatable');
		$(this).find('.accordion-group').each(function(index){

			$(this).find('.accordion-toggle')
				.attr("data-parent", '#accordion-repeatable')
				.attr("href", '#accordion-item-' + index);

			$(this).find('.collapse')
				.attr("id", 'accordion-item-' + index);
		});

		//Media
		$(this).find('.sppb-media-input').each(function(){
			var $id = random_number();
			$(this).attr('id', 'media-' + $id);
		});

		//Editor
		$(this).find('.sppb-editor').each(function(){
			
			var $id = random_number();
			$(this).attr('id', 'sppb-editor-' + $id);

		});
	}

	//remove ids
	$.fn.cleanRandomIds = function(){

		$(this).find('select').chosen('destroy');
		
		//Accordion
		$(this).find('.accordion').each(function(){
			$(this).removeAttr('id');
			$(this).find('.accordion-toggle').each(function() {
				$(this).removeAttr("data-parent");
				$(this).removeAttr("href");
			});

			$(this).find('.collapse').each(function() {
				$(this)
					.removeClass('in')
					.removeAttr("id")
					.removeAttr('style');
			})
		});

		//Media
		$(this).find('.media').each(function(){
			$(this).find('.input-media').removeAttr('id');
		});

		//Editor
		$(this).find('.sppb-editor').each(function(){
			var $id = $(this).attr('id');
			tinymce.execCommand('mceRemoveEditor', false, $id);
			$(this).removeAttr('id').removeAttr('style').removeAttr('area-hidden');
		});

		$(this).find('.mce-tinymce').remove();

		return $(this);

	}


	$.fn.init_tinymce = function()
	{
		tinymce.init({
			force_br_newlines : true,
			force_p_newlines : false,
			forced_root_block : '',
			file_browser_callback: function(field_name, url, type, win) {
				var media_modal = '<div class="sppb-media-modal-overlay" tabindex="-1">'
			    media_modal += '<div id="sppb-media-modal">'
			    media_modal += '<div class="sppb-media-modal-inner">'
			    media_modal += '<div class="sppb-media-modal-header clearfix">'
			    media_modal += '<h3 class="pull-left"><i class="fa fa-toggle-right"></i> ' + Joomla.JText._('COM_SPPAGEBUILDER_MEDIA_MANAGER') + '</h3>'
			    media_modal += '<div class="pull-right"><input type="file" accept="image/*" style="display:none"><a href="#" class="btn btn-success btn-large btn-upload-media"><i class="fa fa-upload"></i> ' + Joomla.JText._('COM_SPPAGEBUILDER_MEDIA_MANAGER_UPLOAD_FILE') + '</a><a href="#" class="btn btn-danger btn-large btn-close-modal"><i class="fa fa-times"></i> ' + Joomla.JText._('COM_SPPAGEBUILDER_MEDIA_MANAGER_CLOSE') + '</a></div>'
			    media_modal += '</div>'

			    media_modal += '<div class="sppb-media-modal-subheader clearfix">'

			    media_modal += '<ul class="sppb-media-modal-tab">'
			    media_modal += '<li class="active"><a class="tab-browse-media" href="#"><i class="fa fa-image"></i> <span class="hidden-phone">Browse Media</span></a></li>'
			    media_modal += '<li><a class="tab-browse-folder" href="#"><i class="fa fa-folder-open-o"></i> <span class="hidden-phone">Browse Folder</span></a></li>'
			    media_modal += '</ul>'

			    media_modal += '<div class="sppb-media-modal-filter-tools">'
			    media_modal += '<div class="sppb-media-search"><i class="fa fa-search"></i><input type="text" class="input-search-media" placeholder="' + Joomla.JText._('COM_SPPAGEBUILDER_MEDIA_MANAGER_SEARCH') + '"><a href="#" class="sppb-clear-search" style="display: none;"><i class="fa fa-times-circle"></i></a></div>'
			    media_modal += '<div class="sppb-media-modal-filter"></div>'
			    media_modal += '</div>'

			    media_modal += '</div>'

			    media_modal += '<div class="sppb-media-modal-btn-tools clearfix" style="display:none;">'
			    media_modal += '<a href="#" class="btn btn-primary btn-insert-media" data-target="'+ field_name +'"><i class="fa fa-check"></i> ' + Joomla.JText._('COM_SPPAGEBUILDER_MEDIA_MANAGER_INSERT') + '</a> <a href="#" class="btn btn-warning btn-cancel-media"><i class="fa fa-times"></i> ' + Joomla.JText._('COM_SPPAGEBUILDER_MEDIA_MANAGER_CANCEL') + '</a> <a href="#" class="btn btn-danger btn-delete-media"><i class="fa fa-minus-circle"></i> ' + Joomla.JText._('COM_SPPAGEBUILDER_MEDIA_MANAGER_DELETE') + '</a>'
			    media_modal += '</div>'

			    media_modal += '<div class="sppb-media-modal-body">'
			    media_modal += '<div class="sppb-media-modal-body-inner">'

			    media_modal += '<div class="spinner">'
			    media_modal += '<div class="bounce1"></div>'
			    media_modal += '<div class="bounce2"></div>'
			    media_modal += '<div class="bounce3"></div>'
			    media_modal += '</div>'

			    media_modal += '<a class="btn btn-default btn-large btn-loadmore" href="#" style="display: none;"><i class="fa fa-refresh"></i> ' + Joomla.JText._('COM_SPPAGEBUILDER_MEDIA_MANAGER_LOAD_MORE') + '</a>';

			    media_modal += '</div>'
			    media_modal += '</div>'

			    media_modal += '</div>'
			    media_modal += '</div>'

			    $(media_modal).hide().appendTo($('body').addClass('sppb-media-modal-open')).fadeIn(300, function() {
			      $(this).browseMedia()
			    })
			},

			toolbar_items_size: "small",
			invalid_elements : "script,applet,iframe",

			content_css : "administrator/components/com_sppagebuilder/assets/css/tinymce.css",

			plugins: [
			"advlist autolink lists link charmap preview image",
			"searchreplace code fullscreen",
			"media contextmenu paste"
			],
			relative_urls : true,
			document_base_url : pagebuilder_base,
			image_class_list: [
				{title: 'None', value: ''},
				{title: 'Left', value: 'pull-left'},
				{title: 'Right', value: 'pull-right'}
			],

			toolbar: "insertfile | styleselect | bold italic fontsizeselect | alignleft aligncenter alignright alignjustify | blockquote | bullist numlist | link image fullscreen"
		});
	};

	
	//Override clone
	(function (original) {
		jQuery.fn.clone = function () {
			var result       = original.apply(this, arguments),
			my_textareas     = this.find('textarea').add(this.filter('textarea')),
			result_textareas = result.find('textarea').add(result.filter('textarea')),
			my_selects       = this.find('select').add(this.filter('select')),
			result_selects   = result.find('select').add(result.filter('select'));

			for (var i = 0, l = my_textareas.length; i < l; ++i)          
				$(result_textareas[i]).val($(my_textareas[i]).val());

			for (var i = 0, l = my_selects.length;   i < l; ++i) 
				result_selects[i].selectedIndex = my_selects[i].selectedIndex;

			return result;
		};
	})($.fn.clone);

	$.ui.plugin.add("resizable", "alsoResizeReverse", {

		start: function(event, ui) {

			var self = $(this).data("resizable"), o = self.options;

			var _store = function(exp) {
				$(exp).each(function() {
					$(this).data("resizable-alsoresize-reverse", {
						width: parseInt($(this).width(), 10), height: parseInt($(this).height(), 10),
						left: parseInt($(this).css('left'), 10), top: parseInt($(this).css('top'), 10)
					});
				});
			};

			if (typeof(o.alsoResizeReverse) == 'object' && !o.alsoResizeReverse.parentNode) {
				if (o.alsoResizeReverse.length) { o.alsoResize = o.alsoResizeReverse[0];    _store(o.alsoResizeReverse); }
				else { $.each(o.alsoResizeReverse, function(exp, c) { _store(exp); }); }
			}else{
				_store(o.alsoResizeReverse);
			}
		},

		resize: function(event, ui){
			var self = $(this).data("resizable"), o = self.options, os = self.originalSize, op = self.originalPosition;

			var delta = {
				height: (self.size.height - os.height) || 0, width: (self.size.width - os.width) || 0,
				top: (self.position.top - op.top) || 0, left: (self.position.left - op.left) || 0
			},

			_alsoResizeReverse = function(exp, c) {
				$(exp).each(function() {
					var el = $(this), start = $(this).data("resizable-alsoresize-reverse"), style = {}, css = c && c.length ? c : ['width', 'height', 'top', 'left'];

					$.each(css || ['width', 'height', 'top', 'left'], function(i, prop) {
                    var sum = (start[prop]||0) - (delta[prop]||0); // subtracting instead of adding
                    if (sum && sum >= 0)
                    	style[prop] = sum || null;
                });

                //Opera fixing relative position
                if (/relative/.test(el.css('position')) && $.browser.opera) {
                	self._revertToRelativePosition = true;
                	el.css({ position: 'absolute', top: 'auto', left: 'auto' });
                }

                el.css(style);
            });
			};

			if (typeof(o.alsoResizeReverse) == 'object' && !o.alsoResizeReverse.nodeType) {
				$.each(o.alsoResizeReverse, function(exp, c) { _alsoResizeReverse(exp, c); });
			}else{
				_alsoResizeReverse(o.alsoResizeReverse);
			}
		}
	});



})(jQuery);