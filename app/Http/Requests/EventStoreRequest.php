<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
{
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'category_id' => 'required|exists:categories,id' // Valida se a categoria existe
        ];
    }
}