<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Musician;
use GDO\Audio\MethodAudioCRUD;
use GDO\Audio\GDO_Song;

final class MusicianCRUD extends MethodAudioCRUD
{
    public function hrefList() { return href('Audio', 'MusicianList'); }
    public function gdoTable() { return GDO_Musician::table(); }
    public function formName() { return 'form_musician'; }
    public function crudName() { return 'musician_id'; }
    
    public $song;
    public function song(GDO_Song $song) { $this->song = $song; return $this; }

}
