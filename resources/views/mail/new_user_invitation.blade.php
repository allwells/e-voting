@include('beautymail::templates.widgets.articleStart', ['color' => '#5850ec'])
@extends('beautymail::templates.minty')

@section('content')

    @include('beautymail::templates.minty.contentStart')
    <tr>
        <td class="title">
            <h3>
                <strong>Hello {{ $recipient['first_name'] }},</strong>
            </h3>
        </td>
    </tr>

    <tr>
        <td width="100%" height="7"></td>
    </tr>

    <tr>
        <td class="paragraph">
            You are invited to participate in a private election. Login with the details below to participate in the
            election. We advice that you change your password to avoid forgetting your password.
        </td>
    </tr>

    <tr>
        <td width="100%" height="13"></td>
    </tr>

    <tr>
        <td class="title">
            <strong>Login Details:</strong>
        </td>
    </tr>

    <tr>
        <td width="100%" height="4"></td>
    </tr>

    <tr>
        <td class="paragraph">
            Email: {{ $recipient['email'] }}
        </td>
    </tr>

    <tr>
        <td width="100%" height="4"></td>
    </tr>

    <tr>
        <td class="paragraph">
            Password: {{ $genPassword }}
        </td>
    </tr>

    <tr>
        <td width="100%" height="25"></td>
    </tr>

    <tr>
        <td>
            @include('beautymail::templates.minty.button', [
                'text' => 'Go to election page',
                'link' =>
                    env('APP_ENV') == 'production'
                        ? "https://evotin.herokuapp.com/elections/$election->id"
                        : "http://localhost:8000/elections/$election->id",
            ])
        </td>
    </tr>

    <tr>
        <td width="100%" height="25"></td>
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
