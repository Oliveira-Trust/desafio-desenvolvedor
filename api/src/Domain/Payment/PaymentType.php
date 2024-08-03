<?php

namespace Domain\Payment;

enum PaymentType: string
{
  case Boleto = "boleto";

  case Cartao = "cartao";
}