<?php
namespace GDO\Audio;

use GDO\Core\GDT;
use GDO\UI\GDT_Link;
use GDO\UI\GDT_Label;
use GDO\Invite\GDO_Invitation;
use GDO\UI\GDT_Container;

final class GDT_MusicianInstrument extends GDT
{
    public $song;
    public function song(GDO_Song $song) { $this->song = $song; return $this; }
    
    public $musician;
    public function musician(GDO_Musician $musician) { $this->musician = $musician; }
    
    public $instrument;
    public function instrument(GDT_Instrument $instrument) { $this->instrument = $instrument; return $this; }
    
    public function renderCard()
    {
        return 
        GDT_Link::make()->label($this->song->displayTitle())->href($this->song->hrefShow())->renderCell().
        GDT_Label::make()->label($this->song->displayMusicianInstrument())->renderCell();
    }
    
    public function renderForm()
    {
        $musician = GDT_Label::make()->label('musician', [$this->musician->getCountry()->renderFlag(), $this->musician->displayName()]);
        $instrument = GDT_Label::make()->rawLabel($this->instrument->displayLabel());
        echo GDT_Container::makeWith($musician, $instrument)->renderForm();
    }
    
}
