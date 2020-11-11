<?php
/**
* Edit module poll
*
* @copyright 2002-2007 by papaya Software GmbH - All rights reserved.
* @link http://www.papaya-cms.com/
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, version 2
*
* You can redistribute and/or modify this script under the terms of the GNU General Public
* License (GPL) version 2, provided that the copyright and license notes, including these
* lines, remain unmodified. papaya is distributed in the hope that it will be useful, but
* WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
* FOR A PARTICULAR PURPOSE.
*
* @package Papaya-Modules
* @subpackage Free-Poll
* @version $Id: edmodule_poll.php 39563 2014-03-14 15:59:39Z weinert $
*/

/**
* Edit module poll
*
* @package Papaya-Modules
* @subpackage Free-Poll
*/
class edmodule_poll extends base_module {
  
  /**
  * GUID
  * @var string $guid
  */
  var $guid = "5602b2b497326580a691512b924fc131";
  /**
  * module name
  * @var string $module
  */
  var $module = 'poll';
  /**
  * file name
  * @var string $fileName
  */
  var $fileName = "edmodule_poll.php";
  /**
  * module title
  * @var string $title
  */
  var $title = "Poll";
  /**
  * module description
  * @var string $description
  */
  var $description = "Poll management";

  /**
  * gylph
  * @var string $glyph
  */
  var $glyph = 'poll.gif';

  /**
  * permissions
  * @var array $permissions
  */
  var $permissions = array(
    1 => 'Manage',
    2 => 'Edit categories',
  );

  /**
  * Execute module
  *
  * @access public
  */
  function execModule() {
    if ($this->hasPerm(1, TRUE)) {
      $poll = new base_poll;
      $poll->module = $this;
      $poll->layout = $this->layout;
      // load parameters
      $poll->initialize();
      // process from init
      $poll->execute();
      // output data no database transaction
      $poll->getXML();
    }
  }
}

