<?php

$host = 'localhost';
$dbname = 'cad_aniversarios';
$user = 'postgres';
$password = '641700';
$port = '5432'; 


function insert($db, string $table, array $dados = []) 
{
    $keys = array_keys($dados);
    $colunas = implode(',', $keys);
    $valores = implode(',', array_map(fn($e) => ":{$e}", $keys));
    $cmd = "INSERT INTO {$table} ($colunas) VALUES ($valores)";
    $stmt = $db->prepare($cmd);
  
    foreach ($dados as $key => $value) {
        $stmt->bindValue(":{$key}", $value);
    }

    $stmt->execute(); 
    return $stmt;
}

try {
   
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  
    $csvFile = 'norm_aniversarios.csv';

    // Abrindo o arquivo CSV
    if (($handle = fopen($csvFile, 'r')) !== FALSE) {
        // Lê o cabeçalho do arquivo CSV
        $header = fgetcsv($handle, 1000, ';');

        // Itera sobre as linhas restantes do arquivo
        while (($data = fgetcsv($handle, 1000, ';')) !== FALSE) {

            // $y = str_replace(';',',',$header);
            // $z = str_replace(';',',',$data);

            // print_r($z);
            // Mapeia o conteúdo de $data com os nomes das colunas do cabeçalho
            // $row = array_combine($header, $data);
            // $r= implode(',',$row);
            // die();
            // Chama a função insert para inserir os dados no banco
           
            // Preparando a consulta SQL para inserção no banco de dados
            $stmt = $pdo->prepare("INSERT INTO aniversarios($header[0], $header[1], $header[2]) VALUES (:valor1, :valor2, :valor3)");

            // Bind dos valores (substituindo pelos valores reais do CSV)
            $stmt->bindValue(':valor1', $data[0], PDO::PARAM_STR);
            $stmt->bindValue(':valor2', $data[1], PDO::PARAM_STR);
            $stmt->bindValue(':valor3', $data[2], PDO::PARAM_STR);
            // $stmt->bindValue(':valor1', $row[$header[0]], PDO::PARAM_STR);
            // $stmt->bindValue(':valor2', $row[$header[1]], PDO::PARAM_STR);
            // $stmt->bindValue(':valor3', $row[$header[2]], PDO::PARAM_STR);

            // Executa a inserção
            $stmt->execute();
        //     [$a,$b,$c] = explode(';',$r);
           
            // print_r($row);
        //     // print_r($b);
        //     // print_r($c);
            // sleep(2);
        }

        fclose($handle);
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao abrir o arquivo CSV.";
    }
} catch (PDOException $e) {
    echo "Erro ao inserir dados: " . $e->getMessage();
}
