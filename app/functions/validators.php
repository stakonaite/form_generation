<?php

function validate_login($filtered_input, &$form)
{
    $logged_in = \App\App::$session->login(
        $filtered_input['email'],
        $filtered_input['password']
    );

    if (!$logged_in) {
        $form['fields']['email']['error'] = 'Prisijungimo duomenys neteisingi!';
        $form['fields']['password']['value'] = '';
        return false;
    }

    return true;
}

function validate_mail($field_value, &$field)
{
    $modelUser = new \App\Users\Model();
    $users = $modelUser->get(['email' => $field_value]);
    if ($users) {
        $field['error'] = 'Vartotojas tokiu el.paštu jau registruotas!';
        return false;
    }

    return true;
}