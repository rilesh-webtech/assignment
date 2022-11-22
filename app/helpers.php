<?php
/**
 * File name: helpers.php
 * Last modified: 14/06/21, 5:27 PM
 * Author: NearCraft - https://codecanyon.net/user/nearcraft
 * Copyright (c) 2021
 */

if(!function_exists('get_xml_file_to_array')) {
    /**
     * Format Question for the Exam
     * @param $question
     * @param $qType
     * @return null|string|string[]
     */
    function get_xml_file_to_array($path) {

        $xmlfile = file_get_contents($path);
        $xmlObject = simplexml_load_string($xmlfile);
        $json = json_encode($xmlObject);
        return json_decode($json, true);
        
    }
}