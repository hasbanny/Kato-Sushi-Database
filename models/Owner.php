<?php

use Base\Owner as BaseOwner;

/**
 * Skeleton subclass for representing a row from the 'owner' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Owner extends BaseOwner
{
    public function setPassword($p){
        $hash = password_hash($p, PASSWORD_DEFAULT);
        return $hash;
    }

    public function login($pass){
        if (password_verify($pass, $this->getPasswordHash())) {
            return true;
        } else {
            return false;
        }
    }
}
