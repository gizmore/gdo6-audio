<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Album;
use GDO\Table\MethodQueryList;
use GDO\Audio\GDT_Band;

/**
 * List albums.
 * Prefilter by band.
 * @author gizmore
 * @since 6.10
 */
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
    
    public function gdoParameters()
    {
        return [
            GDT_Band::make('album_band'),
        ];
    }
    
    public function getBandID()
    {
        return (int) $this->gdoParameterVar('album_band');
    }
    
    public function getQuery()
    {
        $query = parent::getQuery();
        if ($bandId = $this->getBandID())
        {
            $query->where("album_band={$bandId}");
        }
        return $query;
    }
    
}
