<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInterviewRequest extends FormRequest {
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
            'interviewers' => ['required']
        ];
    }

    public function withValidator(Validator $validator) {
        $validator->after(function (Validator $validator) {
            // Ensure all interviewers exists on DB
            $interviewers = $this->get('interviewers');

            $exists = User::query()->whereIn('id', $interviewers)
                ->whereRole(User::ROLE_INTERVIEWER)->exists();

            if (!$exists) {
                $validator->errors()->add('interviewers', 'Some of the selected interviewers do not exist!');
            }

            return $validator;
        });
    }
}
