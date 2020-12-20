<?php
namespace GDO\Audio;

use GDO\UI\GDT_Container;
use GDO\UI\GDT_Label;
use GDO\UI\GDT_Link;

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
            $this->addField(GDT_Label::make()->label($this->band->displayName()));
            $this->addField(GDT_Label::make()->label('founded'));
            $this->addField($this->band->gdoColumn('band_founded'));
            $this->addField(GDT_Link::make('num_albums')->href($this->band->hrefAlbums())->label('num_albums', [$this->band->getVar('band_albums')]));
            $this->addField(GDT_Link::make('num_songs')->href($this->band->hrefSongs())->label('num_songs', [$this->band->getVar('band_songs')]));
        }
    }
    
}
