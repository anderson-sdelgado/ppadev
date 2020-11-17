<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/AtualAplicDAO.class.php');
/**
 * Description of AtualAplicativoCTR
 *
 * @author anderson
 */
class AtualAplicCTR {
    //put your code here
    
    private $base = 2;
    
    public function atualAplic($versao, $info) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $atualAplicDAO = new AtualAplicDAO();

            $jsonObj = json_decode($info['dado']);
            $dados = $jsonObj->dados;

            foreach ($dados as $d) {
                $idEquip = $d->idEquip;
                $va = $d->versaoAtual;
            }
            $retorno = 'N';
            $v = $atualAplicDAO->verAtual($idEquip, $this->base);
            if ($v == 0) {
                $atualAplicDAO->insAtual($idEquip, $va, $this->base);
            } else {
                $result = $atualAplicDAO->retAtual($idEquip, $this->base);
                foreach ($result as $item) {
                    $vn = $item[2];
                    $vab = $item[1];
                }
                if (strcmp($va, $vab) <> 0) {
                    $atualAplicDAO->updAtualNova($idEquip, $va, $this->base);
                } else {
                    if (strcmp($va, $vn) <> 0) {
                        $retorno = 'S';
                    }
                }
            }
            $dthr = $atualAplicDAO->dataHora($this->base);
            if ($retorno == 'S') {
                return $retorno;
            } else {
                return $retorno . "#" . $dthr;
            }
        
        }
        
    }
    
}
