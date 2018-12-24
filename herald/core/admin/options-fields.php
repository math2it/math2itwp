<?php

/* Branding */
Redux::setSection( $opt_name , array(
        'icon'      => ' el-icon-smiley',
        'title'     => esc_html__( 'Branding', 'herald' ),
        'desc'     => esc_html__( 'Personalize theme by adding your own images', 'herald' ),
        'fields'    => array(

            array(
                'id'        => 'logo',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__( 'Logo', 'herald' ),
                'subtitle'      => esc_html__( 'Upload your logo image here, or leave empty to show the website title instead.', 'herald' ),
                'default'   => array( 'url' => esc_url( get_template_directory_uri().'/assets/img/herald_logo.png' ) ),
            ),

            array(
                'id'        => 'logo_retina',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__( 'Retina logo (2x)', 'herald' ),
                'subtitle'      => esc_html__( 'Optionally upload another logo for devices with retina displays. It should be double the size of your standard logo', 'herald' ),
                'default'   => array( 'url' => esc_url( get_template_directory_uri().'/assets/img/herald_logo@2x.png' ) ),
            ),

            array(
                'id'        => 'logo_mini',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__( 'Mini logo', 'herald' ),
                'subtitle'      => esc_html__( 'Optionally upload another logo which may be used as mobile/tablet logo', 'herald' ),
                'default'   => array( 'url' => esc_url( get_template_directory_uri().'/assets/img/herald_logo_mini.png' ) ),
            ),

            array(
                'id'        => 'logo_mini_retina',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__( 'Mini retina logo (2x)', 'herald' ),
                'subtitle'      => esc_html__( 'Upload double sized mini logo for devices with retina displays', 'herald' ),
                'default'   => array( 'url' => esc_url( get_template_directory_uri().'/assets/img/herald_logo_mini@2x.png' ) ),
            ),

            array(
                'id'        => 'default_fimg',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__( 'Default featured image', 'herald' ),
                'subtitle'      => esc_html__( 'Upload your default featured image/placeholder. It will be displayed for posts that do not have a featured image set.', 'herald' ),
                'default'   => array( 'url' => esc_url( get_template_directory_uri().'/assets/img/herald_default.jpg' ) ),
            )
        ) )
);


/* Header */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-bookmark',
        'title'     => esc_html__( 'Header', 'herald' ),
        'fields'    => array(
)));

/* Header General */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Sections', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(

             array(
                    'id'        => 'header_sections',
                    'type'      => 'sortable',
                    'mode'      => 'checkbox',
                    'title'     => esc_html__( 'Header sections', 'herald' ),
                    'subtitle'  => esc_html__( 'Select (re-order) header sections you want to display', 'herald' ),
                    'options'   => array(
                        'top' => esc_html__('Top bar', 'herald'),
                        'middle' => esc_html__('Main area (middle bar)', 'herald'),
                        'bottom' => esc_html__('Bottom bar', 'herald'),
                        'trending' => esc_html__('Trending posts', 'herald'),
                        ),
                    'default' => array(
                        'top' => 1,
                        'middle' => 1,
                        'bottom' => 1,
                        'trending' => 1,
                    ),
                ),
            )));


/* Top Bar */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Top Bar', 'herald' ),
        'desc'     => esc_html__( 'Modify and style your header top bar', 'herald' ),
        'subsection' => true,
        'fields'    => array(

            array(
                'id' => 'color_header_top_bg',
                'type' => 'color',
                'title' => esc_html__( 'Background color', 'herald' ),
                'transparent' => false,
                'default' => '#111111',
            ),

            array(
                'id' => 'color_header_top_txt',
                'type' => 'color',
                'title' => esc_html__( 'Text color', 'herald' ),
                'transparent' => false,
                'default' => '#aaaaaa',
            ),

            array(
                'id' => 'color_header_top_acc',
                'type' => 'color',
                'title' => esc_html__( 'Accent color', 'herald' ),
                'transparent' => false,
                'default' => '#ffffff',
            ),

            array(
                'id'        => 'header_top_left',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Left slot', 'herald' ),
                'subtitle'  => esc_html__( 'Check which elements to add in left slot', 'herald' ),
                'options'   => herald_get_header_elements( 'top', 'left'),
                'default'   => herald_get_header_elements( 'top', 'left', true ),
            ),

            array(
                'id'        => 'header_top_center',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Center slot', 'herald' ),
                'subtitle'  => esc_html__( 'Check which elements to add in center slot', 'herald' ),
                'options'   => herald_get_header_elements( 'top', 'center'),
                'default'   => herald_get_header_elements( 'top', 'center', true ),
            ),

            array(
                'id'        => 'header_top_right',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Right slot', 'herald' ),
                'subtitle'  => esc_html__( 'Check which elements to add in right slot', 'herald' ),
                'options'   => herald_get_header_elements( 'top', 'right'),
                'default'   => herald_get_header_elements( 'top', 'right', true ),
            ),

        ) )
);

/* Main header area */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Main Area', 'herald' ),
        'desc'     => esc_html__( 'Modify and style your main header area', 'herald' ),
        'subsection' => true,
        'fields'    => array(

            array(
                'id' => 'header_height',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Height', 'herald' ),
                'subtitle' => esc_html__( 'Specify a height for your main header area', 'herald' ),
                'desc' => esc_html__( 'Note: Height value is in px.', 'herald' ),
                'default' => 120,
                'validate' => 'numeric'
            ),

            array(
                'id' => 'color_header_middle_bg',
                'type' => 'color',
                'title' => esc_html__( 'Background color', 'herald' ),
                'transparent' => false,
                'default' => '#0277bd',
            ),

            array(
                'id'       => 'background_header_middle',
                'type'     => 'background',
                'title'    => esc_html__( 'Background image', 'herald' ),
                'subtitle' => esc_html__( 'Optionally upload background image or pattern', 'herald' ),
                'background-color' => false,
                'default'  => array(),
            ),

            array(
                'id' => 'color_header_middle_txt',
                'type' => 'color',
                'title' => esc_html__( 'Text color', 'herald' ),
                'transparent' => false,
                'default' => '#ffffff',
            ),

            array(
                'id' => 'color_header_middle_acc',
                'type' => 'color',
                'title' => esc_html__( 'Accent color', 'herald' ),
                'transparent' => false,
                'default' => '#111111',
            ),

            array(
                'id'        => 'header_middle_left',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Left slot', 'herald' ),
                'subtitle'  => esc_html__( 'Check which elements to add in left slot', 'herald' ),
                'options'   => herald_get_header_elements( 'middle', 'left'),
                'default'   => herald_get_header_elements( 'middle', 'left', true ),
            ),

            array(
                'id'        => 'header_middle_left_align',
                'type'      => 'radio',
                'title'     => esc_html__( 'Align elements', 'herald' ),
                'subtitle'  => esc_html__( 'If you choose more than one element in the slot, choose if they will be aligned horizontally or vertically', 'herald' ),
                'options'   => array(
                        'hor' => esc_html__( 'Horizontally', 'herald' ),
                        'ver' => esc_html__( 'Vertically', 'herald' ),
                    ),
                'default'   => 'hor',
            ),

            array(
                'id'        => 'header_middle_center',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Center slot', 'herald' ),
                'subtitle'  => esc_html__( 'Check which elements to add in center slot', 'herald' ),
                'options'   => herald_get_header_elements( 'middle', 'center'),
                'default'   => herald_get_header_elements( 'middle', 'center', true ),
            ),

            array(
                'id'        => 'header_middle_center_align',
                'type'      => 'radio',
                'title'     => esc_html__( 'Align center slot elements', 'herald' ),
                'subtitle'  => esc_html__( 'If you choose more than one element in the slot, choose if they will be aligned horizontally or vertically', 'herald' ),
                'options'   => array(
                        'hor' => esc_html__( 'Horizontally', 'herald' ),
                        'ver' => esc_html__( 'Vertically', 'herald' ),
                    ),
                'default'   => 'hor',
            ),

            array(
                'id'        => 'header_middle_right',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Right slot', 'herald' ),
                'subtitle'  => esc_html__( 'Check which elements to add in right slot', 'herald' ),
                'options'   => herald_get_header_elements( 'middle', 'right'),
                'default'   => herald_get_header_elements( 'middle', 'right', true ),
            ),

            array(
                'id'        => 'header_middle_right_align',
                'type'      => 'radio',
                'title'     => esc_html__( 'Align elements', 'herald' ),
                'subtitle'  => esc_html__( 'If you choose more than one element in the slot, choose if they will be aligned horizontally or vertically', 'herald' ),
                'options'   => array(
                        'hor' => esc_html__( 'Horizontally', 'herald' ),
                        'ver' => esc_html__( 'Vertically', 'herald' ),
                    ),
                'default'   => 'hor',
            ),



        ) )
);

/* Bottom header bar */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Bottom Bar', 'herald' ),
        'desc'     => esc_html__( 'Modify and style your header bottom bar', 'herald' ),
        'subsection' => true,
        'fields'    => array(

            array(
                'id' => 'color_header_bottom_bg',
                'type' => 'color',
                'title' => esc_html__( 'Background color', 'herald' ),
                'transparent' => false,
                'default' => '#0288d1',
            ),

            array(
                'id' => 'color_header_bottom_txt',
                'type' => 'color',
                'title' => esc_html__( 'Text color', 'herald' ),
                'transparent' => false,
                'default' => '#ffffff',
            ),

            array(
                'id' => 'color_header_bottom_acc',
                'type' => 'color',
                'title' => esc_html__( 'Accent color', 'herald' ),
                'transparent' => false,
                'default' => '#424242',
            ),

             array(
                'id'        => 'header_bottom_left',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Left slot', 'herald' ),
                'subtitle'  => esc_html__( 'Check which elements to add in left slot', 'herald' ),
                'options'   => herald_get_header_elements( 'bottom', 'left'),
                'default'   => herald_get_header_elements( 'bottom', 'left', true ),
            ),

            array(
                'id'        => 'header_bottom_center',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Center slot', 'herald' ),
                'subtitle'  => esc_html__( 'Check which elements to add in center slot', 'herald' ),
                'options'   => herald_get_header_elements( 'bottom', 'center'),
                'default'   => herald_get_header_elements( 'bottom', 'center', true ),
            ),

            array(
                'id'        => 'header_bottom_right',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Right slot', 'herald' ),
                'subtitle'  => esc_html__( 'Check which elements to add in right slot', 'herald' ),
                'options'   => herald_get_header_elements( 'bottom', 'right'),
                'default'   => herald_get_header_elements( 'bottom', 'right', true ),
            ),

        ) )
);

/* Trending */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Trending Posts', 'herald' ),
        'desc'     => esc_html__( 'Manage settings for you trending posts', 'herald' ),
        'subsection' => true,
        'fields'    => array(

            array(
                'id' => 'color_header_trending_bg',
                'type' => 'color',
                'title' => esc_html__( 'Background color', 'herald' ),
                'transparent' => false,
                'default' => '#eeeeee',
            ),


            array(
                'id' => 'color_header_trending_txt',
                'type' => 'color',
                'title' => esc_html__( 'Text color', 'herald' ),
                'transparent' => false,
                'default' => '#666666',
            ),

            array(
                'id' => 'color_header_trending_acc',
                'type' => 'color',
                'title' => esc_html__( 'Accent color', 'herald' ),
                'transparent' => false,
                'default' => '#111111',
            ),

             array(
                'id'        => 'trending_number',
                'type'      => 'button_set',
                'title'     => esc_html__( 'Number of posts (columns)', 'herald' ),
                'options'   => array(
                    '3' => '3', 
                    '4' => '4', 
                    '6' => '6'
                ),
                'default'   => '6'
            ),

             array(
                'id'        => 'trending_fimg',
                'type'      => 'switch',
                'title'     => esc_html__( 'Display featured images', 'herald' ),
                'subtitle'  => esc_html__( 'Check if you want display featured images on trending posts', 'herald' ),
                'default'   => true,
            ),

            array(
                'id'        => 'trending_slider',
                'type'      => 'switch',
                'title'     => esc_html__( 'Enable slider', 'herald' ),
                'subtitle'  => esc_html__( 'Check if you want to slide/rotate items', 'herald' ),
                'default'   => false,
            ),

            array(
                'id'        => 'trending_slider_post',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Specify number of total posts', 'herald' ),
                'default'   => 10,
                'validate'  => 'numeric',
                'required'  => array('trending_slider', '=', '1'),
            ),

            

            array(
                'id'        => 'trending_order',
                'type'      => 'radio',
                'title'     => esc_html__( 'Trending posts chooses from', 'herald' ),
                'options'   => herald_get_fa_post_opts(),
                'default'   => 'date',
            ),

            array(
                'id'        => 'trending_cat',
                'type'      => 'checkbox',
                'title'     => esc_html__( 'In category', 'herald' ),
                'subtitle'  => esc_html__( 'Select trending posts only from one or more specific categories', 'herald' ),
                'data'  => 'categories',
                'default' => array()
            ),

            array(
                'id'        => 'trending_tag',
                'type'      => 'select',
                'multi'      => true,
                'title'     => esc_html__( 'Tagged with', 'herald' ),
                'subtitle'  => esc_html__( 'Select trending posts only tagged with one or more specific tags', 'herald' ),
                'data'  => 'tag',
                'default' => array()
            ),


            array(
                'id'        => 'trending_time',
                'type'      => 'radio',
                'title'     => esc_html__( 'Trending posts are not older than', 'herald' ),
                'options'   => herald_get_time_diff_opts(),
                'default'   => '0'
            ),

            array(
                'id' => 'trending_manual',
                'type' => 'text',
                'title' => esc_html__( 'Manually choose trending posts', 'herald' ),
                'subtitle'  => esc_html__( 'Specify post IDs separated by comma to manually pick trending posts', 'herald' ),
                'description'  => esc_html__( 'Example: 34, 56, 78, 145, 434, 223', 'herald' ),
                'default' => '',
            ),

           
            
)));

/* Sticky header area */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Sticky Header', 'herald' ),
        'desc'     => esc_html__( 'Modify and style your sticky header area', 'herald' ),
        'subsection' => true,
        'fields'    => array(

            array(
                'id'        => 'header_sticky',
                'type'      => 'switch',
                'title'     => esc_html__( 'Display sticky header', 'herald' ),
                'subtitle'  => esc_html__( 'Check if you want to enable sticky header', 'herald' ),
                'default'   => true,
            ),

            array(
                'id'        => 'header_sticky_offset',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Sticky header offset', 'herald' ),
                'subtitle'  => esc_html__( 'Specify after how many px of scrolling the sticky header appears', 'herald' ),
                'default'   => 600,
                'validate'  => 'numeric',
                'required' => array( 'header_sticky', '=', true )
            ),

            array(
                'id'        => 'header_sticky_up',
                'type'      => 'switch',
                'title'     => esc_html__( 'Smart sticky', 'herald' ),
                'subtitle'  => esc_html__( 'Sticky header appears only if you scroll up', 'herald' ),
                'default'   => false,
            ),

            array(
                'id' => 'color_header_sticky_bg',
                'type' => 'color',
                'title' => esc_html__( 'Background color', 'herald' ),
                'transparent' => false,
                'default' => '#0288d1',
                'required' => array( 'header_sticky', '=', true )
            ),


            array(
                'id' => 'color_header_sticky_txt',
                'type' => 'color',
                'title' => esc_html__( 'Text color', 'herald' ),
                'transparent' => false,
                'default' => '#ffffff',
                'required' => array( 'header_sticky', '=', true )
            ),

            array(
                'id' => 'color_header_sticky_acc',
                'type' => 'color',
                'title' => esc_html__( 'Accent color', 'herald' ),
                'transparent' => false,
                'default' => '#444444',
                'required' => array( 'header_sticky', '=', true )
            ),

             array(
                'id'        => 'header_sticky_left',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Left slot', 'herald' ),
                'subtitle'  => esc_html__( 'Check which elements to add in left slot', 'herald' ),
                'options'   => herald_get_header_elements( 'sticky', 'left'),
                'default'   => herald_get_header_elements( 'sticky', 'left', true ),
                'required' => array( 'header_sticky', '=', true )
            ),

            array(
                'id'        => 'header_sticky_center',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Center slot', 'herald' ),
                'subtitle'  => esc_html__( 'Check which elements to add in center slot', 'herald' ),
                'options'   => herald_get_header_elements( 'sticky', 'center'),
                'default'   => herald_get_header_elements( 'sticky', 'center', true ),
                'required' => array( 'header_sticky', '=', true )
            ),

            array(
                'id'        => 'header_sticky_right',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Right slot', 'herald' ),
                'subtitle'  => esc_html__( 'Check which elements to add in right slot', 'herald' ),
                'options'   => herald_get_header_elements( 'sticky', 'right'),
                'default'   => herald_get_header_elements( 'sticky', 'right', true ),
                'required' => array( 'header_sticky', '=', true )
            ),
)));

/* Mega menu */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Responsive Header', 'herald' ),
        'desc'     => esc_html__( 'Manage settings for responsive header, used for mobiles, tablets and other smaller resolutions)', 'herald' ),
        'subsection' => true,
        'fields'    => array(

        array(
                'id'        => 'header_responsive_breakpoint',
                'type'      => 'slider',
                'title'     => esc_html__( 'Responsive header breakpoint', 'herald' ),
                'subtitle'  => esc_html__( 'Choose exact width of the browser which will trigger responsive header', 'herald' ),
                'desc'  => esc_html__( 'Note: value is in px', 'herald' ),
                'default'   => 1249,
                "min"       => 1024,
                "step"      => 1,
                "max"       => 1249,
                'display_value' => 'text'
        ),
        array(
                'id'        => 'header_responsive_elements',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Responsive menu elements', 'herald' ),
                'subtitle'  => esc_html__( 'Choose which elements you want to add to your main navigation in responsive/mobile menu', 'herald' ),
                'options'   => array(
                        'secondary-menu-1' =>  esc_html__('Secondary menu 1', 'herald'),
                        'secondary-menu-2' =>  esc_html__('Secondary menu 2', 'herald'),
                        'secondary-menu-3' =>  esc_html__('Secondary menu 3', 'herald'),
                        'social-menu' => esc_html__('Social menu', 'herald'), 
                ),
                'default' => array(
                    'social-menu' => false,
                    'secondary-menu-1' => false,
                    'secondary-menu-2' => false,
                    'secondary-menu-3' => false
                )
               
        ),

        array(
                'id'        => 'header_responsive_group',
                'type'      => 'switch',
                'title'     => __( 'Group secondary menus on mobile under "more" link ', 'herald' ),
                'subtitle'  => esc_html__( 'Enable this option if you like to display secondary menus grouped within a single "more" link in responsive/mobile menu', 'herald' ),
                'default'   => false
        ),

         array(
                'id'        => 'header_ad_responsive',
                'type'      => 'switch',
                'title'     => esc_html__( 'Header ad', 'herald' ),
                'subtitle'  => esc_html__( 'Check if you want to display your header ad on mobile devices', 'herald' ),
                'desc'  => esc_html__( 'Note: ad must be added in Header Ad Slot in Theme Options -> Ads', 'herald' ),
                'default'   => false,
        ),
            
)));

/* Mega menu */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Mega Menu', 'herald' ),
        'desc'     => esc_html__( 'Manage settings for mega menu', 'herald' ),
        'subsection' => true,
        'fields'    => array(

        array(
                'id'        => 'mega_menu',
                'type'      => 'switch',
                'title'     => esc_html__( 'Enable mega menu', 'herald' ),
                'subtitle'  => esc_html__( 'Check if you want to enable mega menu functionality', 'herald' ),
                'default'   => true,
        ),

        array(
                'id'        => 'mega_menu_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Mega menu posts layout', 'herald' ),
                'subtitle'  => esc_html__( 'Choose how to display your posts in mega menu', 'herald' ),
                'options'   => herald_get_main_layouts( false, false, array('a', 'a1', 'a2', 'a3', 'b', 'b1', 'c', 'c1', 'd', 'd1', 'e' ) ),
                'default'   => 'i',
                'required' => array( 'mega_menu', '=', true )
        ),

        array(
                'id'        => 'mega_menu_limit',
                'type'      => 'text',
                'class' => 'small-text',
                'title'     => esc_html__( 'Number of posts', 'herald' ),
                'subtitle'  => esc_html__( 'Choose max number of posts in mega menu', 'herald' ),
                'default'   => 4,
                'validate' => 'numeric',
                'required' => array( 'mega_menu', '=', true )
        ),

        array(
                'id'        => 'mega_menu_sub_cat',
                'type'      => 'switch',
                'title'     => esc_html__( 'Display child categories', 'herald' ),
                'subtitle'  => esc_html__( 'If you check this option, links to child categories of a current category will be automatically displayed', 'herald' ),
                'default'   => true,
                'required' => array( 'mega_menu', '=', true )
        ), 
            
)));



/* Content */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-screen',
        'title'     => esc_html__( 'Content', 'herald' ),
        'desc'     => esc_html__( 'Manage your main content styling options', 'herald' ),
        'fields'    => array(

            array(
                'id'        => 'content_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Content layout', 'herald' ),
                'options'   => array(
                    'boxed' => array( 'title' => esc_html__( 'Boxed', 'herald' ),       'img' => get_template_directory_uri().'/assets/img/admin/content_boxed.png' ),
                    'wide' => array( 'title' => esc_html__( 'Wide', 'herald' ),       'img' =>  get_template_directory_uri().'/assets/img/admin/content_full.png' ),
                ),
                'default'   => 'boxed',

            ),

            array(
                'id'       => 'body_background',
                'type'     => 'background',
                'title'    => esc_html__( 'Body background', 'herald' ),
                'subtitle' => esc_html__( 'Setup your body background color, image or pattern', 'herald' ),
                'default'  => array(
                    'background-color' => '#eeeeee',
                ),
                'required' => array( 'content_layout', '=', 'boxed' )
            ),

            array(
                'id' => 'color_content_bg',
                'type' => 'color',
                'title' => esc_html__( 'Content background color', 'herald' ),
                'subtitle' => esc_html__( 'Specify main content background color', 'herald' ),
                'transparent' => false,
                'default' => '#ffffff',
            ),

            array(
                'id' => 'color_content_title',
                'type' => 'color',
                'title' => esc_html__( 'Title (heading) color', 'herald' ),
                'subtitle' => esc_html__( 'This color applies to headings, post/page tiles, widget titles, etc... ', 'herald' ),
                'transparent' => false,
                'default' => '#333333',
            ),

            array(
                'id' => 'color_content_txt',
                'type' => 'color',
                'title' => esc_html__( 'Text color', 'herald' ),
                'subtitle' => esc_html__( 'This color applies to standard text', 'herald' ),
                'transparent' => false,
                'default' => '#444444',
            ),

            array(
                'id' => 'color_content_acc',
                'type' => 'color',
                'title' => esc_html__( 'Accent color', 'herald' ),
                'subtitle' => esc_html__( 'This color applies to links, buttons, pagination, etc...', 'herald' ),
                'transparent' => false,
                'default' => '#0288d1',
            ),

            array(
                'id' => 'color_content_meta',
                'type' => 'color',
                'title' => esc_html__( 'Meta color', 'herald' ),
                'subtitle' => esc_html__( 'This color applies to miscellaneous elements such as meta icons etc...', 'herald' ),
                'transparent' => false,
                'default' => '#999999',
            ),
        ) )
);




/* Footer */

Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-bookmark-empty',
        'title'     => esc_html__( 'Footer', 'herald' ),
        'desc'     => esc_html__( 'Manage options for your footer area', 'herald' ),
        'fields'    => array(
             
             array(
                'id' => 'color_footer_bg',
                'type' => 'color',
                'title' => esc_html__( 'Background color', 'herald' ),
                'subtitle' => esc_html__( 'Specify footer background color', 'herald' ),
                'transparent' => false,
                'default' => '#222222',
            ),

            array(
                'id' => 'color_footer_txt',
                'type' => 'color',
                'title' => esc_html__( 'Text color', 'herald' ),
                'subtitle' => esc_html__( 'This is the standard text color for footer', 'herald' ),
                'transparent' => false,
                'default' => '#dddddd',
            ),

            array(
                'id' => 'color_footer_acc',
                'type' => 'color',
                'title' => esc_html__( 'Accent color', 'herald' ),
                'subtitle' => esc_html__( 'This color will apply to buttons, links, etc...', 'herald' ),
                'transparent' => false,
                'default' => '#0288d1',
            ),

            array(
                'id' => 'color_footer_meta',
                'type' => 'color',
                'title' => esc_html__( 'Meta color', 'herald' ),
                'subtitle' => esc_html__( 'This color will apply to miscellaneous text like date, number of views, etc...', 'herald' ),
                'transparent' => false,
                'default' => '#aaaaaa',
            ),

            array(
                'id' => 'footer_widgets',
                'type' => 'switch',
                'switch' => true,
                'title' => esc_html__( 'Display footer widgetized area', 'herald' ),
                'subtitle' => wp_kses( sprintf( __( 'Check if you want to include footer widgetized area in your theme. You can manage the footer content in the <a href="%s">Apperance -> Widgets</a> settings.', 'herald' ), admin_url( 'widgets.php' ) ), wp_kses_allowed_html( 'post' )),
                'default' => true
            ),

            array(
                'id'        => 'footer_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Footer columns', 'herald' ),
                'subtitle'  => esc_html__( 'Choose number of columns to display in footer area', 'herald' ),
                'desc'  => wp_kses( sprintf( __( 'Note: Each column represents one Footer Sidebar in <a href="%s">Apperance -> Widgets</a> settings.', 'herald' ), admin_url( 'widgets.php' ) ), wp_kses_allowed_html( 'post' ) ),
                'options'   => array(
                    '1_12' => array( 'title' => esc_html__( '1 Column', 'herald' ),       'img' => get_template_directory_uri().'/assets/img/admin/footer_col_1.png' ),
                    '2_6' => array( 'title' => esc_html__( '2 Columns', 'herald' ),       'img' => get_template_directory_uri().'/assets/img/admin/footer_col_2.png' ),
                    '3_4' => array( 'title' => esc_html__( '3 Columns', 'herald' ),       'img' => get_template_directory_uri().'/assets/img/admin/footer_col_3.png' ),
                    '4_3' => array( 'title' => esc_html__( '4 Columns', 'herald' ),       'img' => get_template_directory_uri().'/assets/img/admin/footer_col_4.png' )
                ),
                'default'   => '4_3',
                'required' => array( 'footer_widgets', '=', true )
            ),

            array(
                'id' => 'footer_bottom',
                'type' => 'switch',
                'title' => esc_html__( 'Display footer bottom bar', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display footer bottom bar', 'herald' ),
                'default' => true
            ),

            array(
                'id' => 'footer_copyright',
                'type' => 'editor',
                'title' => esc_html__( 'Copyright', 'herald' ),
                'subtitle' => esc_html__( 'Specify the copyright text to show at the bottom of the website', 'herald' ),
                'default' =>  __( 'Copyright &copy; {current_year}. Created by <a href="http://mekshq.com" target="_blank" rel="nofollow">Meks</a>. Powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a>.', 'herald' ),
                'args'   => array(
                    'textarea_rows'    => 3  ,
                    'default_editor' => 'html'                          ),
                'required' => array( 'footer_bottom', '=', true )
            ),

            array(
                'id'        => 'footer_left',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Left slot', 'herald' ),
                'subtitle'  => esc_html__( 'Check which elements to add in left slot', 'herald' ),
                'options'   => herald_get_footer_elements( 'left'),
                'default'   => herald_get_footer_elements( 'left', true ),
                'required' => array( 'footer_bottom', '=', true )
            ),

            array(
                'id'        => 'footer_center',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Center slot', 'herald' ),
                'subtitle'  => esc_html__( 'Check which elements to add in center slot', 'herald' ),
                'options'   => herald_get_footer_elements( 'center'),
                'default'   => herald_get_footer_elements( 'center', true ),
                'required' => array( 'footer_bottom', '=', true )
            ),

            array(
                'id'        => 'footer_right',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Right slot', 'herald' ),
                'subtitle'  => esc_html__( 'Check which elements to add in right slot', 'herald' ),
                'options'   => herald_get_footer_elements( 'right'),
                'default'   => herald_get_footer_elements( 'right', true ),
                'required' => array( 'footer_bottom', '=', true )
            ),


        ) )
);

/* Sidebars */
Redux::setSection( $opt_name , array(
        'icon'      => ' el-icon-list',
        'title'     => esc_html__( 'Sidebars', 'herald' ),
        'class'     => 'sidgen',
        'desc' => wp_kses( sprintf( __( 'Use this panel to generate additional sidebars. You can manage sidebars content in the <a href="%s">Apperance -> Widgets</a> settings.', 'herald' ), admin_url( 'widgets.php' ) ), wp_kses_allowed_html( 'post' ) ),
        'fields'    => array( 

            array(
                'id'        => 'sidebars',
                'type'      => 'sidgen',
                'title'     => '',
            ),
        ) ) );

/* Layout settings */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-th-large',
        'title'     => esc_html__( 'Main Layouts', 'herald' ),
        'heading' => false,
        'fields'    => array(
        ) )
);


/* Layout A */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout A', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            array(
                'id'        => 'section_layout_a',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_a.png' ).'"/>'.esc_html__( 'Layout A', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout A', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_a_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout A', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_a_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout A', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date', 'comments') )
            ),

            array(
                'id' => 'lay_a_content',
                'type' => 'radio',
                'title' => esc_html__( 'Layout A content type', 'herald' ),
                'options' => array( 
                    'excerpt' =>  esc_html__('Excerpt (automatically limit number of characters)', 'herald' ),
                    'content' =>  esc_html__('Full content (optionally split with "<--more-->" tag)', 'herald'),
                    'none' =>  esc_html__('None', 'herald')
                 ),
                'subtitle' => esc_html__( 'Choose content type', 'herald' ),
                'default' => 'excerpt'
            ),

            array(
                'id' => 'lay_a_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Excerpt limit', 'herald' ),
                'subtitle' => esc_html__( 'Specify your excerpt limit', 'herald' ),
                'desc' => esc_html__( 'Note: Value represents number of characters', 'herald' ),
                'default' => '290',
                'validate' => 'numeric',
                'required'  => array( 'lay_a_content', '=', 'excerpt' )
            ),

            array(
                'id' => 'lay_a_rm',
                'type' => 'switch',
                'title' => esc_html__( 'Read more link', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to enable read more link for Layout A', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'img_size_lay_a_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Layout A image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio for Layout A', 'herald' ),
                'options'   => herald_get_image_ratio_opts(),
                'default'   => '16_9',
            ),

            array(
                'id'        => 'img_size_lay_a_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Layout A image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio for Layout A images', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_a_ratio', '=', 'custom' ),
            ),

        ) ) );

/* Layout A1 */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout A1', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_a1',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_a1.png' ).'"/>'.esc_html__( 'Layout A1', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout A1', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_a1_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout A1', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_a1_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout A1', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date', 'comments') )
            ),

            array(
                'id' => 'lay_a1_excerpt',
                'type' => 'switch',
                'title' => esc_html__( 'Layout A1 excerpt', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to show a text excerpt for posts in Layout A1', 'herald' ),
                'default' => false
            ),


            array(
                'id' => 'lay_a1_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Excerpt limit', 'herald' ),
                'subtitle' => esc_html__( 'Specify your excerpt limit', 'herald' ),
                'desc' => esc_html__( 'Note: Value represents number of characters', 'herald' ),
                'default' => '290',
                'validate' => 'numeric',
                'required'  => array( 'lay_a1_excerpt', '=', true )
            ),

            array(
                'id' => 'lay_a1_rm',
                'type' => 'switch',
                'title' => esc_html__( 'Read more link', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to enable read more link for Layout A1', 'herald' ),
                'default' => false,
                'required'  => array( 'lay_a1_excerpt', '=', true )
            ),

            array(
                'id'        => 'img_size_lay_a1_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Layout A1 image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio for Layout A1', 'herald' ),
                'options'   => herald_get_image_ratio_opts(),
                'default'   => '16_9',
            ),

            array(
                'id'        => 'img_size_lay_a1_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Layout A1 image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio for Layout A1 images', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_a1_ratio', '=', 'custom' ),
            ),

        ) ) );

/* Layout A2 */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout A2', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_a2',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_a2.png' ).'"/>'.esc_html__( 'Layout A2', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout A2', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_a2_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout A2', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_a2_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout A2', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date', 'comments') )
            ),

            array(
                'id' => 'lay_a2_excerpt',
                'type' => 'switch',
                'title' => esc_html__( 'Layout A2 excerpt', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to show a text excerpt for posts in Layout A2', 'herald' ),
                'default' => true
            ),


            array(
                'id' => 'lay_a2_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Excerpt limit', 'herald' ),
                'subtitle' => esc_html__( 'Specify your excerpt limit', 'herald' ),
                'desc' => esc_html__( 'Note: Value represents number of characters', 'herald' ),
                'default' => '250',
                'validate' => 'numeric',
                'required'  => array( 'lay_a2_excerpt', '=', true )
            ),

            array(
                'id' => 'lay_a2_rm',
                'type' => 'switch',
                'title' => esc_html__( 'Read more link', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to enable read more link for Layout A2', 'herald' ),
                'default' => false,
                'required'  => array( 'lay_a2_excerpt', '=', true )
            ),

            array(
                'id'        => 'img_size_lay_a2_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Layout A2 image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio for Layout A2', 'herald' ),
                'options'   => herald_get_image_ratio_opts(),
                'default'   => '16_9',
            ),

            array(
                'id'        => 'img_size_lay_a2_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Layout A2 image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio for Layout A2 images', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_a2_ratio', '=', 'custom' ),
            ),

        ) ) );

/* Layout A3 */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout A3', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_a3',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_a3.png' ).'"/>'.esc_html__( 'Layout A3', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout A3', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_a3_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout A3', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_a3_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout A3', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date', 'comments') )
            ),

            array(
                'id' => 'lay_a3_excerpt',
                'type' => 'switch',
                'title' => esc_html__( 'Layout A3 excerpt', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to show a text excerpt for posts in Layout A3', 'herald' ),
                'default' => true
            ),


            array(
                'id' => 'lay_a3_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Excerpt limit', 'herald' ),
                'subtitle' => esc_html__( 'Specify your excerpt limit', 'herald' ),
                'desc' => esc_html__( 'Note: Value represents number of characters', 'herald' ),
                'default' => '250',
                'validate' => 'numeric',
                'required'  => array( 'lay_a3_excerpt', '=', true )
            ),

            array(
                'id' => 'lay_a3_rm',
                'type' => 'switch',
                'title' => esc_html__( 'Read more link', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to enable read more link for Layout A3', 'herald' ),
                'default' => true,
                'required'  => array( 'lay_a3_excerpt', '=', true )
            ),

            array(
                'id'        => 'img_size_lay_a3_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Layout A3 image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio for Layout A3', 'herald' ),
                'options'   => herald_get_image_ratio_opts(),
                'default'   => '16_9',
            ),

            array(
                'id'        => 'img_size_lay_a3_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Layout A3 image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio for Layout A3 images', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_a3_ratio', '=', 'custom' ),
            ),

        ) ) );



/* Layout B */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout B', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(

            array(
                'id'        => 'section_layout_b',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_b.png' ).'"/>'.esc_html__( 'Layout B', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout B', 'herald' ),
                'indent' => false
            ),

            array(
                'id' => 'lay_b_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout B', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_b_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout B', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date', 'comments') )
            ),

            array(
                'id' => 'lay_b_excerpt',
                'type' => 'switch',
                'title' => esc_html__( 'Layout B excerpt', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to show a text excerpt for posts in Layout B', 'herald' ),
                'default' => true
            ),

            array(
                'id' => 'lay_b_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Excerpt limit', 'herald' ),
                'subtitle' => esc_html__( 'Specify your excerpt limit', 'herald' ),
                'desc' => esc_html__( 'Note: Value represents number of characters', 'herald' ),
                'default' => '170',
                'validate' => 'numeric',
                'required'  => array( 'lay_b_excerpt', '=', true )
            ),

            array(
                'id' => 'lay_b_rm',
                'type' => 'switch',
                'title' => esc_html__( 'Read more link', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to enable read more link for Layout B', 'herald' ),
                'default' => true,
                'required'  => array( 'lay_b_excerpt', '=', true )
            ),

             array(
                'id'        => 'img_size_lay_b_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Layout B image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio for Layout B', 'herald' ),
                'options'   => herald_get_image_ratio_opts(),
                'default'   => '16_9',
            ),

            array(
                'id'        => 'img_size_lay_b_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Layout B image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio for Layout B images', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_b_ratio', '=', 'custom' ),
            ),

        ) ) );


/* Layout B1 */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout B1', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_b1',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_b1.png' ).'"/>'.esc_html__( 'Layout B1', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout B1', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_b1_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout B1', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_b1_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout B1', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date', 'comments') )
            ),

            array(
                'id' => 'lay_b1_excerpt',
                'type' => 'switch',
                'title' => esc_html__( 'Layout B1 excerpt', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to show a text excerpt for posts in Layout B1', 'herald' ),
                'default' => true
            ),


            array(
                'id' => 'lay_b1_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Excerpt limit', 'herald' ),
                'subtitle' => esc_html__( 'Specify your excerpt limit', 'herald' ),
                'desc' => esc_html__( 'Note: Value represents number of characters', 'herald' ),
                'default' => '160',
                'validate' => 'numeric',
                'required'  => array( 'lay_b1_excerpt', '=', true )
            ),

            array(
                'id' => 'lay_b1_rm',
                'type' => 'switch',
                'title' => esc_html__( 'Read more link', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to enable read more link for Layout B1', 'herald' ),
                'default' => false,
                'required'  => array( 'lay_b1_excerpt', '=', true )
            ),

            array(
                'id'        => 'img_size_lay_b1_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Layout B1 image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio for Layout B1', 'herald' ),
                'options'   => herald_get_image_ratio_opts(),
                'default'   => '3_2',
            ),

            array(
                'id'        => 'img_size_lay_b1_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Layout B1 image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio for Layout B1 images', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_b1_ratio', '=', 'custom' ),
            ),

        ) ) );

/* Layout C */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout C', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_c',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_c.png' ).'"/>'.esc_html__( 'Layout C', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout C', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_c_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout C', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_c_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout C', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date') )
            ),

            array(
                'id' => 'lay_c_excerpt',
                'type' => 'switch',
                'title' => esc_html__( 'Layout C excerpt', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to show a text excerpt for posts in Layout C', 'herald' ),
                'default' => true
            ),


            array(
                'id' => 'lay_c_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Excerpt limit', 'herald' ),
                'subtitle' => esc_html__( 'Specify your excerpt limit', 'herald' ),
                'desc' => esc_html__( 'Note: Value represents number of characters', 'herald' ),
                'default' => '150',
                'validate' => 'numeric',
                'required'  => array( 'lay_c_excerpt', '=', true )
            ),

            array(
                'id' => 'lay_c_rm',
                'type' => 'switch',
                'title' => esc_html__( 'Read more link', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to enable read more link for Layout C', 'herald' ),
                'default' => false,
                'required'  => array( 'lay_c_excerpt', '=', true )
            ),

            array(
                'id'        => 'img_size_lay_c_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Layout C image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio for Layout C', 'herald' ),
                'options'   => herald_get_image_ratio_opts(),
                'default'   => '16_9',
            ),

            array(
                'id'        => 'img_size_lay_c_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Layout C image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio for Layout C images', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_c_ratio', '=', 'custom' ),
            ),

        ) ) );

/* Layout C1 */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout C1', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_c1',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_c1.png' ).'"/>'.esc_html__( 'Layout C1', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout C1', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_c1_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout C1', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_c1_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout C1', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date') )
            ),

            array(
                'id' => 'lay_c1_excerpt',
                'type' => 'switch',
                'title' => esc_html__( 'Layout C1 excerpt', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to show a text excerpt for posts in Layout C1', 'herald' ),
                'default' => false
            ),


            array(
                'id' => 'lay_c1_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Excerpt limit', 'herald' ),
                'subtitle' => esc_html__( 'Specify your excerpt limit', 'herald' ),
                'desc' => esc_html__( 'Note: Value represents number of characters', 'herald' ),
                'default' => '150',
                'validate' => 'numeric',
                'required'  => array( 'lay_c1_excerpt', '=', true )
            ),

            array(
                'id' => 'lay_c1_rm',
                'type' => 'switch',
                'title' => esc_html__( 'Read more link', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to enable read more link for Layout C1', 'herald' ),
                'default' => false,
                'required'  => array( 'lay_c1_excerpt', '=', true )
            ),

            array(
                'id'        => 'img_size_lay_c1_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Layout C1 image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio for Layout C1', 'herald' ),
                'options'   => herald_get_image_ratio_opts(),
                'default'   => '3_2',
            ),

            array(
                'id'        => 'img_size_lay_c1_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Layout C1 image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio for Layout C1 images', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_c1_ratio', '=', 'custom' ),
            ),

        ) ) );


/* Layout D */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout D', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_d',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_d.png' ).'"/>'.esc_html__( 'Layout D', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout D', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_d_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout D', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_d_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout D', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date') )
            ),

            array(
                'id'        => 'img_size_lay_d_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Layout D image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio for Layout D', 'herald' ),
                'options'   => herald_get_image_ratio_opts(),
                'default'   => '16_9',
            ),

            array(
                'id'        => 'img_size_lay_d_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Layout D image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio for Layout D images', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_d_ratio', '=', 'custom' ),
            ),

        ) ) );

/* Layout D1 */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout D1', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_d1',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_d1.png' ).'"/>'.esc_html__( 'Layout D1', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout D1', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_d1_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout D1', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_d1_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout D1', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date') )
            ),

            array(
                'id'        => 'img_size_lay_d1_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Layout D1 image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio for Layout D1', 'herald' ),
                'options'   => herald_get_image_ratio_opts(),
                'default'   => '3_2',
            ),

            array(
                'id'        => 'img_size_lay_d1_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Layout D1 image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio for Layout D1 images', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_d1_ratio', '=', 'custom' ),
            ),

        ) ) );

/* Layout E */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout E', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_e',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_e.png' ).'"/>'.esc_html__( 'Layout E', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout E', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_e_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout E', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_e_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout E', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date') )
            ),

            array(
                'id' => 'lay_e_excerpt',
                'type' => 'switch',
                'title' => esc_html__( 'Layout E excerpt', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to show a text excerpt for posts in Layout E', 'herald' ),
                'default' => false
            ),


            array(
                'id' => 'lay_e_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Excerpt limit', 'herald' ),
                'subtitle' => esc_html__( 'Specify your excerpt limit', 'herald' ),
                'desc' => esc_html__( 'Note: Value represents number of characters', 'herald' ),
                'default' => '150',
                'validate' => 'numeric',
                'required'  => array( 'lay_e_excerpt', '=', true )
            ),

        ) ) );

/* Layout F */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout F', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_f',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_f.png' ).'"/>'.esc_html__( 'Layout F', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout F', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_f_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout F', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_f_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout F', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date') )
            ),

            array(
                'id' => 'lay_f_excerpt',
                'type' => 'switch',
                'title' => esc_html__( 'Layout F excerpt', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to show a text excerpt for posts in Layout F', 'herald' ),
                'default' => false
            ),


            array(
                'id' => 'lay_f_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Excerpt limit', 'herald' ),
                'subtitle' => esc_html__( 'Specify your excerpt limit', 'herald' ),
                'desc' => esc_html__( 'Note: Value represents number of characters', 'herald' ),
                'default' => '80',
                'validate' => 'numeric',
                'required'  => array( 'lay_f_excerpt', '=', true )
            ),

            array(
                'id'        => 'img_size_lay_f_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Layout F image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio for Layout F', 'herald' ),
                'options'   => herald_get_image_ratio_opts(),
                'default'   => '16_9',
            ),

            array(
                'id'        => 'img_size_lay_f_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Layout F image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio for Layout F images', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_f_ratio', '=', 'custom' ),
            ),

        ) ) );

/* Layout F1 */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout F1', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_f1',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_f1.png' ).'"/>'.esc_html__( 'Layout F1', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout F1', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_f1_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout F1', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_f1_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout F1', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date') )
            ),

            array(
                'id' => 'lay_f1_excerpt',
                'type' => 'switch',
                'title' => esc_html__( 'Layout F1 excerpt', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to show a text excerpt for posts in Layout F1', 'herald' ),
                'default' => false
            ),


            array(
                'id' => 'lay_f1_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Excerpt limit', 'herald' ),
                'subtitle' => esc_html__( 'Specify your excerpt limit', 'herald' ),
                'desc' => esc_html__( 'Note: Value represents number of characters', 'herald' ),
                'default' => '80',
                'validate' => 'numeric',
                'required'  => array( 'lay_f1_excerpt', '=', true )
            ),

            array(
                'id'        => 'img_size_lay_f1_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Layout F1 image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio for Layout F1', 'herald' ),
                'options'   => herald_get_image_ratio_opts(),
                'default'   => '3_2',
            ),

            array(
                'id'        => 'img_size_lay_f1_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Layout F1 image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio for Layout F1 images', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_f1_ratio', '=', 'custom' ),
            ),

        ) ) );

/* Layout G */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout G', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_g',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_g.png' ).'"/>'.esc_html__( 'Layout G', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout G', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_g_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout G', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_g_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout G', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('none') )
            ),

            array(
                'id'        => 'img_size_lay_g_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Layout G image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio for Layout G', 'herald' ),
                'options'   => herald_get_image_ratio_opts(),
                'default'   => '3_2',
            ),

            array(
                'id'        => 'img_size_lay_g_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Layout G image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio for Layout G images', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_g_ratio', '=', 'custom' ),
            ),

        ) ) );

/* Layout G1 */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout G1', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_g1',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_g1.png' ).'"/>'.esc_html__( 'Layout G1', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout G1', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_g1_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout G1', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_g1_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout G1', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('none') )
            ),

            array(
                'id'        => 'img_size_lay_g1_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Layout G1 image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio for Layout G1', 'herald' ),
                'options'   => herald_get_image_ratio_opts(),
                'default'   => '4_3',
            ),

            array(
                'id'        => 'img_size_lay_g1_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Layout G1 image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio for Layout G1 images', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_g1_ratio', '=', 'custom' ),
            ),

        ) ) );


/* Layout H */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout H', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_h',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_h.png' ).'"/>'.esc_html__( 'Layout H', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout H', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_h_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout H', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_h_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout H', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date') )
            ),

            array(
                'id' => 'lay_h_excerpt',
                'type' => 'switch',
                'title' => esc_html__( 'Layout H excerpt', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to show a text excerpt for posts in Layout H', 'herald' ),
                'default' => false
            ),


            array(
                'id' => 'lay_h_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Excerpt limit', 'herald' ),
                'subtitle' => esc_html__( 'Specify your excerpt limit', 'herald' ),
                'desc' => esc_html__( 'Note: Value represents number of characters', 'herald' ),
                'default' => '80',
                'validate' => 'numeric',
                'required'  => array( 'lay_h_excerpt', '=', true )
            ),

        ) ) );

/* Layout I */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout I', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_i',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_i.png' ).'"/>'.esc_html__( 'Layout I', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout I', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_i_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout I', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_i_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout I', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date' ) )
            ),

            array(
                'id'        => 'img_size_lay_i_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Layout I image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio for Layout I', 'herald' ),
                'options'   => herald_get_image_ratio_opts(),
                'default'   => '16_9',
            ),

            array(
                'id'        => 'img_size_lay_i_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Layout I image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio for Layout I images', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_i_ratio', '=', 'custom' ),
            ),

        ) ) );

/* Layout I1 */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout I1', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_i1',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_i1.png' ).'"/>'.esc_html__( 'Layout I1', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout I1', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_i1_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout I1', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_i1_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout I1', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('none' ) )
            ),

            array(
                'id'        => 'img_size_lay_i1_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Layout I1 image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio for Layout I1', 'herald' ),
                'options'   => herald_get_image_ratio_opts(),
                'default'   => '4_3',
            ),

            array(
                'id'        => 'img_size_lay_i1_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Layout I1 image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio for Layout I1 images', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_i1_ratio', '=', 'custom' ),
            ),

        ) ) );


/* Layout J */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout J', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_j',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_j.png' ).'"/>'.esc_html__( 'Layout J', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout J', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_j_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout J', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_j_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout J', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date') )
            ),

        ) ) );

/* Layout K */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout K', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_k',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_k.png' ).'"/>'.esc_html__( 'Layout k', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout K', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_k_title',
                'type' => 'switch',
                'title' => esc_html__( 'Display post title', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display post titles for posts in Layout K', 'herald' ),
                'default' => true
            ),

            array(
                'id' => 'lay_k_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout K', 'herald' ),
                'default' => false
            ),

            array(
                'id'        => 'lay_k_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout K', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array( 'none') )
            ),

            array(
                'id'        => 'img_size_lay_k_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Layout L image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio for Layout K', 'herald' ),
                'options'   => herald_get_image_ratio_opts(),
                'default'   => '3_2',
            ),

            array(
                'id'        => 'img_size_lay_k_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Layout K image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio for Layout L images', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_l_ratio', '=', 'custom' ),
            ),

        ) ) );

/* Layout L */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout L', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_l',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_l.png' ).'"/>'.esc_html__( 'Layout L', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for posts displayed in Layout L', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_l_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link for posts in Layout L', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_l_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for posts in Layout L', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('none') )
            ),

        ) ) );

/* Featured Layouts */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-stop',
        'title'     => esc_html__( 'Featured Layouts', 'herald' ),
        'heading' => false,
        'fields'    => array(
        ) )
);

/* FA Layout 1 */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout 1', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_fa1',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_fa1.png' ).'"/>'.esc_html__( 'Layout 1', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for featured area Layout 1', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_fa1_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_fa1_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date', 'comments') )
            ),

            array(
                'id' => 'lay_fa1_excerpt',
                'type' => 'switch',
                'title' => esc_html__( 'Display text excerpt', 'herald' ),
                'default' => true
            ),


            array(
                'id' => 'lay_fa1_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Excerpt limit', 'herald' ),
                'desc' => esc_html__( 'Note: Value represents number of characters', 'herald' ),
                'default' => '150',
                'validate' => 'numeric',
                'required'  => array( 'lay_fa1_excerpt', '=', true )
            ),

            array(
                'id' => 'lay_fa1_color',
                'type' => 'switch',
                'title' => esc_html__( 'Apply category color background overlay', 'herald' ),
                'default' => false
            ),

        ) ) );



/* FA Layout 2 */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout 2', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_fa2',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_fa2.png' ).'"/>'.esc_html__( 'Layout 2', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for featured area Layout 2', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_fa2_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_fa2_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date', 'comments') )
            ),

            array(
                'id' => 'lay_fa2_excerpt',
                'type' => 'switch',
                'title' => esc_html__( 'Display text excerpt', 'herald' ),
                'default' => true
            ),


            array(
                'id' => 'lay_fa2_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Excerpt limit', 'herald' ),
                'desc' => esc_html__( 'Note: Value represents number of characters', 'herald' ),
                'default' => '70',
                'validate' => 'numeric',
                'required'  => array( 'lay_fa2_excerpt', '=', true )
            ),

            array(
                'id' => 'lay_fa2_color',
                'type' => 'switch',
                'title' => esc_html__( 'Apply category color background overlay', 'herald' ),
                'default' => false
            ),

        ) ) );

/* FA Layout 3 */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout 3', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_fa3',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_fa3.png' ).'"/>'.esc_html__( 'Layout 3', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for featured area Layout 3', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_fa3_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_fa3_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('comments') )
            ),

            array(
                'id' => 'lay_fa3_excerpt',
                'type' => 'switch',
                'title' => esc_html__( 'Display text excerpt', 'herald' ),
                'default' => true
            ),


            array(
                'id' => 'lay_fa3_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Excerpt limit', 'herald' ),
                'desc' => esc_html__( 'Note: Value represents number of characters', 'herald' ),
                'default' => '150',
                'validate' => 'numeric',
                'required'  => array( 'lay_fa3_excerpt', '=', true )
            ),

            array(
                'id' => 'lay_fa3_color',
                'type' => 'switch',
                'title' => esc_html__( 'Apply category color background overlay', 'herald' ),
                'default' => false
            ),

        ) ) );

/* FA Layout 4 */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout 4', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_fa4',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_fa4.png' ).'"/>'.esc_html__( 'Layout 4', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for featured area Layout 4', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_fa4_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_fa4_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('comments') )
            ),

            array(
                'id' => 'lay_fa4_excerpt',
                'type' => 'switch',
                'title' => esc_html__( 'Display text excerpt', 'herald' ),
                'default' => true
            ),


            array(
                'id' => 'lay_fa4_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Excerpt limit', 'herald' ),
                'desc' => esc_html__( 'Note: Value represents number of characters', 'herald' ),
                'default' => '150',
                'validate' => 'numeric',
                'required'  => array( 'lay_fa4_excerpt', '=', true )
            ),

            array(
                'id' => 'lay_fa4_color',
                'type' => 'switch',
                'title' => esc_html__( 'Apply category color background overlay', 'herald' ),
                'default' => false
            ),

        ) ) );

/* FA Layout 5 */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout 5', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_layout_fa5',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url( get_template_directory_uri().'/assets/img/admin/layout_fa5.png' ).'"/>'.esc_html__( 'Layout 5', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for featured area Layout 5', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_fa5_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_fa5_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('date', 'comments') )
            )

        ) ) );

/* Single Post */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-pencil',
        'title'     => esc_html__( 'Single Post', 'herald' ),
        'heading' => false,
        'fields'    => array(
        ) )
);

/* Single - Layout */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Layout', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_single_layout',
                'type'      => 'section',
                'title'     => esc_html__( 'Layout', 'herald' ),
                'subtitle'  => esc_html__( 'Manage your default layout and sidebar options for single posts', 'herald' ),
                'indent'   => false
            ),

            array(
                'id'        => 'single_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Single post layout', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a default layout for single posts', 'herald' ),
                'desc' => esc_html__( 'Note: You can override this option for each specific post', 'herald' ),
                'options'   => herald_get_single_layouts(),
                'default'   => 1
            ),

            array(
                'id'        => 'single_use_sidebar',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Display sidebar', 'herald' ),
                'desc' => esc_html__( 'Note: You can override this option for each particular post', 'herald' ),
                'options'   => herald_get_sidebar_layouts(),
                'default'   => 'right'
            ),

            array(
                'id'        => 'single_sidebar',
                'type'      => 'select',
                'title'     => esc_html__( 'Post standard sidebar', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a single post standard sidebar', 'herald' ),
                'options'   => herald_get_sidebars_list(),
                'default'   => 'herald_default_sidebar',
                'required'  => array( 'single_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'single_sticky_sidebar',
                'type'      => 'select',
                'title'     => esc_html__( 'Post sticky sidebar', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a single post sticky sidebar', 'herald' ),
                'options'   => herald_get_sidebars_list(),
                'default'   => 'herald_default_sticky_sidebar',
                'required'  => array( 'single_use_sidebar', '!=', 'none' )
            ),

  

        ) ) );

/* Single - Content */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Content', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_single_content',
                'type'      => 'section',
                'title'     => esc_html__( 'Content', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for single post content', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'single_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Display category link', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a category link', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'lay_single_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data ( list )', 'herald' ),
                'subtitle'  => esc_html__( 'Check which meta data to show for single posts', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array( 'date', 'views', 'rtime' ) )
            ),

            array(
                'id' => 'single_fimg',
                'type' => 'switch',
                'title' => esc_html__( 'Display featured image', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display the featured image', 'herald' ),
                'default' => true
            ),

             array(
                'id' => 'single_fimg_cap',
                'type' => 'switch',
                'title' => esc_html__( 'Display featured image caption', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display a caption/description on the featured image', 'herald' ),
                'default' => true,
                'required'  => array( 'single_fimg', '=', true )
            ),

            array(
                'id'        => 'img_size_lay_single_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Featured image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio', 'herald' ),
                'options'   => herald_get_image_ratio_opts( true ),
                'default'   => 'original',
            ),

            array(
                'id'        => 'img_size_lay_single_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Featured image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio ', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_single_ratio', '=', 'custom' ),
            ),

            array(
                'id' => 'single_headline',
                'type' => 'switch',
                'title' => esc_html__( 'Display headline (excerpt)', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display post excerpt at the begining of post', 'herald' ),
                'default' => true,
            ),

            array(
                'id' => 'single_tags',
                'type' => 'switch',
                'title' => esc_html__( 'Display tags', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display tags below the post content', 'herald' ),
                'default' => true
            ),
  

        ) ) );

/* Single - Meta */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Meta bar', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            
            array(
                'id'        => 'section_single_meta',
                'type'      => 'section',
                'title'     => esc_html__( 'Meta bar', 'herald' ),
                'subtitle'  => esc_html__( 'Manage options for vertical meta bar on single posts', 'herald' ),
                'indent'   => false
            ),



            array(
                'id'        => 'single_meta_bar_position',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Meta bar layout', 'herald' ),
                'desc' => esc_html__( 'Note: You can override this option for each particular post', 'herald' ),
                'options'   => herald_get_meta_bar_layouts(),
                'default'   => 'left'
            ),

            array(
                'id' => 'single_meta_bar_sticky',
                'type' => 'switch',
                'title' => esc_html__( 'Make meta bar sticky ', 'herald' ),
                'subtitle' => esc_html__( 'Check this option if you want meta bar to stick to top while scrolling', 'herald' ),
                'default' => false
            ),
            

            array(
                'id' => 'single_avatar',
                'type' => 'switch',
                'title' => esc_html__( 'Display author image', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display author avatar', 'herald' ),
                'default' => true
            ),

            array(
                'id'        => 'single_author_social_links',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Author social links', 'herald' ),
                'subtitle'  => esc_html__( 'Check which social links you want to display below the author avatar', 'herald' ),
                'desc'      => esc_html__( 'Note: The social URLs for each author must be present in its profile settings', 'herald' ),
                'options'   => herald_get_author_social_opts(),
                'default'   => herald_get_author_social_opts( array('twitter') ),
                'required'  => array('single_avatar', '=', true )
            ),

            array(
                'id'        => 'lay_single_big_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data ( big )', 'herald' ),
                'subtitle'  => esc_html__( 'Check what big meta data to show for single posts', 'herald' ),
                'options'   => herald_get_meta_opts(),
                'default' => herald_get_meta_opts( array('comments') )
            ),

            array(
                'id' => 'single_share',
                'type' => 'switch',
                'title' => esc_html__( 'Display share icon', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display share icon', 'herald' ),
                'default' => true
            ),

            array(
                'id' => 'single_meta_ad',
                'type' => 'radio',
                'title' => esc_html__( 'Display ad', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display ad inside meta bar', 'herald' ),
                'options' => array( 
                    'top' =>  esc_html__('At the top of meta bar'),
                    'bottom' =>  esc_html__('At the bottom of meta bar'),
                    'none' =>  esc_html__('Do not display'),
                 ),
                'default' => 'top'
            ),

        ) ) );

/* Single - Extras */
Redux::setSection( $opt_name , array(
        'icon'      => '',
        'title'     => esc_html__( 'Extras', 'herald' ),
        'heading' => false,
        'subsection' => true,
        'fields'    => array(
            


            array(
                'id' => 'single_author',
                'type' => 'switch',
                'title' => esc_html__( 'Display author area', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to display the "about the author" area.', 'herald' ),
                'default' => true
            ),

            array(
                'id' => 'single_paginated_nav_position',
                'type' => 'radio',
                'title' => esc_html__( 'Display paginated post navigation', 'herald' ),
                'subtitle' => esc_html__( 'Check where do you want to display paging navigation for paginated posts', 'herald' ),
                'options' => array( 
                    'above' =>  esc_html__('Above content'),
                    'below' =>  esc_html__('Below content'),
                    'abovebelow' =>  esc_html__('Above and below content'),
                 ),
                'default' => 'above'
            ),

            array(
                'id' => 'single_comment_form',
                'type' => 'radio',
                'title' => esc_html__( 'Display comment form', 'herald' ),
                'subtitle' => esc_html__( 'Check where do you want to display comment form', 'herald' ),
                'options' => array( 
                    'above' =>  esc_html__('Above comments list'),
                    'below' =>  esc_html__('Below comments list'),
                 ),
                'default' => 'above'
            ),

            array(
                'id' => 'single_infinite_scroll',
                'type' => 'switch',
                'title' => esc_html__( 'Infinite scroll', 'herald' ),
                'subtitle' => esc_html__( 'Enable infinite scroll loading for single posts', 'herald' ),
                'default' => false
            ),

            array(
                'id'        => 'section_single_sticky',
                'type'      => 'section',
                'title'     => esc_html__( 'Sticky bar', 'herald' ),
                'subtitle'  => esc_html__( 'Sticky bottom bar options', 'herald' ),
                'indent'   => false
            ),

            array(
                'id' => 'single_sticky_bar',
                'type' => 'switch',
                'title' => esc_html__( 'Display sticky bottom bar', 'herald' ),
                'default' => true
            ),

            array(
                'id' => 'single_sticky_prevnext',
                'type' => 'switch',
                'title' => esc_html__( 'Display prev/next posts', 'herald' ),
                'subtitle'  => esc_html__( 'Check if you want to display previous and next post links in sticky bar', 'herald' ),
                'default' => true,
                'required'  => array( 'single_sticky_bar', '=', true )
            ),

            array(
                'id' => 'single_prevnext_same_cat',
                'type' => 'switch',
                'title' => esc_html__( 'Get prev/next posts from the same category', 'herald' ),
                'subtitle'  => esc_html__( 'Check if previous and next post will be pulled from the same category as current post', 'herald' ),
                'default' => true,
                'required'  => array( 'single_sticky_prevnext', '=', true )
            ),

            array(
                'id' => 'single_sticky_comments',
                'type' => 'switch',
                'title' => esc_html__( 'Display comments button', 'herald' ),
                'subtitle'  => esc_html__( 'Check if you want to display comments button in sticky bar', 'herald' ),
                'default' => true,
                'required'  => array( 'single_sticky_bar', '=', true )
            ),

            array(
                'id' => 'single_sticky_share',
                'type' => 'switch',
                'title' => esc_html__( 'Display share buttons', 'herald' ),
                'subtitle'  => esc_html__( 'Check if you want to display share buttons in sticky bar', 'herald' ),
                'default' => true,
                'required'  => array( 'single_sticky_bar', '=', true )
            ),

            array(
                'id' => 'section_related',
                'type' => 'section',
                'title' => esc_html__( 'Related posts', 'herald' ),
                'subtitle' => esc_html__( 'These are options for the related posts area below the single post', 'herald' ),
                'indent' => false
            ),

            array(
                'id' => 'single_related',
                'type' => 'switch',
                'title' => esc_html__( 'Display "related" posts box', 'herald' ),
                'subtitle' => esc_html__( 'Choose if you want to display an additional area with related posts below the post content', 'herald' ),
                'default' => true
            ),
            
            array(
                'id'        => 'related_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Related posts layout', 'herald' ),
                'subtitle'  => esc_html__( 'Choose how to display your related posts', 'herald' ),
                'options'   => herald_get_main_layouts(),
                'default'   => 'f1'
            ),
            

            array(
                'id'        => 'related_limit',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Related area posts number limit', 'herald' ),
                'default'   => 3,
                'validate'  => 'numeric',
                'required'  => array( 'single_related', '=', true ),
            ),

            array(
                'id'        => 'related_type',
                'type'      => 'radio',
                'title'     => esc_html__( 'Related area chooses from posts', 'herald' ),
                'options'   => array(
                    'cat' => esc_html__( 'Located in the same category', 'herald' ),
                    'tag' => esc_html__( 'Tagged with at least one same tag', 'herald' ),
                    'cat_or_tag' => esc_html__( 'Located in the same category OR tagged with a same tag', 'herald' ),
                    'cat_and_tag' => esc_html__( 'Located in the same category AND tagged with a same tag', 'herald' ),
                    'author' => esc_html__( 'By the same author', 'herald' ),
                    '0' => esc_html__( 'All posts', 'herald' )
                ),
                'default'   => 'cat',
                'required'  => array( 'single_related', '=', true ),
            ),

            array(
                'id'        => 'related_order',
                'type'      => 'radio',
                'title'     => esc_html__( 'Related posts are ordered by', 'herald' ),
                'options'   => herald_get_post_order_opts(),
                'default'   => 'date',
                'required'  => array( 'single_related', '=', true ),
            ),

            array(
                'id'        => 'related_time',
                'type'      => 'radio',
                'title'     => esc_html__( 'Related posts are not older than', 'herald' ),
                'options'   => herald_get_time_diff_opts(),
                'default'   => '0',
                'required'  => array( 'single_related', '=', true ),
            )
  

        ) ) );

/* Page */
Redux::setSection( $opt_name ,  array(
        'icon'      => 'el-icon-file-edit',
        'title'     => esc_html__( 'Page', 'herald' ),
        'desc'     => esc_html__( 'Manage default settings for your pages', 'herald' ),
        'fields'    => array(

            array(
                'id'        => 'page_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Page layout', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a default layout for your pages', 'herald' ),
                'desc' => esc_html__( 'Note: You can override this option for each specific page', 'herald' ),
                'options'   => herald_get_page_layouts(),
                'default'   => 1
            ),

            array(
                'id'        => 'page_use_sidebar',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Display sidebar', 'herald' ),
                'desc' => esc_html__( 'Note: You can override this option for each particular page', 'herald' ),
                'options'   => herald_get_sidebar_layouts(),
                'default'   => 'right'
            ),

            array(
                'id'        => 'page_sidebar',
                'type'      => 'select',
                'title'     => esc_html__( 'Page standard sidebar', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a page standard sidebar', 'herald' ),
                'options'   => herald_get_sidebars_list(),
                'default'   => 'herald_default_sidebar',
                'required'  => array( 'page_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'page_sticky_sidebar',
                'type'      => 'select',
                'title'     => esc_html__( 'Page sticky sidebar', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a page sticky sidebar', 'herald' ),
                'options'   => herald_get_sidebars_list(),
                'default'   => 'herald_default_sticky_sidebar',
                'required'  => array( 'page_use_sidebar', '!=', 'none' )
            ),

            array(
                'id' => 'page_fimg',
                'type' => 'switch',
                'title' => esc_html__( 'Display the featured image', 'herald' ),
                'subtitle' => esc_html__( 'Choose if you want to display the featured image on single pages', 'herald' ),
                'default' => true,
            ),

            array(
                'id' => 'page_fimg_cap',
                'type' => 'switch',
                'title' => esc_html__( 'Display the featured image caption', 'herald' ),
                'subtitle' => esc_html__( 'Choose if you want to display the caption/description on the featured image', 'herald' ),
                'default' => false,
                'required'  => array( 'page_fimg', '=', true )
            ),

            array(
                'id'        => 'img_size_lay_page_ratio',
                'type'      => 'radio',
                'title'     => esc_html__( 'Featured image ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Choose an image ratio', 'herald' ),
                'options'   => herald_get_image_ratio_opts( true ),
                'default'   => 'original',
            ),

            array(
                'id'        => 'img_size_lay_page_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Featured image custom ratio', 'herald' ),
                'subtitle'  => esc_html__( 'Specify your custom ratio ', 'herald' ),
                'desc'      => esc_html__( 'Note: put 3:4 or 2:1 or any custom ratio you want', 'herald' ),
                'default'   => '',
                'required'  => array( 'img_size_lay_page_ratio', '=', 'custom' ),
            ),


            array(
                'id' => 'page_comments',
                'type' => 'switch',
                'title' => esc_html__( 'Display comments', 'herald' ),
                'subtitle' => esc_html__( 'Choose if you want to display comments on pages', 'herald' ),
                'description' => esc_html__( 'Note: This is just an option to quickly hide/display comments on pages. If you want to allow/disallow comments properly, you need to do it in the "Discussion" box for each particular page.', 'herald' ),
                'default' => true
            )
        ) )
);

/* Categories */
Redux::setSection( $opt_name ,  array(
        'icon'      => 'el-icon-folder',
        'title'     => esc_html__( 'Category Template', 'herald' ),
        'desc'     => esc_html__( 'Manage settings for the category templates. Note: these are global category settings, you can optionally modify these settings for each individual category.', 'herald' ),
        'fields'    => array(

            
            array(
                'id'        => 'category_fa_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Featured area layout', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a default featured area layout for categories', 'herald' ),
                'options'   => herald_get_featured_layouts( false, true ),
                'default'   => 'none',
                
            ),

            array(
                'id'        => 'category_fa_order',
                'type'      => 'radio',
                'title'     => esc_html__( 'Featured area chooses from', 'herald' ),
                'options'   => herald_get_fa_post_opts(),
                'default'   => 'date',
                'required'  => array( 'category_fa_layout', '!=', 'none' ),
            ),

            array(
                'id'        => 'category_fa_unique',
                'type'      => 'switch',
                'title'     => esc_html__( 'Make featured area posts unique', 'herald' ),
                'subtitle'  => esc_html__( 'Do not duplicate featured area posts and exclude them from main post listing below', 'herald' ),
                'default'   => false,
                'required'  => array( 'category_fa_layout', '!=', 'none' ),
            ),

            array(
                'id'        => 'category_sub',
                'type'      => 'switch',
                'title'     => esc_html__( 'Display child category navigation', 'herald' ),
                'subtitle'  => esc_html__( 'Choose if you want to display links to child categories in category heading', 'herald' ),
                'default'   => true
            ),

            array(
                'id'        => 'category_desc',
                'type'      => 'switch',
                'title'     => esc_html__( 'Display category description', 'herald' ),
                'subtitle'  => esc_html__( 'Choose if you want to display category description', 'herald' ),
                'default'   => true
            ),
            
            array(
                'id'        => 'category_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Main layout', 'herald' ),
                'subtitle'  => esc_html__( 'Choose how to display your posts on category templates', 'herald' ),
                'desc'  => esc_html__( 'Note: You can override this option for each category separately', 'herald' ),
                'options'   => herald_get_main_layouts(),
                'default'   => 'b1',
            ),

            array(
                'id'        => 'category_ppp',
                'type'      => 'radio',
                'title'     => esc_html__( 'Posts per page', 'herald' ),
                'subtitle'  => esc_html__( 'Choose how many posts per page you want to display', 'herald' ),
                'options'   => array(
                    'inherit' => wp_kses( sprintf( __( 'Inherit from global option in <a href="%s">Settings->Reading</a>', 'herald' ), admin_url( 'options-general.php' ) ), wp_kses_allowed_html( 'post' ) ),
                    'custom' => esc_html__( 'Custom number', 'herald' )
                ),
                'default'   => 'inherit'
            ),

            array(
                'id'        => 'category_ppp_num',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Number of posts per page', 'herald' ),
                'default'   => get_option( 'posts_per_page' ),
                'required'  => array( 'category_ppp', '=', 'custom' ),
                'validate'  => 'numeric'
            ),


            array(
                'id'        => 'category_starter_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Starter layout', 'herald' ),
                'subtitle'  => esc_html__( 'By choosing a starter layout, first "x" posts on the page will be displayed in this layout', 'herald' ),
                'options'   => herald_get_main_layouts( false, true ),
                'default'   => 'none',
            ),

            array(
                'id'        => 'category_starter_limit',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Number of starter posts', 'herald' ),
                'subtitle'  => esc_html__( 'Specify how many posts to display in "starter" layout', 'herald' ),
                'default'   => 1,
                'required'  => array( 'category_starter_layout', '!=', 'none' ),
                'validate'  => 'numeric'
            ),

            array(
                'id'        => 'category_use_sidebar',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Display sidebar', 'herald' ),
                'options'   => herald_get_sidebar_layouts(),
                'default'   => 'right'
            ),

            array(
                'id'        => 'category_sidebar',
                'type'      => 'select',
                'title'     => esc_html__( 'Category standard sidebar', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a standard category sidebar', 'herald' ),
                'options'   => herald_get_sidebars_list(),
                'default'   => 'herald_default_sidebar',
                'required'  => array( 'category_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'category_sticky_sidebar',
                'type'      => 'select',
                'title'     => esc_html__( 'Category sticky sidebar', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a sticky category sidebar', 'herald' ),
                'options'   => herald_get_sidebars_list(),
                'default'   => 'herald_default_sticky_sidebar',
                'required'  => array( 'category_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'category_pag',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Pagination', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a pagination type for category template', 'herald' ),
                'desc'  => esc_html__( 'Note: You can override this option for each category separately', 'herald' ),
                'options'   => herald_get_pagination_layouts(),
                'default'   => 'numeric'
            )


        ) )
);

/* Tags */
Redux::setSection( $opt_name , array(
        'icon'      => ' el-icon-tag',
        'title'     => esc_html__( 'Tag Template', 'herald' ),
        'desc'     => esc_html__( 'Manage settings for the tag templates', 'herald' ),
        'fields'    => array(


            array(
                'id'        => 'tag_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Main layout', 'herald' ),
                'subtitle'  => esc_html__( 'Choose how to display your posts on the tag template', 'herald' ),
                'options'   => herald_get_main_layouts(),
                'default'   => 'b1'
            ),

            array(
                'id'        => 'tag_ppp',
                'type'      => 'radio',
                'title'     => esc_html__( 'Posts per page', 'herald' ),
                'subtitle'  => esc_html__( 'Choose how many posts per page you want to display', 'herald' ),
                'options'   => array(
                    'inherit' => wp_kses( sprintf( __( 'Inherit from global option in <a href="%s">Settings->Reading</a>', 'herald' ), admin_url( 'options-general.php' ) ), wp_kses_allowed_html( 'post' )),
                    'custom' => esc_html__( 'Custom number', 'herald' )
                ),
                'default'   => 'inherit'
            ),

            array(
                'id'        => 'tag_ppp_num',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Number of posts per page', 'herald' ),
                'default'   => get_option( 'posts_per_page' ),
                'required'  => array( 'tag_ppp', '=', 'custom' ),
                'validate'  => 'numeric'
            ),


            array(
                'id'        => 'tag_starter_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Starter layout', 'herald' ),
                'subtitle'  => esc_html__( 'By choosing a starter layout, first "x" posts on the page will be displayed in this layout', 'herald' ),
                'options'   => herald_get_main_layouts( false, true ),
                'default'   => 'none',
            ),

            array(
                'id'        => 'tag_starter_limit',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Number of starter posts', 'herald' ),
                'subtitle'  => esc_html__( 'Specify how many posts to display in "starter" layout', 'herald' ),
                'default'   => 1,
                'required'  => array( 'tag_starter_layout', '!=', 'none' ),
                'validate'  => 'numeric'
            ),


            array(
                'id'        => 'tag_use_sidebar',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Display sidebar', 'herald' ),
                'options'   => herald_get_sidebar_layouts(),
                'default'   => 'right'
            ),

            array(
                'id'        => 'tag_sidebar',
                'type'      => 'select',
                'title'     => esc_html__( 'Tag standard sidebar', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a standard sidebar for the tag template', 'herald' ),
                'options'   => herald_get_sidebars_list(),
                'default'   => 'herald_default_sidebar',
                'required'  => array( 'tag_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'tag_sticky_sidebar',
                'type'      => 'select',
                'title'     => esc_html__( 'Tag sticky sidebar', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a sticky sidebar for the tag template', 'herald' ),
                'options'   => herald_get_sidebars_list(),
                'default'   => 'herald_default_sticky_sidebar',
                'required'  => array( 'tag_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'tag_pag',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Pagination', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a pagination type for tag template', 'herald' ),
                'options'   => herald_get_pagination_layouts(),
                'default'   => 'numeric'
            ),

        ) )
);

/* Author */
Redux::setSection( $opt_name ,  array(
        'icon'      => 'el-icon-user',
        'title'     => esc_html__( 'Author Template', 'herald' ),
        'desc'     => esc_html__( 'Manage settings for the author templates', 'herald' ),
        'fields'    => array(

            array(
                'id'        => 'author_desc',
                'type'      => 'switch',
                'title'     => esc_html__( 'Author description', 'herald' ),
                'subtitle'  => esc_html__( 'Choose if you want to display the author avatar with bio/description', 'herald' ),
                'default'   => true
            ),

            array(
                'id'        => 'author_social',
                'type'      => 'switch',
                'title'     => esc_html__( 'Author social links', 'herald' ),
                'subtitle'  => esc_html__( 'Choose if you want to display the author social links', 'herald' ),
                'default'   => true
            ),

            array(
                'id'        => 'author_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Main layout', 'herald' ),
                'subtitle'  => esc_html__( 'Choose how to display your posts on the author template', 'herald' ),
                'options'   => herald_get_main_layouts(),
                'default'   => 'b1'
            ),

            array(
                'id'        => 'author_ppp',
                'type'      => 'radio',
                'title'     => esc_html__( 'Posts per page', 'herald' ),
                'subtitle'  => esc_html__( 'Choose how many posts per page you want to display', 'herald' ),
                'options'   => array(
                    'inherit' => wp_kses( sprintf( __( 'Inherit from global option in <a href="%s">Settings->Reading</a>', 'herald' ), admin_url( 'options-general.php' ) ), wp_kses_allowed_html( 'post' )),
                    'custom' => esc_html__( 'Custom number', 'herald' )
                ),
                'default'   => 'inherit'
            ),

            array(
                'id'        => 'author_ppp_num',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Number of posts per page', 'herald' ),
                'default'   => get_option( 'posts_per_page' ),
                'required'  => array( 'author_ppp', '=', 'custom' ),
                'validate'  => 'numeric'
            ),

            array(
                'id'        => 'author_starter_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Starter layout', 'herald' ),
                'subtitle'  => esc_html__( 'By choosing a starter layout, first "x" posts on the page will be displayed in this layout', 'herald' ),
                'options'   => herald_get_main_layouts( false, true ),
                'default'   => 'none',
            ),

            array(
                'id'        => 'author_starter_limit',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Number of starter posts', 'herald' ),
                'subtitle'  => esc_html__( 'Specify how many posts to display in "starter" layout', 'herald' ),
                'default'   => 1,
                'required'  => array( 'author_starter_layout', '!=', 'none' ),
                'validate'  => 'numeric'
            ),

            array(
                'id'        => 'author_use_sidebar',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Display sidebar', 'herald' ),
                'options'   => herald_get_sidebar_layouts(),
                'default'   => 'right'
            ),

            array(
                'id'        => 'author_sidebar',
                'type'      => 'select',
                'title'     => esc_html__( 'Author standard sidebar', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a standard sidebar for the author template', 'herald' ),
                'options'   => herald_get_sidebars_list(),
                'default'   => 'herald_default_sidebar',
                'required'  => array( 'author_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'author_sticky_sidebar',
                'type'      => 'select',
                'title'     => esc_html__( 'Author sticky sidebar', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a sticky sidebar for the author template', 'herald' ),
                'options'   => herald_get_sidebars_list(),
                'default'   => 'herald_default_sticky_sidebar',
                'required'  => array( 'author_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'author_pag',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Pagination', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a pagination type for author template', 'herald' ),
                'options'   => herald_get_pagination_layouts(),
                'default'   => 'numeric'
            ),

        ) )
);

/* Search */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-search',
        'title'     => esc_html__( 'Search Template', 'herald' ),
        'desc'     => esc_html__( 'Manage settings for the search results template', 'herald' ),
        'fields'    => array(


            array(
                'id'        => 'search_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Main layout', 'herald' ),
                'subtitle'  => esc_html__( 'Choose how to display your posts on the search template', 'herald' ),
                'options'   => herald_get_main_layouts(),
                'default'   => 'b1'
            ),

            array(
                'id'        => 'search_ppp',
                'type'      => 'radio',
                'title'     => esc_html__( 'Posts per page', 'herald' ),
                'subtitle'  => esc_html__( 'Choose how many posts per page you want to display', 'herald' ),
                'options'   => array(
                    'inherit' => wp_kses( sprintf( __( 'Inherit from global option in <a href="%s">Settings->Reading</a>', 'herald' ), admin_url( 'options-general.php' ) ), wp_kses_allowed_html( 'post' )),
                    'custom' => esc_html__( 'Custom number', 'herald' )
                ),
                'default'   => 'inherit'
            ),

            array(
                'id'        => 'search_ppp_num',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Number of posts per page', 'herald' ),
                'default'   => get_option( 'posts_per_page' ),
                'required'  => array( 'search_ppp', '=', 'custom' ),
                'validate'  => 'numeric'
            ),

            array(
                'id'        => 'search_use_sidebar',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Display sidebar', 'herald' ),
                'options'   => herald_get_sidebar_layouts(),
                'default'   => 'right'
            ),

            array(
                'id'        => 'search_sidebar',
                'type'      => 'select',
                'title'     => esc_html__( 'Search standard sidebar', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a standard sidebar for the search template', 'herald' ),
                'options'   => herald_get_sidebars_list(),
                'default'   => 'herald_default_sidebar',
                'required'  => array( 'search_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'search_sticky_sidebar',
                'type'      => 'select',
                'title'     => esc_html__( 'Search sticky sidebar', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a sticky sidebar for the search template', 'herald' ),
                'options'   => herald_get_sidebars_list(),
                'default'   => 'herald_default_sticky_sidebar',
                'required'  => array( 'search_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'search_pag',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Pagination', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a pagination type for search template', 'herald' ),
                'options'   => herald_get_pagination_layouts(),
                'default'   => 'numeric'
            ),

        ) )
);

/* Archives */

Redux::setSection( $opt_name ,  array(
        'icon'      => 'el-icon-folder-open',
        'title'     => esc_html__( 'Archive Templates', 'herald' ),
        'desc'     => esc_html__( 'Manage settings for other miscellaneous templates like date archives, post format archives, index (latest posts) page, etc...', 'herald' ),
        'fields'    => array(

            array(
                'id'        => 'archive_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Main layout', 'herald' ),
                'subtitle'  => esc_html__( 'Choose how to display your posts on the archive templates', 'herald' ),
                'options'   => herald_get_main_layouts(),
                'default'   => 'b1'
            ),


            array(
                'id'        => 'archive_ppp',
                'type'      => 'radio',
                'title'     => esc_html__( 'Posts per page', 'herald' ),
                'subtitle'  => esc_html__( 'Choose how many posts per page you want to display', 'herald' ),
                'options'   => array(
                    'inherit' => wp_kses( sprintf( __( 'Inherit from global option in <a href="%s">Settings->Reading</a>', 'herald' ), admin_url( 'options-general.php' ) ), wp_kses_allowed_html( 'post' ) ),
                    'custom' => esc_html__( 'Custom number', 'herald' )
                ),
                'default'   => 'inherit'
            ),

            array(
                'id'        => 'archive_ppp_num',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Number of posts per page', 'herald' ),
                'default'   => get_option( 'posts_per_page' ),
                'required'  => array( 'archive_ppp', '=', 'custom' ),
                'validate'  => 'numeric'
            ),

            array(
                'id'        => 'archive_starter_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Starter layout', 'herald' ),
                'subtitle'  => esc_html__( 'By choosing a starter layout, first "x" posts on the page will be displayed in this layout', 'herald' ),
                'options'   => herald_get_main_layouts( false, true ),
                'default'   => 'none',
            ),

            array(
                'id'        => 'archive_starter_limit',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Number of starter posts', 'herald' ),
                'subtitle'  => esc_html__( 'Specify how many posts to display in "starter" layout', 'herald' ),
                'default'   => 2,
                'required'  => array( 'archive_starter_layout', '!=', 'none' ),
                'validate'  => 'numeric'
            ),

            array(
                'id'        => 'archive_use_sidebar',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Display sidebar', 'herald' ),
                'options'   => herald_get_sidebar_layouts(),
                'default'   => 'right'
            ),

            array(
                'id'        => 'archive_sidebar',
                'type'      => 'select',
                'title'     => esc_html__( 'Archive standard sidebar', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a standard sidebar for the archive templates', 'herald' ),
                'options'   => herald_get_sidebars_list(),
                'default'   => 'herald_default_sidebar',
                'required'  => array( 'archive_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'archive_sticky_sidebar',
                'type'      => 'select',
                'title'     => esc_html__( 'Archive sticky sidebar', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a sticky sidebar for the archive templates', 'herald' ),
                'options'   => herald_get_sidebars_list(),
                'default'   => 'herald_default_sticky_sidebar',
                'required'  => array( 'archive_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'archive_pag',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Pagination', 'herald' ),
                'subtitle'  => esc_html__( 'Choose a pagination type for archive templates', 'herald' ),
                'options'   => herald_get_pagination_layouts(),
                'default'   => 'numeric'
            ),

        ) )
);

/* Typography */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-fontsize',
        'title'     => esc_html__( 'Typography', 'herald' ),
        'desc'     => esc_html__( 'Manage fonts and typography settings', 'herald' ),
        'fields'    => array(

            array(
                'id'          => 'main_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Main text font', 'herald' ),
                'google'      => true,
                'font-backup' => false,
                'font-size' => false,
                'color' => false,
                'line-height' => false,
                'text-align' => false,
                'units'       =>'px',
                'subtitle'    => esc_html__( 'This is your main font, used for standard text', 'herald' ),
                'default'     => array(
                    'google'      => true,
                    'font-weight'  => '400',
                    'font-family' => 'Open Sans',
                    'subsets' => 'latin-ext'
                ),
                'preview' => array(
                    'always_display' => true,
                    'font-size' => '16px',
                    'line-height' => '26px',
                    'text' => 'This is a font used for your main content on the website. Here at MeksHQ, we believe that readability is a very important part of any WordPress theme. This is an example of how a simple paragraph of text will look like on your website.'
                )
            ),

            array(
                'id'          => 'h_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Headings font', 'herald' ),
                'google'      => true,
                'font-backup' => false,
                'font-size' => false,
                'color' => false,
                'line-height' => false,
                'text-align' => false,
                'units'       =>'px',
                'subtitle'    => esc_html__( 'This is a font used for titles and headings', 'herald' ),
                'default'     => array(
                    'google'      => true,
                    'font-weight'  => '700',
                    'font-family' => 'Lato',
                    'subsets' => 'latin-ext'
                ),
                'preview' => array(
                    'always_display' => true,
                    'font-size' => '24px',
                    'line-height' => '30px',
                    'text' => 'There is no good blog without great readability'
                )

            ),

            array(
                'id'          => 'nav_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Navigation font', 'herald' ),
                'google'      => true,
                'font-backup' => false,
                'font-size' => false,
                'color' => false,
                'line-height' => false,
                'text-align' => false,
                'units'       =>'px',
                'subtitle'    => esc_html__( 'This is a font used for main website navigation', 'herald' ),
                'default'     => array(
                    'font-weight'  => '600',
                    'font-family' => 'Open Sans',
                    'subsets' => 'latin-ext'
                ),

                'preview' => array(
                    'always_display' => true,
                    'font-size' => '16px',
                    'text' => 'Home &nbsp;&nbsp;About &nbsp;&nbsp;Blog &nbsp;&nbsp;Contact'
                )

            ),

            array(
                'id'          => 'finetune',
                'type'        => 'section',
                'indent' => false,
                'title'       => esc_html__( 'Fine-tune typography', 'herald' ),
                'subtitle'    => esc_html__( 'Advanced options to adjust font sizes', 'herald' )
            ),

            array(
                'id'       => 'font_size_p',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Main text font size', 'herald' ),
                'subtitle' => esc_html__( 'This is your body text font size, used for default text on single posts and pages', 'herald' ),
                'default'  => '16',
                'min'      => '12',
                'step'     => '1',
                'max'      => '24',
            ),

            array(
                'id'       => 'font_size_nav',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Navigation font size', 'herald' ),
                'subtitle' => esc_html__( 'Applies to main website navigation', 'herald' ),
                'default'  => '14',
                'min'      => '12',
                'step'     => '1',
                'max'      => '24',
            ),

            array(
                'id'       => 'font_size_widget_and_module_title',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Module and Widget title', 'herald' ),
                'subtitle' => esc_html__( 'Applies to widgets, modules and archives titles', 'herald' ),
                'default'  => '16',
                'min'      => '14',
                'step'     => '1',
                'max'      => '20',
            ),

            array(
                'id'       => 'font_size_small',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Small text (widget) font size', 'herald' ),
                'subtitle' => esc_html__( 'Applies to widgets and some special elements', 'herald' ),
                'default'  => '15',
                'min'      => '12',
                'step'     => '1',
                'max'      => '24',
            ),

            array(
                'id'       => 'font_size_h1',
                'type'     => 'spinner',
                'title'    => esc_html__( 'H1 font size', 'herald' ),
                'subtitle' => esc_html__( 'Applies to H1 elements and single post/page titles', 'herald' ),
                'default'  => '40',
                'min'      => '30',
                'step'     => '1',
                'max'      => '60',
            ),

            array(
                'id'       => 'font_size_h2',
                'type'     => 'spinner',
                'title'    => esc_html__( 'H2 font size', 'herald' ),
                'subtitle' => esc_html__( 'Applies to H2 elements and layouts A, A1 and A3', 'herald' ),
                'default'  => '33',
                'min'      => '25',
                'step'     => '1',
                'max'      => '45',
            ),

            array(
                'id'       => 'font_size_h3',
                'type'     => 'spinner',
                'title'    => esc_html__( 'H3 font size', 'herald' ),
                'subtitle' => esc_html__( 'Applies to H3 elements, featured area layout 5 big post title and layouts B, B1 and C', 'herald' ),
                'default'  => '28',
                'min'      => '20',
                'step'     => '1',
                'max'      => '35',
            ),

            array(
                'id'       => 'font_size_h4',
                'type'     => 'spinner',
                'title'    => esc_html__( 'H4 font size', 'herald' ),
                'subtitle' => esc_html__( 'Applies to H4 elements and layout C1', 'herald' ),
                'default'  => '23',
                'min'      => '16',
                'step'     => '1',
                'max'      => '30',
            ),

            array(
                'id'       => 'font_size_h5',
                'type'     => 'spinner',
                'title'    => esc_html__( 'H5 font size', 'herald' ),
                'subtitle' => esc_html__( 'Applies to H5 elements, featured area layout 1 and layouts E and F', 'herald' ),
                'default'  => '19',
                'min'      => '14',
                'step'     => '1',
                'max'      => '25',
            ),

            array(
                'id'       => 'font_size_h6',
                'type'     => 'spinner',
                'title'    => esc_html__( 'H6 font size', 'herald' ),
                'subtitle' => esc_html__( 'Applies to H6 elements, featured area layout 2 and layouts D, D1, F1, H and I', 'herald' ),
                'default'  => '16',
                'min'      => '14',
                'step'     => '1',
                'max'      => '22',
            ),

            array(
                'id'       => 'font_size_h7',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Small title font size', 'herald' ),
                'subtitle' => esc_html__( 'Applies to titles of layouts G, G1, I1, J, K and L', 'herald' ),
                'default'  => '14',
                'min'      => '11',
                'step'     => '1',
                'max'      => '16',
            ),

            array(
                'id'       => 'font_size_excerpt_text',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Entry headline font size', 'herald' ),
                'subtitle' => esc_html__( 'Font size for text excerpt in the beginning of the single post', 'herald' ),
                'default'  => '19',
                'min'      => '14',
                'step'     => '1',
                'max'      => '25',
            ),

            array(
                'id'       => 'font_size_meta_data_smaller',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Meta Data font size smaller', 'herald' ),
                'subtitle' => esc_html__( 'Applies to meta data in smaller module layouts',  'herald' ),
                'default'  => '13',
                'min'      => '10',
                'step'     => '1',
                'max'      => '15',
            ),

            array(
                'id'       => 'font_size_meta_data_bigger',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Meta Data font size bigger', 'herald' ),
                'subtitle' => esc_html__( 'Applies to meta data in larger module layouts',  'herald' ),
                'default'  => '14',
                'min'      => '10',
                'step'     => '1',
                'max'      => '20',
            ),

            array(
                'id' => 'uppercase',
                'type' => 'checkbox',
                'multi' => true,
                'title' => esc_html__( 'Uppercase text', 'herald' ),
                'subtitle' => esc_html__( 'Check if you want to show CAPITAL LETTERS for specific elements', 'herald' ),
                'options' => array(
                    'site-title a' => esc_html__( 'Site title', 'herald' ),
                    'site-description' => esc_html__( 'Site description', 'herald' ),
                    'main-navigation' => esc_html__( 'Main navigation', 'herald' ),
                    'entry-title' => esc_html__( 'Post/Page titles', 'herald' ),
                    'meta-category a' => esc_html__( 'Category links', 'herald' ),
                    'herald-mod-title' => esc_html__( 'Module titles', 'herald' ),
                    'herald-sidebar .widget-title' => esc_html__( 'Widget titles', 'herald' ),
                    'herald-site-footer .widget-title' => esc_html__( 'Footer widget titles', 'herald' ),

                    
                ),
                'default' => array(
                    'site-title a' => 0,
                    'site-description' => 0,
                    'main-navigation' => 1,
                    'entry-title' => 0,
                    'meta-category a' => 1,
                    'herald-mod-title' => 0,
                    'herald-sidebar .widget-title' => 0,
                    'herald-site-footer .widget-title' => 0
                )
            )

        ) )
);

/* Ads */
Redux::setSection( $opt_name, array(
		'icon'   => 'el-icon-usd',
		'title'  => esc_html__( 'Ads', 'herald' ),
		'desc'   => esc_html__( 'Use this options to fill your ads slots. Both image and JavaScript related ads are allowed.', 'herald' ),
		'fields' => array(
			
			array(
				'id'       => 'ad_header',
				'type'     => 'editor',
				'title'    => esc_html__( 'Header ad slot', 'herald' ),
				'subtitle' => esc_html__( 'This ad will be displayed in website header. You can enable it in header main area settings', 'herald' ),
				'default'  => '',
				'desc'     => esc_html__( 'Note: If you want to paste HTML or js code, use "text" mode in editor. Suggested size of an ad banner is 728x90', 'herald' ),
				'args'     => array(
					'textarea_rows'  => 5,
					'default_editor' => 'html',
				),
			),
			
			
			array(
				'id'       => 'ad_below_header',
				'type'     => 'editor',
				'title'    => esc_html__( 'Below header', 'herald' ),
				'subtitle' => esc_html__( 'This ad will be displayed between your header and website content', 'herald' ),
				'default'  => '',
				'desc'     => esc_html__( 'Note: If you want to paste HTML or JavaScript code, use "text" mode in editor', 'herald' ),
				'args'     => array(
					'textarea_rows'  => 5,
					'default_editor' => 'html',
				),
			),
			
			array(
				'id'       => 'ad_above_footer',
				'type'     => 'editor',
				'title'    => esc_html__( 'Above footer', 'herald' ),
				'subtitle' => esc_html__( 'This ad will be displayed between your footer and website content', 'herald' ),
				'default'  => '',
				'desc'     => esc_html__( 'Note: If you want to paste HTML or JavaScript code, use "text" mode in editor', 'herald' ),
				'args'     => array(
					'textarea_rows'  => 5,
					'default_editor' => 'html',
				),
			),
			
			array(
				'id'       => 'ad_above_single',
				'type'     => 'editor',
				'title'    => esc_html__( 'Above single post content', 'herald' ),
				'subtitle' => esc_html__( 'This ad will be displayed above post content on your single post templates', 'herald' ),
				'default'  => '',
				'desc'     => esc_html__( 'Note: If you want to paste HTML or JavaScript code, use "text" mode in editor', 'herald' ),
				'args'     => array(
					'textarea_rows'  => 5,
					'default_editor' => 'html',
				),
			),
			
			array(
				'id'       => 'ad_below_single',
				'type'     => 'editor',
				'title'    => esc_html__( 'Below single post content', 'herald' ),
				'subtitle' => esc_html__( 'This ad will be displayed below post content on your single post templates', 'herald' ),
				'default'  => '',
				'desc'     => esc_html__( 'Note: If you want to paste HTML or JavaScript code, use "text" mode in editor', 'herald' ),
				'args'     => array(
					'textarea_rows'  => 5,
					'default_editor' => 'html',
				),
			),
			
			array(
				'id'       => 'ad_single_meta',
				'type'     => 'editor',
				'title'    => esc_html__( 'Inside single post meta bar', 'herald' ),
				'subtitle' => esc_html__( 'This ad will be displayed inside vertical meta bar on single post templates', 'herald' ),
				'default'  => '',
				'desc'     => esc_html__( 'Note: Ad inside this field cannot be larger than 130px width. If you want to paste HTML or JavaScript code, use "text" mode in editor. ', 'herald' ),
				'args'     => array(
					'textarea_rows'  => 5,
					'default_editor' => 'html',
				),
			),
			
			array(
				'id'       => 'ad_between_posts',
				'type'     => 'editor',
				'title'    => esc_html__( 'Between posts', 'herald' ),
				'subtitle' => esc_html__( 'This ad will be displayed between posts on archive templates such as category archives, tag archives etc...', 'herald' ),
				'default'  => '',
				'desc'     => esc_html__( 'Note: If you want to paste HTML or JavaScript code, use "text" mode in editor', 'herald' ),
				'args'     => array(
					'textarea_rows'  => 5,
					'default_editor' => 'html',
				),
			),
			
			array(
				'id'       => 'ad_between_posts_position',
				'type'     => 'text',
				'class'    => 'small-text',
				'title'    => esc_html__( 'Between posts position', 'herald' ),
				'subtitle' => esc_html__( 'Specify after how many posts you want to display ad', 'herald' ),
				'default'  => 4,
				'validate' => 'numeric',
			),
			
			array(
				'id'       => 'ad_exclude_404',
				'type'     => 'switch',
				'title'    => esc_html__( 'Do not show ads on 404 page', 'herald' ),
				'subtitle' => esc_html__( 'Disable ads on 404 error page', 'herald' ),
				'default'  => false,
			),
			
			array(
				'id'       => 'ad_exclude_from_pages',
				'type'     => 'select',
				'title'    => esc_html__( 'Do not show ads on specific pages', 'herald' ),
				'subtitle' => esc_html__( 'Select pages on which you don\'t want to display ads', 'herald' ),
				'multi'    => true,
				'sortable' => true,
				'data'     => 'page',
				'args'     => array(
					'posts_per_page' => - 1,
				),
				'default'  => array(),
			),
		
		),
	) );

/* Misc. */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-wrench',
        'title'     => esc_html__( 'Misc.', 'herald' ),
        'desc'     => esc_html__( 'These are some additional miscellaneous theme settings', 'herald' ),
        'fields'    => array(

            array(
                'id' => 'rtl_mode',
                'type' => 'switch',
                'title' => esc_html__( 'RTL mode (right to left)', 'herald' ),
                'subtitle' => esc_html__( 'Enable this option if you are using right to left writing/reading', 'herald' ),
                'default' => false
            ),

            array(
                'id' => 'rtl_lang_skip',
                'type' => 'text',
                'title' => esc_html__( 'Skip RTL for specific language(s)', 'herald' ),
                'subtitle' => wp_kses( sprintf( __( 'Paste specific WordPress language <a href="%s" target="_blank">locale code</a> to exclude it from the RTL mode', 'herald' ), 'http://wpcentral.io/internationalization/' ), wp_kses_allowed_html( 'post' )),
                'desc' => esc_html__( 'i.e. If you are using Arabic and English versions on the same WordPress installation you should put "en_US" in this field and its version will not be displayed as RTL. Note: To exclude multiple languages, separate by comma: en_US, de_DE', 'herald' ),
                'default' => '',
                'required' => array( 'rtl_mode', '=', true )
            ),

            array(
                'id'        => 'social_share',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Social sharing', 'herald' ),
                'subtitle'  => esc_html__( 'Choose social networks that you want to use for sharing posts', 'herald' ),
                'options'   => array(
                    'facebook' => esc_html__( 'Facebook', 'herald' ),
                    'twitter' => esc_html__( 'Twitter', 'herald' ),
                    'gplus' => esc_html__( 'Google+', 'herald' ),
                    'pinterest' => esc_html__( 'Pinterest', 'herald' ),
                    'linkedin' => esc_html__( 'LinkedIN', 'herald' ),
                    'reddit' => esc_html__( 'Reddit', 'herald' ),
                    'email' => esc_html__( 'Email', 'herald' ),
                    'stumbleupon' => esc_html__( 'StumbleUpon', 'herald' ),
                    'whatsapp' => esc_html__( 'WhatsApp', 'herald' ),
                    'vkontakte' => esc_html__( 'vKontakte', 'herald' ),
                    
                ),
                'default' => array(
                    'facebook' => 1,
                    'twitter' => 1,
                    'gplus' => 1,
                    'pinterest' => 1,
                    'linkedin' => 1,
                    'reddit' => 0,
                    'email' => 0,
                    'stumbleupon' => 0,
                    'whatsapp' => 0,
                    'vkontakte' => ''
                ),
            ),

            array(
                'id' => 'more_string',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'More string', 'herald' ),
                'subtitle' => esc_html__( 'Specify your "more" string to append after limited post excerpts', 'herald' ),
                'default' => '...',
                'validate' => 'no_html'
            ),

            array(
                'id' => 'smooth_scroll',
                'type' => 'switch',
                'title' => esc_html__( 'Smooth scrolling', 'herald' ),
                'subtitle' => esc_html__( 'Use this option to enable smooth scrolling effect on the website', 'herald' ),
                'default' => false
            ),

            array(
                'id' => 'auto_gallery_img_sizes',
                'type' => 'switch',
                'title' => esc_html__( 'Automatic gallery image sizes', 'herald' ),
                'subtitle' => esc_html__( 'If you enable this option, theme will automatically detect best possible size for your galleries, depending of gallery columns number you choose', 'herald' ),
                'default' => true
            ),

            array(
                'id' => 'popup_img',
                'type' => 'switch',
                'title' => esc_html__( 'Open galleries and image post format in pop-up', 'herald' ),
                'subtitle' => esc_html__( 'If you enable this option, galleries and image post format will be open in pop-up', 'herald' ),
                'default' => true
            ),

            array(
                'id' => 'on_single_img_popup',
                'type' => 'switch',
                'title' => esc_html__( 'Open content image(s) in pop-up', 'herald' ),
                'subtitle' => esc_html__( 'Enable this option if you want to open your content image(s) in pop-up', 'herald' ),
                'default' => false
            ),

            array(
                'id' => 'views_forgery',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Post views forgery', 'herald' ),
                'subtitle' => esc_html__( 'Specify a value to add to the real number of entry views for each post', 'herald' ),
                'desc' => esc_html__( 'i.e. If a post has 45 views and you put 100, your post will display 145 views', 'herald' ),
                'default' => '',
                'validate' => 'numeric'
            ),

            array(
                'id'        => 'overlay_opacity',
                'type'      => 'slider',
                'title'     => esc_html__( 'Image overlay opacity', 'herald' ),
                'subtitle'  => esc_html__( 'For post layouts which have the text over the image, choose values for image overlay opacity', 'herald' ),
                'description' => esc_html__( 'Note: First value is for initial opacity, second one is for image hover', 'herald' ),
                "default" => array(
                    1 => .5,
                    2 => .8,
                ),
                'resolution' => 0.1,
                "min" => 0,
                "step" => .1,
                "max" => 1,
                'display_value' => 'label',
                'handles' => 2,
            ),

            array(
                'id' => 'scroll_to_top',
                'type' => 'switch',
                'title' => esc_html__( 'Display scroll to top button', 'herald' ),
                'subtitle' => esc_html__( 'If you check this option, scroll to top button will appear at the bottom on the page while you scroll', 'herald' ),
                'default' => false
            ),

            array(
                'id'        => 'image_404',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__( '404 Image', 'herald' ),
                'subtitle'      => esc_html__( 'Upload image to display on 404 error page', 'herald' ),
                'default'   => array( 'url' => '' ),
            ),

            array(
                'id'        => 'multibyte_rtime',
                'type'      => 'switch',
                'title'     => esc_html__( 'Enable "multibyte" support for reading time', 'herald' ),
                'subtitle'  => esc_html__( 'Check this option if your site is using language with special characters (i.e. Japanese)', 'herald' ),
                'default'   => false
            ),

            array(
                'id' => 'primary_category',
                'type' => 'switch',
                'title' => esc_html__( 'Primary category support', 'herald' ),
                'subtitle' => esc_html__( 'This option supports primary category feature from Yoast SEO plugin. If a post is assigned to multiple categories, only selected primary category will be displayed for that post in all listing layouts', 'herald' ),
                'default' => false
            ),

            array(
                'id' => 'words_read_per_minute',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Words to read per minute', 'herald' ),
                'subtitle' => esc_html__( 'Use this option to set number of words your visitors read per minute, in order to fine-tune calculation of post reading time meta data', 'herald' ),
                'validate' => 'numeric',
                'default' => 200
            ),

        )
    )
);

/* WooCommerce */

if ( herald_is_woocommerce_active() ) {

    Redux::setSection( $opt_name , array(
            'icon'      => 'el-icon-shopping-cart',
            'title' => esc_html__( 'WooCommerce', 'herald' ),
            'desc' => esc_html__( 'Manage options for WooCommerce pages', 'herald' ),
            'fields' => array(
                array(
                    'id'        => 'product_use_sidebar',
                    'type'      => 'image_select',
                    'title'     => esc_html__( 'Product sidebar layout', 'herald' ),
                    'subtitle'  => esc_html__( 'Choose sidebar layout for WooCommerce products', 'herald' ),
                    'options'   => herald_get_sidebar_layouts(),
                    'default'   => 'right'
                ),

                array(
                    'id'        => 'product_sidebar',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Product standard sidebar', 'herald' ),
                    'subtitle'  => esc_html__( 'Choose standard sidebar for WooCommerce products', 'herald' ),
                    'options'   => herald_get_sidebars_list(),
                    'default'   => 'herald_default_sidebar',
                    'required'  => array( 'product_use_sidebar', '!=', 'none' )
                ),

                array(
                    'id'        => 'product_sticky_sidebar',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Product sticky sidebar', 'herald' ),
                    'subtitle'  => esc_html__( 'Choose sticky sidebar for WooCommerce products', 'herald' ),
                    'options'   => herald_get_sidebars_list(),
                    'default'   => 'herald_default_sticky_sidebar',
                    'required'  => array( 'product_use_sidebar', '!=', 'none' )
                ),

                array(
                    'id'        => 'product_cat_use_sidebar',
                    'type'      => 'image_select',
                    'title'     => esc_html__( 'Product archives sidebar layout', 'herald' ),
                    'subtitle'  => esc_html__( 'Choose sidebar layout for WooCommerce products category, tag, archive etc...', 'herald' ),
                    'options'   => herald_get_sidebar_layouts(),
                    'default'   => 'right'
                ),

                array(
                    'id'        => 'product_cat_sidebar',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Product archives standard sidebar', 'herald' ),
                    'subtitle'  => esc_html__( 'Choose standard sidebar for WooCommerce products category, tag, archive etc...', 'herald' ),
                    'options'   => herald_get_sidebars_list(),
                    'default'   => 'herald_default_sidebar',
                    'required'  => array( 'product_cat_use_sidebar', '!=', 'none' )
                ),

                array(
                    'id'        => 'product_cat_sticky_sidebar',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Product archives sticky sidebar', 'herald' ),
                    'subtitle'  => esc_html__( 'Choose sticky sidebar for WooCommerce products category, tag, archive etc...', 'herald' ),
                    'options'   => herald_get_sidebars_list(),
                    'default'   => 'herald_default_sticky_sidebar',
                    'required'  => array( 'product_cat_use_sidebar', '!=', 'none' )
                )
            ) )
    );
}

/* bbPress */

if ( herald_is_bbpress_active() ) {
    Redux::setSection( $opt_name , array(
            'icon'      => 'el-icon-quotes',
            'title' => esc_html__( 'bbPress', 'herald' ),
            'desc' => esc_html__( 'Manage options for bbPress pages', 'herald' ),
            'fields' => array(
                array(
                    'id'        => 'forum_use_sidebar',
                    'type'      => 'image_select',
                    'title'     => esc_html__( 'Forum sidebar layout', 'herald' ),
                    'subtitle'  => esc_html__( 'Choose sidebar layout for bbPress forums', 'herald' ),
                    'options'   => herald_get_sidebar_layouts(),
                    'default'   => 'right'
                ),

                array(
                    'id'        => 'forum_sidebar',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Forum standard sidebar', 'herald' ),
                    'subtitle'  => esc_html__( 'Choose standard sidebar for bbPress forums', 'herald' ),
                    'options'   => herald_get_sidebars_list(),
                    'default'   => 'herald_default_sidebar',
                    'required'  => array( 'forum_use_sidebar', '!=', 'none' )
                ),

                array(
                    'id'        => 'forum_sticky_sidebar',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Forum sticky sidebar', 'herald' ),
                    'subtitle'  => esc_html__( 'Choose sticky sidebar for bbPress forums', 'herald' ),
                    'options'   => herald_get_sidebars_list(),
                    'default'   => 'herald_default_sticky_sidebar',
                    'required'  => array( 'forum_use_sidebar', '!=', 'none' )
                ),

                array(
                    'id'        => 'topic_use_sidebar',
                    'type'      => 'image_select',
                    'title'     => esc_html__( 'Topic sidebar layout', 'herald' ),
                    'subtitle'  => esc_html__( 'Choose sidebar layout for bbPress topics', 'herald' ),
                    'options'   => herald_get_sidebar_layouts(),
                    'default'   => 'right'
                ),

                array(
                    'id'        => 'topic_sidebar',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Topic standard sidebar', 'herald' ),
                    'subtitle'  => esc_html__( 'Choose standard sidebar for bbPress topics', 'herald' ),
                    'options'   => herald_get_sidebars_list(),
                    'default'   => 'herald_default_sidebar',
                    'required'  => array( 'topic_use_sidebar', '!=', 'none' )
                ),

                array(
                    'id'        => 'topic_sticky_sidebar',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Topic sticky sidebar', 'herald' ),
                    'subtitle'  => esc_html__( 'Choose sticky sidebar for bbPress topics', 'herald' ),
                    'options'   => herald_get_sidebars_list(),
                    'default'   => 'herald_default_sticky_sidebar',
                    'required'  => array( 'topic_use_sidebar', '!=', 'none' )
                ),

                array(
                    'id'        => 'bb_user_use_sidebar',
                    'type'      => 'image_select',
                    'title'     => esc_html__( 'User sidebar layout', 'herald' ),
                    'subtitle'  => esc_html__( 'Choose sidebar layout for bbPress user pages', 'herald' ),
                    'options'   => herald_get_sidebar_layouts(),
                    'default'   => 'right'
                ),

                array(
                    'id'        => 'bb_user_sidebar',
                    'type'      => 'select',
                    'title'     => esc_html__( 'User standard sidebar', 'herald' ),
                    'subtitle'  => esc_html__( 'Choose standard sidebar for bbPress user pages', 'herald' ),
                    'options'   => herald_get_sidebars_list(),
                    'default'   => 'herald_default_sidebar',
                    'required'  => array( 'bb_user_use_sidebar', '!=', 'none' )
                ),

                array(
                    'id'        => 'bb_user_sticky_sidebar',
                    'type'      => 'select',
                    'title'     => esc_html__( 'User sticky sidebar', 'herald' ),
                    'subtitle'  => esc_html__( 'Choose sticky sidebar for bbPress user pages', 'herald' ),
                    'options'   => herald_get_sidebars_list(),
                    'default'   => 'herald_default_sticky_sidebar',
                    'required'  => array( 'bb_user_use_sidebar', '!=', 'none' )
                )


            ) )
    );
}


Redux::setSection( $opt_name , array(
        'type' => 'divide',
        'id' => 'herald-divide',
    ) );

/* Translation Options */

$translate_options[] = array(
    'id' => 'enable_translate',
    'type' => 'switch',
    'switch' => true,
    'title' => esc_html__( 'Enable theme translation?', 'herald' ),
    'default' => '1'
);

$translate_strings = herald_get_translate_options();

foreach ( $translate_strings as $string_key => $string ) {
    $translate_options[] = array(
        'id' => 'tr_'.$string_key,
        'type' => 'text',
        'title' => esc_html( $string['text'] ),
        'subtitle' => isset( $string['desc'] ) ? $string['desc'] : '',
        'default' => ''
    );
}

Redux::setSection( $opt_name, array(
        'icon'      => 'el-icon-globe-alt',
        'title' => esc_html__( 'Translation', 'herald' ),
        'desc' => __( 'Use these settings to quckly translate or change the text in this theme. If you want to remove the text completely instead of modifying it, you can use <strong>"-1"</strong> as a value for particular field translation. <br/><br/><strong>Note:</strong> If you are using this theme for a multilingual website, you need to disable these options and use multilanguage plugins (such as WPML) and manual translation with .po and .mo files located inside the "languages" folder.', 'herald' ),
        'fields' => $translate_options
    ) );

/* Performance */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-dashboard',
        'title'     => esc_html__( 'Performance', 'herald' ),
        'desc'     => esc_html__( 'Use these options to put your theme to a high speed as well as save your server resources!', 'herald' ),
        'fields'    => array(

         array(
                'id' => 'minify_css',
                'type' => 'switch',
                'title' => esc_html__( 'Use minified CSS', 'herald' ),
                'subtitle' => esc_html__( 'Load all theme css files combined and minified into a single file.', 'herald' ),
                'default' => true
            ),

         array(
                'id' => 'minify_js',
                'type' => 'switch',
                'title' => esc_html__( 'Use minified JS', 'herald' ),
                'subtitle' => esc_html__( 'Load all theme js files combined and minified into a single file.', 'herald' ),
                'default' => true
            ),

         array(
                'id' => 'disable_img_sizes',
                'type' => 'checkbox',
                'multi' => true,
                'title' => esc_html__( 'Disable additional image sizes', 'herald' ),
                'subtitle' => esc_html__( 'By default, theme generates additional image size/version for each of the layouts it offers. You can use this option to avoid creating additional sizes if you are not using particular layout and save your server bandwith.', 'herald' ),
                'options' => array(
                    'a' => 'Layout A',
                    'a1' => 'Layout A1',
                    'a2' => 'Layout A2',
                    'a3' => 'Layout A3',
                    'b' => 'Layout B',
                    'b1' => 'Layout B1',
                    'c' => 'Layout C',
                    'c1' => 'Layout C1',
                    'd' => 'Layout D',
                    'd1' => 'Layout D1',
                    'f' => 'Layout F',
                    'f1' => 'Layout F1',
                    'g' => 'Layout G',
                    'g1' => 'Layout G1',
                    'i' => 'Layout I',
                    'i1' => 'Layout I1',
                    'k' => 'Layout K',
                    'single' => 'Single post featured image',
                    'page' => 'Page featured image',
                    'fa1' => 'Featured area 1 & 2',
                    'fa3' => 'Featured area 3 & 4',
                    'fa5' => 'Featured area 5',
                ),

                'default' => array()
         ),



)));

/* Additional code */

Redux::setSection( $opt_name, array(
        'icon'      => 'el-icon-css',
        'title' => esc_html__( 'Additional Code', 'herald' ),
        'desc' =>  esc_html__( 'Modify the default styling of the theme by adding custom CSS or JavaScript code. Note: These options are for advanced users only, so use it with caution.', 'herald' ),
        'fields' => array(


            array(
                'id'       => 'additional_css',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Additional CSS', 'herald' ),
                'subtitle' => esc_html__( 'Use this field to add CSS code and modify the default theme styling', 'herald' ),
                'mode'     => 'css',
                'theme'    => 'monokai',
                'default'  => ''
            ),

            array(
                'id'       => 'additional_js',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Additional JavaScript', 'herald' ),
                'subtitle' => esc_html__( 'Use this field to add JavaScript code', 'herald' ),
                'desc' => esc_html__( 'Note: Please use clean execution JavaScript code without "script" tags', 'herald' ),
                'mode'     => 'javascript',
                'theme'    => 'monokai',
                'default'  => ''
            ),

            array(
                'id'       => 'ga',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Google Analytics tracking code', 'herald' ),
                'subtitle' => esc_html__( 'Paste your Google Analytics tracking code (or any other JavaScript related tracking code)', 'herald' ),
                'desc' => esc_html__( 'Note: Please use code with "script" tags included', 'herald' ),
                'mode'     => 'text',
                'theme'    => 'monokai',
                'default'  => ''
            )
        ) )
);



/* Updater Options */

Redux::setSection( $opt_name, array(
        'icon'      => 'el-icon-time',
        'title' => esc_html__( 'Updater', 'herald' ),
        'desc' => wp_kses( sprintf( __( 'Specify your ThemeForest username and API Key to enable theme update notification. When there is a new version of the theme, it will appear on your <a href="%s">updates screen</a>.', 'herald' ), admin_url( 'update-core.php' ) ), wp_kses_allowed_html( 'post' )),
        'fields' => array(

            array(
                'id' => 'theme_update_username',
                'type' => 'text',
                'title' => esc_html__( 'Your ThemeForest Username', 'herald' ),
                'default' => ''
            ),

            array(
                'id' => 'theme_update_apikey',
                'type' => 'text',
                'title' => esc_html__( 'Your ThemeForest API Key', 'herald' ),
                'desc' => wp_kses( sprintf( __( 'Where can I find my %s?', 'herald'), '<a href="http://themeforest.net/help/api" target="_blank">API key</a>'), wp_kses_allowed_html( 'post' ) ),
                'default' => ''
            )
        ) )
);




?>
