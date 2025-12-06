<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use App\Models\MqttData;

class MqttSubscriber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to MQTT broker and store data to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $server = '8288748b7bcb4d358e2ebbccd07b5cce.s1.eu.hivemq.cloud';
        $port = 8883;
        $username = 'EnerNeo';
        $password = 'EnerNeo123';
        
        $this->info('Connecting to MQTT broker...');
        
        $mqtt = new MqttClient($server, $port, uniqid('laravel_'));
        
        $connectionSettings = (new ConnectionSettings)
            ->setUsername($username)
            ->setPassword($password)
            ->setUseTls(true)
            ->setTlsSelfSignedAllowed(true);
        
        try {
            $mqtt->connect($connectionSettings, true);
            $this->info('Connected to MQTT broker successfully!');
            
            // Subscribe ke semua topic enerneo/user_1/#
            $mqtt->subscribe('enerneo/user_1/#', function ($topic, $message) {
                $this->info("Received: {$topic} => {$message}");
                
                // Parse topic: enerneo/user_1/{type}/{metric}
                $parts = explode('/', $topic);
                
                if (count($parts) === 4) {
                    $type = $parts[2];    // load, pv, batt
                    $metric = $parts[3];  // voltage, current, power, energy, frequency, pf
                    
                    // Skip jika value adalah "nan" atau tidak valid
                    if (strtolower($message) === 'nan' || trim($message) === '') {
                        $this->warn("⚠️ Skipping invalid value for {$topic}: {$message}");
                        return;
                    }
                    
                    $value = (float) $message;
                    
                    // Simpan atau update data
                    MqttData::updateOrCreate(
                        [
                            'user_id' => 'user_1',
                            'type' => $type,
                            'metric' => $metric
                        ],
                        [
                            'value' => $value
                        ]
                    );
                    
                    $this->line("✅ Saved: {$type}/{$metric} = {$value}");
                }
            }, 0);
            
            $this->info('Subscribed to enerneo/user_1/# - Listening for messages...');
            $mqtt->loop(true);
            
        } catch (\Exception $e) {
            $this->error('MQTT Error: ' . $e->getMessage());
        }
    }
}
