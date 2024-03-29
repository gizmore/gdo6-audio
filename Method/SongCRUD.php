<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Song;
use GDO\Audio\MethodAudioCRUD;
use GDO\Audio\GDO_Album;
use GDO\Core\GDO;
use GDO\Form\GDT_Form;
use GDO\Audio\GDO_SongAlbum;
use GDO\Audio\GDO_Band;
use GDO\Util\Common;
use GDO\Core\Website;

final class SongCRUD extends MethodAudioCRUD
{
    public $album;
    public function album(GDO_Album $album) { $this->album = $album; return $this->band($album->getBand()); }
    
    public $band;
    public function band(GDO_Band $band=null) { $this->band = $band; return $this; }
    
    public function hrefList() { return href('Audio', 'SongList'); }
    public function gdoTable() { return GDO_Song::table(); }
    public function formName() { return 'form_song'; }
    public function crudName() { return 'song_id'; }
    
    public function onInit()
    {
        parent::onInit();
        if ($id = Common::getRequestString('album_id'))
        {
            if ($album = GDO_Album::table()->find($id, false))
            {
                $this->album($album);
            }
        }
    }
    
    public function createForm(GDT_Form $form)
    {
        parent::createForm($form);
        
        if ($this->band)
        {
            $form->getField('song_band')->initial($this->band->getID());
            
        }
        $genre = $form->getField('song_genre');
        if (!$genre->hasVar())
        {
            if ($this->band && $this->band->getGenre())
            {
                $genre->initial($this->band->getGenre());
            }
            elseif ($this->album && $this->album->getGenre())
            {
                $genre->initial($this->album->getGenre());
            }
        }
    }
    
    public function afterCreate(GDT_Form $form, GDO $gdo)
    {
//         parent::afterCreate($form, $gdo);
        
        /** @var $song GDO_Song **/
        $song = $gdo;
        if ($this->album)
        {
            GDO_SongAlbum::addTrack($this->album, $song);
            Website::redirectMessage('msg_added_track', [$song->displayTitle(), $this->album->displayTitle()], $this->album->hrefEdit());
            return $this->renderPage();
        }
        
//         $this->resetForm();
    }

    public function renderPage()
    {
        if ($this->gdo)
        {
            $setMusician = SongMusician::make()->song($this->gdo);
            $crudMusician = MusicianCRUD::make()->song($this->gdo);
            return parent::renderPage()->
            addField($setMusician->execute())->
            addField($crudMusician->execute());
        }
        
//         $this->resetForm();
        return parent::renderPage();
    }

}
