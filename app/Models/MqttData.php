<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MqttData extends Model
{
    protected $table = 'mqtt_data';
    protected $fillable = ['user_id', 'type', 'metric', 'value'];
}
