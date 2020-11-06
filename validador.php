<?php

	$cpf = $_POST["cpf"];
	
	if(empty($cpf) || strlen($cpf) < 14){
		echo  "<script>alert('Por favor, digite um CPF válido!');</script>";
		echo "<script>window.location='index.html';</script>";
	}else{
		validarCPF($cpf);
	}


	function validarCPF($cpf){
	$vetor = array(9);
	$cont = 0;
	for($i = 0; $i < 11; $i ++){
		if(preg_match( "/[0-9]/",  $cpf[$i])){
			$vetor[$cont] = $cpf[$i];
			$cont++;
		}
	}
	$d1 = calcularD1($vetor);
	$d2 = calcularD2($vetor, $d1);

	if($d1 == $cpf[12] && $d2 == $cpf[13]){
		include("resultadovalido.html");
	}else{
		include("resultadoinvalido.html");
	}
	}

	function calcularD1($vetor){
		$soma = 0;
		foreach ($vetor as $chave => $value) {
			$soma += $value * ($chave + 1);
		}
		$d1 = $soma % 11;

		if($d1 === 10){
			$d1 = 0;
		}
		return $d1;
	}

	function calcularD2($vetor, $d1){
		$soma = 0;
		foreach ($vetor as $chave => $value) {
			$soma += $value * ($chave);
		}
		$soma += $d1 * 9;
		$d2 = $soma % 11;

		if($d2 === 10){
			$d2 = 0;
		}
		return $d2;
	}
?>