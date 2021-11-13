<?php

/**
 * Description of Validacoes
 * @author felipe
 */
class Validacoes {

    public static function verificaTamanho($campo, $texto, int $min, int $max) {

        if (!is_null($texto)) {
            $length = strlen($texto);
            if ($length < $min) {
                throw InvalidArgumentException("Tamanho minimo deve do campo " . $campo . " ser de " . $min);
            } else if ($length > $max) {
                throw InvalidArgumentException("Tamanho maximo deve do campo " . $campo . " ser de " . $max);
            }
        } else {
            throw InvalidArgumentException("O campo  " . $campo . " nao pode ser vazio");
        }
    }

}
