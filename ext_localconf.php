<?php
defined('TYPO3_MODE') or die();

call_user_func(
    function ($extKey) {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Libeo.' . $extKey,
            'Glossary',
            [
                'Term' => 'list',

            ],
            // non-cacheable actions
            [
                'Term' => '',

            ]
        );
    },
    $_EXTKEY
);
