<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Album;
use GDO\Table\MethodQueryList;

final class AlbumList extends MethodQueryList
{
    public function gdoTable()
    {
        return GDO_Album::table();
    }

}
