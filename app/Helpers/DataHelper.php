<?php

/**
 * Classe de Data
 * @version 1
 * @author Pedro <pero.phnb@gmail.com>
 */

namespace App\Helpers;
//Exemplo - {{ \App\Helpers\CustomHelper::fooBar() }}
class DataHelper {
	public function __construct(){
		
	}
	/**
	 * Método implementado para formatar uma data de acordo
	 * com um formato especificado.
	 *
	 * @param  $date             - a data que será formatada
	 * @param  $format[optional] - o formato em que a data será retornada
	 * @return string
	 * @access public
	 */
	public static function data( $string = 'd/m/Y' ){
		return date($string);
	}
	/**
	 * Método implementado para formatar uma data de acordo
	 * com um formato especificado.
	 *
	 * @param  $date             - a data que será formatada
	 * @param  $format[optional] - o formato em que a data será retornada
	 * @return string
	 * @access public
	 */
	public static function formataData($date, $format = false){
		// formato padrao da aplicação
		$std = 'd/m/Y';
	
		// verifica se há um formato válido para a saída
		if ( $format === false && empty($std) )
			return false;
	
		// transforma a data para o formato timestamp Unix
		if ( ! is_int($date) )
			$date = self::totime($date);
	
		// se não for uma data válida, finaliza
		if ( empty($date) )
			return;
	
		// verifica qual formato será usado
		$format = $format === false ? $std : $format;
		
		return date($format, $date);
	}
	/**
	 * Método implementado para retornar uma
	 * data no formato dateTime.
	 *
	 * @return int
	 * @access public
	 */
	public static function totime($date){
		return (int) strtotime(preg_replace('/[.\/]/', '-', $date));
	}
	/**
	 * Retorna a data atual no formato padrao brasileiro
	 *
	 * @param  none
	 * @return string
	 * @access public
	 */
	public static function dataAtual(){
		return date('d/m/Y');
	}
	/**
	 * Retorna o ano atual
	 *
	 * @param  date
	 * @return string
	 * @access public
	 */
	public static function anoAtual(){
		return date('Y');
	}
	/**
	 * Retorna a data atual no formato padrao brasileiro
	 *
	 * @param  none
	 * @return string
	 * @access public
	 */
	public static function dataHoraAtual($dataHora = 'd/m/Y H:i:s'){
		return date($dataHora);
	}
	/**
	 * Método implementado para verificar se é uma data valida
	 *
	 * @return array
	 * @access public
	 */
	public static function verificaDataValida($data, $format = 'd/m/Y'){
		$d = DateTime::createFromFormat($format, $data);
		return $d && $d->format($format) == $data;
	}
	/**
	 * Método implementado para verificar se é uma data valida no padrao da API
	 *
	 * exemplo : se a data é 22/02/2018 a data a ser passada eh 20180222
	 *
	 * @return array
	 * @access public
	 */
	public static function verificaDataValidaAPi($data, $format = 'd/m/Y'){
		if(strlen($data) == 8)
		{
			$ano = substr($data, 0, -4);
			$mes = substr($data, 4, -2);
			$dia = substr($data, 6);
				
			return checkdate ( $mes , $dia , $ano );
		}
		else
		{
			return false;
		}
	
	}
	
	/**
	 * Método implementado para adicionar uma quantidade de
	 * dias   uma determinada data.
	 *
	 * @param  string  $date    - a data inicial que será somada
	 * @param  int     $dias  - o número de dias que será somado
	 * @param  boolean $format  - indica se o resultado será formatado.
	 */
	public static function subtrairDias($date, $dias, $format = true){
		return $format === true ? date('d/m/Y', self::calculate('-', $date, $dias)) : self::calculate('-', $date, $dias);
	}
	/**
	 * Método implementado para adicionar uma quantidade de
	 * dias   uma determinada data.
	 *
	 * @param  string  $date    - a data inicial que será somada
	 * @param  int     $dias  - o número de dias que será somado
	 * @param  boolean $format  - indica se o resultado será formatado.
	 */
	public static function addDias($date, $dias, $format = true) {
		return $format === true ? date('d/m/Y', self::calculate('+', $date, $dias)) : self::calculate('+', $date, $dias);
	}
	
	/**
	 * Método implementado para fazer um cálculo de subtração
	 * ou soma de dias   uma determinada data.
	 *
	 * @param  string $operator - a operação que será realizada
	 * @param  string $date     - a data que fará parte da operação.
	 * @param  int    $dias    - a quantidade de dias que será calculado.
	 * @return int
	 */
	public static function calculate($operator, $date, $dias){
		// verifica se os parâmetros foram passados corretamente
		if ( empty($date) || empty($dias) )
			return false;
	
		// transforma a data para timestamp
		$date = self::totime($date);
	
		// verifica se houve falha na conversão
		if ( $date === false )
			return false;
	
		if ( $dias <= 1 )
			$day = ' day';
		else
			$day = ' days';
	
		// retorna o resultado em timestamp
		return strtotime($operator.$dias.$day, $date);
	}
	/**
	 * Calcula a diferença de minutos
	 *
	 * @param  string $date_one - a data maior
	 * @param  string $date_two - a data menor
	 * @return int
	 * @access public
	 */
	public static function diferenceMinutos($date_one, $date_two, $horaArredondada = true){
		$diferenca = (self::totime($date_one) - self::totime($date_two));
	
		if($horaArredondada == true)
		{
			return round($diferenca /( 60 * 60));
		}
	
		return $diferenca /( 60 * 60);
	}
	/**
	 * Calcula a idade a partir da data de nascimento 
	 *
	 * @param  string $data_nascimento - data de nascimento
	 * @return string
	 * @access public
	 */
	public static function calcularIdade($data_nascimento){
		//formata a data
		$data_nascimento = self::formataData($data_nascimento);
		
		// Separa em dia, mês e ano
		list($dia, $mes, $ano) = explode('/', $data_nascimento);
		
		// Descobre que dia é hoje e retorna a unix timestamp
		$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		
		// Descobre a unix timestamp da data de nascimento do fulano
		$nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
		
		// Depois apenas fazemos o cálculo já citado :)
		$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
		
		return $idade;
	}
	/**
	 * Método implementado para adicionar uma quantidade de
	 * meses a uma determinada data.
	 *
	 * @param  string  $date    - a data inicial que será somada
	 * @param  int     $number  - o número de dias que será somado
	 * @param  boolean $format  - indica se o resultado será formatado.
	 * @return mixed
	 */
	public static function addAnos($date, $number, $format = true){
		$data = date("d/m/Y",strtotime(date("Y-m-d", strtotime(self::formataData($date, 'Y-m-d'))) . " $number year"));
	
		return $format === true ? $data : $data;
	}
	/**
	 * Método implementado para retornar o dia da
	 * semana de uma determinada data.
	 *
	 * @param  $date[optional] - a data que será avaliada
	 * @return string
	 * @access public
	 */
	public static function weekday($date = false){
		// se não for passado uma data, pegamos a data de hoje
		if ( $date === false )
			$date = date('d-m-Y');
	
		// se não for uma data válida, termina a execução
		if ( ! is_int($date) && ! $date = self::totime($date) )
			return false;
	
		// cria um array para tradução do dia
		$day = array(
				0 => 'domingo',
				1 => 'segunda-feira',
				2 => 'terça-feira',
				3 => 'quarta-feira',
				4 => 'quinta-feira',
				5 => 'sexta-feira',
				6 => 'sábado'
		);
	
		// pega o nome do dia traduzido
		$week = $day[date('w', $date)];
	
		// retorna o dia da semana
		return (string) $week;
	}
	/**
	 * Método implementado para retornar uma data por
	 * extenso, juntamente com o dia da semana.
	 *
	 * @param  string  $date[optional]      - a data que será escrita
	 * @param  boolean $uppercase[optional] - informa se a 1ª letra será maiuscula.
	 * @return string
	 * @access public
	 */
	public static function dataPorExtenso($date = false, $uppercase = true, $weekday = true){
		// verifica o parâmetro passado
		if ( empty($date) )
			$date = date('d-m-Y');
	
		// se não for uma data válida, termina a execução
		if ( ! $date = self::totime($date) )
			return false;
	
		// cria o array para traduzir o numero para nome
		$meses = array(   1 => 'Janeiro'
						, 2 => 'Fevereiro'
						, 3 => 'Março'
						, 4 => 'Abril'
						, 5 => 'Maio'
						, 6 => 'Junho'
						, 7 => 'Julho'
						, 8 => 'Agosto'
						, 9 => 'Setembro'
						, 10=> 'Outubro'
						, 11=> 'Novembro'
						, 12=> 'Dezembro' 
					);
			
		// pega o dia da semana por extenso
		$diaSemana  = self::weekday($date);
		$diaMes     = date('d', $date);
		$nomeMes    = $meses[(int)date('m', $date)];
		$ano        = date('Y', $date);
	
		// retorna a data escrita por extenso
		if ($weekday == true)
			return (string) ( $uppercase === true ? ucfirst($diaSemana) : $diaSemana ) . ', ' . $diaMes . ' de ' . $nomeMes . ' de ' . $ano;
		else
			return (string) $diaMes . ' de ' . $nomeMes . ' de ' . $ano;
	
	}
	/**
	 * Calcula a diferença em dias entre duas datas.
	 *
	 * @param  string $date_one - a data maior
	 * @param  string $date_two - a data menor
	 * @return int
	 * @access public
	 */
	public static function diferenceDias($date_one, $date_two){
		return round((self::totime($date_one) - self::totime($date_two)) / 86400);
	}
}