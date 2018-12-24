== Change Log ==

= 2.1.2 =

* Added: Initial support for the upcoming new WordPress content editor (Gutenberg)

= 2.1.1 =

* Fixed: Featured module not working when posts were filtered by tag (bug appeared in version 2.1)

= 2.1 =

* Added: Option to add category featured image (thumbnail) so it can be displayed in Category modules
* Added: Featured Module in Modules Template now fully supports displaying Custom Post Types (if registered, they will be detected automatically and you can choose it instead of standard posts)
* Added: Option to display Facebook and Instagram profile links in author vertical meta bar on single posts (Theme Options -> Single Post -> Meta Bar)
* Added: Options to disable ads on specific pages, i.e contact, 404, etc... (Theme Options -> Ads)
* Added: Quora social icon option for author social links in the author box below single post content
* Improved: Styling for GDPR cookie consent checkbox field in comment forms
* Improved: Password protected functionality is now supported in Modules Template
* Fixed: Font size options not working properly on specific server configurations
* Fixed: Minor styling issues

= 2.0 =

* Added: Options to manage font sizes for various text elements through Theme Options panel (Theme Options -> Typography) 
* Added: Option to specify "number of words per minute" in order to fine-tune calculation of posts "reading time" (Theme Options -> Misc.)
* Improved: Compatibility for the latest WooCommerce plugin version
* Fixed: Minor styling issues in various browsers & responsive mode

= 1.9.1 =

* Added: When choosing posts manually inside modules, now you have a quick search field for an easier selection, instead of entering post IDs (Modules Template)
* Fixed: Problem with comments section overlapping footer in Post Layout 1 (appeared in version 1.9)
* Fixed: Minor styling issues


= 1.9 =

* Added: Option to display updated/modified date in post meta data for all layouts (Theme Options -> Main Layouts)
* Added: Option to order posts by updated/modified date in Modules (Modules Template)
* Added: Option to choose between include/exclude logic when filtering custom post types by its taxonomies (Modules Template)
* Added: Option to add WooCommerce Cart as Header element (Theme Options -> Header)
* Added: Option to display Header Ad in responsive mode (Theme Options -> Header -> Responsive Header)
* Added: Translation strings for login form in Header (Theme Options -> Translate)
* Improved: Blurry text over the images in specific layouts and cases
* Fixed: Minor styling issues in various browsers & responsive mode


= 1.8 =
* Added: Category modules (now you can display/list your categories via module builder)
* Added: vKontakte share button
* Added: Login form can be added as header element (Theme Options -> Header)
* Added: Support for new WordPress widgets (Audio, Video, Image)
* Added: Option to group secondary menus under a single "more" link in responsive/mobile navigation (Theme Options -> Header -> Responsive Header)
* Added: Support for Yoast SEO plugin's "primary category" feature (Theme Options -> Misc.)
* Added: New Google Fonts (Theme Options -> Typography.)
* Added: Support for WooCommerce 3+
* Fixed: Conflict with some plugins which break author twitter url on single post vertical meta bar
* Fixed: Minor styling issues in various browsers, responsive and rtl mode


= 1.7 =
* Added: Authors module which displays your users/authors (Modules Template)
* Adeed: New ad slot to display ad inside vertical meta bar on single posts (Theme Options -> Ads, Theme Options -> Single Post -> Meta Bar)
* Added: More options for trending posts section. Now you can slide/rotate items, and choose number of items to display (Theme Options -> Header -> Trending)
* Added: Options to temporarily activate/deactivate modules
* Added: Options to order posts by user/visitor review score (if using WP review plugin)
* Added: Option to open regular content images in pop-up (Theme Options -> Misc.)
* Added: Option to add more elements to responsive/mobile header navigation (Theme Options -> Header -> Responsive Header)
* Improved: Image post format now displays image caption in pop-up
* Fixed: Sticky bottom bar on single posts not displaying on mobile
* Fixed: Minor styling issues in various browsers, responsive and rtl mode

= 1.6 =
* Added: Support for custom post types in modules. If any public custom post type is registered it will be automatically detected in modules (Modules Template)
* Added: Authors Page Template which lists all blog authors
* Added: Support for Co-Authors Plus WordPress Plugin, now you can easily set multiple authors for a single post
* Added: Option to filter posts by one or more authors (Modules Template)
* Added: Option to exclude specific posts by IDs (Modules Template)
* Added: Option to add link to module title (Modules Template)
* Added: Option to make vertical meta bar sticky  (Theme Options -> Single Post -> Meta Bar)
* Added: Option to enable infinite scroll loading on single posts (Theme Options -> Single Post -> Extras)
* Added: Options to choose sidebars for bbPress user pages (Theme Options -> bbPress )
* Improved: If category has a parent it will display its link so you can go back to parent category (Category Template)
* Fixed: Filtering by tags not working in modules when more then one tag is specified

= 1.5.3 =

* Added: Option to display full content instead of excerpt in Layout A (Theme Options -> Main Layouts -> Layout A)
* Added: Share options for ReddIt, StubmeUpon, Email and WhatsApp (Theme Options -> Misc.)
* Improved: FontAwesome libary is updated to the latest version
* Improved: Redux options framework updated to the latest version
* Fixed: Exclude by tag option not working in modules
* Fixed: Minor styling issues in various browsers, responsive and rtl mode

= 1.5.2 =

* Added: "Custom CSS class" option field for sections and modules with which you get a possibility to apply custom styling to a section or a module using CSS
* Added: Option to on/off ads above and below content per each single post
* Added: Translation strings for comment form fields i.e Name, Email, Website (Theme Options -> Translation)
* Improved: Social sharing not working in some specific cases (i.e. having UTF8 characters in post titles)
* Improved: Reading time and excerpt limit now properly calculates values for languages with UTF8 and special characters
* Fixed: Option to filter posts by time period in Herald Posts Widget
* Fixed: Sticky sidebar conflicts in specific cases
* Fixed: Featured image custom ratio option not working (Theme Options -> Page)


= 1.5.1 =

* Fixed: Module builder not working in specific cases (bug appeared in version 1.5)


= 1.5 =

* Added: Option to specify browser width which will trigger responsive header ( Theme Options -> Header -> Responsive Header)
* Added: Option to sort posts in ascending or descending order in modules (Modules Template)
* Added: Option to automatically select posts from child categories if parent category is selected (Modules Template)
* Added: Option to choose whether to include or exclude posts from selected categories (Modules Template)
* Added: Option to choose whether to include or exclude posts from selected tags (Modules Template)
* Added: Option to on/off category description (Theme Options -> Category Template)
* Added: Option to position comment form above/below comments list (Theme Options -> Single -> Extras)
* Added: Option to display post time in meta data for all post layouts
* Added: Option to enable "multibyte" support and calculate reading time properly for some specific languages (Theme Options -> Misc.)
* Added: Option to choose whether prev/next posts in sticky bottom bar will be pulled from the same category as current post (Theme Options -> Single -> Extras)
* Added: Full support for Custom Sidebars WordPress plugin by WMPU Dev. Now widgets inherit our theme styling by default 
* Improved: If paginated post is set to be displayed in layouts 3,6 or 9, it will automatically fall-back to layouts 2,5 or 8 respectively, in order to avoid styling issues
* Fixed: Minor styling conflict with WP Review plugin latest version
* Fixed: Minor styling issues in various browsers, responsive and rtl mode


= 1.4.3 =

* Fixed: Problem with editing categories in WP 4.5


= 1.4.2 =

* Fixed: Bug with specific Google Fonts


= 1.4.1 =
* Improved: Featured image on the first page of a paginated post is displayed by default
* Fixed: Minor styling glitches in various browsers, responsive and rtl mode
* Fixed: Header/Footer date language for non-english WP installations
* Fixed: Conflict with plugins which override Twitter field in user profile options


= 1.4 =

* Added: Support for post reviews system using WP Review WordPress Plugin (stars, points and percentage review type). You can also order posts in modules by review values!
* Added: Option to automatically play (rotate) posts in slider modules
* Added: Posibility to remove vertical meta bar on single posts (Theme Options -> Single Post -> Meta Bar)
* Added: Support for breadcrumbs using Yoast SEO WordPress plugin
* Added: Search button in mobile/responsive header
* Fixed: Minor styling glitches reported by users

= 1.3 =

* Added: Options to filter trending posts by category, tag, or choose manually (Theme Options -> Header -> Trending Posts)
* Added: Option to filter posts in Modules by specific post Format (i.e. display Video posts only)
* Added: Possibility to override global display options per each single post separately (i.e. On/Off featured image only for some posts)
* Added: New ad slot - above single post content (Theme Options -> Ads )
* Added: Possibility to put Mini Logo in header bottom bar
* Added: Option to position meta bar left/right for single posts (Theme Options -> Single Post -> Meta Bar)
* Added: Option to change overlay opacity values for Layouts with the text over the images (Theme Options -> Misc)
* Added: Option to display scroll to top button (Theme Options -> Misc)
* Added: Possibility to order posts in Modules by title (alphabetically)
* Added: Option to on/off post titles in Layout K (Theme Options -> Main layouts -> Layout K)
* Added: Option to position paginated post navigation above/below post content (Theme Options -> Single Post -> Extras)
* Added: Option to display featured image caption on pages (Theme Options -> Page)
* Added: Full width Page template
* Fixed: Several styling issues for specific layouts
* Fixed: Lots of RTL mode bugs and issues



= 1.2 = 

* Added: Full support for WooCommerce WordPress plugin
* Added: Products Module! You can display your WooCommerce products in Modules template
* Added: Full support for bbPress WordPress plugin
* Added: Option to filter posts by tag (Posts Module, Featured Module)
* Added: 2 new demos for import - Blog and Tech examples!
* Improved: Several styling tweaks and improvements in various browsers and responsive mode
* Fixed: Text module not saving content in Mozilla Firefox
* Fixed: Module builder not working fine in older Safari versions

= 1.1 =

* Added: 3 new demo examples in demo importer!
* Improved: Several styling tweaks and improvements in various browsers and responsive mode
* Fixed: Related posts option not working in admin in some browsers
* Fixed: Comments button in sticky bottom bar not working for custom comments plugins
* Fixed: Logo option not sizing properly on mobiles


= 1.0 =
* Initial release
