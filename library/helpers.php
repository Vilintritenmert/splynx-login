<?php

if(!function_exists('array_only')){

    /**
     * White list for array
     *
     * @param $array
     * @param $keys
     * @return array
     */
    function array_only($array, $keys){

        return array_intersect_key($array, array_flip((array) $keys));
    }
}