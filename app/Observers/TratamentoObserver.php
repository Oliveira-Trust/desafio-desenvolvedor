<?php

    namespace App\Observers;

    use App\Models\Config;
    use App\Models\Historico;

    class TratamentoObserver
    {
        public function creating(Historico $model)
        {
            $model->user_id = auth()->user()->id;
        }

        public function updating(Config $model)
        {
            $model->user_id = auth()->user()->id;
        }
    }
