<?php declare(strict_types=1);

/**
 * @license Apache 2.0
 */

namespace OpenApi\Annotations;

/**
 * @Annotation
 */
#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Get extends Operation
{
    /**
     * @inheritdoc
     */
    public $method = 'get';

    /**
     * @inheritdoc
     */
    public static $_parents = [
        PathItem::class,
    ];
}
