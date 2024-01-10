<?php

namespace MuseaShows\Lib;

/**
 * interface PostTypeInterface
 * @package MuseaShows\Lib;
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