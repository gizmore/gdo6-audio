<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Band;
use GDO\Table\MethodQueryList;

final class BandList extends MethodQueryList
{
    public function gdoTable()
    {
        return GDO_Band::table();
    }

}
