<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Block XP settings form.
 *
 * @package    block_xp
 * @copyright  2014 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir . '/formslib.php');

/**
 * Block XP settings form class.
 *
 * @package    block_xp
 * @copyright  2014 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_xp_settings_form extends moodleform {

    /**
     * Form definintion.
     *
     * @return void
     */
    public function definition() {
        $mform = $this->_form;

        $defaultconfig = $this->_customdata['defaultconfig'];

        $mform->addElement('text', 'levels', get_string('levelcount', 'block_xp'));
        $mform->setDefault('levels', $defaultconfig->levels);
        $mform->setType('levels', PARAM_INT);

        $mform->addElement('checkbox', 'enablelog', get_string('enablelogging', 'block_xp'));
        $mform->setDefault('enablelog', $defaultconfig->enablelog);

        $options = array(
            '0' => get_string('forever', 'block_xp'),
            '1' => get_string('for1day', 'block_xp'),
            '3' => get_string('for3days', 'block_xp'),
            '7' => get_string('for1week', 'block_xp'),
            '30' => get_string('for1month', 'block_xp'),
        );
        $mform->addElement('select', 'keeplogs', get_string('keeplogs', 'block_xp'), $options);
        $mform->setDefault('keeplogs', $defaultconfig->keeplogs);

        $this->add_action_buttons();
    }

    /**
     * Data validate.
     *
     * @param array $data The data submitted.
     * @param array $files The files submitted.
     * @return array of errors.
     */
    public function validation($data, $files) {
        $errors = array();
        if ($data['levels'] < 2) {
            $errors['levels'] = get_string('errorlevelsincorrect', 'block_xp');
        }
        return $errors;
    }

}
