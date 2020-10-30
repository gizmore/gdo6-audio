<?php
namespace GDO\Audio;

use GDO\UI\GDT_Container;
use GDO\UI\GDT_Label;

/**
 * Used as subtitle in cards and lists.
 * Shows Country + Birthday + Age + NumSongs + NumInstruments
 * 
 * @author gizmore
 * @version 6.10
 * @since 6.10
 */
final class GDT_MusicianSubtitle extends GDT_Container
{
    public $musician;
    public function musician(GDO_Musician $musician) { $this->musician= $musician; return $this; }
    
    public function __construct()
    {
        $this->horizontal();
    }
    
    public function renderCell()
    {
        $this->beforeRender();
        return parent::renderCell();
    }
    
    private function beforeRender()
    {
        if (!$this->getFields())
        {
            $m = $this->musician;
            $this->addField($m->gdoColumn('musician_country'));
            $this->addField(GDT_Label::make()->label('born', [$m->displayBirthdate()]));
            $this->addField(GDT_Label::make()->label('age', [$m->displayAge()]));
            $this->addField(GDT_Label::make()->label('musician_num_songs', [$m->getNumSongs()]));
            $this->addField(GDT_Label::make()->label('musician_num_instruments', [$m->getNumInstruments()]));
        }
    }
    
}
