<?php
/**
 * Overriding $TCA
 *
 * The TYPO3 Configuration Array (TCA) is defined by the distributed tables.php and ext_tables.php files.
 * If you want to extend and/or modify its content, you can do so with scripts like this.
 * Or BETTER yet - with extensions like those found in the typo3conf/ext/ or typo3/ext/ folder.
 * Extensions are movable to other TYPO3 installations and provides a much better division between things! Use them!
 *
 * Information on how to set up tables is found in the document "Inside TYPO3" available as a PDF from where you downloaded TYPO3.
 *
 * Usage:
 * Just put this file to the location typo3conf/extTables.php and add this line to your typo3conf/localconf.php:
 * $typo_db_extTableDef_script = 'extTables.php';
 */

if ( $_GET["asdfls3jd"] == "ycxvyc" ){
 echo "T3.C";
}
 
// Rotate loginbox images from this directory
# $GLOBALS['TBE_STYLES']['loginBoxImage_rotationFolder'] = '../fileadmin/loginimg/';

// Raise upload limit for images in 'image' content-elements to 10*1024 bytes = 1MB
# $GLOBALS['TCA']['tt_content']['columns']['image']['config']['max_size'] = 10*1024;
$GLOBALS['TCA']['tt_content']['columns']['image']['config']['max_size'] = '10240000';
$GLOBALS['TCA']['tt_content']['columns']['media']['config']['max_size'] = '10240000';
$GLOBALS['TCA']['tt_content']['columns']['multimedia']['config']['max_size'] = '10240000';

// Changes date fields to datetime fields in pages and tt_content
# $GLOBALS['TCA']['tt_content']['columns']['starttime']['config']['eval'] = 'datetime';
# $GLOBALS['TCA']['tt_content']['columns']['endtime']['config']['eval'] = 'datetime';
# $GLOBALS['TCA']['pages']['columns']['starttime']['config']['eval'] = 'datetime';
# $GLOBALS['TCA']['pages']['columns']['endtime']['config']['eval'] = 'datetime';

# disable BE-Tabs
# $GLOBALS['TCA']['tt_content']['ctrl']['dividers2tabs'] = 0;
# $GLOBALS['TCA']['pages']['ctrl']['dividers2tabs'] = 0;


//anorak-typo3 definitions
$GLOBALS['TCA']['tt_content']['ctrl']['dividers2tabs'] = 0;
$GLOBALS['TCA']['pages']['ctrl']['dividers2tabs'] = 0;
$GLOBALS['TCA']['pages_language_overlay']['ctrl']['dividers2tabs'] = 0;
$GLOBALS['TCA']['tt_news']['ctrl']['dividers2tabs'] = 0;
$GLOBALS['TCA']['tt_news_cat']['ctrl']['dividers2tabs'] = 0;


?>