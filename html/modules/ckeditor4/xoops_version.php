<?php
/**
 * @file
 * @package ckeditor4
 * @version $Id$
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

//
// Define a basic manifesto.
//
$modversion['name'] = _MI_CKEDITOR4_LANG_CKEDITOR4;
$modversion['version'] = 0.18;
$modversion['description'] = _MI_CKEDITOR4_DESC_CKEDITOR4;
$modversion['author'] = "nao-pon http://xoops.hypweb.net/";
$modversion['credits'] = "Naoki Sawada aka nao-pon";
$modversion['help'] = "help.html";
$modversion['license'] = "GPL";
$modversion['official'] = 0;
$modversion['image'] = "images/mydhtml.png";
$modversion['dirname'] = "ckeditor4";

$modversion['cube_style'] = true;
$modversion['disable_legacy_2nd_installer'] = false;

// TODO After you made your SQL, remove the following comment-out.
// $modversion['sqlfile']['mysql'] = "sql/mysql.sql";
##[cubson:tables]
##[/cubson:tables]

//
// Templates. You must never change [cubson] chunk to get the help of cubson.
//
$modversion['templates'][]['file'] = 'ckeditor4_textarea.html';
##[cubson:templates]
##[/cubson:templates]

//
// Admin panel setting
//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

//
// Public side control setting
//
$modversion['hasMain'] = 0;
// $modversion['sub'][]['name'] = "";
// $modversion['sub'][]['url'] = "";

//$modversion['config'][] = array(
//		'name'			=> 'editors' ,
//		'title'			=> '_MI_CKEDITOR4_EDITORS',
//		'description'	=> '_MI_CKEDITOR4_EDITORS_DESC',
//		'formtype'		=> ((defined('_MI_LEGACY_DETAILED_VERSION') && version_compare(_MI_LEGACY_DETAILED_VERSION, 'CorePack 20120825', '>='))? 'checkbox_br' : 'select_multi'),
//		'valuetype'		=> 'array',
//		'default'		=> array( 'html', 'bbcode'),
//		'options'		=> array( 'HTML' => 'html', 'XOOPS(BB)Code' => 'bbcode')
//) ;

$modversion['config'][] = array(
		'name'			=> 'toolbar_admin' ,
		'title'			=> '_MI_CKEDITOR4_TOOLBAR_ADMIN',
		'description'	=> '_MI_CKEDITOR4_TOOLBAR_ADMIN_DESC',
		'formtype'		=> 'textarea' ,
		'valuetype'		=> 'string' ,
		'default'		=> 'Full'
) ;

$modversion['config'][] = array(
		'name'			=> 'special_groups' ,
		'title'			=> '_MI_CKEDITOR4_SPECIAL_GROUPS',
		'description'	=> '_MI_CKEDITOR4_SPECIAL_GROUPS_DESC',
		'formtype'		=> ((defined('_MI_LEGACY_DETAILED_VERSION') && version_compare(_MI_LEGACY_DETAILED_VERSION, 'CorePack 20120825', '>='))? 'group_checkbox' : 'group_multi') ,
		'valuetype'		=> 'array' ,
		'default'		=> array()
) ;

$modversion['config'][] = array(
		'name'			=> 'toolbar_special_group' ,
		'title'			=> '_MI_CKEDITOR4_TOOLBAR_SPECIAL_GROUP',
		'description'	=> '_MI_CKEDITOR4_TOOLBAR_SPECIAL_GROUP_DESC',
		'formtype'		=> 'textarea' ,
		'valuetype'		=> 'string' ,
		'default'		=> 'Full'
) ;

$modversion['config'][] = array(
		'name'			=> 'toolbar_user' ,
		'title'			=> '_MI_CKEDITOR4_TOOLBAR_USER',
		'description'	=> '_MI_CKEDITOR4_TOOLBAR_USER_DESC',
		'formtype'		=> 'textarea' ,
		'valuetype'		=> 'string' ,
		'default'		=> '[["PasteText","-","Undo","Redo" ],["Bold","Italic","Underline","Strike","-","TextColor","-","RemoveFormat","FontSize"],["Blockquote"],["Link","Image","Smiley"],["Maximize", "ShowBlocks","-","About""]]'
) ;

$modversion['config'][] = array(
		'name'			=> 'toolbar_guest' ,
		'title'			=> '_MI_CKEDITOR4_TOOLBAR_GUEST',
		'description'	=> '_MI_CKEDITOR4_TOOLBAR_GUEST_DESC',
		'formtype'		=> 'textarea' ,
		'valuetype'		=> 'string' ,
		'default'		=> '[["PasteText","-","Undo","Redo" ],["Bold","Italic","Underline","Strike","-","TextColor","-","RemoveFormat","FontSize"],["Blockquote"],["Link","Image","Smiley"],["Maximize", "ShowBlocks","-","About"]]'
) ;

$modversion['config'][] = array(
		'name'			=> 'toolbar_bbcode' ,
		'title'			=> '_MI_CKEDITOR4_TOOLBAR_BBCODE',
		'description'	=> '_MI_CKEDITOR4_TOOLBAR_BBCODE_DESC',
		'formtype'		=> 'textarea' ,
		'valuetype'		=> 'string' ,
		'default'		=> '[["Source"],["PasteText","-","Undo","Redo" ],["Bold","Italic","Underline","Strike","-","TextColor","-","RemoveFormat","FontSize"],["Blockquote"],["Link","Image","Smiley"]]'
) ;

$modversion['config'][] = array(
		'name'			=> 'contentsCss' ,
		'title'			=> '_MI_CKEDITOR4_CONTENTSCSS',
		'description'	=> '_MI_CKEDITOR4_CONTENTSCSS_DESC',
		'formtype'		=> 'textarea' ,
		'valuetype'		=> 'string' ,
		'default'		=> 'head'
) ;

$modversion['config'][] = array(
		'name'			=> 'extraPlugins' ,
		'title'			=> '_MI_CKEDITOR4_EXTRAPLUGINS',
		'description'	=> '_MI_CKEDITOR4_EXTRAPLUGINS_DESC',
		'formtype'		=> 'textbox' ,
		'valuetype'		=> 'string' ,
		'default'		=> ''
) ;

$modversion['config'][] = array(
		'name'			=> 'customConfig' ,
		'title'			=> '_MI_CKEDITOR4_CUSTOMCONFIG',
		'description'	=> '_MI_CKEDITOR4_CUSTOMCONFIG_DESC',
		'formtype'		=> 'textbox' ,
		'valuetype'		=> 'string' ,
		'default'		=> ''
) ;

$modversion['config'][] = array(
		'name'			=> 'xelfinder' ,
		'title'			=> '_MI_CKEDITOR4_XELFINDER',
		'description'	=> '_MI_CKEDITOR4_XELFINDER_DESC',
		'formtype'		=> 'textbox' ,
		'valuetype'		=> 'string' ,
		'default'		=> 'xelfinder'
) ;

?>
