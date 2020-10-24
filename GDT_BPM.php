<?php
namespace GDO\Audio;

use GDO\DB\GDT_UInt;

final class GDT_BPM extends GDT_UInt
{
    public function __construct()
    {
        $this->bytes(2);
    }

}
