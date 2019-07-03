(function () {
<?php
    require_once dirname(__FILE__) . '/jquery.js';

?>

    var $ = jQuery.noConflict(true);
    <?php
    require_once dirname(__FILE__) . '/jquery-ui.js';
    ?>

    <?php
    require_once dirname(__FILE__) . '/core.js';


?>

    var DATA = {};
    DATA.HREF = '<?php echo P::cleanLinebreaks($href); ?>';
    DATA.HOST = '<?php echo $host; ?>';
    DATA.APP_NAME = '<?php echo $appName; ?>';
    var REMOTE_HOST = '//the.app.me';


    var Apps = [];

    <?php if($sf_user->isAuthenticated()): ?>

        <?php if($Projects && $Projects->count()): ?>

            <?php foreach($Projects as $i => $project): ?>
                Apps.push({
                    id: '<?php echo $i + 1; ?>',
                    name: '<?php echo $project->getName(); ?>',
                    run: function ($content) {

                        <?php echo sfOutputEscaper::unescape($project->getCodebase()); ?>

                    }
                })

            <?php endforeach; ?>

        <?php else: ?>
            Apps.push({
                id: '1',
                name: 'TheApp',
                content: '<?php echo P::prepareForJs(get_partial('index/no_apps')); ?>',
                run: function($content){

                }
            });
        <?php endif; ?>

    <?php else: ?>
        Apps.push({
            id: '1',
            name: 'TheApp',
            content: '<?php echo P::prepareForJs(get_partial('index/not_authorized')); ?>',
            run: function($content){

            }
        });
    <?php endif; ?>


    <?php
    require_once dirname(__FILE__) . '/load.js'; ?>

})();
