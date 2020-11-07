<?php
namespace GDO\Audio;

use GDO\UI\GDT_Container;

/**
 * Used as subtitle in cards and lists.
 * Shows BandCountry + BandTitle + FoundingDate
 * 
 * @author gizmore
 * @version 6.10
 * @since 6.10
 */
final class GDT_BandSubtitle extends GDT_Container
{
    public $band;
    public function band(GDO_Band $band=null) { $this->band =  $band; return $this; }
    
    public function __construct()
    {
        $this->horizontal();
    }
    
    public function renderCell()
    {
        $this->beforeRender();
        return parent::renderCell();
    }
    
    private function beforeRender()
    {
        if ( (!$this->getFields()) && ($this->band) )
        {
            $this->addField($this->band->gdoColumn('band_country')->withName(false));
            $this->addField($this->band->gdoColumn('band_name'));
            $this->addField($this->band->gdoColumn('band_founded'));
        }
    }
    
}
