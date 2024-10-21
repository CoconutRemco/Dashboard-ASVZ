<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container">
    <h1>MQTT Messages</h1>

    @if(count($messages) > 0)
        <ul>
            @foreach($messages as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    @else
        <p>No messages received yet.</p>
    @endif
</div>
</body>
</html>
