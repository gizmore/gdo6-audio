<?php
namespace GDO\Audio\Method;

use GDO\Table\MethodQueryCards;
use GDO\Audio\GDO_Album;

final class AlbumList extends MethodQueryCards
{
    public function gdoTable()
    {
        return GDO_Album::table();
    }

}
