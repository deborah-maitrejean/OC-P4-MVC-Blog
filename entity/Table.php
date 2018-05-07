<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 27/04/2018
 * Time: 21:45
 */

namespace Entity;


/**
 * Class Table
 * @package Entity
 */
class Table
{
    /**
     * @param array $data
     */
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst($key);
            $this->$setter($value);
        }
    }
}