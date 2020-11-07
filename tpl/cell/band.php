<?phpuse GDO\Audio\GDO_Band;
use GDO\UI\GDT_Label;/** @var $gdo GDO_Band **/
echo GDT_Label::make()->label('band_cell',     [$gdo->displayCountry(), $gdo->displayName(), $gdo->displayFounded()])->renderCell();