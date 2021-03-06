/*! MetaMorph - v1.0.0 - 09-09-2014
 * http://themesidea.co.uk/
 * Copyright (c) 2014
 * metamorph_layouts = [];
 * metamorph_current_layout;
 */
var metamorph_current_section = '';
var metamorph_current_region = '';
var metamorph_current_layout = 0;
var metamorph_default_layout = {
  'key': 'new_layout',
  'title': 'New layout',
  'sections': [],
  'weight': 100
};
var metamorph_default_section = {
  'layout': 0,
  'regions': [],
  'weight': 100
};
var metamorph_default_region = {
  'weight': 100
}
var keyString = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
base64Encode = function (c) {
  var a = "";
  var k, h, f, j, g, e, d;
  var b = 0;
  c = UTF8Encode(c);
  while (b < c.length) {
    k = c.charCodeAt(b++);
    h = c.charCodeAt(b++);
    f = c.charCodeAt(b++);
    j = k >> 2;
    g = ((k & 3) << 4) | (h >> 4);
    e = ((h & 15) << 2) | (f >> 6);
    d = f & 63;
    if (isNaN(h)) {
      e = d = 64
    } else {
      if (isNaN(f)) {
        d = 64
      }
    }
    a = a + keyString.charAt(j) + keyString.charAt(g) + keyString.charAt(e) + keyString.charAt(d)
  }
  return a
};
UTF8Encode = function (b) {
  b = b.replace(/\x0d\x0a/g, "\x0a");
  var a = "";
  for (var e = 0; e < b.length; e++) {
    var d = b.charCodeAt(e);
    if (d < 128) {
      a += String.fromCharCode(d)
    } else {
      if ((d > 127) && (d < 2048)) {
        a += String.fromCharCode((d >> 6) | 192);
        a += String.fromCharCode((d & 63) | 128)
      } else {
        a += String.fromCharCode((d >> 12) | 224);
        a += String.fromCharCode(((d >> 6) & 63) | 128);
        a += String.fromCharCode((d & 63) | 128)
      }
    }
  }
  return a
};
(function ($) {
  /*
   ** add region object to html list
   */
  function regionToHtml(region) {
    region.colxs = region.colxs || 12;
    region.colsm = region.colsm || 12;
    region.colmd = region.colmd || region.size || 6;
    region.collg = region.collg || region.size || 6;
    return $('<li>').data({
      key: region.key,
      title: region.title,
      colxs: region.colxs,
      colsm: region.colsm,
      colmd: region.colmd,
      collg: region.collg
    }).addClass('metamorph-region').addClass('col-xs-' + region.colxs).addClass('col-sm-' + region.colsm).addClass('col-md-' + region.colmd).addClass('col-lg-' + region.collg).html('<div class="region-inner"><i class="fa fa-arrows-alt region-sortable"></i>' + region.title + '<i class="fa fa-wrench region-settings pull-right"></i></div>');
  }

  function sectionToHtml(section) {
    var $section = $('<li>').addClass('metamorph-section section-' + section.key).data({
      key: section.key,
      title: section.title,
      fullwidth: section.fullwidth || 'no',
      backgroundcolor: section.backgroundcolor || '',
      sticky: section.sticky || false,
      vphone: section.vphone || false,
      vtablet: section.vtablet || false,
      vdesktop: section.vdesktop || false,
      hphone: section.hphone || false,
      htablet: section.htablet || false,
      hdesktop: section.hdesktop || false,
      colpadding: section.colpadding || '',
      custom_class: section.custom_class || ''
    });
    if (section.backgroundcolor != '') {
      $section.css({
        backgroundColor: section.backgroundcolor
      });
    }
    if (section.key != 'unassigned') {
      var $sectionHeader = $('<div class="metamorph-section-header"><i class="fa fa-arrows-alt section-sortable"></i><span class="section_title">' + section.title + '</span><i class="fa fa-wrench section-settings pull-right"></i></div>');
    } else {
      var $sectionHeader = $('<div class="metamorph-section-header"><span class="section_title">' + section.title + '</span></div>');
    }
    var $sectionContent = $('<ul id="section-' + section.key + '">').addClass('metamorph-section-inner row');
    $section.append($sectionHeader).append($sectionContent);
    $(section.regions).each(function () {
      var region = regionToHtml(this);
      $sectionContent.append(region);
    });
    return $section;
  }

  function metamorph_loadLayouts() {
    $('ul#metamorph_layouts li').remove();
    $(metamorph_layouts).each(function (index) {
      var layoutTab = $('<li>').addClass('metamorph_layout');
      var layoutTitle = $('<a href="#">').text(this.title).click(function () {
        metamorph_saveLayout(metamorph_current_layout);
        metamorph_loadLayout(index);
        $('li.metamorph_layout').removeClass('active');
        $(this).parent().addClass('active');
        return false;
      });
      layoutTab.append(layoutTitle);
      var copyLayout = $('<span title="Duplicate this layout" class="fa fa-copy"></span>').css({
        color: '#0074BD',
        cursor: 'pointer',
        marginRight: '5px'
      });
      copyLayout.click(function () {
        metamorph_saveLayout(metamorph_current_layout);
        metamorph_copy_layout(metamorph_layouts[index]);
        metamorph_current_layout = 0;
        metamorph_loadLayouts();
        metamorph_loadLayout(0);
        $('li.metamorph_layout:first').addClass('active');
      })
      layoutTab.append(copyLayout);
      if (this.key != 'default') {
        var editLayout = $('<span title="Rename this layout" class="layout-settings fa fa-edit"></span>').css({
          color: '#0074BD',
          cursor: 'pointer',
          marginRight: '5px'
        });
        editLayout.click(function () {
          $('input[name=layout_name]').val(metamorph_layouts[metamorph_current_layout].title);
          $('#edit-metamorph-layouts-edit').dialog('open');
        });
        layoutTab.append(editLayout);
        var layoutRemove = $('<span title="Remove this layout" class="fa fa-trash-o"></span>').css({
          color: '#FF0000',
          cursor: 'pointer',
          marginRight: '5px'
        }).click(function () {
          if (confirm('Are you sure you want to remove this layout?')) {
            metamorph_layouts.splice(index, 1);
            metamorph_current_layout = 0;
            metamorph_loadLayouts();
            metamorph_loadLayout(0);
            $('li.metamorph_layout:first').addClass('active');
          }
        });
        layoutTab.append(layoutRemove);
      }

      $('ul#metamorph_layouts').append(layoutTab);
    })
  }

  function metamorph_loadLayout(layoutIndex) {
    metamorph_current_layout = layoutIndex;
    var layout = metamorph_layouts[layoutIndex];
    $('textarea[name=metamorph_layout_pages]').val(layout.pages || '');
    if (layoutIndex == 0) {
      $('.form-item-metamorph-layout-pages').hide();
    } else {
      $('.form-item-metamorph-layout-pages').show();
    }
    /*Load sections*/
    $('#metamorph_sections').find('li').remove();
    $(layout.sections).each(function () {
      var $section = sectionToHtml(this);
      $('#metamorph_sections').append($section);
    });
    metamorph_sections_sortable();
    metamorph_regions_sortable();
    $('.region-settings').click(function () {
      metamorph_current_region = $(this).parents('li.metamorph-region');
      $('select[name=region_col_xs]').val(metamorph_current_region.data('colxs'));
      $('select[name=region_col_sm]').val(metamorph_current_region.data('colsm'));
      $('select[name=region_col_md]').val(metamorph_current_region.data('colmd'));
      $('select[name=region_col_lg]').val(metamorph_current_region.data('collg'));
      $('#edit-metamorph-region-settings').dialog('open');
    });
    $('.section-settings').click(function () {
      metamorph_current_section = $(this).parents('li.metamorph-section');
      $('input[name=section_title]').val(metamorph_current_section.data('title'));
      $('select[name=section_fullwidth]').val(metamorph_current_section.data('fullwidth'));
      $('input[name=section_background_color]').val(metamorph_current_section.data('backgroundcolor'));
      $('input[name=section_colpadding]').val(metamorph_current_section.data('colpadding'));
      $('input[name=section_custom_class]').val(metamorph_current_section.data('custom_class'));
      $('input[name=section_sticky]').attr('checked', metamorph_current_section.data('sticky'));
      $('input[name^=section_visible]').each(function () {
        $(this).attr('checked', metamorph_current_section.data($(this).val()));
      });
      $('#edit-metamorph-section-settings').dialog('open');
    });
  }

  function metamorph_copy_layout(layout) {
    var newLayout = {};
    $.extend(true, newLayout, layout);
    newLayout.title = 'copy of ' + newLayout.title;
    newLayout.key = metamorph_title_to_key(newLayout.title);
    metamorph_layouts[metamorph_layouts.length] = newLayout;
  }

  function metamorph_add_section(title, key) {
    if (key == null) {
      key = metamorph_title_to_key(title);
    }
    var section = $('<li>').addClass('metamorph-section').attr({
      'data-key': key,
      'data-title': title,
      'data-fullwidth': 'no'
    });
    var sectionHeader = $('<div class="metamorph-section-header"><i class="fa fa-arrows-alt section-sortable"></i>' + title + '</div>');
    var sectionContent = $('<ul>').addClass('metamorph-section-inner row');
    section.append(sectionHeader).append(sectionContent);
    $('#metamorph_sections').append(section);
  }

  function metamorph_title_to_key(title) {
    return title.replace(/[^a-z0-9]/g, function (s) {
      var c = s.charCodeAt(0);
      if (c == 32) return '-';
      if (c >= 65 && c <= 90) return s.toLowerCase();
      return '__' + ('000' + c.toString(16)).slice(-4);
    });
  };

  function metamorph_valid_section(name) {
    return true;
  }

  function metamorph_sections_sortable() {
    $('#metamorph_sections').sortable({
      handle: '.section-sortable',
      cancel: '.section-unassigned',
      stop: function () {
        metamorph_saveLayout(metamorph_current_layout);
      }
    });
  }

  function metamorph_regions_sortable() {
    $('.metamorph-section-inner').sortable({
      handle: '.region-sortable',
      connectWith: '.metamorph-section-inner'
    });
  }

  function metamorph_saveLayout(layoutIndex) {
    var layout = {
      key: metamorph_layouts[layoutIndex].key,
      title: metamorph_layouts[layoutIndex].title,
      sections: [],
      pages: $('textarea[name=metamorph_layout_pages]').val()
    };
    $('#metamorph_sections li.metamorph-section').each(function (index) {
      var section = {
        key: $(this).data('key'),
        title: $(this).data('title'),
        weight: index,
        fullwidth: $(this).data('fullwidth'),
        backgroundcolor: $(this).data('backgroundcolor'),
        sticky: $(this).data('sticky'),
        vphone: $(this).data('vphone'),
        vtablet: $(this).data('vtablet'),
        vdesktop: $(this).data('vdesktop'),
        hphone: $(this).data('hphone'),
        htablet: $(this).data('htablet'),
        hdesktop: $(this).data('hdesktop'),
        colpadding: $(this).data('colpadding'),
        custom_class: $(this).data('custom_class'),
        regions: []
      };
      $(this).find('.metamorph-region').each(function (index) {
        var region = {
          key: $(this).data('key'),
          title: $(this).data('title'),
          weight: index,
          colxs: $(this).data('colxs'),
          colsm: $(this).data('colsm'),
          colmd: $(this).data('colmd'),
          collg: $(this).data('collg')
        };
        section.regions[index] = region;
      });
      layout.sections[index] = section;
    });
    metamorph_layouts[layoutIndex] = layout;
  }
  $(document).ready(function () {
    if (parseFloat(jQuery.fn.jquery) < 1.7) {
      alert('You are using jQuery ' + jQuery.fn.jquery + '. Please upgrade to jquery ui 1.7.x or higher!');
    }
    metamorph_loadLayouts();
    metamorph_loadLayout(0);
    $('li.metamorph_layout:first').addClass('active');
    $('#edit-metamorph-layouts-edit').dialog({
      autoOpen: false,
      modal: true,
      title: 'Layout settings',
      buttons: {
        Save: function () {
          var title = $.trim($('input[name=layout_name]').val());
          if (title == '' || title == 'Default') {
            alert('The title invalid.');
            return;
          }
          metamorph_layouts[metamorph_current_layout].title = title;
          metamorph_layouts[metamorph_current_layout].key = metamorph_title_to_key(title);
          $('.metamorph_layout.active a').text(title);
          $(this).dialog('close');
        },
        Cancel: function () {
          $(this).dialog('close');
        }
      }
    });

    $('#edit-metamorph-section-settings').dialog({
      autoOpen: false,
      modal: true,
      title: 'Section settings',
      width: 500,
      buttons: {
        Apply: function () {
          metamorph_current_section.find('.section_title').text($('input[name=section_title]').val());
          metamorph_current_section.data({
            title: $('input[name=section_title]').val(),
            fullwidth: $('select[name=section_fullwidth]').val(),
            backgroundcolor: $('input[name=section_background_color]').val(),
            sticky: $('input[name=section_sticky]').prop('checked'),
            vphone: false,
            vtablet: false,
            vdesktop: false,
            hphone: false,
            htablet: false,
            hdesktop: false,
            colpadding: $('input[name=section_colpadding]').val(),
            custom_class: $('input[name=section_custom_class]').val()
          });
          $('input[name^=section_visible]:checked').each(function () {
            metamorph_current_section.data($(this).val(), true);
          });
          $(this).dialog("close");
        },
        'Remove section': function () {
          if (confirm('Are you sure you want to remove this section?')) {
            $(metamorph_current_section).find('.metamorph-region').each(function () {
              $('ul#section-unassigned').append($(this));
            });
            metamorph_current_section.remove();
            $(this).dialog("close");
          }
        },
        Cancel: function () {
          $(this).dialog("close");
        }
      }
    });

    $('#edit-metamorph-region-settings').dialog({
      autoOpen: false,
      modal: true,
      title: 'Region settings',
      width: 500,
      closeText: 'colose',
      buttons: {
        Apply: function () {
          metamorph_current_region.removeClass('col-xs-1 col-xs-2 col-xs-3 col-xs-4 col-xs-5 col-xs-6 col-xs-7 col-xs-8 col-xs-9 col-xs-10 col-xs-11 col-xs-12');
          metamorph_current_region.addClass('col-xs-' + $('select[name=region_col_xs]').val());
          metamorph_current_region.data('colxs', $('select[name=region_col_xs]').val());

          metamorph_current_region.removeClass('col-sm-1 col-sm-2 col-sm-3 col-sm-4 col-sm-5 col-sm-6 col-sm-7 col-sm-8 col-sm-9 col-sm-10 col-sm-11 col-sm-12');
          metamorph_current_region.addClass('col-sm-' + $('select[name=region_col_sm]').val());
          metamorph_current_region.data('colsm', $('select[name=region_col_sm]').val());

          metamorph_current_region.removeClass('col-md-1 col-md-2 col-md-3 col-md-4 col-md-5 col-md-6 col-md-7 col-md-8 col-md-9 col-md-10 col-md-11 col-md-12');
          metamorph_current_region.addClass('col-md-' + $('select[name=region_col_md]').val());
          metamorph_current_region.data('colmd', $('select[name=region_col_md]').val());

          metamorph_current_region.removeClass('col-lg-1 col-lg-2 col-lg-3 col-lg-4 col-lg-5 col-lg-6 col-lg-7 col-lg-8 col-lg-9 col-lg-10 col-lg-11 col-lg-12');
          metamorph_current_region.addClass('col-lg-' + $('select[name=region_col_lg]').val());
          metamorph_current_region.data('collg', $('select[name=region_col_lg]').val());
          $(this).dialog("close");
        },
        Cancel: function () {
          $(this).dialog("close");
        }
      }
    });

    $('a.metamorph-add-layout').click(function () {
      metamorph_saveLayout(metamorph_current_layout);
      metamorph_copy_layout(metamorph_layouts[0]);
      metamorph_current_layout = 0;
      metamorph_loadLayouts();
      metamorph_loadLayout(0);
      $('li.metamorph_layout:first').addClass('active');
    });
    $('#metamorph_add_section a').click(function () {
      $('#metamorph_add_section_dialog').dialog('open');
      return false;
    })
    $('#metamorph_add_section_dialog').dialog({
      autoOpen: false,
      modal: true,
      buttons: {
        Add: function () {
          var newSection = $('input[name=section_name]').val();
          if (metamorph_valid_section(newSection)) {
            metamorph_add_section(newSection);
            metamorph_sections_sortable();
            metamorph_regions_sortable();
            $(this).dialog("close");
          } else {
            alert('The section name is invalid or already exists.');
          }
        },
        Cancel: function () {
          $(this).dialog("close");
        }
      }
    });
    $('form#system-theme-settings').submit(function () {
      metamorph_saveLayout(metamorph_current_layout);
      var layoutsstr = base64Encode(JSON.stringify(metamorph_layouts));
      $('input[name=metamorph_layouts]').val(layoutsstr);
      return true;
    });
    //Format form
    $('#edit-cols .form-item').addClass('col-md-3');
    $('#edit-section-visible').addClass('.row').find('.form-item').addClass('col-md-4');
  })
})(jQuery);
