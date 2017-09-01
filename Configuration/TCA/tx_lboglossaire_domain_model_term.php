<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$ll  = 'LLL:EXT:lbo_glossary/Resources/Private/Language/locallang_db.xlf:';
$fll = 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:';

$GLOBALS['TCA']['tx_lboglossary_domain_model_term'] = [
    'ctrl'      => [
        'title'                    => $ll . 'tx_lboglossary_domain_model_term',
        'label'                    => 'term',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'cruser_id'                => 'cruser_id',
        'dividers2tabs'            => true,
        'versioningWS'             => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete'                   => 'deleted',
        'enablecolumns'            => [
            'disabled'  => 'hidden',
            'starttime' => 'starttime',
            'endtime'   => 'endtime',
        ],
        'searchFields'             => 'term,description,',
        'iconfile'                 => 'EXT:lbo_glossary/Resources/Public/Icons/tx_lboglossary_domain_model_term.gif',
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, term, description',
    ],
    'types'     => [
        '1' => [
            'showitem' => 'sys_language_uid;' . $fll . 'sys_language_uid_formlabel,l18n_parent, l10n_diffsource, ' .
                          'hidden, --palette--;;1, term, description, --div--;' . $fll . 'tabs.access, ' .
                          'starttime, endtime',
        ],
    ],
    'palettes'  => [
        '1' => ['showitem' => ''],
    ],
    'columns'   => [
        'sys_language_uid' => [
            'exclude' => true,
            'label'   => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config'  => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'special'    => 'languages',
                'items'      => [
                    [
                        'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple',
                    ],
                ],
                'default'    => 0,
            ],
        ],
        'l10n_parent'      => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => true,
            'label'       => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'items'               => [
                    ['', 0],
                ],
                'foreign_table'       => 'tx_news_domain_model_news',
                'foreign_table_where' => 'AND tx_news_domain_model_news.pid=###CURRENT_PID### ' .
                                         'AND tx_news_domain_model_news.sys_language_uid IN (-1,0)',
                'default'             => 0,
            ],
        ],
        'l10n_diffsource'  => [
            'config' => [
                'type'    => 'passthrough',
                'default' => '',
            ],
        ],

        't3ver_label' => [
            'label'  => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max'  => 255,
            ],
        ],

        'hidden'    => [
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config'  => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config'  => [
                'type'       => 'input',
                'renderType' => 'inputDateTime',
                'size'       => 13,
                'eval'       => 'datetime',
                'checkbox'   => 0,
                'default'    => 0,
                'range'      => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
                ],
                'behaviour'  => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'endtime'   => [
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config'  => [
                'type'       => 'input',
                'renderType' => 'inputDateTime',
                'size'       => 13,
                'eval'       => 'datetime',
                'checkbox'   => 0,
                'default'    => 0,
                'range'      => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
                ],
                'behaviour'  => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],

        'term'        => [
            'exclude' => 1,
            'label'   => $ll . 'tx_lboglossary_domain_model_term.term',
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'description' => [
            'exclude' => 1,
            'label'   => $ll . 'tx_lboglossary_domain_model_term.description',
            'config'  => [
                'type'           => 'text',
                'cols'           => 40,
                'rows'           => 15,
                'eval'           => 'trim',
                'enableRichtext' => true,
            ],
        ],
    ],
];

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'lbo_glossary',
    'Glossary',
    'LLL:EXT:lbo_glossary/Resources/Private/Language/backend.xlf:pluginName'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('lbo_glossary',
                                                                  'Configuration/TypoScript',
                                                                  'A11y Glossary: Base configuration');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_lboglossary_domain_model_term',
                                                                        'EXT:lbo_glossary/Resources/Private/Language/locallang_csh_tx_lboglossary_domain_model_term.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_lboglossary_domain_model_term');
