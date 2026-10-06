<?php
function contarConsultas($agenda) {
    return count($agenda);
}

function contarPacientesDiferentes($agenda) {

    $pacientes = [];

    foreach ($agenda as $consulta) {
        $pacientes[] = $consulta["paciente"];
    }

    return count(array_unique($pacientes));
}

function contarEspecialidades($agenda) {

    $especialidades = [];

    foreach ($agenda as $consulta) {

        $especialidade = $consulta["especialidade"];

        if (isset($especialidades[$especialidade])) {
            $especialidades[$especialidade]++;
        } else {
            $especialidades[$especialidade] = 1;
        }
    }

    return $especialidades;
}

function ordenarHorarios($agenda) {

    usort($agenda, function($a, $b) {
        return strcmp($a["horario"], $b["horario"]);
    });

    return $agenda;
}

function pesquisarPaciente($agenda, $nome) {

    $resultado = [];

    foreach ($agenda as $consulta) {

        if (strtolower($consulta["paciente"]) == strtolower($nome)) {
            $resultado[] = $consulta;
        }
    }

    return $resultado;
}

function primeiroAtendimento($agenda) {

    $agendaOrdenada = ordenarHorarios($agenda);

    return $agendaOrdenada[0];
}

function ultimoAtendimento($agenda) {

    $agendaOrdenada = ordenarHorarios($agenda);

    return $agendaOrdenada[count($agendaOrdenada) - 1];
}

function verificarHorariosDuplicados($agenda) {

    $horarios = [];
    $duplicados = [];

    foreach ($agenda as $consulta) {

        $horario = $consulta["horario"];

        if (isset($horarios[$horario])) {
            $duplicados[] = $horario;
        } else {
            $horarios[$horario] = true;
        }
    }

    return array_unique($duplicados);
}


function organizarAgenda($agenda, $pacientePesquisa) {

    $agendaOrdenada = ordenarHorarios($agenda);

    return [
        "Total de consultas" => contarConsultas($agenda),
        "Pacientes diferentes" => contarPacientesDiferentes($agenda),
        "Consultas por especialidade" => contarEspecialidades($agenda),
        "Primeiro atendimento" => primeiroAtendimento($agenda),
        "Último atendimento" => ultimoAtendimento($agenda),
        "Agenda ordenada" => $agendaOrdenada,
        "Pesquisa paciente" => pesquisarPaciente($agenda, $pacientePesquisa),
        "Horários duplicados" => verificarHorariosDuplicados($agenda)
    ];
}


$agenda = [

    [
        "paciente" => "João",
        "especialidade" => "Cardiologia",
        "data" => "05/10/2026",
        "horario" => "14:00"
    ],

    [
        "paciente" => "Maria",
        "especialidade" => "Dermatologia",
        "data" => "05/10/2026",
        "horario" => "09:00"
    ],

    [
        "paciente" => "Carlos",
        "especialidade" => "Cardiologia",
        "data" => "05/10/2026",
        "horario" => "11:00"
    ],

    [
        "paciente" => "João",
        "especialidade" => "Dermatologia",
        "data" => "05/10/2026",
        "horario" => "16:00"
    ],

    [
        "paciente" => "Ana",
        "especialidade" => "Pediatria",
        "data" => "05/10/2026",
        "horario" => "11:00"
    ]
];


$resultado = organizarAgenda($agenda, "João");

echo "Total de consultas: " . $resultado["Total de consultas"] . "<br>";

echo "Pacientes diferentes: " . $resultado["Pacientes diferentes"] . "<br>";

echo "<br>Consultas por especialidade:<br>";

foreach ($resultado["Consultas por especialidade"] as $especialidade => $quantidade) {
    echo $especialidade . ": " . $quantidade . "<br>";
}


echo "<br>Primeiro atendimento:<br>";
print_r($resultado["Primeiro atendimento"]);

echo "<br><br>Último atendimento:<br>";
print_r($resultado["Último atendimento"]);


echo "<br><br>Agenda ordenada:<br>";

foreach ($resultado["Agenda ordenada"] as $consulta) {
    echo $consulta["horario"] . " - "
       . $consulta["paciente"] . " - "
       . $consulta["especialidade"] . "<br>";
}


echo "<br>Pesquisa por paciente:<br>";

foreach ($resultado["Pesquisa paciente"] as $consulta) {
    echo $consulta["paciente"] . " - "
       . $consulta["especialidade"] . " - "
       . $consulta["data"] . " - "
       . $consulta["horario"] . "<br>";
}


echo "<br>Horários duplicados:<br>";

if (count($resultado["Horários duplicados"]) == 0) {
    echo "Nenhum horário duplicado.";
} else {
    foreach ($resultado["Horários duplicados"] as $horario) {
        echo $horario . "<br>";
    }
}

?>