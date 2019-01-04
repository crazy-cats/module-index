<?php
/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

/* @var $this \CrazyCat\Core\Block\Head */
?>
<script type="text/javascript" src="<?php echo getStaticUrl( 'CrazyCat\Core::js/require.js' ); ?>"></script>
<script type="text/javascript">
    // <![CDATA[
    window.languageCode = '<?php echo $this->getLangCode(); ?>';
    window.localStoragePrefix = '<?php echo $this->getLocalStoragePrefix(); ?>';

    require.config( {
        baseUrl: '<?php echo getStaticUrl( '' ); ?>',
        waitSeconds: 0,
        paths: {
            jquery: '<?php echo getStaticUrl( 'CrazyCat\Core::js/jquery' ); ?>',
            text: '<?php echo getStaticUrl( 'CrazyCat\Core::js/text' ); ?>',
            utility: '<?php echo getStaticUrl( 'CrazyCat\Core::js/utility' ); ?>',
            translator: '<?php echo getStaticUrl( 'CrazyCat\Core::js/translator' ); ?>',
            editor: '<?php echo getStaticUrl( 'CrazyCat/Core/js/tinymce/tinymce.min' ); ?>'
        },
        shim: {
            editor: {
                exports: 'tinymce'
            }
        }
    } );

    require.config( {
        deps: [ 'translator' ],
        callback: function() {
            window.translationStorageName = '<?php echo md5( getBaseUrl() ); ?> :: crazycat-translations-' + window.languageCode;
            if ( !window.localStorage.getItem( window.translationStorageName ) ) {
                require( [ 'text!<?php echo getUrl( 'index/translate/source', [ 'is_frontend' => true ] ) ?>' ], function( translations ) {
                    window.localStorage.setItem( window.translationStorageName, translations );
                } );
            }
        }
    } );
    // ]]>
</script>