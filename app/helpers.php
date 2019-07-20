<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//check that the function doesn't already exist in the Laravel helpers function package
if(!function_exists('remove_spaces'))
{
    
    /**
     * function that checks for empty string spaces and replaces them with no spaces
     * thereby removing the empty space.
     * @param type $string
     * @return type
     */
    function remove_spaces($string)
    {
        $result = str_replace(' ', '', $string);
        return $result;
    }
}
