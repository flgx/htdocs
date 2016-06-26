<?php namespace Backoffice\Managers;


Interface UploadManagerInterface
{
	/**
	 * Get the name of the  entitie field
	 */
	public function getUploadField();

	/**
	 * get the new name of the file
	 */
	public function getUploadNewName();

	/**
	 * get the destination file
	 */
	public function getUploadDestination();
}