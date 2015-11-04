<?php
/**
 * Static class for reading config variables from config.ini
 */
class Config {

private static $ini = null;

public static function get($name) {
	self::loadIni();
	return self::$ini[$name];
}

private static function loadIni($fileName = "config.ini") {
	if(is_null(self::$ini)) {
		self::$ini = parse_ini_file($fileName);
	}
}

}#