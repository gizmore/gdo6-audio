<?php
use GDO\UI\GDT_ListItem;
use GDO\UI\GDT_Link;
use GDO\Audio\GDO_Band;
use GDO\Audio\GDT_BandSubtitle;
/** @var $gdo GDO_Band **/

$list = GDT_ListItem::make('band-'.$gdo->getID());

if ($gdo->isFeatured())
{
    $list->addClass('featured');
}

// $list->avatar($gdo->gdoColumnCopy('album_cover')->variant('thumb')->imageSize(48, 48)->withFileInfo(false));
$list->title(GDT_Link::make()->rawLabel($gdo->display('band_name'))->href($gdo->hrefShow()));
$list->subtitle(GDT_BandSubtitle::make()->band($gdo));

echo $list->render();
