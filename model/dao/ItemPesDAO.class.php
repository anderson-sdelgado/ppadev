<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dbutil/OCI.class.php');
require_once('../model/dao/AjusteDataHoraDAO.class.php');
/**
 * Description of ItemPesDAO
 *
 * @author anderson
 */
class ItemPesDAO extends OCI {
    //put your code here
    
    public function verifItem($idCabec, $item) {

        $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " PPA_ITEM "
                . " WHERE "
                . " DTHR_CEL = TO_DATE('" . $item->dthrItemPes . "','DD/MM/YYYY HH24:MI')"
                . " AND "
                . " CABEC_ID = " . $idCabec;

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            foreach ($row as $item) {
                $v = $item[0];
            }
        }

        return $v;
    }
    
    public function insItem($idCabec, $item) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        $sql = "INSERT INTO PPA_ITEM ("
                . " CABEC_ID "
                . " , NRO_NF "
                . " , ITEM_NF "
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
                . " , " . $item->nroNFItemPes
                . " , '" . $item->codItNFItemPes . "'"
                . " , " . $item->valorItemPes
                . " , '" . $item->comentFalhaItemPes . "'"
                . " , " . $item->latitudeItemPes
                . " , " . $item->longitudeItemPes
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($item->dthrItemPes)
                . " , TO_DATE('" . $item->dthrItemPes . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " ) ";

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $sql);
        oci_execute($stid);
    }
    
}
