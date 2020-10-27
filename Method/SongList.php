<?php
namespace GDO\Audio\Method;

use GDO\Table\MethodQueryCards;
use GDO\Audio\GDO_Song;

final class SongList extends MethodQueryCards
{
    public function gdoTable()
    {
        return GDO_Song::table();
    }

}
