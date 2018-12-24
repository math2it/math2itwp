<?php

/**
 * Wrapper function for __()
 *
 * It checks if specific text is translated via options panel
 * If option is set, it returns translated text from theme options
 * If option is not set, it returns default translation string (from language file)
 *
 * @param string  $string_key Key name (id) of translation option
 * @return string Returns translated string
 * @since  1.0
 */

if ( !function_exists( '__herald' ) ):
	function __herald( $string_key ) {
		if ( ( $translated_string = herald_get_option( 'tr_'.$string_key ) ) && herald_get_option( 'enable_translate' ) ) {

			if ( $translated_string == '-1' ) {
				return "";
			}

			return $translated_string;

		} else {

			$translate = herald_get_translate_options();
			return $translate[$string_key]['text'];
		}
	}
endif;



/**
 * Get featured image
 *
 * Function gets featured image depending on the size and post id.
 * If image is not set, it gets the default featured image placehloder from theme options.
 *
 * @param string  $size               Image size ID
 * @param int     $post_id            Post ID - if not passed it gets current post id by default
 * @param bool    $ignore_default_img Wheter to apply default featured image post doesn't have featured image
 * @return string Image HTML output
 * @since  1.0
 */

if ( !function_exists( 'herald_get_featured_image' ) ):
	function herald_get_featured_image( $size = 'large', $post_id = false, $ignore_default_img = false, $ignore_size_suffix = false ) {

		global $herald_sidebar_opts, $herald_img_flag, $herald_image_matches;

		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		//Check if we need to force "full" or "with sidebar" size
		if ( (!$ignore_size_suffix && $herald_img_flag == 'full') || ( !$ignore_size_suffix && $herald_sidebar_opts['use_sidebar'] == 'none' && $herald_img_flag != 'sid' ) ) {
			$size .= '-full';
		}


		if( get_post_type() == 'attachment'){
			return '<img src="'.esc_attr( wp_get_attachment_url( $post_id ) ).'" alt="'.esc_attr( get_the_title( $post_id ) ).'" />';
		}

		//Check if has a matched image size
		if ( !empty( $herald_image_matches ) && array_key_exists( $size, $herald_image_matches ) ) {
			$size = $herald_image_matches[$size];
		}

		if ( has_post_thumbnail( $post_id ) ) {

			return get_the_post_thumbnail( $post_id, $size );

		} else if ( !$ignore_default_img && ( $placeholder = herald_get_option( 'default_fimg' ) ) ) {

				//If there is no featured image, try to get default from theme options
				
				global $placeholder_img, $placeholder_imgs;

				if ( empty( $placeholder_img ) ) {
					$img_id = herald_get_image_id_by_url( $placeholder );
				} else {
					$img_id = $placeholder_img;
				}

				if ( !empty( $img_id ) ) {
					if ( !isset( $placeholder_imgs[$size] ) ) {
						$def_img = wp_get_attachment_image( $img_id, $size );
					} else {
						$def_img = $placeholder_imgs[$size];
					}

					if ( !empty( $def_img ) ) {
						$placeholder_imgs[$size] = $def_img;
						return $def_img;
					}
				}

				return '<img src="'.esc_attr( $placeholder ).'" alt="'.esc_attr( get_the_title( $post_id ) ).'" />';
			}

		return false;
	}
endif;


/**
 * Get post categories
 *
 * Function gets categories for current post and displays and slightly modifies
 * HTML output of category list so we can have category id in class parameter
 *
 * @return string HTML output of category links
 * @since  1.0
 */

if ( !function_exists( 'herald_get_category' ) ):
	function herald_get_category() {
		global $post;

		$primary_category = !is_single() && herald_is_yoast_active() ? herald_get_option('primary_category') : false;
		$primary_term_id = $primary_category ? get_post_meta( $post->ID, '_yoast_wpseo_primary_category', true ) : false;

		if ( $primary_category && isset($primary_term_id) && !empty($primary_term_id) ) {

			$term = get_term( $primary_term_id );
	
			if(!is_wp_error( $term ) && !empty($term)){
				return '<a href="'.esc_url( get_term_link( $term->term_id ) ).'" class="herald-cat-'.$term->term_id.'">'.$term->name.'</a>';
			}

			return '';

		} else { 
						
			$output = array();
			$taxs = array();
			$taxonomies = get_post_taxonomies( $post->ID );

			if ( !empty( $taxonomies ) ) {

				foreach ( $taxonomies as $tax ) {
					if ( is_taxonomy_hierarchical( $tax ) ) {
						$terms = get_the_terms( $post->ID,  $tax );
						if ( !empty( $terms ) ) {
							$taxs[] = $terms;
						}

					}
				}
			}

			if ( !empty( $taxs ) ) {

				foreach ( $taxs as $tax ) {
					if ( !empty( $tax ) ) {
						foreach ( $tax as $term ) {
							$output[] = '<a href="'.esc_url( get_term_link( $term->term_id ) ).'" class="herald-cat-'.$term->term_id.'">'.$term->name.'</a>';
						}
					}
				}

				if ( !empty( $output ) ) {
					$output = implode( ' <span>&bull;</span> ', $output );
					return $output;
				}
			}

		} 

		return "";
	}
endif;


/**
 * Get post meta data
 *
 * Function outputs meta data HTML based on theme options for specifi layout
 *
 * @param string  $layout     Layout ID
 * @param array   $force_meta Force specific meta instead of using options
 * @return string HTML output of meta data
 * @since  1.0
 */

if ( !function_exists( 'herald_get_meta_data' ) ):
	function herald_get_meta_data( $layout = 'a', $force_meta = false ) {

		$meta_data = $force_meta !== false ? $force_meta : array_keys( array_filter( herald_get_option( 'lay_'.$layout .'_meta' ) ) );

		$output = '';

		if ( !empty( $meta_data ) ) {

			$has_time = in_array( 'time', $meta_data ) ? true : false;
			$has_date = in_array( 'date', $meta_data ) ? true : false;
			$time_added = false;

			foreach ( $meta_data as $mkey ) {

				$meta = '';

				switch ( $mkey ) {

				case 'date':

					if ( $has_time ) {
						$time = ' '.get_the_time();
						$time_added = true;
					} else {
						$time = '';
					}

					$meta = '<span class="updated">'.get_the_date().$time.'</span>';
					break;

				case 'modified_date':

					if ( $has_time ) {
						$time = ' '.get_the_modified_time();
						$time_added = true;
					} else {
						$time = '';
					}

					$meta = '<span class="updated">'.get_the_modified_date().$time.'</span>';
					break;

				case 'time':
					if ( !$time_added && !$has_date ) {
						$meta = '<span class="updated">'.get_the_time().'</span>';
					}
					break;

				case 'author':
					if ( herald_is_co_authors_active() && $coauthors_meta = get_coauthors() ) {
						$temp = '';
						foreach ( $coauthors_meta as $key ) {
							$temp .= '<span class="vcard author"><span class="fn"><a href="'.esc_url( get_author_posts_url( $key->ID, $key->user_nicename ) ).'">'.$key->display_name.'</a></span></span>';
						}
						$multi_class = count( $coauthors_meta ) > 1 ? "couauthors-icon" : '';
						$meta = '<div class="coauthors '.esc_attr( $multi_class ).'">'.$temp.'</div>';


					} else {
						$author_id = get_post_field( 'post_author', get_the_ID() );
						$meta = '<span class="vcard author"><span class="fn"><a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ).'">'.get_the_author_meta( 'display_name', $author_id ).'</a></span></span>';
					}
					break;

				case 'views':
					global $wp_locale;
					$thousands_sep = isset( $wp_locale->number_format['thousands_sep'] ) ? $wp_locale->number_format['thousands_sep'] : ',';
					if ( strlen( $thousands_sep ) > 1 ) {
						$thousands_sep = trim( $thousands_sep );
					}
					$meta = function_exists( 'ev_get_post_view_count' ) ?  number_format_i18n( absint( str_replace( $thousands_sep, '', ev_get_post_view_count( get_the_ID() ) ) + absint( herald_get_option( 'views_forgery' ) ) ) )  . ' '.__herald( 'views' ) : '';
					break;

				case 'rtime':
					$meta = herald_read_time( get_post_field( 'post_content', get_the_ID() ) );
					if ( !empty( $meta ) ) {
						$meta .= ' '.__herald( 'min_read' );
					}
					break;

				case 'comments':
					if ( comments_open() || get_comments_number() ) {
						ob_start();
						comments_popup_link( __herald( 'no_comments' ), __herald( 'one_comment' ), __herald( 'multiple_comments' ) );
						$meta = ob_get_contents();
						ob_end_clean();
					} else {
						$meta = '';
					}
					break;

				case 'reviews':
					$meta = '';
					if ( herald_is_wp_review_active() ) {
						$meta = function_exists( 'wp_review_show_total' ) ? wp_review_show_total( false, '' ) : '';
					}
					break;

				default:
					break;
				}

				if ( !empty( $meta ) ) {
					$output .= '<div class="meta-item herald-'.$mkey.'">'.$meta.'</div>';
				}
			}
		}


		return $output;

	}
endif;


/**
 * Get post excerpt
 *
 * Function outputs post excerpt for specific layout
 *
 * @param string  $layout     Layout ID
 * @param string  $force_meta Force specific meta instead of using options for layout
 * @return string HTML output of category links
 * @since  1.0
 */

if ( !function_exists( 'herald_get_excerpt' ) ):
	function herald_get_excerpt( $layout = 'a' ) {

		$manual_excerpt = false;

		if ( has_excerpt() ) {
			$content =  get_the_excerpt();
			$manual_excerpt = true;
		} else {
			$text = get_the_content( '' );
			$text = strip_shortcodes( $text );
			$text = apply_filters( 'the_content', $text );
			$content = str_replace( ']]>', ']]&gt;', $text );
		}


		if ( !empty( $content ) ) {
			$limit = herald_get_option( 'lay_'.$layout.'_excerpt_limit' );
			if ( !empty( $limit ) || !$manual_excerpt ) {
				$more = herald_get_option( 'more_string' );
				$content = wp_strip_all_tags( $content );
				$content = preg_replace( '/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $content );
				$content = herald_trim_chars( $content, $limit, $more );
			}
			return wpautop( $content );
		}

		return '';

	}
endif;


/**
 * Get archive heading
 *
 * Function gets title and description for current template
 *
 * @return string Uses herald_print_heading() to generate HTML output
 * @since  1.0
 */

if ( !function_exists( 'herald_get_archive_heading' ) ):
	function herald_get_archive_heading() {
		if ( is_category() ) {

			$obj = get_queried_object();

			$args['title'] = __herald( 'category' ).single_cat_title( '', false );
			
			$args['desc'] = herald_get_option( 'category_desc' ) ? category_description() : '';
			$args['cat'] = $obj->term_id;

			if ( herald_get_option( 'category_sub' ) ) {

				$sub = get_categories( array( 'parent' => $obj->term_id, 'hide_empty' => false ) );

				if ( !empty( $sub ) ) {
					$args['subnav'] = '';
					foreach ( $sub as $child ) {
						$args['subnav'] .= '<a href="'.esc_url( get_category_link( $child ) ).'">'.$child->name.'</a>';
					}
					$args['title'] .= '<i class="fa fa-angle-down herald-sub-cat-icon" aria-hidden="true"></i><div class="herald-mod-subnav-mobile">'.$args['subnav'].'</div>';
				}

				if ( !empty( $obj->parent ) ) {
					$parent = get_category( $obj->parent );
					$args['actions'] = '<a href="'.esc_url( get_category_link( $parent->term_id ) ).'">'.$parent->name.'</a>';
				}


			}

			

		} else if ( is_author() ) {

				$obj = get_queried_object();

				if ( empty( $obj ) ) {
					global $author;
					$obj = isset( $_GET['author_name'] ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) );
				}

				if ( herald_is_co_authors_active() ) {

					$args['title'] = __herald( 'author' ).$obj->display_name;

					if ( herald_get_option( 'author_desc' ) ) {
						$args['desc'] = wpautop( get_avatar( $obj->user_email, 80 ) . get_the_author_meta( 'description' ) );
					}

					if ( herald_get_option( 'author_social' ) ) {
						$args['subnav'] = herald_get_author_social( $obj->ID );
					}
				} else {

					$args['title'] = __herald( 'author' ).$obj->display_name;

					if ( herald_get_option( 'author_desc' ) ) {
						$args['desc'] = wpautop( get_avatar( $obj->ID, 80 ) . get_the_author_meta( 'description', $obj->ID ) );
					}

					if ( herald_get_option( 'author_social' ) ) {
						$args['subnav'] = herald_get_author_social( $obj->ID );
					}
				}

			} else if ( is_tax() ) {
				$args['title'] = single_term_title( '', false );
			} else if ( is_home() && ( $posts_page = get_option( 'page_for_posts' ) ) && !is_page_template( 'template-modules.php' ) ) {
				$args['title'] = get_the_title( $posts_page );
			} else if ( is_search() ) {
				$args['title'] = __herald( 'search_results_for' ).get_search_query();
				$args['desc'] = get_search_form( false );
			} else if ( is_tag() ) {
				$args['title'] = __herald( 'tag' ).single_tag_title( '', false );
				$args['desc'] = tag_description();
			} else if ( is_day() ) {
				$args['title'] = __herald( 'archive' ).get_the_date();
			} else if ( is_month() ) {
				$args['title'] = __herald( 'archive' ).get_the_date( 'F Y' );
			} else if ( is_year() ) {
				$args['title'] = __herald( 'archive' ).get_the_date( 'Y' );
			} else {
			$args['title'] = '';
			$args['desc'] = '';
		}

		if ( !empty( $args['title'] ) ) {
			$args['title'] = '<h1 class="h6 herald-mod-h herald-color">'.$args['title'].'</h1>';
		}

		if ( !empty( $args['desc'] ) ) {
			$args['desc'] = wpautop( $args['desc'] );
		}

		return herald_print_heading( $args );
	}
endif;


/**
 * Get post format icon
 *
 * Checks format of current post and returns icon class.
 *
 * @return string Icon HTML output
 * @since  1.0
 */

if ( !function_exists( 'herald_post_format_icon' ) ):
	function herald_post_format_icon() {

		$format = get_post_format();

		$icons = array(
			'video' => 'fa-play',
			'audio' => 'fa-volume-up',
			'image' => 'fa-picture-o',
			'gallery' => 'fa-camera'
		);

		//Allow plugins or child themes to modify icons
		$icons = apply_filters( 'herald_post_format_icons', $icons );

		if ( $format && array_key_exists( $format, $icons ) ) {

			return '<span class="herald-format-icon"><i class="fa '.esc_attr( $icons[$format] ).'"></i></span>';
		}

		return '';
	}
endif;


/**
 * Get post display option
 *
 * Checks if specific option is ovewritten in single post
 * so we know if we pull this options from global options or particular post
 *
 * @param string  $option  Option id string
 * @param int     $post_id
 * @return mixed Option value
 * @since  1.3
 */

if ( !function_exists( 'herald_get_post_display' ) ):
	function herald_get_post_display( $option = false, $post_id = false ) {

		if ( empty( $option ) ) {
			return false;
		}

		if ( !$post_id ) {
			$post_id = get_the_ID();
		}

		$meta = herald_get_post_meta( $post_id, 'display' );

		if ( in_array( $option, array( 'ad_below', 'ad_above' ) ) ) {
			return $meta[$option];
		}

		if ( array_key_exists( $option, $meta ) ) {
			$value = $meta[$option] == 'inherit' ? herald_get_option( 'single_'.$option ) : $meta[$option];
			return $value;
		}

		return false;
	}
endif;


/**
 * Get single post content class
 *
 * Checks if meta bar is enabled and returns proper Bootstrap wrapper classes
 *
 * @return string Output of classes
 * @since  1.4
 */

if ( !function_exists( 'herald_single_content_class' ) ):
	function herald_single_content_class() {
		$meta_bar_position = herald_get_single_meta_bar_position();
		return $meta_bar_position != 'none' ? 'col-lg-10 col-md-10 col-sm-10' : 'col-lg-12 col-md-12 col-sm-12';
	}
endif;


/**
 * Breadcrumbs
 *
 * @param bool    $echo Whether to output HTML or not
 * @return string|void Return or echo HTML output
 * @since  1.4
 */

if ( !function_exists( 'herald_breadcrumbs' ) ):
	function herald_breadcrumbs( $echo = true ) {
		$breadcrumbs = '';

		if ( function_exists( 'yoast_breadcrumb' ) ) {
			$breadcrumbs = yoast_breadcrumb( '<div id="herald-breadcrumbs" class="herald-breadcrumbs">', '</div>', false );
		}

		if ( $echo ) {
			echo $breadcrumbs;
		} else {
			return $breadcrumbs;
		}

	}
endif;

/**
 * Return category image or if is not set category image return last post feature image
 *
 * @since  2.1
 *
 * @return mixed html 
 */

if ( !function_exists('herald_get_category_featured_image') ) :
	function herald_get_category_featured_image($size, $cat_id){
		
		global $herald_sidebar_opts, $herald_img_flag, $herald_image_matches;
		
		if ( empty( $cat_id ) ) {
			$cat_id = get_queried_object_id();
		}

		if ( $herald_img_flag == 'full' || ( $herald_sidebar_opts['use_sidebar'] == 'none' && $herald_img_flag != 'sid' ) ) {
			$size .= '-full';
		}
		
		if ( !empty( $herald_image_matches ) && array_key_exists( $size, $herald_image_matches ) ) {
			$size = $herald_image_matches[$size];
		}

		$img_url = herald_get_category_meta( $cat_id, 'image' );

		$img_html = '';

        if ( !empty( $img_url ) ) {
            $img_id = herald_get_image_id_by_url( $img_url );
            $img_html = wp_get_attachment_image( $img_id, $size );
            if ( empty( $img_html ) ) {
                $img_html = '<img src="'.esc_url( $img_url ).'"/>';
            }
        }
		
        if ( empty( $img_html )  ) {
			$first_post = herald_get_first_post_in_category($cat_id);
			$post_id = false;
			if (!empty($first_post) && isset($first_post->ID)) {
				$post_id = $first_post->ID;
			}  
			$img_html = herald_get_featured_image( $size, $post_id, false, true);
        }

        return wp_kses_post( $img_html );
	}
endif;

/**
 * Return author social links
 *
 * @since  2.1
 *
 * @param int $author_id
 * @return mixed html 
 */

if ( !function_exists('herald_get_author_social_links') ) :
	function herald_get_author_social_links($author_id){
		
		if ( empty($author_id) ) {
			return false;
		}

		$output = '';

		$social_links = array_filter( herald_get_option('single_author_social_links') );

		
		if ( empty($social_links) ) {
			return $output;
		}

		foreach ( $social_links as $key => $value ) {

			$social_url = get_the_author_meta( $key, $author_id );
			
			if ( empty($social_url) ) {
				continue;
			}

			
			$pos = strpos( $social_url, '@');

			switch ($key) {
				case 'twitter':
					if ($pos !== false){
						$social_url = 'https://twitter.com/'.substr( $social_url, $pos, strlen( $social_url ) );
					}
					$output .= '<a class="herald-author-twitter" href="'.esc_url( $social_url ).'" target="_blank">'.basename($social_url).'</a>';
					break;

				case 'facebook':
					$output .= '<a class="herald-author-twitter herald-author-'.esc_attr($key).'" href="'.esc_url( $social_url ).'" target="_blank">'.basename($social_url).'</a>';
					break;

				case 'instagram':
					if ($pos !== false){
						$social_url = 'https://instagram.com/'.substr( $social_url, 1 );
					}
					$output .= '<a class="herald-author-twitter herald-author-'.esc_attr($key).'" href="'.esc_url( $social_url ).'" target="_blank">'.basename( $social_url ).'</a>';
					break;
				
				default:
					break;
			}
			
		}

		return $output;
	}
endif;

/**
 * Display ads
 *
 * @since  2.1
 *
 * @return boolean
 */
if(!function_exists('herald_can_display_ads')):
    function herald_can_display_ads(){
		if(is_404() && herald_get_option('ad_exclude_404')){
			return false;
		}
		
		$exclude_ids_option = herald_get_option('ad_exclude_from_pages');
	    $exclude_ids = !empty($exclude_ids_option) ? $exclude_ids_option : array();
	
		if(is_page() && in_array(get_queried_object_id(), $exclude_ids)){
			return false;
		}
		
		return true;
    }
endif;

/**
 * Check if post or page are using clear blur
 *
 * @since  2.1
 * @return boolean
 */
if(!function_exists('herald_has_clear_blur')):
    function herald_has_clear_blur(){
	
		if(get_page_template_slug() == 'template-full-width.php'){
			return false;
		}
		
		if(is_page()){
			$layout = herald_get_page_layout();
			
			if(in_array($layout, array('3', '6'))){
				return true;
			}
		}
		
		if(is_single()){
			$layout = herald_get_single_layout();
			
			if(in_array($layout, array('3', '6', '9'))){
				return true;
			}
		}
		
		return false;
    }
endif;
?>
