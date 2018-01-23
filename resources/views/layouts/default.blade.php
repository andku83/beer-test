<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
<div class="container">

    <header class="row">
        @include('includes.header')
    </header>

    <div id="main" class="row">

        @if(($alert = request()->session()->get('alert')) != '')
            <div class="alert-{{ $alert['class'] }} alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="main">
            @yield('content')
        </div>

    </div>

</div>

@include('includes.footer')

</body>
</html>