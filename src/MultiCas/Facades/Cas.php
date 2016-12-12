<?php namespace LIYunde\MultiCas\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Cas
 * @package LIYunde\MultiCas\Facades
 *
 * @method LIYunde\MultiCas\CasServer default()
 */
class Cas extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'cas'; }

}