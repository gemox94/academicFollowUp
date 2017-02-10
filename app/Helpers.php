<?php
/******************************************
 *
 * ESTA LIBRERIA ES PARA COLOCAR FUNCIONES QUE SE UTILICEN
 * YA SEA EN LOS CONTROLADORES O EN LAS VISTAS
 *
 ******************************************/


/*
 * Checar por alertas.
 * Esta funcion checa si Session tiene una alerta.
 * Esta funcion se llamaria desde una vista para desplegar
 * la alerta.
 */
// ESTE ES EL CODIGO DE EJEMPLO QUE SE UTILIZARIA EN EL BACKEND
// PARA GENERAR UNA ALERTA
//$request->session()->flash('alert', array('msg'   => 'Inicie sesión con su correo: "'.$usuario->email.'"',
//                                          'tipo'  => 'success',
//                                          'quick' => 'Registro exitoso!'));
function get_alert(){
    if(Session::has('alert')){
        echo '<div class="alert alert-'.Session::get('alert')['tipo'].'">
                    <strong>'.Session::get('alert')['quick'].'</strong>
                    <br>
                    '.Session::get('alert')['msg'].'
                </div>';
    }
}


/*
 * Generate random string
 */
function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
