<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Album;
use GDO\Table\MethodQueryList;
use GDO\Audio\GDT_Band;

final class AlbumList extends MethodQueryList
{
    public function gdoTable() { return GDO_Album::table(); }
    public function isFiltered() { return true; }
    public function gdoFilters()
    {
        return [
            GDT_Band::make('album_band'),
        ];
    }
    

}
