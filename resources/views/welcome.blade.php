<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
<div id='app'>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>title</th>
            <th>date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($deliveries as $delivery)
        <tr>
            <td>{{ $delivery->id }}</td>
            <td>{{ $delivery->title }}</td>
            <td>{{ $delivery->date }}</td>

        </tr>
        @endforeach

        </tbody>
    </table>
<hr/>
<h3>Create draggable</h3>
<table-draggable :deliveries="{{ $deliveries }}"></table-draggable>
</div>
</body>
<script src="{{asset('/js/app.js')}}" crossorigin="anonymous"></script>
</html>
