<?php
namespace GDO\Audio\Method;

use GDO\Core\GDO;
use GDO\Audio\GDO_Band;
use GDO\Core\MethodCompletionSearch;

/**
 * Generic completion for music bands.
 * 
 * @author gizmore
 * @version 6.10
 * @since 6.10
 *
 * @see GDT_Table
 */
final class CompleteBand extends MethodCompletionSearch
{
    public function gdoTable()
    {
        return GDO_Band::table();
    }
    
    public function gdoQuery()
    {
        return parent::gdoQuery()->where('band_deleted IS NULL');
    }
    
    public function gdoHeaderColumns()
    {
        return $this->gdoTable()->getGDOColumns(['band_name', 'band_genre', 'band_country']);
    }
    
    public function renderJSON(GDO $gdo)
    {
        /** @var $gdo GDO_Band **/
        return array(
            'id' => $gdo->getID(),
            'text' => $gdo->displayName(),
            'display' => $gdo->renderChoice(),
        );
    }

    
}
