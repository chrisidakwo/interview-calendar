<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvailibilityStoreRequest;
use App\Models\TimeSlot;
use App\Repositories\AvailabilityRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AvailabilityController extends Controller {
    private AvailabilityRepository $availabilityRepository;

    public function __construct(AvailabilityRepository $availabilityRepository) {
        $this->availabilityRepository = $availabilityRepository;
    }

    public function index(Request $request) {
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function viewCreateForm(Request $request) {
        $timeSlots = TimeSlot::query()->get()->groupBy(['day'])
            ->sortKeys()->map(function ($value, $key) {
                return Arr::sort($value->toArray(), function ($val, $k) {
                    return (int) $val['start_time'];
                });
            });

        $availabilitySlots = $request->user()->availability;

        return view('availability.set', compact('timeSlots', 'availabilitySlots'));
    }

    /**
     * @param AvailibilityStoreRequest $request
     * @return RedirectResponse
     */
    public function store(AvailibilityStoreRequest $request): RedirectResponse {
        $slots = $request->get('slots');

        $availabilitySlots = [];
        foreach ($slots as $dayNumber => $timeSlots) {
            foreach ($timeSlots as $time => $timeSlot) {
                $availabilitySlots[$dayNumber][] = [
                    'start' => "$time:00",
                    'end'   => ($time + 1) . ':00'
                ];
            }
        }

        $this->availabilityRepository->storeAvailability($availabilitySlots, auth()->id());

        session()->flash('success', 'Availability updated!');

        return back();
    }
}
