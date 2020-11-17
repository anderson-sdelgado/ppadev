<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/EquipDAO.class.php');
require_once('../model/dao/FuncDAO.class.php');
require_once('../model/dao/OrdCarregDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {
    //put your code here
    
    private $base = 2;
    
    public function dadosEquip($versao) {
        
        $versao = str_replace("_", ".", $versao);
       
        if($versao >= 1.00){
            
            $equipDAO = new EquipDAO();
        
            $dados = array("dados"=>$equipDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosFunc($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $funcDAO = new FuncDAO();

            $dadosFunc = array("dados" => $funcDAO->dados($this->base));
            $resFunc = json_encode($dadosFunc);

            return $resFunc;
        
        }
        
    }
    
    public function dadosOrdCarreg($versao) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $ordCarregDAO = new OrdCarregDAO();

            $ordCarregDados = array("dados" => $ordCarregDAO->dados($this->base));
            $ordCarregDadosRet = json_encode($ordCarregDados);
            
            return $ordCarregDadosRet;
        
        }
        
    }
    
    public function pesqOrdCarreg($versao, $info) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $ordCarregDAO = new OrdCarregDAO();

            $dado = $info['dado'];

            $ordCarregDados = array("dados" => $ordCarregDAO->pesq($dado, $this->base));
            $ordCarregDadosRet = json_encode($ordCarregDados);
            
            return $ordCarregDadosRet;
        
        }
        
    }
    
}
