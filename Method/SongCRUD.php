<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Song;
use GDO\Audio\MethodAudioCRUD;
use GDO\Audio\GDO_Album;
use GDO\Core\GDO;
use GDO\Form\GDT_Form;
use GDO\Audio\GDO_SongAlbum;

final class SongCRUD extends MethodAudioCRUD
{
    public $album;
    public function album(GDO_Album $album) { $this->album = $album; return $this; }
    
    public function hrefList() { return href('Audio', 'SongList'); }
    public function gdoTable() { return GDO_Song::table(); }
    public function formName() { return 'form_song'; }
    public function crudName() { return 'song_id'; }
    
    public function afterCreate(GDT_Form $form, GDO $gdo)
    {
        /** @var $song GDO_Song **/
        $song = $gdo;
        if ($this->album)
        {
            GDO_SongAlbum::addTrack($this->album, $song);
        }
        return $this->message('msg_added_track', [$song->displayTitle(), $this->album->renderChoice()]);
    }

}
