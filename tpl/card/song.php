<?php
use GDO\Audio\GDO_Song;

$card = GDT_Card::make('card-' . $gdo->getID());

$card->title($gdo->displayTitle());
$card->subtitle(t('song_subtitle', []));
echo $card->render();