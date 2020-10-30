<?php
namespace GDO\Audio;

use GDO\Core\GDO;
use GDO\DB\GDT_AutoInc;
use GDO\DB\GDT_UInt;

final class GDO_SongAlbum extends GDO
{
    public function gdoColumns()
    {
        return array(
            GDT_AutoInc::make('sa_id'),
            GDT_Album::make('sa_album')->notNull(),
            GDT_Song::make('sa_song')->notNull(),
            GDT_UInt::make('sa_track')->bytes(1),
        );
    }
    
    /**
     * @param GDO_Album $album
     * @return GDO_Song[]
     */
    public static function getSongs(GDO_Album $album)
    {
        return self::table()->
        select('gdo_song.*, sa_track')->
        joinObject('sa_song')->
        where('sa_album='.$album->getID())->
        order('sa_track')->
        exec()->
        fetchAllObjectsAs(GDO_Song::table());
    }
    
    public static function addTrack(GDO_Album $album, GDO_Song $song, $track=null)
    {
        self::blank(array(
            'sa_album' => $album->getID(),
            'sa_song' => $song->getID(),
            'sa_track' => $track === null ? self::getNextTrackNumber($album) : $track,
        ))->insert();
    }
    
    public static function getNextTrackNumber(GDO_Album $album)
    {
        return self::table()->select('COUNT(sa_song)+1')->where("sa_album={$album->getID()}")->first()->exec()->fetchValue();
    }
    
}
