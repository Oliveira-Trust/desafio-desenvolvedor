<?php

namespace App\Models;

class Carrinho
{
	public $items;
	public $qtdTotal =0;
	public $precoTotal=0;

	public function __construct($CarrinhoOld)
	{
		if($CarrinhoOld)
		{
			$this->items = $CarrinhoOld->items;
			$this->qtdTotal = $CarrinhoOld->qtdTotal;
			$this->precoTotal = $CarrinhoOld->precoTotal;
		}
		
	}
	public function add($item, $id)
	{
		$itemNovo = ['qtd' => 0, 'preco' => $item -> preco, 'item'=> $item];
		if($this -> items)
		{
			if(array_key_exists($id, $this->items))
			{
				$itemNovo = $this->items[$id];
			}
		}
		$itemNovo['qtd']++;
		$itemNovo['preco'] = $item->preco * $itemNovo['qtd'];
		$this -> items[$id] = $itemNovo;
		$this ->qtdTotal++;
		$this->precoTotal += $item->preco;	
	}

	public function excluir($id)
	{
		$this->items[$id]['qtd']--;		
		$this->items[$id]['preco'] -= $this->items[$id]['item']['preco'];
		$this->qtdTotal--;
		$this->precoTotal -= $this->items[$id]['item']['preco'];

		if($this->items[$id]['qtd'] <= 0)
		{
			unset($this->items[$id]);
		}
		//ddd($this);
	}

}
