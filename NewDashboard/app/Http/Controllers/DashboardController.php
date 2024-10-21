<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MqttService;

class DashboardController extends Controller
{
    public function index()
    {
        // Retrieve MQTT messages from the session
        $messages = session('mqtt_messages', []);

        // Return the messages to the dashboard view
        return view('dashboard', ['messages' => $messages]);
    }

    public function sendMessage(Request $request, MqttService $mqttService)
    {
        // Validate message input
        $request->validate([
            'message' => 'required|string',
        ]);

        // Send the message via MQTT
        $mqttService->publishMessage($request->message);

        // Redirect back to the dashboard
        return redirect()->route('dashboard');
    }
}
