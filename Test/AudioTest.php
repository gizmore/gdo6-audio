<?php
namespace GDO\Audio\Test;

use GDO\Tests\TestCase;
use GDO\Tests\MethodTest;
use GDO\Audio\Method\BandCRUD;
use function PHPUnit\Framework\assertStringContainsString;
use GDO\Audio\GDO_Band;
use GDO\Audio\Method\AlbumCRUD;
use GDO\Audio\GDO_Album;
use GDO\Audio\GDO_Song;
use GDO\File\GDO_File;
use function PHPUnit\Framework\assertTrue;
use GDO\Tests\Module_Tests;
use GDO\Audio\Method\AudioRange;
use function PHPUnit\Framework\assertEquals;

/**
 * This module is good for some basic crud testing.
 * It creates the basic Ranzgruppe website contents.
 * Ranzgruppe is the gdo6 testcase for a medium sized complexity.
 * It uses virtual columns to count a lot stats, and is an essential test case for the core.
 * @author gizmore
 * @version 6.10.4
 * @since 6.10.0
 */
final class AudioTest extends TestCase
{
    private $ranzgruppe;
    private $bsv;
    private $punk = 'punk';
    private $intro;
    
    public function testBandCreation()
    {
        $this->lang('de');
        $this->timezone('Europe/Berlin');
        $method = BandCRUD::make();
        $p = [
            'band_name' => 'Ranzgruppe',
            'band_description' => 'Die wohl längste Punkband der Welt aus Peine. Stahlhart und Eiskalt!',
            'band_genre' => 'punk',
            'band_founded' => '24.12.2020 13:37:42.314',
            'band_country' => 'DE',
            'create' => '1',
        ];
        $m = MethodTest::make()->method($method)->parameters($p);
        $r = $m->execute();
        echo $r->renderCLI();
        $this->assert200('Test if bands can be created.');
        
        $this->ranzgruppe = GDO_Band::findById(1);
        assertTrue(!!$this->ranzgruppe);
        assertStringContainsString('Die wohl l', $this->ranzgruppe->displayDescription(), 'Test if band description is copied correctly.');
    }

    public function testAlbumCreation()
    {
        $this->ranzgruppe = GDO_Band::findById(1);
        
        $m = AlbumCRUD::make();
        
        $gp = [
            'band_id' => $this->ranzgruppe->getID(),
        ];
        $p = [
            'album_title' => 'Band. Scheibe. Vorfall.',
            'album_genre' => 'Punk',
            'album_description' => 'Inspiriert vom Film Troja. Diese eine Melodie Alter. Und des amtiken Griechenland.',
            'album_released' => null,
            'create' => 1,
        ];
        MethodTest::make()->method($m)->getParameters($gp)->parameters($p)->execute();
        $this->assert200('Test if albums can be created.');
        
        $this->bsv = GDO_Album::findById(1);
        assertTrue(!!$this->bsv);
    }
    
    public function testNestedFormOutput()
    {
        $gp = [
            'album_id' => '1',
        ];
        $r = MethodTest::make()->method(AlbumCRUD::make())->getParameters($gp)->execute();
        assertEquals(1, substr_count($r->render(), 'Assign Song'), 'Test if nested cruds do not display twice.');
    }
    
    public function testCreateSong()
    {
        $this->ranzgruppe = GDO_Band::findById(1);
        $modTest = Module_Tests::instance();
        $mp3 = GDO_File::fromPath('INTRO 04', $modTest->filePath('Test/data/01_BAND_SCHEIBE_VORFALL_-_INTRO_4.mp3'))->insert()->copy();
        $this->intro = GDO_Song::blank([
            'song_title' => 'INTRO 4',
            'song_band' => $this->ranzgruppe->getID(),
            'song_genre' => $this->punk,
            'song_language' => 'de',
            'song_file' => $mp3->getID(),
            'song_lyrics' => null,
            'song_description' => 'Athenis Sei Meiner Seele Gnädig - Das jüngste Gericht dann ist Schicht.',
            'song_duration' => '3m 25',
            'song_bpm' => null,
            'song_released' => '26.12.2020',
            'song_featured' => '1',
            'submit' => 1,
        ])->insert();
        
        assertTrue($this->intro->isPersisted());
    }
    
    public function testPlay()
    {
        $file = GDO_Song::getById(1)->getFile();
        $p = [];
        $gp = ['file' => $file->getID()];
        $m = AudioRange::make();
        $this->callMethod($m, $p, $gp);
    }
    
}
