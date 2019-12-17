<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/ItemNotaFiscalDAO.class.php');
/**
 * Description of ItemNotaFiscal
 *
 * @author anderson
 */
class ItemNotaFiscalCTR {
    //put your code here
    
    public function dados($versao) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $itemNotaFiscalDAO = new ItemNotaFiscalDAO();

            $dadosItemNotaFiscal = array("dados" => $itemNotaFiscalDAO->dados());
            $resItemNotaFiscal = json_encode($dadosItemNotaFiscal);

            return $resItemNotaFiscal;
        
        }
        
    }
    
}
