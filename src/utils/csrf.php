<?php

class CsrfUtil {

    public static function getToken($self, $request) {
        $nameKey = $self->csrf->getTokenNameKey();
        $valueKey = $self->csrf->getTokenValueKey();
        $name = $request->getAttribute($nameKey);
        $value = $request->getAttribute($valueKey);

        $tokenArray = [
            'nameKey' => $nameKey,
            'valueKey' => $valueKey,
            'name' => $name,
            'value' => $value,
            'username' => Authorization::getSession('username'),
            'hostname' => IPUtil::getHostName(),
            'enpoint' => 'manager',
            'date' => date("l jS \of F Y h:i:s A")
        ];
        return $tokenArray;
    }

}