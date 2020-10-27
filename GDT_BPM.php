<?php
namespace GDO\Audio;

use GDO\DB\GDT_UInt;

final class GDT_BPM extends GDT_UInt
{
    public $bytes = 2;
    public $icon = 'time';
    
    public function defaultLabel() { return $this->label('bpm'); }

}
