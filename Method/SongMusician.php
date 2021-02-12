<?php
namespace GDO\Audio\Method;

use GDO\Form\GDT_Form;
use GDO\Form\MethodForm;
use GDO\Audio\GDT_Song;
use GDO\Form\GDT_AntiCSRF;
use GDO\Form\GDT_Submit;
use GDO\Util\Common;
use GDO\Audio\GDO_Song;
use GDO\Core\Website;
use GDO\Audio\GDO_Musician;
use GDO\Audio\GDO_SongMusician;
use GDO\Audio\GDT_Musician;
use GDO\Audio\GDT_Instrument;
use GDO\Audio\GDT_MusicianInstrument;
use GDO\UI\GDT_Divider;

final class SongMusician extends MethodForm
{
    public function formName() { return 'form_sm'; }
    
    /**
     *  @var GDO_Song
     */
    public $song;
    public function song(GDO_Song $song) { $this->song = $song; return $this; }
    
    /**
     * @var GDO_Musician
     */
    public $musician;
    public function musician(GDO_Musician $musician) { $this->musician = $musician; return $this; }
    
    public function createForm(GDT_Form $form)
    {
        $form->addField(GDT_Song::make('song_id')->initial(Common::getRequestString('song_id')));
        $form->addField(GDT_Musician::make('musician_id')->initial(Common::getRequestString('musician_id')));
        $form->addField(GDT_Instrument::make('instrument')->notNull());
        
        if ($this->song)
        {
            $form->addField(GDT_Divider::make('div1')->label('musicians'));
            foreach (GDO_SongMusician::getMusicians($this->song) as $musician)
            {
                $mi = GDT_MusicianInstrument::make()->song($this->song)->musician($musician)->instrument(GDT_Instrument::make()->initial($musician->getInstrument()));
                $form->addField($mi);
            }
        }
        
        $form->actions()->addField(GDT_Submit::make());
        $form->addField(GDT_AntiCSRF::make());
    }

    public function formValidated(GDT_Form $form)
    {
        if ($this->song)
        {
            $this->musician = $form->getFormValue('musician_id');
            $redirectHREF = $this->song->hrefEdit();
        }
        elseif ($this->musician)
        {
            $this->song = $form->getFormValue('song_id');
            $redirectHREF = $this->musician->hrefEdit();
        }
        $instrument = $form->getField('instrument');
        
        if ($this->musician && $this->song)
        {
            GDO_SongMusician::connectMusician($this->song, $this->musician, $form->getField('instrument'));
            Website::redirectMessage('msg_added_musician_to_song', [$this->musician->displayName(), $this->song->displayTitle(), $instrument->getValue()], $redirectHREF);
        }
        
        return parent::formValidated($form);
    }
    
}
