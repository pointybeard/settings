<?php

declare(strict_types=1);

namespace pointybeard\Symphony\Extensions\Settings\Models;

use pointybeard\Symphony\Classmapper;
use pointybeard\Symphony\Extensions\Settings;

final class Setting extends Classmapper\AbstractModel implements Classmapper\Interfaces\FilterableModelInterface, Classmapper\Interfaces\SortableModelInterface
{
    use Classmapper\Traits\HasModelTrait;
    use Classmapper\Traits\HasFilterableModelTrait;
    use Classmapper\Traits\HasSortableModelTrait;

    public function getSectionHandle(): string
    {
        return 'settings';
    }

    protected static function getCustomFieldMapping(): array
    {
        return [
            'name' => [
                'flags' => self::FLAG_STR | self::FLAG_SORTBY | self::FLAG_SORTASC | self::FLAG_REQUIRED,
            ],

            'value' => [
                'flags' => self::FLAG_STR | self::FLAG_REQUIRED,
            ],

            'date-modified-at' => [
                'flags' => self::FLAG_NULL,
                'databaseFieldName' => 'date',
            ],

            'date-created-at' => [
                'databaseFieldName' => 'date',
                'flags' => self::FLAG_REQUIRED,
            ],

            'group' => [
                'flags' => self::FLAG_STR | self::FLAG_REQUIRED | self::FLAG_ARRAY,
            ],
        ];
    }

    public static function fetchByGroup(string $group): \Iterator
    {
        self::setDefaultResultContainer('\\pointybeard\\Symphony\\Extensions\\Settings\\SettingsResultIterator');

        $result = (new self)
            ->appendFilter(Classmapper\FilterFactory::build('FindInSet', 'group', [$group]))
            ->filter()
        ;

        self::restoreDefaultResultContainer();

        return $result;
    }

    public static function loadFromNameFilterByGroup(string $name, string $group): ?self
    {
        $result = (new self)
            ->appendFilter(Classmapper\FilterFactory::build('FindInSet', 'group', [$group]))
            ->appendFilter(Classmapper\FilterFactory::build('Basic', 'name', $name))
            ->filter()
            ->current()
        ;

        // current() returns true/false but we want to be returning NULL so we
        // cannot use the return value directly.
        return $result instanceof self ? $result : null;
    }
}
