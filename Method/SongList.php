<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Song;
use GDO\Audio\GDT_Band;
use GDO\Table\MethodQueryList;

final class SongList extends MethodQueryList
{
    public function gdoTable()
    {
        return GDO_Song::table();
    }

    public function isOrdered() { return true; }
    public function defaultOrderField() { return 'song_created'; }
    public function defaultOrderDirAsc() { return false; }
    
    public function isFiltered() { return true; }
    
    
    public function gdoFilters()
    {
        return array(
            GDT_Band::make('song_band'),
        );
    }

}
