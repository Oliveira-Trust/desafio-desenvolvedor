<?php

namespace App\Observers;

use App\Models\BuyCurrencyModel;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class BuyCurrencyModelObserver
{
    /**
     * Handle the BuyCurrencyModel "created" event.
     *
     * @param  \App\Models\BuyCurrencyModel  $buyCurrencyModel
     * @return void
     */
    public function created(BuyCurrencyModel $buyCurrencyModel)
    {
        Log::alert('tentou entrar no created');
        if(!$buyCurrencyModel->user) {
            Log::alert('não tinha user' . $buyCurrencyModel->user_id);
            return;
        }

        Notification::send(
            $buyCurrencyModel->user,
            new InvoicePaid(json_decode(json_encode($buyCurrencyModel)))
        );
    }

    /**
     * Handle the BuyCurrencyModel "updated" event.
     *
     * @param  \App\Models\BuyCurrencyModel  $buyCurrencyModel
     * @return void
     */
    public function updated(BuyCurrencyModel $buyCurrencyModel)
    {
        Log::alert('tentou entrar no updated');
        if(!$buyCurrencyModel->user) {
            Log::alert('não tinha user' . $buyCurrencyModel->user_id);
            return;
        }

        Notification::send(
            $buyCurrencyModel->user,
            new InvoicePaid(json_decode(json_encode($buyCurrencyModel)))
        );
    }

}
