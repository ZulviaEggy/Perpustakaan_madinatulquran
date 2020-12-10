<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of helpers
 *
 * @author Herzi
 */
function setActive($path, $active = 'active') {
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}
/*
function alert($message = null, $title = '') {
    return call_user_func_array('Alert::', $path.';
}
*/
function setShow($path, $show = 'show') {
    return call_user_func_array('Request::is', (array)$path) ? $show : '';
}

