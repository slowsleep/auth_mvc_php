<?php

class DB
{
    public static function connect($pathToFile = null)
    {
        if ($pathToFile) {
            $dsn = "sqlite:$pathToFile";
        } else {
            $dsn = "sqlite:app/db/db.sqlite";
        }
        $db = new PDO($dsn);

        return $db;
    }
}
