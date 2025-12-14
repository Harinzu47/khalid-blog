<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check(); // Hanya izinkan pengguna yang terautentikasi
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:5000'],
            'parent_id' => ['nullable', Rule::exists('comments', 'id')->where(function ($q) {
                $q->where('post_id', $this->route('post')->id);
            })],
        ];
    }
}
