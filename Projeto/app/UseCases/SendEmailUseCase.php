
<?php
// app/UseCases/SendEmailUseCase.php
namespace App\UseCases;

use App\Services\EmailService;

class SendEmailUseCase
{
    private $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function execute($userId, $quoteId)
    {
        $user = $this->userRepository->getUserById($userId);
        $quote = $this->quoteRepository->getQuoteById($quoteId);

        $subject = 'Your recent currency conversion quote';
        $body = "Hello {$user->getEmail()},\n\n".
                 "Here are the details of your recent currency conversion:\n\n".
                 "Base currency: {$quote->getBaseCurrency()->getSymbol()}\n".
                 "Target currency: {$quote->getTargetCurrency()->getSymbol()}\n".
                 "Amount: {$quote->getAmountBRL()}\n".
                 "Payment method: {$quote->getPaymentMethod()}\n".
                 "Conversion fee: {$quote->getConversionFee()}\n".
                 "Payment fee: {$quote->getPaymentFee()}\n".
                 "Total amount in target currency: {$quote->getAmountTargetCurrency()}\n";

        return $this->emailService->sendEmail($user->getEmail(), $subject, $body);
    }
}
