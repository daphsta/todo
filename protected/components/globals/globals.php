<?php

/*
 * Custom Global Functions / Helpers
 */

/**
 * This function renders input array in JSON format
 * @param array $input
 */
function renderJson($input)
{
    header('Content-type: application/json');
    echo CJSON::encode($input);
    Yii::app()->end(); 
}

?>
