jQuery( document ).ready( function( $ ) {

	// Have Faceted Search filter already open upon loading the Ideas page
	$( '.blog .emc-faceted-search' ).addClass( 'emc-toggle-open' );

	// Small menu for screen sizes under 480px wide
	$( '.emc-menu-button' ).click( function() {
		$( '.small-navigation' ).slideToggle();
	})

	// Expanding search field for screen sizes under 450px wide
	$( '.emc-search-button' ).click( function() {
		$( '.emc-small-search' ).slideToggle();
	})

	// Expanding "View your projects" section for logged-in users
	$( '.emc-welcome-title .emc-toggle-link' ).click( function() {
		$( '.emc-projects' ).slideToggle( function() {
			$( this ).parent().find( '.emc-welcome-title .emc-toggle-link' ).toggleClass( 'emc-toggle-open' );
		});
	})

	// Expanding project contact list for logged-in users
	$( '.emc-contact-link' ).click( function() {
		$( this ).parent().find( '.emc-contacts' ).slideToggle( function() {
			$( this ).parent().find( '.emc-toggle-link' ).toggleClass( 'emc-toggle-open' );
		});

	})

	// JS hacks to re-arrange and style the MailChimp form
	$( '.widget_mailchimpsf_widget #mc_mv_EMAIL' ).parent().appendTo( '.mc_form_inside' );
	$( '#mc_mv_EMAIL' ).attr( 'placeholder', 'Email' );
	$( '#mc_message' ).appendTo( '.mc_form_inside' );

	$( '.emc-toggle-link' ).each( function() {
		$(this).click(function() {
			$( this ).parent().find( '.readmore-content' ).slideToggle( function() {
				$( this ).parent().find( '.emc-toggle-link' ).toggleClass( 'emc-toggle-open' );
			});
		});
	})

	// Have Faceted Search filter already open upon loading the Ideas page
	$( '.page-template-page-ideas .emc-faceted-search' ).addClass( 'emc-toggle-open' );
	// Collapse results filter below certain width
	if ($(window).width() <= 680) {
    $('.page-template-page-ideas .emc-faceted-search').removeClass('emc-toggle-open');
  } else {
    $('.page-template-page-ideas .emc-faceted-search').addClass('emc-toggle-open');
  }


  // Have Faceted Search filter already open upon loading the Modules page
  $( '.single-module .emc-faceted-search' ).addClass( 'emc-toggle-open' );
  // Collapse results filter below certain width
  if ($(window).width() <= 680) {
    $('.single-module .emc-faceted-search').removeClass('emc-toggle-open');
  } else {
    $('.single-module .emc-faceted-search').addClass('emc-toggle-open');
  }

    // Have Faceted Search filter already open upon loading the Modules page
  $( '.page-template-page-early-math-library .emc-faceted-search' ).addClass( 'emc-toggle-open' );
  // Collapse results filter below certain width
  if ($(window).width() <= 680) {
    $('.page-template-page-early-math-library .emc-faceted-search').removeClass('emc-toggle-open');
  } else {
    $('.page-template-page-early-math-library .emc-faceted-search').addClass('emc-toggle-open');
  }

  // Accordion toggle
  $('.accordion-toggle').each(function() {
  if($(this).has('.mod-section-icon-lock').length > 0) {
    $(this).find('.mod-section-icon').css('display','none');
    $(this).addClass('mod-locked');
  }});
  //$('.accordion').find('.accordion-toggle').first().addClass('active');
  //$('.accordion').find('.accordion-toggle .icon-arrow-right').first().addClass('icon-visually-hidden');
  //$('.accordion').find('.accordion-toggle .icon-arrow-down').first().addClass('icon-visible');
  $('.accordion').find('.accordion-toggle:not(.mod-locked)').click(function(){
    //Expand or collapse this panel
    $(this).toggleClass('active');
    $(this).next().slideToggle('fast');
    $(this).find('.accordion-arrows').children('.icon-arrow-down').toggleClass('icon-visible');
    $(this).find('.accordion-arrows').children('.icon-arrow-right').toggleClass('icon-visually-hidden');
  });


  $('.accordion .accordion-toggle').first().addClass('first');
  $('.accordion .accordion-content').first().addClass('first');
  $('.accordion .accordion-toggle').last().addClass('last');
  $('.accordion .accordion-content').last().addClass('last');  


  // Submenu Accordion toggle
  $('.submenu-accordion').find('.submenu-accordion-toggle').click(function(){
    //Expand or collapse this panel
    $(this).toggleClass('active');
    $(this).next().slideToggle('fast');
    $(this).children('.icon-arrow-down').toggleClass('icon-visible');
    $(this).children('.icon-arrow-right').toggleClass('icon-visually-hidden');
  });


  $('.submenu-accordion .submenu-accordion-toggle').first().addClass('first');
  $('.submenu-accordion .submenu-accordion-content').first().addClass('first');
  $('.submenu-accordion .submenu-accordion-toggle').last().addClass('last');
  $('.submenu-accordion .submenu-accordion-content').last().addClass('last'); 


  // Click image to show video functionality
  $('.videocover').click(function () {
    var video = $(this).closest('.video-container').find('video')[0];
    video.play();

    $(this).css('visibility', 'hidden');
    return false;
  });

  // Add 'last_column' class

  // Append fadeout class to "Related Posts" on module pages
  $('<div class="fadeout">').appendTo('.primary-module .facetwp-template .type-post');

  // Copy info from one Gravity Form field to another
  $('input#choice_3_131_1').click(function() {
    if($(this).is(':checked')) {
      $('#input_3_23_1').val($('#input_3_9_1').val());
      $('#input_3_23_2').val($('#input_3_9_2').val());
      $('#input_3_23_3').val($('#input_3_9_3').val());
      $('#input_3_23_4').val($('#input_3_9_4').val());
      $('#input_3_23_5').val($('#input_3_9_5').val());
      $('#input_3_23_6').val($('#input_3_9_6').val());
    };
  });

  $('input#choice_3_132_1').click(function() {
    if($(this).is(':checked')) {
      $('#input_3_36_1').val($('#input_3_9_1').val());
      $('#input_3_36_2').val($('#input_3_9_2').val());
      $('#input_3_36_3').val($('#input_3_9_3').val());
      $('#input_3_36_4').val($('#input_3_9_4').val());
      $('#input_3_36_5').val($('#input_3_9_5').val());
      $('#input_3_36_6').val($('#input_3_9_6').val());
    };
  });

  $('input#choice_3_133_1').click(function() {
    if($(this).is(':checked')) {
      $('#input_3_49_1').val($('#input_3_9_1').val());
      $('#input_3_49_2').val($('#input_3_9_2').val());
      $('#input_3_49_3').val($('#input_3_9_3').val());
      $('#input_3_49_4').val($('#input_3_9_4').val());
      $('#input_3_49_5').val($('#input_3_9_5').val());
      $('#input_3_49_6').val($('#input_3_9_6').val());
    };
  });

  $('input#choice_3_134_1').click(function() {
    if($(this).is(':checked')) {
      $('#input_3_59_1').val($('#input_3_9_1').val());
      $('#input_3_59_2').val($('#input_3_9_2').val());
      $('#input_3_59_3').val($('#input_3_9_3').val());
      $('#input_3_59_4').val($('#input_3_9_4').val());
      $('#input_3_59_5').val($('#input_3_9_5').val());
      $('#input_3_59_6').val($('#input_3_9_6').val());
    };
  });

  $('input#choice_3_135_1').click(function() {
    if($(this).is(':checked')) {
      $('#input_3_71_1').val($('#input_3_9_1').val());
      $('#input_3_71_2').val($('#input_3_9_2').val());
      $('#input_3_71_3').val($('#input_3_9_3').val());
      $('#input_3_71_4').val($('#input_3_9_4').val());
      $('#input_3_71_5').val($('#input_3_9_5').val());
      $('#input_3_71_6').val($('#input_3_9_6').val());
    };
  });

   $('input#choice_3_136_1').click(function() {
    if($(this).is(':checked')) {
      $('#input_3_81_1').val($('#input_3_9_1').val());
      $('#input_3_81_2').val($('#input_3_9_2').val());
      $('#input_3_81_3').val($('#input_3_9_3').val());
      $('#input_3_81_4').val($('#input_3_9_4').val());
      $('#input_3_81_5').val($('#input_3_9_5').val());
      $('#input_3_81_6').val($('#input_3_9_6').val());
    };
  });

   $('input#choice_3_137_1').click(function() {
    if($(this).is(':checked')) {
      $('#input_3_94_1').val($('#input_3_9_1').val());
      $('#input_3_94_2').val($('#input_3_9_2').val());
      $('#input_3_94_3').val($('#input_3_9_3').val());
      $('#input_3_94_4').val($('#input_3_9_4').val());
      $('#input_3_94_5').val($('#input_3_9_5').val());
      $('#input_3_94_6').val($('#input_3_9_6').val());
    };
  });

   $('input#choice_3_138_1').click(function() {
    if($(this).is(':checked')) {
      $('#input_3_123').val($('#input_3_124').val());
    };
  });

   $('input#choice_3_138_1').click(function() {
    if($(this).is(':checked')) {
      $('#input_3_124').val($('#input_3_124').val());
    };
  });

  $('input#choice_3_139_1').click(function() {
    if($(this).is(':checked')) {
      $('#input_3_125').val($('#input_3_124').val());
    };
  });

  $('input#choice_3_140_1').click(function() {
    if($(this).is(':checked')) {
      $('#input_3_126').val($('#input_3_124').val());
    };
  });

  $('input#choice_3_141_1').click(function() {
    if($(this).is(':checked')) {
      $('#input_3_127').val($('#input_3_124').val());
    };
  });

  $('input#choice_3_142_1').click(function() {
    if($(this).is(':checked')) {
      $('#input_3_128').val($('#input_3_124').val());
    };
  });

  $('input#choice_3_143_1').click(function() {
    if($(this).is(':checked')) {
      $('#input_3_129').val($('#input_3_124').val());
    };
  });

  $('input#choice_3_144_1').click(function() {
    if($(this).is(':checked')) {
      $('#input_3_130').val($('#input_3_124').val());
    };
  });



});
    

jQuery(document).on('facetwp-loaded', function() {
	jQuery(document.body).trigger('post-load');
	jQuery('.hentry').show();
});


// Force FacetWP to refresh on page interaction
// More info here: https://facetwp.com/how-to-disable-facet-auto-refresh/
/*
jQuery(function() {
    FWP.auto_refresh = true;
});
*/

// Scroll to top after clicking FacetWP pagination links.
// Links previously sent user to the middle of the page.
// More info here: https://facetwp.com/how-to-add-pagination-scrolling/ 
jQuery(document).on('facetwp-loaded', function() {
    jQuery('html, body').animate({
        scrollTop: jQuery('body').offset().top
    }, 0);
});

// Hide old version of media player while page loads, then show it on pageload
jQuery('.audio-intro').hide(); 
jQuery(document).ready(function() { 
  jQuery('.audio-intro').hide(); 
});

// Tipso Bubble Script
!function(t){"function"==typeof define&&define.amd?define(["jquery"],t):"object"==typeof exports?module.exports=t(require("jquery")):t(jQuery)}(function(t){function o(o,e){this.element=t(o),this.doc=t(document),this.win=t(window),this.settings=t.extend({},n,e),"object"==typeof this.element.data("tipso")&&t.extend(this.settings,this.element.data("tipso"));for(var r=Object.keys(this.element.data()),s={},d=0;d<r.length;d++){var l=r[d].replace(i,"");if(""!==l){l=l.charAt(0).toLowerCase()+l.slice(1),s[l]=this.element.data(r[d]);for(var p in this.settings)p.toLowerCase()==l&&(this.settings[p]=s[l])}}this._defaults=n,this._name=i,this._title=this.element.attr("title"),this.mode="hide",this.ieFade=!a,this.settings.preferedPosition=this.settings.position,this.init()}function e(o){var e=o.clone();e.css("visibility","hidden"),t("body").append(e);var r=e.outerHeight(),s=e.outerWidth();return e.remove(),{width:s,height:r}}function r(t){t.removeClass("top_right_corner bottom_right_corner top_left_corner bottom_left_corner"),t.find(".tipso_title").removeClass("top_right_corner bottom_right_corner top_left_corner bottom_left_corner")}function s(o){var i,n,a,d=o.tooltip(),l=o.element,p=o,f=t(window),g=10,c=p.settings.background,h=p.titleContent();switch(void 0!==h&&""!==h&&(c=p.settings.titleBackground),l.parent().outerWidth()>f.outerWidth()&&(f=l.parent()),p.settings.position){case"top-right":n=l.offset().left+l.outerWidth(),i=l.offset().top-e(d).height-g,d.find(".tipso_arrow").css({marginLeft:-p.settings.arrowWidth,marginTop:""}),i<f.scrollTop()?(i=l.offset().top+l.outerHeight()+g,d.find(".tipso_arrow").css({"border-bottom-color":c,"border-top-color":"transparent","border-left-color":"transparent","border-right-color":"transparent"}),r(d),d.addClass("bottom_right_corner"),d.find(".tipso_title").addClass("bottom_right_corner"),d.find(".tipso_arrow").css({"border-left-color":c}),d.removeClass("top-right top bottom left right"),d.addClass("bottom")):(d.find(".tipso_arrow").css({"border-top-color":p.settings.background,"border-bottom-color":"transparent ","border-left-color":"transparent","border-right-color":"transparent"}),r(d),d.addClass("top_right_corner"),d.find(".tipso_arrow").css({"border-left-color":p.settings.background}),d.removeClass("top bottom left right"),d.addClass("top"));break;case"top-left":n=l.offset().left-e(d).width,i=l.offset().top-e(d).height-g,d.find(".tipso_arrow").css({marginLeft:-p.settings.arrowWidth,marginTop:""}),i<f.scrollTop()?(i=l.offset().top+l.outerHeight()+g,d.find(".tipso_arrow").css({"border-bottom-color":c,"border-top-color":"transparent","border-left-color":"transparent","border-right-color":"transparent"}),r(d),d.addClass("bottom_left_corner"),d.find(".tipso_title").addClass("bottom_left_corner"),d.find(".tipso_arrow").css({"border-right-color":c}),d.removeClass("top-right top bottom left right"),d.addClass("bottom")):(d.find(".tipso_arrow").css({"border-top-color":p.settings.background,"border-bottom-color":"transparent ","border-left-color":"transparent","border-right-color":"transparent"}),r(d),d.addClass("top_left_corner"),d.find(".tipso_arrow").css({"border-right-color":p.settings.background}),d.removeClass("top bottom left right"),d.addClass("top"));break;case"bottom-right":n=l.offset().left+l.outerWidth(),i=l.offset().top+l.outerHeight()+g,d.find(".tipso_arrow").css({marginLeft:-p.settings.arrowWidth,marginTop:""}),i+e(d).height>f.scrollTop()+f.outerHeight()?(i=l.offset().top-e(d).height-g,d.find(".tipso_arrow").css({"border-bottom-color":"transparent","border-top-color":p.settings.background,"border-left-color":"transparent","border-right-color":"transparent"}),r(d),d.addClass("top_right_corner"),d.find(".tipso_title").addClass("top_left_corner"),d.find(".tipso_arrow").css({"border-left-color":p.settings.background}),d.removeClass("top-right top bottom left right"),d.addClass("top")):(d.find(".tipso_arrow").css({"border-top-color":"transparent","border-bottom-color":c,"border-left-color":"transparent","border-right-color":"transparent"}),r(d),d.addClass("bottom_right_corner"),d.find(".tipso_title").addClass("bottom_right_corner"),d.find(".tipso_arrow").css({"border-left-color":c}),d.removeClass("top bottom left right"),d.addClass("bottom"));break;case"bottom-left":n=l.offset().left-e(d).width,i=l.offset().top+l.outerHeight()+g,d.find(".tipso_arrow").css({marginLeft:-p.settings.arrowWidth,marginTop:""}),i+e(d).height>f.scrollTop()+f.outerHeight()?(i=l.offset().top-e(d).height-g,d.find(".tipso_arrow").css({"border-bottom-color":"transparent","border-top-color":p.settings.background,"border-left-color":"transparent","border-right-color":"transparent"}),r(d),d.addClass("top_left_corner"),d.find(".tipso_title").addClass("top_left_corner"),d.find(".tipso_arrow").css({"border-right-color":p.settings.background}),d.removeClass("top-right top bottom left right"),d.addClass("top")):(d.find(".tipso_arrow").css({"border-top-color":"transparent","border-bottom-color":c,"border-left-color":"transparent","border-right-color":"transparent"}),r(d),d.addClass("bottom_left_corner"),d.find(".tipso_title").addClass("bottom_left_corner"),d.find(".tipso_arrow").css({"border-right-color":c}),d.removeClass("top bottom left right"),d.addClass("bottom"));break;case"top":n=l.offset().left+l.outerWidth()/2-e(d).width/2,i=l.offset().top-e(d).height-g,d.find(".tipso_arrow").css({marginLeft:-p.settings.arrowWidth,marginTop:""}),i<f.scrollTop()?(i=l.offset().top+l.outerHeight()+g,d.find(".tipso_arrow").css({"border-bottom-color":c,"border-top-color":"transparent","border-left-color":"transparent","border-right-color":"transparent"}),d.removeClass("top bottom left right"),d.addClass("bottom")):(d.find(".tipso_arrow").css({"border-top-color":p.settings.background,"border-bottom-color":"transparent","border-left-color":"transparent","border-right-color":"transparent"}),d.removeClass("top bottom left right"),d.addClass("top"));break;case"bottom":n=l.offset().left+l.outerWidth()/2-e(d).width/2,i=l.offset().top+l.outerHeight()+g,d.find(".tipso_arrow").css({marginLeft:-p.settings.arrowWidth,marginTop:""}),i+e(d).height>f.scrollTop()+f.outerHeight()?(i=l.offset().top-e(d).height-g,d.find(".tipso_arrow").css({"border-top-color":p.settings.background,"border-bottom-color":"transparent","border-left-color":"transparent","border-right-color":"transparent"}),d.removeClass("top bottom left right"),d.addClass("top")):(d.find(".tipso_arrow").css({"border-bottom-color":c,"border-top-color":"transparent","border-left-color":"transparent","border-right-color":"transparent"}),d.removeClass("top bottom left right"),d.addClass(p.settings.position));break;case"left":n=l.offset().left-e(d).width-g,i=l.offset().top+l.outerHeight()/2-e(d).height/2,d.find(".tipso_arrow").css({marginTop:-p.settings.arrowWidth,marginLeft:""}),n<f.scrollLeft()?(n=l.offset().left+l.outerWidth()+g,d.find(".tipso_arrow").css({"border-right-color":p.settings.background,"border-left-color":"transparent","border-top-color":"transparent","border-bottom-color":"transparent"}),d.removeClass("top bottom left right"),d.addClass("right")):(d.find(".tipso_arrow").css({"border-left-color":p.settings.background,"border-right-color":"transparent","border-top-color":"transparent","border-bottom-color":"transparent"}),d.removeClass("top bottom left right"),d.addClass(p.settings.position));break;case"right":n=l.offset().left+l.outerWidth()+g,i=l.offset().top+l.outerHeight()/2-e(d).height/2,d.find(".tipso_arrow").css({marginTop:-p.settings.arrowWidth,marginLeft:""}),n+g+p.settings.width>f.scrollLeft()+f.outerWidth()?(n=l.offset().left-e(d).width-g,d.find(".tipso_arrow").css({"border-left-color":p.settings.background,"border-right-color":"transparent","border-top-color":"transparent","border-bottom-color":"transparent"}),d.removeClass("top bottom left right"),d.addClass("left")):(d.find(".tipso_arrow").css({"border-right-color":p.settings.background,"border-left-color":"transparent","border-top-color":"transparent","border-bottom-color":"transparent"}),d.removeClass("top bottom left right"),d.addClass(p.settings.position))}if("top-right"===p.settings.position&&d.find(".tipso_arrow").css({"margin-left":-p.settings.width/2}),"top-left"===p.settings.position){var m=d.find(".tipso_arrow").eq(0);m.css({"margin-left":p.settings.width/2-2*p.settings.arrowWidth})}if("bottom-right"===p.settings.position){var m=d.find(".tipso_arrow").eq(0);m.css({"margin-left":-p.settings.width/2,"margin-top":""})}if("bottom-left"===p.settings.position){var m=d.find(".tipso_arrow").eq(0);m.css({"margin-left":p.settings.width/2-2*p.settings.arrowWidth,"margin-top":""})}n<f.scrollLeft()&&("bottom"===p.settings.position||"top"===p.settings.position)&&(d.find(".tipso_arrow").css({marginLeft:n-p.settings.arrowWidth}),n=0),n+p.settings.width>f.outerWidth()&&("bottom"===p.settings.position||"top"===p.settings.position)&&(a=f.outerWidth()-(n+p.settings.width),d.find(".tipso_arrow").css({marginLeft:-a-p.settings.arrowWidth,marginTop:""}),n+=a),n<f.scrollLeft()&&("left"===p.settings.position||"right"===p.settings.position||"top-right"===p.settings.position||"top-left"===p.settings.position||"bottom-right"===p.settings.position||"bottom-left"===p.settings.position)&&(n=l.offset().left+l.outerWidth()/2-e(d).width/2,d.find(".tipso_arrow").css({marginLeft:-p.settings.arrowWidth,marginTop:""}),i=l.offset().top-e(d).height-g,i<f.scrollTop()?(i=l.offset().top+l.outerHeight()+g,d.find(".tipso_arrow").css({"border-bottom-color":c,"border-top-color":"transparent","border-left-color":"transparent","border-right-color":"transparent"}),d.removeClass("top bottom left right"),r(d),d.addClass("bottom")):(d.find(".tipso_arrow").css({"border-top-color":p.settings.background,"border-bottom-color":"transparent","border-left-color":"transparent","border-right-color":"transparent"}),d.removeClass("top bottom left right"),r(d),d.addClass("top")),n+p.settings.width>f.outerWidth()&&(a=f.outerWidth()-(n+p.settings.width),d.find(".tipso_arrow").css({marginLeft:-a-p.settings.arrowWidth,marginTop:""}),n+=a),n<f.scrollLeft()&&(d.find(".tipso_arrow").css({marginLeft:n-p.settings.arrowWidth}),n=0)),n+p.settings.width>f.outerWidth()&&("left"===p.settings.position||"right"===p.settings.position||"top-right"===p.settings.position||"top-left"===p.settings.position||"bottom-right"===p.settings.position||"bottom-right"===p.settings.position)&&(n=l.offset().left+l.outerWidth()/2-e(d).width/2,d.find(".tipso_arrow").css({marginLeft:-p.settings.arrowWidth,marginTop:""}),i=l.offset().top-e(d).height-g,i<f.scrollTop()?(i=l.offset().top+l.outerHeight()+g,d.find(".tipso_arrow").css({"border-bottom-color":c,"border-top-color":"transparent","border-left-color":"transparent","border-right-color":"transparent"}),r(d),d.removeClass("top bottom left right"),d.addClass("bottom")):(d.find(".tipso_arrow").css({"border-top-color":p.settings.background,"border-bottom-color":"transparent","border-left-color":"transparent","border-right-color":"transparent"}),r(d),d.removeClass("top bottom left right"),d.addClass("top")),n+p.settings.width>f.outerWidth()&&(a=f.outerWidth()-(n+p.settings.width),d.find(".tipso_arrow").css({marginLeft:-a-p.settings.arrowWidth,marginTop:""}),n+=a),n<f.scrollLeft()&&(d.find(".tipso_arrow").css({marginLeft:n-p.settings.arrowWidth}),n=0)),d.css({left:n+p.settings.offsetX,top:i+p.settings.offsetY}),i<f.scrollTop()&&("right"===p.settings.position||"left"===p.settings.position)&&(l.tipso("update","position","bottom"),s(p)),i+e(d).height>f.scrollTop()+f.outerHeight()&&("right"===p.settings.position||"left"===p.settings.position)&&(l.tipso("update","position","top"),s(p))}var i="tipso",n={speed:200,background:"#55b555",titleBackground:"#333333",color:"#ffffff",titleColor:"#ffffff",titleContent:"",showArrow:!0,position:"top",width:300,maxWidth:"",delay:0,hideDelay:0,animationIn:"",animationOut:"",offsetX:0,offsetY:0,arrowWidth:8,tooltipHover:!1,content:null,ajaxContentUrl:null,contentElementId:null,useTitle:!1,templateEngineFunc:null,onBeforeShow:null,onShow:null,onHide:null};t.extend(o.prototype,{init:function(){{var t=this,o=this.element;this.doc}if(o.addClass("tipso_style").removeAttr("title"),t.settings.tooltipHover){var e=null,r=null;o.on("mouseover."+i,function(){clearTimeout(e),clearTimeout(r),r=setTimeout(function(){t.show()},0)}),o.on("mouseout."+i,function(){clearTimeout(e),clearTimeout(r),e=setTimeout(function(){t.hide()},200),t.tooltip().on("mouseover."+i,function(){t.mode="tooltipHover"}).on("mouseout."+i,function(){t.mode="show",clearTimeout(e),e=setTimeout(function(){t.hide()},200)})})}else o.on("mouseover."+i,function(){t.show()}),o.on("mouseout."+i,function(){t.hide()})},tooltip:function(){return this.tipso_bubble||(this.tipso_bubble=t('<div class="tipso_bubble"><div class="tipso_title"></div><div class="tipso_content"></div><div class="tipso_arrow"></div></div>')),this.tipso_bubble},show:function(){var o=this.tooltip(),e=this,r=this.win;e.settings.showArrow===!1?o.find(".tipso_arrow").hide():o.find(".tipso_arrow").show(),"hide"===e.mode&&(t.isFunction(e.settings.onBeforeShow)&&e.settings.onBeforeShow(this.element,this),e.settings.size&&o.addClass(e.settings.size),e.settings.width?o.css({background:e.settings.background,color:e.settings.color,width:e.settings.width}).hide():e.settings.maxWidth?o.css({background:e.settings.background,color:e.settings.color,maxWidth:e.settings.maxWidth}).hide():o.css({background:e.settings.background,color:e.settings.color,width:300}).hide(),o.find(".tipso_title").css({background:e.settings.titleBackground,color:e.settings.titleColor}),o.find(".tipso_content").html(e.content()),o.find(".tipso_title").html(e.titleContent()),s(e),r.on("resize."+i,function(){e.settings.position=e.settings.preferedPosition,s(e)}),window.clearTimeout(e.timeout),e.timeout=null,e.timeout=window.setTimeout(function(){e.ieFade||""===e.settings.animationIn||""===e.settings.animationOut?o.appendTo("body").stop(!0,!0).fadeIn(e.settings.speed,function(){e.mode="show",t.isFunction(e.settings.onShow)&&e.settings.onShow(this.element,this)}):o.remove().appendTo("body").stop(!0,!0).removeClass("animated "+e.settings.animationOut).addClass("noAnimation").removeClass("noAnimation").addClass("animated "+e.settings.animationIn).fadeIn(e.settings.speed,function(){t(this).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",function(){t(this).removeClass("animated "+e.settings.animationIn)}),e.mode="show",t.isFunction(e.settings.onShow)&&e.settings.onShow(this.element,this),r.off("resize."+i,null,"tipsoResizeHandler")})},e.settings.delay))},hide:function(){var o=this,e=this.win,r=this.tooltip();window.clearTimeout(o.timeout),o.timeout=null,o.timeout=window.setTimeout(function(){"tooltipHover"!==o.mode&&(o.ieFade||""===o.settings.animationIn||""===o.settings.animationOut?r.stop(!0,!0).fadeOut(o.settings.speed,function(){t(this).remove(),t.isFunction(o.settings.onHide)&&"show"===o.mode&&o.settings.onHide(this.element,this),o.mode="hide",e.off("resize."+i,null,"tipsoResizeHandler")}):r.stop(!0,!0).removeClass("animated "+o.settings.animationIn).addClass("noAnimation").removeClass("noAnimation").addClass("animated "+o.settings.animationOut).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",function(){t(this).removeClass("animated "+o.settings.animationOut).remove(),t.isFunction(o.settings.onHide)&&"show"===o.mode&&o.settings.onHide(this.element,this),o.mode="hide",e.off("resize."+i,null,"tipsoResizeHandler")}))},o.settings.hideDelay)},destroy:function(){{var t=this.element,o=this.win;this.doc}t.off("."+i),o.off("resize."+i,null,"tipsoResizeHandler"),t.removeData(i),t.removeClass("tipso_style").attr("title",this._title)},titleContent:function(){var t,o=this.element,e=this;return t=e.settings.titleContent?e.settings.titleContent:o.data("tipso-title")},content:function(){var o,e=this.element,r=this,s=this._title;return r.settings.ajaxContentUrl?o=t.ajax({type:"GET",url:r.settings.ajaxContentUrl,async:!1}).responseText:r.settings.contentElementId?o=t("#"+r.settings.contentElementId).text():r.settings.content?o=r.settings.content:r.settings.useTitle===!0?o=s:"string"==typeof e.data("tipso")&&(o=e.data("tipso")),null!==r.settings.templateEngineFunc&&(o=r.settings.templateEngineFunc(o)),o},update:function(t,o){var e=this;return o?void(e.settings[t]=o):e.settings[t]}});var a=function(){var t=document.createElement("p").style,o=["ms","O","Moz","Webkit"];if(""===t.transition)return!0;for(;o.length;)if(o.pop()+"Transition"in t)return!0;return!1}();t[i]=t.fn[i]=function(e){var r=arguments;if(void 0===e||"object"==typeof e)return this instanceof t||t.extend(n,e),this.each(function(){t.data(this,"plugin_"+i)||t.data(this,"plugin_"+i,new o(this,e))});if("string"==typeof e&&"_"!==e[0]&&"init"!==e){var s;return this.each(function(){var n=t.data(this,"plugin_"+i);n||(n=t.data(this,"plugin_"+i,new o(this,e))),n instanceof o&&"function"==typeof n[e]&&(s=n[e].apply(n,Array.prototype.slice.call(r,1))),"destroy"===e&&t.data(this,"plugin_"+i,null)}),void 0!==s?s:this}}});