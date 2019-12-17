<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../model/dbutil/Conn.class.php');
/**
 * Description of OSDAO
 *
 * @author anderson
 */
class OSDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                            . " OS.OS_ID AS \"idOS\" "
                            . " , OS.NRO AS \"nroOS\" "
                        . " FROM "
                            . " ORD_CARREG ODC "
                            . " , EMBAL_PROD EMB "
                            . " , CLASSIF_PROD CLP "
                            . " , DADOS_PROD DAP "
                            . " , PROD PRD "
                            . " , R_VEICULOS_ORDCARREG RVO "
                            . " , VEICULOS VEI "
                            . " , OS_AGRICOLA OSA "
                            . " , OS OS "
                        . " WHERE " 
                            . " ODC.DT_HR_LIBER > TO_DATE('12/12/2019', 'DD/MM/YYYY') "
                            . " AND "
                            . " ODC.OSAGRICOLA_ID IS NOT NULL "
                            . " AND "
                            . " CLIENT_ID IS NULL "
                            . " AND "
                            . " ODC.EMBPROD_ID = EMB.EMBPROD_ID "
                            . " AND "
                            . " EMB.CLASSIFPR_ID = CLP.CLASSIFPR_ID "
                            . " AND "
                            . " CLP.DADOSPROD_ID = DAP.DADOSPROD_ID "
                            . " AND "
                            . " DAP.PROD_ID  = PRD.PROD_ID "
                            . " AND "
                            . " RVO.ORDCARREG_ID = ODC.ORDCARREG_ID "
                            . " AND "
                            . " RVO.VEICULOS_ID = VEI.VEICULOS_ID "
                            . " AND "
                            . " ODC.OSAGRICOLA_ID = OSA.OSAGRICOLA_ID "
                            . " AND "
                            . " OSA.OS_ID = OS.OS_ID "
                        . " GROUP BY "
                            . " OS.OS_ID "
                            . " , OS.NRO ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
