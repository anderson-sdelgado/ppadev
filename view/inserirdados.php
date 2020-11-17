<?php
//var_dump($_POST);

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

require_once('../control/PesagemCTR.class.php');

if (isset($info)):

    $pesagemCTR = new PesagemCTR();
    echo $pesagemCTR->salvarDados($versao, $info, "inserirdados");
    
endif;
