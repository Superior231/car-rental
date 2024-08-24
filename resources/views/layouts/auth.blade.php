<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('components.styles')
</head>

<body class="bg-soft-blue">

    <div class="container">
        @include('components.toast')
        <div class="row align-items-center justify-content-center py-5" style="min-height: 100vh">
            <div class="col-md-5">
                @yield('content')
            </div>
        </div>
    </div>

    @include('components.scripts')
</body>

</html>
