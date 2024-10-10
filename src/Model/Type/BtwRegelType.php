<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;

/**
 * @psalm-immutable
 *
 * @method static BtwSoort TE_VORDEREN_BTW_TYPE()
 * @method static BtwSoort AF_TE_DRAGEN_BTW_TYPE()
 */
final class BtwRegelType extends Enum
{
    private const TE_VORDEREN_BTW_TYPE  = 'TeVorderenBtwType';
    private const AF_TE_DRAGEN_BTW_TYPE = 'AfTeDragenBtwType';
}