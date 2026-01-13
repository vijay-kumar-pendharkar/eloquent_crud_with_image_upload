<!DOCTYPE html>
<html lang="en"></html>
<title>
    @yield('title','app')
</title>

@include('layouts.header')

<body>
    @yield('content')
</body>

@include('layouts.footer')