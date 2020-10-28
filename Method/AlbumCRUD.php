<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Album;
use GDO\Audio\MethodAudioCRUD;

final class AlbumCRUD extends MethodAudioCRUD
{
    public function hrefList()
    {
        return href('Audio', 'AlbumList');
    }

    public function gdoTable()
    {
        return GDO_Album::table();
    }
    
}