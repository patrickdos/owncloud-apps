<?php
/**
 * ownCloud - user_saml
 *
 * @author Sixto Martin <smartin@yaco.es>
 * @copyright 2012 Yaco Sistemas // CONFIA
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

/**
 * This class is used to find another possible identities of a single user.
 */
class OC_USER_SAML_Consolidator {

	public static function getSimilarIdentities($userUid, $userDisplayName) {
		$matches = OCP\User::getDisplayNames($userDisplayName, 10, 0);
		$result = array();
		foreach ($matches as $uid => $displayName) {
			if (OC_User::isAdminUser($uid) ||
			  mb_strlen($displayName,'UTF-8') !== mb_strlen($userDisplayName,'UTF-8') ||
			  $userUid === $uid) {
				unset($matches[$uid]);
			} else {
				$replaceIdx = strpos($uid, '@');
				if ($replaceIdx >= 3) {
					$replaceIdx = $replaceIdx - 2;
				} else {
					$replaceIdx = $replaceIdx - 1;
				}
				$obfuscatedId = substr_replace($uid, '●●●', 1, $replaceIdx );
				$result[$obfuscatedId] = $displayName;
			}
		}
		return $result;
	}
}
