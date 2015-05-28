<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2012 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class ClubRegMediaHelper extends JObject
{
	
	public static function canUpload(&$file, &$err)
	{
		// Load the com_media language files, default to the admin file and fall back to site if one isn't found
		
		$params = JComponentHelper::getParams('com_media'); 
	
		if (empty($file['name']))
		{
			$err = 'COM_MEDIA_ERROR_UPLOAD_INPUT';
			return false;
		}
	
		jimport('joomla.filesystem.file');
		if ($file['name'] !== JFile::makesafe($file['name']))
		{
			$err = 'COM_MEDIA_ERROR_WARNFILENAME';
			return false;
		}
	
		$format = strtolower(JFile::getExt($file['name']));
	
		$allowable = explode(',', $params->get('upload_extensions'));
		$ignored = explode(',', $params->get('ignore_extensions'));
		if (!in_array($format, $allowable) && !in_array($format, $ignored))
		{
			$err = 'COM_MEDIA_ERROR_WARNFILETYPE';
			return false;
		}
	
		$maxSize = (int) ($params->get('upload_maxsize', 0) * 1024 * 1024);
		if ($maxSize > 0 && (int) $file['size'] > $maxSize)
		{
			$err = 'COM_MEDIA_ERROR_WARNFILETOOLARGE';
			return false;
		}
	
		$user = JFactory::getUser();
		$imginfo = null;
		if ($params->get('restrict_uploads', 1))
		{
			$images = explode(',', $params->get('image_extensions'));
			if (in_array($format, $images)) { // if its an image run it through getimagesize
				// if tmp_name is empty, then the file was bigger than the PHP limit
				if (!empty($file['tmp_name']))
				{
					if (($imginfo = getimagesize($file['tmp_name'])) === false)
					{
						$err = 'COM_MEDIA_ERROR_WARNINVALID_IMG';
						return false;
					}
				} else {
					$err = 'COM_MEDIA_ERROR_WARNFILETOOLARGE';
					return false;
				}
			} elseif (!in_array($format, $ignored))
			{
				// if its not an image...and we're not ignoring it
				$allowed_mime = explode(',', $params->get('upload_mime'));
				$illegal_mime = explode(',', $params->get('upload_mime_illegal'));
				if (function_exists('finfo_open') && $params->get('check_mime', 1))
				{
					// We have fileinfo
					$finfo = finfo_open(FILEINFO_MIME);
					$file["saved_mime"] = $type = finfo_file($finfo, $file['tmp_name']);
					
					if (strlen($type) && !in_array($type, $allowed_mime) && in_array($type, $illegal_mime))
					{
						$err = 'COM_MEDIA_ERROR_WARNINVALID_MIME';
						return false;
					}
					finfo_close($finfo);
				} elseif (function_exists('mime_content_type') && $params->get('check_mime', 1))
				{
					// we have mime magic
					$file["saved_mime"] = $type = mime_content_type($file['tmp_name']);
					if (strlen($type) && !in_array($type, $allowed_mime) && in_array($type, $illegal_mime))
					{
						$err = 'COM_MEDIA_ERROR_WARNINVALID_MIME';
						return false;
					}
				} 
				/*elseif (!$user->authorise('core.manage'))
				{
					$err = 'COM_MEDIA_ERROR_WARNNOTADMIN';
					return false;
				}*/
			}
		}
	
		$xss_check = file_get_contents($file['tmp_name'], false, null, -1, 256);
		$html_tags = array('abbr', 'acronym', 'address', 'applet', 'area', 'audioscope', 'base', 'basefont', 'bdo', 'bgsound', 'big', 'blackface', 'blink', 'blockquote', 'body', 'bq', 'br', 'button', 'caption', 'center', 'cite', 'code', 'col', 'colgroup', 'comment', 'custom', 'dd', 'del', 'dfn', 'dir', 'div', 'dl', 'dt', 'em', 'embed', 'fieldset', 'fn', 'font', 'form', 'frame', 'frameset', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'head', 'hr', 'html', 'iframe', 'ilayer', 'img', 'input', 'ins', 'isindex', 'keygen', 'kbd', 'label', 'layer', 'legend', 'li', 'limittext', 'link', 'listing', 'map', 'marquee', 'menu', 'meta', 'multicol', 'nobr', 'noembed', 'noframes', 'noscript', 'nosmartquotes', 'object', 'ol', 'optgroup', 'option', 'param', 'plaintext', 'pre', 'rt', 'ruby', 's', 'samp', 'script', 'select', 'server', 'shadow', 'sidebar', 'small', 'spacer', 'span', 'strike', 'strong', 'style', 'sub', 'sup', 'table', 'tbody', 'td', 'textarea', 'tfoot', 'th', 'thead', 'title', 'tr', 'tt', 'ul', 'var', 'wbr', 'xml', 'xmp', '!DOCTYPE', '!--');
	
		foreach ($html_tags as $tag)
		{
			// A tag is '<tagname ', so we need to add < and a space or '<tagname>'
			if (stristr($xss_check, '<'.$tag.' ') || stristr($xss_check, '<'.$tag.'>'))
			{
				$err = 'COM_MEDIA_ERROR_WARNIEXSS';
				return false;
			}
		}
		return true;
	}
	function processImg(&$return_object,$debug=FALSE){
		require_once("class.dropshadow.php");
	
		$img_type = '';
		switch($return_object->file_type){
			case '.gif':
				$img_type = 'gif';
				break;
			case '.jpg':
				$img_type = 'jpg';
				break;
			case '.png':
				$img_type = 'png';
				break;
			default:
				$img_type = 'jpg';
				break;
		}
	
		$ds = new dropShadow($debug);
		$ds->loadImage($return_object->file_path);
	
		$d_width = 0;
		$d_height = 0;
		$size = getimagesize($return_object->file_path);
		$ds->final_width = 150;
		$ds->final_height = 150;
	
		$return_object->orginal_width = $size[0];
		$return_object->orginal_height = $size[1];
	
		if(($return_object->orginal_width > $ds->final_width) or ($return_object->orginal_height > $ds->final_height)){
			if($return_object->orginal_width > $return_object->orginal_height ){
				$d_width = $ds->final_width ;
			}else{
				$d_height = $ds->final_height;
			}
		}else{
			$d_height = $return_object->orginal_height;
			$d_width  = $return_object->orginal_width;
		}
	
		$ds->resizeToSize($d_width,$d_height);
		$ds->saveFinal($return_object->thumb_path.$return_object->file_name,$img_type,80);
	}
	/**
	 * $return_object->file_type
	 * $return_object->file_path
	 * $return_object->orginal_width
	 * $return_object->orginal_height
	 * $return_object->file_name
	 * $return_object->thumb_path
	 *
	 * @param unknown_type $return_object
	 * @param unknown_type $debug
	 */
	function resize_image_operation(&$return_object,$debug=FALSE){
	
		require_once("class.dropshadow.php");
	
		$img_type = '';
		switch($return_object->file_type){
			case '.gif':
				$img_type = 'gif';
				break;
			case '.jpg':
				$img_type = 'jpg';
				break;
			case '.png':
				$img_type = 'png';
				break;
			default:
				$img_type = 'jpg';
				break;
		}
	
		$ds = new dropShadow($debug);
		$ds->loadImage($return_object->file_path);
	
		$d_width = 0;
		$d_height = 0;
		$size = getimagesize($return_object->file_path);
		$ds->final_width = $return_object->final_width;
		$ds->final_height = $return_object->final_height;
	
		$return_object->orginal_width = $size[0];
		$return_object->orginal_height = $size[1];
	
		if(($return_object->orginal_width > $ds->final_width) or ($return_object->orginal_height > $ds->final_height)){
			if($return_object->orginal_width > $return_object->orginal_height ){
				$d_width = $ds->final_width ;
			}else{
				$d_height = $ds->final_height;
			}
		}else{
			$d_height = $return_object->orginal_height;
			$d_width  = $return_object->orginal_width;
		}
	
		$ds->resizeToSize($d_width,$d_height);
		$ds->saveFinal($return_object->folder_path.$return_object->file_name,$img_type,80);
	
	}
}