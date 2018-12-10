/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.toolbar = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' }
	];
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';
	config.font_names='宋体/SimSun;新宋体/NSimSun;MS 明朝/MS Mincho;MS Pゴシック/ms gothic;黑体/SimHei;微软雅黑/Microsoft YaHei;'+ config.font_names;

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
	config.image_previewText=' ';
	config.filebrowserImageUploadUrl= "http://backend.labor-laws.com/upload/index";
	//config.filebrowserImageUploadUrl= "http://localhost/zcw/backend/web/upload/index";
	//config.filebrowserImageUploadUrl= "http://localhost/zcw/backend/web/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images";
	
};
