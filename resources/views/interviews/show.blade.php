@extends('layouts.app')

@section('title', 'Add Interviewers For ' . $interview->name)

@section('breadcrumb-items')
    <li>
        <span>{{ 'Add Interviewers For ' . $interview->name }}</span>
    </li>
@endsection

@section('content')
    <div class="card max-w-3xl">
        <div class="content">
            <form action="{{ route('interviews.update', $interview->id) }}" method="post">
                @csrf

                <div class="mb-6">
                    <label for="ddlInterviewers">Select Interviewers</label>
                    <select name="interviewers[]" id="ddlInterviewers" class="form-select" multiple required>
                        @foreach($interviewers as $interviewer)
                            <option value="{{ $interviewer->id }}">{{ $interviewer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="footer">
                    <button class="btn btn-indigo">Update Interviewers</button>
                </div>
            </form>
        </div>
    </div>
@endsection
