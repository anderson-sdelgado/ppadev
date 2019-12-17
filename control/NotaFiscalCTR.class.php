<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/NotaFiscalDAO.class.php');
/**
 * Description of NotaFiscalCTR
 *
 * @author anderson
 */
class NotaFiscalCTR {
    //put your code here
    
    public function dados($versao) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $notaFiscalDAO = new NotaFiscalDAO();

            $dadosNotaFiscal = array("dados" => $notaFiscalDAO->dados());
            $resNotaFiscal = json_encode($dadosNotaFiscal);

            return $resNotaFiscal;
        
        }
        
    }
    
}
