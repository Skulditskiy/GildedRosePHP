<?php

namespace GildedRose;

/**
 * Class ItemConjurable
 * @package GildedRose
 */
class ItemConjurable extends Item
{
    /**
     * Indicated whether item is conjured or not. No explicit getter or setter,
     * @see parent::__construct
     *
     * @var bool
     */
    public $conjured;

}

