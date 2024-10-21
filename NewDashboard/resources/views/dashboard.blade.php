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
    <h1>MQTT Dashboard</h1>

    <h2>Send a Message</h2>
    <form action="{{ route('send.message') }}" method="POST">
        @csrf
        <input type="text" name="message" placeholder="Enter message to send" required>
        <button type="submit">Send Message</button>
    </form>

    <h2>Received Messages</h2>
    <ul>
        @forelse ($messages as $msg)
            <li>{{ $msg }}</li>
        @empty
            <li>No messages received yet.</li>
        @endforelse
    </ul>
</div>
</body>
</html>
