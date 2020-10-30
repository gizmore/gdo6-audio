<?php
namespace GDO\Audio\Method;

use GDO\UI\MethodCard;
use GDO\Audio\GDO_Musician;

final class MusicianShow extends MethodCard
{
    public function gdoTable()
    {
        return GDO_Musician::table();
    }

}
