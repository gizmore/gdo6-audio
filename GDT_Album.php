<?php
namespace GDO\Audio;

use GDO\DB\GDT_Object;

final class GDT_Album extends GDT_Object
{
    public function defaultLabel() { return $this->label('album'); }
    
    protected function __construct()
    {
        $this->table(GDO_Album::table());
        $this->completionHref(href('Audio', 'CompleteAlbum'));
    }
    
}
