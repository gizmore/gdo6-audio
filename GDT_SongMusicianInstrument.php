<?php
namespace GDO\Audio;

use GDO\Core\GDT;
use GDO\UI\GDT_Link;
use GDO\UI\GDT_Label;

final class GDT_SongMusicianInstrument extends GDT
{
    public $song;
    public function song(GDO_Song $song) { $this->song = $song; return $this; }
    
    public function renderCard()
    {
        return 
        GDT_Link::make()->label($this->song->displayTitle())->href($this->song->hrefShow())->renderCell().
        GDT_Label::make()->label($this->song->displayMusicianInstrument())->renderCell();
    }
    
}
