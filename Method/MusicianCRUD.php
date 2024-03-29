<?php
namespace GDO\Audio\Method;

use GDO\Audio\GDO_Musician;
use GDO\Audio\MethodAudioCRUD;
use GDO\Audio\GDO_Song;
use GDO\Core\GDO;
use GDO\Form\GDT_Form;
use GDO\Audio\GDO_SongMusician;
use GDO\Audio\GDT_Instrument;
use GDO\Core\Website;

final class MusicianCRUD extends MethodAudioCRUD
{
    public function hrefList() { return href('Audio', 'MusicianList'); }
    public function gdoTable() { return GDO_Musician::table(); }
    public function formName() { return 'form_musician'; }
    public function crudName() { return 'musician_id'; }
    
    /** @var GDO_Song **/
    public $song;
    public function song(GDO_Song $song) { $this->song = $song; return $this; }
    
    public function createForm(GDT_Form $form)
    {
        parent::createForm($form);
        if ($this->song)
        {
            $form->addFieldAfter(GDT_Instrument::make('musician_instrument')->notNull(), 'musician_name');
        }
    }

    public function renderPage()
    {
        if ($this->gdo)
        {
            $setMusician = SongMusician::make()->musician($this->gdo);
            return parent::renderPage()->
            addField($setMusician->execute());
        }
        return parent::renderPage();
    }
    
    public function afterCreate(GDT_Form $form, GDO $gdo)
    {
        $this->resetForm();
        
        if ($song = $this->song)
        {
            /** @var $musician GDO_Musician **/
            $musician = $gdo;
            $instrument = $form->getField('musician_instrument');
            GDO_SongMusician::connectMusician($song, $musician, $instrument);
            Website::redirectMessage('msg_added_musician_to_song', [$musician->displayName(), $song->displayTitle(), $instrument->getValue()], $song->hrefEdit());
        }
        else
        {
            $musician = $gdo;
            Website::redirectMessage('msg_added_musician', [$musician->displayName()], $musician->hrefEdit());
        }
    }
    
}
