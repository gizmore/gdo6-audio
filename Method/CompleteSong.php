<?php
namespace GDO\Audio\Method;

use GDO\Core\GDO;
use GDO\Audio\GDO_Song;
use GDO\Core\MethodCompletionSearch;

/**
 * Generic completion for music songs.
 * 
 * @author gizmore
 * @version 6.10
 * @since 6.10
 *
 * @see GDT_Table
 * @see MethodCompletion
 */
final class CompleteSong extends MethodCompletionSearch
{
    public function gdoTable()
    {
        return GDO_Song::table();
    }
    
    public function gdoQuery()
    {
        return parent::gdoQuery()->where('song_deleted IS NULL');
    }
    
    public function gdoHeaderColumns()
    {
        return $this->gdoTable()->getGDOColumns(['song_title', 'song_band', 'song_genre', 'song_language', 'song_lyrics', 'song_bpm']);
    }
    
    public function renderJSON(GDO $gdo)
    {
        /** @var $gdo GDO_Song **/
        return array(
            'id' => $gdo->getID(),
            'text' => $gdo->displayTitle(),
            'display' => $gdo->renderChoice(),
        );
    }

}
