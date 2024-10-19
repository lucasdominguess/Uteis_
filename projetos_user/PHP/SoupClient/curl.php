<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://10.10.64.117:8080/smsservices/services/PessoaService?wsdl=null',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.smssp.fundacao.br" 
xmlns:xsd="http://domain.smssp.fundacao.br/xsd">
<soapenv:Header xmlns:ns3="http://auth.smssp.atech.br">
<ns3:login>GETCONNECT</ns3:login>
<ns3:password>GETCONNECT!@#$</ns3:password>
<ns3:sistema>eSAUDESP</ns3:sistema>
</soapenv:Header>
 <soapenv:Body>
 <ser:pesquisarPorFiltro>
 <!--Optional:-->
 <ser:filtroPesquisaPessoa>
 <!--Optional:-->
 <xsd:dataNascimento>1970-08-30T00:00:00.000-03:00</xsd:dataNascimento> 
 <!--Optional:-->
 <xsd:nome>TESTE WS PESSOASERVICE</xsd:nome>
 </ser:filtroPesquisaPessoa>
 </ser:pesquisarPorFiltro>
 </soapenv:Body>
</soapenv:Envelope>
',
CURLOPT_HTTPHEADER => array(
    'Content-Type: text/plain'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;

$response = curl_exec($curl);

curl_close($curl);

// Verifica se a resposta contém "MIMEBoundary" e separa o conteúdo
if (strpos($response, 'MIMEBoundary') !== false) {
    // Divide a resposta em partes, separando pelo boundary
    $parts = preg_split('/--MIMEBoundary_[^\s]+/', $response);
    
    // Procura a parte que contém o XML
    foreach ($parts as $part) {
        if (strpos($part, '<?xml') !== false) {
            $response = trim($part);
            break;
        }
    }
}

echo $response;

