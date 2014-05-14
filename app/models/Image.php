<?php

class Image extends \Eloquent {
	protected $fillable = [];

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function size()
	{
		return (int)$this->size;
	}
}