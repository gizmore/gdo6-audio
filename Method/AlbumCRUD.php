<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Album;
use GDO\Audio\MethodAudioCRUD;
use GDO\Core\GDO;
use GDO\Form\GDT_Form;
use GDO\Core\Website;

final class AlbumCRUD extends MethodAudioCRUD
{
    public function hrefList() { return href('Audio', 'AlbumList'); }
    public function gdoTable() { return GDO_Album::table(); }
    public function crudName() { return 'album_id'; }
    public function formName() { return 'form_album'; }
    
    public function renderPage()
    {
        if ($this->gdo)
        {
            $setSong = AlbumSong::make()->album($this->gdo);
            $crudSong = SongCRUD::make()->album($this->gdo);
            return parent::renderPage()->
            add($setSong->execute())->
            add($crudSong->execute());
        }
        return parent::renderPage();
    }
    
    public function afterCreate(GDT_Form $form, GDO $gdo)
    {
        /** @var $gdo GDO_Album **/
        return Website::redirect($gdo->hrefEdit(), 12);
    }
    
}
