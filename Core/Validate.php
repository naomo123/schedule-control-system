<?php
    function isEmpty($field){
        return empty(trim($field));
    }

    function isText($field){
        return is_string($field);
    }

    function isEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    function isLicense($field){
        return preg_match('/^[0-9]{8}-[0-9]{1}$/', $field);
    }

    function isTelephone($field){
        return preg_match('/^[267][0-9]{3}-?[0-9]{4}$/', $field);
    }

    function isCode($field){
        return preg_match('/^E[0-9]{5}$/', $field);
    }    
    
    function isAuthorCode($field){
        return preg_match('/^AUT[0-9]{3}$/', $field);
    }