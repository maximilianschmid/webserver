<?php
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']=array (
  '_DEFAULT' => 
  array (
    'init' => 
    array (
      'enableCHashCache' => true,
      'appendMissingSlash' => 'ifNotFile,redirect',
      'adminJumpToBackend' => true,
      'enableUrlDecodeCache' => true,
      'enableUrlEncodeCache' => true,
      'emptyUrlReturnValue' => '/',
    ),//init

    'pagePath' => 
     array (
      'type' => 'user',
      'userFunc' => 'EXT:realurl/class.tx_realurl_advanced.php:&tx_realurl_advanced->main',
      'spaceCharacter' => '-',
      'languageGetVar' => 'L',
      'rootpage_id' => '1',
    ),//pagePath

    'preVars' => 
      array (
        0 => 
        array (
          'GETvar' => 'L',
          'valueMap' => 
          array (
            'de' => '0',
            'en' => '1',
            'it' => '3',
          ),
          'valueDefault' => 'de',
          'noMatch' => 'bypass',
      ),
    ),//preVars

    
    'postVarSets' => array(
      '_DEFAULT' => array(
      'browse' => array( 
        array( 
            'GETvar' => 'tx_ttnews[pointer]', 
          'valueMap' => array(
            'weiter' => '1',
            'more' => '2',
          ),
        ),
      ),
      // news kategorien
      'kategorie' => array ( 
        array( 
          'GETvar' => 'tx_ttnews[cat]', 
          'lookUpTable' => array(
            'table' => 'tt_news_cat', 
            'id_field' => 'uid', 
            'alias_field' => 'title', 
            'addWhereClause' => ' AND NOT deleted', 
            'useUniqueCache' => 1, 
            'useUniqueCache_conf' => array( 
              'strtolower' => 1, 
              'spaceCharacter' => '-',
            ),
          ),
        ),
      ),
                  // news artikel
      'datum' => array(
        array(
          'GETvar' => 'tx_ttnews[year]', 
        ),
        array(
          'GETvar' => 'tx_ttnews[month]', 
          'valueMap' => array(
            '01' => '01',
            '02' => '02',
            '03' => '03',
            '04' => '04',
            '05' => '05',
            '06' => '06',
            '07' => '07',
            '08' => '08',
            '09' => '09',
            '10' => '10',
            '11' => '11',
            '12' => '12',
          ),
        ),
        array(
          'GETvar' => 'tx_ttnews[day]',
        ),
        array(
          'GETvar' => 'tx_ttnews[tt_news]',
          'lookUpTable' => array( 
            'table' => 'tt_news', 
            'id_field' => 'uid', 
            'alias_field' => 'title', 
            'addWhereClause' => ' AND NOT deleted AND NOT hidden',
            'useUniqueCache' => 1, 
            'useUniqueCache_conf' => array( 
              'strtolower' => 1, 
              'spaceCharacter' => '-',  
            ),
            'languageGetVar' => 'L',
            'languageExceptionUids' => '',
            'languageField' => 'sys_language_uid',
            'transOrigPointerField' => 'l18n_parent',
            'enable404forInvalidAlias' => 1,
          ),
          
        ),
      ),  
    ),
  ),//postVarSets

  // configure filenames for different pagetypes
  'fileName' => array(
    'defaultToHTMLsuffixOnPrev'=>1,
      'acceptHTMLsuffix' => 1,
            'index' => array(
                'rss.xml' => array(
                    'keyValues' => array(
                        'type' => 100,
                    ),
                ),
                'rss091.xml' => array(
                    'keyValues' => array(
                        'type' => 101,
                    ),
                ),
                'rdf.xml' => array(
                    'keyValues' => array(
                        'type' => 104,
                    ),
                ),
                'atom.xml' => array(
                    'keyValues' => array(
                        'type' => 103,
                    ),
                ),
                'atom03.xml' => array(
                    'keyValues' => array(
                        'type' => 102,
                    ),
                ),
                'sitemap.xml' => array(
                    'keyValues' => array(
                        'type' => 200,
                    ),
                ),
      ),
  ),//fileName
    
    
  ),
);
?>