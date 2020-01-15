<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/VeiculoDAO.class.php');
require_once('../model/dao/NotaFiscalDAO.class.php');
require_once('../model/dao/ItemNotaFiscalDAO.class.php');
/**
 * Description of EquipCTR
 *
 * @author anderson
 */
class VeiculoCTR {
    //put your code here
    
    public function dados($versao) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $veiculoDAO = new VeiculoDAO();

            $veiculoDados = array("dados" => $veiculoDAO->dados());
            $veiculoDadosRet = json_encode($veiculoDados);

            return $veiculoDadosRet;
        
        }
        
    }
    
    public function pesq($versao, $info) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $veiculoDAO = new VeiculoDAO();
            $notaFiscalDAO = new NotaFiscalDAO();
            $itemNotaFiscalDAO = new ItemNotaFiscalDAO();

            $dado = $info['dado'];

            $veiculoDados = array("dados" => $veiculoDAO->pesq($dado));
            $veiculoDadosRet = json_encode($veiculoDados);

            $notaFiscalDados = array("dados" => $notaFiscalDAO->pesq($dado));
            $notaFiscalRet = json_encode($notaFiscalDados);

            $itemNotaFiscalDados = array("dados" => $itemNotaFiscalDAO->pesq($dado));
            $itemNotaFiscalRet = json_encode($itemNotaFiscalDados);
            
            return $veiculoDadosRet . "#" . $notaFiscalRet . "|" . $itemNotaFiscalRet;
        
        }
        
    }
    
    
}
