@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="page-actions">
        @if(auth()->user()->role === \App\Models\User::ROLE_INTERVIEWER)
            <a href="{{ route('interviews.create') }}" class="btn btn-indigo">New Interview</a>
            <a href="{{ route('candidates.create') }}" class="btn btn-indigo ml-3">New Candidate</a>
        @endif

            @if(auth()->user()->role === \App\Models\User::ROLE_ADMIN)
                <a href="{{ route('interviewers.create') }}" class="btn btn-indigo">New Interviewer</a>
            @endif
    </section>

    @if(auth()->user()->role === \App\Models\User::ROLE_ADMIN)
        <section class="page-section">
            <div class="card">
                <div class="header mb-4">
                    <div class="title">Interviewers</div>
                </div>

                <div class="content m-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Availability</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(count($users))
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ '' }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">There are no interviewers</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    @endif

    @if(auth()->user()->role === \App\Models\User::ROLE_INTERVIEWER)
        <section class="page-section">
            <div class="card">
                <div class="header">
                    <div class="title">Upcoming Interviews</div>
                </div>

                <div class="content">
                    Hello world
                </div>
            </div>
        </section>

        <section class="page-section">
            <div class="card">
                <div class="header">
                    <div class="title">Past Interviews</div>
                </div>

                <div class="content">
                    Hello world
                </div>
            </div>
        </section>
    @endif

    @if (auth()->user()->role === \App\Models\User::ROLE_CANDIDATE)
        <section class="page-section">
            <div class="card">
                <div class="header">
                    <div class="title">Interview</div>
                </div>

                <div class="content">
                    Hello world
                </div>
            </div>
        </section>
    @endif
@endsection
