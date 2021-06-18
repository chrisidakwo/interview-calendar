@extends('layouts.app')

@section('content')
    <section class="page-actions">
        @if($type === 'interviewer')
            <a href="{{ route('interviews.create') }}" class="btn btn-indigo">New Interview</a>
            <a href="{{ route('candidates.create') }}" class="btn btn-indigo ml-3">New Candidate</a>
        @endif
    </section>

    @if($type === 'interviewer')
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
    @else
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
