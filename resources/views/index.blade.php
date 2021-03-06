<!doctype html>
<html ng-app="app">
<head>
    <base href="/"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="{!! asset('css/vendor.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
    <title>Расписание</title>
    <!--[if lte IE 10]>
    <script type="text/javascript">document.location.href = '/unsupported-browser'</script>
    <![endif]-->
</head>
<body layout="column" layout-fill>

    <div ui-view="header"></div>
    <md-content ui-view="main"></md-content>

    <script src="{!! asset('js/vendor.js') !!}"></script>
    <script src="{!! asset('js/partials.js') !!}"></script>
    <script src="{!! asset('js/app.js') !!}"></script>

    {{--livereload--}}
    @if ( env('APP_ENV') === 'local' )
    <script type="text/javascript">
        document.write('<script src="'+ location.protocol + '//' + (location.host.split(':')[0] || 'localhost') +':35729/livereload.js?snipver=1" type="text/javascript"><\/script>')
    </script>
    @endif
</body>
</html>
