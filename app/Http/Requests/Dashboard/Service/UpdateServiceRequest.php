<?php

namespace App\Http\Requests\Dashboard\Service;

use App\Models\Service;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateServiceRequest extends FormRequest
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
            'title' => [
                'required', 'string', 'max:255'
            ],
            'description' => [
                'nullable', 'string', 'max:5000'
            ],
            'delivery_time' => [
                'required', 'integer', 'max:100'
            ],
            'revision_limit' => [
                'required', 'integer', 'max:100'
            ],
            'price' => [
                'required', 'integer'
            ],
            'note' => [
                'nullable', 'string', 'max:5000'
            ]
        ];
    }
}
