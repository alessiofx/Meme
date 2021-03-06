<?php
/**
 * Meme CMS
 *
 * LICENSE
 *
 * This source file is subject to the GPL license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://memecms.com/license/gnu-gpl
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@memecms.com so we can send you a copy immediately.
 *
 * @version		MEME
 * @package		MemeCMS
 * @copyright	Copyright (C) 2009 - 2012 Alessio Pigliacelli, Studio Pigliacelli S.a.s. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt http://memecms.com/license/gnu-gpl
 * @version		$Id: RssController.php 401 2010-11-18 20:25:30Z alex $
 */

class Admin_AjaxController extends Zend_Controller_Action
{
	protected $cache;


    public function init()
    {
    	$this->cache = Zend_Registry::get('Meme_Cache');

    	// Setting model
		$this->SettingsModel = new Admin_Model_DbTable_SettingsTable();
		
		$this->urlAdapter = new Admin_Model_urlAdapter();


    
    }
    
    
   	public function preDispatch()
		{
			//Disable layout

			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender(true);
	
		}


	public function indexAction()
	{
		
		
		
	}
	
	public function pingAction()
	{
	
		$sitemapPingModel = new Admin_Model_sitemapPing();
	
		$status = $sitemapPingModel->pingSitemapGoogle($this->SettingsModel->get('address').'/sitemap.xml');
		if($status == true)
		{
		echo 'ok';	}
		
		echo $this->SettingsModel->get('address').'/sitemap.xml';
	}
	
	public function cleancacheAction()
	{
		$this->cache = Zend_Registry::get('Meme_Cache');

		//cache
		if(extension_loaded('apc') == 1)
					{	// clean all records
						$this->cache->clean(Zend_Cache::CLEANING_MODE_ALL);
 
					}
				else
					{
						$this->cache->clean(Zend_Cache::CLEANING_MODE_ALL);
						$this->cache->clean(Zend_Cache::CLEANING_MODE_OLD);					
					}
		//end cache

	
	}
	
	
	
	public function analitycsAction()
	{

	$analitycsModel = new Admin_Model_Analitycs();
	
	echo $analitycsModel->visits();	
	
	}



}