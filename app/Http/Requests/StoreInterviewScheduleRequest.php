<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInterviewScheduleRequest extends FormRequest {
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
            'time_slot' => ['required'],
            'month'     => ['required'],
            'day'       => ['required', 'numeric', Rule::in(range(1, 31))],
        ];
    }

    public function withValidator(Validator $validator) {
        $validator->after(function (Validator $val) {
            // Ensure the the selected time_slot for the selected day is valid

            $timeSlot = (int) $this->get('time_slot');
            [$year, $month] = explode('-', $this->get('month'));
            $day = $this->get('day');

            // Create date instance from provided month, day, and year
            $date = Carbon::create($year, $month, $day);

            $interview = $this->route('interview');

            $interviewersSlots = $interview->interviewers->getAvailableSlots()->toArray()[0];
            $candidateSlots = $interview->candidate->availability;

            // Get available time slots for interviewers and candidate
            $availableSlots = getAvailableSlots($interviewersSlots, $candidateSlots);

            // Get day of the week and compare against same day availability slots for the interview
            $dayOfWeek = $date->clone()->dayOfWeek;

            // Get the starting hour for all available time slots of the the day of the week
            $slotsForTheWeek = array_map(function ($value) {
                return (int) $value[0];
            }, $availableSlots[$dayOfWeek]);

            // If the selected time slot is not in the list of available hours for the week, then add an error
            if (!in_array($timeSlot, $slotsForTheWeek)) {
                $val->errors()->add('time_slot', 'The selected time slot is not available');
            }

            return $val;
        });
    }
}
