@extends('layouts.app')

@section('title', 'Schedule A Date')

@section('content')
    <div class="row">
        <div class="col-12 lg:col-8 lg:mb-0 mb-4">
            <div class="card">
                <div class="content m-0">
					<?php
					[$year, $month] = explode('-', request()->query('month'));
					$selectedDay = request()->query('day', $selectedDay ?? null);
					$noPreviousMonth = false;

					$timeSlotsForSelectedDay = [];
					if ($selectedDay) {
						$_dayOfWeek = \Carbon\Carbon::create($year, $month, $selectedDay)->dayOfWeek;
						$timeSlotsForSelectedDay = \Illuminate\Support\Arr::get($availableSlots, $_dayOfWeek, []);
					}

					$calendar = new CalendR\Calendar();
					$_month = $calendar->getMonth((int)$year, (int)$month);

					$currMonth = Carbon\Carbon::create($year, $month)->startOfMonth();

					$prevMonth = Carbon\Carbon::create($year, $month)->startOfMonth()->subMonth();

					if ($prevMonth->lt(today()->startOfMonth())) {
						$noPreviousMonth = true;
						$prevMonth = today()->startOfMonth();
					}

					$nextMonth = Carbon\Carbon::create($year, $month)->startOfMonth()->addMonth()
					?>

                    <div class="flex justify-between flex-row bg-gray-200 p-6">
                        @if($noPreviousMonth)
                            <span>Previous</span>
                        @else
                            <a href="{{ route('interviews.schedule', ['interview' => $interview->id, 'month' => sprintf("%s-%s", $prevMonth->year, $prevMonth->month)]) }}">Previous</a>
                        @endif
                        <h5 class="font-bold">{{ $_month }} {{ $year }}</h5>
                        <a href="{{ route('interviews.schedule', ['interview' => $interview->id, 'month' => sprintf("%s-%s", $nextMonth->year, $nextMonth->month)]) }}">Next</a>
                    </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">Mon</th>
                            <th class="text-center">Tue</th>
                            <th class="text-center">Wed</th>
                            <th class="text-center">Thu</th>
                            <th class="text-center">Fri</th>
                            <th class="text-center">Sat</th>
                            <th class="text-center">Sun</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($_month as $week)
                            <tr>
                                @foreach($week as $day)
                                    @if(!$_month->includes($day))
                                        <td class="cursor-not-allowed text-gray-300 text-center select-none">
                                            {{ $day->format('d') }}
                                        </td>
                                    @endif

                                    @if($_month->includes($day))
										<?php
										$calendarDay = \Carbon\Carbon::create($year, $_month->format('m'), $day->format('d'));
										$dayOfWeek = $calendarDay->clone()->dayOfWeek;
										$availableSlotsDayOfWeek = array_keys($availableSlots);
										?>

										<?php
										// Build classes for each day cell
										$classes = [];

										if (in_array($dayOfWeek, $availableSlotsDayOfWeek) && (today()->year == (int)$year)
											&& (today()->month == (int)$_month->format('m'))
											&& (today()->format('d') == $day->format('d'))
										) {
											$classes[] = 'bg-gray-100';
										}

										if ($selectedDay && $selectedDay == $day->format('d')) {
											$classes[] = 'text-white bg-gray-500';
										} else {
											$classes[] = 'text-gray-700';
										}
										?>

                                        @if (!in_array($dayOfWeek, $availableSlotsDayOfWeek) || today()->gt($calendarDay))
                                            <td class="cursor-not-allowed text-gray-300 text-center select-none">
                                                {{ $day->format('d') }}
                                            </td>
                                        @else
                                            <td class="p-0 text-center hover:bg-gray-300 transition-all duration-300 cursor-pointer">
                                                <a href="{{ route('interviews.schedule', ['interview' => $interview->id, 'month' => sprintf("%s-%s", $currMonth->year, $currMonth->month), 'day' => $day->format('d')]) }}"
                                                   class="p-4 block transition-all duration-300 {{ implode(' ', $classes) }}">
                                                    {{ $day->format('d') }}
                                                </a>
                                            </td>
                                        @endif
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12 lg:col-4">
            <div class="card" style="min-height: 200px;">
                <div class="header">
                    <div class="title">Select Time</div>
                </div>
                <div class="content mt-0 mb-6">
                    @if(!empty($timeSlotsForSelectedDay))
                        <form action="" method="post">
                            @csrf
                            <input type="hidden" name="month" value="{{ request()->query('month') }}" required>
                            <input type="hidden" name="day" value="{{ request()->query('day') }}" required>

                            <label for="ddlSlot" class="form-label m-0">Select from the available time</label>
                            <select name="time_slot" id="ddlSlot" class="form-select mb-3" required>
                                @foreach($timeSlotsForSelectedDay as $slot)
                                    <option value="{{ explode(':', $slot[0])[0] }}">{{ $slot[0] }} - {{ $slot[1] }}</option>
                                @endforeach
                            </select>

                            <button class="w-full btn btn-indigo">Schedule Time</button>
                        </form>
                    @else
                        <p class="mb-0 text-gray-400">Select a day</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
