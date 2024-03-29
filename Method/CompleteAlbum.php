<?php
namespace GDO\Audio\Method;

use GDO\Core\GDO;
use GDO\Audio\GDO_Album;
use GDO\Core\MethodCompletionSearch;

/**
 * Generic completion for music albums.
 * 
 * @author gizmore
 * @version 6.10.6
 * @since 6.10.0
 *
 * @see GDT_Table
 */
final class CompleteAlbum extends MethodCompletionSearch
{
    public function gdoTable()
    {
        return GDO_Album::table();
    }
    
    public function getQuery()
    {
        return parent::getQuery()->where('album_deleted IS NULL');
    }
    
    public function gdoHeaderColumns()
    {
        return $this->gdoTable()->getGDOColumns(['album_title', 'album_genre', 'album_band', 'album_country']);
    }
    
    public function renderJSON(GDO $gdo)
    {
        /** @var $gdo GDO_Album **/
        return [
            'id' => $gdo->getID(),
            'text' => $gdo->displayTitle(),
            'display' => $gdo->renderChoice(),
        ];
    }
    
}
