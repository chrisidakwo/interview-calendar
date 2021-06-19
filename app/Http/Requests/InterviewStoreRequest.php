<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class InterviewStoreRequest extends FormRequest {
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
            'candidate_id' => ['required', 'string', 'exists:users,id']
        ];
    }

    public function withValidator(Validator $validator) {
        $validator->after(function (Validator $validate) {
            // If candidate already has an interview and is not past the time slot, return error
            $candidate = User::query()->find($this->get('candidate_id'));

            if ($candidate->interviews) {
                return $validate->errors()->add('candidate_id', 'Candidate already has an interview schedule');
            }

            return $validate;
        });
    }
}
