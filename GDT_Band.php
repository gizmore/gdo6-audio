<?php
namespace GDO\Audio;

use GDO\DB\GDT_Object;

/**
 * A music band column.
 * @author gizmore
 */
final class GDT_Band extends GDT_Object
{
    public function defaultLabel() { return $this->label('band'); }
    
    public function __construct()
    {
        $this->table(GDO_Band::table());
        $this->completionHref(href('Audio', 'CompleteBand'));
    }
    
}
