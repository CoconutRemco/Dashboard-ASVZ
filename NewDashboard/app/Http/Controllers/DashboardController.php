<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Fetch messages from the cache
        $messages = cache()->get('mqtt_messages', []);

        // Return the dashboard view
        return view('dashboard', ['messages' => $messages]);
    }
}
