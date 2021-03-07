<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value'
    ];



    public static function get($key){
        $setting = self::query()->where('key', $key)->first();
        if(!$setting){
            return ;
        }
        return $setting->value;
    }

    public function set($key, $value = null){
        $setting = self::query()->where('key', $key)->firstOrFail();
        $setting->value = $value;
        $setting->saveOrFail();
        Config::set($key, $value);
        
        if(Config::get($key) == $value){
            return true;
        }
        return false;
    }


}
