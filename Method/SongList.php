<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Song;
use GDO\Table\MethodQueryList;
use GDO\Audio\GDT_Band;

/**
 * List of songs.
 * @author gizmore
 * @version 6.10
 * @since 6.10
 */
final class SongList extends MethodQueryList
{
    public function gdoTable() { return GDO_Song::table(); }

    public function getDefaultOrder() { return 'song_released'; }
    public function getDefaultOrderDir() { return false; }
    
    public function gdoHeaders()
    {
        $t = $this->gdoTable();
        return [
            $t->gdoColumn('song_title'),
            $t->gdoColumn('song_lyrics'),
            $t->gdoColumn('song_description'),
            $t->gdoColumn('song_released'),
        ];
    }

    public function gdoParameters()
    {
        return [
            GDT_Band::make('song_band'),
        ];
    }
    
    public function getBandID()
    {
        return $this->gdoParameterVar('song_band');
    }
    
    public function getQuery()
    {
        $query = parent::getQuery();
        if ($bandId = $this->getBandID())
        {
            $query->where("song_band={$bandId}");
        }
        return $query;
    }

}
