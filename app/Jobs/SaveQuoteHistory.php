<?php

namespace App\Jobs;

use App\Models\PaymentMethod;
use App\Models\QuoteHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SaveQuoteHistory implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected ?int $user_id,
        protected array $data
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->data['user_id'] = $this->user_id;
        $this->data['payment_method_id'] = $this->getPaymentMethodId();

        $this->saveData($this->data);
    }

    private function getPaymentMethodId(): int
    {
        return PaymentMethod::whereName($this->data['payment_title'])->firstOrFail()->id;
    }

    private function saveData(array $data): void
    {
        QuoteHistory::create($data);
    }
}
