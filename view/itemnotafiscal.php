<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);

require_once('../control/ItemNotaFiscalCTR.class.php');

$itemNotaFiscalCTR = new ItemNotaFiscalCTR();

echo $itemNotaFiscalCTR->dados($versao);
