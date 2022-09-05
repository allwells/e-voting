@props(['election' => $election])

@php
$votes = App\Models\Vote::where('election_id', $election->id)->get();
$candidates = App\Models\Candidate::where('election_id', $election->id)->get();
@endphp

<div class="flex justify-between items-start gap-3 rounded-lg overflow-hidden">
    <a href='{{ route('elections.show', $election) }}'
        style="background-image: url({{ $election->cover ? $election->cover : asset('images/profile-bg.jpg') }}); background-repeat: no-repeat; background-position: center; background-size: cover;"
        class="min-h-[4rem] min-w-[4rem] rounded-md">
    </a>

    <div class="flex-grow flex flex-col items-start justify-start">
        <a href='{{ route('elections.show', $election) }}' class="text-lg font-bold hover:text-[#0000FF] line-clamp-1"
            title="{{ $election->title }}">{{ $election->title }}</a>

        <p class="text-xs font-normal m-0 flex justify-start items-center gap-0.5">
            <svg class="w-4 h-4 text-[#0000FF]" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->start_date, 0, 10)))) }} -
            {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->end_date, 0, 10)))) }}
        </p>

        <div class="flex justify-start items-center gap-3 text-xs cursor-default mt-1">
            <span class="flex justify-center items-center gap-0.5" title="Candidates">
                <svg class="w-4 h-4 text-[#0000FF]" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd"></path>
                </svg>
                {{ $candidates->count() }}
            </span>

            <span class="flex justify-center items-center gap-0.5" title="Votes">
                <svg class="w-[18px] h-[18px] text-[#0000FF]" viewBox="0 0 15 10" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M14.1396 5.95346H12.7434V7.27645H13.232C13.3477 7.27645 13.4415 7.35087 13.4415 7.44182V7.77257C13.4415 7.86352 13.3477 7.93794 13.232 7.93794H2.48072C2.36509 7.93794 2.27128 7.86352 2.27128 7.77257V7.44182C2.27128 7.35087 2.36509 7.27645 2.48072 7.27645H2.96941V5.95346H1.57314C1.18698 5.95346 0.875 6.24906 0.875 6.61495V8.59944C0.875 8.96533 1.18698 9.26093 1.57314 9.26093H14.1396C14.5258 9.26093 14.8378 8.96533 14.8378 8.59944V6.61495C14.8378 6.24906 14.5258 5.95346 14.1396 5.95346ZM12.0452 7.27645V0.667697C12.0452 0.297673 11.7289 0 11.3405 0H4.37442C3.9839 0 3.66755 0.29974 3.66755 0.667697V7.27645H12.0452ZM5.48271 3.51419L6.03904 2.9912C6.13067 2.90438 6.27903 2.90438 6.37066 2.99327L7.27169 3.85321L9.34865 1.9018C9.44028 1.81498 9.58864 1.81498 9.68027 1.90387L10.2322 2.431C10.3239 2.51782 10.3239 2.65838 10.2301 2.74521L7.43095 5.37465C7.33932 5.46147 7.19097 5.46147 7.09934 5.37258L5.48271 3.8284C5.3889 3.74158 5.39108 3.60101 5.48271 3.51419Z"
                        clip-rule="evenodd"></path>
                </svg>
                {{ $votes->count() }}
            </span>

            @if ($election->type == 'private')
                <span class="flex justify-center font-bold uppercase items-center gap-0.5"
                    title="This election is private">
                    <svg class="w-4 h-4 text-[#DD0000]" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Private
                </span>
            @endif
        </div>
    </div>

    <a href="{{ route('results.view', $election) }}" id="result-arrow-btn"
        class="bg-[#0000FF] h-full w-12 text-white flex justify-center items-center">
        <svg class="w-6 h-6" id="result-arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
        </svg>
    </a>
</div>
