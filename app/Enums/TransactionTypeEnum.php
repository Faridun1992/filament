<?php

namespace App\Enums;

enum TransactionTypeEnum: int
{
    case CREDIT = 1;
    case DEBIT = 2;
}
