/**
 * HD GAVI Portfolio — Admin Gallery Uploader
 * Media library integration + drag & drop reorder for project screenshots.
 */
(function ($) {
  'use strict';

  $(function () {
    // ── Sync grid → hidden textarea ──
    function syncGallery(key) {
      var grid = $('#hdgavi-gallery-grid-' + key);
      var urls = [];
      grid.find('.hdgavi-gallery-item').each(function () {
        urls.push($(this).data('url'));
      });
      $('#hdgavi-gallery-data-' + key).val(urls.join('\n'));
    }

    // ── Add item to grid ──
    function addToGrid(key, url) {
      var grid = $('#hdgavi-gallery-grid-' + key);
      var item = $(
        '<div class="hdgavi-gallery-item" data-url="' + url + '">' +
        '<img src="' + url + '" alt="">' +
        '<button type="button" class="hdgavi-gallery-remove" title="Remove">&times;</button>' +
        '</div>'
      );
      grid.append(item);
      syncGallery(key);
    }

    // ── Media Library button ──
    $(document).on('click', '.hdgavi-gallery-add', function (e) {
      e.preventDefault();
      var key = $(this).data('key');

      var frame = wp.media({
        title: 'Select Screenshots',
        button: { text: 'Add to Gallery' },
        multiple: true,
        library: { type: 'image' }
      });

      frame.on('select', function () {
        var selection = frame.state().get('selection');
        selection.each(function (attachment) {
          var url = attachment.attributes.url;
          // Prefer medium_large or large if available
          if (attachment.attributes.sizes) {
            if (attachment.attributes.sizes.medium_large) {
              url = attachment.attributes.sizes.medium_large.url;
            } else if (attachment.attributes.sizes.large) {
              url = attachment.attributes.sizes.large.url;
            }
          }
          addToGrid(key, url);
        });
      });

      frame.open();
    });

    // ── Add URL button ──
    $(document).on('click', '.hdgavi-gallery-add-url', function (e) {
      e.preventDefault();
      var key = $(this).data('key');
      var url = prompt('Enter image URL:');
      if (url && url.trim()) {
        addToGrid(key, url.trim());
      }
    });

    // ── Remove button ──
    $(document).on('click', '.hdgavi-gallery-remove', function (e) {
      e.preventDefault();
      e.stopPropagation();
      var item = $(this).closest('.hdgavi-gallery-item');
      var key = item.closest('.hdgavi-gallery-field').find('.hdgavi-gallery-add').data('key');
      item.fadeOut(200, function () {
        item.remove();
        syncGallery(key);
      });
    });

    // ── Drag & Drop reorder ──
    $('.hdgavi-gallery-grid').sortable({
      items: '.hdgavi-gallery-item',
      cursor: 'grabbing',
      tolerance: 'pointer',
      placeholder: 'hdgavi-gallery-placeholder',
      forcePlaceholderSize: true,
      update: function () {
        var key = $(this).closest('.hdgavi-gallery-field').find('.hdgavi-gallery-add').data('key');
        syncGallery(key);
      }
    });
  });
})(jQuery);
