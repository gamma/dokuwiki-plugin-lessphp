<?php
/**
 * lessphp wrapper plugin
 * 
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     i-net software <tools@inetsoftware.de>
 * @author     Gerry Weissbach <gweissbach@inetsoftware.de>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'action.php');

class action_plugin_lessphp extends DokuWiki_Action_Plugin {
	
    /**
	* Register Plugin in DW
	**/
    public function register(Doku_Event_Handler $controller) {
		$controller->register_hook('INIT_LANG_LOAD', 'BEFORE', $this, 'lessphp_load');
	}

	/**
	* Check for Template changes
	**/
	function lessphp_load(&$event)
	{
		global $conf, $INFO;
        if ( ! strrpos( $_SERVER['SCRIPT_FILENAME'], 'css.php', -7 ) ) {
            return;
        }
		
		$lessInc = dirname(__FILE__) . '/inc/lessc.inc.php';
		if ( !file_exists($lessInc) ) {
    		system("git submodule init " . dirname(__FILE__) );
    		system("git submodule update " . dirname(__FILE__) );
		}
		
		// If this is a call for css.php include the other library
		if ( file_exists($lessInc) ) {
    		require_once( $lessInc );
        }
	}
}
