<?php
namespace PfarreNg\Calmedia\Domain\Repository;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Thomas Huber <thomas.huber@huber-web.at>, Pfarre Neuguntramsdorf
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * The repository for Typs
 */
class PlaceRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/*
	 * Default ordering for all queries created by this repository
	 */

	protected $defaultOrderings = array(
		'name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	);
	
	/*
	 * list all HolidayTemplates
	 */
	public function listBackendPlaces($pid){
		$query = $this->createQuery();
		$query->getQuerySettings()->setStoragePageIds(array($pid));
		return $query->execute();
	}
}