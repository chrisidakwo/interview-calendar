@extends('layouts.app')

@section('title', 'Interviews')

@section('breadcrumb-items')
    <li>
        <span>Interviews</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
    </li>
@endsection

@section('content')
    <section class="page-actions">
        <a href="{{ route('interviews.create') }}" class="btn btn-indigo ml-3">New Interview</a>
    </section>

    <section class="page-section">
        <div class="card">
            <div class="header mb-4">
                <div class="title">Interviews</div>
            </div>

            <div class="content m-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Candidate</th>
                            <th>Time Slot</th>
                            <th>Other Interviewers</th>
                        </tr>
                    </thead>

                    <tbody>
                    @if(count($interviews))
                        @foreach($interviews as $interview)
                            <tr class="cursor-pointer" onclick="window.location.href = '{{ route('interviews.show', $interview->id) }}'">
                                <td>{{ $interview->name }}</td>
                                <td>{{ $interview->candidate->name }}</td>
                                @if ($interview->time_slot)
                                    <td>{{ $interview->time_slot->format('d-m-Y H:m') }}</td>
                                @else
                                    <td></td>
                                @endif
                                @if ($interview->interviewers)
                                    <td>{{ implode(', ', $interview->OtherInterviewers(auth()->id())) }}</td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">There are no interviews</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
