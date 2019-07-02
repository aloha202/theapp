(function () {
<?php

    require_once dirname(__FILE__) . '/jquery.js';

    require_once dirname(__FILE__) . '/jquery-ui.js';
?>

    var REMOTE_HOST = '//the.app.me';
    var CORE_CSS_JQUERY_UI = REMOTE_HOST + '/public/core/css/jquery-ui.css?rand=' + Math.random();
    var CORE_CSS_THEAPP = REMOTE_HOST + '/public/core/css/theapp.css?rand=' + Math.random();
    <?php
    require_once dirname(__FILE__) . '/load.js'; ?>
})();
