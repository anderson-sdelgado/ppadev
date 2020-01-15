<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../model/dbutil/Conn.class.php');
/**
 * Description of NotaFiscalDAO
 *
 * @author anderson
 */
class NotaFiscalDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                        . " NF.NFENT_ID AS \"idNF\" "
                        . " , NF.NRO AS \"nroNF\" "
                    . " FROM "
                        . "NF_ENT NF "
                    . " WHERE " 
                        . " NF.RAZAO_SOCIAL LIKE 'ADUBOS VERA CRUZ LTDA' "
                        . " AND "
                        . " NF.DT_HR_LIBER > TO_DATE('12/12/2019', 'DD/MM/YYYY') "
                    . " ORDER BY "
                        . " NF.NFENT_ID "
                    . " DESC ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
    public function pesq($placa) {

        $select = " SELECT "
                        . " NF.NFENT_ID AS \"idNF\" "
                        . " , NF.NRO AS \"nroNF\" "
                    . " FROM "
                        . "NF_ENT NF "
                    . " WHERE " 
                        . " NF.RAZAO_SOCIAL LIKE 'ADUBOS VERA CRUZ LTDA' "
                        . " AND "
                        . " NF.DT_HR_LIBER > TO_DATE('12/12/2019', 'DD/MM/YYYY') "
                    . " ORDER BY "
                        . " NF.NFENT_ID "
                    . " DESC ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
