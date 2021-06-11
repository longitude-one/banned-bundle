<?php

namespace LongitudeOne\BannedBundle\Entity;

interface BannedInterface
{
    public function isBanned(): bool;
}
