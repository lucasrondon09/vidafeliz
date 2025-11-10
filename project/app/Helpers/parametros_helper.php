<?php

function getPeriodos($id = null)
{
    $periodos = [
        1 => 'Matutino',
        2 => 'Vespertino',
        3 => 'Noturno'
    ];
    
    if(!empty($id)){
        return $periodos[$id] ?? 'Não encontrado';
    }

    return $periodos;
}


function getGrau($id = null)
{
    $graus = [
                1 => 'Educação Infantil',
                2 => 'Ensino Fundamental',
                3 => 'Ensino Médio',    
                4 => 'Ensino Superior'
            ];
       
    if(!empty($id)){
        return $graus[$id] ?? 'Não encontrado';
    } 

    return $graus;
}   


function dataAtualExtenso(){
    $formatter = new IntlDateFormatter(
        'pt_BR',
        IntlDateFormatter::LONG,
        IntlDateFormatter::NONE,
        'America/Cuiaba',
        IntlDateFormatter::GREGORIAN,
        "d 'de' MMMM 'de' yyyy"
    );
    return $formatter->format(new DateTime());

    

}

function getCategoriaAvaliacaoIndividual($id = null)
{
    
    $categorias = [
        1 => 'Aspectos Físicos',
        2 => 'Aspectos Sociais',
        3 => 'Aspectos Cognitivos',
        4 => 'Habilidades Linguísticas',
        5 => 'Habilidades Matemáticas'
    ];
    
    if(!empty($id)){
        return $categorias[$id] ?? 'Não encontrado';
    }

    return $categorias;
}

function getUfsBrasil()
{
    return [
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins'
    ];
}