<?php
/**
 * Contact Recipients plugin for Craft CMS
 *
 * Route recipient based on subject
 *
 * @author    @cole007
 * @copyright Copyright (c) 2017 @cole007
 * @link      http://ournameismud.co.uk/
 * @package   ContactRecipients
 * @since     1.0.0
 */

namespace Craft;

class ContactRecipientsPlugin extends BasePlugin
{
    /**
     * @return mixed
     */
    private function searchForId($subject, $array) {
        foreach ($array as $key => $val) {
            if ($val['subject'] === $subject) {
                return $key;
            }
        }
        return null;
    }

    public function init()
    {
        parent::init();

        craft()->on('contactForm.beforeSend', function(Event $event) {
            $src = $event->params['message'];
            $subject = $src->subject;

            $pluginSettings = craft()->plugins->getPlugin('contactrecipients')->getSettings();


            $match = $this->searchForId($subject, $pluginSettings->recipients);
            $recipient = $pluginSettings->recipients[$match]['recipient'];
            // $event->params['message']->toEmail = $recipient;

            $formSettings = craft()->plugins->getPlugin('contactform')->getSettings();
            $formSettings->toEmail = $recipient;
            
        });
    }

    /**
     * @return mixed
     */
    public function getName()
    {
         return Craft::t('Contact Recipients');
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return Craft::t('Route recipient based on subject');
    }

    /**
     * @return string
     */
    public function getDocumentationUrl()
    {
        return '???';
    }

    /**
     * @return string
     */
    public function getReleaseFeedUrl()
    {
        return '???';
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getSchemaVersion()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getDeveloper()
    {
        return '@cole007';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'http://ournameismud.co.uk/';
    }

    /**
     * @return bool
     */
    public function hasCpSection()
    {
        return false;
    }

    /**
     */
    public function onBeforeInstall()
    {
    }

    /**
     */
    public function onAfterInstall()
    {
    }

    /**
     */
    public function onBeforeUninstall()
    {
    }

    /**
     */
    public function onAfterUninstall()
    {
    }

    /**
     * @return array
     */
    protected function defineSettings()
    {
        return array(
            'recipients' => array(AttributeType::Mixed, 'label' => 'Some Setting', 'default' => ''),
        );
    }

    /**
     * @return mixed
     */
    public function getSettingsHtml()
    {
       return craft()->templates->render('contactrecipients/ContactRecipients_Settings', array(
           'settings' => $this->getSettings()
       ));
    }

    /**
     * @param mixed $settings  The plugin's settings
     *
     * @return mixed
     */
    public function prepSettings($settings)
    {
        // Modify $settings here...

        return $settings;
    }

}