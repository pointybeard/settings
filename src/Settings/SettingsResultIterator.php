<?php

declare(strict_types=1);

namespace pointybeard\Symphony\Extensions\Settings;

class SettingsResultIterator extends \SymphonyPDO\Lib\ResultIterator
{
    /**
     * Looks through the current set of results for an instance of
     * Models\Setting with a specified name. If it finds one, it returns the
     * value of that setting.
     * @param  string $name the name of the setting to look for
     * @return string|null the value of the setting or null if not located
     */
    public function find(string $name): ?string
    {
        $this->rewind();
        $result = null;
        foreach ($this as $item) {
            if ($item instanceof Models\Setting && $item->name == $name) {
                $result = $item->value();
            }
        }
        $this->rewind();

        return $result;
    }
}
