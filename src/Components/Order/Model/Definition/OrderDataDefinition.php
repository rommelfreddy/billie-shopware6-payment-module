<?php

declare(strict_types=1);

/*
 * Copyright (c) Billie GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Billie\BilliePayment\Components\Order\Model\Definition;

use Billie\BilliePayment\Components\Order\Model\Collection\OrderDataCollection;
use Billie\BilliePayment\Components\Order\Model\OrderDataEntity;
use Shopware\Core\Checkout\Order\OrderDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ReferenceVersionField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\UpdatedAtField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class OrderDataDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'billie_order_data';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return OrderDataEntity::class;
    }

    public function getCollectionClass(): string
    {
        return OrderDataCollection::class;
    }

    protected function defaultFields(): array
    {
        return [
            new UpdatedAtField(),
        ];
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField(
                'id',
                OrderDataEntity::FIELD_ID
            ))->addFlags(new Required(), new PrimaryKey()),

            (new FkField(
                'order_id',
                OrderDataEntity::FIELD_ORDER_ID,
                OrderDefinition::class
            ))->addFlags(new Required()),
            (new ReferenceVersionField(OrderDefinition::class))->addFlags(new Required()),

            (new StringField(
                'reference_id',
                OrderDataEntity::FIELD_REFERENCE_ID
            ))->addFlags(new Required()),

            (new StringField(
                'external_invoice_number',
                OrderDataEntity::FIELD_EXTERNAL_INVOICE_NUMBER
            )),

            (new StringField(
                'external_invoice_url',
                OrderDataEntity::FIELD_EXTERNAL_INVOICE_URL
            )),

            (new StringField(
                'external_delivery_note_url',
                OrderDataEntity::FIELD_EXTERNAL_DELIVERY_NOTE_URL
            )),

            (new BoolField(
                'successful',
                OrderDataEntity::FIELD_IS_SUCCESSFUL
            ))->addFlags(new Required()),
        ]);
    }
}
