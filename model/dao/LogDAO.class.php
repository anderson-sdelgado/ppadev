<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../model/dbutil/Conn.class.php');
/**
 * Description of InserirDados
 *
 * @author anderson
 */
class LogDAO extends Conn {
    //put your code here

    /** @var PDO */
    private $Conn;

    public function salvarDados($dados, $pagina, $base) {

        $this->Conn = parent::getConn($base);

        $sql = "INSERT INTO DADOS_MOBILE ("
                . " DTHR "
                . " , APLICATIVO "
                . " , PAGINA "
                . " , DADOS "
                . " ) "
                . " VALUES ("
                . " SYSDATE "
                . " , 'PPA' "
                . " , ? "
                . " , ? "
                . " )";

        $this->Create = $this->Conn->prepare($sql);
        $this->Create->bindParam(1, $pagina, PDO::PARAM_STR, 30);
        $this->Create->bindParam(2, $dados, PDO::PARAM_STR, 32000);
        $this->Create->execute();
        
    }

}
