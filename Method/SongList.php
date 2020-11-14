<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Song;
use GDO\Table\MethodQueryList;

/**
 * List of songs.
 * @author gizmore
 * @version 6.10
 * @since 6.10
 */
final class SongList extends MethodQueryList
{
    public function gdoTable() { return GDO_Song::table(); }

    public function getDefaultOrder() { return 'song_created'; }
    public function getDefaultOrderDir() { return false; }
    
    public function gdoHeaders()
    {
        $t = $this->gdoTable();
        return [
            $t->gdoColumn('song_title'),
            $t->gdoColumn('song_lyrics'),
            $t->gdoColumn('song_description'),
        ];
    }

}
