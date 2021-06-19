<div class="hidden md:block bg-indigo-800 flex-shrink-0 w-56 p-12 overflow-y-auto">
    <div class="mb-4">
        <a class="flex items-center group py-3" href="{{ route('dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="#fff">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>

            <div class="text-white">
                Dashboard
            </div>
        </a>
    </div>
    @if(auth()->user()->role === \App\Models\User::ROLE_INTERVIEWER)
        <div class="mb-4">
            <a class="flex items-center group py-3" href="{{ route('interviews') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                     stroke="#fff">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>

                <div class="text-white">Interviews</div>
            </a>
        </div>
    @endif

    @if(auth()->user()->role === \App\Models\User::ROLE_INTERVIEWER)
        <div class="mb-4">
            <a class="flex items-center group py-3" href="{{ route('candidates') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                     stroke="#fff">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>

                <div class="text-white">Candidates</div>
            </a>
        </div>
    @endif

    @if(in_array(auth()->user()->role, [\App\Models\User::ROLE_INTERVIEWER, \App\Models\User::ROLE_CANDIDATE]))
        <div class="mb-4">
            <a class="flex items-center group py-3" href="{{ route('availability.create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                     stroke="#fff">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>

                <div class="text-white">Set Availability</div>
            </a>
        </div>
    @endif
</div>
