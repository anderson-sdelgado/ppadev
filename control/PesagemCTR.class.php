<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/LogDAO.class.php');
require_once('../model/dao/CabecPesDAO.class.php');
require_once('../model/dao/ItemPesDAO.class.php');
/**
 * Description of PesagemCTR
 *
 * @author anderson
 */
class PesagemCTR {
    
    private $base = 2;
    
    public function salvarDados($versao, $info, $pagina) {

        $cabec = $info['cabec'];
        $item = $info['item'];
        $pagina = $pagina . '-' . $versao;
        $dados = $cabec . $item;
        $this->salvarLog($dados, $pagina);

        $versao = str_replace("_", ".", $versao);

        if ($versao >= 1.00) {

            $item = mb_convert_encoding($item,"UTF-8","auto");

            $jsonObjCabec = json_decode($cabec);
            $jsonObjItem = json_decode($item);
            
            $dadosCabec = $jsonObjCabec->cabec;
            $dadosItem = $jsonObjItem->item;

            return $this->salvarCabec($dadosCabec, $dadosItem);
            
        }
    }

    private function salvarLog($dados, $pagina) {
        $logDAO = new LogDAO();
        $logDAO->salvarDados($dados, $pagina, $this->base);
    }
    
    private function salvarCabec($dadosCabec, $dadosItem) {
        $cabecPesDAO = new CabecPesDAO();
        $idCabecArray = array();
        foreach ($dadosCabec as $cabec) {
            $v = $cabecPesDAO->verifCabec($cabec, $this->base);
            if ($v == 0) {
                $cabecPesDAO->insCabec($cabec, $this->base);
            }
            $idCabecBD = $cabecPesDAO->idCabec($cabec, $this->base);
            $idCabecArray[] = array("idCabPes" => $cabec->idCabPes);
            $this->salvarItem($idCabecBD, $dadosItem);
        }
        $dadoCabec = array("cabec"=>$idCabecArray);
        $retCabec = json_encode($dadoCabec);
        return 'GRAVOU_' . $retCabec;
    }

    private function salvarItem($idBolBD, $dadosItem) {
        $itemPesDAO = new ItemPesDAO();
        foreach ($dadosItem as $item) {
            $v = $itemPesDAO->verifItem($idBolBD, $item, $this->base);
            if ($v == 0) {
                $itemPesDAO->insItem($idBolBD, $item, $this->base);
            }
        }
    }
    
}
