@extends('layouts.app')

@section('title', 'Create Interview')

@section('breadcrumb-items')
    <li>
        <span>New Interview</span>
    </li>
@endsection

@section('content')
    <div class="card max-w-3xl">
        <div class="content">
            <form action="{{ route('interviews.store') }}" method="post">
                @csrf

                <div class="mb-6">
                    <label for="txtName">Title</label>
                    <input id="txtName" type="text" class="form-input" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-6">
                    <label for="txtDescription">Description</label>
                    <textarea id="txtDescription" class="form-input"
                              name="description">{{ old('description') }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="ddlCandidate">Candidate</label>
                    <select name="candidate_id" id="ddlCandidate" class="form-select" required>
                        @if(count($candidates))
                            @foreach($candidates as $candidate)
                                <option value="{{ $candidate->id }}">{{ $candidate->name }}</option>
                            @endforeach
                        @else
                            <option value=''>There are no candidates</option>
                        @endif
                    </select>
                </div>

                <div class="footer">
                    <button class="btn btn-indigo">Create Interview</button>
                </div>
            </form>
        </div>
    </div>
@endsection
