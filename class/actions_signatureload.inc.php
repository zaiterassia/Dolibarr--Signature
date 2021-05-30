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
 *  \brief      ajax call.
 *
 *  \file       signature/class/actions_signatureload.inc.php
 *  \ingroup    signature
 *  \brief     ajax call to load signature.
 */
require '../../../main.inc.php';

$tmp_dir = DOL_DOCUMENT_ROOT.'/custom/signature/tmp/';
$tmp_name = $tmp_dir . "tmp_file.png";
$generatethumbs = 1;
$upload_dir = $_POST['dir'];
$name = "signature.png";
$destfull = $upload_dir . "/" . $name;
if ( $_POST['sig'] ) {
    $res = file_put_contents($destfull, file_get_contents($_POST['sig']));

	// Generate thumbs.
	if ($res && $generatethumbs)
	{
		    global $maxwidthsmall, $maxheightsmall, $maxwidthmini, $maxheightmini;
			include_once DOL_DOCUMENT_ROOT.'/core/lib/images.lib.php';
		if (image_format_supported($destfull) == 1)
		{
			// Create thumbs
			// We can't use $object->addThumbs here because there is no $object known
			// Used on logon for example
			$imgThumbSmall = vignette($destfull, $maxwidthsmall, $maxheightsmall, '_small', 50, "thumbs");
			// Create mini thumbs for image (Ratio is near 16/9)
			// Used on menu or for setup page for example
			$imgThumbMini = vignette($destfull, $maxwidthmini, $maxheightmini, '_mini', 50, "thumbs");
		}
	}

    if ($res) {
    	setEventMessages($langs->trans("FileTransferComplete"), null, 'mesgs');
    	echo 1;
    }
    else {
    	setEventMessages($langs->trans("ErrorFileNotUploaded"), null, 'errors');
    	echo 0;

    }
}
else{
	echo 0;
}
?>