<?php

$nameApp = "Cálculo Trabalhista";
$internalNameApp = "calculo_trabalhista";


function Abrir_HtmlHeader($tituloAdicional="", $estilo="", $script=""){
    global $nameApp;
    echo '<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>'.$nameApp.$tituloAdicional.'</title>
    <style>'.$estilo.'</style>
    <script>'.$script.'</script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
';
}

function Fechar_HtmlHeader(){
    echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            </body></html>';
}

function Rodape(){
    $anoAtual = date('Y');

    echo '<footer class="text-center text-white" style="background-color: #f1f1f1; margin-top:10%;">
    <!-- Copyright -->
    <div class="text-center text-dark p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © '.$anoAtual.' Copyright | Developed by IB2S Softwares:
        <a class="text-dark" href="https://ib2s.xyz/">ib2s.xyz</a>
    </div>
    <!-- Copyright -->
</footer>';
}

function InputNumero($nomeEntrada="", $classe="", $idEntrada="", $prefixo="", $txtAmostra="", $sufixo="", $txtAcessibilidade="", $parametrosExtra=""){
    if ($idEntrada != ""){
        $idEntrada = ' id="'.$idEntrada."' ";
    }
    if ($sufixo!='')
    {
        $sufixo = '<span class="input-group-text">'.$sufixo.'</span>';
    }

    if ($prefixo!= ''){
        $prefixo = '<span class="input-group-text">'.$prefixo.'</span>';
    }

    echo '<div class="input-group mb-3">
		    '.$prefixo.'
		        <input type="number" '.$parametrosExtra.' '.$idEntrada.' class="form-control '.$classe.'" name="'.$nomeEntrada.'" placeholder="'.$txtAmostra.'" aria-label="'.$txtAcessibilidade.'">
		    '.$sufixo.'
		  </div>';
}

function img($caminhoImagem="", $txtAlternativo="", $parametros="", $classe=""){
    echo '<img src="'.$caminhoImagem.'"  '.$parametros.' class="mx-auto d-block img-fluid '.$classe.' " alt="'.$txtAlternativo.'">';
}

function Titulo($txtTitulo="", $classe="", $parametros="", $nroTitulo="2"){
    echo '<h'.$nroTitulo.' class="'.$classe.' text-center" '.$parametros.'>'.$txtTitulo.'</h'.$nroTitulo.'>';
}

function Abrir_Container($tipo="mt-5"){
    echo '<div class="container mt-5">';
}
function Fechar_Container(){
    echo '</div>';
}

function Abrir_Formulario($metodo="POST", $destino=""){
    if ($destino!=''){
        $destino = 'action="'.$destino.'" ';
    }
    
    echo '<form '.$destino.' method="'.$metodo.'" class="mt-4">';
}
function Fechar_Formulario(){
    echo '</form>';
}

function Btn($txtBtn="", $tpBtn="btn-primary", $classe=""){
    echo '<button type="submit" class="btn '.$tpBtn.' '.$classe.' w-100">'.$txtBtn.'</button>';
}

function CheckBtnSwt($nomeCheckBtn="", $txtCheckBtn="", $value="", $estilo=""){
    if ($value != ''){
        $value= ' value="'.$value.'"';
    }
    
    echo '<div class="input-group mb-3">
			<div class="form-check form-switch">
			<input class="form-check-input" type="checkbox" role="switch" name="'.$nomeCheckBtn.'" '.$value.' style="cursor: pointer; '.$estilo.'" id="flexSwitchCheckDefault">
			<label class="form-check-label" for="flexSwitchCheckDefault">'.$txtCheckBtn.'</label>
			</div>
		</div>';
}

function Abrir_DivResultados(){
    echo '<div class="mt-4 p-3 bg-light border rounded">';
}
function Fechar_DivResultados(){
    echo '</div>';
}

function ImprimirMonetario($txtTitulo="", $vlr=0){
    echo '<p><strong>'.$txtTitulo.'</strong> R$ '.number_format($vlr, 2, ',', '.').'</p>';
}
function ImprimirTxt($txtTitulo="", $txt=""){
    echo '<p><strong>'.$txtTitulo.'</strong> '.$txt.'</p>';
}

function SelecionarItem($txtTitulo="", $nomeObjeto = "", $txtPadrao="", $vlrPadrao="", $arrAssotiativo=[]){
    echo '<div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">'.$txtTitulo.'</label>
                <select class="form-select" id="inputGroupSelect01" style="cursor: pointer;" name="'.$nomeObjeto.'">
                    <option selected value="'.$vlrPadrao.'">'.$txtPadrao.'</option>';
    
    foreach ($arrAssotiativo as $item){
        echo '<option value="'.$item['vlr'].'">'.$item['txt'].'</option>';
    }
    
    echo '</select> </div>';
}





?>