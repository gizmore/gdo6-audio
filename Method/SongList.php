<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Song;
use GDO\Audio\GDT_Band;
use GDO\Table\MethodQueryList;
use GDO\Audio\GDT_Song;

final class SongList extends MethodQueryList
{
    public function gdoTable()
    {
        return GDO_Song::table();
    }
    
    public function isFiltered() { return true; }
    
    public function gdoFilters()
    {
        return array(
            GDT_Band::make('song_band'),
        );
    }

}
