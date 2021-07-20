<?php

  //conexao com o banco de dados
    include_once('conexao.php');

  //verifica o post
    if(isset($_POST['enviar_arquivo'])){
    //define o formato do arquivo
      $formatoPermitido = array("xml");
    //pega a extensão do arquivo
      $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
    //verficar o formato do arquivo com a extensão permitida
      if(in_array($extensao , $formatoPermitido)){
        //inserir o arquivo em uma asta temporária
        $temporario = $_FILES['arquivo']['tmp_name'];
        //carregar o arquivo xml
        $arquivo = simplexml_load_file($temporario);
        //verifica se o arquivo começa com "nfeProc"
        if($arquivo->NFe->infNFe){
            //verificar o cnpj se for igual ao número fornecido 9066241000884
            $cnpj = $arquivo->NFe->infNFe->emit->CNPJ;
            if( $cnpj == "9066241000884"){

                  //recuperar os [dados]
                $nNota =  $arquivo->NFe->infNFe->ide->nNF;
                $dataEmi = $arquivo->NFe->infNFe->ide->dhEmi;
                //verificar se possui CNPJ ou CPF
                $cnpj = $arquivo->NFe->infNFe->dest->CNPJ;
                if($cnpj == ""){
                  $cnpj = $arquivo->NFe->infNFe->dest->CPF;
                }
                $nome = $arquivo->NFe->infNFe->dest->xNome;
                $end =  $arquivo->NFe->infNFe->dest->enderDest->xLgr;
                $num = $arquivo->NFe->infNFe->dest->enderDest->nro;
                $bairro =  $arquivo->NFe->infNFe->dest->enderDest->xBairro;
                $cidade =  $arquivo->NFe->infNFe->dest->enderDest->xMun;
                $uf = $arquivo->NFe->infNFe->dest->enderDest->UF;
                $cep = $arquivo->NFe->infNFe->dest->enderDest->CEP;
                $tel = $arquivo->NFe->infNFe->dest->enderDest->fone;
                $total =  $arquivo->NFe->infNFe->total->ICMSTot->vNF;

                //salvar no banco
                $query = "INSERT INTO dados (nNF, data, cnpj, nome	,endereco, numero	,bairro	,cidade, uf	, cep	, tel	,  total
                ) values ('$nNota', '$dataEmi', '$cnpj', '$nome' , '$end', '$num', '$bairro', '$cidade', '$uf', '$cep', '$tel' , '$total')";
                $result = mysqli_query($conexao, $query);
                //header('Location: index.php');

                //verificar se o campo nProt esta preenchido
                $nprot = $arquivo->protNFe->infProt->nProt;
                if( $nprot != "" ){
                      header('Location: index.php?var=p');
                }else{
                      header('Location: index.php?var=np');
                }

            }else{
              //cnpj diferente
              header('Location: index.php?var=dnf');
            }

          //arquivo com que começa com NFe
          }else if($arquivo->infNFe){

            //verificar o cnpj se for igual ao número fornecido 9066241000884
            $cnpj = $arquivo->infNFe->emit->CNPJ;
            if( $cnpj == "9066241000884"){

                  //recuperar os [dados]
                $nNota =  $arquivo->infNFe->ide->nNF;
                $dataEmi = $arquivo->infNFe->ide->dhEmi;
                //verificar se possui CNPJ ou CPF
                $cnpj = $arquivo->infNFe->dest->CNPJ;
                if($cnpj == ""){
                  $cnpj = $arquivo->infNFe->dest->CPF;
                }
                $nome = $arquivo->infNFe->dest->xNome;
                $end =  $arquivo->infNFe->dest->enderDest->xLgr;
                $num = $arquivo->infNFe->dest->enderDest->nro;
                $bairro =  $arquivo->infNFe->dest->enderDest->xBairro;
                $cidade =  $arquivo->infNFe->dest->enderDest->xMun;
                $uf = $arquivo->infNFe->dest->enderDest->UF;
                $cep = $arquivo->infNFe->dest->enderDest->CEP;
                $tel = $arquivo->infNFe->dest->enderDest->fone;
                $total =  $arquivo->infNFe->total->ICMSTot->vNF;

                //salvar no banco
                $query = "INSERT INTO dados (nNF, data, cnpj, nome	,endereco, numero	,bairro	,cidade, uf	, cep	, tel	,  total
                ) values ('$nNota', '$dataEmi', '$cnpj', '$nome' , '$end', '$num', '$bairro', '$cidade', '$uf', '$cep', '$tel' , '$total')";
                $result = mysqli_query($conexao, $query);
                //header('Location: index.php');

                //verificar se o campo nProt esta preenchido
                $nprot = $arquivo->protNFe->infProt->nProt;
                if( $nprot != "" ){
                      header('Location: index.php?var=p');
                }else{
                      header('Location: index.php?var=np');
                }

            }else{
              //cnpj diferente
              header('Location: index.php?var=dnf');
            }
            
          }  
          
      //validar extensão xml
      }else{
        header('Location: index.php?var=ext');
      }
    
    }
?>