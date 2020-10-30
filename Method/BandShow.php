<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Band;
use GDO\UI\MethodCard;

final class BandShow extends MethodCard
{
    public function gdoTable()
    {
        return GDO_Band::table();
    }

}
