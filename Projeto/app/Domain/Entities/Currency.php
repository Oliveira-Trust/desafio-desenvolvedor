<?php
// app/Domain/Entities/Currency.php
namespace App\Domain\Entities;

class Currency
{
    private $id;
    private $name;
    private $symbol;
    
    public function __construct($id, $name, $symbol) {
        $this->id = $id;
        $this->name = $name;
        $this->symbol = $symbol;
    }
    
    // getters and setters
}
