<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('list_options')) {
    function list_options($options, $keyName, $valueName,$default=null)
    {
        $result = [];
        if(!is_null($default))
            $result[''] = $default;
        if (count($options) > 0) {
            foreach ($options as $option) {
                $result[$option[$keyName]] = $option[$valueName];
            }
        }
        return $result;
    }
}