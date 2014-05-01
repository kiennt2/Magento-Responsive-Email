<?php

class Edm_ResponsiveEmail_Model_Email_Template extends Edm_ResponsiveEmail_Model_Email_Template_Abstract
{
    public function getProcessedTemplate(array $variables = array())
    {

        $edm_active = Mage::getStoreConfig('system/mail_style/edmconfig_active');

        if($edm_active === "1"){

            $edm_package = Mage::getStoreConfig('system/mail_style/edmconfig_package');
            $edm_theme = Mage::getStoreConfig('system/mail_style/edmconfig_theme');
            $edm_area = Mage::getStoreConfig('system/mail_style/edmconfig_area');
            $edm_charset = Mage::getStoreConfig('system/mail_style/edmconfig_charset');
            $edm_viewport_width = Mage::getStoreConfig('system/mail_style/edmconfig_viewport_width');
            $edm_viewport_init = Mage::getStoreConfig('system/mail_style/edmconfig_viewport_initial');
            $edm_viewport_min = Mage::getStoreConfig('system/mail_style/edmconfig_viewport_min');
            $edm_viewport_max = Mage::getStoreConfig('system/mail_style/edmconfig_viewport_max');
            $edm_user_scalable = Mage::getStoreConfig('system/mail_style/edmconfig_viewport_scalable');

            if (!isset($variables['edm_path'])) {
                $variables['edm_path'] = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).$edm_area.'/'.$edm_package.'/'.$edm_theme.'/';
            }

            if (!isset($variables['edm_image'])) {
                $variables['edm_image'] = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).$edm_area.'/'.$edm_package.'/'.$edm_theme.'/'.'images/responsive_email/';
            }

            $html = parent::getProcessedTemplate($variables);

            $imagePath = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).$edm_area.'/'.$edm_package.'/'.$edm_theme.'/images/responsive_email/';
            $fontPath = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).$edm_area.'/'.$edm_package.'/'.$edm_theme.'/fonts/responsive_email/';
            $replacePath = array("fontspathdonotremove", "imagespathdonotremove");
            $mediaPath = array($fontPath, $imagePath, $html);
            $cssReplace = $this->_getAdditionalCssNotInline();

            $styleIncludePath = str_replace($replacePath, $mediaPath, $cssReplace);

            $styleExt = "<meta name='viewport' content='width=".$edm_viewport_width.", initial-scale=".$edm_viewport_init.", minimum-scale=".$edm_viewport_min.", maximum-scale=".$edm_viewport_max.", user-scalable=".$edm_user_scalable."'/>";
            $styleExt .= "<meta http-equiv='Content-Type' content='text/html; charset=".$edm_charset."' />";
            $styleExt .= "<style type=\"text/css\">\n%s\n</style>\n%s";
            $styleExtInclude = sprintf($styleExt, $styleIncludePath, $html);

            $cssToInline = $this->_getAdditionalCss();
            $cssToInlineStyles = new TijsVerkoyen_CssToInlineStyles($styleExtInclude, $cssToInline);
            $html = $cssToInlineStyles->convert();

            return $html;
        }else{
            $html = parent::getProcessedTemplate($variables);
            return $html;
        }

    }

    /**
     * @return string
     */
    protected function _getAdditionalCss()
    {
        $css = '';
        $inlineCssFiles = Mage::helper('responsive_email')->getInlineCssFilesArray();
        foreach ($inlineCssFiles as $file) {
            $css .= $this->_getCssFileContent($file) . "\n";
        }

        return $css;
    }

    protected function _getAdditionalCssNotInline()
    {
        $css = '';
        $cssFiles = Mage::helper('responsive_email')->getNotInlineCssFilesArray();
        foreach ($cssFiles as $file) {
            $css .= $this->_getCssFileContent($file) . "\n";
        }

        return $css;
    }

    /**
     * @param string $filename
     * @return string
     */
    protected function _getCssFileContent($filename)
    {
        $edm_package = Mage::getStoreConfig('system/mail_style/edmconfig_package');
        $edm_theme = Mage::getStoreConfig('system/mail_style/edmconfig_theme');
        $edm_area = Mage::getStoreConfig('system/mail_style/edmconfig_area');

        $filename = Mage::getDesign()->getFilename(
            'css' . DS . 'responsive_email' . DS . $filename,
            array(
                '_type' => 'skin',
                '_default' => false,
                '_area' => $edm_area,
                '_package' => $edm_package,
                '_theme' => $edm_theme
            )
        );

        return file_get_contents($filename);
    }
}