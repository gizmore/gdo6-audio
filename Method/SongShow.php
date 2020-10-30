<?php
namespace GDO\Audio\Method;

use GDO\UI\MethodCard;
use GDO\Audio\GDO_Song;

final class SongShow extends MethodCard
{
    public function gdoTable()
    {
        return GDO_Song::table();
    }

}
