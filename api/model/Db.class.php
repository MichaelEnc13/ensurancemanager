<?php

class Db
{


    private const USER_LOCAL = "root";
    private const PASS_LOCAL = "";
    private const SERVER_LOCAL = "mysql:hostname=localhost;dbname=seguros";
    private const USER = "u790594714_seguros";
    private const PASS = "DotsellSolPass2022@";
    private const SERVER = "mysql:hostname=localhost;dbname=u790594714_seguros";


    private static function connect()
    {

        if ($_SERVER['REMOTE_ADDR'] == "::1") :

            return new PDO(Db::SERVER_LOCAL, Db::USER_LOCAL, Db::PASS_LOCAL);
        else :
            return new PDO(Db::SERVER, Db::USER, Db::PASS);
        endif;
    }

    public static function queries($query, $values)
    {

        $cmd = Db::connect()->prepare($query);
        $done = $cmd->execute(is_array($values) ? $values : null);
        return array(
            "status" => $done,
            "data" => $cmd,
            "error" => $cmd->errorInfo()

        );
    }
}
