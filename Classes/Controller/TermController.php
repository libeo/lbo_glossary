<?php

namespace Libeo\LboGlossary\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Cyril Janody <cyril.janody@libeo.com>, Libéo
 *  (c) 2015 Pierre Boivin <pierre.boivin@libeo.com>, Libéo
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
 * TermController
 */
class TermController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * termRepository
     *
     * @var \Libeo\LboGlossary\Domain\Repository\TermRepository
     * @inject
     */
    protected $termRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $terms = $this->termRepository->findAll();
        $this->view->assign('terms', $terms);
    }

}