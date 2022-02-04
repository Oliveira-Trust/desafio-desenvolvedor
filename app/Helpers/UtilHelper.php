<?php

/**
 * Classe de utilidades para o sistema
 * @version 1
 * @author Pedro <pero.phnb@gmail.com>
 */

namespace App\Helpers;
//Exemplo - {{ \App\Helpers\CustomHelper::fooBar() }}


class UtilHelper {
	/**
	 * Método implementado para debugar 
	 * 
	 * @param  $var  - a variavel que sera debugada.
	 * @param  $exit - indica se o script sera finalizado.
	 * @return void
	 * @access public
	 */
	public static function debug($var, $exit = true)
	{
		// monta a string de debug
		$debug = '<pre>'.print_r($var, true).'</pre>';
		
		// exibe o conte�do 
		echo $debug;
		
		// verifica se a aplica��o vai ser finalziada
		if ( $exit === true )
			exit();
	}
    /**
	 * Método feito alterar array simples separado por virgula
	 * simples por virgula
	 *
	 * @param  array  $array - o array ou string
	 *
	 * @return string
	 */
	public static function alteraArrayParaVirgula($array)	{
	
		$string = '';
	
		if ( is_array($array) )
		{
			$total    = count($array);
			$contador = 0;
			$string   = '';
				
			foreach($array as $item)
			{
				$contador++;
				if ( $total > $contador )
				{
					if ( !empty($item) )
						$string .= $item.',';
				}
				else
				{
					if ( !empty($item) )
						$string .= $item;
				}
			}
		}
		else
		{
			$string = $array;
		}
		
		return $string;
	}

}