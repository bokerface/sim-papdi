<?php

namespace App\Enums;

enum PaymentMethodEnum: string
{
    case Transfer = "Transfer";
    case Midtrans = "Midtrans";
}
