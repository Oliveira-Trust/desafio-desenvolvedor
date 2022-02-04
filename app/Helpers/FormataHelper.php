<?php

/**
 * Classe de utilidades para o sistema
 * @version 1
 * @author Pedro <pero.phnb@gmail.com>
 */

namespace App\Helpers;
//Exemplo - {{ \App\Helpers\CustomHelper::fooBar() }}


class FormataHelper {

    /**
	 * Transforma o numero em float
	 * 
	 * 
	 * @param unknown $num
	 * @return number
	 */
	public static function tofloat($num){
		$dotPos = strrpos($num, '.');
		$commaPos = strrpos($num, ',');
		$sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
		((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);
		if (!$sep) 
		{
			return floatval(preg_replace("/[^0-9]/", "", $num));
		}
		return floatval(
				preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
				preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
		);
    }
    /**
	 * Formata um número de acordo com o padrão
	 * monetário estabelecido.
	 *
	 * @param  $number             - o numero que será formatado
	 * @param  $decimals[optional] - quantas casas decimais terá
	 * @param  $thousand[optional] - se usará separador de milhar
	 * @return string
	 * @access public
	 */
	public static function formataValor($number, $decimals = false, $dec_point = false, $thousand = false){
		// transforma o valor para float
		$number = self::tofloat($number);
		// verifica se é um número válido
		if ( $number === false ){
			return false;
        }
		// formata o número
		return (string) number_format(
				$number,
				$decimals  === false ? '2'  : $decimals,
				$dec_point === false ? ','  : $dec_point,
				$thousand  === false ? '.'  : $thousand
		);
    }
    /**
	 * Método implementado para formatarCPF ou CNPJ.
	 *
	 * @return string
	 * @access public
	 */
	public static function formataCpfCnpj($cpfcnpj){
		// se já estiver formatado, retorna ele mesmo
		if ( self::verificaCpfCnpjFormatado($cpfcnpj) ){
			return $cpfcnpj;
        }
        
		// precisar ter no mínimo 11 caracteres e no máximo 14
		if ( strlen($cpfcnpj) < 11 || strlen($cpfcnpj) > 14 ){
			return false;
        }
        
		// inicializa a variável que receberá o valor formatado
        $formatado = (string) '';
        
		if ( strlen($cpfcnpj) == 11 ){
			$formatado = substr($cpfcnpj, 0, 3) . '.'
					. substr($cpfcnpj, 3, 3) . '.'
							. substr($cpfcnpj, 6, 3) . '-'
									. substr($cpfcnpj, 9, 2);
		} else if ( strlen($cpfcnpj) == 14 ) {
			$formatado = substr($cpfcnpj, 0,  2) . '.'
					. substr($cpfcnpj, 2,  3) . '.'
							. substr($cpfcnpj, 5,  3) . '/'
									. substr($cpfcnpj, 8,  4) . '-'
											. substr($cpfcnpj, 12, 2);
		}
		return $formatado;
    }
    /**
	 * Método implementado para limpar e remover caracteres
	 * especiais que estejam no CPF/CNPJ.
	 *
	 * @param  string $cpfcnpj - o numero do CPF/CNPJ.
	 * @return string
	 * @access public
	 */
	public static function limparCPFCNPJ($cpfcnpj){
		if ( empty($cpfcnpj) ){
			return false;
        }
		// define todos os caracteres que serão retirados
		$proibidos = array('.', '/', '-', '_');
		// faz a retirada dos caracteres
		$cpfcnpj = str_replace($proibidos, array(''), $cpfcnpj);
		return $cpfcnpj;
	}
	
	/**
	 * Método Feito para validar um número
	 * de CPF ou CNPJ.
	 *
	 * @param  string $cpfcnpj - o número do CPF ou CNPJ.
	 * @return boolean
	 * @access public
	 */
	public static function validaCPFCNPJ($cpfcnpj) {
        $cpfcnpj = self::limparCPFCNPJ($cpfcnpj);
        
		// retira o excesso de espaços
        $cnpj = trim($cpfcnpj);
        
		// verifica se foi passado um cnpj
		if ( empty($cpfcnpj) ){
            return false;
        }    
		// só pode possuir números
		if ( strlen($cpfcnpj) != preg_match_all('/[0-9]/', $cpfcnpj, $matches) ){
			return false;
        }
			
		// não podemos deixar que um cnpj seja formado
		// apenas pelo mesmo número(digito). Ex: 66666666666666
        $digito	= $cpfcnpj[0];
        
        $quant  = 0;
		for ( $i=0,$b=strlen($cpfcnpj);$i<$b;$i=$i+1 ) {
			if ( $cpfcnpj[$i] == $digito )
				$quant = $quant + 1;
        }
        
		// verifica se o cnpj é formado apenas por um dígito
		if ( $quant === strlen($cpfcnpj) ){
			return false;
        }
        
		// realiza a validação do dígito verificador
		if ( strlen($cpfcnpj) == 11 ){
			return self::validaCPF($cpfcnpj);
        }
		else if ( strlen($cpfcnpj) == 14 ){
			return self::validaCNPJ($cpfcnpj);
        }
        return false;
	}
	/**
	 * Limpar CEP
	 *
	 */
	public static function limpaCep($cep){
		$cep = trim( str_replace('.', '', $cep) );
		$cep = trim( str_replace('-', '', $cep) );
		return $cep;
	}
	/**
	 * Método implementado para Abreviar Nome
	 *
	 * Exemplo de : 'Pedro Henrique Novaes Braga' para 'Pedro H. N. Braga'
	 *
	 * @return boolean
	 * @access public
	 */
	public static function abreviarNome($nome){
		//nome formatado
		$nome_formatado = '';
		if(isset($nome) && $nome != ''){
			//remove excesso de  espacos
			$nome = preg_replace('/( )+/', ' ', $nome);
				
			//explodir o nome
			$arrayNome = explode(' ', $nome);
				
			if(isset($arrayNome) && count($arrayNome) > 0 ){
				//indice final do array dos nomes
				$indice_final = count($arrayNome) - 1;
				foreach ($arrayNome as $key => $item){
					if($key == '0' || $key == $indice_final){
						//Primeiro e ultimo nome completos
						$nome_formatado .= $item.' ';
					}
					else{
						//caso tenha um sobrenome complementar, exemplo : 'de', 'dos' , 'da', 'das' nao abrevia ,
						//Exemplo de nome REINALDO JOSE DOS SANTOS, ao final fica:  REINALDO J. DOS SANTOS
						if(strlen($item) > 2 && strlen($item) > 3){
							$nome_formatado .= substr($item, '0', '1').' ';
                        } else {
							$nome_formatado .= $item.' ';
                        }
					}
				}
			}
		}
		//remove excesso de  espacos
		$nome_formatado = preg_replace('/( )+/', ' ', $nome_formatado);
		return $nome_formatado;
	}
	/**
	 * formatar bytes para mostrar tamanho
	 *
	 * @param [type] $bytes
	 * @return void
	 */
	public static function formatarBytes($bytes){
		$bytes = (int) $bytes;
		$retorno  = '';
		if ($bytes >= 1000000000) {
			return round($bytes / 1000000000,2) . ' GB';
		}
		if ($bytes >= 1000000) {
			return round($bytes / 1000000,2) . ' MB';
		}
		return round($bytes / 1000,2) . ' KB';
	}

}