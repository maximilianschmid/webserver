<?php

########################################################################
# Extension Manager/Repository config file for ext: "db_yamltv"
#
# Auto generated 03-06-2008 22:39
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'YAML for TemplaVoila',
	'description' => 'This is the public version of YAML for TemplaVoila Template. It can be used free of charge if the links in the footer remain intact. If you want to remove these links, you MUST buy a license. See http://yaml.t3net.de/Nutzungsbedingungen.67.0.html for informations about a license.',
	'category' => 'templates',
	'author' => 'Dieter Bunkerd',
	'author_email' => 'db@t3net.de',
	'author_company' => 'T3NET CO.,LTD.',
	'shy' => '',
	'dependencies' => 'css_styled_content,templavoila,indexed_search,macina_searchbox,kb_md5fepw,tt_news,sr_language_menu',
	'conflicts' => 'db_yamlap',
	'priority' => '',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'version' => '3.0.4',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.1.0-4.9.9',
			'css_styled_content' => '0.3.1-',
			'templavoila' => '1.3.3-',
			'indexed_search' => '2.0.0-',
			'macina_searchbox' => '2.2.0-',
			'kb_md5fepw' => '0.4.0-',
			'tt_news' => '2.0.0-',
			'sr_language_menu' => '1.3.0-',
		),
		'conflicts' => array(
			'db_yamlap' => '9.9.9-0.0.0',
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:94:{s:9:"ChangeLog";s:4:"8cba";s:10:"README.txt";s:4:"97bc";s:12:"ext_icon.gif";s:4:"8502";s:17:"ext_localconf.php";s:4:"3618";s:14:"ext_tables.php";s:4:"b204";s:16:"locallang_db.xml";s:4:"5d19";s:14:"doc/manual.sxw";s:4:"8a45";s:29:"pi1/class.tx_dbyamltv_pi1.php";s:4:"b1c8";s:24:"pi1/static/constants.txt";s:4:"b0ed";s:20:"pi1/static/setup.txt";s:4:"bff6";s:27:"template/2col_left_0-u.html";s:4:"74d5";s:28:"template/2col_left_0-ul.html";s:4:"3c11";s:26:"template/2col_left_13.html";s:4:"23e1";s:27:"template/2col_left_132.html";s:4:"ae9a";s:35:"template/2col_left_13_sub25-75.html";s:4:"ab0b";s:38:"template/2col_left_13_sub33-33-33.html";s:4:"d229";s:35:"template/2col_left_13_sub33-66.html";s:4:"8e46";s:35:"template/2col_left_13_sub38-62.html";s:4:"6397";s:35:"template/2col_left_13_sub50-50.html";s:4:"9364";s:35:"template/2col_left_13_sub62-38.html";s:4:"da8b";s:35:"template/2col_left_13_sub66-33.html";s:4:"da85";s:35:"template/2col_left_13_sub75-25.html";s:4:"0f45";s:21:"template/LIESMICH.txt";s:4:"d4ab";s:19:"template/README.txt";s:4:"5256";s:45:"template/01_layouts_basics/3col_standard.html";s:4:"541f";s:42:"template/02_layouts_2col/2col_left_13.html";s:4:"5e8c";s:42:"template/02_layouts_2col/2col_left_31.html";s:4:"66ca";s:43:"template/02_layouts_2col/2col_right_13.html";s:4:"1aae";s:43:"template/02_layouts_2col/2col_right_31.html";s:4:"2b16";s:40:"template/03_layouts_3col/3col_1-2-3.html";s:4:"b07f";s:40:"template/03_layouts_3col/3col_1-3-2.html";s:4:"2f98";s:40:"template/03_layouts_3col/3col_2-1-3.html";s:4:"7c06";s:40:"template/03_layouts_3col/3col_2-3-1.html";s:4:"fa35";s:40:"template/03_layouts_3col/3col_3-1-2.html";s:4:"01b9";s:40:"template/03_layouts_3col/3col_3-2-1.html";s:4:"e33e";s:56:"template/04_layouts_styling/3col_column_backgrounds.html";s:4:"39fe";s:53:"template/04_layouts_styling/3col_column_dividers.html";s:4:"2f9a";s:50:"template/04_layouts_styling/3col_faux_columns.html";s:4:"1ca0";s:47:"template/04_layouts_styling/3col_gfxborder.html";s:4:"ed7a";s:47:"template/05_layouts_advanced/2col_left_seo.html";s:4:"0249";s:48:"template/05_layouts_advanced/3col_fixed_seo.html";s:4:"9429";s:23:"template/FCE/25-75.html";s:4:"ec89";s:26:"template/FCE/33-33-33.html";s:4:"00fe";s:23:"template/FCE/33-66.html";s:4:"283e";s:23:"template/FCE/38-62.html";s:4:"e148";s:23:"template/FCE/50-50.html";s:4:"57a2";s:23:"template/FCE/62-38.html";s:4:"0e2d";s:23:"template/FCE/66-33.html";s:4:"f2cf";s:23:"template/FCE/75-25.html";s:4:"e3a2";s:37:"template/FCE/adjustable-2columns.html";s:4:"2de0";s:37:"template/FCE/adjustable-3columns.html";s:4:"af73";s:31:"template/FCE/roundbox-blue.html";s:4:"0f66";s:32:"template/FCE/roundbox-green.html";s:4:"7d67";s:30:"template/FCE/roundbox-red.html";s:4:"3f91";s:31:"template/yaml/central_draft.css";s:4:"18af";s:31:"template/yaml/markup_draft.html";s:4:"597c";s:27:"template/yaml/core/base.css";s:4:"d829";s:30:"template/yaml/core/iehacks.css";s:4:"132d";s:33:"template/yaml/core/print_base.css";s:4:"c41a";s:32:"template/yaml/core/slim_base.css";s:4:"6034";s:35:"template/yaml/core/slim_iehacks.css";s:4:"0732";s:38:"template/yaml/core/slim_print_base.css";s:4:"9c5d";s:29:"template/yaml/debug/debug.css";s:4:"fa58";s:43:"template/yaml/debug/images/grid_pattern.png";s:4:"fc8f";s:46:"template/yaml/debug/images/warning_iehacks.gif";s:4:"00db";s:41:"template/yaml/debug/images/yaml_debug.gif";s:4:"94ef";s:45:"template/yaml/navigation/nav_shinybuttons.css";s:4:"9907";s:44:"template/yaml/navigation/nav_slidingdoor.css";s:4:"d683";s:38:"template/yaml/navigation/nav_vlist.css";s:4:"e11f";s:60:"template/yaml/navigation/images/shiny_buttons/background.gif";s:4:"b830";s:67:"template/yaml/navigation/images/shiny_buttons/background_active.gif";s:4:"79e2";s:65:"template/yaml/navigation/images/sliding_door/gfx_sliding_door.psd";s:4:"d6f7";s:57:"template/yaml/navigation/images/sliding_door/round/bg.gif";s:4:"8bfb";s:59:"template/yaml/navigation/images/sliding_door/round/left.gif";s:4:"3946";s:62:"template/yaml/navigation/images/sliding_door/round/left_on.gif";s:4:"8c55";s:60:"template/yaml/navigation/images/sliding_door/round/right.gif";s:4:"26a9";s:63:"template/yaml/navigation/images/sliding_door/round/right_on.gif";s:4:"7809";s:53:"template/yaml/navigation/images/vlist/square/node.gif";s:4:"5899";s:59:"template/yaml/navigation/images/vlist/square/node_minus.gif";s:4:"569a";s:58:"template/yaml/navigation/images/vlist/square/node_plus.gif";s:4:"77fa";s:56:"template/yaml/navigation/images/vlist/square/subnode.gif";s:4:"6913";s:62:"template/yaml/navigation/images/vlist/square/subnode_minus.gif";s:4:"18b6";s:61:"template/yaml/navigation/images/vlist/square/subnode_plus.gif";s:4:"99bc";s:44:"template/yaml/patches/patch_layout_draft.css";s:4:"5e23";s:41:"template/yaml/patches/patch_nav_vlist.css";s:4:"abe5";s:39:"template/yaml/print/print_003_draft.css";s:4:"f98a";s:39:"template/yaml/print/print_020_draft.css";s:4:"8bd6";s:39:"template/yaml/print/print_023_draft.css";s:4:"471a";s:39:"template/yaml/print/print_100_draft.css";s:4:"1128";s:39:"template/yaml/print/print_103_draft.css";s:4:"4cbb";s:39:"template/yaml/print/print_120_draft.css";s:4:"e43a";s:39:"template/yaml/print/print_123_draft.css";s:4:"23a2";s:38:"template/yaml/screen/basemod_draft.css";s:4:"b55d";s:40:"template/yaml/screen/content_default.css";s:4:"3882";}',
	'suggests' => array(
	),
);

?>