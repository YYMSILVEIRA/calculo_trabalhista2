<?php

require_once("funcoes.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$salario_base = 0;
	$valor_insalubridade = 0;
	$valor_periculosidade = 0;
	$valor_hora_extra_50 = 0;
	$valor_hora_extra_100 = 0;
	$vlr_aviso_previo = 0;
	
	
	
	
    $salario_base = floatval($_POST['salario_base']);
    $insalubridade = floatval($_POST['insalubridade']);
    $periculosidade = isset($_POST['periculosidade']) ? 0.3 : 0;
    $hora_extra_50 = floatval($_POST['hora_extra_50']);
    $hora_extra_100 = floatval($_POST['hora_extra_100']);
    $anos_trabalhados = intval($_POST['anos_trabalhados']);
    
    $valor_insalubridade = $salario_base * ($insalubridade / 100);
    $valor_periculosidade = $salario_base * $periculosidade;
    $valor_hora = $salario_base / 220;
    $valor_hora_extra_50 = $hora_extra_50 * ($valor_hora * 1.5);
    $valor_hora_extra_100 = $hora_extra_100 * ($valor_hora * 2);
    $aviso_previo = 30 + ($anos_trabalhados * 3);
    $vlr_aviso_previo = (($salario_base)/30)*$aviso_previo;
    $total = $salario_base + $valor_insalubridade + $valor_periculosidade + $valor_hora_extra_50 + $valor_hora_extra_100+$vlr_aviso_previo;
}


Abrir_HtmlHeader(); /* Cabeçalho da página html */

	Abrir_Container(); /* Abrir Conteiner Dos dados */
		Titulo(txtTitulo: $nameApp);
		img(caminhoImagem: "LogotipoDireito.png", txtAlternativo: 'Logotipo da advocacia', parametros: ' width="120px" ');
		
		Abrir_Formulario();
			InputNumero(nomeEntrada: "salario_base", txtAmostra: 'Informe o salário bruto', prefixo: 'R$', sufixo: ',00', txtAcessibilidade: 'Adicione o salário bruto neste campo');

				/* Array assotiativo que define os tipos de insalubridade */
				$arrAsInsalubridade = [
											[
												'vlr' => '1', 
												'txt' => 'Mínimo (10%)'
											],
											[
												'vlr' => '2', 
												'txt' => 'Mínimo (20%)'
											],
											[
												'vlr' => '3', 
												'txt' => 'Mínimo (40%)'
											]
									  ];
				/* Array assotiativo que define os tipos de insalubridade */

				SelecionarItem(txtTitulo: 'Grau de Insalubridade', nomeObjeto: 'insalubridade', txtPadrao: 'Nenhum', arrAssotiativo: $arrAsInsalubridade);
			
			CheckBtnSwt(nomeCheckBtn: 'periculosidade', txtCheckBtn: 'Periculosidade (30%)');
			
			InputNumero(nomeEntrada: "hora_extra_50", prefixo: 'Horas Extras (50%)', txtAcessibilidade: 'Adicione as horas extras 50%, neste campo');

			InputNumero(nomeEntrada: "hora_extra_100", prefixo: 'Horas Extras (100%)', txtAcessibilidade: 'Adicione as horas extras 100%, neste campo');

			InputNumero(nomeEntrada: "anos_trabalhados", prefixo: 'Anos Trabalhados');

			Btn(txtBtn: "<b>Calcular</b>");
		
		Fechar_Formulario();

		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			Abrir_DivResultados();
				Titulo(txtTitulo: 'Resultados', nroTitulo: '4');
					ImprimirMonetario(txtTitulo: "Salário Base:", vlr: $salario_base);
					ImprimirMonetario(txtTitulo: "Insalubridade:", vlr: $valor_insalubridade);
					ImprimirMonetario(txtTitulo: "Periculosidade:", vlr: $valor_periculosidade);
					ImprimirMonetario(txtTitulo: "Hora Extra 50%:", vlr: $valor_hora_extra_50);
					ImprimirMonetario(txtTitulo: "Hora Extra 100%:", vlr: $valor_hora_extra_100);
					ImprimirTxt(txtTitulo: "Aviso Prévio:", txt: $valor_insalubridade);
					ImprimirMonetario(txtTitulo: "Vlr Aviso Prévio:", vlr: $vlr_aviso_previo);
					ImprimirMonetario(txtTitulo: "Total a Receber:", vlr: $total);
			Fechar_DivResultados();
		}

	Fechar_Container();	
	Rodape();
Fechar_HtmlHeader();

?>

