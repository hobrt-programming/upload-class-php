<?php 



/**
* all right reserved to hobrt
*@author hobrt-programming.com
*@package upload class
*@files upload.php
*/
class up
{
	private $error=array(
	'1' => 'حجم الملف اكبر من المسموح به',
	'2'	=> 'نوع الملف غير مسموح به',
	'3' => 'خطأ في رفع الملف '
	 );
	public $mime ;
	public $file_name;
	public $max_size;
	public $ext;
	public $up_folder;
	public $upl;
	public $url;
	public function upload()
	{
			$err=$_FILES[$this->file_name]['error'];
			$name=$_FILES[$this->file_name]['name'];
			$type=$_FILES[$this->file_name]['type'];
			$size=$_FILES[$this->file_name]['size'];
			$tem_name=$_FILES[$this->file_name]["tmp_name"];
			if($err>0){
				return $this->error['3'];
			}
			else {
				$arr=explode('.', $name);
				$ext=end($arr);
				if($this->ext_test($ext)){
					if($this->mimetype_test($type)){
						if($this->size_test($size)) {
							$this->url=$this->rname($name);
							$test=move_uploaded_file($tem_name, $this->upl.'/'.$this->url);
							if($test){
								return true;
							}
						}
						else {
							return $this->error['1'];
						}
					}
					else {
						return $this->error['2'];
					}
				}
				else {
					return $this->error['2'];
				}
			}
	}
	private function mimetype_test($type){
		if(in_array($type, $this->mime)){
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
	private function ext_test($ext) {
		if(in_array($ext, $this->ext)) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
	private function size_test($size){
		if($size > $this->max_size) {
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
	private function rname($name) {
		$arr=explode('.', $name);
		$ext=end($arr);
		//$arre=array_pop($arr);
		$nm=$this->getkey();
		if(file_exists($this->upl.'/'.$nm)) {
			return $nm.'_'.time().'.'.$ext;
		}
		else {
			return $nm.".".$ext;
		}
	}
	private function getkey()  
 	{
     $alpha = 'ABCDEFGHIJ12KLMNOPQRS67TUVWXY345Zabcdefghijklmn08opqrstuv9wxyz'; 
     global $key ;
     $length = 10; // عدد طول النص
     for($i=0; $i<$length; $i++){
         $ran = rand(0, strlen($alpha)-1);
         $key .= substr($alpha, $ran, 1);
     }   
     return $key;
 	}
}

 ?>
