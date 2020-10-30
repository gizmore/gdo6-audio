<?php
namespace GDO\Audio\Method;

use GDO\Core\Method;
use GDO\Audio\GDT_Album;
use GDO\UI\GDT_Card;
use GDO\Audio\GDO_Album;
use GDO\Audio\GDT_BandSubtitle;

final class AlbumView extends Method
{
    private GDO_Album $album;
    
    public function gdoParameters()
    {
        return array(
            GDT_Album::make('album_id')->notNull(),
        );
    }
    
    public function init()
    {
        $this->album = GDO_Album::table()->find($this->gdoParameterVar('album_id'));
    }
    
    public function execute()
    {
        $card = GDT_Card::make();
        
        $card->avatar($this->album->gdoColumn('album_cover'));
        $card->title($this->album->gdoColumn('album_title'));
        $card->subtitle(GDT_BandSubtitle::make()->band($this->album->getBand()));
        
        $card->editorFooter();
    }
    
}
