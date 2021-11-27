<?php
use GDO\UI\GDT_ListItem;
use GDO\UI\GDT_Link;
use GDO\Audio\GDO_Musician;
use GDO\Audio\GDT_MusicianSubtitle;
/** @var $gdo GDO_Musician **/

$list = GDT_ListItem::make('musician-'.$gdo->getID());

if ($gdo->isFeatured())
{
    $list->addClass('featured');
}

$list->avatar($gdo->gdoColumnCopy('musician_photo')->variant('thumb')->previewHREF(href('Audio', 'MusicianPhoto', '&file={id}'))->imageSize(48, 48)->withFileInfo(false));
$list->title(GDT_Link::make()->labelRaw($gdo->display('musician_name'))->href($gdo->hrefShow()));
$list->subtitle(GDT_MusicianSubtitle::make()->musician($gdo));

echo $list->render();
