<?php

function translatePaymentMethod($paymentMethod)
{
    switch ($paymentMethod) {
        case 'billet':
            return 'Boleto';
            break;
        
        case 'credit_card':
            return 'Cartão de crédito';
            break;
    }


}