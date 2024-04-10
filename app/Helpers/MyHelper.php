<?php

function makeMessages()
{
    $messages = [
        'email.required' => 'El campo correo es obligatorio',
        'password.required' => 'El campo contraseña es obligatorio',
        'password.min' => 'El campo contraseña debe tener minimo 8 caracteres'
    ];
    return $messages;
}