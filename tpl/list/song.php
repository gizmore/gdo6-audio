<?php
use GDO\UI\GDT_ListItem;
use GDO\UI\GDT_Link;
use GDO\Audio\GDO_Song;
use GDO\Audio\GDT_SongSubtitle;
/** @var $gdo GDO_Song **/

$list = GDT_ListItem::make('band-'.$gdo->getID());

if ($gdo->isFeatured())
{
    $list->addClass('featured');
}

// $list->avatar($gdo->gdoColumnCopy('album_cover')->variant('thumb')->imageSize(48, 48)->withFileInfo(false));
$list->title(GDT_Link::make()->rawLabel($gdo->display('song_title'))->href($gdo->hrefShow()));
$list->subtitle(GDT_SongSubtitle::make()->song($gdo));

echo $list->render();
