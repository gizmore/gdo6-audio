<?php
namespace GDO\Audio;

use GDO\Core\GDO;
use GDO\DB\GDT_Object;

/**
 * Relation between albums and songs.
 * @author gizmore
 */
final class GDO_AlbumSong extends GDO
{
    public function gdoColumns()
    {
        return array(
            GDT_Object::make('as_album')->table(GDO_Album::table())->primary(),
            GDT_Object::make('as_song')->table(GDO_Song::table())->primary(),
        );
    }
    
}
