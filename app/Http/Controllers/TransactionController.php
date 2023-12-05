<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function createTransaction(TransactionRequest $request)
    {
        return Transaction::create($request->validated());
    }

    public function showUsersTransactions(int $id)
    {
        return Transaction::query()
            ->whereRelation('balance', 'user_id', $id)
            ->get();
    }
}
