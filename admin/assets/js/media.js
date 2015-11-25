/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

+function ($) {
  'use strict';

  /* ========================================================================
  * Browse Media
  * ======================================================================== */

  $.fn.browseMedia = function(options) {
    var options = $.extend({
      date: '',
      start: 0,
      filter: true
    }, options)

    var request = {
      'option': 'com_sppagebuilder',
      'task': 'media.browse',
      'start': options.start,
      'date': options.date
    }

    $.ajax({
      type   : 'POST',
      data   : request,
      beforeSend: function() {
        $('#sppb-media-modal .btn-loadmore').hide()
        $('#sppb-media-modal .sppb-media-images').remove()
        $('#sppb-media-modal .sppb-media-modal-body').prepend($('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>'))
      },
      success: function (response) {
        $('#sppb-media-modal .spinner').remove();
        try {
          var data = $.parseJSON(response)
          if(data.loadmore) {
            $('#sppb-media-modal .btn-loadmore').removeAttr('style')
          } else {
            $('#sppb-media-modal .btn-loadmore').hide();
          }
          $('#sppb-media-modal .sppb-media-modal-body').prepend(data.output)
          if(options.filter) {
            $('#sppb-media-modal .sppb-media-modal-filter').html(data.date_filter)
          }
        } catch (e) {
          $('#sppb-media-modal .sppb-media-modal-body').html(response)
        }
      }
    })
  }


  /* ========================================================================
  * Browse Folders
  * ======================================================================== */

  $.fn.browseFolders = function(options) {

    var options = $.extend({
      path: '/images',
      filter: true
    }, options);

    return this.each(function() {
      var request = {
        'option' : 'com_sppagebuilder',
        'task' : 'media.folders',
        'path' : options.path
      };

      $.ajax({
        type   : 'POST',
        data   : request,

        beforeSend: function() {
          if(!options.filter) {
            $('#sppb-media-modal .folder-filter').val( options.path )
          }
          $('#sppb-media-modal .btn-loadmore').hide()
          $('#sppb-media-modal .sppb-media-images').remove()
          $('#sppb-media-modal .sppb-media-modal-body').prepend($('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>'))
        },

        success: function (response) {
          try {
            var data = $.parseJSON(response)
            $('#sppb-media-modal .spinner').remove()
            $('#sppb-media-modal .sppb-media-modal-body').prepend(data.output)

            if(options.filter) {
              $('#sppb-media-modal .sppb-media-modal-filter').html(data.folders_tree)
            }

          } catch (e) {
            $('#sppb-media-modal .sppb-media-modal-body').html(response)
          }
        }
      })
    })
  }

  
  // Media Modal
  // =======================

  $(document).on('click', '.sppb-btn-media', function(event){
    var $this = $(this)
    event.preventDefault()
    var modal_html = ''
    modal_html += '<div class="sppb-media-modal-overlay"></div>'
    modal_html += $('<div>').append($('.sppb-media-modal').clone().removeClass('sppb-media-modal').attr('id', 'sppb-media-modal').attr('data-target_id', $this.prev().attr('id'))).html()
    $(modal_html).hide().appendTo($('body')).fadeIn('fast')
    setTimeout(function(){
      $(this).browseMedia()
    }, 1000)
  })

  
  // Media Tab
  // =======================

  $(document).on('click', '#sppb-media-modal .tab-browse-media', function(event){
    event.preventDefault()
    $('#sppb-media-modal .tab-browse-folder').parent().removeClass('active')
    $(this).parent().addClass('active')
    setTimeout(function(){
      $(this).browseMedia()
    }, 300)
  })

  
  // Date Filter
  // =======================

  $(document).on('change', '#sppb-media-modal .date-filter', function(event){
    event.preventDefault()
    $(this).browseMedia({
      filter: false,
      date: $(this).val()
    })
  })

  
  /* ========================================================================
  * Load More
  * ======================================================================== */

  $(document).on('click', '#sppb-media-modal .btn-loadmore', function(event){
    event.preventDefault()
    var $this = $(this)

    var request = {
      'option' : 'com_sppagebuilder',
      'task' : 'media.browse',
      'date' : $('#sppb-media-modal .date-filter').val(),
      'start': $('#sppb-media-modal .sppb-media-images').find('>li').length 
    }

    $.ajax({
      type   : 'POST',
      data   : request,
      beforeSend: function() {
        $this.find('.fa').removeClass('fa-refresh').addClass('fa-spinner fa-spin')
      },
      success: function (response) {
        try {
          var data = $.parseJSON(response)
          if(data.loadmore) {
            $('#sppb-media-modal .btn-loadmore').removeAttr('style')
          } else {
            $('#sppb-media-modal .btn-loadmore').hide()
          }
          $this.find('.fa').removeClass('fa-spinner fa-spin').addClass('fa-refresh')
          $('#sppb-media-modal .sppb-media-images').append(data.output)
        } catch (e) {
          $('#sppb-media-modal .sppb-media-modal-body').html(response)
        }
      }
    })
  })

  // Close Modal Window
  // =======================

  $(document).on('click', '.sppb-media-modal-overlay, #sppb-media-modal .btn-close-modal', function(event){
    event.preventDefault()
    $('.sppb-media-modal-overlay, #sppb-media-modal').fadeOut(200, function(){
      $(this).remove()
    })
  })


  /* ========================================================================
  * File Upload
  * ======================================================================== */

  $(document).on('click', '#sppb-media-modal .btn-upload-file', function(event){
    event.preventDefault()
    $('#sppb-media-modal input[type="file"]').click()
  });

  $(document).on('change', '#sppb-media-modal input[type="file"]', function(event){
    event.preventDefault()
    var $this = $(this)
    var file = $(this).prop('files')[0]

    var data = new FormData()
    data.append('option', 'com_sppagebuilder')
    data.append('task', 'media.upload')

    if($('#sppb-media-modal .folder-filter').val() != undefined) {
      data.append('folder', $('#sppb-media-modal .folder-filter').val())
    }

    if (file.type.match(/image.*/)) {
      data.append('image', file)

      $.ajax({
        type: "POST",
        data:  data,
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function() {
          if($('#sppb-media-modal .sppb-media-folder').length) {
            $('#sppb-media-modal .sppb-media-folder').last().after($('<li class="sppb-image-loader"><div><div><div class="sppb-media-image"><i class="fa fa-spinner fa-pulse"></i></div></div></div></li>'))
          } else {
            $('#sppb-media-modal .sppb-media-images').prepend($('<li class="sppb-image-loader"><div><div><div class="sppb-media-image"><i class="fa fa-spinner fa-pulse"></i></div></div></div></li>'))
          }
          $('#sppb-media-modal .btn-upload-file').attr('disabled', 'disabled')
        },
        success: function(response)
        {
          try {
            var data = $.parseJSON(response)
            if(data.status) {
              $('#sppb-media-modal .sppb-media-images').find('.sppb-image-loader').remove()

              if($('#sppb-media-modal .sppb-media-folder').length) {
                $('#sppb-media-modal .sppb-media-folder').last().after(data.output)
              } else {
                $('#sppb-media-modal .sppb-media-images').prepend(data.output)
              }

              $('#sppb-media-modal .btn-upload-file').removeAttr('disabled')
            }
          } catch (e) {
            $('#sppb-media-modal .sppb-media-modal-body').html(response)
          }
        }         
      })
    }

    $this.val('')

  })

  
  // Select Media
  // =======================

  $(document).on('click', '#sppb-media-modal .btn-insert-media', function(event){
    event.preventDefault()
    var id = $('#sppb-media-modal').data('target_id'),
    $id = $('#' + id)
    $id.prev('.media-preview').find('img').attr('src', $(this).data('src'))
    $id.val($(this).data('path'))
    $('.sppb-media-modal-overlay, #sppb-media-modal').fadeOut(200, function(){
      $(this).remove()
    })
  })

  
  /* ========================================================================
  * Remove File
  * ======================================================================== */

  $(document).on('click', '#sppb-media-modal .remove-media-item', function(event) {
    event.preventDefault()
    var $this = $(this)
    var $parent = $this.closest('li')

    if (confirm("You are about to permanently delete this item. 'Cancel' to stop, 'OK' to delete.") == true) {
      var request = {
        'option' : 'com_sppagebuilder',
        'task' : 'media.delete',
        'id' : $this.data('id')
      };

      $.ajax({
        type: "POST",
        data   : request,
        success: function(response)
        {

          try {
            var data = $.parseJSON(response)
            if(data.status) {
              $parent.remove()
            } else {
              alert(data.output)
            }
          } catch (e) {
            $('#sppb-media-modal .sppb-media-modal-body').html(response)
          }
        }
      })
    }
  })

  
  // Select Media
  // =======================

  $(document).on('click', '#sppb-media-modal .tab-browse-folder', function(event){
    event.preventDefault()
    $('#sppb-media-modal .tab-browse-media').parent().removeClass('active')
    $(this).parent().addClass('active')

    setTimeout(function(){
      $(this).browseFolders()
    }, 300)
  })

  $(document).on('click', '#sppb-media-modal .to-folder', function(event){
    event.preventDefault()
    $('#sppb-media-modal .sppb-media-images').find('>li').removeClass('folder-selected')
    $(this).closest('li').addClass('folder-selected')
  })

  $(document).on('dblclick', '#sppb-media-modal .to-folder', function(event){
    event.preventDefault()
    $(this).browseFolders({
      filter: false,
      path: $(this).data('path')
    })
  })

  $(document).on('click', '#sppb-media-modal .to-folder-back', function(event){
    event.preventDefault()
    $(this).browseFolders({
      filter: false,
      path: $(this).data('path')
    })
  })

  $(document).on('change', '#sppb-media-modal .folder-filter', function(event){
    event.preventDefault()
    $(this).browseFolders({
      filter: false,
      path: $(this).val()
    })
  })


  /* ========================================================================
  * Drag & Drop Upload
  * ======================================================================== */

  $(document).on('dragenter', '#sppb-media-modal .sppb-media-modal-body', function (event){
    event.preventDefault()
    $(this).addClass('dragdrop')
  })

  $(document).on('mouseleave', '#sppb-media-modal .sppb-media-modal-body', function (event){
    event.preventDefault()
    $(this).removeClass('dragdrop')
  })

  $(document).on('dragover', '#sppb-media-modal .sppb-media-modal-body', function (event){
    event.preventDefault()
  })

  $(document).on('drop', '#sppb-media-modal .sppb-media-modal-body', function (event){
    event.preventDefault()
    $(this).removeClass('dragdrop')
    var image = event.originalEvent.dataTransfer.files

    var data = new FormData()
    data.append('option', 'com_sppagebuilder')
    data.append('task', 'media.upload')

    if($('#sppb-media-modal .folder-filter').val() != undefined) {
      data.append('folder', $('#sppb-media-modal .folder-filter').val())
    }

    if (image[0].type.match(/image.*/)) {
      data.append('image', image[0])

      $.ajax({
        type: "POST",
        data:  data,
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function() {
          if($('#sppb-media-modal .sppb-media-folder').length) {
            $('#sppb-media-modal .sppb-media-folder').last().after($('<li class="sppb-image-loader"><div><div><div class="sppb-media-image"><i class="fa fa-spinner fa-pulse"></i></div></div></div></li>'))
          } else {
            $('#sppb-media-modal .sppb-media-images').prepend($('<li class="sppb-image-loader"><div><div><div class="sppb-media-image"><i class="fa fa-spinner fa-pulse"></i></div></div></div></li>'))
          }
          $('#sppb-media-modal .btn-upload-file').attr('disabled', 'disabled')
        },
        success: function(response)
        {
          try {
            var data = $.parseJSON(response)
            if(data.status) {
              $('#sppb-media-modal .sppb-media-images').find('.sppb-image-loader').remove()

              if($('#sppb-media-modal .sppb-media-folder').length) {
                $('#sppb-media-modal .sppb-media-folder').last().after(data.output)
              } else {
                $('#sppb-media-modal .sppb-media-images').prepend(data.output)
              }

              $('#sppb-media-modal .btn-upload-file').removeAttr('disabled')
            }
          } catch (e) {
            $('#sppb-media-modal .sppb-media-modal-body').html(response)
          }
        }          
      })
    }
  })

}(jQuery);