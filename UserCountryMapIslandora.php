<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\UserCountryMapIslandora;

use \Piwik\FrontController;
use \Piwik\Piwik;
use \Piwik\Plugins\UserCountryMap;

/**
 */
class UserCountryMapIslandora extends UserCountryMap
{
    public function postLoad()
    {
        Piwik::addAction('Template.leftColumnUserCountry', array('Piwik\Plugins\UserCountryMapIslandora\UserCountryMapIslandora', 'insertMapInLocationReport'));
    }

    public static function insertMapInLocationReport(&$out)
    {
        $out = '<h2>' . Piwik::translate('UserCountryMapIslandora_VisitorMap') . '</h2>';
        $out .= FrontController::getInstance()->fetchDispatch('UserCountryMapIslandora', 'visitorMap');
    }

    public function registerEvents()
    {
        $hooks = array(
            'AssetManager.getJavaScriptFiles' => 'getJsFiles',
            'AssetManager.getStylesheetFiles' => 'getStylesheetFiles',
            'Translate.getClientSideTranslationKeys' => 'getClientSideTranslationKeys'
        );
        return $hooks;
    }

    public function getJsFiles(&$jsFiles)
    {
        $jsFiles[] = "libs/bower_components/visibilityjs/lib/visibility.core.js";
        $jsFiles[] = "plugins/UserCountryMapIslandora/javascripts/vendor/raphael.min.js";
        $jsFiles[] = "plugins/UserCountryMapIslandora/javascripts/vendor/jquery.qtip.min.js";
        $jsFiles[] = "plugins/UserCountryMapIslandora/javascripts/vendor/kartograph.min.js";
        $jsFiles[] = "libs/bower_components/chroma-js/chroma.min.js";
        $jsFiles[] = "plugins/UserCountryMapIslandora/javascripts/visitor-map.js";
    }

    public function getStylesheetFiles(&$stylesheets)
    {
        $stylesheets[] = "plugins/UserCountryMapIslandora/stylesheets/visitor-map.less";
    }

    public function getClientSideTranslationKeys(&$translationKeys)
    {
        $translationKeys[] = 'UserCountryMapIslandora_WithUnknownRegion';
        $translationKeys[] = 'UserCountryMapIslandora_WithUnknownCity';
        $translationKeys[] = 'General_UserId';
    }
}
