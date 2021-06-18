@extends('layouts.app')

@section('content')
    <section class="page-actions">
        @if(auth()->user()->role === \App\Models\User::ROLE_INTERVIEWER)
            <a href="{{ route('interviews.create') }}" class="btn btn-indigo">New Interview</a>
            <a href="{{ route('candidates.create') }}" class="btn btn-indigo ml-3">New Candidate</a>
        @endif

            @if(auth()->user()->role === \App\Models\User::ROLE_ADMIN)
                <a href="{{ route('interviews.create') }}" class="btn btn-indigo">New Interviewer</a>
            @endif
    </section>

    @if(auth()->user()->role === \App\Models\User::ROLE_ADMIN)
        <section class="page-section">
            <div class="card">
                <div class="header">
                    <div class="title">Interviewers</div>
                </div>

                <div class="content">
                    Hello world
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
