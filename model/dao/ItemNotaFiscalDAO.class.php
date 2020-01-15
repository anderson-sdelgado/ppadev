<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../model/dbutil/Conn.class.php');
/**
 * Description of ItemNotaFiscalDAO
 *
 * @author anderson
 */
class ItemNotaFiscalDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                        . " INF.ITNFENT_ID AS \"idItemNF\" "
                        . " , NF.NFENT_ID AS \"idNF\" "
                        . " , INF.CD_PROD AS \"codProd\" "
                    . " FROM " 
                        . " ITNF_ENT INF "
                        . " , NF_ENT NF "
                    . " WHERE "
                        . " NF.RAZAO_SOCIAL LIKE 'ADUBOS VERA CRUZ LTDA' "
                        . " AND "
                        . " NF.DT_HR_LIBER > TO_DATE('12/12/2019', 'DD/MM/YYYY') "
                        . " AND "
                        . " INF.NFENT_ID = NF.NFENT_ID ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
    public function pesq($placa) {

        $select = " SELECT "
                        . " INF.ITNFENT_ID AS \"idItemNF\" "
                        . " , NF.NFENT_ID AS \"idNF\" "
                        . " , INF.CD_PROD AS \"codProd\" "
                    . " FROM " 
                        . " ITNF_ENT INF "
                        . " , NF_ENT NF "
                    . " WHERE "
                        . " NF.RAZAO_SOCIAL LIKE 'ADUBOS VERA CRUZ LTDA' "
                        . " AND "
                        . " NF.DT_HR_LIBER > TO_DATE('12/12/2019', 'DD/MM/YYYY') "
                        . " AND "
                        . " INF.NFENT_ID = NF.NFENT_ID ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
