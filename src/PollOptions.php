<?php

namespace Papaya\Module\Poll {

  use Papaya\Application\Access as ApplicationAccess;

  class PollOptions
    implements
    ApplicationAccess,
    \Papaya\Plugin\Configurable\Options
  {

    use
      ApplicationAccess\Aggregation,
      \Papaya\Plugin\Editable\Options\Aggregation;

    const OPTION_CONSENT_COOKIE_LEVEL = 'CONSENT_COOKIE_LEVEL';


    public $guid = '9a635f774ad6c2149125f6f4eb05fcba';

    private static $_defaults = array(
      self::OPTION_CONSENT_COOKIE_LEVEL => -1
    );


    public function createOptionsEditor(\Papaya\Plugin\Editable\Options $options) {
      $configuration = new \Papaya\Administration\Plugin\Editor\Dialog($options);
      $configuration->papaya($this->papaya());
      $dialog = $configuration->dialog();
      $dialog->fields[] = $field = new \PapayaUiDialogFieldSelect(
        new \PapayaUiStringTranslated('Consent Cookie Level'),
        self::OPTION_CONSENT_COOKIE_LEVEL,
        new \Papaya\UI\Text\Translated\Collection(
          [
            -1 => 'Any/None',
            0 => 'Basic',
            1 => 'Extended'
          ]
        )
      );
      return $configuration;
    }

    public function getConsentCookieLevel() {
      return $this->options()->withDefaults(self::$_defaults)->get(self::OPTION_CONSENT_COOKIE_LEVEL, -1);
    }
  }
}
