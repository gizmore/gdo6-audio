<?php
namespace GDO\Audio\Method;

use GDO\Table\MethodQueryCards;
use GDO\Audio\GDO_Band;

final class BandList extends MethodQueryCards
{
    public function gdoTable()
    {
        return GDO_Band::table();
    }

}
