<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dbutil/OCI.class.php');
/**
 * Description of InserirDados
 *
 * @author anderson
 */
class LogDAO extends OCI {
    //put your code here

    /** @var PDO */
    private $Conn;

    public function salvarDados($dados, $pagina) {

        $this->Conn = parent::getConn();

        $sql = "INSERT INTO DADOS_MOBILE ("
                . " DTHR "
                . " , APLICATIVO "
                . " , PAGINA "
                . " , DADOS "
                . " ) "
                . " VALUES ("
                . " SYSDATE "
                . " , 'PPA' "
                . " , :pagina "
                . " , :dados "
                . " )";

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $sql);
        oci_bind_by_name($stid, ":pagina", $pagina, 30);
        oci_bind_by_name($stid, ":dados", $dados, 32000);
        oci_execute($stid);
        
    }

}
