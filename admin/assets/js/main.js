/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

jQuery(function($) {

	$(document).ready(function(){

		$('#jform_id, #jform_sptext').closest('.control-group').hide();

		$(this).find('select').each(function(){
			$(this).chosen('destroy');
		});

		$(this).init_tinymce();

		jqueryUiLayout();

		//Filter Addons
		$(document).on('click', '#modal-addons .addon-filter ul li a', function(){
			var $self = $(this);
			var $this = $(this).parent();
			$self.closest('ul').children().removeClass('active');
			$self.parent().addClass('active');

			if($this.data('category')=='all') {
				$('#modal-addons').find('.pagebuilder-addons').children().removeAttr('style');
				return true;
			}

			$('#modal-addons').find('.pagebuilder-addons').children().each(function(){
				if($(this).hasClass( 'addon-cat-' + $this.data('category') )) {
					$(this).removeAttr('style');
				} else {
					$(this).css('display', 'none');
				}
			});

		});

		//Search addon
		$(document).on('keyup', '#modal-addons #search-addon', function(){
			var value = $(this).val();
			var exp = new RegExp('.*?' + value + '.*?', 'i');

			$('#modal-addons .addon-filter ul li').removeClass('active').first().addClass('active');

			$('#modal-addons').find('.pagebuilder-addons').children().each(function() {
				var isMatch = exp.test($('.element-title', this).text());
				$(this).toggle(isMatch);
			});
		});

		//Duplicate row
		$(document).on('click', '.duplicate-row', function(event){
			event.preventDefault();

			var $this = $(this),
				$parent = $this.closest('.pagebuilder-section'),
				$clone = $parent[0].outerHTML;

			var $cloned = $($clone).insertAfter($parent).fadeIn(500);

			jqueryUiLayout();
		});

		$(document).on('click', '.add-addon', function(event){
			event.preventDefault();

			$('#modal-addons .addon-filter ul li').removeClass('active').first().addClass('active');

			var $columns = $('.page-builder-area .column');
			$columns.removeClass('active-column').find('.generated').each(function(){
				$(this).removeClass('active-generated');
			});

			$(this).parent().prev().addClass('active-column');

			var $html = $('.pagebuilder-addons-wrapper').find('.pagebuilder-addons').clone(true);
			$('#modal-addons').find('.sp-modal-body').empty();
			$('#modal-addons').find('.sp-modal-body').html( $html );
			$('#modal-addons').spmodal();
			$('#modal-addon').find('#save-change').removeClass('edit').addClass('addnew');
		});

		//edit generated addon
		$(document).on('click', '.addon-edit', function(event){
			event.preventDefault();
			var $toClone = $(this).closest('.generated').addClass('active-generated');
			$toClone.elementEdit();
			$('#modal-addon').find('#save-change').removeClass('addnew').addClass('edit');
		});

		//Single addon modal
		$(document).on('click', '#modal-addons .pagebuilder-addons > li >a', function(event){
			event.preventDefault();
			$(this).next().elementEdit();
		});


		//Add Repeatable
		$(document).on('click', '.clone-repeatable', function(){
			$(this).next().find('>.accordion-group:first-child').cloneRepeatable();
		});

		//Clone Repeatable
		$(document).on('click', '#modal-addon .action-duplicate', function(){
			$(this).closest('.accordion-group').cloneRepeatable();
		});

		//Remove Repeatable
		$(document).on('click', '#modal-addon .action-remove', function(event){

			event.preventDefault();

			if($(this).closest('.accordion').find('.accordion-group').length != 1) //Do not delete last item
			{
				if ( confirm("Click Ok button to delete, Cancel to leave.") == true ) {

					$(this).closest('.accordion-group').fadeOut(500, function(){
						$(this).remove();
					});

				}
			}

		});

		//Add addon to elements
		$(document).on('click', '#modal-addon #save-change', function(){
			
			var title;

			if ( $(this).hasClass('addnew') )
			{
				var $original = $('#modal-addon').find('.generated');
				$original.cleanRandomIds();
				//destroy color picker
				$original.find('.minicolors-input').each(function() {
					$that = $(this);
					$(this).minicolors('destroy');
					$that.removeClass('minicolors');
				});

				var $admin_label = $original.find('.addon-admin_label:first').not('.repeatable-items .addon-admin_label:first');

				if ($admin_label.length) {
					title = $admin_label.val();
				}else{
					title = $original.find('.addon-title:first').not('.repeatable-items .addon-title:first').val();
				}
				
				$original.find('.addon-input-title').text(title);

				var $clone = $original.clone();
				$clone.appendTo( $('.page-builder-area .column.active-column'));

			} else {

				var $original = $('#modal-addon').find('.generated .generated-items');
				$original.cleanRandomIds();
				//destroy color picker
				$original.find('.minicolors-input').each(function() {
					$that = $(this);
					$(this).minicolors('destroy');
					$that.removeClass('minicolors');
				});

				var $admin_label = $original.find('.addon-admin_label:first').not('.repeatable-items .addon-admin_label:first');

				if ($admin_label.length) {
					title = $admin_label.val();
				}else{
					title = $original.find('.addon-title:first').not('.repeatable-items .addon-title:first').val();
				}

				$original.find('.addon-input-title').text(title);

				var $clone = $original.clone();
				$('.active-generated').empty();
				$clone.appendTo( '.active-generated' ).parent().hide().addClass('populating-content').fadeIn(500, function(){
					$(this).removeClass('populating-content');
				});
				$('.active-generated').removeClass('active-generated');
			}

		});

		$(document).on('click', '#save-change, .sp-modal-footer .sppb-btn-danger', function(){
			$('.active-generated').removeClass('active-generated');
		});

		$('.sp-modal-header').on('click','button.close',function(){
			$('.active-generated').removeClass('active-generated');
		});

		// Duplicated column
		$(document).on('click', '.action .addon-duplicate', function(event){
			event.preventDefault();
			var $that = $(this),
				$parent = $that.closest('.generated'),
				$original = $that.closest('.generated').removeClass('active-generated'),
				$clone = $original.clone(true, true);
			$clone.hide().insertAfter( $parent ).fadeIn(500);
		});

		// Remove Row
		$(document).on('click', '.delete-row', function(event){
			event.preventDefault();

			if ( confirm("Click Ok button to delete Row, Cancel to leave.") == true )
			{
				$(this).closest('.pagebuilder-section').fadeOut(100, function(){
					$(this).remove();
				});
			}
		});

		// Remove Addons
		$(document).on('click', '.action .remove-addon', function(event){
			event.preventDefault();

			if ( confirm("Click Ok button to delete, Cancel to leave.") == true )
			{
				$(this).closest('.generated').remove();
			}

		});

		//Title
		$(document).on('keyup', '#modal-addon .accordion .addon-title', function(){
			$(this).closest('.accordion-group').find('.accordion-toggle').text( $(this).val() );
		});

		// row layout generate
		$(document).on('click', '.row-layout', function(event){
			event.preventDefault();

			var $that = $(this);
			if ($that.hasClass('active')) {
				return;
			};

			var $parent 		= $that.closest('.row-layout-container'),
				$gparent 		= $that.closest('.pagebuilder-section'),
				oldLayoutData 	= $parent.find('.active').data('layout'),
				oldLayout;

			if (oldLayoutData !=12) {
				oldLayout = oldLayoutData.split(',');
			}else{
				oldLayout = [12];
			}

			var layoutData 		= $that.data('layout'),
				newLayout;	
			if(layoutData != 12 ){
				newLayout = layoutData.split(',');
			}else{
				newLayout = [12];
			}

			var col = [],
				colAttr = [];
			$gparent.find('.column-parent').each(function(i,val){
				col[i] = $(this).find('.column').html();
				var colData = $(this).data();

				if (typeof colData == 'object') {
					colAttr[i] = $(this).data();
				}else{
					colAttr[i] = '';
				}
			});

			$parent.find('.active').removeClass('active');
			$that.addClass('active');

			var new_item = '';

			if ( oldLayout.length > newLayout.length )
			{
				var j = 1;
				for(var i=0; i < newLayout.length; i++)
				{
					var dataAttr = '';
					if (typeof colAttr[i] == 'object') {
						$.each(colAttr[i],function(index,value){
							dataAttr += ' data-'+index+'="'+value+'"';
						});
					}

					new_item +='<div class="column-parent col-sm-'+newLayout[i]+'" '+dataAttr+'>';

					if ( j != newLayout.length )
					{
						if (col[i]){
							new_item += '<div class="column ui-sortable">';
							new_item += col[i];
							new_item += '</div>';
						}else{
							new_item += '<div class="column"></div>';
						}
					} else {
						new_item += '<div class="column ui-sortable">';
						for(; j < col.length+1; j++)
						{
							if( col[j-1] )
							{
								new_item += col[j-1];
							}
						}
						new_item += '</div>';
					}
					
					new_item +='<div class="col-settings"><a class="add-addon" href="javascript:void(0)"><i class="fa fa-plus-circle"></i> Addon</a> <a class="column-options" href="javascript:void(0)"><i class="fa fa-cog"></i> Options</a></div></div>';
					j++;
				}

			}
			else
			{
				for(var i=0; i<newLayout.length; i++)
				{
					var dataAttr = '';
					if (typeof colAttr[i] == 'object') {
						$.each(colAttr[i],function(index,value){
							dataAttr += ' data-'+index+'="'+value+'"';
						});
					}

					new_item +='<div class="column-parent col-sm-'+newLayout[i]+'" '+dataAttr+'>';
					if (col[i]){
						new_item += '<div class="column ui-sortable">';
						new_item += col[i];
						new_item += '</div>';
					}else{
						new_item += '<div class="column"></div>';
					}
					new_item +='<div class="col-settings"><a class="add-addon" href="javascript:void(0)"><i class="fa fa-plus-circle"></i> Addon</a><a class="column-options" href="javascript:void(0)"><i class="fa fa-cog"></i> Options</a></div></div>';
				}
			}

			$old_column = $gparent.find('.column-parent');
			$gparent.find('.row.ui-sortable').append( new_item );

			$old_column.remove();

			$gparent.find('.column').columnSortable();

			jqueryUiLayout();

			return false;
		});

		//Column Settings
		$(document).on('click', '.column-options', function(event){
			event.preventDefault();
			
			var $this = $(this);
			$('.column-parent').removeClass('active-column-parent');
			var $parent = $(this).closest('.column-parent');
			$parent.addClass('active-column-parent');

			$('#modal-column').find('.sp-modal-body').empty();
			var $clone = $('.column-settings').clone(true);

			$clone.find('.sppb-color').each(function(){
				$(this).addClass('minicolors');
			});

			//Chosen
			$clone = $('#modal-column').find('.sp-modal-body').append( $clone );

			//retrive column settings
			$clone.find('.addon-input').each(function(){
				var $that = $(this),
					$attr_value = $parent.data( $(this).data('attrname'));

				// make a check for chekbox only
				if ($that.attr('type') == 'checkbox') {
					if ($attr_value == '1') {
						$that.attr('checked','checked');
					}else{
						$that.removeAttr('checked');
					}
				}else{
					$(this).val( $attr_value );
				}
			});

			$clone.find('.minicolors').each(function() {
				$(this).minicolors({
					control: 'hue',
					position: 'bottom',
					theme: 'bootstrap'
				});
			});

			$clone.find('select').chosen({
				allow_single_deselect: true
			});
			$('#modal-column').spmodal();

		});

		//Save Coulumn Settings
		$(document).on('click', '#save-column', function(){

			$('#modal-column').find('.addon-input').each(function(){

				var $this = $(this),
					$parent = $('.active-column-parent'),
					$attrname = $this.data('attrname');

				$parent.removeData( $attrname );

				if ($this.attr('type') == 'checkbox') {
					if ($this.attr("checked")) {
						$parent.attr('data-' + $attrname, '1');
					}else{
						$parent.attr('data-' + $attrname, '0');
					}
				}else{
					$parent.attr('data-' + $attrname, $(this).val());
				}

			});
		});

		//Row Settings Form Open
		$(document).on('click', '.row-options', function(event){
			event.preventDefault();

			var $this = $(this),
				$parent = $(this).closest('.pagebuilder-section');

			$('.pagebuilder-section').removeClass('active-row');
			$parent.addClass('active-row');

			$('#modal-row').find('.sp-modal-body').empty();
			var $clone = $('.row-settings').clone(true);

			$clone.find('.sppb-color').each(function(){
				$(this).addClass('minicolors');
			});

			$clone = $('#modal-row').find('.sp-modal-body').append( $clone );

			//retrive column settings
			$clone.find('.addon-input').each(function(){
				var $that = $(this),
					$attr_value = $parent.data( $(this).data('attrname'));

				// make a check for chekbox only
				if ($that.attr('type') == 'checkbox') {
					if ($attr_value == '1') {
						$that.attr('checked','checked');
					}else{
						$that.removeAttr('checked');
					}
				}else if($that.hasClass('input-media')){
					if($attr_value){
						$that.prev('.sppb-media-preview').removeClass('no-image')
							.attr('src',pagebuilder_base+$attr_value);
					}
					$that.val( $attr_value );
				}else{
					$that.val( $attr_value );
				}
			});		

			$clone.find('.minicolors').each(function() {
				$(this).minicolors({
					control: 'hue',
					position: 'bottom',
					theme: 'bootstrap'
				});
			});

			$('#modal-row').randomIds();

			$clone.find('select').chosen({
				allow_single_deselect: true
			});
			$('#modal-row').spmodal();
		});

		// Remove Media
		$(document).on('click', 'a.remove-media', function(event){
			event.preventDefault();
			$(this).closest('.media').find('.input-media').val('');
			$(this).closest('.media').find('.media-preview img').removeAttr('src');
		});

		//save
		$(document).on('click', '#save-row', function(){
			$('#modal-row').find('.addon-input').each(function(){

				var $this = $(this),
					$parent = $('.active-row'),
					$attrname = $this.data('attrname');

				$parent.removeData( $attrname );

				if ($this.attr('type') == 'checkbox') {
					if ($this.attr("checked")) {
						$parent.attr('data-' + $attrname, '1');
					}else{
						$parent.attr('data-' + $attrname, '0');
					}
				}else{
					$parent.attr('data-' + $attrname, $(this).val());
				}

			});
		});

		$.fn.allData = function() {
			var intID = $.data(this.get(0));
			return($.cache[intID]);
		};


	});//end ready

	// add new row
	var html = '';
	html += '<div class="pagebuilder-section">';

	html += '<div class="section-header clearfix">';
	html += '<div class="pull-left">';
	html += '<a class="move-row" href="javascript:void(0)"><i class="fa fa-arrows"></i></a>';
	html += '<div class="row-layout-container">';
	html += '<a class="add-column" href="javascript:void(0)"><i class="fa fa-plus"></i> Add Column</a>';
	html += '<ul>';
	html += '<li><a href="#" class="row-layout row-layout-12 sp-tooltip active" data-layout="12" data-toggle="tooltip" data-placement="top" data-original-title="1/1"></a></li>';
	html += '<li><a href="#" class="row-layout row-layout-66 sp-tooltip" data-layout="6,6" data-toggle="tooltip" data-placement="top" data-original-title="1/2 + 1/2"></a></li>';
	html += '<li><a href="#" class="row-layout row-layout-444 sp-tooltip" data-layout="4,4,4" data-toggle="tooltip" data-placement="top" data-original-title="1/3 + 1/3 + 1/3"></a></li>';
	html += '<li><a href="#" class="row-layout row-layout-3333 sp-tooltip" data-layout="3,3,3,3" data-toggle="tooltip" data-placement="top" data-original-title="1/4 + 1/4 + 1/4 + 1/4"></a></li>';
	html += '<li><a href="#" class="row-layout row-layout-48 sp-tooltip" data-layout="4,8" data-toggle="tooltip" data-placement="top" data-original-title="1/3 + 3/4"></a></li>';
	html += '<li><a href="#" class="row-layout row-layout-39 sp-tooltip" data-layout="3,9" data-toggle="tooltip" data-placement="top" data-original-title="1/4 + 3/4"></a></li>';
	html += '<li><a href="#" class="row-layout row-layout-363 sp-tooltip" data-layout="3,6,3" data-toggle="tooltip" data-placement="top" data-original-title="1/4 + 1/2 + 1/4"></a></li>';
	html += '<li><a href="#" class="row-layout row-layout-264 sp-tooltip" data-layout="2,6,4" data-toggle="tooltip" data-placement="top" data-original-title="1/6 + 1/2 + 1/3"></a></li>';
	html += '<li><a href="#" class="row-layout row-layout-210 sp-tooltip" data-layout="2,10" data-toggle="tooltip" data-placement="top" data-original-title="1/6 + 5/6"></a></li>';
	html += '<li><a href="#" class="row-layout row-layout-57 sp-tooltip" data-layout="5,7" data-toggle="tooltip" data-placement="left" data-original-title="5/12 + 7/12"></a></li>';
	html += '</ul>';
	html += '</div>';
	html += '</div>';

	html += '<div class="row-actions pull-right">';
	html += '<a class="add-rowplus" href="javascript:void(0)"><i class="fa fa-plus"></i></a>';
	html += '<a class="row-options" href="javascript:void(0)"><i class="fa fa-cog"></i></a>';
	html += '<a class="duplicate-row" href="javascript:void(0)"><i class="fa fa-files-o"></i></a>';
	html += '<a class="delete-row" href="javascript:void(0)"><i class="fa fa-times"></i></a>';
	html += '</div>';
	html += '</div>';

	html += '<div class="row ui-sortable">';
	html += '<div class="column-parent col-sm-12">';
	html += '<div class="column">';

	html += '</div>';

	html += '<div class="col-settings">';
	html += '<a class="add-addon" href="javascript:void(0)"><i class="fa fa-plus-circle"></i> Addon</a>';
	html += '<a class="column-options" href="javascript:void(0)"><i class="fa fa-cog"></i> Options</a>';
	html += '</div>';
	html += '</div>';
	html += '</div>';
	html += '</div>';

	$('#add-row').on('click',function(){
		$(html).appendTo('.page-builder-area');
		jqueryUiLayout();
	});

	$(document).on('click','.add-rowplus',function(){
		var $parent = $(this).closest('.pagebuilder-section');
		$(html).insertAfter($parent);
		jqueryUiLayout();
	});

	$('#add-template').on('click', function(event) {
		event.preventDefault();
		if ($(this).siblings('#pagebuilder-templates')) {
			$('#pagebuilder-templates').slideToggle('fast');
		}
	});

	function genJsonAddons(){

		var item = [];
		$('.page-builder-area .pagebuilder-section').each(function(index) {

			var $row 		= $(this),
			rowIndex 	= index,
			rowObj = $row.data();
			delete rowObj.sortableItem;

			var activeLayout = $row.find('.row-layout.active'),
			layoutArray = activeLayout.data('layout'),
			layout = 12;

			if( layoutArray != 12){
				layout = layoutArray.split(',').join('');
			}
			
			item[rowIndex] = {
				'type'  	: 'sp_row',
				'layout'	: layout,
				'settings' 	: rowObj,
				'attr'		: []
			};

			$row.find('.column-parent').each(function(index){

				var $column 	= $(this),
				colIndex 	= index,
				className 	= $column.attr('class'),
				colObj 		= $column.data();
				delete colObj.sortableItem;

				item[rowIndex].attr[colIndex] = {
					'type' 				: 'sp_col',
					'class_name' 		: className,
					'settings' 			: colObj,
					'attr' 				: []
				};

				$column.find('.generated').each(function(index){
					var $addon 	= $(this),
					codeIndex 	= index,
					codeName	= $addon.find('.generated-item>h3').data('name'),
					codeTitle	= $addon.find('.generated-item>h3').text(),
					codeType	= $addon.data('addon'),
					codeAtts 	= new Object();

					$addon.find('.item-inner > .form-group .addon-input').each(function(){
						var $this = $(this);
						//alert($this.val());
						codeAtts[ $this.data('attrname') ] = $this.val();

						// for checkbox only
						if ($this.attr('type') == 'checkbox') {
							if ($this.attr("checked")) {
								codeAtts[ $this.data('attrname') ] = '1';
							}else{
								codeAtts[ $this.data('attrname') ] = '0';
							}
						}
					});



					item[rowIndex].attr[colIndex].attr[codeIndex] = {
						'type' 		: codeType,
						'name' 		: codeName.toLowerCase(),
						'title'		: codeTitle,
						'atts'		: codeAtts,
						'scontent'	: []
					};

					if( $addon.find('.item-inner .repeatable-items') ){
						$addon.find('.item-inner .repeatable-items .accordion-group').each(function(index){
							var reIndex 	= index,
							$this 		= $(this),
							reCodeAtts 	= new Object(),
							repName = $this.data('inner_base');

							$this.find('.addon-input').each(function(){
								var $this = $(this);
								reCodeAtts[ $this.data('attrname') ] = $this.val();
							});

							item[rowIndex].attr[colIndex].attr[codeIndex].scontent[index] = {
								'type' 	: 'repeatable',
								'name'	: repName,
								'atts'	: reCodeAtts
							}
						});
					}
				});

	});

	});
	return item;

	}

	document.adminForm.onsubmit = function(event){
		event.stopImmediatePropagation();
		$('#jform_sptext').val( JSON.stringify(genJsonAddons()) );
	}

	function jqueryUiLayout()
	{
		$( ".page-builder-area" ).sortable({
			placeholder: "ui-state-highlight",
			forcePlaceholderSize: true,
			axis: 'y',
			opacity: 0.8,
			tolerance: 'pointer',

		}).disableSelection();

		$('.pagebuilder-section').find('>.row').rowSortable();
		$('.column').columnSortable();
	}

	// tinyMCE editor source code edit
	$(document).on('focusin', function(e) {
		if ($(e.target).closest(".mce-window").length) {
			e.stopImmediatePropagation();
		}
	});

	$('.sp-tooltip').tooltip();
});
