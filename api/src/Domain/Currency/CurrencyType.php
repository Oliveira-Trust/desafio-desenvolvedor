<?php

namespace Domain\Currency;

enum CurrencyType: string
{
  case BRL = 'BRL';

  case EUR = 'EUR';

  case USD = 'USD';
}