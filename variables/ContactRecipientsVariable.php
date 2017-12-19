<?php
/**
 * Contact Recipients plugin for Craft CMS
 *
 * Contact Recipients Variable
 *
 * @author    @cole007
 * @copyright Copyright (c) 2017 @cole007
 * @link      http://ournameismud.co.uk/
 * @package   ContactRecipients
 * @since     1.0.0
 */

namespace Craft;

class ContactRecipientsVariable
{
    /**
     */
    public function recipients()
    {
        $pluginSettings = craft()->plugins->getPlugin('contactrecipients')->getSettings();
        $rows = $pluginSettings->recipients;
        return $rows;
    }
}