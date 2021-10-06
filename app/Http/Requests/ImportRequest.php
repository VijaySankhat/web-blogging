<?php

namespace App\Http\Requests;

use App\Rules\CanImport;

class ImportRequest extends AbstractRequest
{

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'url' => ['required', 'url', new CanImport()],
        ];
    }
}