<?php
namespace GDO\Audio;

use GDO\UI\GDT_Message;

/**
 * Lyrics is just a message.
 * 
 * @author gizmore
 * @version 6.10
 * @since 6.10
 */
final class GDT_Lyrics extends GDT_Message
{
    public function defaultLabel() { return $this->label('lyrics'); }

    protected function __construct()
    {
        $this->addClass('gdt-lyrics');
    }
    
}
