<?php
require_once File::build_path(array("config","conf.php"));
class Model {
	
	public static $pdo;
	
	public static function Init(){
		$hostname = Conf::getHostname();
		$database_name = Conf::getDatabase();
		$login = Conf::getLogin();
		$password = Conf::getPassword();

		try{
			self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e) {
			if (Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
			}
			die();
		}
	}

	public static function selectAll() {
		$table_name = static::$object;
		$class_name = 'Model' . ucfirst(static::$object);

		$rep = Model::$pdo->query("SELECT * FROM $table_name");
		$rep->setFetchMode(PDO::FETCH_CLASS, "$class_name");
		return $rep->fetchAll();
	}

	public static function select($primary_value){
		$table_name = static::$object;
		$class_name = 'Model' . ucfirst(static::$object);
		$primary_key = static::$primary;

		$sql = "SELECT * from $table_name WHERE $primary_key=:nom_tag";
		$req_prep = Model::$pdo->prepare($sql);

		$values = array(
			"nom_tag" => $primary_value,
		);
		$req_prep->execute($values);

		$req_prep->setFetchMode(PDO::FETCH_CLASS, "$class_name");
		$tab = $req_prep->fetchAll();

		if (empty($tab))
			return false;
		return $tab[0];
	}

	public static function delete($primary) {
        try{
            $table_name = static::$object;
            $primary_key = static::$primary;

            $sql = "DELETE from $table_name WHERE $primary_key=:nom_tag";
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "nom_tag" => $primary,
            );
            $req_prep->execute($values);
            return true;
        }
        catch (PDOException $e) {
            if (Conf::getDebug()) echo "Erreur : " . $e->getMessage();
        }
	}

	public static function update($data) {
		$table_name = static::$object;
		$primary_key = static::$primary;
		$set = "";

		foreach ($data as $key => $value) {
			$set = "$set$key=:$key,";
		}
		$set = rtrim($set, ",");

		$sql = "UPDATE $table_name 
		SET $set 
		WHERE $primary_key=:$primary_key";
		$req_prep = Model::$pdo->prepare($sql);

		$req_prep->execute($data);
	}

	public static function save($data) {
		try{
			$table_name = static::$object;
			$into = "";
			$values = "";

			foreach ($data as $key => $value) {
				$into = "$into$key,";
				$values = "$values:$key,";
			}
			$into = rtrim($into, ",");
			$values = rtrim($values, ",");

			$sql = "INSERT INTO $table_name ($into) VALUES ($values)";
			$req_prep = Model::$pdo->prepare($sql);
			$req_prep->execute($data);
			return true;
		}
		catch (PDOException $e) {
			if (Conf::getDebug()) echo "Erreur : " . $e->getMessage();
		}
	}

    public function __construct($data = NULL)  {
        if (!is_null($data)) {
            foreach ($data as $key => $value){
                $this->$key = $value;
            }
        }
    }
}

Model::Init();
?>