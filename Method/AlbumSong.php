<?php
namespace GDO\Audio\Method;

use GDO\Form\GDT_Form;
use GDO\Form\MethodForm;
use GDO\Audio\GDT_Song;
use GDO\Form\GDT_AntiCSRF;
use GDO\Form\GDT_Submit;
use GDO\Audio\GDT_Album;
use GDO\Util\Common;
use GDO\Audio\GDO_Song;
use GDO\Audio\GDO_Album;
use GDO\Audio\GDO_SongAlbum;
use GDO\Audio\GDT_Track;

final class AlbumSong extends MethodForm
{
    public function formName() { return 'form_as'; }
    
    public $album;
    public function album(GDO_Album $album) { $this->album = $album; return $this; }
    
    public $song;
    public function song(GDO_Song $song) { $this->song = $song; return $this; }
    
    public function createForm(GDT_Form $form)
    {
        $form->addField(GDT_Album::make('as_album')->initial(Common::getRequestString('album_id')));

        $tracks = GDO_SongAlbum::getSongs($this->album);
        foreach ($tracks as $track)
        {
            $track = GDT_Track::make("track[{$track->getTrack()}]")->a
        }
        
        $form->addField(GDT_Song::make('as_song')->initial(Common::getRequestString('song_id')));
        $form->addField(GDT_Submit::make());
        $form->addField(GDT_AntiCSRF::make());
    }

    
}
