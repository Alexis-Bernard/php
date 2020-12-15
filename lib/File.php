<?php 
Class File{
	public static function build_path($path_array) {
		return __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . join(DIRECTORY_SEPARATOR , $path_array);
	}
}
?>