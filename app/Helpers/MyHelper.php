<?php

function makeMessagesLogin()
{
    $messages = [
        'email.required' => 'Debe ingresar su correo electrónico para iniciar sesión',
        'password.required' => 'Debe ingresar su contraseña para iniciar sesión',
        'email.email' => 'El correo electronico debe ser uno válido',
    ];
    return $messages;
}
function makeMessageRegister()
{
    $messages = [
        'name.required' => 'Debe ingresar el campo nombre del sorteador',
        'email.required' => 'Debe ingresar el correo electrónico del sorteador',
        'email.email' => 'El correo electronico debe ser uno válido',
        'age.required' => 'Debe ingresar la edad del sorteador',
        'email.unique'=> 'El correo electrónico ingresado ya existe en el sistema'
        //validar email
    ];
    return $messages;
}