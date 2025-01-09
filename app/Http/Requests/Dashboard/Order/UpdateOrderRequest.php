<?php

namespace App\Http\Requests\Dashboard\Order;

use App\Models\Service;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateOrderRequest extends FormRequest
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
            'freelancer_id' => [
                'nullable', 'integer'
            ],
            'client_id' => [
                'nullable', 'integer'
            ],
            'service_id' => [
                'nullable', 'integer'
            ],
            'file' => [
                'required', 'file', 'max:10000'
            ],
            'note' => [
                'required', 'string', 'max:5000'
            ],
            'expired' => [
                'nullable', 'date'
            ],
            'status_order_id' => [
                'nullable', 'integer'
            ]
        ];
    }
}
