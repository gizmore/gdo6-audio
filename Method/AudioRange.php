<?php
namespace GDO\Audio\Method;

use GDO\Core\Method;
use GDO\File\FileUtil;
use GDO\File\GDO_File;
use GDO\Audio\GDO_Song;
use GDO\Net\Stream;
use GDO\DB\GDT_String;
use GDO\Audio\GDT_AudioFile;

/**
 * Get the raw audio file for a song.
 * @author gizmore
 *
 */
final class AudioRange extends Method
{
    public function gdoParameters()
    {
        return [
            GDT_AudioFile::make('file')->notNull(),
            GDT_String::make('variant'),
        ];
    }
    
    public function getFileID() { return $this->gdoParameterVar('file'); }
    public function getVariant() { return $this->gdoParameterVar('variant'); }
    
    public function execute()
    {
        $fileID = $this->getFileID();
        $variant = $this->getVariant();
        GDO_Song::table()->findBy('song_file', $fileID);
        if (!($file = GDO_File::getById($fileID)))
        {
            return $this->error('err_unknown_file', null, 404);
        }
        
        $path = $file->getVariantPath($variant);
        if (!FileUtil::isFile($path))
        {
            return $this->error('err_file_not_found', [htmlspecialchars($path)]);
        }
        
        Stream::serveWithRange($file, $variant);
    }
    
}
