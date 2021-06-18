@extends('layouts.app')

@section('title', 'Create Candidates')

@section('breadcrumb-items')
    <li>
        <span>New Candidate</span>
    </li>
@endsection

@section('content')
    <div class="card max-w-3xl">
        <div class="content">
            <form action="{{ route('users.store') }}" method="post">
                @csrf

                <input type="hidden" name="role" value="{{ \App\Models\User::ROLE_CANDIDATE }}">

                <div class="mb-6">
                    <label for="txtName">Name</label>
                    <input id="txtName" type="text" class="form-input" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-6">
                    <label for="txtEmail">Email</label>
                    <input id="txtEmail" type="email" class="form-input" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="footer">
                    <button class="btn btn-indigo">Create Candidate</button>
                </div>
            </form>
        </div>
    </div>
@endsection
