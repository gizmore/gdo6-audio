<?php
namespace GDO\Audio;

use GDO\UI\GDT_Container;
use GDO\UI\GDT_Label;
use GDO\UI\GDT_Link;

/**
 * Used as subtitle in cards and lists.
 * Shows BandCountry + BandTitle + AlbumDate + TrackCount
 * 
 * @author gizmore
 * @version 6.10
 * @since 6.10
 */
final class GDT_AlbumSubtitle extends GDT_Container
{
    public $band;
    public function band(GDO_Band $band=null) { $this->band = $band; return $this; }
    
    public $album;
    public function album(GDO_Album $album=null) { $this->album = $album; return $this; }
    
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
        if ( (!$this->getFields()) )
        {
            if ($this->band)
            {
                $this->addField($this->band->gdoColumn('band_country')->withName(false));
                $this->addField(GDT_Link::make()->labelRaw($this->band->displayName())->href($this->band->hrefShow()));
            }
            if ($this->album)
            {
                $this->addField($this->album->gdoColumn('album_released'));
                $this->addField(GDT_Label::make()->label('num_tracks', [$this->album->getVar('album_tracks')]));
            }
        }
    }
    
}
