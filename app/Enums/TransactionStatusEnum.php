<?php

namespace App\Enums;

enum TransactionStatusEnum: int
{
    case NEW = 1;
    case DONE = 2;
    case CANCELED = 3;
}
