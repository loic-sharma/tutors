<?php

Validator::register('umemail', function($attribute, $value, $parameters)
{
    return (strpos($value, '@umich.edu') !== false);
});