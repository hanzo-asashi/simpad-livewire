<?php

// Code within app\Helpers\Helper.php

namespace App\Helpers;

use Config;

class Helper
{
    public static function applClasses()
    {
        // default data array
        $DefaultData = [
            'mainLayoutType'         => 'vertical',
            'theme'                  => 'light',
            'sidebarCollapsed'       => false,
            'navbarColor'            => '',
            'horizontalMenuType'     => 'floating',
            'verticalMenuNavbarType' => 'floating',
            'footerType'             => 'static', //footer
            'layoutWidth'            => 'boxed',
            'showMenu'               => true,
            'bodyClass'              => '',
            'pageClass'              => '',
            'pageHeader'             => true,
            'contentLayout'          => 'default',
            'blankPage'              => false,
            'defaultLanguage'        => 'en',
            'direction'              => env('MIX_CONTENT_DIRECTION', 'ltr'),
        ];

        // if any key missing of array from custom.php file it will be merge and set a default value from dataDefault array and store in data variable
        $data = array_merge($DefaultData, config('custom.custom'));

        // All options available in the template
        $allOptions = [
            'mainLayoutType'         => ['vertical', 'horizontal'],
            'theme'                  => ['light' => 'light', 'dark' => 'dark-layout', 'bordered' => 'bordered-layout', 'semi-dark' => 'semi-dark-layout'],
            'sidebarCollapsed'       => [true, false],
            'showMenu'               => [true, false],
            'layoutWidth'            => ['full', 'boxed'],
            'navbarColor'            => ['bg-primary', 'bg-info', 'bg-warning', 'bg-success', 'bg-danger', 'bg-dark'],
            'horizontalMenuType'     => ['floating' => 'navbar-floating', 'static' => 'navbar-static', 'sticky' => 'navbar-sticky'],
            'horizontalMenuClass'    => ['static' => '', 'sticky' => 'fixed-top', 'floating' => 'floating-nav'],
            'verticalMenuNavbarType' => ['floating' => 'navbar-floating', 'static' => 'navbar-static', 'sticky' => 'navbar-sticky', 'hidden' => 'navbar-hidden'],
            'navbarClass'            => ['floating' => 'floating-nav', 'static' => 'navbar-static-top', 'sticky' => 'fixed-top', 'hidden' => 'd-none'],
            'footerType'             => ['static' => 'footer-static', 'sticky' => 'footer-fixed', 'hidden' => 'footer-hidden'],
            'pageHeader'             => [true, false],
            'contentLayout'          => ['default', 'content-left-sidebar', 'content-right-sidebar', 'content-detached-left-sidebar', 'content-detached-right-sidebar'],
            'blankPage'              => [false, true],
            'sidebarPositionClass'   => [
                'content-left-sidebar'           => 'sidebar-left', 'content-right-sidebar' => 'sidebar-right', 'content-detached-left-sidebar' => 'sidebar-detached sidebar-left',
                'content-detached-right-sidebar' => 'sidebar-detached sidebar-right', 'default' => 'default-sidebar-position',
            ],
            'contentsidebarClass' => [
                'content-left-sidebar'           => 'content-right', 'content-right-sidebar' => 'content-left', 'content-detached-left-sidebar' => 'content-detached content-right',
                'content-detached-right-sidebar' => 'content-detached content-left', 'default' => 'default-sidebar',
            ],
            'defaultLanguage' => ['en' => 'en', 'fr' => 'fr', 'de' => 'de', 'pt' => 'pt', 'id' => 'id'],
            'direction'       => ['ltr', 'rtl'],
        ];

        //if mainLayoutType value empty or not match with default options in custom.php config file then set a default value
        foreach ($allOptions as $key => $value) {
            if (array_key_exists($key, $DefaultData)) {
                if (gettype($DefaultData[$key]) === gettype($data[$key])) {
                    // data key should be string
                    if (is_string($data[$key])) {
                        // data key should not be empty
                        if (isset($data[$key]) && $data[$key] !== null) {
                            // data key should not be exist inside allOptions array's sub array
                            if (!array_key_exists($data[$key], $value)) {
                                // ensure that passed value should be match with any of allOptions array value
                                $result = array_search($data[$key], $value, 'strict');
                                if (empty($result) && $result !== 0) {
                                    $data[$key] = $DefaultData[$key];
                                }
                            }
                        } else {
                            // if data key not set or
                            $data[$key] = $DefaultData[$key];
                        }
                    }
                } else {
                    $data[$key] = $DefaultData[$key];
                }
            }
        }

        //layout classes
        $layoutClasses = [
            'theme'                  => $data['theme'],
            'layoutTheme'            => $allOptions['theme'][$data['theme']],
            'sidebarCollapsed'       => $data['sidebarCollapsed'],
            'showMenu'               => $data['showMenu'],
            'layoutWidth'            => $data['layoutWidth'],
            'verticalMenuNavbarType' => $allOptions['verticalMenuNavbarType'][$data['verticalMenuNavbarType']],
            'navbarClass'            => $allOptions['navbarClass'][$data['verticalMenuNavbarType']],
            'navbarColor'            => $data['navbarColor'],
            'horizontalMenuType'     => $allOptions['horizontalMenuType'][$data['horizontalMenuType']],
            'horizontalMenuClass'    => $allOptions['horizontalMenuClass'][$data['horizontalMenuType']],
            'footerType'             => $allOptions['footerType'][$data['footerType']],
            'sidebarClass'           => '',
            'bodyClass'              => $data['bodyClass'],
            'pageClass'              => $data['pageClass'],
            'pageHeader'             => $data['pageHeader'],
            'blankPage'              => $data['blankPage'],
            'blankPageClass'         => '',
            'contentLayout'          => $data['contentLayout'],
            'sidebarPositionClass'   => $allOptions['sidebarPositionClass'][$data['contentLayout']],
            'contentsidebarClass'    => $allOptions['contentsidebarClass'][$data['contentLayout']],
            'mainLayoutType'         => $data['mainLayoutType'],
            'defaultLanguage'        => $allOptions['defaultLanguage'][$data['defaultLanguage']],
            'direction'              => $data['direction'],
        ];
        // set default language if session hasn't locale value the set default language
        if (!session()->has('locale')) {
            app()->setLocale($layoutClasses['defaultLanguage']);
        }

        // sidebar Collapsed
        if ($layoutClasses['sidebarCollapsed'] == 'true') {
            $layoutClasses['sidebarClass'] = 'menu-collapsed';
        }

        // blank page class
        if ($layoutClasses['blankPage'] == 'true') {
            $layoutClasses['blankPageClass'] = 'blank-page';
        }

        return $layoutClasses;
    }

    public static function updatePageConfig($pageConfigs)
    {
        $demo = 'custom';
        if (isset($pageConfigs)) {
            if (count($pageConfigs) > 0) {
                foreach ($pageConfigs as $config => $val) {
                    Config::set('custom.'.$demo.'.'.$config, $val);
                }
            }
        }
    }

    public static function getAllMenu()
    {
        $path = resource_path('data/menu-data/verticalMenu.json');
        $menu = file_get_contents($path);

        return json_decode($menu, true);
    }
}
