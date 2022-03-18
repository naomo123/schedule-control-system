<?php
    function isEmpty($field){
        return empty(trim($field));
    }

    function isText($field){
        return preg_match('/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/', $field);
    }

    function isEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    function isLicense($field){
        return preg_match('/^[A-Z]{2}[0-9]{6}+$/', $field);
    }

    function isTelephone($field){
        return preg_match('/^[267][0-9]{3}-?[0-9]{4}$/', $field);
    }

    function isEditorialCode($field){
        return preg_match('/^EDI[0-9]{3}$/', $field);
    }    
    
    function isAuthorCode($field){
        return preg_match('/^AUT[0-9]{3}$/', $field);
    }