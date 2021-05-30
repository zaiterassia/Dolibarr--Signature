<?php
/* Copyright (C) 2004-2018  Laurent Destailleur     <eldy@users.sourceforge.net>
 * Copyright (C) 2018-2019  Nicolas ZABOURI         <info@inovea-conseil.com>
 * Copyright (C) 2019-2020  Frédéric France         <frederic.france@netlogic.fr>
 * Copyright (C) 2021 Assia Zaiter <assia.zaiter@exher.fr>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

/**
 * 	\defgroup   signature     Module Signature
 *  \brief      Signature module descriptor.
 *
 *  \file       signature/class/actions_signature.class.php
 *  \ingroup    signature
 *  \brief     hook overload.
 */

/**
 * Class ActionsSignature
 */
class ActionsSignature {

/**
	 * Overloading the formattachOptions function 
	 *
	 * @param   array()         $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          $action         Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function formattachOptions($parameters, &$object, &$action, $hookmanager)
	{
		global $conf, $user, $langs;

		$error = 0; // Error counter

        /*print_r($parameters); print_r($object); echo "action: " . $action; */
	    if (in_array($parameters['currentcontext'], array('formfile')))	    // do something only for the context 'somecontext1' or 'somecontext2'
	    {
			// Do what you want here...
			// You can for example call global vars like $fieldstosearchall to overwrite them, or update database depending on $action and $_POST values.
		}

		if (! $error) {
			$html = '<div class="titre inline-block">Ajouter une signature de document</div>';
			$html .= '<link rel="stylesheet" href="../custom/signature/css/signature-pad.css">';
			$html .= '<div class="inline-block" style="padding-right: 10px;">';
			$html .= '<button class="button" id="myBtn">Signer en ligne</button></div>';
			$html .= '<form id="sigform" action="../custom/signature/class/action.formmodal.php" method="post">';
			$html .= '<input id="siginput" type="hidden" name="sig" value="" />';
			$html .= '<input id="dir" type="hidden" name="dir" value="' . $conf->user->dir_output.'/'.$object->id.'" />';
			$html .= '</form>';
			$html .= file_get_contents(DOL_DOCUMENT_ROOT. '/custom/signature/class/html.formmodal.class.php');
			$html .= '<script src="../custom/signature/js/signature_pad.umd.js"></script>';
			$html .= '<script src="../custom/signature/js/app.js"></script>';
			$html .= '<script src="../custom/signature/js/script.js"></script>';
			$hookmanager->resPrint = $html ;
			return 0;                                    // or return 1 to replace standard code
		} else {
			// $this->errors[] = 'Error message';
			return -1;
		}
	}
}