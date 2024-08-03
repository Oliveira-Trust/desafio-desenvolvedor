<?php

namespace Domain\Config\Enums;

enum ConfigName: string
{
  case FeePercentages = 'fee_percentages';

  case TransactionalEmail = 'transactional_email';

  case CompanyEmailAddress = 'company_email_address';

  case CompanyName = 'company_name';
}