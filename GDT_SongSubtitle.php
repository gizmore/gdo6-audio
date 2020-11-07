<?php
namespace GDO\Audio;

use GDO\UI\GDT_Container;

/**
 * Used as subtitle in cards and lists.
 * Shows BandCountry + BandTitle + SongReleased + Duration + Genre
 * 
 * @author gizmore
 * @version 6.10
 * @since 6.10
 */
final class GDT_SongSubtitle extends GDT_Container
{
    public $song;
    public $band;
    public function song(GDO_Song $song) { $this->song = $song; $this->band = $song->getBand(); return $this; }
    
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
                $this->addField($this->band->gdoColumn('band_name'));
            }
            $this->addField($this->song->gdoColumn('song_released'));
            $this->addField($this->song->gdoColumn('song_duration'));
            $this->addField($this->song->gdoColumn('song_genre'));
        }
    }
    
}
