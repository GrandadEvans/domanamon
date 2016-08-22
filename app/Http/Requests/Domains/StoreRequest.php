<?php

declare(strict_types=1);

namespace Domanamon\Http\Requests\Domains;

use Domanamon\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'domain' => 'required|activeurl'
        ];
    }

    /**
     * Customise the error messages
     */
    public function messages(): array
    {
        return [
            'domain.required' => 'The Domain Address is required',
            'domain.activeurl' => 'The Domain Address currently must be an active URL',
        ];
    }
}
