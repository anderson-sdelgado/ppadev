<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);

require_once('../control/NotaFiscalCTR.class.php');

$notaFiscalCTR = new NotaFiscalCTR();

echo $notaFiscalCTR->dados($versao);
