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
        $logDAO->salvarDados($dados, $pagina);
    }
    
    private function salvarCabec($dadosCabec, $dadosItem) {
        $cabecPesDAO = new CabecPesDAO();
        foreach ($dadosCabec as $cabec) {
            $v = $cabecPesDAO->verifCabec($cabec);
            if ($v == 0) {
                $cabecPesDAO->insCabec($cabec);
            }
            $idCabecBD = $cabecPesDAO->idCabec($cabec);
            $idCabec = $cabec->idCabPes;
        }
        $this->salvarItem($idCabecBD, $dadosItem);
        return $idCabec;
    }

    private function salvarItem($idBolBD, $dadosItem) {
        $itemPesDAO = new ItemPesDAO();
        foreach ($dadosItem as $item) {
            $v = $itemPesDAO->verifItem($idBolBD, $item);
            if ($v == 0) {
                $itemPesDAO->insItem($idBolBD, $item);
            }
        }
    }
    
}
