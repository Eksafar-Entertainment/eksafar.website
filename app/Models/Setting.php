<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = ["key", "value"];

    public static function getAll(){
        $RAWsettings = Setting::get();
        $settings = new stdClass();
        foreach($RAWsettings as $setting){
            $key = $setting->key;
            $value = $setting->value;
            try{
                $value = json_decode($value);
            } catch(Exception $err){

            }
            $settings->$key = $value;
        }
        return $settings;
    }
    public static function getSetting($key){
        $setting = Setting::where("key", $key)->first();
        if(!$setting) return null;
        try{
            return json_decode($setting->value);
        } catch(Exception $err){
            return $setting->value;
        }
    }

    public static function saveSetting($key, $value){
        $setting = Setting::where("key", $key)->first() ?? new Setting(["key"=> $key]);
        try{
            $setting->value = json_encode($value);
        } catch(Exception $err){
            $setting->value = $value;
        }
        $setting->save();
        return $setting->value;
    }
}
