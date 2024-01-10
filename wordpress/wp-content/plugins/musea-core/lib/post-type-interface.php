<?php

namespace MuseaCore\Lib;

/**
 * interface PostTypeInterface
 * @package MuseaCore\Lib;
 */
interface PostTypeInterface {
	/**
	 * @return string
	 */
	public function getBase();
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register();
}