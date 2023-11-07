<?php

namespace Fakell\BotMessenger\Helpers;

use Fakell\BotMessenger\Model\Personas\Personas;

class PersonasListFactory {


    /**
     * Create an list of Personas
     *
     * @param array $data
     * @return Personas[]
     */
    public static function create(array $data = []){
        $personas = [];
        foreach($data["data"] as $p) {
            $personas [] = new Personas($p["name"], $p["profile_picture_url"], $p["id"]);
        }
        return $personas;
    }
}