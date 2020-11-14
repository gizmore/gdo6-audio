<?php
namespace GDO\Audio\Method;

use GDO\Core\GDO;
use GDO\Audio\GDO_Musician;
use GDO\Core\MethodCompletionSearch;

/**
 * Generic completion for musicians.
 * 
 * @author gizmore
 * @version 6.10
 * @since 6.10
 *
 * @see GDT_Table
 */
final class CompleteMusician extends MethodCompletionSearch
{
    public function gdoTable()
    {
        return GDO_Musician::table();
    }
    
    public function getQuery()
    {
        return parent::getQuery()->where('musician_deleted IS NULL');
    }
    
    public function gdoHeaderColumns()
    {
        return $this->gdoTable()->getGDOColumns(['musician_name', 'musician_country']);
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
