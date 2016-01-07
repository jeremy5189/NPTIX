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
                margin-top: 50px;
                font-size: 60px;
            }
            img {
                margin-top: -10px;
                margin-bottom: 50px;
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
                <div class="title">{{ trans('ui.title') }}<br/>
                    <?php if( time() < env('START_TIME') ) { ?>
                        <a href="#">尚未開放報名</a>
                    <?php } else { ?>
                        <a href="/register">進入報名系統</a>
                    <?php } ?>
                </div>
                <a href="/upload/poster.jpg"><img src="/upload/poster.jpg" width="600" alt=""></a>
            </div>
        </div>
    </body>
</html>
