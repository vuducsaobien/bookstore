<?php require_once PATH_SCRIPT . 'PhpThumb' . DS . 'ThumbLib.inc.php';

class Upload{
	
	public function uploadFile($fileObj, $folderUpload, $width = 60, $height = 90,$options = null){
		if($options == null){
			if($fileObj['tmp_name'] != null){
				$uploadDir		= PATH_UPLOAD . $folderUpload . DS;
				
				$fileName		= $this->randomString(8) . '.' . pathinfo($fileObj['name'], PATHINFO_EXTENSION);				
				
				// Big Picture
				@copy($fileObj['tmp_name'], $uploadDir . $fileName);
				$thumb = PhpThumbFactory::create($uploadDir . $fileName);
				$thumb->adaptiveResize($width, $height);
				$prefix	= $width . 'x' . $height . '-';

				// 60 x 90 picture
				$thumb->save($uploadDir . $prefix . $fileName); 
			}	
		}
		return $fileName;
	}
	
	public function removeFile($folderUpload, $fileName){
		$fileName	= PATH_UPLOAD . $folderUpload . DS . $fileName;
		@unlink($fileName);
	}
	
	// Random filename Picture after Upload
	private function randomString($length = 5){
	
		$arrCharacter = array_merge(range('a','z'), range(0,9));
		$arrCharacter = implode('', $arrCharacter);
		$arrCharacter = str_shuffle($arrCharacter);
	
		$result		  = substr($arrCharacter, 0, $length);
		return $result;
	}
}