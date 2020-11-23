<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../model/dbutil/Conn.class.php');
require_once('../model/dao/AjusteDataHoraDAO.class.php');
/**
 * Description of CabPesDAO
 *
 * @author anderson
 */
class CabecPesDAO extends Conn {
    //put your code here
    
    public function verifCabec($cabec, $base) {

        $select = " SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " PPA_CABEC "
                    . " WHERE "
                        . " DTHR_INICIAL_CEL = TO_DATE('" . $cabec->dthrInicialCabPes . "','DD/MM/YYYY HH24:MI')"
                        . " AND "
                        . " MATRIC_FUNC = " . $cabec->matricFuncCabPes
                        . " AND "
                        . " PLACA_VEIC LIKE '" . $cabec->placaVeicCabPes . "'";

        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $qtde = $item['QTDE'];
        }

        return $qtde;
    }

    public function idCabec($cabec, $base) {

        $select = " SELECT "
                    . " ID AS ID "
                . " FROM "
                    . " PPA_CABEC "
                . " WHERE "
                    . " DTHR_INICIAL_CEL = TO_DATE('" . $cabec->dthrInicialCabPes . "','DD/MM/YYYY HH24:MI')"
                    . " AND "
                    . " MATRIC_FUNC = " . $cabec->matricFuncCabPes
                    . " AND "
                    . " PLACA_VEIC LIKE '" . $cabec->placaVeicCabPes . "'";

        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $id = $item['ID'];
        }

        return $id;
    }

    public function insCabec($cabec, $base) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        $sql = "INSERT INTO PPA_CABEC ("
                . " MATRIC_FUNC "
                . " , EQUIP_ID "
                . " , PLACA_VEIC "
                . " , DTHR_INICIAL "
                . " , DTHR_INICIAL_CEL "
                . " , DTHR_INICIAL_TRANS "
                . " , DTHR_FINAL "
                . " , DTHR_FINAL_CEL "
                . " , DTHR_FINAL_TRANS "
                . " ) "
                . " VALUES ("
                . " " . $cabec->matricFuncCabPes
                . " , " . $cabec->idEquipCabPes
                . " , '" . $cabec->placaVeicCabPes . "'"
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($cabec->dthrInicialCabPes, $base)
                . " , TO_DATE('" . $cabec->dthrInicialCabPes . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($cabec->dthrFinalCabPes, $base)
                . " , TO_DATE('" . $cabec->dthrFinalCabPes . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " ) ";

        $this->Conn = parent::getConn($base);
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }
    
}
