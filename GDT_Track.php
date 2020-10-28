<?php
namespace GDO\Audio;

use GDO\Core\GDT;
use GDO\UI\GDT_Label;
use GDO\UI\GDT_Title;

final class GDT_Track extends GDT
{
    public $album;
    public function album(GDO_Album $album) { $this->album = $album; return $this; }

    public $song;
    public function song(GDO_Song $song) { $this->song = $song; return $this; }
    
    public function getTrack() { return $this->song->getTrack(); }

    public function renderCard()
    {
        return
        GDT_Label::make()->label('track_duration', [$this->getTrack(), $this->song->dispayDuration()])->renderCell() . 
        GDT_Title::make()->initial($this->song->getTitle())->renderCell();
        
    }
    
    
}
