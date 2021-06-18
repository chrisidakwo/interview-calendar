@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="card">
        <div class="header mb-6">
            <div class="title">Login</div>
        </div>

        <div class="content">
            <form action="{{ url('/login') }}" method="post">
                @csrf

                <div class="mb-4">
                    <label for="txtEmail" class="form-label mb-0">Email Address</label>
                    <input id="txtEmail" type="email" name="email" value="{{ old('email') }}" class="form-input" required>
                </div>

                <div class="mb-8">
                    <label for="txtPassword" class="form-label mb-0">Password</label>
                    <input id="txtPassword" type="password" name="password" class="form-input" required>
                </div>

                <div class="footer text-center">
                    <button class="btn btn-indigo w-full" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>

    <a class="mb-0 mt-3 block text-center" href="{{ route('home') }}">Go back</a>
@endsection
