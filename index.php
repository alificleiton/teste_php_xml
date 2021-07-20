<?php
  include_once('conexao.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>
    <div class="container">

        <h1 class="titulo">Teste Prático - Alifi Cleiton</h1>

        <form class="formulario" action="registrar.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="arquivo"><br>
            <input type="submit" name="enviar_arquivo">
        </form>

        <?php
            $query = "SELECT * from dados ";                    
            $result= mysqli_query($conexao, $query);
            $linha = mysqli_num_rows($result);
            if($linha == ''){
              echo "<h3> Não foram encontrados dados Cadastrados no Banco!! </h3>";
            }else{
          ?>
                <table class="table">
                    <thead class="text-secondary">
                      <th> Número NF </th>
                      <th> Data</th>
                      <th>CNPJ / CPF</th>
                      <th>Nome</th>
                      <th>Endereço</th>
                      <th>Número</th>
                      <th>Bairro</th>
                      <th>Cidade</th>
                      <th>UF</th>
                      <th>CEP</th>
                      <th>Tel</th>
                      <th>Total</th>                 
                    </thead>
                    <tbody>

                      <?php
                            while($res = mysqli_fetch_array($result)){
                              $nNF = $res["nNF"];
                              $data = $res["data"];
                              $cnpj = $res["cnpj"];
                              $nome = $res["nome"];
                              $endereco = $res["endereco"];
                              $numero = $res["numero"];
                              $bairro = $res["bairro"];
                              $cidade = $res["cidade"];
                              $uf = $res["uf"];
                              $cep = $res["cep"];
                              $tel = $res["tel"];
                              $total = $res["total"];
                      ?>
                        <td> <?php echo $nNF ?> </td>
                        <td> <?php echo $data ?> </td>
                        <td> <?php echo $cnpj ?> </td>
                        <td> <?php echo $nome ?> </td>
                        <td> <?php echo $endereco ?> </td>
                        <td> <?php echo $numero ?> </td>
                        <td> <?php echo $bairro ?> </td>
                        <td> <?php echo $cidade ?> </td>
                        <td> <?php echo $uf ?> </td>
                        <td> <?php echo $cep ?> </td>
                        <td> <?php echo $tel ?> </td>
                        <td> <?php echo $total ?> </td>
                        <tr>

                        <?php } ?>
                    </tbody>
                  </table>
          <?php } ?>       
     </div>

    <?php

        if(@$_GET['var'] === "p" ){
          echo '<script type="text/javascript">';
          echo ' alert("Dados inseridos com Sucesso!!!")'; 
          echo '</script>';
        }

        if(@$_GET['var'] === "np" ){
          echo '<script type="text/javascript">';
          echo ' alert("Campo nProt não está Preenchido")'; 
          echo '</script>';
        }

        if (isset($_GET['var']) && $_GET['var'] == "dnf"){
          echo '<script type="text/javascript">';
          echo ' alert("CNPJ do emitente diferente de 09066241000884")'; 
          echo '</script>';
        }

        if (isset($_GET['var']) && $_GET['var'] == "ext"){
          echo '<script type="text/javascript">';
          echo ' alert("Extensão do arquivo inválida, somente XML")'; 
          echo '</script>';
        }

      ?>
</body>
</html>