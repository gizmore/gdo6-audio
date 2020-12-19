<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Album;
use GDO\Table\MethodQueryList;

final class AlbumList extends MethodQueryList
{
    public function gdoTable() { return GDO_Album::table(); }
    
    public function gdoHeaders()
    {
        return $this->gdoTable()->gdoColumnsExcept(...['album_id', 'album_cover']);
    }

    public function getDefaultOrder()
    {
        return 'album_created';
    }
    
    public function getDefaultOrderDir()
    {
        return false;
    }
    
    
}
