<?php

namespace WordpressCustomSettings;

class SettingSection {

	protected $name;
	protected $title;
	protected $description;

	/**
	 * SettingSection constructor.
	 *
	 * @param string $name
	 * @param string $title
	 * @param string $description
	 */
	public function __construct( $name, $title, $description = '' ) {
		$this->name        = $name;
		$this->title       = $title;
		$this->description = $description;
	}

	/**
	 * @return string
	 */
	public function get_name(): string {
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function get_title(): string {
		return $this->title;
	}

	/**
	 * @return string
	 */
	public function get_description(): string {
		return $this->description;
	}


}