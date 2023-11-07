<?php

namespace Fakell\BotMessenger\Model\Attachment\Template\Receipt;

class Summary implements \JsonSerializable {
    /**
     * @var null|int
     */
    private $subtotal;

    /**
     * @var null|int
     */
    private $shippingCost;

    /**
     * @var null|int
     */
    private $totalTax;

    /**
     * @var int
     */
    private $totalCost;

    /**
     * @param int $totalCost
     * @param null|int $totalTax
     * @param null|int $subtotal
     * @param null|int $shippingCost
     */
    public function __construct(int $totalCost, $totalTax = null, $subtotal = null, $shippingCost = null) {
        $this->subtotal = $subtotal;
        $this->shippingCost = $shippingCost;
        $this->totalCost = $totalCost;
        $this->totalTax = $totalTax;
    }

    /**
     * @return int
     */
    public function getSubtotal() {
        return $this->subtotal;
    }

    /**
     * @return int
     */
    public function getShippingCost() {
        return $this->shippingCost;
    }

    /**
     * @return int
     */
    public function getTotalTax() {
        return $this->totalTax;
    }

    /**
     * @return int
     */
    public function getTotalCost() {
        return $this->totalCost;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        return [
            'subtotal' => $this->subtotal,
            'shipping_cost' => $this->shippingCost,
            'total_tax' => $this->totalTax,
            'total_cost' => $this->totalCost,
        ];
    }
}
