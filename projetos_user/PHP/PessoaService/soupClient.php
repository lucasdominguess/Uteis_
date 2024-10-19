<?php 


// $options = array(
//     'location' => 'http://10.10.64.117:8080/smsservices/services/PessoaService',
//     'uri' => 'http://service.smssp.fundacao.br',
//     'trace' => 1,
//     'exceptions' => 1
// );

// $client = new SoapClient(null, $options);

// $params = [
//     'filtroPesquisaPessoa' => [
//         'dataNascimento' => '1993-05-25T00:00:00.000-03:00',
//         'nome' => 'lucas joaquim domingues'
//     ]
// ];

// try {
//     $response = $client->__soapCall('pesquisarPorFiltro', [$params]);
    
//     // Converte a resposta SOAP para um array
//     $responseArray = json_decode(json_encode($response), true);

//     // Exibe a resposta
//     print_r($responseArray);

// } catch (SoapFault $e) {
//     echo "Erro: " . $e->getMessage();
// }

$soap = new \SoapClient("
http://webdesenv5.prodam/SH0839_BUSCA_SAUDE_WS/BuscaSaudeService.svc?wsdl");
$params = ['Latitude'=>"latitude",'Longitude'=>"longitude"];
$res = $this->soap->ObterUbsReferencia(['objParametros'=>$params]);
echo $res->ObterUbsReferenciaResult->EstabelecimentoVO->CNES;
echo $res->ObterUbsReferenciaResult->EstabelecimentoVO->NomeEstabelecimento;