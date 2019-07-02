(function () {
<?php
    require_once dirname(__FILE__) . '/jquery.js';

?>

    var $ = jQuery.noConflict(true);
    <?php
    require_once dirname(__FILE__) . '/jquery-ui.js';


?>
    var HTML = {};
    var DATA = {};
    DATA.HREF = '<?php echo P::cleanLinebreaks($href); ?>';
    DATA.HOST = '<?php echo $host; ?>';
    DATA.APP_NAME = '<?php echo $appName; ?>';
    var REMOTE_HOST = '//the.app.me';
    var CORE_CSS_JQUERY_UI = REMOTE_HOST + '/public/core/css/jquery-ui.css?rand=' + Math.random();
    var CORE_CSS_THEAPP = REMOTE_HOST + '/public/core/css/theapp.css?rand=' + Math.random();
    var AUTHORIZED = <?php echo $sf_user->isAuthenticated() ? 'true' : 'false'; ?>;
    HTML.NOT_AUTHORIZED = '<?php echo P::cleanLinebreaks(get_partial('index/not_authorized')); ?>';
    <?php if($Projects && $Projects->count()): ?>

    <?php else: ?>
        HTML.APP_CONTENT = "You are not using any app for this website";
    <?php endif; ?>


    <?php
    require_once dirname(__FILE__) . '/load.js'; ?>


    <?php echo sfOutputEscaper::unescape($codebase); ?>
})();
