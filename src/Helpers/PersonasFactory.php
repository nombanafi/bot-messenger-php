<?php

namespace Fakell\BotMessenger\Helpers;

use Fakell\BotMessenger\Model\Personas\Personas;

class PersonasFactory {


    /**
     * Create an list of Personas
     *
     * @param array $data
     * @return Personas[]
     */
    public static function createList(array $data = []){
        $personas = [];
        foreach($data["data"] as $p) {
            $personas [] = new Personas($p["name"], $p["profile_picture_url"], $p["id"]);
        }
        return $personas;
    }

    /**
     * Creat on Personas
     *
     * @param array $data
     * @return Personas
     */
    public static function createOne(array $data){
        return new Personas(
            $data["name"],
            $data["profile_picture_url"],
            $data["id"]
        );
    }
}