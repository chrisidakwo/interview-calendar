@extends('layouts.app')

@section('breadcrumb-items')
    <li>
        <span>Candidates</span>
    </li>
@endsection

@section('content')
    <section class="page-actions">
        @if(auth()->user()->role === \App\Models\User::ROLE_INTERVIEWER)
            <a href="{{ route('candidates.create') }}" class="btn btn-indigo ml-3">New Candidate</a>
        @endif
    </section>

    <section class="page-section">
        <div class="card">
            <div class="header mb-4">
                <div class="title">Candidates</div>
            </div>

            <div class="content m-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Interview Slot</th>
                        </tr>
                    </thead>

                    <tbody>
                    @if(count($users))
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                @if ($user->interview)
                                    <td>{{ $user->interview->time_slot }}</td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center">There are no candidates</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
