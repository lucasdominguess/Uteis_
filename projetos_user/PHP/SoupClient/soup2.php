<<?php 
$options = array(
    'login' => 'GETCONNECT',
    'password' => 'GETCONNECT!@#$',
    'sistema' => 'eSAUDESP',
    'soap_version' => SOAP_1_1,
    'trace' => true,
);

$client = new SoapClient('http://10.10.64.117:8080/smsservices/services/PessoaService?wsdl', $options);

$params = array(
    'filtroPesquisaPessoa' => array(
        'dataNascimento' => '1970-08-30T00:00:00.000-03:00',
        'nome' => 'TESTE WS PESSOASERVICE'
    )
);

try {
    $response = $client->__soapCall('pesquisarPorFiltro', array($params));
    echo $client->__getLastResponse();
} catch (SoapFault $fault) {
    echo 'Error: ' . $fault->getMessage();
}
