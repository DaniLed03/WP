<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Automattic\WooCommerce\GoogleListingsAndAds\Vendor\Google\Service\ShoppingContent;

class OrdersReturnRefundLineItemRequest extends \Automattic\WooCommerce\GoogleListingsAndAds\Vendor\Google\Model
{
  /**
   * @var string
   */
  public $lineItemId;
  /**
   * @var string
   */
  public $operationId;
  /**
   * @var Price
   */
  public $priceAmount;
  protected $priceAmountType = Price::class;
  protected $priceAmountDataType = '';
  /**
   * @var string
   */
  public $productId;
  /**
   * @var string
   */
  public $quantity;
  /**
   * @var string
   */
  public $reason;
  /**
   * @var string
   */
  public $reasonText;
  /**
   * @var Price
   */
  public $taxAmount;
  protected $taxAmountType = Price::class;
  protected $taxAmountDataType = '';

  /**
   * @param string
   */
  public function setLineItemId($lineItemId)
  {
    $this->lineItemId = $lineItemId;
  }
  /**
   * @return string
   */
  public function getLineItemId()
  {
    return $this->lineItemId;
  }
  /**
   * @param string
   */
  public function setOperationId($operationId)
  {
    $this->operationId = $operationId;
  }
  /**
   * @return string
   */
  public function getOperationId()
  {
    return $this->operationId;
  }
  /**
   * @param Price
   */
  public function setPriceAmount(Price $priceAmount)
  {
    $this->priceAmount = $priceAmount;
  }
  /**
   * @return Price
   */
  public function getPriceAmount()
  {
    return $this->priceAmount;
  }
  /**
   * @param string
   */
  public function setProductId($productId)
  {
    $this->productId = $productId;
  }
  /**
   * @return string
   */
  public function getProductId()
  {
    return $this->productId;
  }
  /**
   * @param string
   */
  public function setQuantity($quantity)
  {
    $this->quantity = $quantity;
  }
  /**
   * @return string
   */
  public function getQuantity()
  {
    return $this->quantity;
  }
  /**
   * @param string
   */
  public function setReason($reason)
  {
    $this->reason = $reason;
  }
  /**
   * @return string
   */
  public function getReason()
  {
    return $this->reason;
  }
  /**
   * @param string
   */
  public function setReasonText($reasonText)
  {
    $this->reasonText = $reasonText;
  }
  /**
   * @return string
   */
  public function getReasonText()
  {
    return $this->reasonText;
  }
  /**
   * @param Price
   */
  public function setTaxAmount(Price $taxAmount)
  {
    $this->taxAmount = $taxAmount;
  }
  /**
   * @return Price
   */
  public function getTaxAmount()
  {
    return $this->taxAmount;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(OrdersReturnRefundLineItemRequest::class, 'Google_Service_ShoppingContent_OrdersReturnRefundLineItemRequest');
