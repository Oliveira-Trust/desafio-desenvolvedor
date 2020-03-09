<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    const TYPING_ORDER = 'Pedido em digitação';
    const AWAITING_PAYMENT = 'Aguardando pagamento';
    const CONFIRMED_PAYMENT = 'Pagamento confirmado';
    const CANCELLED = 'Cancelado';

    protected $fillable = [
        'client',
    ];

    public function scopeByAuthorizedUser($query)
    {
        if (auth()->user()->admin){
            return $query;
        }
        return $query->where('user_id', auth()->user()->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(OrderProducts::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function save(array $options=[]) {
        if (empty($this->user_id)) {
            $this->user_id = auth()->user()->id;
        }
        parent::save($options);
    }

    public function confirmPayment()
    {
        if ($this->status == Order::AWAITING_PAYMENT){
            $this->status = Order::CONFIRMED_PAYMENT;
            $this->save();
            return true;
        }
        return false;
    }

    public function cancelOrder()
    {
        if ($this->status == Order::AWAITING_PAYMENT | $this->status == Order::TYPING_ORDER){
            $this->status = Order::CANCELLED;
            $this->save();
            return true;
        }
        return false;
    }

    public function commitOrder()
    {
        if ($this->status =! Order::TYPING_ORDER){
            return false;
        }
        $this->status = Order::AWAITING_PAYMENT;
        $this->value = $this->calculateValue();
        $this->save();
        return true;
    }

    public function calculateValue()
    {
        $value = 0;
        foreach ($this->products as $item){
            $value += $item->quantity * $item->product->price;
        }
        return $value;
    }
}
