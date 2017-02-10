/****************************** NAVIGATION *******************************/

/**
 * Multi-level Drop Down Menu (multi-ddm)
 * March 26, 2009
 * Corey Hart @ http://www.codenothing.com
 * @timer: [Default 500] Time in milliseconds to hold menu's open on mouseouts
 * @parentMO: CSS class to add/remove from parent menu on mouseover/mouseouts
 * @childMO: CSS class to add/remove to ALL child menus
 * @levels: Array of CSS classes in order of appearance on drop downs
 * @parentTag: List type of the parent menu ('ul' or 'ol')
 * @childTag: List type of each menu level ('ul' or 'ol')
 * @tags: List type of each level in order ('ul' or 'ol' for each)
 * @numberOfLevels: [Default 5] Number of levels the menu has. Will default to 
 * 	length of levels array when childMO is null.
 */ 
(function(jQuery){
	jQuery.fn.dropDownMenu = function(options){
		var menus = new Array();
		var css;
		var tag;
		var internal;
		var timeout;
		var settings = jQuery.extend({
			timer: 500,
			parentMO: null,
			childMO: null,
			levels: [],
			parentTag: 'ul',
			childTag: 'ul',
			tags: [],
			numberOfLevels: 5
		},options||{});

		// Set number of levels
		if (settings.tags.length > 0){
			settings.numberOfLevels = settings.tags.length;
		}else if (settings.levels.length){
			settings.numberOfLevels = settings.levels.length;
		}

		// Set css levels with childMO
		if (settings.childMO){
			for (var i=0; i<settings.numberOfLevels; i++) settings.levels[i] = settings.childMO;
		}

		// Set tag levels with tag
		if (settings.tags.length < 1){
			for (var i=0; i<settings.numberOfLevels; i++) settings.tags[i] = settings.childTag;
		}

		// Run through each level
		menus[0] = jQuery(this).children('li');
		for (var i=1; i<settings.numberOfLevels+2; i++){
			// Tags/CSS
			css = (i==1) ? settings.parentMO : settings.levels[i-2];
			tag = (i==1) ? settings.parentTag : settings.tags[i-2];

			// level selector
			menus[i] = menus[i-1].children(settings.tag).children('li');

			// Action
			menus[i-1].attr({rel: css+';'+tag}).mouseover(function(){
				if (timeout) clearTimeout(timeout);
				internal = jQuery(this).attr("rel").split(";");
				jQuery(this).siblings('li').children('a').removeClass(internal[0]).siblings(internal[1]).hide();
				jQuery(this).children('a').addClass(internal[0]).siblings(internal[1]).show();
			}).mouseout(function(){
				internal = jQuery(this).attr("rel").split(";");
				if (internal[0] == settings.parentMO){
					timeout = setTimeout(function(){closemenu();}, settings.timer);
				}
			});
		}

		// Allows user option to close menus by clicking outside the menu on the body
		jQuery(document).click(function(){closemenu();});

		// Closes all open menus
		var closemenu = function(){
			for (var i=menus.length; i>-1; i--){
				if (menus[i] && menus[i].attr("rel")){
					internal = menus[i].attr("rel").split(";");
					menus[i].children(internal[1]).hide().siblings('a').removeClass(internal[0]);
				}
			}
			jQuery('a', menus[0]).removeClass(settings.parentMO);
			if (timeout) clearTimeout(timeout);
			}
		};
	})(jQuery);


/****************************** TABBED PANELS *******************************/


(function(jQuery){ 
     jQuery.fn.extend({  
         tabify: function() {
			function getHref(el){
				hash = jQuery(el).find('a').attr('href');
				if(hash)
					return hash.substring(0,hash.length-4);
				else
					return false;
				}
		 	function setActive(el){
				jQuery(el).addClass('active');
				if(getHref(el))
					jQuery(getHref(el)).show();
				else
					return false;
				jQuery(el).siblings('li').each(function(){
					jQuery(this).removeClass('active');
					jQuery(getHref(this)).hide();
				});
			}
			return this.each(function() {
				var self = this;
				
				jQuery(this).find('li>a').each(function(){
					jQuery(this).attr('href',jQuery(this).attr('href') + '-tab');
				});
				
				function handleHash(){
					if(location.hash)
						setActive(jQuery(self).find('a[href=' + location.hash + ']').parent());
				}
				if(location.hash)
					handleHash();
				setInterval(handleHash,100);
				jQuery(this).find('li').each(function(){
					if(jQuery(this).hasClass('active'))
						jQuery(getHref(this)).show();
					else
						jQuery(getHref(this)).hide();
				});
            }); 
        } 
    }); 
})(jQuery);

/******************************* SWAP IT *************************************/
(function($) {

jQuery.fn.canvasSwap = function(options) {
    	
    var options = jQuery.extend({}, jQuery.fn.canvasSwap.defaults, options);
    
    jQuery(this).hover (
    
    	function () {
    		
    		var thesrc = $(this).attr('src');
    	
    		var name = thesrc.substring(0, thesrc.lastIndexOf('.'));
    	
    		var extension = thesrc.substring(thesrc.lastIndexOf('.'));
    		
    		$(this).attr('src', name + options.suffix + extension);
    		
    	}, function () {
    		
    		var thesrc = $(this).attr('src');
    		
    		var name = thesrc.substring(0, thesrc.lastIndexOf('.') - options.suffix.length);
    		
    		var extension = thesrc.substring(thesrc.lastIndexOf('.'));
    		
    		$(this).attr('src', name + extension);
    		
    	}
    	
    );
    
    if(options.ie6_support == true) {
    	
    	if(jQuery.browser.version == "5.5" || jQuery.browser.version == "6.0") {
    	
    		jQuery(this).next().hover (
    		
    			function () {
    			
    				var thefilter = $(this).css('filter').substring(56);
        	
        			var thesrc = thefilter.substring(0, thefilter.length-24);
        	
        			var name = thesrc.substring(0, thesrc.lastIndexOf('.'));
        		
        			var extension = thesrc.substring(thesrc.lastIndexOf('.'));
        		
        			$(this).css('filter', 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' + name + options.suffix + extension + '\', sizingMethod=\'scale\')');
    				
    			}, function () {
    			
    				var thefilter = $(this).css('filter').substring(56);
        	
        			var thesrc = thefilter.substring(0, thefilter.length-24);
        			
        			var name = thesrc.substring(0, thesrc.lastIndexOf('.') - options.suffix.length);
    		
    				var extension = thesrc.substring(thesrc.lastIndexOf('.'));
        	
        			$(this).css('filter', 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' + name + extension + '\', sizingMethod=\'scale\')');
    				
    			}
    			
    		);
    		
    	}
    	
    }
    
};

jQuery.fn.canvasSwap.defaults = {
	
	suffix: '_over',
	
	ie6_support: false
	
}

})(jQuery);

/****************************** DOCUMENT READY *******************************/
jQuery(document).ready(function(){
								
//swap it								
	$.fn.canvasSwap.defaults.suffix = '_hover';
    $.fn.canvasSwap.defaults.ie6_support = true;
    $('img.swapit').canvasSwap();
						   
// pane-list
	jQuery("ul.pane-list li, ol.pane-list li, p.pane-list, div.pane-list, span.pane-list").click(function(){
    	window.location=jQuery(this).find("a").attr("href"); return false;
		});
	
// navigation
	jQuery('#multi-ddm').dropDownMenu({parentMO: 'parent-hover', childMO: 'child-hover1'});

// sliding panels
	jQuery(".menu_list div.menu_head").click(function(){
		jQuery(this).toggleClass('active').next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
		jQuery(this).siblings("div.menu_head").removeClass('active')
		});

// tabbed panels
	jQuery('#menu').tabify();

// append .navlink to top level navigation
	jQuery("#multi-ddm>li>a").addClass("navlink");

// append .first & .last to top level navigation
	jQuery("#mn-topnav>ul>li:first>a").addClass("first");
		jQuery("#mn-topnav>ul>li:last>a").addClass("last");

// append #content-top
    //ONLOAD CHECK CONDITION AND APPLY CLASS BUT NOT TO FIRST "a"
    jQuery("#mn-topnav li a:not(:first)").each(function(){
		//LETS CHECK EACH HREF
		checklink = this.href;
		//LETS SEE IF WE FIND AN # IN THE HREF
		check = checklink.indexOf('#');
		//IF WE DONT FIND ONE ADD THE CLASS
		if (check <= -1)
			{ jQuery(this).addClass("top-anchor"); }
		});
		//YOURS TRULY : LEYLA BALAREZO
	jQuery("#mn-topnav a.top-anchor").each(function(){
		var newHref = jQuery(this).attr("href") + "#mn-main";
		jQuery(this).attr("href",newHref);
		}); 

// anchorlist
	var sublinks = jQuery("#multi-ddm").find("li.current-menu-item").find("ul").html();
		jQuery("ul#sublinks").html(sublinks);

// append .first & .last to bottom lists
	jQuery("#mn-bottom ul:first").addClass("first");
		jQuery("#mn-bottom ul:last").addClass("last");
	jQuery("#mn-footer ul#footernav li:first").addClass("first");
		jQuery("#mn-footer ul#footernav li:last").addClass("last");
	jQuery("#mn-footer ul#footerlinks li:first").addClass("first");
			jQuery("#mn-footer ul#footerlinks li:last").addClass("last");

// social network bottom icon swap
	var template_directory = jQuery('meta[name="template_directory"]').attr("content");
		jQuery('.socialnets a[href*="facebook"]').html('<img src="demo-spindown-open.gif" />');
		jQuery('.socialnets a[href*="twitter"]').html('<img src="images/icons/twitter.png" />');
		jQuery('.socialnets a[href*="linkedin"]').html('<img src="images/icons/linkedin.png" />');
		jQuery('.socialnets a[href*="youtube"]').html('<img src="images/icons/youtube.png" />');
		jQuery('.socialnets a[href*="myspace"]').html('<img src="images/icons/myspace.png" />');

// fancybox classing
	if(jQuery("#mn-content").length){
	jQuery("#mn-content a").has("img").addClass("lightboxed");
		jQuery("a.lightboxed").fancybox();
	}
		
// target social media _blank
jQuery(document).ready(function(){
  jQuery('ul.socialnet li a').attr('target', '_blank');
});
		
		
}); //close doc ready
