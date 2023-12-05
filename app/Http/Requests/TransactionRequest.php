<?php

namespace App\Http\Requests;

use App\Enums\TransactionTypeEnum;
use App\Models\Balance;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'balance_id' => ['required', 'integer', 'exists:'.Balance::class.',id'],
            'amount' => ['required', 'numeric', 'min:1'],
            'type' => ['required', 'integer', 'in:'.TransactionTypeEnum::CREDIT->value.','.TransactionTypeEnum::DEBIT->value]
        ];
    }
}
