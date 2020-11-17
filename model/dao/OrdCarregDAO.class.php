<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../model/dbutil/Conn.class.php');
/**
 * Description of EquipDAO
 *
 * @author anderson
 */
class OrdCarregDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados($base) {

        $select = " SELECT "
                            . " ORDCARREG_ID AS \"idBDOrdCarreg\" "
                            . " , PLACA AS \"placaVeicOrdCarreg\" "
                            . " , NRO_OS AS \"nroOSOrdCarreg\" "
                            . " , PRODUTO_CD AS \"prodOrdCarreg\" "
                        . " FROM "
                            . " V_ORDCARREG_ADUBO ";
        
        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
    public function pesq($placa, $base) {

        $select = " SELECT "
                            . " ORDCARREG_ID AS \"idOrdCarreg\" "
                            . " , PLACA AS \"placaVeicOrdCarreg\" "
                            . " , NRO_OS AS \"nroOSOrdCarreg\" "
                            . " , PRODUTO_CD AS \"prodOrdCarreg\""
                        . " FROM "
                            . " V_ORDCARREG_ADUBO "
                        . " WHERE "
                            . " PLACA LIKE '" . $placa . "'";
        
        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
