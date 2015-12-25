<!DOCTYPE html>
<html>
    <head>
        <title>{{ trans('ui.title') }}</title>
        <meta charset="utf-8">

        <style>
            html, body {
                height: 100%;

            }
            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-family: "Helvetica Neue", Helvetica, Arial, "Microsoft Jhenghei", sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }

            a {
                color: black;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">{{ trans('ui.title') }}<br/><a href="/register">進入報名系統</a></div>
            </div>
        </div>
    </body>
</html>
