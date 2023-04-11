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
     * @param Base|OrderClient|OrderDelivery $model
     * @return void
     */
    public function build(Base $model): void
    {
        if (property_exists($model, 'country') && $model?->getCountry()) {
            $model->setCountry(
                $this->getGeoId($model->getCountry(), 'country')
            );
        }

        if (property_exists($model, 'city') && $model?->getCity()) {
            $model->setCity(
                $this->getGeoId($model->getCity(), 'city')
            );
        }
    }

    private function getGeoId($id, string $type): string
    {
        if ($this->geoService()->isServiceId($id) || strlen($id) === 2) {
            return $id;
        }

        if (!isset($this->searched[$id])) {
            $result = $this->geoService()->search($id, null, $type);

            if ($result->count() !== 1) {
                throw new \LogicException(ucfirst($type) . ' not found');
            }
            $this->searched[$id] = $result->first()->getId();
        }
        return $this->searched[$id];
    }
}
