@extends('layouts.app')

@section('title', 'Set Availability')

@section('breadcrumb-items')
    <li>
        <span>Set Availability</span>
    </li>
@endsection

@section('content')
    <div class="card max-w-3xl">
        <div class="content">
            <form action="{{ route('availability.store') }}" method="post">
                @csrf

                @foreach($timeSlots as $day => $slots)
                    <div class="mb-6">
                        <h5 class="mb-2">{{ \App\Models\TimeSlot::DAYS[$day] }}</h5>

                        <div class="inline">
                            @foreach($slots as $slot)
                                <label class="mt-6 mr-8 w-32 select-none">
                                    <input class="mr-1" type="checkbox" name="slots[{{ $day }}][{{ (int) $slot['start_time'] }}]" @if(checkAvailability($availabilitySlots ?: [], $day, (int) $slot['start_time'])) checked @endif />
                                    <span class="text-sm">{{ $slot['start_time'] }} - {{ $slot['end_time'] }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="footer">
                    <button class="btn btn-indigo" type="submit">Update Availability</button>
                </div>
            </form>
        </div>
    </div>
@endsection
