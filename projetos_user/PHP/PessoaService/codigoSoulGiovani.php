<?php 

$soap = new \SoapClient("
http://webdesenv5.prodam/SH0839_BUSCA_SAUDE_WS/BuscaSaudeService.svc?wsdl");
$params = ['Latitude'=>"latitude",'Longitude'=>"longitude"];
$res = $this->soap->ObterUbsReferencia(['objParametros'=>$params]);
echo $res->ObterUbsReferenciaResult->EstabelecimentoVO->CNES;
echo $res->ObterUbsReferenciaResult->EstabelecimentoVO->NomeEstabelecimento;