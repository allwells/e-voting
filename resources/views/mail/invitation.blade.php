<html>

<head>
    <style rel="stylesheet" type="text/css">
        .body {
            width: 100% !important;
            background-color: #FFFFFF !important;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI",
                Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue",
                sans-serif;
        }

        h3,
        p {
            color: #333333 !important;
        }

        p {
            font-size: 16px;
        }

        h3 {
            font-size: 18px;
            font-weight: 600;
        }

        .header {
            width: 100% !important;
            display: flex !important;
            padding: 1rem 0 !important;
            place-items: center !important;
            height: fit-content !important;
            justify-content: center !important;
        }

        a {
            width: fit-content !important;
            height: fit-content !important;
        }

        .logo {
            width: 180px !important;
            height: 70px !important;
        }

        .main {
            width: 100% !important;
        }

        .content {
            padding: 2rem 0 !important;
            place-items: center !important;
            justify-content: center !important;
            background-color: #ffffff !important;
        }

        footer {
            width: 100% !important;
            font-size: 12px !important;
            padding: 2rem 0 !important;
            color: #555555 !important;
            text-align: center !important;
            height: fit-content !important;
        }

        .link {
            color: #333;
            padding: 1rem 2rem;
            border-radius: 5px;
            text-decoration: none;
            background-color: #f5f5f5;
        }
    </style>
</head>

<div class="body">
    <div class="header">
        <a href="https://evotin.herokuapp.com">
            <img class="logo" src="{{ asset('images/logo-tranparent.png') }}" alt="eVoting logo" />
        </a>
    </div>

    <div class="main">
        <div class="content">
            <h3 class="greeting">Hello {{ $recipient['fname'] }},</h3>
            <p class="body-text">You have been invited to participate in a provate election.</p>
            <p class="body-text">Below are your login details.</p>
        </div>

        <p>Login Details:</p>
        <p>Email: {{ $recipient['email'] }}</p>
        <p>Password: {{ $recipient['email'] }}</p>

        <a href="{{ env('APP_ENV') == 'production' ? "http://evotin.herokuapp.com/elections/$election->id" : "http://localhost:8000/elections/$election->id" }}"
            class="link" rel="noreferrer" target="_blank">View Election</a>

        <div>
            <p class="regards">Regards,</p>
            <p class="company">{{ config('app.name') }}</p>
        </div>
    </div>

    <footer>
        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </footer>
</div>

</html>
