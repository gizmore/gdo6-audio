<?php
namespace GDO\Audio;

use GDO\Core\GDT;
use GDO\UI\GDT_Label;
use GDO\UI\GDT_Title;
use GDO\UI\GDT_Divider;
use GDO\UI\GDT_Link;

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
        return '<label>' . t('track') . sprintf(' %02d', $this->getTrack()) . '</label>' .
            GDT_Link::make()->href($this->song->hrefShow())->label(t('track_duration', [$this->song->displayTitle(), $this->song->displayDuration()]))->renderCell();
    }
    
    public function renderForm()
    {
        return sprintf('<div>%s</div>', $this->renderCell());
    }
    
    public function renderCell()
    {
        printf('%02d - %s (%s)', $this->song->getTrack(), $this->song->displayTitle(), $this->song->displayDuration());
    }
    
}
