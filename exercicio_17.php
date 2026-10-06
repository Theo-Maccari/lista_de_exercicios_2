<?php

function contarCaracteres($texto) {
    return strlen($texto);
}

function contarPalavras($texto) {
    $texto = trim($texto);
    $texto = preg_replace('/\s+/', ' ', $texto);

    if ($texto == '') {
        return 0;
    }

    return count(explode(' ', $texto));
}

function contarFrases($texto) {
    $frases = preg_split('/[.!?]+/', $texto);
    $frases = array_filter($frases);

    return count($frases);
}

function separarPalavras($texto) {
    $texto = strtolower($texto);
    $texto = preg_replace('/[.,!?;:]/', '', $texto);
    $texto = preg_replace('/\s+/', ' ', trim($texto));

    if ($texto == '') {
        return [];
    }

    return explode(' ', $texto);
}

function palavraMaisLonga($palavras) {

    $maior = '';

    foreach ($palavras as $palavra) {
        if (strlen($palavra) > strlen($maior)) {
            $maior = $palavra;
        }
    }

    return $maior;
}

function palavraMaisCurta($palavras) {

    if (count($palavras) == 0) {
        return '';
    }

    $menor = $palavras[0];

    foreach ($palavras as $palavra) {
        if (strlen($palavra) < strlen($menor)) {
            $menor = $palavra;
        }
    }

    return $menor;
}

function contarPalavrasRepetidas($palavras) {

    $contagem = array_count_values($palavras);
    $repetidas = 0;

    foreach ($contagem as $quantidade) {
        if ($quantidade > 1) {
            $repetidas++;
        }
    }

    return $repetidas;
}

function palavrasMaisFrequentes($palavras) {

    $contagem = array_count_values($palavras);

    arsort($contagem);

    return array_slice($contagem, 0, 5, true);
}

function removerEspacosDuplicados($texto) {
    return preg_replace('/\s+/', ' ', trim($texto));
}

function formatarTexto($texto) {
    return ucwords(strtolower(removerEspacosDuplicados($texto)));
}

function processarTexto($texto) {

    $palavras = separarPalavras($texto);

    return [
        "Caracteres" => contarCaracteres($texto),
        "Palavras" => contarPalavras($texto),
        "Frases" => contarFrases($texto),
        "Palavra mais longa" => palavraMaisLonga($palavras),
        "Palavra mais curta" => palavraMaisCurta($palavras),
        "Palavras repetidas" => contarPalavrasRepetidas($palavras),
        "Cinco mais frequentes" => palavrasMaisFrequentes($palavras),
        "Sem espaços duplicados" => removerEspacosDuplicados($texto),
        "Texto formatado" => formatarTexto($texto)
    ];
}


$texto = "o gato correu   muito. O gato correu para casa! O cachorro ficou   em casa.";

$resultado = processarTexto($texto);

echo "Caracteres: " . $resultado["Caracteres"] . "<br>";
echo "Palavras: " . $resultado["Palavras"] . "<br>";
echo "Frases: " . $resultado["Frases"] . "<br>";
echo "Palavra mais longa: " . $resultado["Palavra mais longa"] . "<br>";
echo "Palavra mais curta: " . $resultado["Palavra mais curta"] . "<br>";
echo "Palavras repetidas: " . $resultado["Palavras repetidas"] . "<br>";

echo "Cinco palavras mais frequentes:<br>";

foreach ($resultado["Cinco mais frequentes"] as $palavra => $quantidade) {
    echo $palavra . " (" . $quantidade . " vezes)<br>";
}

echo "Texto sem espaços duplicados: " . $resultado["Sem espaços duplicados"] . "<br>";
echo "Texto formatado: " . $resultado["Texto formatado"];

?>



?>