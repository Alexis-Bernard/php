<?php
Class GenerateKey{
    private static $possibleChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    public static function generate($length = 16) {

        $key = '';

        for($i = 0; $i < $length; $i ++)
            $key .= self::$possibleChars[mt_rand(0, strlen(self::$possibleChars)-1)];

        return $key;
    }
}
?>