<?php
require_once File::build_path(array("model","model.php"));
class ModelTypes extends model {
	private $type;
	private $path;
	protected static $object = "types";
	protected static $primary='type';

	public function getType() {
		return $this->type;
	}

	public function getPath() {
		return $this->path;
	}
}
?>