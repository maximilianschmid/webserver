<?php
/**
 * Copyright notice
 *
 * (c)  2006 -2011 Peter Russ (peter.russ@uon.li)  All rights reserved

 * License:
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the MPL Mozilla Public License
 * as published by the Free Software Foundation; either version 1.1
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * MPL Mozilla Public License for more details.
 *
 * You may have received a copy of the MPL Mozilla Public License
 * along with this program.
 *
 * An on-line copy of the MPL Mozilla Public License can be found
 * http://www.mozilla.org/MPL/MPL-1.1.html
 *
 * @author: 		Peter Russ <peter.russ@uon.li>
 * @copyright:		(c) Peter Russ (peter.russ@uon.li), 2006 -2011
 * @version:		$Rev: 43059 $
 * @package:		TYPO3
 * @subpackage:	fdfx_be_image
 * 
 */
class tx_fdfxbeimage_Image_Crop extends tx_fdfxbeimage_Image_Basic {
	
	public function getContent() {
		$content = '';
		$options = '';
		$optionLines = explode ( ',', $this->conf ['FIXED_SIZE'] );
		$sessionData = tx_fdfxbeimage_data::sessionGet();
		$count = 1;
		foreach ( $optionLines as $line ) {
			$sel = ($count ++ == $this->conf ['FIXED_SIZE_DEFAULT']) ? ' selected="selected"' : '';
			list ( $value, $option ) = explode ( '=', $line );
			$options .= '<option value="' . $value . '"' . $sel . '>' . $option . '</option>';
		}
		$formats = explode( ',', $this->conf ['IMAGE_FORMAT'] );
		$imageOptions = '';
		foreach ( $formats as $format ) {
			$format = strtolower($format);
			$sel = ($convertTo == $format) ? ' selected="selected"' : '';
			$imageOptions .= '<option value="' . $format . '"' . $sel . '>' . strtoupper($format) . '</option>';
		}	
		$fI = t3lib_div::split_fileref ( $this->fileName );
		$fileNameLocal = substr ( $this->fileName, strlen ( PATH_site ) );
		$fileName = t3lib_div::isFirstPartOfStr ( $this->fileName, PATH_site ) ? '../../../../' . (($this->fileNameLocal) ? $this->fileNameLocal : $fileNameLocal) : $fI ['file'];
		$x = tx_fdfxbeimage_data::getValueFromSession($sessionData, 'x');
		$y = tx_fdfxbeimage_data::getValueFromSession($sessionData, 'y');
		$width =tx_fdfxbeimage_data::getValueFromSession($sessionData, 'width');
		$height = tx_fdfxbeimage_data::getValueFromSession($sessionData, 'height');
		$percentSize = tx_fdfxbeimage_data::getValueFromSession($sessionData, 'percentSize');
		$convertTo = tx_fdfxbeimage_data::getValueFromSession($sessionData, 'convertTo');
		$content = '
<div id="pageContent">
<div>
' . $this->btn_back ( '', $this->returnUrl ) . '
</div>

<div class="crop_content"  style="float:left;">
  <div id="imageContainer">
    <img src="' . $fileName . '">
  </div>
</div>

<div style="float:left;">
<form>
<input type="hidden" id="input_image_ref" value="' . $fileNameLocal . '">
<fieldset id="fdfx-be-image-crop-offset">
	<legend>' . $GLOBALS ['LANG']->getLL ( 'tx_fdfxbeimage_crop_legend_offset' ) . '</legend>
    <div class="item item-crop-x">
    	<label for=""input_crop_x">' . $GLOBALS ['LANG']->getLL ( 'tx_fdfxbeimage_crop_label_x' ) . '</label>
        <input type="text" class="textInput" name="crop_x" id="input_crop_x" value="' . $x . '"/>
    </div>
    <div class="item item-crop-y">
    	<label for=""input_crop_y">' . $GLOBALS ['LANG']->getLL ( 'tx_fdfxbeimage_crop_label_y' ) . '</label>
        <input type="text" class="textInput" name="crop_y" id="input_crop_y" value="' . $y . '" />
    </div>
	<div class="item item-dimension">
		Dimension: <span id="label_dimension"></span>
	</div>
</fieldset>
<fieldset id="fdfx-be-image-crop-dimension">
	<legend>' . $GLOBALS ['LANG']->getLL ( 'tx_fdfxbeimage_crop_legend_dimension' ) . '</legend>
    <div class="item item-crop-width">
    	<label for=""input_crop_width">' . $GLOBALS ['LANG']->getLL ( 'tx_fdfxbeimage_crop_label_width' ) . '</label>
        <input type="text" class="textInput" name="crop_width" id="input_crop_width"  value="' . $width . '"/>
    </div>
    <div class="item item-crop-height">
    	<label for=""input_crop_height">' . $GLOBALS ['LANG']->getLL ( 'tx_fdfxbeimage_crop_label_height' ) . '</label>
        <input type="text" class="textInput" name="crop_height" id="input_crop_height"  value="' . $height . '"/>
    </div>
    <div class="item item-ratio">
    	<label for=""input_ratiol">' . $GLOBALS ['LANG']->getLL ( 'tx_fdfxbeimage_crop_label_ratio' ) . '</label>
		<input type="checkbox" name="ratio" id="input_ratio" value=""/>
    </div>
    <div class="item item-lock">
    	<label for=""input_lock">' . $GLOBALS ['LANG']->getLL ( 'tx_fdfxbeimage_crop_label_lock' ) . '</label>
		<input type="checkbox" name="lock" id="input_lock" value=""/>
    </div>
</fieldset>
<fieldset id="fdfx-be-image-crop-output">
	<legend>' . $GLOBALS ['LANG']->getLL ( 'tx_fdfxbeimage_crop_legend_output' ) . '</legend>
    <div class="item item-crop-percent-size">
    	<label for=""input_crop__percent_size">' . $GLOBALS ['LANG']->getLL ( 'tx_fdfxbeimage_crop_label_percent' ) . '</label>
        <input type="text" class="textInput" name="crop_percent_size" id="crop_percent_size"  value="' . $percentSize . '"/>
    </div>
    <div class="item item-convert-to">
    	<label for=""input_convert_to">' . $GLOBALS ['LANG']->getLL ( 'tx_fdfxbeimage_crop_label_convert' ) . '</label>
		<select class="textInput" id="input_convert_to">
' . $imageOptions . '
			</select>
    </div>
    <div class="item item-fixedsize">
    	<label for=""input_fixedsize">' . $GLOBALS ['LANG']->getLL ( 'tx_fdfxbeimage_crop_label_fixedsize' ) . '</label>
		<select class="textInput" id="input_fixedsize" onchange="cropScript_setSize(this)">
			<option value=""></option>
' . $options . '
		</select>
		<input type="button" class="setbutton" onclick="cropScript_setSize(this)" value="' . $GLOBALS ['LANG']->getLL ( 'tx_fdfxbeimage_crop_setsize' ) . '" />
    </div>
</fieldset>
<fieldset id="fdfx-be-image-crop-process">
	<legend>' . $GLOBALS ['LANG']->getLL ( 'tx_fdfxbeimage_crop_legend_process' ) . '</legend>
    <div class="item item-preview">
    	<label for=""input_preview">' . $GLOBALS ['LANG']->getLL ( 'tx_fdfxbeimage_crop_label_preview' ) . '</label>
		<input type="radio" name="store" id="input_preview" value="1" />
    </div>
    <div class="item item-store">
    	<label for=""input_store">' . $GLOBALS ['LANG']->getLL ( 'tx_fdfxbeimage_crop_label_store' ) . '</label>
		<input type="radio" name="store" id="input_store" value="2" checked="checked" />
    </div>
    <div class="item crop-botton">
           <input type="button" class="button" onclick="cropScript_executeCrop(this)" value="' . $GLOBALS ['LANG']->getLL ( 'tx_fdfxbeimage_crop_submit' ) . '" />
    </div>
    <div id="crop_progressBar"></div>
</fieldset>
</form>

</div>

</div>

<script type="text/javascript">
setCHash("' . tx_fdfxbeimage_image::getEncryptionMd5 ( $GLOBALS ['TYPO3_CONF_VARS'] ["SYS"] ["encryptionKey"], array ('crop', $fileNameLocal ) ) . '");
autoCrop=' . ((intval ( $this->conf ['FIXED_SIZE_DEFAULT'] ) > 0) ? 1 : 0) . ';
init_imageCrop();
resizeWinTo();
</script>
';
		return $content;
	}
	
	public function getHeader() {
		global $BACK_PATH;
		
		$extPath = $BACK_PATH . t3lib_extMgm::extRelPath ( self::$extKey ) . 'res/crop-image/';
		$imgObj = t3lib_div::makeInstance ( 't3lib_stdGraphic' );
		$imgObj->init ();
		$imgObj->mayScaleUp = 0;
		
		// Read Image Dimensions (returns false if file was not an image type, otherwise dimensions in an array)
		$imgInfo = '';
		$imgInfo = $imgObj->getImageDimensions ( $this->fileName );
		$width = $imgInfo [0];
		$height = $imgInfo [1];
		$content = '';
		if ($width > $this->conf ['MAX_WIDTH'] || $height > $this->conf ['MAX_HEIGHT']) {
			//we scale the image to display it in BE
			$imgObj->tempPath = PATH_site . $imgObj->tempPath;
			$file = t3lib_div::getFileAbsFileName ( $this->fileName );
			$imgInfoNew = $imgObj->imageMagickConvert ( $file, 'web', '', '', ' -' . $this->conf ['RESIZE_COMMAND'] . ' ' . $this->conf ['MAX_WIDTH'] . 'x' . $this->conf ['MAX_HEIGHT'], '', '', 1 );
			if (is_array ( $imgInfoNew )) {
				$this->fileNameLocal = substr ( $imgInfoNew [3], strlen ( PATH_site ) );
				$width = $imgInfoNew [0];
				$height = $imgInfoNew [1];
			} else {
				$content .= '<script type="text/javascript">alert("' . $this->conf ['RESIZE_COMMAND'] . ' is not accepted by ImageMagick. Please adjust!");</script>';
			}
		}
		$content .= '
	<link rel="stylesheet" href="' . $extPath . 'css/xp-info-pane.css"/>
	<link rel="stylesheet" href="' . $extPath . 'css/image-all.css" />
	<link rel="stylesheet" href="' . $extPath . 'css/image-crop.css" />
	' .  ($this->conf['CSS_FILE']? '<link rel="stylesheet" href="' .  $this->conf['CSS_FILE'] . '" />' : '') . '
	<script type="text/javascript" src="' . $extPath . 'js/fdfx_error.js"></script>
	<script type="text/javascript" src="' . $extPath . 'js/xp-info-pane.js"></script>
	<script type="text/javascript" src="' . $extPath . 'js/ajax.js"></script>
	<script type="text/javascript">
	var crop_script_server_file ="' . '../../../../' . t3lib_extMgm::extRelPath ( self::$extKey ) . 'cm1/class.tx_fdfxbeimage_image.php";

	var cropToolBorderWidth = 1;	// Width of dotted border around crop rectangle
	var smallSquareWidth = 7;	// Size of small squares used to resize crop rectangle

	// Size of image shown in crop tool
	var crop_imageWidth = ' . $width . ';
	var crop_imageHeight = ' . $height . ';

	// Size of original image
	var crop_originalImageWidth = ' . $imgInfo [0] . ';
	var crop_originalImageHeight =' . $imgInfo [1] . ';

	var crop_minimumPercent = 10;	// Minimum percent - resize
	var crop_maximumPercent = 200;	// Maximum percent -resize


	var crop_minimumWidthHeight = 15;	// Minimum width and height of crop area

	var updateFormValuesAsYouDrag = true;	// This variable indicates if form values should be updated as we drag. This process could make the script work a little bit slow. That is why this option is set as a variable.
	if(!document.all)updateFormValuesAsYouDrag = false;	// Enable this feature only in IE

	/* End of variables you could modify */
	function setCHash(chash)
	{
		md5Hash=chash;
	}
	/* Resize for popup */
	function resizeWinTo() {
		if (window.opener) {
			var oH = crop_imageHeight + 200, oW = crop_imageWidth +300;
			if ( !oH || window.doneAlready ) { return; }
			var x = window; 
			x.doneAlready = true;
			var scW = screen.availWidth ? screen.availWidth : screen.width;
			var scH = screen.availHeight ? screen.availHeight : screen.height;
			var moveWidth = Math.round((scW-oW)/2), moveHeight = Math.round((scH-oH)/2);
			if( !window.opera ) { x.moveTo(moveWidth,moveHeight); }
			x.resizeTo( oW, oH);
		}
	}
	</script>
	<script type="text/javascript" src="' . $extPath . 'js/image-crop.js"></script>
	<script type="text/javascript">
	extensionPath="' . $BACK_PATH . t3lib_extMgm::extRelPath ( self::$extKey ) . 'res/crop-image/";
	</script>
';
		return $content;
	}
}

if (defined ( 'TYPO3_MODE' ) && $TYPO3_CONF_VARS [TYPO3_MODE] ['XCLASS'] ['ext/fdfx_be_image/lib/class.tx_fdfxbeimage_image_crop.php']) {
	include_once ($TYPO3_CONF_VARS [TYPO3_MODE] ['XCLASS'] ['ext/fdfx_be_image/lib/class.tx_fdfxbeimage_image_crop.php']);
}
?>