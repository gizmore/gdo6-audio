<?php
namespace GDO\Audio\Method;

use GDO\Core\Method;
use GDO\DB\GDT_Id;
use GDO\Audio\GDO_Album;
use GDO\File\Method\GetFile;
use GDO\DB\GDT_Enum;

/**
 * Render an album cover image.
 * @author gizmore
 */
final class Cover extends Method
{
    public function gdoParameters()
    {
        return array(
            GDT_Id::make('album')->notNull(),
            GDT_Id::make('file')->notNull(),
            GDT_Enum::make('variant')->enumValues('thumb'),
        );
    }
    
    public function execute()
    {
        $album = GDO_Album::findById($this->gdoParameterVar('album'));
        $variant = $this->gdoParameterVar('variant');
        return GetFile::make()->executeWithId($album->getCoverId(), $variant);
    }
    
}
