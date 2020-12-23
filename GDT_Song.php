<?php
namespace GDO\Audio;

use GDO\DB\GDT_Object;

/**
 * A music band column.
 * @author gizmore
 */
final class GDT_Song extends GDT_Object
{
    public function defaultLabel() { return $this->label('song'); }
    
    protected function __construct()
    {
        $this->table(GDO_Song::table());
        $this->completionHref(href('Audio', 'CompleteSong'));
    }
    
}
