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
class EquipDAO extends Conn {
    //put your code here
    
    public function dados($base) {

        $select = " SELECT "
                    . " E.EQUIP_ID AS \"idEquip\" "
                    . " , E.NRO_EQUIP AS \"nroEquip\" "
                    . " , E.CLASSOPER_CD AS \"codClasseEquip\" "
                    . " , CARACTER(E.CLASSOPER_DESCR) AS \"descrClasseEquip\" "
                . " FROM "
                    . " V_EQUIP E ";
        
        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
