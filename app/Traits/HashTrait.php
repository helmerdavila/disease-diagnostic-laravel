<?php

namespace Tesis\Traits;

use Hashids;

/**
 * The Hashids trait, return first hashed element or 404
 */
trait HashTrait
{
    public function encode($id)
    {
        $encoded = Hashids::encode($id);

        return $encoded;
    }

    public function decode($hashed)
    {
        $decoded = array_get(Hashids::decode($hashed), 0, null);

        if (is_null($decoded)) {
            abort(404);
        }

        return $decoded;
    }
}
