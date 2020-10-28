<?php
namespace GDO\Audio;

use GDO\DB\GDT_Object;

final class GDT_Musician extends GDT_Object
{
    public function defaultLabel() { return $this->label('musician'); }
    
    public function __construct()
    {
        $this->table(GDO_Musician::table());
        $this->completionHref(href('Audio', 'CompleteMusician'));
    }
    
}
