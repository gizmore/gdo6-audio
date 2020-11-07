<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Band;
use GDO\Audio\MethodAudioCRUD;
use GDO\Form\GDT_Form;
use GDO\Form\GDT_AddButton;
use GDO\Core\Website;
use GDO\Core\GDO;

final class BandCRUD extends MethodAudioCRUD
{
    public function formName() { return 'form_band'; }
    public function crudName() { return 'band_id'; } 
    public function gdoTable() { return GDO_Band::table(); }
    public function hrefList() { return href('Audio', 'BandList'); }

    public function createForm(GDT_Form $form)
    {
        parent::createForm($form);
        
        if ($this->gdo)
        {
            $form->addField(GDT_AddButton::make('btn_add_album')->href(href('Audio', 'AlbumCRUD', '&band_id='.$this->getCRUDID())));
        }
    }
    
    public function afterCreate(GDT_Form $form, GDO $gdo)
    {
        Website::redirectMessage('msg_band_created', null, $this->href('&band_id='.$gdo->getID()));
    }
    
}
