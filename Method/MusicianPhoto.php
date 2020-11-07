<?php
namespace GDO\Audio\Method;

use GDO\Core\Method;
use GDO\DB\GDT_Id;
use GDO\Audio\GDO_Album;
use GDO\File\Method\GetFile;
use GDO\DB\GDT_Enum;
use GDO\Audio\GDO_Musician;

/**
 * Render an album cover image.
 * @author gizmore
 */
final class MusicianPhoto extends Method
{
    public function gdoParameters()
    {
        return array(
            GDT_Id::make('file')->notNull(),
            GDT_Enum::make('variant')->enumValues('thumb'),
        );
    }
    
    public function execute()
    {
        $musician = GDO_Musician::findBy('musician_photo', $this->gdoParameterVar('file'));
        $variant = $this->gdoParameterVar('variant');
        return GetFile::make()->executeWithId($musician->getPhotoID(), $variant);
    }
    
}
