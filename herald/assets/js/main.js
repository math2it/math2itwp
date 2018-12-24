(function($) {

    "use strict";

    $(document).ready(function() {


        if ((navigator.userAgent.match(/iPhone/)) || (navigator.userAgent.match(/iPod/))) {
            $('body').addClass('iphone-device');
        }

        if (navigator.userAgent.match(/Android/)) {
            $('body').addClass('android-device');
        }

        /* Make sure main area elements are centered and use proper logo version */

        var herald_retina_logo_done = false,
            herald_retina_mini_logo_done = false,
            herald_header_center_done = false;

        herald_header_check();

        $(window).resize(function() {

            // Don't do anything in full screen mode
            if(document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement || document.msFullscreenElement){
                return;
            }

            herald_header_check();
            herald_sticky_sidebar();
            herald_sidebar_switch();
            herald_sticky_meta_bar();
            herald_responsive_header_ad();

            $('.herald-responsive-header .herald-menu-popup-search.herald-search-active span').removeClass('fa-times').addClass('fa-search');
            $('.herald-responsive-header .herald-menu-popup-search .herald-in-popup').removeClass('herald-search-active');
        });


        /* Featured area hovers */

        $(".herald-fa-item").hover(function() {

                var excerpt_height = $(this).find('.entry-content').height();

                $(this).find('.entry-header').css({
                    "-webkit-transform": "translate(0,-" + excerpt_height + "px)",
                    "-ms-transform": "translate(0,-" + excerpt_height + "px)",
                    "transform": "translate(0,-" + excerpt_height + "px)"
                });
            },
            function() {
                $(this).find('.entry-header').css({
                    "-webkit-transform": "translate(0,0)",
                    "-ms-transform": "translate(0,0)",
                    "transform": "translate(0,0)"
                });
            });

        /*Reverse submenu ul if out of the screen */
        $('.main-navigation li').hover(function(e) {
            if ($(this).closest('body').width() < $(document).width()) {

                $(this).find('ul').addClass('herald-rev');
            }
        }, function() {
            $(this).find('ul').removeClass('herald-rev');
        });

        /* Fit Videos */

        $(".meta-media").fitVids();
        $(".herald-entry-content").fitVids();


        /* Header search */

        $('body').on('click', '.herald-site-header .herald-menu-popup-search span, .herald-header-sticky .herald-menu-popup-search span', function(e) {

            e.preventDefault();
            $(this).toggleClass('fa-times', 'fa-search');
            $(this).parent().toggleClass('herald-search-active');
            $('.herald-search-active input[type="text"]').focus();

            /* Reverse login form if is out of the screen */
            if ($(this).closest('body').width() < $(document).width()) {
                $(this).siblings('.herald-in-popup').addClass('herald-reverse-form');
            } else {
                $(this).siblings('.herald-in-popup').removeClass('herald-reverse-form');
            }

        });

        /* Responsive Search functionality addons */
        $(".herald-responsive-header .herald-menu-popup-search span").click(function(e) {

            e.preventDefault();


            $(this).next().toggle();
            $(this).toggleClass('fa-times', 'fa-search');


            if ($(window).width() < 1250) {
                $('.herald-responsive-header .herald-in-popup .herald-search-input').focus();
                $('.herald-responsive-header .herald-in-popup').css('width', $(window).width());
            }


        });

        /* Center elements in sticky header and bottom header */

        $('.herald-header-sticky').imagesLoaded(function() {

            $('.herald-header-sticky .hel-el').children().each(function() {
                $(this).heraldCenter().animate({
                    opacity: 1
                }, 100);
            });

        });

        $('.header-bottom').imagesLoaded(function() {

            $('.header-bottom .hel-el').children().each(function() {
                $(this).heraldCenter().animate({
                    opacity: 1
                }, 100);
            });

        });

        /* Mega menu hovers */

        $(".herald-site-header .herald-mega-menu, .herald-header-sticky .herald-mega-menu").hover(function() {
            var el_width = $('.herald-site-content').width();
            $(this).find('> .sub-menu').css('width', el_width + 'px');
        });

        /* Share This hover */
        $('body').on('hover', ".entry-meta-wrapper .herald-share", function(e) {

            if (e.type == "mouseenter") {
                $(this).find('.meta-share-wrapper').slideDown();
            } else { // mouseleave
                $(this).find('.meta-share-wrapper').slideUp();
            }

        });

        /* Show/Hide subcategory links on mobile devices*/
        if (window.matchMedia("(max-width: 766px)").matches) {     
            $('.herald-mod-subnav-mobile').each(function() {
                $(this).closest('.herald-mod-h').addClass('herald-subcat-dropdown');
            });
        }

        $('body').on('click', '.herald-subcat-dropdown', function() {
            $(this).find('.herald-mod-subnav-mobile').slideToggle(200);
        });

        $('body').imagesLoaded(function() {
            herald_sticky_sidebar();
            herald_sidebar_switch();
            herald_sticky_meta_bar();

            herald_sticky_bottom_bar($('.herald-site-content .herald-section').last());
            $('.herald-clear-blur').clearBlur();
        });


        /* Sticky header */

        if (herald_js_settings.header_sticky) {

            var herald_last_top;

            $(window).scroll(function() {
                var top = $(window).scrollTop();
                if (herald_js_settings.header_sticky_up) {
                    if (herald_last_top > top && top >= herald_js_settings.header_sticky_offset) {
                        $("body").addClass("herald-sticky-header-visible");
                    } else {
                        $("body").removeClass("herald-sticky-header-visible");
                    }
                } else {
                    if (top >= herald_js_settings.header_sticky_offset) {
                        $("body").addClass("herald-sticky-header-visible");
                    } else {
                        $("body").removeClass("herald-sticky-header-visible");
                    }
                }

                herald_last_top = top;
            });
        }


        /* Sticky single bottom bar */

        function herald_sticky_bottom_bar(obj) {

            if (herald_js_settings.single_sticky_bar) {

                var herald_footer_offset = $('.herald-site-footer').offset().top - $(window).height();

                /* Single Sticky Bar Mobile Navigation */
                if ($('body').hasClass('single') && obj.find('.herald-single-sticky').length) {
                    var herald_sticky_share_elements = obj.find('.herald-single-sticky').clone(true, true);
                    obj.append('<div class="herald-single-sticky herald-single-mobile-sticky hidden-lg hidden-md">' + herald_sticky_share_elements.html() + '</div>');
                }

                $(window).scroll(function() {

                    var top = $(window).scrollTop();

                    if (top >= (obj.offset().top + 600) && top < herald_footer_offset) {
                        obj.addClass("herald-sticky-single-visible");
                    } else {
                        obj.removeClass("herald-sticky-single-visible");
                    }
                });
            }
        }

        /* Initialize magnific pop-up */

        herald_popup_image_content($('.herald-section'));

        if (herald_js_settings.popup_img) {
            herald_popup_image($('.herald-site-content'));
            herald_popup_gallery($('.herald-site-content'));
        }


        /* Comment form opener */

        $('body').on('click', '.herald-comment-form-open', function(e) {

            e.preventDefault();
            var section = $(this).closest('.herald-section');

            $(this).parent().fadeOut(100, function() {
                section.find('#respond').fadeIn(300);
                section.find('#respond #comment').focus();
                 $('.herald-clear-blur').clearBlur();
            });



        });

        /* Open comment form automatically if Jetpack is enabled */
        if ($('#jetpack_remote_comment').length) {
            $('.herald-comment-form-open').parent().hide();
            $('#respond').fadeIn(300);
        }


        /* Scroll to comments */

        $('body').on('click', '.entry-meta-single .herald-comments a, .herald-comment-action', function(e) {

            e.preventDefault();
            var section = $(this).closest('.herald-section');

            var target = this.hash,
                $target = section.find(target);


            section.find('.herald-comment-form-open').parent().hide();
            section.find('#respond').show();


            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 900, 'swing', function() {
                window.location.hash = target;
            });

        });


        /* Share icons click */

        $('body').on('click', 'ul.herald-share a:not(".no-popup")', function(e) {
            e.preventDefault();
            var data = $(this).attr('data-url');
            herald_social_share(data);
        });



        /* Module slider */

        $(".herald-slider").each(function() {
            var controls = $(this).closest('.herald-module').find('.herald-slider-controls');
            var module_columns = $(this).closest('.herald-module').attr('data-col');
            var layout_columns = controls.attr('data-col');
            var slider_items = module_columns / layout_columns;
            var autoplay_time = parseInt(controls.attr('data-autoplay')) * 1000;
            var autoplay = autoplay_time ? true : false;

            $(this).owlCarousel({
                rtl: (herald_js_settings.rtl_mode === "true"),
                loop: true,
                autoHeight: false,
                autoWidth: false,
                items: slider_items,
                margin: 40,
                nav: true,
                center: false,
                fluidSpeed: 100,
                autoplay: autoplay,
                autoplayHoverPause: true,
                autoplayTimeout: autoplay_time,
                navContainer: controls,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                responsive: {
                    0: {
                        margin: 20,
                        items: (layout_columns <= 2) ? 2 : 1
                    },
                    768: {
                        margin: 30
                    },
                    1480: {
                        margin: 40
                    }
                }
            });
        });

        /* Trending posts slider */

        $('.trending-slider').owlCarousel({
            rtl: (herald_js_settings.rtl_mode === "true"),
            loop: true,
            autoWidth: false,
            items: herald_js_settings.trending_columns,
            nav: false,
            center: false,
            fluidSpeed: 100,
            margin: 20,
            autoplay: true,
            autoplayHoverPause: true,
            autoplayTimeout: 2500
        });

        /* Widget slider */
        herald_widget_slider($("body"));

        function herald_widget_slider(obj) {

            obj.find(".herald-widget-slider").each(function() {
                var $controls = $(this).closest('.widget').find('.herald-slider-controls');

                $(this).owlCarousel({
                    rtl: (herald_js_settings.rtl_mode === "true"),
                    loop: true,
                    autoHeight: false,
                    autoWidth: false,
                    nav: true,
                    center: false,
                    fluidSpeed: 100,
                    navContainer: $controls,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                    responsive: {
                        0: {
                            autoWidth: false,
                            margin: 20,
                            items: 1
                        }
                    }
                });
            });

        }

        /* Gallery slider */

        herald_gallery($('.herald-section'));

        function herald_gallery(obj) {

            obj.find('.gallery-columns-1').owlCarousel({
                rtl: (herald_js_settings.rtl_mode === "true"),
                loop: true,
                nav: true,
                autoWidth: false,
                center: false,
                fluidSpeed: 100,
                margin: 0,
                items: 1,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
            });
        }


        /* Handling URL on ajax call for load more and infinite scroll case */

        if ($('.herald-infinite-scroll').length || $('.herald-load-more').length || $('.herald-infinite-scroll-single').length) {

            var herald_url_pushes = [];
            var herald_pushes_up = 0;
            var herald_pushes_down = 0;

            var push_obj = {
                prev: window.location.href,
                next: '',
                offset: $(window).scrollTop(),
                prev_title: window.document.title,
                next_title: window.document.title
            };

            herald_url_pushes.push(push_obj);
            //window.history.pushState(push_obj, '', window.location.href);
            var last_up, last_down = 0;

            $(window).scroll(function() {
                if (herald_url_pushes[herald_pushes_up].offset != last_up && $(window).scrollTop() < herald_url_pushes[herald_pushes_up].offset) {
                    last_up = herald_url_pushes[herald_pushes_up].offset;
                    last_down = 0;
                    window.document.title = herald_url_pushes[herald_pushes_up].prev_title;
                    window.history.replaceState(herald_url_pushes, '', herald_url_pushes[herald_pushes_up].prev); //1

                    herald_pushes_down = herald_pushes_up;
                    if (herald_pushes_up != 0) {
                        herald_pushes_up--;
                    }
                }
                if (herald_url_pushes[herald_pushes_down].offset != last_down && $(window).scrollTop() > herald_url_pushes[herald_pushes_down].offset) {

                    last_down = herald_url_pushes[herald_pushes_down].offset;
                    last_up = 0;

                    window.document.title = herald_url_pushes[herald_pushes_down].next_title;
                    window.history.replaceState(herald_url_pushes, '', herald_url_pushes[herald_pushes_down].next);

                    herald_pushes_up = herald_pushes_down;
                    if (herald_pushes_down < herald_url_pushes.length - 1) {
                        herald_pushes_down++;
                    }
                }
            });

        }


        /* Load more button handler */
        var herald_load_ajax_new_count = 0;

        $("body").on('click', '.herald-load-more a', function(e) {
            e.preventDefault();
            var $link = $(this);
            var page_url = $link.attr("href");
            var start_url = window.location.href;
            var prev_title = window.document.title;
            $link.addClass('herald-loader-active');
            $('.herald-loader').show();
            $("<div>").load(page_url, function() {
                var n = herald_load_ajax_new_count.toString();
                var $wrap = $link.closest('.herald-module').find('.herald-posts');
                var $new = $(this).find('.herald-module:last article').addClass('herald-new-' + n);
                var $this_div = $(this);

                $new.imagesLoaded(function() {

                    $new.hide().appendTo($wrap).fadeIn(400);

                    if ($this_div.find('.herald-load-more').length) {
                        $('.herald-load-more').html($this_div.find('.herald-load-more').html());
                        $('.herald-loader').hide();
                        $link.removeClass('herald-loader-active');
                    } else {
                        $('.herald-load-more').fadeOut('fast').remove();
                    }

                    herald_sticky_sidebar(true);

                    if (page_url != window.location) {

                        herald_pushes_up++;
                        herald_pushes_down++;
                        var next_title = $this_div.find('title').text();

                        var push_obj = {
                            prev: start_url,
                            next: page_url,
                            offset: $(window).scrollTop(),
                            prev_title: prev_title,
                            next_title: next_title
                        };

                        herald_url_pushes.push(push_obj);
                        window.document.title = next_title;
                        window.history.pushState(push_obj, '', page_url);

                    }

                    herald_load_ajax_new_count++;

                    return false;
                });

            });

        });


        /* Infinite scroll handler */
        var herald_infinite_allow = true;

        if ($('.herald-infinite-scroll').length) {
            $(window).scroll(function() {
                if (herald_infinite_allow && $('.herald-infinite-scroll').length && ($(this).scrollTop() > ($('.herald-infinite-scroll').offset().top) - $(this).height() - 200)) {
                    var $link = $('.herald-infinite-scroll a');
                    var page_url = $link.attr("href");
                    var start_url = window.location.href;
                    var prev_title = window.document.title;
                    if (page_url != undefined) {
                        herald_infinite_allow = false;
                        $('.herald-loader').show();
                        $("<div>").load(page_url, function() {
                            var n = herald_load_ajax_new_count.toString();
                            var $wrap = $link.closest('.herald-module').find('.herald-posts');
                            var $new = $(this).find('.herald-module:last article').addClass('herald-new-' + n);
                            var $this_div = $(this);

                            $new.imagesLoaded(function() {

                                $new.hide().appendTo($wrap).fadeIn(400);

                                if ($this_div.find('.herald-infinite-scroll').length) {
                                    $('.herald-infinite-scroll').html($this_div.find('.herald-infinite-scroll').html());
                                    $('.herald-loader').hide();
                                    herald_infinite_allow = true;
                                } else {
                                    $('.herald-infinite-scroll').fadeOut('fast').remove();
                                }

                                herald_sticky_sidebar(true);


                                if (page_url != window.location) {
                                    herald_pushes_up++;
                                    herald_pushes_down++;
                                    var next_title = $this_div.find('title').text();

                                    var push_obj = {
                                        prev: start_url,
                                        next: page_url,
                                        offset: $(window).scrollTop(),
                                        prev_title: prev_title,
                                        next_title: next_title
                                    };

                                    herald_url_pushes.push(push_obj);
                                    window.document.title = next_title;
                                    window.history.pushState(push_obj, '', page_url);

                                }
                                herald_load_ajax_new_count++;

                                return false;
                            });

                        });
                    }
                }
            });
        }


        /* Infinite scroll on single page */
        var herald_infinite_single_allow = true;
        var herald_load_ajax_single_new_count = 0;
        var herald_window_history_initial = true;

        if ($('.herald-infinite-scroll-single').length) {
            $(window).scroll(function() {
                if (herald_infinite_single_allow && $('.herald-infinite-scroll-single').length && ($(this).scrollTop() > ($('.herald-infinite-scroll-single').offset().top) - $(this).height() - 200)) {
                    var $link = $('.herald-infinite-scroll-single a').css('opacity', 0);
                    var page_url = $link.attr("href");
                    var start_url = window.location.href;
                    var prev_title = window.document.title;
                    if (page_url != undefined) {
                        herald_infinite_single_allow = false;
                        $('.herald-loader').show();
                        $("<div>").load(page_url, function() {
                            var $this_div = $(this);
                            var n = herald_load_ajax_single_new_count.toString();
                            var $wrap = $('.herald-site-content').find('.herald-section').last();
                            var $new = $this_div.find('.herald-section').last().addClass('herald-new-' + n);

                            $new.imagesLoaded(function() {

                                $new.hide().insertAfter($wrap).fadeIn(400);

                                if ($this_div.find('.herald-infinite-scroll-single').length) {
                                    $('.herald-infinite-scroll-single').html($this_div.find('.herald-infinite-scroll-single').html());
                                    $('.herald-loader').hide();
                                    herald_infinite_single_allow = true;
                                } else {
                                    $('.herald-infinite-scroll-single').fadeOut('fast').remove();
                                }

                                herald_sticky_sidebar(true);
                                herald_gallery($new);
                                herald_widget_slider($new);
                                herald_sticky_bottom_bar($new);
                                herald_sticky_meta_bar();
                                herald_popup_image_content($new);
                                if (herald_js_settings.popup_img) {
                                    herald_popup_image($new);
                                    herald_popup_gallery($new);
                                }

                                var push_obj = {};

                                if (herald_window_history_initial) {

                                    push_obj = {
                                        prev: window.location.href,
                                        next: '',
                                        offset: 0,
                                        prev_title: window.document.title,
                                        next_title: window.document.title
                                    };

                                    window.history.pushState(push_obj, '', window.location.href);

                                    herald_window_history_initial = false;

                                }

                                if (page_url != window.location) {

                                    herald_pushes_up++;
                                    herald_pushes_down++;
                                    var next_title = $this_div.find('title').text();

                                    push_obj = {
                                        prev: start_url,
                                        next: page_url,
                                        offset: $(window).scrollTop(),
                                        prev_title: prev_title,
                                        next_title: next_title
                                    };

                                    herald_url_pushes.push(push_obj);
                                    window.document.title = next_title;
                                    window.history.pushState(push_obj, '', page_url);

                                }

                                herald_load_ajax_single_new_count++;

                                return false;
                            });

                        });
                    }
                }
            });
        }

        /* Header tweaks */
        function herald_header_check() {

            // Center middle header elements vertically

            if (!herald_header_center_done && $('.header-middle').is(':visible')) {

                $('.header-middle').imagesLoaded(function() {

                    $('.header-middle .hel-el').children().each(function() {
                        $(this).heraldCenter().animate({
                            opacity: 1
                        }, 100);
                    });

                });

                herald_header_center_done = true;
            }

            //Retina logo
            if (window.devicePixelRatio > 1) {

                if (!herald_retina_logo_done && herald_js_settings.logo_retina && $('.herald-logo').length) {
                    $('.herald-logo').imagesLoaded(function() {

                        $('.herald-logo').each(function() {
                            if ($(this).is(':visible')) {
                                //var height = $(this).height();
                                var width = $(this).width();
                                $(this).attr('src', herald_js_settings.logo_retina).css('width', width + 'px');
                            }
                        });
                    });

                    herald_retina_logo_done = true;
                }

                if (!herald_retina_mini_logo_done && herald_js_settings.logo_mini_retina && $('.herald-logo-mini').length) {
                    $('.herald-logo-mini').imagesLoaded(function() {
                        $('.herald-logo-mini').each(function() {
                            if ($(this).is(':visible')) {
                                //var height = $(this).height();
                                var width = $(this).width();
                                $(this).attr('src', herald_js_settings.logo_mini_retina).css('width', width + 'px');
                            }
                        });
                    });

                    herald_retina_mini_logo_done = true;
                }
            }
        }



        /* Share popup function */

        function herald_social_share(data) {
            window.open(data, "Share", 'height=500,width=760,top=' + ($(window).height() / 2 - 250) + ', left=' + ($(window).width() / 2 - 380) + 'resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0');
        }


        /* Pop-up image function */

        function herald_popup_image(obj) {

            obj.find('.herald-image-format').magnificPopup({
                type: 'image',
                image: {
                    titleSrc: function(item) {
                        return item.el.find('figure').text();
                    }
                }
            });
        }


        /* Pop-up gallery function */

        function herald_popup_gallery(obj) {
            obj.find('.gallery').each(function() {
                $(this).find('.gallery-icon a.herald-popup').magnificPopup({
                    type: 'image',
                    gallery: {
                        enabled: true
                    },

                    image: {
                        titleSrc: function(item) {
                            var $caption = item.el.closest('.gallery-item').find('.gallery-caption');
                            if ($caption != 'undefined') {
                                return $caption.text();
                            }
                            return '';
                        }
                    }
                });
            });
        }

        /* Popup image function on single ocntent*/

        function herald_popup_image_content(obj) {

            if (obj.find("a.herald-popup-img").length) {

                var popupImg = obj.find("a.herald-popup-img");

                popupImg.find('img').each(function() {
                    var $that = $(this);
                    if ($that.hasClass('alignright')) {
                        $that.removeClass('alignright').parent().addClass('alignright');
                    }
                    if ($that.hasClass('alignleft')) {
                        $that.removeClass('alignleft').parent().addClass('alignleft');
                    }
                    if ($that.hasClass('alignnone')) {
                        $that.removeClass('alignnone').parent().addClass('alignnone');
                    }
                    if ($that.hasClass('aligncenter')) {
                        $that.removeClass('aligncenter').parent().addClass('aligncenter');
                    }
                });

                popupImg.magnificPopup({
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    image: {
                        titleSrc: function(item) {
                            return item.el.closest('.wp-caption').find('figcaption').text();
                        }
                    }
                });
            }
        }


        /* Initialize sticky sidebar */

        function herald_sticky_sidebar(fixed) {
            if ($(window).width() >= 1250) {

                if ($('.herald-sticky').length) {

                    $('.herald-sidebar').each(function() {
                        var $section = $(this).closest('.herald-section');
                        var section_height;
                        if ($section.find('.herald-ignore-sticky-height').length) {
                            section_height = $section.height() - 40 - $section.find('.herald-ignore-sticky-height').height();
                        } else {
                            section_height = $section.height() - 40;
                        }

                        $(this).css('min-height', section_height);
                    });

                    //Fix for load more button if sticky is at bottom
                    if (fixed && $(".herald-sticky").last().css('position') == 'absolute') {
                        $(".herald-sticky").last().css('position', 'fixed').css('top', 100);
                    }

                    $(".herald-sticky").stick_in_parent({
                        parent: ".herald-sidebar",
                        offset_top: 100
                    });

                }

            } else {

                $('.herald-sidebar').each(function() {
                    $(this).css('height', 'auto');
                    $(this).css('min-height', '1px');
                });

                $(".herald-sticky").trigger("sticky_kit:detach");
            }

        }

        /* Put sidebars below content in responsive mode */
        function herald_sidebar_switch() {
            $('.herald-sidebar-left').each(function() {
                if ($(window).width() < 1250) {
                    if($(this).parent().find('div').first().hasClass('herald-sidebar-left')){
                        $(this).insertAfter($(this).parent().find('.col-mod-main'));
                    }
                } else {
                    if(!$(this).parent().find('div').first().hasClass('herald-sidebar-left')){
                        $(this).insertBefore($(this).parent().find('.col-mod-main'));
                    }
                }
            });
        }

        /* Initialize sticky meta bar on single */
        function herald_sticky_meta_bar() {

            if ($(window).width() >= 768) {

                if ($('.entry-meta-wrapper-sticky').length) {

                    $('.entry-meta-wrapper-sticky').each(function() {

                        var parent = $(this).parent();
                        var section = $(this).closest('.herald-section');
                        var height = section.find('.herald-entry-content').parent().height() - 70;
                        parent.css('min-height', height);

                    });

                    $('.entry-meta-wrapper-sticky').stick_in_parent();

                }


            } else {

                $('.entry-meta-wrapper-sticky').each(function() {
                    $(this).css('height', 'auto');
                    $(this).css('min-height', '1px');
                });

                $(".entry-meta-wrapper-sticky").trigger("sticky_kit:detach");

            }
        }

        /* Mobile Navigation */

        var herald_slide_items = $('.herald-slide');
        var herald_site_content = $('.herald-site-content');


        function herald_responsive_nav_open() {
            herald_slide_items.removeClass('close').addClass('open');
            $('body').addClass('herald-menu-open');
        }

        function herald_responsive_nav_close() {
            herald_slide_items.removeClass('open').addClass('close');
            $('body').removeClass('herald-menu-open');
        }

        herald_responsive_header_ad();
        /* Header ad in mobile/tablet devices */
        function herald_responsive_header_ad() {
            if (herald_js_settings.header_ad_responsive) {
                var header_ad = $('#header .herald-ad');
                if (($(window).width() < herald_js_settings.header_responsive_breakpoint) && !header_ad.hasClass('cloned')) {
                    header_ad.addClass('cloned');
                    var responsive_ad = header_ad.clone().removeClass('cloned hidden-xs').addClass('header-mobile-ad');
                    responsive_ad.insertAfter('#herald-responsive-header');
                }
            }
        }

        /* Other navigation on resposive menu */
        if (herald_js_settings.responsive_menu_more_link != 0) {

            var mobile_nav = $('.herald-more-link-wrapper');
            var secondary = $('.herald-mobile-nav .secondary-navigation');

            if (secondary.length) {

                secondary.each(function() {
                    var menu = $(this).find('ul').first().children();
                    mobile_nav.find('.herald-more-link ul').append(menu);
                    $(this).remove();
                });

            }

        }

        $('.herald-nav-toggle').on('click', function() {
            if (herald_site_content.hasClass('open')) {
                herald_responsive_nav_close();
            } else {
                herald_responsive_nav_open();
            }
        });

        herald_site_content.click(function() {
            if (herald_site_content.hasClass('open')) {
                herald_responsive_nav_close();
            }
        });


        $('.herald-mobile-nav li').each(function() {
            var $this = $(this);
            $this.closest('nav').removeClass('herald-menu').addClass('herald-mob-nav');
            if ( $this.hasClass('menu-item-has-children') || $this.hasClass('herald-mega-menu') ) {
                $this.append('<span class="herald-menu-toggler fa fa-caret-down"></span>');
            }
            if ( $this.hasClass('herald-mega-menu') ) {
                var sub_categories = $this.find('.herald-mega-menu-sub-cats ul li');
                $this.find('.container').remove();
                $this.find('.sub-menu').append(sub_categories);
            }
        });
        
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            $('.herald-menu-toggler').on('touchstart', function(e) {
                $(this).prev().slideToggle();
                $(this).parent().toggleClass('herald-current-mobile-item');
            });
        } else {
            $('.herald-menu-toggler').on('click', function(e) {
                $(this).prev().slideToggle();
                $(this).parent().toggleClass('herald-current-mobile-item');
            });
        }



        /* Responsive Search functionality addons */

        $('body').on('click', '.herald-responsive-header .herald-menu-popup-search span', function(e) {
            e.preventDefault();
            e.stopPropagation();

            if ($(window).width() < 1250) {
                $('.herald-responsive-header .herald-in-popup').css('width', $(window).width());
            }

        });

        /* Back to top button */

        if ($('#back-top').length) {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 400) {
                    $('#back-top').fadeIn();
                } else {
                    $('#back-top').fadeOut();
                }
            });

            $('#back-top').click(function() {
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        }

        $(window).resize(function (){
            $('.herald-clear-blur').clearBlur();
        });

    }); //document ready end

    /* Clear browser blur caused by odd element height */
    $.fn.clearBlur = function() {
        $(this).each(function (i, elem){
            var $elem = $(elem),
            $parent = $elem.parent(),
            $img = $parent.find('img');

            if($img.is('[data-lazy-src]')) return;

            // Reset height
            $elem.css('height', 'auto');
            $parent.css('height', 'auto');

            var height = $elem.height(),
                isOdd = height % 2,
                parentHeight = $parent.height(),
                parentOdd = parentHeight % 2;

            height = isOdd ? height - 1 : height;
            parentHeight = parentOdd ? parentHeight - 1 : parentHeight;
            $elem.css( "height", height );
            $parent.css('height', parentHeight);
        });
    };

    /* Function to center elements */
    $.fn.heraldCenter = function() {
        this.css("position", "absolute");
        this.css("top", (($(this).parent().height() - this.height()) / 2) + "px");
        return this;
    };


    if (herald_js_settings.smooth_scroll) {


        // SmoothScroll for websites v1.3.9 (Balazs Galambosi)
        // http://www.smoothscroll.net/
        //
        // Licensed under the terms of the MIT license.
        //
        // You may use it in your theme if you credit me. 
        // It is also free to use on any individual website.
        //
        // Exception:
        // The only restriction would be not to publish any  
        // extension for browsers or native application
        // without getting a written permission first.
        //

        (function() {

            // Scroll Variables (tweakable)
            var defaultOptions = {

                // Scrolling Core
                frameRate: 150, // [Hz]
                animationTime: 400, // [ms]
                stepSize: 100, // [px]

                // Pulse (less tweakable)
                // ratio of "tail" to "acceleration"
                pulseAlgorithm: true,
                pulseScale: 4,
                pulseNormalize: 1,

                // Acceleration
                accelerationDelta: 50, // 50
                accelerationMax: 3, // 3

                // Keyboard Settings
                keyboardSupport: true, // option
                arrowScroll: 50, // [px]

                // Other
                touchpadSupport: false, // ignore touchpad by default
                fixedBackground: true,
                excluded: ''
            };

            var options = defaultOptions;


            // Other Variables
            var isExcluded = false;
            var isFrame = false;
            var direction = {
                x: 0,
                y: 0
            };
            var initDone = false;
            var root = document.documentElement;
            var activeElement;
            var observer;
            var deltaBuffer = [];
            var isMac = /^Mac/.test(navigator.platform);

            var key = {
                left: 37,
                up: 38,
                right: 39,
                down: 40,
                spacebar: 32,
                pageup: 33,
                pagedown: 34,
                end: 35,
                home: 36
            };


            /***********************************************
             * SETTINGS
             ***********************************************/

            var options = defaultOptions;


            /***********************************************
             * INITIALIZE
             ***********************************************/

            /**
             * Tests if smooth scrolling is allowed. Shuts down everything if not.
             */
            function initTest() {
                if (options.keyboardSupport) {
                    addEvent('keydown', keydown);
                }
            }

            /**
             * Sets up scrolls array, determines if frames are involved.
             */
            function init() {

                if (initDone || !document.body) return;

                initDone = true;

                var body = document.body;
                var html = document.documentElement;
                var windowHeight = window.innerHeight;
                var scrollHeight = body.scrollHeight;

                // check compat mode for root element
                root = (document.compatMode.indexOf('CSS') >= 0) ? html : body;
                activeElement = body;

                initTest();

                // Checks if this script is running in a frame
                if (top != self) {
                    isFrame = true;
                }

                /**
                 * This fixes a bug where the areas left and right to
                 * the content does not trigger the onmousewheel event
                 * on some pages. e.g.: html, body { height: 100% }
                 */
                else if (scrollHeight > windowHeight &&
                    (body.offsetHeight <= windowHeight ||
                        html.offsetHeight <= windowHeight)) {

                    var fullPageElem = document.createElement('div');
                    fullPageElem.style.cssText = 'position:absolute; z-index:-10000; ' +
                        'top:0; left:0; right:0; height:' +
                        root.scrollHeight + 'px';
                    document.body.appendChild(fullPageElem);

                    // DOM changed (throttled) to fix height
                    var pendingRefresh;
                    var refresh = function() {
                        if (pendingRefresh) return; // could also be: clearTimeout(pendingRefresh);
                        pendingRefresh = setTimeout(function() {
                            if (isExcluded) return; // could be running after cleanup
                            fullPageElem.style.height = '0';
                            fullPageElem.style.height = root.scrollHeight + 'px';
                            pendingRefresh = null;
                        }, 500); // act rarely to stay fast
                    };

                    setTimeout(refresh, 10);

                    // TODO: attributeFilter?
                    var config = {
                        attributes: true,
                        childList: true,
                        characterData: false
                        // subtree: true
                    };

                    observer = new MutationObserver(refresh);
                    observer.observe(body, config);

                    if (root.offsetHeight <= windowHeight) {
                        var clearfix = document.createElement('div');
                        clearfix.style.clear = 'both';
                        body.appendChild(clearfix);
                    }
                }

                // disable fixed background
                if (!options.fixedBackground && !isExcluded) {
                    body.style.backgroundAttachment = 'scroll';
                    html.style.backgroundAttachment = 'scroll';
                }
            }

            /**
             * Removes event listeners and other traces left on the page.
             */
            function cleanup() {
                observer && observer.disconnect();
                removeEvent(wheelEvent, wheel);
                removeEvent('mousedown', mousedown);
                removeEvent('keydown', keydown);
            }


            /************************************************
             * SCROLLING
             ************************************************/

            var que = [];
            var pending = false;
            var lastScroll = Date.now();

            /**
             * Pushes scroll actions to the scrolling queue.
             */
            function scrollArray(elem, left, top) {

                directionCheck(left, top);

                if (options.accelerationMax != 1) {
                    var now = Date.now();
                    var elapsed = now - lastScroll;
                    if (elapsed < options.accelerationDelta) {
                        var factor = (1 + (50 / elapsed)) / 2;
                        if (factor > 1) {
                            factor = Math.min(factor, options.accelerationMax);
                            left *= factor;
                            top *= factor;
                        }
                    }
                    lastScroll = Date.now();
                }

                // push a scroll command
                que.push({
                    x: left,
                    y: top,
                    lastX: (left < 0) ? 0.99 : -0.99,
                    lastY: (top < 0) ? 0.99 : -0.99,
                    start: Date.now()
                });

                // don't act if there's a pending queue
                if (pending) {
                    return;
                }

                var scrollWindow = (elem === document.body);

                var step = function(time) {

                    var now = Date.now();
                    var scrollX = 0;
                    var scrollY = 0;

                    for (var i = 0; i < que.length; i++) {

                        var item = que[i];
                        var elapsed = now - item.start;
                        var finished = (elapsed >= options.animationTime);

                        // scroll position: [0, 1]
                        var position = (finished) ? 1 : elapsed / options.animationTime;

                        // easing [optional]
                        if (options.pulseAlgorithm) {
                            position = pulse(position);
                        }

                        // only need the difference
                        var x = (item.x * position - item.lastX) >> 0;
                        var y = (item.y * position - item.lastY) >> 0;

                        // add this to the total scrolling
                        scrollX += x;
                        scrollY += y;

                        // update last values
                        item.lastX += x;
                        item.lastY += y;

                        // delete and step back if it's over
                        if (finished) {
                            que.splice(i, 1);
                            i--;
                        }
                    }

                    // scroll left and top
                    if (scrollWindow) {
                        window.scrollBy(scrollX, scrollY);
                    } else {
                        if (scrollX) elem.scrollLeft += scrollX;
                        if (scrollY) elem.scrollTop += scrollY;
                    }

                    // clean up if there's nothing left to do
                    if (!left && !top) {
                        que = [];
                    }

                    if (que.length) {
                        requestFrame(step, elem, (1000 / options.frameRate + 1));
                    } else {
                        pending = false;
                    }
                };

                // start a new queue of actions
                requestFrame(step, elem, 0);
                pending = true;
            }


            /***********************************************
             * EVENTS
             ***********************************************/

            /**
             * Mouse wheel handler.
             * @param {Object} event
             */
            function wheel(event) {

                if (!initDone) {
                    init();
                }

                var target = event.target;
                var overflowing = overflowingAncestor(target);

                // use default if there's no overflowing
                // element or default action is prevented   
                // or it's a zooming event with CTRL 
                if (!overflowing || event.defaultPrevented || event.ctrlKey) {
                    return true;
                }

                // leave embedded content alone (flash & pdf)
                if (isNodeName(activeElement, 'embed') ||
                    (isNodeName(target, 'embed') && /\.pdf/i.test(target.src)) ||
                    isNodeName(activeElement, 'object')) {
                    return true;
                }

                var deltaX = -event.wheelDeltaX || event.deltaX || 0;
                var deltaY = -event.wheelDeltaY || event.deltaY || 0;

                if (isMac) {
                    if (event.wheelDeltaX && isDivisible(event.wheelDeltaX, 120)) {
                        deltaX = -120 * (event.wheelDeltaX / Math.abs(event.wheelDeltaX));
                    }
                    if (event.wheelDeltaY && isDivisible(event.wheelDeltaY, 120)) {
                        deltaY = -120 * (event.wheelDeltaY / Math.abs(event.wheelDeltaY));
                    }
                }

                // use wheelDelta if deltaX/Y is not available
                if (!deltaX && !deltaY) {
                    deltaY = -event.wheelDelta || 0;
                }

                // line based scrolling (Firefox mostly)
                if (event.deltaMode === 1) {
                    deltaX *= 40;
                    deltaY *= 40;
                }

                // check if it's a touchpad scroll that should be ignored
                if (!options.touchpadSupport && isTouchpad(deltaY)) {
                    return true;
                }

                // scale by step size
                // delta is 120 most of the time
                // synaptics seems to send 1 sometimes
                if (Math.abs(deltaX) > 1.2) {
                    deltaX *= options.stepSize / 120;
                }
                if (Math.abs(deltaY) > 1.2) {
                    deltaY *= options.stepSize / 120;
                }

                scrollArray(overflowing, deltaX, deltaY);
                event.preventDefault();
                scheduleClearCache();
            }

            /**
             * Keydown event handler.
             * @param {Object} event
             */
            function keydown(event) {

                var target = event.target;
                var modifier = event.ctrlKey || event.altKey || event.metaKey ||
                    (event.shiftKey && event.keyCode !== key.spacebar);

                // our own tracked active element could've been removed from the DOM
                if (!document.contains(activeElement)) {
                    activeElement = document.activeElement;
                }

                // do nothing if user is editing text
                // or using a modifier key (except shift)
                // or in a dropdown
                // or inside interactive elements
                var inputNodeNames = /^(textarea|select|embed|object)$/i;
                var buttonTypes = /^(button|submit|radio|checkbox|file|color|image)$/i;
                if (inputNodeNames.test(target.nodeName) ||
                    isNodeName(target, 'input') && !buttonTypes.test(target.type) ||
                    isNodeName(activeElement, 'video') ||
                    isInsideYoutubeVideo(event) ||
                    target.isContentEditable ||
                    event.defaultPrevented ||
                    modifier) {
                    return true;
                }

                // spacebar should trigger button press
                if ((isNodeName(target, 'button') ||
                        isNodeName(target, 'input') && buttonTypes.test(target.type)) &&
                    event.keyCode === key.spacebar) {
                    return true;
                }

                var shift, x = 0,
                    y = 0;
                var elem = overflowingAncestor(activeElement);
                var clientHeight = elem.clientHeight;

                if (elem == document.body) {
                    clientHeight = window.innerHeight;
                }

                switch (event.keyCode) {
                    case key.up:
                        y = -options.arrowScroll;
                        break;
                    case key.down:
                        y = options.arrowScroll;
                        break;
                    case key.spacebar: // (+ shift)
                        shift = event.shiftKey ? 1 : -1;
                        y = -shift * clientHeight * 0.9;
                        break;
                    case key.pageup:
                        y = -clientHeight * 0.9;
                        break;
                    case key.pagedown:
                        y = clientHeight * 0.9;
                        break;
                    case key.home:
                        y = -elem.scrollTop;
                        break;
                    case key.end:
                        var damt = elem.scrollHeight - elem.scrollTop - clientHeight;
                        y = (damt > 0) ? damt + 10 : 0;
                        break;
                    case key.left:
                        x = -options.arrowScroll;
                        break;
                    case key.right:
                        x = options.arrowScroll;
                        break;
                    default:
                        return true; // a key we don't care about
                }

                scrollArray(elem, x, y);
                event.preventDefault();
                scheduleClearCache();
            }

            /**
             * Mousedown event only for updating activeElement
             */
            function mousedown(event) {
                activeElement = event.target;
            }


            /***********************************************
             * OVERFLOW
             ***********************************************/

            var uniqueID = (function() {
                var i = 0;
                return function(el) {
                    return el.uniqueID || (el.uniqueID = i++);
                };
            })();

            var cache = {}; // cleared out after a scrolling session
            var clearCacheTimer;

            //setInterval(function () { cache = {}; }, 10 * 1000);

            function scheduleClearCache() {
                clearTimeout(clearCacheTimer);
                clearCacheTimer = setInterval(function() {
                    cache = {};
                }, 1 * 1000);
            }

            function setCache(elems, overflowing) {
                for (var i = elems.length; i--;)
                    cache[uniqueID(elems[i])] = overflowing;
                return overflowing;
            }

            //  (body)                (root)
            //         | hidden | visible | scroll |  auto  |
            // hidden  |   no   |    no   |   YES  |   YES  |
            // visible |   no   |   YES   |   YES  |   YES  |
            // scroll  |   no   |   YES   |   YES  |   YES  |
            // auto    |   no   |   YES   |   YES  |   YES  |

            function overflowingAncestor(el) {
                var elems = [];
                var body = document.body;
                var rootScrollHeight = root.scrollHeight;
                do {
                    var cached = cache[uniqueID(el)];
                    if (cached) {
                        return setCache(elems, cached);
                    }
                    elems.push(el);
                    if (rootScrollHeight === el.scrollHeight) {
                        var topOverflowsNotHidden = overflowNotHidden(root) && overflowNotHidden(body);
                        var isOverflowCSS = topOverflowsNotHidden || overflowAutoOrScroll(root);
                        if (isFrame && isContentOverflowing(root) ||
                            !isFrame && isOverflowCSS) {
                            return setCache(elems, getScrollRoot());
                        }
                    } else if (isContentOverflowing(el) && overflowAutoOrScroll(el)) {
                        return setCache(elems, el);
                    }
                } while (el = el.parentElement);
            }

            function isContentOverflowing(el) {
                return (el.clientHeight + 10 < el.scrollHeight);
            }

            // typically for <body> and <html>
            function overflowNotHidden(el) {
                var overflow = getComputedStyle(el, '').getPropertyValue('overflow-y');
                return (overflow !== 'hidden');
            }

            // for all other elements
            function overflowAutoOrScroll(el) {
                var overflow = getComputedStyle(el, '').getPropertyValue('overflow-y');
                return (overflow === 'scroll' || overflow === 'auto');
            }


            /***********************************************
             * HELPERS
             ***********************************************/

            function addEvent(type, fn) {
                window.addEventListener(type, fn, false);
            }

            function removeEvent(type, fn) {
                window.removeEventListener(type, fn, false);
            }

            function isNodeName(el, tag) {
                return (el.nodeName || '').toLowerCase() === tag.toLowerCase();
            }

            function directionCheck(x, y) {
                x = (x > 0) ? 1 : -1;
                y = (y > 0) ? 1 : -1;
                if (direction.x !== x || direction.y !== y) {
                    direction.x = x;
                    direction.y = y;
                    que = [];
                    lastScroll = 0;
                }
            }

            var deltaBufferTimer;

            if (window.localStorage && localStorage.SS_deltaBuffer) {
                deltaBuffer = localStorage.SS_deltaBuffer.split(',');
            }

            function isTouchpad(deltaY) {
                if (!deltaY) return;
                if (!deltaBuffer.length) {
                    deltaBuffer = [deltaY, deltaY, deltaY];
                }
                deltaY = Math.abs(deltaY);
                deltaBuffer.push(deltaY);
                deltaBuffer.shift();
                clearTimeout(deltaBufferTimer);
                deltaBufferTimer = setTimeout(function() {
                    if (window.localStorage) {
                        localStorage.SS_deltaBuffer = deltaBuffer.join(',');
                    }
                }, 1000);
                return !allDeltasDivisableBy(120) && !allDeltasDivisableBy(100);
            }

            function isDivisible(n, divisor) {
                return (Math.floor(n / divisor) == n / divisor);
            }

            function allDeltasDivisableBy(divisor) {
                return (isDivisible(deltaBuffer[0], divisor) &&
                    isDivisible(deltaBuffer[1], divisor) &&
                    isDivisible(deltaBuffer[2], divisor));
            }

            function isInsideYoutubeVideo(event) {
                var elem = event.target;
                var isControl = false;
                if (document.URL.indexOf('www.youtube.com/watch') != -1) {
                    do {
                        isControl = (elem.classList &&
                            elem.classList.contains('html5-video-controls'));
                        if (isControl) break;
                    } while (elem = elem.parentNode);
                }
                return isControl;
            }

            var requestFrame = (function() {
                return (window.requestAnimationFrame ||
                    window.webkitRequestAnimationFrame ||
                    window.mozRequestAnimationFrame ||
                    function(callback, element, delay) {
                        window.setTimeout(callback, delay || (1000 / 60));
                    });
            })();

            var MutationObserver = (window.MutationObserver ||
                window.WebKitMutationObserver ||
                window.MozMutationObserver);

            var getScrollRoot = (function() {
                var SCROLL_ROOT;
                return function() {
                    if (!SCROLL_ROOT) {
                        var dummy = document.createElement('div');
                        dummy.style.cssText = 'height:10000px;width:1px;';
                        document.body.appendChild(dummy);
                        var bodyScrollTop = document.body.scrollTop;
                        var docElScrollTop = document.documentElement.scrollTop;
                        window.scrollBy(0, 1);
                        if (document.body.scrollTop != bodyScrollTop)
                            (SCROLL_ROOT = document.body);
                        else
                            (SCROLL_ROOT = document.documentElement);
                        window.scrollBy(0, -1);
                        document.body.removeChild(dummy);
                    }
                    return SCROLL_ROOT;
                };
            })();


            /***********************************************
             * PULSE (by Michael Herf)
             ***********************************************/

            /**
             * Viscous fluid with a pulse for part and decay for the rest.
             * - Applies a fixed force over an interval (a damped acceleration), and
             * - Lets the exponential bleed away the velocity over a longer interval
             * - Michael Herf, http://stereopsis.com/stopping/
             */
            function pulse_(x) {
                var val, start, expx;
                // test
                x = x * options.pulseScale;
                if (x < 1) { // acceleartion
                    val = x - (1 - Math.exp(-x));
                } else { // tail
                    // the previous animation ended here:
                    start = Math.exp(-1);
                    // simple viscous drag
                    x -= 1;
                    expx = 1 - Math.exp(-x);
                    val = start + (expx * (1 - start));
                }
                return val * options.pulseNormalize;
            }

            function pulse(x) {
                if (x >= 1) return 1;
                if (x <= 0) return 0;

                if (options.pulseNormalize == 1) {
                    options.pulseNormalize /= pulse_(1);
                }
                return pulse_(x);
            }

            var userAgent = window.navigator.userAgent;
            var isEdge = /Edge/.test(userAgent); // thank you MS
            var isChrome = /chrome/i.test(userAgent) && !isEdge;
            var isSafari = /safari/i.test(userAgent) && !isEdge;
            var isMobile = /mobile/i.test(userAgent);
            var isEnabledForBrowser = (isChrome || isSafari) && !isMobile;

            var wheelEvent;
            if ('onwheel' in document.createElement('div'))
                wheelEvent = 'wheel';
            else if ('onmousewheel' in document.createElement('div'))
                wheelEvent = 'mousewheel';

            if (wheelEvent && isEnabledForBrowser) {
                addEvent(wheelEvent, wheel);
                addEvent('mousedown', mousedown);
                addEvent('load', init);
            }

        })();

    }

})(jQuery);