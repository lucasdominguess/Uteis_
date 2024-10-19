<?php
$client = new Client();
$headers = [
  'Content-Type' => 'text/plain'
];
$body = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.smssp.fundacao.br" 
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
';
$request = new Request('POST', 'http://10.10.64.117:8080/smsservices/services/PessoaService?wsdl', $headers, $body);
$res = $client->sendAsync($request)->wait();
echo $res->getBody();
