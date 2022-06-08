@extends('layout.layout')

@section('title', 'Information')
@section('information-tab', 'active-information')

@section('views')
    <div class="flex items-center justify-center px-3 py-10 h-fit lg:px-40">
        <div class="w-full min-h-full px-4 py-3 tracking-wide bg-white md:px-8 dark:bg-neutral-700">
            <h2
                class="py-2 sm:py-3 text-white uppercase text-sm w-full px-2.5 shadow-xl -mt-8 bg-indigo-600 ring-1 ring-indigo-600 border-2 border-white cursor-default">
                User Manual
            </h2>
            <div class="pb-6 mt-6 grow text-neutral-500 dark:text-neutral-200">
                <h2>Welcome</h2>
                <p class="mt-1">These are few guidelines for user:</p>

                <ol class="mt-2 ml-5 list-decimal">
                    <li>Voter Registration</li>
                    <ul class="pl-5 mt-2 space-y-2 text-sm list-disc md:pl-9">
                        <li>For casting the vote, you need to first register yourself. For this registeration, the you will
                            be provided a voter registration form on this app.</li>
                        <li>As a voter, you can only register before the election is declared open by the admin.</li>
                        <li>For registration, you will enter your email, phone number and password (for confirmation of your
                            action in your account) with which you will use for the voting process.</li>
                        <li>At the first stage of the registration process, your age will be checked. If you are below 18
                            years or above, then you are eligible to vote.</li>
                        <li>The second stage is OTP verification. In this stage, an OTP will be sent to your phone and email
                            provided for verification.</li>
                        <li>Entering the OTP correctly will get you successfully registered.</li>
                    </ul>

                    <li class="mt-4">Voting Process</li>
                    <ul class="pl-5 mt-2 space-y-2 text-sm list-disc md:pl-9">
                        <li>Overall, voting process is divided into 3 phases all of which will be initialized and terminated
                            by admin. Voters will participate in the voting process as listed below:</li>
                        <ol class="pl-4 mt-2 space-y-2 text-sm list-decimal">
                            <li><strong>Registration Phase:</strong> During this phase, you are to register in order to cast
                                a vote in an election.</li>
                            <li><strong>Voting Phase:</strong> This phase begins only after it has been initialized by the
                                admin, only then can you be able to cast your vote.</li>
                            <li><strong>Result Phase:</strong> This is final phase of the whole voting process during which
                                the results of election will be displayed. This can found in the "Result" section.</li>
                        </ol>
                    </ul>
                </ol>
            </div>
        </div>
    </div>
@endsection
