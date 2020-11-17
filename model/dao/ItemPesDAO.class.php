<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../model/dbutil/Conn.class.php');
require_once('../model/dao/AjusteDataHoraDAO.class.php');
/**
 * Description of ItemPesDAO
 *
 * @author anderson
 */
class ItemPesDAO extends Conn {
    //put your code here
    
    public function verifItem($idCabec, $item, $base) {

        $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " PPA_ITEM "
                . " WHERE "
                . " DTHR_CEL = TO_DATE('" . $item->dthrItemPes . "','DD/MM/YYYY HH24:MI')"
                . " AND "
                . " CABEC_ID = " . $idCabec;

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
    
    public function insItem($idCabec, $item) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        $sql = "INSERT INTO PPA_ITEM ("
                . " CABEC_ID "
                . " , NRO_OS "
                . " , PRODUTO_CD "
                . " , VALOR_PES"
                . " , COMENT_FALHA "
                . " , LATITUDE "
                . " , LONGITUDE "
                . " , DTHR "
                . " , DTHR_CEL "
                . " , DTHR_TRANS "
                . " ) "
                . " VALUES ("
                . " " . $idCabec
                . " , " . $item->nroOSItemPes
                . " , '" . $item->prodItemPes . "'"
                . " , " . $item->pesoItemPes
                . " , '" . $item->comentFalhaItemPes . "'"
                . " , " . $item->latitudeItemPes
                . " , " . $item->longitudeItemPes
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($item->dthrItemPes)
                . " , TO_DATE('" . $item->dthrItemPes . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " ) ";

        $this->Conn = parent::getConn($base);
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }
    
}
