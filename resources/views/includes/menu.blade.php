<div class="hidden md:block bg-indigo-800 flex-shrink-0 w-56 p-12 overflow-y-auto">
    <div class="mb-4">
        <a class="flex items-center group py-3" href="{{ route('dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="#fff">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>

            <div class="text-white">
                Dashboard
            </div>
        </a>
    </div>
    @if(auth()->user()->role === \App\Models\User::ROLE_INTERVIEWER)
        <div class="mb-4">
            <a class="flex items-center group py-3" href="{{ route('interviews') }}">
                <div class="text-white">Interviews</div>
            </a>
        </div>
    @endif

    @if(auth()->user()->role === \App\Models\User::ROLE_INTERVIEWER)
        <div class="mb-4">
            <a class="flex items-center group py-3" href="{{ route('candidates') }}">
                <div class="text-white">Candidates</div>
            </a>
        </div>

        <div class="mb-4">
            <a class="flex items-center group py-3" href="{{ route('availability') }}">
                <div class="text-white">Availability</div>
            </a>
        </div>
    @endif
</div>
