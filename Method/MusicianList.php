<?php
namespace GDO\Audio\Method;

use GDO\Table\MethodQueryCards;
use GDO\Audio\GDO_Musician;

final class MusicianList extends MethodQueryCards
{
    public function gdoTable()
    {
        return GDO_Musician::table();
    }

}
