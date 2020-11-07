<?php
namespace GDO\Audio;

use GDO\Core\GDT;
use GDO\UI\GDT_Label;
use GDO\UI\GDT_Container;
use GDO\UI\GDT_Link;

final class GDT_MusicianInstrument extends GDT
{
    public $song;
    public function song(GDO_Song $song) { $this->song = $song; return $this; }
    
    public $musician;
    public function musician(GDO_Musician $musician) { $this->musician = $musician; return $this; }
    
    public $instrument;
    public function instrument(GDT_Instrument $instrument) { $this->instrument = $instrument; return $this; }
    
    public function renderCard()
    {
        if ($this->musician)
        {
            return
            sprintf('<label>%s</label>', $this->musician->displayName()).
            sprintf('<span>%s</span>', $this->musician->getVar('sm_instrument'));
        }
        if ($this->song)
        {
            return GDT_Link::make()->href($this->song->hrefShow())->rawLabel($this->song->displayName())->initial($this->song->getVar('sm_instrument'))->renderCard();
        }
    }
    
    public function renderForm()
    {
        $c = $this->musician->getCountry();
        $musician = GDT_Label::make()->label('assigned_musician', [$c->renderFlag(), $this->musician->displayName(), $this->instrument->getVar()]);
        echo GDT_Container::makeWith($musician)->renderForm();
    }
    
}
