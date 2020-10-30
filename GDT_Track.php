<?php
namespace GDO\Audio;

use GDO\Core\GDT;
use GDO\UI\GDT_Label;
use GDO\UI\GDT_Title;

final class GDT_Track extends GDT
{
    /** @var GDO_Album **/
    public $album;
    public function album(GDO_Album $album) { $this->album = $album; return $this; }

    /** @var GDO_Song **/
    public $song;
    public function song(GDO_Song $song) { $this->song = $song; return $this; }
    
    public function getTrack() { return $this->song->getTrack(); }

    public function renderCard()
    {
        return
        GDT_Label::make()->label('track_duration', [$this->getTrack(), $this->song->displayTitle(), $this->song->displayDuration()])->renderCell() . 
        GDT_Title::make()->initial($this->song->getTitle())->renderCell();
    }
    
    public function renderForm()
    {
        return $this->renderCell();
    }
    
    public function renderCell()
    {
        printf('%02d - %s (%s)', $this->song->getTrack(), $this->song->displayTitle(), $this->song->displayDuration());
    }
    
}
