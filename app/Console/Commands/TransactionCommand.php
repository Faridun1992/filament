<?php

namespace App\Console\Commands;

use App\Enums\TransactionStatusEnum;
use App\Enums\TransactionTypeEnum;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TransactionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Running new transactions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Transaction::query()
            ->with('balance')
            ->where('status', TransactionStatusEnum::NEW->value)
            ->chunk(1000, function ($transactions) {
                $transactions->each(function ($transaction) {
                    if ($transaction->type === TransactionTypeEnum::CREDIT->value) {
                        DB::transaction(function () use ($transaction) {
                            $transaction->balance->update(['amount' => $transaction->balance->amount + $transaction->amount]);
                            $transaction->update(['status' => TransactionStatusEnum::DONE->value]);
                        });
                    } else {
                        if ($transaction->balance->amount >= $transaction->amount) {
                            DB::transaction(function () use ($transaction) {
                                $transaction->balance->update(['amount' => $transaction->balance->amount - $transaction->amount]);
                                $transaction->update(['status' => TransactionStatusEnum::DONE->value]);
                            });
                        } else {
                            $transaction->update(['status' => TransactionStatusEnum::CANCELED->value]);
                        }
                    }
                });
            });

    }
}
