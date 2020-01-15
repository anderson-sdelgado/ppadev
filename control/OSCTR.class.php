<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/OSDAO.class.php');
/**
 * Description of OSCTR
 *
 * @author anderson
 */
class OSCTR {
    //put your code here
    
    public function dados($versao) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $osDAO = new OSDAO();

            $dadosOS = array("dados" => $osDAO->dados());
            $resOS = json_encode($dadosOS);

            return $resOS;
        
        }
        
    }
    
    public function pesq($versao, $info) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $osDAO = new OSDAO();

            $dado = $info['dado'];

            $osDados = array("dados" => $osDAO->pesq($dado));
            $osDadosRet = json_encode($osDados);

            return $osDadosRet;
        
        }
        
    }
    
    
}
