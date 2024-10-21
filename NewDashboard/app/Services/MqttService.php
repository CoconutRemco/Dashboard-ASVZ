<?php

namespace App\Services;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\Exceptions\MqttClientException;
use PhpMqtt\Client\ConnectionSettings;

class MqttService
{
    protected $client;

    public function __construct()
    {
        $server = 'asvz.local'; // Your broker address
        $port = 1883; // Broker port
        $clientId = 'dashboard_client';

        $this->client = new MqttClient($server, $port, $clientId);
        $settings = (new ConnectionSettings)
            ->setUsername('asvz')
            ->setPassword('asvz');

        try {
            $this->client->connect($settings);
        } catch (MqttClientException $e) {
            report($e);
        }
    }

    public function subscribeToAvailableDevices($callback)
    {
        try {
            $this->client->subscribe('available_devices', function ($topic, $message) use ($callback) {
                $callback($message);
            }, 0);

            // Use a loop that checks for incoming messages without blocking
            while (true) {
                $this->client->loop();
                usleep(50000); // Sleep for 50ms
            }
        } catch (MqttClientException $e) {
            report($e);
        }
    }

    public function disconnect()
    {
        $this->client->disconnect();
    }
}
