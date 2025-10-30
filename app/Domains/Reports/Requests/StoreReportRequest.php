<?php

declare(strict_types=1);

namespace App\Domains\Reports\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
            'location' => ['required', 'string', 'max:255'],
            'incident_date' => ['required', 'date', 'before_or_equal:now'],
            'pin' => ['required', 'string', 'min:6', 'max:20'],
            'witness' => ['nullable', 'string', 'max:255'],
            'evidence.*' => [
                'nullable',
                File::types(['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'])
                    ->max(2 * 1024), // 2MB
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'incident_date.before_or_equal' => 'The incident date cannot be in the future.',
            'evidence.*.max' => 'Each evidence file must not exceed 2MB.',
        ];
    }
}
