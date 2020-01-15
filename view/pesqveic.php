<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

require_once('../control/VeiculoCTR.class.php');

if (isset($info)):
    
    $veiculoCTR = new VeiculoCTR();
    echo $veiculoCTR->pesq($versao, $info);

endif;
