<?php

namespace Payhub\Support;

use GeoService\Service\GeoService;
use Payhub\Models\Base;
use Payhub\Models\OrderClient;
use Payhub\Models\OrderDelivery;

class Normalizer
{
    protected static ?GeoService $geoService = null;

    protected array $searched = [];

    public static function setGeoService(GeoService $geoService): void
    {
        static::$geoService = $geoService;
    }

    public function geoService(): ?GeoService
    {
        if (is_null(static::$geoService)) {
            static::setGeoService(new GeoService);
        }

        return static::$geoService;
    }

    /**
     * @param  Base|OrderClient|OrderDelivery  $model
     */
    public function build(Base $model): void
    {
        if (property_exists($model, 'country') && $model?->getCountry()) {
            $model->setCountry(
                $this->getGeoId($model->getCountry(), 'country')
            );
        }

        if (property_exists($model, 'city') && $model?->getCity()) {
            try {
                $city = $this->getGeoId($model->getCity(), 'city');
            } catch (\LogicException $e) {
                $city = null;
            }

            $model->setCity($city);
        }
    }

    private function getGeoId($keyword, string $type): string
    {
        if ($this->geoService()->isServiceId($keyword) || strlen($keyword) === 2) {
            return $keyword;
        }

        if (! isset($this->searched[$keyword])) {
            $result = $this->geoService()->search($keyword, null, $type);

            if ($result->count() !== 1) {
                throw new \LogicException(sprintf('%s [%s] not found', ucfirst($type), $keyword));
            }
            $this->searched[$keyword] = $result->first()->getId();
        }

        return $this->searched[$keyword];
    }
}
