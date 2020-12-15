<?php
require_once File::build_path(array("model","model.php"));
class Modelfarlane extends model {
	private $id;
	private $type;
	private $duree;
	protected static $object = "farlane";
	protected static $primary='id';

	public function getId() {
		return $this->id;
	}

	public function getType() {
		return $this->type;
	}

	public function getDuree() {
		return $this->duree;
	}

    public static function getPath($primary_value){
        $table_name = static::$object;
        $class_name = 'Model' . ucfirst(static::$object);
        $primary_key = static::$primary;

        $sql = "SELECT path
                FROM farlane
                INNER JOIN types ON farlane.type = types.type
                where id=:nom_tag";
        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "nom_tag" => $primary_value,
        );
        $req_prep->execute($values);
        $filename = $req_prep->fetchAll()[0]['path'];
        return "img/" . $filename;
    }
}
?>