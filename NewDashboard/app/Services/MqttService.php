<?php

namespace App\Services;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class MqttService
{
    protected $mqttClient;

    public function __construct()
    {
        // Replace 'your-mqtt-broker-address' with the actual address of your broker, e.g., 'asvz.local'
        $this->mqttClient = new MqttClient('asvz.local', 1883, 'client-id');
    }

    public function connect()
    {
        // Set the correct credentials for your broker
        $connectionSettings = (new ConnectionSettings)
            ->setUsername('asvz')
            ->setPassword('asvz');

        $this->mqttClient->connect($connectionSettings, true);
    }

    public function subscribeToAvailableDevices(callable $callback)
    {
        $this->connect();
        $this->mqttClient->subscribe('available_devices', function (string $topic, string $message) use ($callback) {
            $callback($message);
        });
        $this->mqttClient->loop(true);
    }

    public function publishMessage($message)
    {
        $this->connect();
        $this->mqttClient->publish('available_devices', $message);
        $this->mqttClient->disconnect();
    }
}
