<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Band;
use GDO\Table\MethodQueryList;

/**
 * Display a list of bands.
 * @author gizmore
 * @version 6.10
 * @since 6.10
 */
final class BandList extends MethodQueryList
{
    public function gdoTable()
    {
        return GDO_Band::table();
    }

}
