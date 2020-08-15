<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * CatalogPricingRule Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class CatalogPricingRule implements ArrayAccess
{
    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'name' => 'string',
        'time_period_ids' => 'string[]',
        'total_price_money' => '\SquareConnect\Model\Money',
        'item_price_money' => '\SquareConnect\Model\Money',
        'discount_id' => 'string',
        'match_products_id' => 'string',
        'apply_products_id' => 'string',
        'stackable' => 'string',
        'exclude_products_id' => 'string',
        'valid_from_date' => 'string',
        'valid_from_local_time' => 'string',
        'valid_until_date' => 'string',
        'valid_until_local_time' => 'string'
    );
  
    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'name' => 'name',
        'time_period_ids' => 'time_period_ids',
        'total_price_money' => 'total_price_money',
        'item_price_money' => 'item_price_money',
        'discount_id' => 'discount_id',
        'match_products_id' => 'match_products_id',
        'apply_products_id' => 'apply_products_id',
        'stackable' => 'stackable',
        'exclude_products_id' => 'exclude_products_id',
        'valid_from_date' => 'valid_from_date',
        'valid_from_local_time' => 'valid_from_local_time',
        'valid_until_date' => 'valid_until_date',
        'valid_until_local_time' => 'valid_until_local_time'
    );
  
    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'name' => 'setName',
        'time_period_ids' => 'setTimePeriodIds',
        'total_price_money' => 'setTotalPriceMoney',
        'item_price_money' => 'setItemPriceMoney',
        'discount_id' => 'setDiscountId',
        'match_products_id' => 'setMatchProductsId',
        'apply_products_id' => 'setApplyProductsId',
        'stackable' => 'setStackable',
        'exclude_products_id' => 'setExcludeProductsId',
        'valid_from_date' => 'setValidFromDate',
        'valid_from_local_time' => 'setValidFromLocalTime',
        'valid_until_date' => 'setValidUntilDate',
        'valid_until_local_time' => 'setValidUntilLocalTime'
    );
  
    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'name' => 'getName',
        'time_period_ids' => 'getTimePeriodIds',
        'total_price_money' => 'getTotalPriceMoney',
        'item_price_money' => 'getItemPriceMoney',
        'discount_id' => 'getDiscountId',
        'match_products_id' => 'getMatchProductsId',
        'apply_products_id' => 'getApplyProductsId',
        'stackable' => 'getStackable',
        'exclude_products_id' => 'getExcludeProductsId',
        'valid_from_date' => 'getValidFromDate',
        'valid_from_local_time' => 'getValidFromLocalTime',
        'valid_until_date' => 'getValidUntilDate',
        'valid_until_local_time' => 'getValidUntilLocalTime'
    );
  
    /**
      * $name User-defined name for the pricing rule. For example, \"Buy one get one free\" or \"10% off\".
      * @var string
      */
    protected $name;
    /**
      * $time_period_ids Unique ID for the [CatalogTimePeriod](#type-catalogtimeperiod)s when this pricing rule is in effect. If left unset, the pricing rule is always in effect.
      * @var string[]
      */
    protected $time_period_ids;
    /**
      * $total_price_money The total amount of money to charge for all matched items.  Only one of `total_price_money`, `item_price`, or `discount` can be supplied.
      * @var \SquareConnect\Model\Money
      */
    protected $total_price_money;
    /**
      * $item_price_money The amount of money to charge for each matched item.  Only one of `total_price_money`, `item_price`, or `discount` can be supplied.
      * @var \SquareConnect\Model\Money
      */
    protected $item_price_money;
    /**
      * $discount_id Unique ID for the [CatalogDiscount](#type-catalogdiscount) to take off the price of all matched items.  Only one of `total_price_money`, `item_price`, or `discount` can be supplied.
      * @var string
      */
    protected $discount_id;
    /**
      * $match_products_id Unique ID for the [CatalogProductSet](#type-catalogproductset) that will be matched by this rule. A match rule matches within the entire cart.
      * @var string
      */
    protected $match_products_id;
    /**
      * $apply_products_id The [CatalogProductSet](#type-catalogproductset) to apply the pricing rule to within the set of matched products specified by `match_products_id`. An apply rule can only match once within the set of matched products. If left unset, the pricing rule will be applied to all products within the set of matched products.
      * @var string
      */
    protected $apply_products_id;
    /**
      * $stackable Describes how the pricing rule can be combined with other pricing rules. See [Stackable](#type-stackable) for all possible values. See [AggregationStrategy](#type-aggregationstrategy) for possible values
      * @var string
      */
    protected $stackable;
    /**
      * $exclude_products_id Identifies the [CatalogProductSet](#type-catalogproductset) to exclude from this pricing rule. An exclude rule matches within the subset of the cart that fits the match rules (the match set). An exclude rule can only match once in the match set. If not supplied, the pricing will be applied to all products in the match set. Other products retain their base price, or a price generated by other rules.
      * @var string
      */
    protected $exclude_products_id;
    /**
      * $valid_from_date Represents the date the Pricing Rule is valid from. Represented in RFC3339 full-date format (YYYY-MM-DD).
      * @var string
      */
    protected $valid_from_date;
    /**
      * $valid_from_local_time Represents the local time the pricing rule should be valid from. Time zone is determined by the device running the Point of Sale app.  Represented in RFC3339 partial-time format (HH:MM:SS). Partial seconds will be truncated.
      * @var string
      */
    protected $valid_from_local_time;
    /**
      * $valid_until_date Represents the date the pricing rule will become inactive.  Represented in RFC3339 full-date format (YYYY-MM-DD).
      * @var string
      */
    protected $valid_until_date;
    /**
      * $valid_until_local_time Represents the local time at which the pricing rule will become inactive. Time zone is determined by the device running the Point of Sale app.  Represented in RFC3339 partial-time format (HH:MM:SS). Partial seconds will be truncated.
      * @var string
      */
    protected $valid_until_local_time;

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initializing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            if (isset($data["name"])) {
              $this->name = $data["name"];
            } else {
              $this->name = null;
            }
            if (isset($data["time_period_ids"])) {
              $this->time_period_ids = $data["time_period_ids"];
            } else {
              $this->time_period_ids = null;
            }
            if (isset($data["total_price_money"])) {
              $this->total_price_money = $data["total_price_money"];
            } else {
              $this->total_price_money = null;
            }
            if (isset($data["item_price_money"])) {
              $this->item_price_money = $data["item_price_money"];
            } else {
              $this->item_price_money = null;
            }
            if (isset($data["discount_id"])) {
              $this->discount_id = $data["discount_id"];
            } else {
              $this->discount_id = null;
            }
            if (isset($data["match_products_id"])) {
              $this->match_products_id = $data["match_products_id"];
            } else {
              $this->match_products_id = null;
            }
            if (isset($data["apply_products_id"])) {
              $this->apply_products_id = $data["apply_products_id"];
            } else {
              $this->apply_products_id = null;
            }
            if (isset($data["stackable"])) {
              $this->stackable = $data["stackable"];
            } else {
              $this->stackable = null;
            }
            if (isset($data["exclude_products_id"])) {
              $this->exclude_products_id = $data["exclude_products_id"];
            } else {
              $this->exclude_products_id = null;
            }
            if (isset($data["valid_from_date"])) {
              $this->valid_from_date = $data["valid_from_date"];
            } else {
              $this->valid_from_date = null;
            }
            if (isset($data["valid_from_local_time"])) {
              $this->valid_from_local_time = $data["valid_from_local_time"];
            } else {
              $this->valid_from_local_time = null;
            }
            if (isset($data["valid_until_date"])) {
              $this->valid_until_date = $data["valid_until_date"];
            } else {
              $this->valid_until_date = null;
            }
            if (isset($data["valid_until_local_time"])) {
              $this->valid_until_local_time = $data["valid_until_local_time"];
            } else {
              $this->valid_until_local_time = null;
            }
        }
    }
    /**
     * Gets name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
  
    /**
     * Sets name
     * @param string $name User-defined name for the pricing rule. For example, \"Buy one get one free\" or \"10% off\".
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Gets time_period_ids
     * @return string[]
     */
    public function getTimePeriodIds()
    {
        return $this->time_period_ids;
    }
  
    /**
     * Sets time_period_ids
     * @param string[] $time_period_ids Unique ID for the [CatalogTimePeriod](#type-catalogtimeperiod)s when this pricing rule is in effect. If left unset, the pricing rule is always in effect.
     * @return $this
     */
    public function setTimePeriodIds($time_period_ids)
    {
        $this->time_period_ids = $time_period_ids;
        return $this;
    }
    /**
     * Gets total_price_money
     * @return \SquareConnect\Model\Money
     */
    public function getTotalPriceMoney()
    {
        return $this->total_price_money;
    }
  
    /**
     * Sets total_price_money
     * @param \SquareConnect\Model\Money $total_price_money The total amount of money to charge for all matched items.  Only one of `total_price_money`, `item_price`, or `discount` can be supplied.
     * @return $this
     */
    public function setTotalPriceMoney($total_price_money)
    {
        $this->total_price_money = $total_price_money;
        return $this;
    }
    /**
     * Gets item_price_money
     * @return \SquareConnect\Model\Money
     */
    public function getItemPriceMoney()
    {
        return $this->item_price_money;
    }
  
    /**
     * Sets item_price_money
     * @param \SquareConnect\Model\Money $item_price_money The amount of money to charge for each matched item.  Only one of `total_price_money`, `item_price`, or `discount` can be supplied.
     * @return $this
     */
    public function setItemPriceMoney($item_price_money)
    {
        $this->item_price_money = $item_price_money;
        return $this;
    }
    /**
     * Gets discount_id
     * @return string
     */
    public function getDiscountId()
    {
        return $this->discount_id;
    }
  
    /**
     * Sets discount_id
     * @param string $discount_id Unique ID for the [CatalogDiscount](#type-catalogdiscount) to take off the price of all matched items.  Only one of `total_price_money`, `item_price`, or `discount` can be supplied.
     * @return $this
     */
    public function setDiscountId($discount_id)
    {
        $this->discount_id = $discount_id;
        return $this;
    }
    /**
     * Gets match_products_id
     * @return string
     */
    public function getMatchProductsId()
    {
        return $this->match_products_id;
    }
  
    /**
     * Sets match_products_id
     * @param string $match_products_id Unique ID for the [CatalogProductSet](#type-catalogproductset) that will be matched by this rule. A match rule matches within the entire cart.
     * @return $this
     */
    public function setMatchProductsId($match_products_id)
    {
        $this->match_products_id = $match_products_id;
        return $this;
    }
    /**
     * Gets apply_products_id
     * @return string
     */
    public function getApplyProductsId()
    {
        return $this->apply_products_id;
    }
  
    /**
     * Sets apply_products_id
     * @param string $apply_products_id The [CatalogProductSet](#type-catalogproductset) to apply the pricing rule to within the set of matched products specified by `match_products_id`. An apply rule can only match once within the set of matched products. If left unset, the pricing rule will be applied to all products within the set of matched products.
     * @return $this
     */
    public function setApplyProductsId($apply_products_id)
    {
        $this->apply_products_id = $apply_products_id;
        return $this;
    }
    /**
     * Gets stackable
     * @return string
     */
    public function getStackable()
    {
        return $this->stackable;
    }
  
    /**
     * Sets stackable
     * @param string $stackable Describes how the pricing rule can be combined with other pricing rules. See [Stackable](#type-stackable) for all possible values. See [AggregationStrategy](#type-aggregationstrategy) for possible values
     * @return $this
     */
    public function setStackable($stackable)
    {
        $this->stackable = $stackable;
        return $this;
    }
    /**
     * Gets exclude_products_id
     * @return string
     */
    public function getExcludeProductsId()
    {
        return $this->exclude_products_id;
    }
  
    /**
     * Sets exclude_products_id
     * @param string $exclude_products_id Identifies the [CatalogProductSet](#type-catalogproductset) to exclude from this pricing rule. An exclude rule matches within the subset of the cart that fits the match rules (the match set). An exclude rule can only match once in the match set. If not supplied, the pricing will be applied to all products in the match set. Other products retain their base price, or a price generated by other rules.
     * @return $this
     */
    public function setExcludeProductsId($exclude_products_id)
    {
        $this->exclude_products_id = $exclude_products_id;
        return $this;
    }
    /**
     * Gets valid_from_date
     * @return string
     */
    public function getValidFromDate()
    {
        return $this->valid_from_date;
    }
  
    /**
     * Sets valid_from_date
     * @param string $valid_from_date Represents the date the Pricing Rule is valid from. Represented in RFC3339 full-date format (YYYY-MM-DD).
     * @return $this
     */
    public function setValidFromDate($valid_from_date)
    {
        $this->valid_from_date = $valid_from_date;
        return $this;
    }
    /**
     * Gets valid_from_local_time
     * @return string
     */
    public function getValidFromLocalTime()
    {
        return $this->valid_from_local_time;
    }
  
    /**
     * Sets valid_from_local_time
     * @param string $valid_from_local_time Represents the local time the pricing rule should be valid from. Time zone is determined by the device running the Point of Sale app.  Represented in RFC3339 partial-time format (HH:MM:SS). Partial seconds will be truncated.
     * @return $this
     */
    public function setValidFromLocalTime($valid_from_local_time)
    {
        $this->valid_from_local_time = $valid_from_local_time;
        return $this;
    }
    /**
     * Gets valid_until_date
     * @return string
     */
    public function getValidUntilDate()
    {
        return $this->valid_until_date;
    }
  
    /**
     * Sets valid_until_date
     * @param string $valid_until_date Represents the date the pricing rule will become inactive.  Represented in RFC3339 full-date format (YYYY-MM-DD).
     * @return $this
     */
    public function setValidUntilDate($valid_until_date)
    {
        $this->valid_until_date = $valid_until_date;
        return $this;
    }
    /**
     * Gets valid_until_local_time
     * @return string
     */
    public function getValidUntilLocalTime()
    {
        return $this->valid_until_local_time;
    }
  
    /**
     * Sets valid_until_local_time
     * @param string $valid_until_local_time Represents the local time at which the pricing rule will become inactive. Time zone is determined by the device running the Point of Sale app.  Represented in RFC3339 partial-time format (HH:MM:SS). Partial seconds will be truncated.
     * @return $this
     */
    public function setValidUntilLocalTime($valid_until_local_time)
    {
        $this->valid_until_local_time = $valid_until_local_time;
        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset 
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }
  
    /**
     * Gets offset.
     * @param  integer $offset Offset 
     * @return mixed 
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }
  
    /**
     * Sets value based on offset.
     * @param  integer $offset Offset 
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }
  
    /**
     * Unsets offset.
     * @param  integer $offset Offset 
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }
  
    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) {
            return json_encode(\SquareConnect\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        } else {
            return json_encode(\SquareConnect\ObjectSerializer::sanitizeForSerialization($this));
        }
    }
}
