<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Musician;
use GDO\Table\MethodQueryList;

final class MusicianList extends MethodQueryList
{
    public function gdoTable()
    {
        return GDO_Musician::table();
    }

}
