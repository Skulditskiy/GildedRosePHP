<?php

require_once "vendor/autoload.php";

use GildedRose\Item;
use GildedRose\ItemConjurable;

$app = new \GildedRose\Program(
    [
        new Item(['name' => "+5 Dexterity Vest",'sellIn' => 10,'quality' => 20]),
        new Item(['name' => "Aged Brie",'sellIn' => 2,'quality' => 0]),
        new Item(['name' => "Elixir of the Mongoose",'sellIn' => 5,'quality' => 7]),
        new Item(['name' => "Sulfuras, Hand of Ragnaros",'sellIn' => 0,'quality' => 80]),
        new Item([
            'name' => "Backstage passes to a TAFKAL80ETC concert",
            'sellIn' => 15,
            'quality' => 20
        ]),
        new ItemConjurable(['name' => "Conjured Mana Cake",'sellIn' => 3,'quality' => 6, 'conjured' => true]),
    ]
);

$app->main();
