<?php
namespace GDO\Audio;

use GDO\Core\GDO;
use GDO\DB\GDT_AutoInc;

/**
 * Relation table for song<=>musician
 * @author gizmore
 * @version 6.10
 * @since 6.10
 */
final class GDO_SongMusician extends GDO
{
    public function gdoColumns()
    {
        return array(
            GDT_AutoInc::make('sm_id'),
            GDT_Song::make('sm_song')->notNull(),
            GDT_Musician::make('sm_musician')->notNull(),
            GDT_Instrument::make('sm_instrument')->notNull(),
        );
    }
    
    public static function getSongs(GDO_Musician $musician)
    {
        return self::table()->select('sm_song_t.*, sm_instrument')->joinObject('sm_song')->fetchTable(GDO_Song::table())->where("sm_musician={$musician->getID()}")->exec()->fetchAllObjects();
    }

    public static function getMusicians(GDO_Song $song)
    {
        return self::table()->select('sm_musician_t.*, sm_instrument')->joinObject('sm_musician')->fetchTable(GDO_Musician::table())->where("sm_song={$song->getID()}")->exec()->fetchAllObjects();
    }
    
    public static function connectMusician(GDO_Song $song, GDO_Musician $musician, GDT_Instrument $instrument)
    {
        self::blank(array(
            'sm_song' => $song->getID(),
            'sm_musician' => $musician->getID(),
            'sm_instrument' => $instrument->getVar(),
        ))->insert();
    }

}
