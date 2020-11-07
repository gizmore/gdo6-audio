<?php
namespace GDO\Audio\Method;

use GDO\Core\Method;
use GDO\File\GDT_File;
use GDO\Audio\GDO_Song;
use GDO\File\Method\GetFile;

/**
 * Get the raw audio file for a song.
 * @author gizmore
 *
 */
final class AudioFile extends Method
{
    public function gdoParameters()
    {
        return [
            GDT_File::make('file')->notNull(),
        ];
    }
    
    public function getFileID() { return $this->gdoParameterVar('file'); }
    
    public function execute()
    {
        $fileID = $this->getFileID();
        GDO_Song::table()->findBy('song_file', $fileID);
        return GetFile::make()->executeWithId($fileID);
    }
    
}
