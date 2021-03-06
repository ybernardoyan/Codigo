<?php
    function buscarUsuario($conn,$usuario,$senha){
      $stmt = $conn->prepare("SELECT LOGIN_Funcionario,ID_TipoUsuario FROM funcionario WHERE LOGIN_Funcionario = ?
                                AND SENHA_Funcionario = ?");
      $stmt->bind_param("ss",$usuario,$senha);
      $stmt->execute();
      $resultado = $stmt->get_result();
      return $resultado->fetch_assoc();
    }


  function createFuncionario($conn,$permissao,$cpf,$nome,$rg,$datnas,$uf,$cidade,$bairro,$cep,$numcas,$email,$telefone,$login,$senha){
    $stmt = $conn->prepare("INSERT INTO `karina`.`Funcionario` (`ID_TipoUsuario`, `CPF_Funcionario`, `NOME_Funcionario`, `RG_Funcionario`, `DTNASC_Funcionario`, `UF_Funcionario`,
     `CIDADE_Funcionario`, `BAIRRO_Funcionario`, `CEP_Funcionario`, `NUMEROCASA_Funcionario`, `EMAIL_Funcionario`, `TELEFONE_Funcionario`, `LOGIN_Funcionario`, `SENHA_Funcionario`)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("issssssssissss",$permissao,$cpf,$nome,$rg,$datnas,$uf,$cidade,$bairro,$cep,$numcas,$email,$telefone,$login,$senha);
    $stmt->execute();
  }

  function readFuncionario($conn,$id){
    $sql="SELECT NOME_Funcionario, BAIRRO_Funcionario, CIDADE_Funcionario, EMAIL_Funcionario,CPF_Funcionario,
    DTNASC_Funcionario,RG_Funcionario,CEP_Funcionario, ID_TipoUsuario, NUMEROCASA_Funcionario,UF_Funcionario, TELEFONE_Funcionario, LOGIN_Funcionario, SENHA_Funcionario FROM Funcionario WHERE ID_Funcionario='".$id."'";
    return $conn->query($sql);
  }

  function updateFuncionario($conn,$login,$senha,$nome,$lvlAccess,$rg,$datnas,$cidade,$bairro,$cep,$email,$uf,$telefone,$idFuncionario){
    $stmt = $conn->prepare("UPDATE `karina`.`Funcionario`
    SET `LOGIN_Funcionario` = ?, `SENHA_Funcionario` = ?, `NOME_Funcionario` = ?, `ID_TipoUsuario` = ?, `RG_Funcionario` = ?, `DTNASC_Funcionario` = ?, `CIDADE_Funcionario` = ?,
     `BAIRRO_Funcionario` = ?, `CEP_Funcionario` = ?, `EMAIL_Funcionario` = ?, `UF_Funcionario` = ?, `TELEFONE_Funcionario` = ?
    WHERE `ID_Funcionario` = ?");
    $stmt->bind_param("sssissssssssi",$login,$senha,$nome,$lvlAccess,$rg,$datnas,$cidade,$bairro,$cep,$email,$uf,$telefone,$idFuncionario);
    $stmt->execute();
  }

  function deleteFuncionario($conn,$id){
    $stmt = $conn->prepare("DELETE FROM `karina`.`Funcionario` WHERE `ID_Funcionario` = ?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
  }

  function loginExiste($conn,$login){
    $stmt = $conn->prepare("SELECT LOGIN_Funcionario FROM funcionario WHERE LOGIN_Funcionario = ?");
    $stmt->bind_param("s",$login);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if($resultado->num_rows > 0){
      return true;
    }else{
      return false;
    }
  }
