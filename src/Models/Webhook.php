<?php

namespace Payhub\Models;

class Webhook extends Base
{
    protected ?int $id = null;

    protected ?string $value = null;

    public function __construct($params = [])
    {
        if (is_array($params)) {
            parent::__construct($params);
        } elseif (is_numeric($params)) {
            $this->setId($params);
        } else {
            $this->setValue($params);
        }
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'value' => $this->getValue(),
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }
}
