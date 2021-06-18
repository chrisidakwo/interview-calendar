<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {
        return [
            'name'         => ['required', 'string'],
            'email'        => ['required', 'email'],
            'role'         => ['required', 'string', Rule::in([User::ROLE_ADMIN, User::ROLE_CANDIDATE, User::ROLE_INTERVIEWER])],
            'availability' => ['sometimes', 'array']
        ];
    }
}
