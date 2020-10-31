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
use GDO\UI\GDT_Divider;
use GDO\Core\Website;

final class AlbumSong extends MethodForm
{
    public function formName() { return 'form_as'; }
    
    /**
     *  @var GDO_Album
     */
    public $album;
    public function album(GDO_Album $album) { $this->album = $album; return $this; }
    
    /**
     * @var GDO_Song
     */
    public $song;
    public function song(GDO_Song $song) { $this->song = $song; return $this; }
    
    public function createForm(GDT_Form $form)
    {
        $form->addField(GDT_Divider::make('div1')->label('tracks'));
        $songs = GDO_SongAlbum::getSongs($this->album);
        foreach ($songs as $song)
        {
            $track = GDT_Track::make("track[{$song->getTrack()}]")->album($this->album)->song($song);
            $form->addField($track);
        }
        
        $form->addField(GDT_Album::make('album_id')->initial(Common::getRequestString('album_id')));
        $form->addField(GDT_Song::make('song_id')->initial(Common::getRequestString('song_id')));
        $form->addField(GDT_Submit::make());
        $form->addField(GDT_AntiCSRF::make());
    }

    public function formValidated(GDT_Form $form)
    {
        $this->song = $form->getFormValue('song_id');
        
        GDO_SongAlbum::addTrack($this->album, $this->song);
        $this->message('msg_added_track', [$this->song->displayTitle(), $this->album->displayTitle()]);
        $this->resetForm();
        return $this->renderPage();
    }
    
}
