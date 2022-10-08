@props(['election' => $election, 'candidates' => $candidates, 'votes' => $votes, 'count' => $count])

@php
foreach ($votes as $vote) {
    if ($vote->election_id == $election->id) {
        $count++;
    }
}

$hasVoted = App\Models\Vote::where('user_id', Auth::user()->id)
    ->where('election_id', (int) $election->id)
    ->first();

$exists = $hasVoted ? $hasVoted->user_id == Auth::user()->id : null;
@endphp

@php
$now = \Carbon\Carbon::now();
$today = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $now);
$endDate = \Carbon\Carbon::parse($election->end_date);
$startDate = \Carbon\Carbon::parse($election->start_date);

$hasNotStarted = $today->lt($election->start_date) && $today->lt($election->end_date);
$hasStarted = $today->gt($election->start_date) && $today->lt($election->end_date);
$hasEnded = ($today->gt($election->start_date) && $today->gt($election->end_date)) || $election->status == 'closed';

$seconds = $endDate->diffInSeconds($now);
$minutes = $endDate->diffInMinutes($now);
$hours = $endDate->diffInHours($now);
$days = $endDate->diffInDays($now);
$months = $endDate->diffInMonths($now);
$years = $endDate->diffInYears($now);

$seconds2 = $startDate->diffInSeconds($now);
$minutes2 = $startDate->diffInMinutes($now);
$hours2 = $startDate->diffInHours($now);
$days2 = $startDate->diffInDays($now);
$months2 = $startDate->diffInMonths($now);
$years2 = $startDate->diffInYears($now);
@endphp

<div class="flex flex-col items-start justify-start overflow-hidden text-white rounded-2xl"
    style="background-image:url('{{ $election->cover ? $election->cover : asset('images/profile-bg.jpg') }}'); background-position:bottom; background-size:cover;">
    <div class="flex flex-col items-start justify-between w-full bg-black/40 h-fit md:h-80">
        <div class="flex items-start justify-between w-full p-3 md:p-5">
            <div>
                <h2 class="m-0 text-xl font-bold text-left md:text-2xl">{{ $election->title }}</h2>
                <p class="mt-1 text-sm font-normal">
                    {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->start_date, 0, 10)))) }} -
                    {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->end_date, 0, 10)))) }}
                </p>
            </div>
        </div>

        <div class="flex flex-col items-start justify-end w-full mt-3 md:mt-0">
            <div class="flex mb-5 -space-x-1 md:-space-x-2.5 px-3 md:px-5">
                @foreach ($candidates as $candidate)
                    @if ($election->id === $candidate->election_id)
                        @if ($candidate->image)
                            <img src="{{ $candidate->image }}" alt="{{ $candidate->name }}"
                                class="w-6 h-6 border-2 rounded-full md:w-10 md:h-10 border-neutral-300" />
                        @else
                            <svg class="bg-black border-2 border-black rounded-full md:w-10 md:h-10 w-7 h-7"
                                fill="currentColor" viewBox="2.2 2.2 15.6 15.6" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    @endif
                @endforeach
            </div>

            <div class="bg-[#0000FF] h-auto w-full flex justify-start items-center px-3 md:px-5 pt-1 pb-2 md:py-3">
                <div class="flex flex-col items-start justify-start w-full">
                    <span class="flex items-center justify-start gap-3">
                        <svg style="width:14px; height: 9.26px;" viewBox="0 0 15 10" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M14.1396 5.95346H12.7434V7.27645H13.232C13.3477 7.27645 13.4415 7.35087 13.4415 7.44182V7.77257C13.4415 7.86352 13.3477 7.93794 13.232 7.93794H2.48072C2.36509 7.93794 2.27128 7.86352 2.27128 7.77257V7.44182C2.27128 7.35087 2.36509 7.27645 2.48072 7.27645H2.96941V5.95346H1.57314C1.18698 5.95346 0.875 6.24906 0.875 6.61495V8.59944C0.875 8.96533 1.18698 9.26093 1.57314 9.26093H14.1396C14.5258 9.26093 14.8378 8.96533 14.8378 8.59944V6.61495C14.8378 6.24906 14.5258 5.95346 14.1396 5.95346ZM12.0452 7.27645V0.667697C12.0452 0.297673 11.7289 0 11.3405 0H4.37442C3.9839 0 3.66755 0.29974 3.66755 0.667697V7.27645H12.0452ZM5.48271 3.51419L6.03904 2.9912C6.13067 2.90438 6.27903 2.90438 6.37066 2.99327L7.27169 3.85321L9.34865 1.9018C9.44028 1.81498 9.58864 1.81498 9.68027 1.90387L10.2322 2.431C10.3239 2.51782 10.3239 2.65838 10.2301 2.74521L7.43095 5.37465C7.33932 5.46147 7.19097 5.46147 7.09934 5.37258L5.48271 3.8284C5.3889 3.74158 5.39108 3.60101 5.48271 3.51419Z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-xl font-bold">
                            {{ $count }} <span class="text-base">{{ $count > 1 ? 'Votes' : 'Vote' }}</span>
                        </span>
                    </span>

                    <span class="flex items-center justify-start gap-3 text-sm">
                        <svg class="w-[15px] h-[14.17px]" viewBox="0 0 15 15" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.50001 13.2888C6.20206 13.2888 4.93327 12.9251 3.85407 12.2436C2.77488 11.5622 1.93374 10.5937 1.43704 9.46048C0.940343 8.3273 0.810384 7.08038 1.0636 5.87741C1.31682 4.67443 1.94183 3.56943 2.85962 2.70213C3.7774 1.83483 4.94672 1.24419 6.21973 1.00491C7.49273 0.765618 8.81223 0.888429 10.0114 1.35781C11.2105 1.82719 12.2354 2.62205 12.9565 3.64188C13.6776 4.66172 14.0625 5.86072 14.0625 7.08726C14.0625 8.73201 13.3711 10.3094 12.1404 11.4724C10.9097 12.6354 9.24049 13.2888 7.50001 13.2888ZM7.50001 1.77168C6.38749 1.77168 5.29995 2.08343 4.37492 2.66751C3.44989 3.2516 2.72892 4.08178 2.30318 5.05308C1.87744 6.02437 1.76604 7.09316 1.98309 8.12428C2.20013 9.15541 2.73586 10.1026 3.52253 10.846C4.3092 11.5893 5.31148 12.0956 6.40262 12.3007C7.49377 12.5058 8.62477 12.4005 9.6526 11.9982C10.6804 11.5959 11.5589 10.9146 12.177 10.0404C12.7951 9.1663 13.125 8.13859 13.125 7.08726C13.125 5.67748 12.5324 4.32544 11.4775 3.32858C10.4226 2.33171 8.99185 1.77168 7.50001 1.77168Z"
                                clip-rule="evenodd"></path>
                            <path fill-rule="evenodd"
                                d="M9.65156 9.74507L7.03125 7.26889V3.10059H7.96875V6.90123L10.3125 9.12049L9.65156 9.74507Z">
                            </path>
                        </svg>
                        @if ($hasStarted)
                            @if ($years > 0)
                                <p class="text-sm font-medium -mr-1.5">Voting closes in</p>
                                <p class="text-sm font-medium">
                                    {{ $years }} {{ $years == 1 ? 'year' : 'years' }}
                                </p>
                            @elseif ($months > 0)
                                <p class="text-sm font-medium -mr-1.5">Voting closes in</p>
                                <p class="text-sm font-medium">
                                    {{ $months }}{{ $months == 1 ? 'month' : 'months' }}</p>
                            @elseif ($days > 0)
                                <p class="text-sm font-medium -mr-1.5">Voting closes in</p>
                                <p class="text-sm font-medium">
                                    {{ $days }} {{ $days == 1 ? 'day' : 'days' }}
                                </p>
                            @elseif ($hours > 0)
                                <p class="text-sm font-medium -mr-1.5">Voting closes in</p>
                                <p class="text-sm font-medium">{{ $hours }}
                                    {{ $hours == 1 ? 'hour' : 'hours' }}
                                </p>
                            @elseif ($minutes > 0)
                                <p class="text-sm font-medium -mr-1.5">Voting closes in</p>
                                <p class="text-sm font-medium">{{ $minutes }}
                                    {{ $minutes == 1 ? 'minute' : 'minutes' }}
                                </p>
                            @else
                                <p class="text-sm font-bold">Voting closes in few seconds</p>
                            @endif
                        @elseif ($hasNotStarted)
                            @if ($years2 > 0)
                                <p class="text-sm font-medium -mr-1.5">Voting opens in</p>
                                <p class="text-sm font-medium">{{ $years2 }}
                                    {{ $years2 == 1 ? 'year' : 'years' }}</p>
                            @elseif ($months2 > 0)
                                <p class="text-sm font-medium -mr-1.5">Voting opens in</p>
                                <p class="text-sm font-medium">{{ $months2 }}
                                    {{ $months2 == 1 ? 'month' : 'months' }}</p>
                            @elseif ($days2 > 0)
                                <p class="text-sm font-medium -mr-1.5">Voting opens in</p>
                                <p class="text-sm font-medium">{{ $days2 }} {{ $days2 == 1 ? 'day' : 'days' }}
                                </p>
                            @elseif ($hours2 > 0)
                                <p class="text-sm font-medium -mr-1.5">Voting opens in</p>
                                <p class="text-sm font-medium">{{ $hours2 }}
                                    {{ $hours2 == 1 ? 'hour' : 'hours' }}</p>
                            @elseif ($minutes2 > 0)
                                <p class="text-sm font-medium -mr-1.5">Voting opens in</p>
                                <p class="text-sm font-medium">{{ $minutes2 }}
                                    {{ $minutes2 == 1 ? 'minute' : 'minutes' }}
                                </p>
                            @else
                                <p class="text-sm font-bold">Voting opens in few seconds</p>
                            @endif
                        @else
                            <p class="text-sm font-bold">Voting closed
                                {{ \Carbon\Carbon::create($election->end_date)->diffForHumans() }}</p>
                        @endif
                    </span>
                </div>

                <a href="{{ route('elections.show', $election) }}"
                    class="py-1.5 px-5 rounded-xl hover:bg-white text-base bg-white/90 text-[#0000FF] h-[36.45px] border border-transparent font-semibold focus:ring focus:ring-white/50 focus:bg-white">
                    @if ($exists)
                        Voted
                    @else
                        Open
                    @endif
                </a>
            </div>
        </div>
    </div>
</div>
