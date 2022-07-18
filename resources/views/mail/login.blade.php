@include('beautymail::templates.widgets.articleStart', ['color' => '#5850ec'])
@extends('beautymail::templates.minty')

@section('content')

    @include('beautymail::templates.minty.contentStart')
    <tr>
        <td class="paragraph">
            We're verifying a recent sign-in for {{ $recipient }}:
        </td>
    </tr>

    <tr>
        <td width="100%" height="15"></td>
    </tr>

    <tr>
        <td class="paragraph">
            <strong>Timestamp:</strong> {{ $timestamp }}
        </td>
    </tr>

    <tr>
        <td width="100%" height="7"></td>
    </tr>

    <tr>
        <td class="paragraph">
            <strong>IP Address:</strong> {{ $clientIpAddress }}
        </td>
    </tr>

    <tr>
        <td width="100%" height="7"></td>
    </tr>

    <tr>
        <td class="paragraph">
            <strong>User Agent:</strong> {{ $clientDevice }}
        </td>
    </tr>

    <tr>
        <td width="100%" height="7"></td>
    </tr>

    <tr>
        <td class="paragraph">
            <strong>Location:</strong> {{ $locationInfo }}
        </td>
    </tr>

    <tr>
        <td width="100%" height="20"></td>
    </tr>

    <tr>
        <td class="paragraph">
            You're receiving this message because of a successful sign-in to your account. <strong>If you believe that this
                sign-in is suspicious, please <a
                    href="{{ env('APP_ENV') == 'production' ? 'http://evotin.herokuapp.com/password/reset' : 'http://localhost:8000/password/reset' }}">
                    reset your password immediately.</a></strong>
        </td>
    </tr>

    <tr>
        <td width="100%" height="15"></td>
    </tr>

    <tr>
        <td class="paragraph">
            If you're aware of this sign-in, please disregard this notice. This can happen when you use your browser's
            incognito or private browsing mode or clear your cookies.
        </td>
    </tr>

    <tr>
        <td width="100%" height="20"></td>
    </tr>

    <tr>
        <td class="paragraph">
            Regards,
        </td>
    </tr>

    <tr>
        <td width="100%" height="3"></td>
    </tr>

    <tr>
        <td class="paragraph">
            <strong>The {{ config('app.name') }} Team</strong>
        </td>
    </tr>

    <tr>
        <td width="100%" height="35"></td>
    </tr>

    <tr>
        <td class="footer" align="center" style="color: #777777;">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </td>
    </tr>

    <tr>
        <td width="100%" height="20"></td>
    </tr>
    @include('beautymail::templates.minty.contentEnd')

@stop
