<?php

namespace Domain\Marketing\Email\Actions;

use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Configuration;
use Brevo\Client\Model\SendSmtpEmail;
use Domain\Config\Enums\ConfigName;
use Domain\Config\Models\Config;
use Domain\User\Models\Users;
use DomainException;
use Exception;
use GuzzleHttp\Client;

class EmailSenderAction
{
  public function __construct(
    public readonly Configuration $configuration,
    public readonly Config $configModel,
    public readonly Users $usersModel,
  ) {
  }

  public function execute(int $user_id, string $subject, array $data): void
  {
    $apiConfig = $this->configuration
      ->getDefaultConfiguration()
      ->setApiKey('api-key', $_ENV['EMAIL_API_KEY']);

    $apiInstance = new TransactionalEmailsApi(new Client(), $apiConfig);

    $transactional_email = $this->configModel->whereName(ConfigName::TransactionalEmail)->get('value')[0]->value;
    $company_name = $this->configModel->whereName(ConfigName::CompanyName)->get('value')[0]->value;
    $mkt_email_address = $this->configModel->whereName(ConfigName::CompanyEmailAddress)->get('value')[0]->value;

    $user = $this->usersModel->find($user_id);

    $sendSmtpEmail = new SendSmtpEmail([
      'subject' => $subject,
      'sender' => ['name' => $company_name, 'email' => $mkt_email_address],
      'replyTo' => ['name' => $company_name, 'email' => $mkt_email_address],
      'to' => [[ 'name' => $user->name, 'email' => $user->email]],
      'htmlContent' => $transactional_email,
      'params' => $data
    ]);

    try {
      $apiInstance->sendTransacEmail($sendSmtpEmail);
    } catch (Exception $e) {
      throw new DomainException($e->getMessage());
    }
  }
}