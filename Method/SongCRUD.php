<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Song;
use GDO\Audio\MethodAudioCRUD;

final class SongCRUD extends MethodAudioCRUD
{
    public function hrefList()
    {
        return href('Audio', 'SongList');
    }

    public function gdoTable()
    {
        return GDO_Song::table();
    }
    
    
}
