<?php
/**
 * @package     IJoomer.Backend
 * @subpackage  com_ijoomeradv.views
 *
 * @copyright   Copyright (C) 2010 - 2014 Tailored Solutions PVT. Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;


/**
 * The Class For IJoomeradvViewItem which will Extends JViewLegacy
 *
 * @package     IJoomer.Backdend
 * @subpackage  com_ijoomeradv.view
 * @since       1.0
 */
class IjoomeradvViewItem extends JViewLegacy
{
	protected $form;

	protected $item;

	protected $modules;

	protected $state;

	/**
	 * The Display Function
	 *
	 * @param   [type]  $tpl  $tpl
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		$this->form    = $this->get('Form');
		$this->item    = $this->get('Item');
		$this->modules = $this->get('Modules');
		$this->state   = $this->get('State');

		$extention = explode('.', $this->form->getValue('views'));
		$extention = $extention[0];

		$lang     = JFactory::getLanguage();
		$base_dir = JPATH_COMPONENT_SITE . '/' . "extensions" . '/' . $extention;
		$lang->load($extention, $base_dir, null, true);

		parent::display($tpl);
		$this->addToolbar();
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since    1.0
	 *
	 * @return void
	 */
	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', true);

		$user  = JFactory::getUser();
		$isNew = ($this->item->id == 0);

		JToolBarHelper::title(JText::_($isNew ? 'COM_IJOOMERADV_VIEW_NEW_ITEM_TITLE' : 'COM_IJOOMERADV_VIEW_EDIT_ITEM_TITLE'), 'menu-add');

		// If a new item, can save the item.  Allow users with edit permissions to apply changes to prevent returning to grid.
		JToolBarHelper::apply('apply');
		JToolBarHelper::save('save');
		JToolBarHelper::save2new('save2new');

		JToolBarHelper::cancel('cancel');
	}
}
