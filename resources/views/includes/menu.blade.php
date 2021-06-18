<div class="hidden md:block bg-indigo-800 flex-shrink-0 w-56 p-12 overflow-y-auto">
    <div class="mb-4">
        <a class="flex items-center group py-3" href="{{ $dashboardUrl }}">
            <div class="text-white">Dashboard</div>
        </a>
    </div>
    <div class="mb-4">
        <a class="flex items-center group py-3" href="{{ $interviewsUrl }}">
            <div class="text-white">Interviews</div>
        </a>
    </div>
    @if($type === 'interviewer')
        <div class="mb-4">
            <a class="flex items-center group py-3" href="{{ $candidatesUrl }}">
                <div class="text-white">Candidates</div>
            </a>
        </div>

        <div class="mb-4">
            <a class="flex items-center group py-3" href="{{ $availabilityUrl }}">
                <div class="text-white">Availability</div>
            </a>
        </div>
    @endif
</div>
