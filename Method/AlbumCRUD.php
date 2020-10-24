<?php
namespace GDO\Audio\Method;

use GDO\Form\MethodCrud;
use GDO\Audio\GDO_Album;

final class AlbumCRUD extends MethodCrud
{
    public function hrefList()
    {
        return href('Audio', 'AlbumList');
    }

    public function gdoTable()
    {
        return GDO_Album::table();
    }
    
}
