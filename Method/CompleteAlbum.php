<?php
namespace GDO\Audio\Method;

use GDO\Core\GDO;
use GDO\Core\MethodCompletion;
use GDO\Audio\GDO_Album;

/**
 * Generic completion for music albums.
 * 
 * @author gizmore
 * @version 6.10
 * @since 6.10
 *
 * @see GDT_Table
 */
final class CompleteAlbum extends MethodCompletion
{
    public function gdoTable()
    {
        return GDO_Album::table();
    }
    
    public function gdoQuery()
    {
        return parent::gdoQuery()->where('album_deleted IS NULL');
    }
    
    public function gdoHeaderColumns()
    {
        return $this->gdoTable()->getGDOColumns(['album_title', 'album_genre', 'album_band', 'album_country']);
    }
    
    public function renderJSON(GDO $gdo)
    {
        return array(
            'id' => $gdo->getID(),
            'text' => $gdo->displayName(),
            'display' => $gdo->renderChoice(),
        );
    }

    
}
