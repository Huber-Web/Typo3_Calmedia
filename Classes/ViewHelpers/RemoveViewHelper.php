<?php
namespace PfarreNg\Calmedia\ViewHelpers;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Beuser\Domain\Model\BackendUser;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

/**
 * Displays 'Delete user' link with sprite icon to remove user
 *
 * @internal
 */
class RemoveViewHelper extends AbstractViewHelper implements CompilableInterface
{
    /**
     * Render link with sprite icon to remove user
     *
     * @param onject $object Target Object
     * @param String $class Target Class Name
     * @param String $cssClass
     * @return string
     */
    public function render($object, $class, $cssClass = '')
    {
        return static::renderStatic(
            array(
                'object' => $object,
            	'class' => $class,
            	'cssClass' => $cssClass
            ),
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
    }

    /**
     * @param array $arguments
     * @param callable $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     *
     * @return string
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        /** @var \TYPO3\CMS\Beuser\Domain\Model\BackendUser $backendUser */
        $object = $arguments['object'];
        $class = $arguments['class'];
        $cssClass = $arguments['cssClass'];
        /** @var BackendUserAuthentication $beUser */
        $beUser = $GLOBALS['BE_USER'];
        /** @var IconFactory $iconFactory */
        $iconFactory = GeneralUtility::makeInstance(IconFactory::class);

        $urlParameters = [
            'cmd[' . $class . '][' . $object->getUid() . '][delete]' => 1,
            'vC' => $beUser->veriCode(),
            'prErr' => 1,
            'uPT' => 1,
            'redirect' => GeneralUtility::getIndpEnv('REQUEST_URI')
        ];
        $url = BackendUtility::getModuleUrl('tce_db', $urlParameters);
        
        return '<a class="btn btn-default ' . $cssClass . '" href="' . htmlspecialchars($url) . '"'
            . ' data-severity="warning"'
            . ' data-title="' . htmlspecialchars($GLOBALS['LANG']->sL('LLL:EXT:lang/locallang_alt_doc.xlf:label.confirm.delete_record.title')) . '"'
            . ' data-content="' . htmlspecialchars($GLOBALS['LANG']->sL('LLL:EXT:lang/locallang_alt_doc.xlf:label.confirm.delete_record.title')) . '" '
            . ' data-button-close-text="' . htmlspecialchars($GLOBALS['LANG']->sL('LLL:EXT:lang/locallang_common.xlf:cancel')) . '"'
            . '>' . $iconFactory->getIcon('actions-edit-delete', Icon::SIZE_SMALL)->render() . '</a>';
    }
}