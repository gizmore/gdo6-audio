<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Album;
use GDO\Audio\MethodAudioCRUD;
use GDO\Core\GDO;
use GDO\Form\GDT_Form;
use GDO\Core\Website;
use GDO\Audio\GDO_Band;
use GDO\Util\Common;
use GDO\Form\GDT_AddButton;
use GDO\Core\GDT_Method;

final class AlbumCRUD extends MethodAudioCRUD
{
    public function hrefList() { return href('Audio', 'AlbumList'); }
    public function gdoTable() { return GDO_Album::table(); }
    public function crudName() { return 'album_id'; }
    public function formName() { return 'form_album'; }
    
    /** @var GDO_Band **/
    private $band;
    public function init()
    {
        parent::init();
        $this->band = GDO_Band::table()->find(Common::getRequestString('band_id'), false);
    }
    
    public function createForm(GDT_Form $form)
    {
        parent::createForm($form);
        if ($this->band)
        {
            $form->getField('album_band')->initial($this->band->getID());
            $form->getField('album_genre')->initial($this->band->getGenre());
        }
        
        if ($this->gdo)
        {
            $form->addField(GDT_AddButton::make('btn_add_song')->href(href('Audio', 'SongCRUD', '&album_id='.$this->gdo->getID())));
        }
    }
    
    public function renderPage()
    {
        if ($this->gdo)
        {
            $setSong = GDT_Method::make()->method(AlbumSong::make()->album($this->gdo));
            $crudSong = GDT_Method::make()->method(SongCRUD::make()->album($this->gdo));
            return parent::renderPage()->
            add($setSong->execute())->
            add($crudSong->execute());
        }
        return parent::renderPage();
    }
    
    public function afterCreate(GDT_Form $form, GDO $gdo)
    {
        /** @var $gdo GDO_Album **/
        return Website::redirectMessage('msg_album_created', null,  $gdo->hrefEdit());
    }
    
}
