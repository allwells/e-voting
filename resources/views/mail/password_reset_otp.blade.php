@include('beautymail::templates.widgets.articleStart', ['color' => '#5850ec'])
@extends('beautymail::templates.minty')

@section('content')

    @include('beautymail::templates.minty.contentStart')
    <tr>
        <td class="paragraph">
            <h2>
                <strong>
                    Hi {{ $user }},
                </strong>
            </h2>
        </td>
    </tr>

    <tr>
        <td width="100%" height="4"></td>
    </tr>

    <tr>
        <td class="paragraph">
            We received a request to reset the password on your <em>eVoting</em> account.
        </td>
    </tr>

    <tr>
        <td width="100%" height="8"></td>
    </tr>

    <tr>
        <td class="paragraph">
            <h1><strong>295569</strong></h1>
        </td>
    </tr>

    <tr>
        <td width="100%" height="8"></td>
    </tr>

    <tr>
        <td class="paragraph">
            Enter this code to complete the reset.
        </td>
    </tr>

    <tr>
        <td width="100%" height="25"></td>
    </tr>

    <tr>
        <td class="paragraph">
            Thanks for helping us keep your account secure.
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
        <td width="100%" height="20"></td>
    </tr>

    <tr>
        <td class="paragraph" style="color: #777;">
            <strong>When and where this happened</strong>
        </td>
    </tr>

    <tr>
        <td width="100%" height="10"></td>
    </tr>

    <tr>
        <td class="paragraph" style="color: #777;">
            <strong>Timestamp:</strong> {{ $timestamp }}
        </td>
    </tr>

    <tr>
        <td width="100%" height="7"></td>
    </tr>

    <tr>
        <td class="paragraph" style="color: #777;">
            <strong>IP Address:</strong> {{ $clientIpAddress }}
        </td>
    </tr>

    <tr>
        <td width="100%" height="7"></td>
    </tr>

    <tr>
        <td class="paragraph" style="color: #777;">
            <strong>User Agent:</strong> {{ $clientDevice }}
        </td>
    </tr>

    <tr>
        <td width="100%" height="7"></td>
    </tr>

    <tr>
        <td class="paragraph" style="color: #777;">
            <strong>Location:</strong> {{ $locationInfo }}
        </td>
    </tr>

    <tr>
        <td width="100%" height="20"></td>
    </tr>

    <tr>
        <td class="paragraph" style="color: #777;">
            <strong>Didn't do this?</strong> Be sure to <a
                href="{{ env('APP_ENV') == 'production' ? 'http://evotin.herokuapp.com/password/reset' : 'http://localhost:8000/password/reset' }}">
                change your password</a> right away.
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
