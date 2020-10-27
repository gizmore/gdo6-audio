<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Band;
use GDO\Audio\MethodAudioCRUD;

final class BandCRUD extends MethodAudioCRUD
{
    public function hrefList()
    {
        return href('Audio', 'BandList');
    }

    public function gdoTable()
    {
        return GDO_Band::table();
    }
    
}
