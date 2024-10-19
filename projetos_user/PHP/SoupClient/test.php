<?php

$options = array(
    'location' => 'http://10.10.64.117:8080/smsservices/services/PessoaService?wsdl=null',
    'uri' => 'http://service.smssp.fundacao.br',
    'trace' => 1,
    'exceptions' => 1
);

$client = new \SoapClient(null, $options);
// var_dump($client) ;

$header = new \SoapHeader(
    'http://auth.smssp.atech.br',
    'login',
    'GETCONNECT'
);

$headerPassword = new \SoapHeader(
    'http://auth.smssp.atech.br',
    'password',
    'GETCONNECT!@#$'
);

$headerSistema = new \SoapHeader(
    'http://auth.smssp.atech.br',
    'sistema',
    'eSAUDESP'
);

$client->__setSoapHeaders([$header, $headerPassword, $headerSistema]);

$params = [
    'filtroPesquisaPessoa' => [
        'dataNascimento' => '1970-08-30T00:00:00.000-03:00',
        'nome' => 'TESTE WS PESSOASERVICE',
    ],
];

try {
    $response = $client->__soapCall('pesquisarPorFiltro', [$params]);
    print_r($response);
} catch (\SoapFault $fault) {
    echo "Erro: {$fault->getMessage()}";
}

