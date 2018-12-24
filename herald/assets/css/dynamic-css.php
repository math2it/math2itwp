<?php 

/* Font styles */
$main_font = herald_get_font_option( 'main_font' );
$h_font = herald_get_font_option( 'h_font' );
$nav_font = herald_get_font_option( 'nav_font' );

/* Font sizes */
$font_size_p = number_format( absint( herald_get_option( 'font_size_p' ) ) / 10, 1 );
$font_size_excerpt_text = number_format( absint( herald_get_option( 'font_size_excerpt_text' ) ) / 10, 1 );
$font_size_meta_data_smaller = number_format( absint( herald_get_option( 'font_size_meta_data_smaller' ) ) / 10, 1 );
$font_size_meta_data_bigger = number_format( absint( herald_get_option( 'font_size_meta_data_bigger' ) ) / 10, 1 );
$font_size_h1 = number_format( absint( herald_get_option( 'font_size_h1' ) ) / 10, 1 );
$font_size_h2 = number_format( absint( herald_get_option( 'font_size_h2' ) ) / 10, 1 );
$font_size_h3 = number_format( absint( herald_get_option( 'font_size_h3' ) ) / 10, 1 );
$font_size_h4 = number_format( absint( herald_get_option( 'font_size_h4' ) ) / 10, 1 );
$font_size_h5 = number_format( absint( herald_get_option( 'font_size_h5' ) ) / 10, 1 );
$font_size_h6 = number_format( absint( herald_get_option( 'font_size_h6' ) ) / 10, 1 );
$font_size_h7 = number_format( absint( herald_get_option( 'font_size_h7' ) ) / 10, 1 );
$font_size_small = number_format( absint( herald_get_option( 'font_size_small' ) ) / 10, 1 );
$font_size_nav = number_format( absint( herald_get_option( 'font_size_nav' ) ) / 10, 1 );
$font_size_widget_and_module_title= number_format( absint( herald_get_option( 'font_size_widget_and_module_title' ) ) / 10, 1 );

/* Top header styles */
$color_header_top_bg = esc_attr(herald_get_option( 'color_header_top_bg' ));
$color_header_top_txt = esc_attr(herald_get_option( 'color_header_top_txt' ));
$color_header_top_acc = esc_attr(herald_get_option( 'color_header_top_acc' ));

/* Middle header styles */
$color_header_middle_bg = esc_attr(herald_get_option( 'color_header_middle_bg' ));
$color_header_middle_txt = esc_attr(herald_get_option( 'color_header_middle_txt' ));
$color_header_middle_acc = esc_attr(herald_get_option( 'color_header_middle_acc' ));
$header_height = esc_attr(herald_get_option( 'header_height' ));

/* Bottom header styles */
$color_header_bottom_bg = esc_attr(herald_get_option( 'color_header_bottom_bg' ));
$color_header_bottom_txt = esc_attr(herald_get_option( 'color_header_bottom_txt' ));
$color_header_bottom_acc = esc_attr(herald_get_option( 'color_header_bottom_acc' ));

/* Sticky header styles */
$color_header_sticky_bg = esc_attr(herald_get_option( 'color_header_sticky_bg' ));
$color_header_sticky_txt = esc_attr(herald_get_option( 'color_header_sticky_txt' ));
$color_header_sticky_acc = esc_attr(herald_get_option( 'color_header_sticky_acc' ));

/* Trending header styles */
$color_header_trending_bg = esc_attr(herald_get_option( 'color_header_trending_bg' ));
$color_header_trending_txt = esc_attr(herald_get_option( 'color_header_trending_txt' ));
$color_header_trending_acc = esc_attr(herald_get_option( 'color_header_trending_acc' ));

$header_responsive_breakpoint = esc_attr(herald_get_option( 'header_responsive_breakpoint' ));


/* General styles */
$body_background = herald_get_bg_option('body_background');
$content_layout = herald_get_option('content_layout');
$color_content_bg = esc_attr(herald_get_option( 'color_content_bg' ));
$color_content_title = esc_attr(herald_get_option( 'color_content_title' ));
$color_content_txt = esc_attr(herald_get_option( 'color_content_txt' ));
$color_content_acc = esc_attr(herald_get_option( 'color_content_acc' ));
$color_content_meta = esc_attr(herald_get_option( 'color_content_meta' ));

/* Footer styles */
$color_footer_bg = esc_attr(herald_get_option( 'color_footer_bg' ));
$color_footer_acc = esc_attr(herald_get_option( 'color_footer_acc' ));
$color_footer_txt = esc_attr(herald_get_option( 'color_footer_txt' ));
$color_footer_meta = esc_attr(herald_get_option( 'color_footer_meta' ));
?>

/* Font sizes */
h1, .h1, .herald-no-sid .herald-posts .h2{ font-size: <?php echo $font_size_h1; ?>rem; }
h2, .h2, .herald-no-sid .herald-posts .h3{ font-size: <?php echo $font_size_h2; ?>rem; }
h3, .h3, .herald-no-sid .herald-posts .h4 { font-size: <?php echo $font_size_h3; ?>rem; }
h4, .h4, .herald-no-sid .herald-posts .h5 { font-size: <?php echo $font_size_h4; ?>rem; }
h5, .h5, .herald-no-sid .herald-posts .h6 { font-size: <?php echo $font_size_h5; ?>rem; }
h6, .h6, .herald-no-sid .herald-posts .h7 { font-size: <?php echo $font_size_h6; ?>rem; }
.h7 {
    font-size: <?php echo $font_size_h7; ?>rem;
}
.herald-entry-content, .herald-sidebar{
    font-size: <?php echo $font_size_p; ?>rem;
}
.entry-content .entry-headline{
    font-size: <?php echo $font_size_excerpt_text; ?>rem;
}
body{
    font-size: <?php echo $font_size_p; ?>rem;
}
.widget{
    font-size: <?php echo $font_size_small; ?>rem;
}
.herald-menu{
    font-size: <?php echo $font_size_nav; ?>rem;
}
.herald-mod-title .herald-mod-h, .herald-sidebar .widget-title{
    font-size: <?php echo $font_size_widget_and_module_title; ?>rem;
}
.entry-meta .meta-item, .entry-meta a, .entry-meta span{
    font-size: <?php echo $font_size_meta_data_bigger; ?>rem;
}
.entry-meta.meta-small .meta-item, .entry-meta.meta-small a, .entry-meta.meta-small span{
    font-size: <?php echo $font_size_meta_data_smaller; ?>rem;
}

/* Top header styles */
.herald-site-header .header-top,
.header-top .herald-in-popup,
.header-top .herald-menu ul {
	background: <?php echo $color_header_top_bg; ?>;
	color: <?php echo $color_header_top_txt; ?>;
}
.header-top a {
	color: <?php echo $color_header_top_txt; ?>;	
}
.header-top a:hover,
.header-top .herald-menu li:hover > a{
	color: <?php echo $color_header_top_acc; ?>;	
}
.header-top .herald-menu-popup:hover > span,
.header-top .herald-menu-popup-search span:hover,
.header-top .herald-menu-popup-search.herald-search-active{
	color: <?php echo $color_header_top_acc; ?>;	
}
#wp-calendar tbody td a{
	background: <?php echo $color_content_acc; ?>;
	color:#FFF;
}
.header-top .herald-login #loginform label,
.header-top .herald-login p,
.header-top a.btn-logout {
    color: <?php echo $color_header_top_acc; ?>;
}
.header-top .herald-login #loginform input {
	color: <?php echo $color_header_top_bg; ?>;
}
.header-top .herald-login .herald-registration-link:after {
	background: <?php echo herald_hex2rgba($color_header_top_acc, 0.25); ?>;
}
.header-top .herald-login #loginform input[type=submit],
.header-top .herald-in-popup .btn-logout {
	background-color: <?php echo $color_header_top_acc; ?>;
	color: <?php echo $color_header_top_bg; ?>;	
}
.header-top a.btn-logout:hover{
	color: <?php echo $color_header_top_bg; ?>;	
}

/* Middle header styles */

<?php if( $middle_bg = herald_get_bg_option('background_header_middle') ) : ?>
	.header-middle {
		<?php echo $middle_bg; ?>
	}
<?php endif; ?>

.header-middle{
	background-color: <?php echo $color_header_middle_bg; ?>;
	color: <?php echo $color_header_middle_txt; ?>;
}

.header-middle a{
	color: <?php echo $color_header_middle_txt; ?>;
}
.header-middle.herald-header-wraper,
.header-middle .col-lg-12{
	height: <?php echo $header_height; ?>px;	
}
.header-middle .site-title img{
	max-height: <?php echo $header_height; ?>px;
}

.header-middle .sub-menu{
	background-color: <?php echo $color_header_middle_txt; ?>;	
}
.header-middle .sub-menu a,
.header-middle .herald-search-submit:hover,
.header-middle li.herald-mega-menu .col-lg-3 a:hover,
.header-middle li.herald-mega-menu .col-lg-3 a:hover:after{
	color: <?php echo $color_header_middle_acc; ?>;
}

.header-middle .herald-menu li:hover > a,
.header-middle .herald-menu-popup-search:hover > span,
.header-middle .herald-cart-icon:hover > a
{
	color: <?php echo $color_header_middle_acc; ?>;
	background-color: <?php echo $color_header_middle_txt; ?>;
}
.header-middle .current-menu-parent a,
.header-middle .current-menu-ancestor a,
.header-middle .current_page_item > a,
.header-middle .current-menu-item > a{
	background-color: <?php echo herald_hex2rgba( $color_header_middle_txt , 0.2); ?>; 
}

.header-middle .sub-menu > li > a,
.header-middle .herald-search-submit,
.header-middle li.herald-mega-menu .col-lg-3 a{
	color: <?php echo herald_hex2rgba( $color_header_middle_acc , 0.7); ?>; 
}
.header-middle .sub-menu > li:hover > a{
	color: <?php echo $color_header_middle_acc; ?>; 
}
.header-middle .herald-in-popup{
	background-color: <?php echo $color_header_middle_txt; ?>;	
}
.header-middle .herald-menu-popup a{
	color: <?php echo $color_header_middle_acc; ?>;	
}
.header-middle .herald-in-popup{
	background-color: <?php echo $color_header_middle_txt; ?>;		
}
.header-middle .herald-search-input{
	color: <?php echo $color_header_middle_acc; ?>;	
}
.header-middle .herald-menu-popup a{
	color: <?php echo $color_header_middle_acc; ?>;	
}
.header-middle .herald-menu-popup > span,
.header-middle .herald-search-active > span{
	color: <?php echo $color_header_middle_txt; ?>;	
}
.header-middle .herald-menu-popup:hover > span,
.header-middle .herald-search-active > span{
	background-color: <?php echo $color_header_middle_txt; ?>;	
	color: <?php echo $color_header_middle_acc; ?>;	
}
.header-middle .herald-login #loginform label,
.header-middle .herald-login #loginform input,
.header-middle .herald-login p,
.header-middle a.btn-logout,
.header-middle .herald-login .herald-registration-link:hover,
.header-middle .herald-login .herald-lost-password-link:hover {
    color: <?php echo $color_header_middle_acc; ?>;
}
.header-middle .herald-login .herald-registration-link:after {
	background: <?php echo herald_hex2rgba($color_header_middle_acc, 0.15); ?>;
}
.header-middle .herald-login a,
.header-middle .herald-username a {
    color: <?php echo $color_header_middle_acc; ?>;
}
.header-middle .herald-login a:hover,
.header-middle .herald-login .herald-registration-link,
.header-middle .herald-login .herald-lost-password-link {
    color: <?php echo $color_header_middle_bg; ?>;
}
.header-middle .herald-login #loginform input[type=submit],
.header-middle .herald-in-popup .btn-logout {
	background-color: <?php echo $color_header_middle_bg; ?>;
	color: <?php echo $color_header_middle_txt; ?>;	
}
.header-middle a.btn-logout:hover{
	color: <?php echo $color_header_middle_txt; ?>;	
}



/* Bottom header styles */

.header-bottom{
	background: <?php echo $color_header_bottom_bg; ?>;
	color: <?php echo $color_header_bottom_txt; ?>;
}
.header-bottom a,
.header-bottom .herald-site-header .herald-search-submit{
	color: <?php echo $color_header_bottom_txt; ?>;
}
.header-bottom a:hover{
	color: <?php echo $color_header_bottom_acc; ?>;	
}

.header-bottom a:hover,
.header-bottom .herald-menu li:hover > a,
.header-bottom li.herald-mega-menu .col-lg-3 a:hover:after{
	color: <?php echo $color_header_bottom_acc; ?>;	
}


.header-bottom .herald-menu li:hover > a,
.header-bottom .herald-menu-popup-search:hover > span,
.header-bottom .herald-cart-icon:hover > a {
	color: <?php echo $color_header_bottom_acc; ?>;
	background-color: <?php echo $color_header_bottom_txt; ?>;
}
.header-bottom .current-menu-parent a,
.header-bottom .current-menu-ancestor a,
.header-bottom .current_page_item > a,
.header-bottom .current-menu-item > a {
	background-color: <?php echo herald_hex2rgba( $color_header_bottom_txt , 0.2); ?>; 
}
.header-bottom .sub-menu{
	background-color: <?php echo $color_header_bottom_txt; ?>;	
}
.header-bottom .herald-menu li.herald-mega-menu .col-lg-3 a,
.header-bottom .sub-menu > li > a,
.header-bottom .herald-search-submit{
	color: <?php echo herald_hex2rgba( $color_header_bottom_acc , 0.7); ?>; 
}
.header-bottom .herald-menu li.herald-mega-menu .col-lg-3 a:hover,
.header-bottom .sub-menu > li:hover > a{
	color: <?php echo $color_header_bottom_acc; ?>; 
}

.header-bottom .sub-menu > li > a,
.header-bottom .herald-search-submit{
	color: <?php echo herald_hex2rgba( $color_header_bottom_acc , 0.7); ?>; 
}
.header-bottom .sub-menu > li:hover > a{
	color: <?php echo $color_header_bottom_acc; ?>; 
}

.header-bottom .herald-in-popup {
	background-color: <?php echo $color_header_bottom_txt; ?>;	
}
.header-bottom .herald-menu-popup a {
	color: <?php echo $color_header_bottom_acc; ?>;	
}

.header-bottom .herald-in-popup,
.header-bottom .herald-search-input {
	background-color: <?php echo $color_header_bottom_txt; ?>;		
}
.header-bottom .herald-menu-popup a,
.header-bottom .herald-search-input{
	color: <?php echo $color_header_bottom_acc; ?>;	
}
.header-bottom .herald-menu-popup > span,
.header-bottom .herald-search-active > span{
	color: <?php echo $color_header_bottom_txt; ?>;	
}
.header-bottom .herald-menu-popup:hover > span,
.header-bottom .herald-search-active > span{
	background-color: <?php echo $color_header_bottom_txt; ?>;	
	color: <?php echo $color_header_bottom_acc; ?>;	
}
.header-bottom .herald-login #loginform label,
.header-bottom .herald-login #loginform input,
.header-bottom .herald-login p,
.header-bottom a.btn-logout,
.header-bottom .herald-login .herald-registration-link:hover,
.header-bottom .herald-login .herald-lost-password-link:hover {
    color: <?php echo $color_header_bottom_acc; ?>;
}
.header-bottom .herald-login .herald-registration-link:after {
	background: <?php echo  herald_hex2rgba( $color_header_bottom_acc, 0.15 ); ?>;
}
.header-bottom .herald-login a {
    color: <?php echo $color_header_bottom_acc; ?>;
}
.header-bottom .herald-login a:hover,
.header-bottom .herald-login .herald-registration-link,
.header-bottom .herald-login .herald-lost-password-link {
    color: <?php echo $color_header_bottom_bg; ?>;
}
.header-bottom .herald-login #loginform input[type=submit],
.header-bottom .herald-in-popup .btn-logout {
	background-color: <?php echo $color_header_bottom_bg; ?>;
	color: <?php echo $color_header_bottom_txt; ?>;	
}
.header-bottom a.btn-logout:hover{
	color: <?php echo $color_header_bottom_txt; ?>;	
}

/* Sticky header styles */

.herald-header-sticky{
	background: <?php echo $color_header_sticky_bg; ?>;
	color: <?php echo $color_header_sticky_txt; ?>;
}
.herald-header-sticky a{
	color: <?php echo $color_header_sticky_txt; ?>;
}

.herald-header-sticky .herald-menu li:hover > a{
	color: <?php echo $color_header_sticky_acc; ?>;
	background-color: <?php echo $color_header_sticky_txt; ?>;
}
.herald-header-sticky .sub-menu{
	background-color: <?php echo $color_header_sticky_txt; ?>;	
}
.herald-header-sticky .sub-menu a{
	color: <?php echo $color_header_sticky_acc; ?>;
}
.herald-header-sticky .sub-menu > li:hover > a{
	color: <?php echo $color_header_sticky_bg; ?>;
}

.herald-header-sticky .herald-in-popup,
.herald-header-sticky .herald-search-input {
	background-color: <?php echo $color_header_sticky_txt; ?>;		
}
.herald-header-sticky .herald-menu-popup a{
	color: <?php echo $color_header_sticky_acc; ?>;	
}
.herald-header-sticky .herald-menu-popup > span,
.herald-header-sticky .herald-search-active > span{
	color: <?php echo $color_header_sticky_txt; ?>;	
}
.herald-header-sticky .herald-menu-popup:hover > span,
.herald-header-sticky .herald-search-active > span{
	background-color: <?php echo $color_header_sticky_txt; ?>;	
	color: <?php echo $color_header_sticky_acc; ?>;	
}
.herald-header-sticky .herald-search-input,
.herald-header-sticky .herald-search-submit{
	color: <?php echo $color_header_sticky_acc; ?>;
}

.herald-header-sticky .herald-menu li:hover > a,
.herald-header-sticky .herald-menu-popup-search:hover > span,
.herald-header-sticky .herald-cart-icon:hover a {
	color: <?php echo $color_header_sticky_acc; ?>;
	background-color: <?php echo $color_header_sticky_txt; ?>;
}

.herald-header-sticky .herald-login #loginform label,
.herald-header-sticky .herald-login #loginform input,
.herald-header-sticky .herald-login p,
.herald-header-sticky a.btn-logout,
.herald-header-sticky .herald-login .herald-registration-link:hover,
.herald-header-sticky .herald-login .herald-lost-password-link:hover {
    color: <?php echo $color_header_sticky_acc; ?>;
}
.herald-header-sticky .herald-login .herald-registration-link:after {
	background: <?php echo  herald_hex2rgba( $color_header_sticky_acc, 0.15 ); ?>;
}
.herald-header-sticky .herald-login a {
    color: <?php echo $color_header_sticky_acc; ?>;
}
.herald-header-sticky .herald-login a:hover,
.herald-header-sticky .herald-login .herald-registration-link,
.herald-header-sticky .herald-login .herald-lost-password-link {
    color: <?php echo $color_header_sticky_bg; ?>;
}
.herald-header-sticky .herald-login #loginform input[type=submit],
.herald-header-sticky .herald-in-popup .btn-logout {
	background-color: <?php echo $color_header_sticky_bg; ?>;
	color: <?php echo $color_header_sticky_txt; ?>;
}
.herald-header-sticky a.btn-logout:hover{
	color: <?php echo $color_header_sticky_txt; ?>;	
}

/* Header trending */

.header-trending{
	background: <?php echo $color_header_trending_bg; ?>;
	color: <?php echo $color_header_trending_txt; ?>;
}

.header-trending a{
	color: <?php echo $color_header_trending_txt; ?>;
}

.header-trending a:hover{
	color: <?php echo $color_header_trending_acc; ?>;	
}




<?php 

	/* Dynamic border smart :) */

	$header_sections = array_keys( array_filter( herald_get_option('header_sections') ) );	
	if(!empty($header_sections)) {
		foreach($header_sections as $i => $section ){
			if( $i ){
				$bg1 = herald_get_option('color_header_'.$section.'_bg');
				$bg2 = herald_get_option('color_header_'.$prev.'_bg');
				if($bg1 == $bg2){
					echo '.header-'.$section.'{ border-top: 1px solid '.herald_hex2rgba(herald_get_option('color_header_'.$section.'_txt'), 0.15).';}';
				}
			}

			$prev = $section;

			if( ($i + 1) == count( $header_sections )){
				//check last section
				$last_bg = herald_get_option('color_header_'.$section.'_bg');
				if( $last_bg == $color_content_bg ){
					echo '.header-'.$section.'{ border-bottom: 1px solid '.herald_hex2rgba(herald_get_option('color_header_'.$section.'_txt'), 0.15).';}';
				}

				if( $content_layout == 'boxed' ){
					$body_styles = herald_get_option('body_background');
					$body_bg = isset($body_styles['background-color']) ? $body_styles['background-color'] : false;
					if( $last_bg == $body_bg ){
						echo '.herald-site-content { margin-top: 1px; }';
					}
				}
			}
		}

	}


?>

body {
  <?php if( $content_layout == 'boxed') : ?>
		<?php echo $body_background; ?>
	<?php else: ?> 
		background-color: <?php echo $color_content_bg; ?>;
  	<?php endif; ?>
  color: <?php echo $color_content_txt; ?>;
  font-family: <?php echo $main_font['font-family']; ?>;
  font-weight: <?php echo $main_font['font-weight']; ?>;
  <?php if ( isset( $main_font['font-style'] ) && !empty( $main_font['font-style'] ) ):?>
  font-style: <?php echo $main_font['font-style']; ?>;
  <?php endif; ?>
}

.herald-site-content{
	background-color:  <?php echo $color_content_bg; ?>;
	<?php if( $content_layout == 'boxed') : ?>
	 box-shadow: 0 0 0 1px <?php echo herald_hex2rgba( $color_content_txt, 0.1); ?>;
	<?php endif; ?>
}

/* Typography styles */

h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6, .h7{
  font-family: <?php echo $h_font['font-family']; ?>;
  font-weight: <?php echo $h_font['font-weight']; ?>;
  <?php if ( isset( $h_font['font-style'] ) && !empty( $h_font['font-style'] ) ):?>
  font-style: <?php echo $h_font['font-style']; ?>;
  <?php endif; ?>
}
.header-middle .herald-menu,
.header-bottom .herald-menu,
.herald-header-sticky .herald-menu,
.herald-mobile-nav{
  font-family: <?php echo $nav_font['font-family']; ?>;
  font-weight: <?php echo $nav_font['font-weight']; ?>;
  <?php if ( isset( $nav_font['font-style'] ) && !empty( $nav_font['font-style'] ) ):?>
  font-style: <?php echo $nav_font['font-style']; ?>;
  <?php endif; ?>
}
.herald-menu li.herald-mega-menu .herald-ovrld .meta-category a{
  font-family: <?php echo $main_font['font-family']; ?>;
  font-weight: <?php echo $main_font['font-weight']; ?>;
  <?php if ( isset( $main_font['font-style'] ) && !empty( $main_font['font-style'] ) ):?>
  font-style: <?php echo $main_font['font-style']; ?>;
  <?php endif; ?>	
}
.herald-entry-content blockquote p{
	color: <?php echo $color_content_acc; ?>;
}
pre {
	background: <?php echo herald_hex2rgba( $color_content_txt , 0.06); ?>;
	border: 1px solid <?php echo herald_hex2rgba( $color_content_txt , 0.2); ?>;
}
thead {
    background: <?php echo herald_hex2rgba( $color_content_txt , 0.06); ?>;
}

/* General styles */
a,
.entry-title a:hover,
.herald-menu .sub-menu li .meta-category a{
	color: <?php echo $color_content_acc; ?>;
}
.entry-meta-wrapper .entry-meta span:before,
.entry-meta-wrapper .entry-meta a:before,
.entry-meta-wrapper .entry-meta .meta-item:before,
.entry-meta-wrapper .entry-meta div,
li.herald-mega-menu .sub-menu .entry-title a,
.entry-meta-wrapper .herald-author-twitter{
	color: <?php echo $color_content_txt; ?>;
}
.herald-mod-title h1,
.herald-mod-title h2,
.herald-mod-title h4{
	color: <?php echo $color_content_bg; ?>;	
}
.herald-mod-head:after,
.herald-mod-title .herald-color,
.widget-title:after,
.widget-title span{
	color: <?php echo $color_content_bg; ?>;
	background-color: <?php echo $color_content_title; ?>;
}
.herald-mod-title .herald-color a{
	color: <?php echo $color_content_bg; ?>;
}
.herald-ovrld .meta-category a,
.herald-fa-wrapper .meta-category a{
	background-color: <?php echo $color_content_acc; ?>;
}

.meta-tags a,
.widget_tag_cloud a,
.herald-share-meta:after{
	background: <?php echo herald_hex2rgba( $color_content_title , 0.1); ?>;
}
h1, h2, h3, h4, h5, h6,
.entry-title a {
	color: <?php echo $color_content_title; ?>;
}

.herald-pagination .page-numbers,
.herald-mod-subnav a,
.herald-mod-actions a,
.herald-slider-controls div,
.meta-tags a,
.widget.widget_tag_cloud a,
.herald-sidebar .mks_autor_link_wrap a,
.herald-sidebar .meks-instagram-follow-link a,
.mks_themeforest_widget .mks_read_more a,
.herald-read-more{
	color: <?php echo $color_content_txt; ?>;
}
.widget.widget_tag_cloud a:hover,
.entry-content .meta-tags a:hover{
	background-color: <?php echo $color_content_acc; ?>;
	color: #FFF;
}
.herald-pagination .prev.page-numbers,
.herald-pagination .next.page-numbers,
.herald-pagination .prev.page-numbers:hover,
.herald-pagination .next.page-numbers:hover,
.herald-pagination .page-numbers.current,
.herald-pagination .page-numbers.current:hover,
.herald-next a,
.herald-pagination .herald-next a:hover,
.herald-prev a,
.herald-pagination .herald-prev a:hover,
.herald-load-more a,
.herald-load-more a:hover,
.entry-content .herald-search-submit,
.herald-mod-desc .herald-search-submit,
.wpcf7-submit{
	background-color:<?php echo $color_content_acc; ?>;
	color: #FFF;	
}
.herald-pagination .page-numbers:hover{
	background-color: <?php echo herald_hex2rgba( $color_content_txt , 0.1); ?>;
}

.widget a,
.recentcomments a,
.widget a:hover,
.herald-sticky-next a:hover,
.herald-sticky-prev a:hover,
.herald-mod-subnav a:hover,
.herald-mod-actions a:hover,
.herald-slider-controls div:hover,
.meta-tags a:hover,
.widget_tag_cloud a:hover,
.mks_autor_link_wrap a:hover,
.meks-instagram-follow-link a:hover,
.mks_themeforest_widget .mks_read_more a:hover,
.herald-read-more:hover,
.widget .entry-title a:hover,
li.herald-mega-menu .sub-menu .entry-title a:hover,
.entry-meta-wrapper .meta-item:hover a,
.entry-meta-wrapper .meta-item:hover a:before,
.entry-meta-wrapper .herald-share:hover > span,
.entry-meta-wrapper .herald-author-name:hover,
.entry-meta-wrapper .herald-author-twitter:hover,
.entry-meta-wrapper .herald-author-twitter:hover:before{
	color:<?php echo $color_content_acc; ?>;
}
.widget ul li a,
.widget .entry-title a,
.herald-author-name,
.entry-meta-wrapper .meta-item,
.entry-meta-wrapper .meta-item span,
.entry-meta-wrapper .meta-item a,
.herald-mod-actions a{
	color: <?php echo $color_content_txt; ?>;
}
.widget li:before{
	background: <?php echo herald_hex2rgba( $color_content_txt , 0.3); ?>;
}
.widget_categories .count{
	background: <?php echo $color_content_acc; ?>;
	color: #FFF;
}
input[type="submit"],
.spinner > div{
	background-color: <?php echo $color_content_acc; ?>;	
}
.herald-mod-actions a:hover,
.comment-body .edit-link a,
.herald-breadcrumbs a:hover{
	color:<?php echo $color_content_acc; ?>;
}
.herald-header-wraper .herald-soc-nav a:hover,
.meta-tags span,
li.herald-mega-menu .herald-ovrld .entry-title a,
li.herald-mega-menu .herald-ovrld .entry-title a:hover,
.herald-ovrld .entry-meta .herald-reviews i:before{
	color: #FFF;
}
.entry-meta .meta-item, 
.entry-meta span, 
.entry-meta a,
.meta-category span,
.post-date,
.recentcomments,
.rss-date,
.comment-metadata a,
.entry-meta a:hover,
.herald-menu li.herald-mega-menu .col-lg-3 a:after,
.herald-breadcrumbs,
.herald-breadcrumbs a,
.entry-meta .herald-reviews i:before{
	color: <?php echo $color_content_meta; ?>;
}

.herald-lay-a .herald-lay-over{
	background: <?php echo $color_content_bg; ?>;
}
.herald-pagination a:hover,
input[type="submit"]:hover,
.entry-content .herald-search-submit:hover,
.wpcf7-submit:hover,
.herald-fa-wrapper .meta-category a:hover,
.herald-ovrld .meta-category a:hover,
.herald-mod-desc .herald-search-submit:hover,
.herald-single-sticky .herald-share li a:hover{
    cursor: pointer;
    text-decoration: none;
    background-image: -moz-linear-gradient(left,rgba(0,0,0,0.1) 0%,rgba(0,0,0,0.1) 100%);
    background-image: -webkit-gradient(linear,left top,right top,color-stop(0%,rgba(0,0,0,0.1)),color-stop(100%,rgba(0,0,0,0.1)));
    background-image: -webkit-linear-gradient(left,rgba(0,0,0,0.1) 0%,rgba(0,0,0,0.1) 100%);
    background-image: -o-linear-gradient(left,rgba(0,0,0,0.1) 0%,rgba(0,0,0,0.1) 100%);
    background-image: -ms-linear-gradient(left,rgba(0,0,0,0.1) 0%,rgba(0,0,0,0.1) 100%);
    background-image: linear-gradient(to right,rgba(0,0,0,0.1) 0%,rgba(0,0,0,0.1) 100%);
}
.herald-sticky-next a,
.herald-sticky-prev a{
	color: <?php echo $color_content_txt; ?>;
}
.herald-sticky-prev a:before,
.herald-sticky-next a:before,
.herald-comment-action,
.meta-tags span,
.herald-entry-content .herald-link-pages a{
	background: <?php echo $color_content_txt; ?>;
}
.herald-sticky-prev a:hover:before,
.herald-sticky-next a:hover:before,
.herald-comment-action:hover,
div.mejs-controls .mejs-time-rail .mejs-time-current,
.herald-entry-content .herald-link-pages a:hover{
	background: <?php echo $color_content_acc; ?>;
}

/* Footer */ 

.herald-site-footer{
	background: <?php echo $color_footer_bg; ?>;
	color: <?php echo $color_footer_txt; ?>;
}
.herald-site-footer .widget-title span{
	color: <?php echo $color_footer_txt; ?>;
	background: transparent;
}
.herald-site-footer .widget-title:before{
	background:<?php echo $color_footer_txt; ?>;
}
.herald-site-footer .widget-title:after,
.herald-site-footer .widget_tag_cloud a{
	background: <?php echo herald_hex2rgba($color_footer_txt, 0.1); ?>;
}
.herald-site-footer .widget li:before{
	background: <?php echo herald_hex2rgba($color_footer_txt, 0.3); ?>;	
}
.herald-site-footer a,
.herald-site-footer .widget a:hover,
.herald-site-footer .widget .meta-category a,
.herald-site-footer .herald-slider-controls .owl-prev:hover,
.herald-site-footer .herald-slider-controls .owl-next:hover,
.herald-site-footer .herald-slider-controls .herald-mod-actions:hover{
	color: <?php echo $color_footer_acc; ?>;
}
.herald-site-footer .widget a,
.herald-site-footer .mks_author_widget h3{
	color: <?php echo $color_footer_txt; ?>;
}
.herald-site-footer .entry-meta .meta-item, 
.herald-site-footer .entry-meta span, 
.herald-site-footer .entry-meta a, 
.herald-site-footer .meta-category span, 
.herald-site-footer .post-date, 
.herald-site-footer .recentcomments, 
.herald-site-footer .rss-date, 
.herald-site-footer .comment-metadata a{
	color: <?php echo $color_footer_meta; ?>;
}
.herald-site-footer .mks_author_widget .mks_autor_link_wrap a, 
.herald-site-footer  .mks_read_more a, 
.herald-site-footer .herald-read-more,
.herald-site-footer .herald-slider-controls .owl-prev, 
.herald-site-footer .herald-slider-controls .owl-next, 
.herald-site-footer .herald-mod-wrap .herald-mod-actions a{
	border-color: <?php echo herald_hex2rgba($color_footer_txt, 0.2); ?>;	
}
.herald-site-footer .mks_author_widget .mks_autor_link_wrap a:hover, 
.herald-site-footer  .mks_read_more a:hover, 
.herald-site-footer .herald-read-more:hover,
.herald-site-footer .herald-slider-controls .owl-prev:hover, 
.herald-site-footer .herald-slider-controls .owl-next:hover, 
.herald-site-footer .herald-mod-wrap .herald-mod-actions a:hover{
	border-color: <?php echo herald_hex2rgba($color_footer_acc, 0.5); ?>;	
}
.herald-site-footer .widget_search .herald-search-input{
	color: <?php echo $color_footer_bg; ?>;
}
.herald-site-footer .widget_tag_cloud a:hover{
	background:<?php echo $color_footer_acc; ?>;
	color:#FFF;
}
.footer-bottom a{
	color:<?php echo $color_footer_txt; ?>;
}
.footer-bottom a:hover,
.footer-bottom .herald-copyright a{
	color:<?php echo $color_footer_acc; ?>;
}
.footer-bottom .herald-menu li:hover > a{
	color: <?php echo $color_footer_acc; ?>;
}
.footer-bottom .sub-menu{
	background-color: rgba(0,0,0,0.5);	
}

/* Borders */ 


.herald-pagination{
	border-top: 1px solid <?php echo herald_hex2rgba( $color_content_title , 0.1); ?>;	
}
.entry-content a:hover,
.comment-respond a:hover,
.comment-reply-link:hover{
	border-bottom: 2px solid <?php echo $color_content_acc; ?>;
}
.footer-bottom .herald-copyright a:hover{
	border-bottom: 2px solid <?php echo $color_footer_acc; ?>;
}

.herald-slider-controls .owl-prev,
.herald-slider-controls .owl-next,
.herald-mod-wrap .herald-mod-actions a{
	border: 1px solid <?php echo herald_hex2rgba($color_content_txt, 0.2); ?>;
}
.herald-slider-controls .owl-prev:hover,
.herald-slider-controls .owl-next:hover,
.herald-mod-wrap .herald-mod-actions a:hover,
.herald-author .herald-socials-actions .herald-mod-actions a:hover {
	border-color: <?php echo herald_hex2rgba($color_content_acc, 0.5); ?>;
}
.herald-pagination,
.herald-link-pages,
#wp-calendar thead th,
#wp-calendar tbody td,
#wp-calendar tbody td:last-child{
	border-color: <?php echo herald_hex2rgba($color_content_txt, 0.1); ?>;
}
.herald-lay-h:after,
.herald-site-content .herald-related .herald-lay-h:after,
.herald-lay-e:after,
.herald-site-content .herald-related .herald-lay-e:after,
.herald-lay-j:after,
.herald-site-content .herald-related .herald-lay-j:after,
.herald-lay-l:after,
.herald-site-content .herald-related .herald-lay-l:after {
	background-color: <?php echo herald_hex2rgba($color_content_txt, 0.1); ?>;
}

input[type="text"], 
input[type="email"], 
input[type="url"], 
input[type="tel"], 
input[type="number"], 
input[type="date"], 
input[type="password"], 
select, 
textarea,
.herald-single-sticky,
td,
th,
table,
.mks_author_widget .mks_autor_link_wrap a,
.widget .meks-instagram-follow-link a,
.mks_read_more a,
.herald-read-more{
	border-color: <?php echo herald_hex2rgba($color_content_txt, 0.2); ?>;
}
.entry-content .herald-search-input,
.herald-fake-button,
input[type="text"]:focus, 
input[type="email"]:focus, 
input[type="url"]:focus, 
input[type="tel"]:focus, 
input[type="number"]:focus, 
input[type="date"]:focus, 
input[type="password"]:focus, 
textarea:focus{
	border-color: <?php echo herald_hex2rgba($color_content_txt, 0.3); ?>;
}
.mks_author_widget .mks_autor_link_wrap a:hover,
.widget .meks-instagram-follow-link a:hover,
.mks_read_more a:hover,
.herald-read-more:hover{
	border-color: <?php echo herald_hex2rgba($color_content_acc, 0.5); ?>;
}
.comment-form,
.herald-gray-area,
.entry-content .herald-search-form,
.herald-mod-desc .herald-search-form{
	background-color: <?php echo herald_hex2rgba($color_content_txt, 0.06); ?>;
	border: 1px solid <?php echo herald_hex2rgba($color_content_txt, 0.15); ?>;
}
.herald-boxed .herald-breadcrumbs{
	background-color: <?php echo herald_hex2rgba($color_content_txt, 0.06); ?>;
}
.herald-breadcrumbs{
	border-color: <?php echo herald_hex2rgba($color_content_txt, 0.15); ?>;
}

.single .herald-entry-content .herald-ad,
.archive .herald-posts .herald-ad{
	border-top: 1px solid <?php echo herald_hex2rgba($color_content_txt, 0.15); ?>;
}
.archive .herald-posts .herald-ad{
	border-bottom: 1px solid <?php echo herald_hex2rgba($color_content_txt, 0.15); ?>;
}
li.comment .comment-body:after{
	background-color: <?php echo herald_hex2rgba($color_content_txt, 0.06); ?>;
}
.herald-pf-invert .entry-title a:hover .herald-format-icon{
	background: <?php echo $color_content_acc; ?>;
}

<?php 

/* Find which area contains main navigation and apply styles to responsive nav */

if(herald_main_nav_section() == 'middle'){
	$color_header_responsive_bg = $color_header_middle_bg;
	$color_header_responsive_txt = $color_header_middle_txt;
	$color_header_responsive_acc = $color_header_middle_acc;
} else {
	$color_header_responsive_bg = $color_header_bottom_bg;
	$color_header_responsive_txt = $color_header_bottom_txt;
	$color_header_responsive_acc = $color_header_bottom_acc;
}


if( $color_header_responsive_bg == $color_content_bg ){
	echo '.herald-responsive-header{ box-shadow: 1px 0 0 1px '.herald_hex2rgba($color_header_responsive_txt, 0.15).';}';
}

	
?>

.herald-responsive-header,
.herald-mobile-nav,
.herald-responsive-header .herald-menu-popup-search .fa{
	color: <?php echo $color_header_responsive_txt; ?>;
	background: <?php echo $color_header_responsive_bg; ?>;
}
.herald-responsive-header a{
	color: <?php echo $color_header_responsive_txt; ?>;
}
.herald-mobile-nav li a{
	color: <?php echo $color_header_responsive_txt; ?>;
}
.herald-mobile-nav li a,
.herald-mobile-nav .herald-mega-menu.herald-mega-menu-classic>.sub-menu>li>a{
	border-bottom: 1px solid <?php echo herald_hex2rgba($color_header_responsive_txt, 0.15); ?>;	
}
.herald-mobile-nav{
	border-right: 1px solid <?php echo herald_hex2rgba($color_header_responsive_txt, 0.15); ?>;
}

.herald-mobile-nav li a:hover{
    color: #fff;
    background-color: <?php echo $color_header_responsive_acc; ?>;	
}

.herald-menu-toggler{
	color: <?php echo $color_header_middle_txt; ?>;
	border-color: <?php echo herald_hex2rgba($color_header_responsive_txt, 0.15); ?>;
}

.herald-goto-top{
	color: <?php echo $color_content_bg; ?>;
	background-color: <?php echo $color_content_title; ?>;
}
.herald-goto-top:hover{
	background-color: <?php echo $color_content_acc; ?>;
}

.herald-responsive-header .herald-menu-popup > span,
.herald-responsive-header .herald-search-active > span{
	color: <?php echo $color_header_responsive_txt; ?>;	
}
.herald-responsive-header .herald-menu-popup-search .herald-in-popup{
	background: <?php echo $color_content_bg; ?>;
}
.herald-responsive-header .herald-search-input,
.herald-responsive-header .herald-menu-popup-search .herald-search-submit{
	color: <?php echo $color_content_txt; ?>;
}

/* WooCommerce styles */

<?php if( herald_is_woocommerce_active() ) : ?>

.woocommerce ul.products li.product .button,
.woocommerce ul.products li.product .added_to_cart,
.woocommerce div.product form.cart .button,
body.woocommerce .button,
body.woocommerce .button:hover,
body.woocommerce-page .button,
body.woocommerce-page .button:hover,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce a.button.alt,
.woocommerce a.button.alt:hover,
.woocommerce-checkout #place_order,
.woocommerce .widget_shopping_cart_content .buttons .button,
.woocommerce #respond input#submit,
.woocommerce #respond input#submit:hover{
	background-color: <?php echo $color_content_acc; ?>;	
}
.woocommerce-pagination{
	border-top: 1px solid <?php echo herald_hex2rgba( $color_content_title , 0.1); ?>;	
}
.woocommerce div.product .woocommerce-tabs ul.tabs li.active a{
	border-bottom: 2px solid <?php echo $color_content_acc; ?>;
}
.woocommerce-cart table.cart td.actions .coupon .input-text{
	border-color: <?php echo herald_hex2rgba( $color_content_title , 0.1); ?>;	
}
.woocommerce table.shop_table tbody:first-child tr:first-child td, 
.woocommerce table.shop_table tbody:first-child tr:first-child th{
	border-top: 1px solid <?php echo herald_hex2rgba( $color_content_title , 0.1); ?>;	
	border-bottom:none;
}
.woocommerce-cart .cart_item td{
	border-bottom: 1px solid <?php echo herald_hex2rgba( $color_content_title , 0.1); ?> !important;		
}
.woocommerce nav.woocommerce-pagination ul li span,
.woocommerce nav.woocommerce-pagination ul li a:hover, 
.woocommerce nav.woocommerce-pagination ul li span.current{
	background-color:<?php echo $color_content_acc; ?>;
	color: #FFF;	
}
.woocommerce .woocommerce-breadcrumb a,
.woocommerce .woocommerce-breadcrumb,
.woocommerce .woocommerce-result-count,
del .amount{
	color: <?php echo $color_content_meta; ?>;	
}
.woocommerce .woocommerce-breadcrumb a:hover{
	color: <?php echo $color_content_acc; ?>;	
}

<?php endif; ?>


/* bbPress styles */

<?php if ( herald_is_bbpress_active() ) : ?>

#bbpress-forums li.bbp-header, #bbpress-forums li.bbp-footer{
	color: <?php echo $color_content_bg; ?>;
	background-color: <?php echo $color_content_title; ?>;
}
#bbpress-forums .bbp-forum-title,
#bbpress-forums .bbp-topic-permalink{
  font-family: <?php echo $h_font['font-family']; ?>;
  font-weight: <?php echo $h_font['font-weight']; ?>;
  <?php if ( isset( $h_font['font-style'] ) && !empty( $h_font['font-style'] ) ):?>
  font-style: <?php echo $h_font['font-style']; ?>;
  <?php endif; ?>	
	color: <?php echo $color_content_title; ?>;
}
#bbpress-forums .bbp-topic-started-by,
.bbp-topic-freshness a,
.bbp-pagination-count,
#bbpress-forums .bbp-forum-info .bbp-forum-content,
#bbpress-forums p.bbp-topic-meta,
.bbp-forum-freshness a,
span.bbp-admin-links a,
.bbp-reply-post-date,
#bbpress-forums li.bbp-forum a,
.widget_display_replies div,
.widget_display_topics div{
	color: <?php echo $color_content_meta; ?>;
}
#bbpress-forums .bbp-forum-title:hover, 
#bbpress-forums .bbp-topic-permalink:hover,
.bbp-topic-freshness a:hover,
.bbp-topic-meta a,
.bbp-forum-freshness a:hover,
span.bbp-admin-links a:hover,
.bbp-reply-post-date:hover,
#bbpress-forums li.bbp-forum a:hover{
	color: <?php echo $color_content_acc; ?>;	
}
.bbp-topic-form,
.bbp-reply-form{
	background-color: <?php echo herald_hex2rgba($color_content_txt, 0.06); ?>;
	border: 1px solid <?php echo herald_hex2rgba($color_content_txt, 0.15); ?>;
}
div.bbp-submit-wrapper button,
#bbpress-forums #bbp-your-profile fieldset.submit button{
	background-color: <?php echo $color_content_acc; ?>;		
}
.bbp-pagination-links a:hover, 
.bbp-pagination-links span.current{
	background-color:<?php echo $color_content_acc; ?>;
	color: #FFF;	
}
#bbpress-forums textarea{
	border: 1px solid <?php echo herald_hex2rgba($color_content_txt, 0.2); ?> !important;
}

.bbp_widget_login .logout-link{
	border: 1px solid <?php echo herald_hex2rgba($color_content_txt, 0.2); ?>;	
	color: <?php echo $color_content_txt; ?>;
}
.bbp_widget_login .logout-link:hover{
	border: 1px solid <?php echo herald_hex2rgba($color_content_acc, 0.5); ?>;	
}
<?php endif; ?>



/* Co Authors Plus Plugin */

<?php if ( herald_is_co_authors_active() ) : ?>

	.entry-meta-wrapper .meta-item.herald-author:hover .coauthors a {
		color: <?php echo $color_content_txt; ?>
	}
	.entry-meta-wrapper .meta-item.herald-author .coauthors a:hover {
		color: <?php echo $color_content_acc; ?>
	}

<?php endif; ?>


<?php

/* Generate css for category colors */
$cat_colors = get_option( 'herald_cat_colors' );

if ( !empty( $cat_colors ) ) {
	foreach ( $cat_colors as $cat => $color ) {
		if( $cat != 0) {
			echo 'a.herald-cat-'.$cat.' , .widget a.herald-cat-'.$cat.'{ color: '.$color.';}';
			echo '.herald-mod-head.herald-cat-'.$cat.':after{ background:'.$color.'; }';
			echo '.herald-mod-head.herald-cat-'.$cat.' .herald-color { background:'.$color.'; }';
			echo '.herald-ovrld .meta-category a.herald-cat-'.$cat.'{ background-color: '.$color.'; color: #FFF;}';
			echo '.widget_categories .cat-item-'.$cat.' .count { background-color: '.$color.';}';
			echo '.herald-fa-colored .herald-cat-'.$cat.' .fa-post-thumbnail:before { background-color: '.$color.';}';
			echo '.herald-fa-wrapper .meta-category .herald-cat-'.$cat.' { background-color: '.$color.';}'; 
			echo '.widget_categories .cat-item-'.$cat.' a:hover { color: '.$color.';}';
			echo '.herald-site-footer .widget a.herald-cat-'.$cat.' { color: '.$color.';}'; 
			echo 'li.herald-mega-menu .sub-menu a.herald-cat-'.$cat.' { color: '.$color.';}';   
		}
	}
}

/* Apply uppercase options */
$uppercase = herald_get_option( 'uppercase' );
if ( !empty( $uppercase ) ) {
	foreach ( $uppercase as $text_class => $val ) {
		if ( $val ){
			echo '.'.$text_class.'{text-transform: uppercase;}';
		} else {
			echo '.'.$text_class.'{text-transform: none;}';
		}
	}
}

/* Additional styles */

$overlay_opacity = herald_get_option('overlay_opacity');
echo '.fa-post-thumbnail:before, .herald-ovrld .herald-post-thumbnail span:before, .herald-ovrld .herald-post-thumbnail a:before { opacity: '.esc_attr($overlay_opacity[1]).'; }';
echo '.herald-fa-item:hover .fa-post-thumbnail:before, .herald-ovrld:hover .herald-post-thumbnail a:before, .herald-ovrld:hover .herald-post-thumbnail span:before{ opacity: '.esc_attr($overlay_opacity[2]).'; }';



?>

/* Responsive header brekpoint */
@media only screen and (min-width: <?php echo $header_responsive_breakpoint; ?>px) {
.herald-site-header .header-top,
.header-middle,
.header-bottom,
.herald-header-sticky,
.header-trending{ display:block !important;}

.herald-responsive-header,.herald-mobile-nav{display:none !important;}
.herald-site-content {
    margin-top: 0 !important;
}
.herald-mega-menu .sub-menu {
    display: block;
}
.header-mobile-ad {
    display: none;
}
}