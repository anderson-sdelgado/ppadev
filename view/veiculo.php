<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);

require_once('../control/VeiculoCTR.class.php');

$veiculoCTR = new VeiculoCTR();

echo $veiculoCTR->dados($versao);
