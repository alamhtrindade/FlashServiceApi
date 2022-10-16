<?php

class ValidaController{
  

  public function retornaDiaSemana($data){
      $diasdasemana = array (1 => "segunda-feira",2 => "terça-feira",3 => "quarta-feira",4 => "quinta-feira",5 => "sexta-feira",6 => "sábado",0 => "domingo");
      $variavel = $data;
      $hoje = getdate(strtotime($variavel));
      $dia = $hoje["mday"];
      $diadasemana = $hoje["wday"];
      $nomediadasemana = $diasdasemana[$diadasemana];
      return $nomediadasemana;
  }

  public function validaDia($data){

    date_default_timezone_set('America/Campo_Grande');
    $timeZone = new DateTimeZone('UTC');

    $hoje =  $hoje = date('d/m/Y');
    $data = str_replace('-','/',$data);

    /** Assumido que $dataEntrada e $dataSaida estao em formato dia/mes/ano */
    $data1 = DateTime::createFromFormat ('d/m/Y', $hoje, $timeZone);
    $data2 = DateTime::createFromFormat ('d/m/Y', $data, $timeZone);

    /** Testa se sao validas */
    if (!($data1 instanceof DateTime)) {
      echo 'Data de entrada invalida!!';
    }

    if (!($data2 instanceof DateTime)) {
      echo 'Data de saida invalida!!';
    }

    /** Compara as datas normalmente com operadores de comparacao < > = e !=*/
    if ($data1 > $data2) {
      return -1;
    }

    if ($data1 < $data2) {
      return 1;
    }

    if($data1 == $data2){
      return 0;
    }
  }
  
  public function retornaHora($ini){
    $inicio;
    switch($ini){
      case "00:00":
        $inicio= 0;
      break;
      case "01:00":
        $inicio = 1;
      break;
      case "02:00":
        $inicio = 2;
      break;
      case "03:00":
        $inicio = 3;
      break;
      case "04:00":
        $inicio = 4;
      break;
      case "05:00":
        $inicio = 5;
      break;
      case "06:00":
        $inicio = 6;
      break;
      case "07:00":
        $inicio = 7;
      break;
      case "08:00":
        $inicio = 8;
      break;
      case "09:00":
        $inicio = 9;
      break;
      case "10:00":
        $inicio = 10;
      break;
      case "11:00":
        $inicio = 11;
      break;
      case "12:00":
        $inicio = 12;
      break;
      case "13:00":
        $inicio = 13;
      break;
      case "14:00":
        $inicio = 14;
      break;
      case "15:00":
        $inicio = 15;
      break;
      case "16:00":
        $inicio = 16;
      break;
      case "17:00":
        $inicio = 17;
      break;
      case "18:00":
        $inicio = 18;
      break;
      case "19:00":
        $inicio = 19;
      break;
      case "20:00":
        $inicio = 20;
      break;
      case "21:00":
        $inicio = 21;
      break;
      case "22:00":
        $inicio = 22;
      break;
      case "23:00":
        $inicio = 23;
      break;
    }
    return $inicio;
  }
}