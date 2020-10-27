<?php
namespace GDO\Audio;

use GDO\DB\GDT_Enum;

/**
 * Music genres taken from https://www.musicgenreslist.com/
 * @author gizmore
 */
final class GDT_Genre extends GDT_Enum
{
    public static $GENRES = array(
        'art_punk',
        'britpunk',
        'college_rock',
        'crossover_thrash',
        'crust_punk',
        'emotional_hardcore',
        'experimental_rock',
        'folk_punk',
        'gothic_rock',
        'grunge',
        'hardcore_punk',
        'hard_rock',
        'indie_rock',
        'lo_fi',
        'musique_concrete',
        'new_wave',
        'progressive_rock',
        'punk',
        'shoegaze',
        'steampunk',
        'anime',
        'blues',
        'acoustic_blues',
        'african_blues',
        'blues_rock',
        'blues_shouter',
        'british_blues',
        'canadian_blues',
        'chicago_blues',
        'classic_blues',
        'classic_female_blues',
        'contemporary_blues',
        'country_blues',
        'dark_blues',
        'delta_blues',
        'detroit_blues',
        'doom_blues',
        'electric_blues',
        'folk_blues',
        'gospel_blues',
        'harmonica_blues',
        'hill_country_blues',
        'hokum_blues',
        'jazz_blues',
        'jump_blues',
        'kansas_city_blues',
        'louisiana_blues',
        'memphis_blues',
        'modern_blues',
        'new_orlean_blues',
        'ny_blues',
        'piano_blues',
        'piedmont_blues',
        'punk_blues',
        'ragtime_blues',
        'rhythm_blues',
        'st_louis_blues',
        'soul_blues',
        'swamp_blues',
        'texas_blues',
        'urban_blues',
        'vandeville',
        'west_coast_blues',
        'childrens_music',
        'lullabies',
        'sing_along',
        'stories',
        'classical',
        'avant_garde',
        'ballet',
        'baroque',
        'cantata',
        'chamber_music',
        'string_quartet',
        'chant',
        'choral',
        'classical_crossover',
        'concerto',
        'concerto_grosso',
        'contemporary_classical',
        'early_music',
        'expressionist',
        'high_classical',
        'impressionist',
        'mass_requiem',
        'medieval',
        'minimalism',
        'modern_composition',
        'modern_classical',
        'opera',
        'oratorio',
        'orchestral',
        'organum',
        'renaissance',
        'early_romantic',
        'later_romantic',
        'sonata',
        'symphonic',
        'symphony',
        'wedding_music',
        'comedy',
        'novelty',
        'parody_music',
        'stand_up_comedy',
        'vaudeville',
        'commercial',
        'jingles',
        'tv_themes',
        'country',
        'alternative_country',
        'americana',
        'australian_country',
        'bakersfield_sound',
        'bluegrass',
        'progressive_bluegrass',
        'reactionary_bluegrass',
        'blues_country',
        'cajun_fiddle_tunes',
        'christian_country',
        'classic_country',
        'close_harmony',
        'contemporary_bluegrass',
        'contemporary_country',
        'country_gospel',
        'country_pop',
        'country_rap',
        'country_rock',
        'country_soul',
        'cowboy',
        'cowpunk',
        'dansband',
        'franco_country',
        'gulf_and_western',
        'hellbilly_music',
        'honky_tonk',
        'instrumental_country',
        'lubbock_sound',
        'nashville_sound',
        'neotraditional_country',
        'outlaw_country',
        'psychobilly',
        'red_dirt',
        'sertanejo',
        'texas_county',
        'traditional_bluegrass',
        'traditional_country',
        'truck_driving_country',
        'urban_cowboy',
        'western_swing',
        'dance',
        'club_dance',
        'breakcore',
        'breakbeat',
        '4_beat',
        'acid_breaks',
        'baltimore_club',
        'big_beat',
        'breakbeat_hardcore',
        'broken_beat',
        'florida_breaks',
        'nu_skool_breaks',
        'brostep',
        'chillstep',
        'dubstep',
        'electroswing',
        'exercise',
        'future_garage',
        'garage',
        'glitch_hop',
        'glitch_pop',
        'bouncy_house',
        'bouncy_techno',
        'digital_hardcore',
        'doomcore',
        'dubstyle',
        'gabber',
        'happy_hardcore',
        'hardstyle',
        'jumpstyle',
        'makina',
        'speedcore',
        'terrorcore',
        'uk_hardcore',
        'hard_dance',
        'eurodance',
        'horrorcore',
        'house',
        'acid_house',
        'chicago_house',
        'deep_house',
        'diva_house',
        'dutch_house',
        'electro_house',
        'freestyle_house',
        'french_house',
        'funky_house',
        'ghetto_house',
        'hardbag',
        'hip_house',
        'italo_house',
        'latin_house',
        'minimal_house',
        'progressive_house',
        'rave_music',
        'swing_house',
        'tech_housetribal_house',
        'uk_hard_house',
        'us_garage',
        'vocal_house',
        'jackin_house',
        'jungle',
        'drum_n_bass',
        'liquid_dub',
        'regstep',
        'techno',
        'acid_techno',
        'detroit_techno',
        'free_tekno',
        'ghettotech',
        'minimal',
        'nortec',
        'schranz',
        'techno_dnb',
        'technopop',
        'tecno_brega',
        'toytown_techno',
        'trance',
        'acid_trance',
        'classic_trance',
        'dream_trance',
        'goa_trance',
        'dark_psytrance',
        'full_on',
        'psybreaks',
        'psyprog',
        'suomisaundi',
        'hard_trance',
        'tech_trance',
        'uplifting_trance',
        'orchestral_uplifting',
        'vocal_trance',
        'trap',
        'disney',
        'easy_listening',
        'background',
        'bop',
        'elevator',
        'furniture',
        'lounge',
        'middle_of_the_road',
        'swing',
        'electronic',
        '2_step',
        '8bit',
        'ambient',
        'ambient_dub',
        'ambient_house',
        'ambient_techno',
        'dark_ambient',
        'drone_music',
        'illbient',
        'isolationism',
        'lowercase',
        'asian_underground',
        'chiptune',
        'bitpop',
        'game_boy',
        'nintendocore',
        'video_game_music',
        'yorkshire_bleeps_and_bass',
        'downtempo',
        'balearic_beat',
        'chill_out',
        'dub_music',
        'dubtronica',
        'ethnic_electronica',
        'moombahton',
        'nu_jazz',
        'darkcore',
        'darkstep',
        'drumfunk',
        'drumstep',
        'hardstep',
        'intelligent_drum_and_bass',
        'jump_up',
        'liquid_funk',
        'neurofunk',
        'oldschool_jungle',
        'darkside_jungle',
        'ragga_jungle',
        'raggacore',
        'sambass',
        'techstep',
        'electro',
        'crunk',
        'electro_backbeat',
        'electro_grime',
        'electropop',
        'electro_swing',
        'electroacoustic',
        'acousmatic_music',
        'computer_music',
        'electroacoustic_improvisation',
        'field_recording',
        'live_coding',
        'live_electronics',
        'soundscape_composition',
        'tape_music',
        'electronica',
        'berlin_school',
        'chillwave',
        'electronic_art_music',
        'electronic_dance_music',
        'folktronica',
        'freestyle_music',
        'glitch',
        'idm',
        'laptronica',
        'skweee',
        'sound_art',
        'synthcore',
        'electronic_rock',
        'alternative_dance',
        'baggy',
        'madchester',
        'dance_punk',
        'dance_rock',
        'dark_wave',
        'electroclash',
        'electronicore',
        'electropunk',
        'ethereal_wave',
        'indietronica',
        'new_rave',
        'space_rock',
        'synthpop',
        'synthpunk',
        'bubblegum_dance',
        'italo_dance',
        'turbofolk',
        'hi_nrg',
        'eurobeat',
        'hard_nrg',
        'new_beat',
        'idm_experimental',
        'industrial',
        'trip_hop',
        'uk_garage',
        '4×4',
        'bassline',
        'grime',
        'speed_garage',
        'enka',
        'folk_music',
        'american_folk_revival',
        'anti_folk',
        'british_folk_revival',
        'filk_music',
        'freak_folk',
        'indie_folk',
        'industrial_folk',
        'neofolk',
        'progressive_folk',
        'psychedelic_folk',
        'sung_poetry',
        'techno_folk',
        'german_folk',
        'german_pop',
        'fitness_and_workout',
        'hip_hop',
        'rap',
        'alternative_rap',
        'bounce',
        'chap_hop',
        'christian_hip_hop',
        'conscious_hip_hop',
        'crunkcore',
        'cumbia_rap',
        'dirty_south',
        'east_coast',
        'brick_city_club',
        'hardcore_hip_hop',
        'mafioso_rap',
        'new_jersey_hip_hop',
        'freestyle_rap',
        'g_funk',
        'gangsta_rap',
        'golden_age',
        'hardcore_rap',
        'hip_pop',
        'hyphy',
        'industrial_hip_hop',
        'instrumental_hip_hop',
        'jazz_rap',
        'latin_rap',
        'low_bap',
        'lyrical_hip_hop',
        'merenrap',
        'midwest_hip_hop',
        'chicago_hip_hop',
        'detroit_hip_hop',
        'st_louis_hip_hop',
        'twin_cities_hip_hop',
        'motswako',
        'nerdcore',
        'new_jack_swing',
        'new_school_hip_hop',
        'old_school_rap',
        'turntablism',
        'underground_rap',
        'west_coast_rap',
        'holiday',
        'chanukah',
        'christmas',
        'easter',
        'halloween',
        'thanksgiving',
        'indie_pop',
        'aggrotech',
        'coldwave',
        'cybergrind',
        'dark_electro',
        'death_industrial',
        'electro_industrial',
        'electronic_body_music',
        'futurepop',
        'industrial_rock',
        'noise',
        'japanoise',
        'power_electronics',
        'power_noise',
        'witch_house',
        'ccm',
        'christian_metal',
        'christian_pop',
        'christian_rap',
        'christian_rock',
        'classic_christian',
        'contemporary_gospel',
        'gospel',
        'christian_and_gospel',
        'praise_and_worship',
        'qawwali',
        'southern_gospel',
        'traditional_gospel',
        'instrumental',
        'march',
        'j_pop',
        'j_rock',
        'j_synth',
        'j_ska',
        'j_punk',
        'jazz',
        'acid_jazz',
        'avant_garde_jazz',
        'bebop',
        'big_band',
        'blue_note',
        'contemporary_jazz',
        'cool',
        'crossover_jazz',
        'dixieland',
        'ethio_jazz',
        'fusion',
        'gypsy_jazz',
        'hard_bop',
        'latin_jazz',
        'mainstream_jazz',
        'ragtime',
        'smooth_jazz',
        'trad_jazz',
        'third_stream',
        'jazz_funk',
        'free_jazz',
        'modal_jazz',
        'karaoke',
        'kayokyoku',
        'latin',
        'rock_latino',
        'argentine_tango',
        'bachata',
        'baithak_gana',
        'baladas_y_boleros',
        'bolero',
        'bossa_nova',
        'brazilian',
        'axe',
        'brazilian_rock',
        'brega',
        'choro',
        'forro',
        'frevo',
        'funk_carioca',
        'lambada',
        'maracatu',
        'pagode',
        'samba',
        'samba_rock',
        'tecnobrega',
        'tropicalia',
        'zouk_lambada',
        'chicha',
        'criolla',
        'contemporary_latin',
        'cumbia',
        'flamenco',
        'huayno',
        'mariachi',
        'merengue_tipico',
        'nuevo_flamenco',
        'pop_latino',
        'portuguese_fado',
        'punta',
        'punta_rock',
        'ranchera',
        'raices',
        'raison',
        'reggaeton_y_hiphop',
        'regional_mexicano',
        'salsa_y_tropical',
        'son',
        'timba',
        'twoubadou',
        'zouk',
        'metal',
        'heavy_metal',
        'speed_metal',
        'thrash_metal',
        'power_metal',
        'death_metal',
        'black_metal',
        'pagan_metal',
        'viking_metal',
        'folk_metal',
        'symphonic_metal',
        'gothic_metal',
        'glam_metal',
        'hair_metal',
        'doom_metal',
        'groove_metal',
        'industrial_metal',
        'modern_metal',
        'neoclassical_metal',
        'post_metal',
        'progressive_metal',
        'avantgarde_metal',
        'sludge',
        'djent',
        'drone',
        'kawaii_metal',
        'pirate_metal',
        'nu_metal',
        'neue_deutsche_haerte',
        'crossover',
        'grindcore',
        'hardcore',
        'metalcore',
        'deathcore',
        'post_hardcore',
        'mathcore',
        'new_age',
        'environmental',
        'healing',
        'meditation',
        'nature',
        'relaxation',
        'travel',
        'pop',
        'adult_contemporary',
        'arab_pop',
        'britpop',
        'bubblegum_pop',
        'chamber_pop',
        'chanson',
        'europop',
        'austropop',
        'balkan_pop',
        'french_pop',
        'latin_pop',
        'laiko',
        'nederpop',
        'russian_pop',
        'dance_pop',
        'dream_pop',
        'electro_pop',
        'iranian_pop',
        'jangle_pop',
        'latin_ballad',
        'levenslied',
        'louisiana_swamp_pop',
        'mexican_pop',
        'motorpop',
        'new_romanticism',
        'orchestral_pop',
        'pop_rap',
        'popera',
        'pop_rock',
        'pop_punk',
        'power_pop',
        'psychedelic_pop',
        'schlager',
        'soft_rock',
        'sophisti_pop',
        'space_age_pop',
        'sunshine_pop',
        'surf_pop',
        'teen_pop',
        'traditional_pop_music',
        'turkish_pop',
        'vispop',
        'wonky_pop',
        'post_disco',
        'boogie',
        'progressive',
        'disco_house',
        'dream_house',
        'space_house',
        'japanese_house',
        'progressive_breaks',
        'progressive_drum_and_bass',
        'progressive_techno',
        'r_n_b',
        'contemporary_r_n_b',
        'disco',
        'funk',
        'modern_soul',
        'motown',
        'neo_soul',
        'northern_soul',
        'psychedelic_soul',
        'quiet_storm',
        'soul',
        'southern_soul',
        'reggae',
        'dancehall',
        'dub',
        'roots_reggae',
        'reggae_fusion',
        'reggae_110',
        'reggae_bultron',
        'romantic_flow',
        'lovers_rock',
        'raggamuffin',
        'ragga',
        'ska',
        '2_tone',
        'rocksteady',
        'rock',
        'acid_rock',
        'adult_oriented_rock',
        'afro_punk',
        'adult_alternative',
        'alternative_rock',
        'american_traditional_rock',
        'anatolian_rock',
        'arena_rock',
        'british_invasion',
        'cock_rock',
        'glam_rock',
        'grind_core',
        'math_metal',
        'math_rock',
        'metal_core',
        'noise_rock',
        'jam_bands',
        'post_punk',
        'prog_rock',
        'art_rock',
        'psychedelic',
        'rock_and_roll',
        'rockabilly',
        'roots_rock',
        'southern_rock',
        'spazzcore',
        'stoner_metal',
        'surf',
        'technical_death_metal',
        'time_lord_rock',
        'alternative_folk',
        'contemporary_folk',
        'folk_rock',
        'love_song',
        'new_acoustic',
        'traditional_folk',
        'foreign_cinema',
        'movie_soundtrack',
        'musicals',
        'original_score',
        'soundtrack',
        'tv_soundtrack',
        'spoken_word',
        'tejano',
        'chicano',
        'classic',
        'conjunto',
        'conjunto_progressive',
        'new_mex',
        'tex_mex',
        'vocal',
        'a_cappella',
        'barbershop',
        'cantique',
        'doo_wop',
        'gregorian_chant',
        'traditional_pop',
        'vocal_jazz',
        'vocal_pop',
        'africa',
        'african_heavy_metal',
        'african_hip_hop',
        'afro_beat',
        'afro_pop',
        'apala',
        'benga',
        'bikutsi',
        'bongo_flava',
        'cape_jazz',
        'chimurenga',
        'coupe_decale',
        'fuji_music',
        'genge',
        'highlife',
        'hiplife',
        'isicathamiya',
        'jit',
        'juju',
        'kapuka',
        'kizomba',
        'kuduro',
        'kwaito',
        'kwela',
        'makossa',
        'maloya',
        'marrabenta',
        'mbalax',
        'mbaqanga',
        'mbube',
        'morna',
        'museve',
        'palm_wine',
        'rai',
        'sakara',
        'sega',
        'seggae',
        'semba',
        'soukous',
        'taarab',
        'zouglou',
        'asia',
        'anison',
        'c_pop',
        'cantopop',
        'hong_kong_english_pop',
        'fann_at_tanbura',
        'fijiri',
        'japanese_pop',
        'k_pop',
        'khaliji',
        'korean_pop',
        'liwa',
        'mandopop',
        'onkyokei',
        'taiwanese_pop',
        'sawt',
        'australia',
        'cajun',
        'calypso',
        'caribbean',
        'chutney',
        'chutney_soca',
        'compas',
        'mambo',
        'merengue',
        'meringue',
        'carnatic',
        'celtic',
        'celtic_folk',
        'contemporary_celtic',
        'dangdut',
        'drinking_songs',
        'europe',
        'france',
        'hawaii',
        'japan',
        'klezmer',
        'middle_east',
        'north_america',
        'ode',
        'piphat',
        'polka',
        'soca',
        'south_africa',
        'south_america',
        'baila',
        'bhangra',
        'bhojpuri',
        'filmi',
        'indian_pop',
        'hindustani',
        'indian_ghazal',
        'lavani',
        'luk_thung',
        'luk_krung',
        'manila_sound',
        'morlam',
        'pinoy_pop',
        'pop_sunda',
        'ragini',
        'thai_pop',
        'traditional_celtic',
        'worldbeat',
        'zydeco',
    );

    public function defaultLabel() { return $this->label('genre'); }
    
    public function __construct()
    {
        $this->icon('guitar');
        $this->enumValues(...self::$GENRES);
        $this->completionHref(href('Audio', 'CompleteGenre'));
        $this->emptyValue('0');
        $this->emptyLabel(t('select_genre'));
    }
    
}
