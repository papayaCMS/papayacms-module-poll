<?php

namespace Papaya\Module\Poll {

  use Papaya\Application\Access as ApplicationAccess;
  use Papaya\Filter\IntegerValue;
  use Papaya\UI\Dialog\Field\Group;
  use Papaya\UI\Dialog\Field\Input;
  use Papaya\UI\Dialog\Field\Select;
  use Papaya\UI\Text\Translated;

  class PollOptions
    implements
    ApplicationAccess,
    \Papaya\Plugin\Configurable\Options
  {

    use
      ApplicationAccess\Aggregation,
      \Papaya\Plugin\Editable\Options\Aggregation;

    const OPTION_IP_LOCKING = 'IP_LOCKING';
    const OPTION_CONSENT_COOKIE_REQUIRE = 'CONSENT_COOKIE_REQUIRE';
    const OPTION_CONSENT_COOKIE_LEVEL = 'CONSENT_COOKIE_LEVEL';


    public $guid = '9a635f774ad6c2149125f6f4eb05fcba';

    private static $_defaults = array(
      self::OPTION_IP_LOCKING => 0,
      self::OPTION_CONSENT_COOKIE_REQUIRE => 0,
      self::OPTION_CONSENT_COOKIE_LEVEL => 0
    );


    public function createOptionsEditor(\Papaya\Plugin\Editable\Options $options) {
      $configuration = new \Papaya\Administration\Plugin\Editor\Dialog($options);
      $configuration->papaya($this->papaya());
      $dialog = $configuration->dialog();
      $dialog->fields[] = $field = new Select\Radio(
        new \PapayaUiStringTranslated('IP Locking'),
        self::OPTION_IP_LOCKING,
        new \Papaya\UI\Text\Translated\Collection(
          [
            1 => 'Yes',
            0 => 'No'
          ]
        )
      );
      $dialog->fields[] = $group = new Group(new Translated('Consent Cookie'));
      $group->fields[] = $field = new Select\Radio(
        new \PapayaUiStringTranslated('Required'),
        self::OPTION_CONSENT_COOKIE_REQUIRE,
        new \Papaya\UI\Text\Translated\Collection(
          [
            1 => 'Yes',
            0 => 'No'
          ]
        )
      );
      $group->fields[] = $field = new Input(
        new \PapayaUiStringTranslated('Level'),
        self::OPTION_CONSENT_COOKIE_LEVEL,
        1,
        self::$_defaults[self::OPTION_CONSENT_COOKIE_LEVEL],
        new IntegerValue(0, 9)
      );
      return $configuration;
    }

    /**
     * @return int
     */
    public function getConsentCookieLevel() {
      $options = $this->options()->withDefaults(self::$_defaults);
      return $options[self::OPTION_CONSENT_COOKIE_REQUIRE] ? (int)$options[self::OPTION_CONSENT_COOKIE_LEVEL] : -1;
    }

    /**
     * @return bool
     */
    public function useIPLocking() {
      $options = $this->options()->withDefaults(self::$_defaults);
      return (bool)$options[self::OPTION_IP_LOCKING];
    }
  }
}
