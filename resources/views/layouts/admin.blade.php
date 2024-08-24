<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('components.styles')
</head>

<body class="bg-soft-blue">
    @include('components.sidebar')
    @include('components.toast')
    @yield('content')
    @include('components.scripts')
</body>

</html>
