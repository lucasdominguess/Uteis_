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
  CURLOPT_POSTFIELDS =>'<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.smssp.fundacao.br" xmlns:xsd="http://domain.smssp.fundacao.br/xsd">
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
<xsd:dataNascimento>1993-05-25T00:00:00.000-03:00</xsd:dataNascimento>
<!--Optional:-->
<xsd:nome>lucas joaquim domingues</xsd:nome>
</ser:filtroPesquisaPessoa>
</ser:pesquisarPorFiltro>
</soapenv:Body>
</soapenv:Envelope>',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: text/plain'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;


// Carregar a string XML em um objeto SimpleXMLElement
// $xml = new SimpleXMLElement($response);

// // Remover namespaces para facilitar a manipulação
// $xml->registerXPathNamespace('soapenv', 'http://schemas.xmlsoap.org/soap/envelope/');
// $body = $xml->xpath('//soapenv:Body')[0];

// // Extrair o conteúdo do Body
// $bodyContent = $body->asXML();

// // Exibir o conteúdo extraído
// echo $bodyContent;



// $parts = explode($delimiter, $part);

// Encontrar a parte que contém o XML
// foreach ($parts as $part) {
//     if (strpos($part, "Content-Type: text/xml") !== false) {
//         // Extrair o XML
//         $xmlStart = strpos($part, "<?xml");
//         $xmlEnd = strrpos($part, ">");
//         $xml = substr($part, $xmlStart, $xmlEnd - $xmlStart + 1);

//         // Agora você pode usar o XML com SimpleXMLElement ou processar como precisar
//         $xmlObject = simplexml_load_string($xml);
//         $json = json_encode($xmlObject);
//         $array = json_decode($json, true);

//         // Exibir a estrutura da resposta
//         print_r($array);
//         break;
//     }
// }
