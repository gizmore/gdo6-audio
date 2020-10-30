<?php
namespace GDO\Audio\Method;

use GDO\UI\MethodCard;
use GDO\Audio\GDO_Album;

final class AlbumView extends MethodCard
{
    public function gdoTable()
    {
        return GDO_Album::table();
    }

}
