<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/FuncDAO.class.php');
/**
 * Description of FuncCTR
 *
 * @author anderson
 */
class FuncCTR {
    //put your code here
    
    public function dados($versao) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $funcDAO = new FuncDAO();

            $dadosFunc = array("dados" => $funcDAO->dados());
            $resFunc = json_encode($dadosFunc);

            return $resFunc;
        
        }
        
    }
    
}
