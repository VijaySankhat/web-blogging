<?php

namespace App\Http\Requests;

use App\Rules\CanSave;
use Illuminate\Support\Str;

class PostsRequest extends AbstractRequest
{

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->input('title'), '-')
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:50',
            'author_id' => ['required', 'exists:users,id', new CanSave()],
        ];
    }
}