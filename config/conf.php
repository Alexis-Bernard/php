<?php
class Conf {
	static private $debug = True; 

	static private $databases = array(
		'hostname' => 'webinfo.iutmontp.univ-montp2.fr',
		'database' => 'bernarda',
		'login' => 'bernarda',
		'password' => 'HKdcAKS4LxEtEpG6'

		/*'hostname' => 'localhost',
		'database' => 'test',
		'login' => 'root',
		'password' => ''*/
	);

	static public function getDebug() {
		return self::$debug;
	}

	static public function getLogin() {
		return self::$databases['login'];
	}

	static public function getHostname() {
		return self::$databases['hostname'];
	}

	static public function getDatabase() {
		return self::$databases['database'];
	}

	static public function getPassword() {
		return self::$databases['password'];
	}
}
?>