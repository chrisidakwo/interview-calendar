@extends('layouts.app')

@section('breadcrumb-items')
    <li>
        <span>New Interviewer</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
    </li>
@endsection

@section('content')
    <div class="card max-w-3xl">
        <div class="content">
            <form action="{{ route('users.store') }}" method="post">
                @csrf

                <input type="hidden" name="role" value="{{ \App\Models\User::ROLE_INTERVIEWER }}">

                <div class="mb-6">
                    <label for="txtName">Name</label>
                    <input id="txtName" type="text" class="form-input" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-6">
                    <label for="txtEmail">Email</label>
                    <input id="txtEmail" type="email" class="form-input" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="footer">
                    <button class="btn btn-indigo">Create Interviewer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
