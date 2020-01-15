<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dbutil/OCI.class.php');
require_once('../model/dao/AjusteDataHoraDAO.class.php');
/**
 * Description of CabPesDAO
 *
 * @author anderson
 */
class CabecPesDAO extends OCI {
    //put your code here
    
    public function verifCabec($cabec) {

        $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " PPA_CABEC "
                . " WHERE "
                . " DTHR_CEL = TO_DATE('" . $cabec->dthrCabPes . "','DD/MM/YYYY HH24:MI')"
                . " AND "
                . " MATRIC_FUNC = " . $cabec->matricFuncCabPes
                . " AND "
                . " PLACA_VEIC LIKE '" . $cabec->placaVeicCabPes . "'";

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

    public function idCabec($cabec) {

        $select = " SELECT "
                . " ID AS ID "
                . " FROM "
                . " PPA_CABEC "
                . " WHERE "
                . " DTHR_CEL = TO_DATE('" . $cabec->dthrCabPes . "','DD/MM/YYYY HH24:MI')"
                . " AND "
                . " MATRIC_FUNC = " . $cabec->matricFuncCabPes
                . " AND "
                . " PLACA_VEIC LIKE '" . $cabec->placaVeicCabPes . "'";

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            foreach ($row as $item) {
                $id = $item[0];
            }
        }

        return $id;
    }

    public function insCabec($cabec) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        $sql = "INSERT INTO PPA_CABEC ("
                . " MATRIC_FUNC "
                . " , PLACA_VEIC "
                . " , FOTO "
                . " , DTHR "
                . " , DTHR_CEL "
                . " , DTHR_TRANS "
                . " ) "
                . " VALUES ("
                . " " . $cabec->matricFuncCabPes
                . " , '" . $cabec->placaVeicCabPes . "'"
                . " , empty_blob() "
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($cabec->dthrCabPes)
                . " , TO_DATE('" . $cabec->dthrCabPes . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " ) RETURNING foto INTO :foto";

        $this->OCI = parent::getConn();
//        echo($sql);
        $result = oci_parse($this->OCI, $sql);
        $blob = oci_new_descriptor($this->OCI, OCI_D_LOB);
        oci_bind_by_name($result, ":foto", $blob, -1, OCI_B_BLOB);
        oci_execute($result, OCI_DEFAULT) or die ("Unable to execute query");

        if(!$blob->save(base64_decode($cabec->fotoCabPes))) {
            oci_rollback($this->OCI);
        }
        else {
            oci_commit($this->OCI);
        }

        oci_free_statement($result);
        $blob->free();
    }
    
}
