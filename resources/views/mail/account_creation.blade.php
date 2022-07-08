@component('mail::message')
    <h2>Hello {{ $user->fname }},</h2>

    You have been selected to participate in a private election.
    Kindly login to continue:

    Login Details:
    Email: {{ $user->email }}
    Password: {{ $user->email }}

    @component('mail::button', ['url' => 'http://localhost:8000/elections/16'])
        View Election
    @endcomponent

    Regards,
    {{ config('app.name') }}

    @component('mail::subcopy')
        If you’re having trouble clicking the "View Election" button, copy and paste the URL below
        into your web browser: [{{ 'http://localhost:8000/elections/16' }}]({{ 'http://localhost:8000/elections/16' }})
    @endcomponent

@endcomponent
