<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Song;
use GDO\Table\MethodQueryList;

final class SongList extends MethodQueryList
{
    public function gdoTable()
    {
        return GDO_Song::table();
    }

}
