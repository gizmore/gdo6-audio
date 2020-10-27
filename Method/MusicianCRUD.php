<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Musician;
use GDO\Audio\MethodAudioCRUD;

final class MusicianCRUD extends MethodAudioCRUD
{
    public function hrefList()
    {
        return href('Audio', 'MusicianList');
    }

    public function gdoTable()
    {
        return GDO_Musician::table();
    }
    
}
