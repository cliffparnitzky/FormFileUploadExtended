<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2012-2013
 * @author     Cliff Parnitzky
 * @package    FormFileUploadExtended
 * @license    LGPL
 */

/**
 * Class FormFileUploadExtended
 *
 * Provides misc functions to improove form file upload field handling.
 * @copyright  Cliff Parnitzky 2012-2013
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class FormFileUploadExtended extends Controller {
	
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->import('Input');
	}
	
	/**
	 * Get form file upload data from $_SESSION and return it
	 */
	public function getFormFileUploadDataFromSession($strTag) {
		$arrTag = explode('::', $strTag);
		if ($arrTag[0] == "upload" && strlen($arrTag[1]) > 0 && isset($_SESSION['FILE_UPLOAD'][$arrTag[1]])) {
			$arrFileData = $_SESSION['FILE_UPLOAD'][$arrTag[1]];
			
			switch ($arrTag[2]) {
				case 'name' : return $arrFileData['name']; break;
				case 'type' : return $arrFileData['type']; break;
				case 'size' : return $this->getFileSize($arrFileData); break;
				default     : return $arrFileData['tmp_name'];
			}
		}
		return false;
	}
	
	/**
	 * Create a human readable output o the file size
	 */
	private function getFileSize($arrFileData) {
		$size = $arrFileData['size'];
		
		switch (strtolower($arrTag[3])) {
			case 'kb' : $size = $size / 1024; break;
			case 'mb' : $size = $size / 1024 / 1024; break;
			case 'gb' : $size = $size / 1024 / 1024 / 1024; break;
		}
		
		$decimalPlaces = 2;
		if (is_numeric($arrTag[4])) {
			$decimalPlaces = $arrTag[4];
		}
		return round($size, $decimalPlaces);
	}
	
	/**
	 * Add form file upload data to $_SESSION
	 */
	public function addFormFileUploadDataToSession(Widget $objWidget, $intId) {
		if ($objWidget instanceof FormFileUpload) {
			$arrFileData = $_SESSION['FILES'][$objWidget->name];
			$arrFileData['tmp_name'] = str_replace(TL_ROOT . '/', '', $arrFileData['tmp_name']);
			$_SESSION['FILE_UPLOAD'][$objWidget->name]) = $arrFileData;
		}
		return $objWidget;
	}
	
	/**
	 * Check if the form file upload field should be protected (hide it)
	 */
	public function protectFormFileUpload (Widget $objWidget, $strForm, $arrForm) {
		$isEditMode = strlen($this->Input->get("details")) > 0;
		if ($objWidget instanceof FormFileUpload && $isEditMode && $objWidget->fileUploadFrontendEditProtection) {
			return new FormFileUploadEmptyWidget();
		}
		return $objWidget;
	}
} 

?>