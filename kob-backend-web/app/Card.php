<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SquareConnect;
use App\Ticket;

class Card extends Model
{
    protected $table = 'cards';
    use SoftDeletes;

    protected $fillable = [
        'number', 'access_id', 'name', 'code', 'expiration', 'active', 'card_address', 'card_address_postal_code', 'card_address_city',
        'state_id', 'country_id',
    ];

    protected $hidden = [];

    //Relationships
    public function tickets(){
        return $this->hasMany(Ticket::class, 'card_id');
    }

    public function access(){
        return $this->belongsTo(Access::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    //Methods
    public static function index($access_id)
    {                  

        $access = Access::find($access_id);
        if(!$access->square_id){
            Card::createSquareUser($access);
        }

        $cards = Card::query();
        $cards = $cards->where('access_id', $access_id);
        if(request()->search){
             $cards = $cards->where('name', 'like', '%'.request()->search.'%');
        }          
        
        $cards = $cards->orderBy('created_at', 'desc');        
        $cards = $cards->paginate(15);
                        
        return $cards;
    }   

    public static function chargeCard($ticket_id){

        if(env("APP_ENV", false)=='dev'){return true;}

        $ticket = Ticket::find($ticket_id);
        

        require(app_path() . '/connect-php-sdk-master/autoload.php');

        $access_token = env('SQUARE_TOKEN');

        // Configure OAuth2 access token for authorization: oauth2
        SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($access_token);

        $customersApi = new SquareConnect\Api\CustomersApi();
        $TransactionsApi = $customersApi = new SquareConnect\Api\TransactionsApi();

        $customerId = $ticket->access->square_id; // Replace with an existing customer_id
        $customerCardId = $ticket->card->card_square_id;  // Replace with an existing customer_id

        if(!$customerId OR !$customerCardId){
            return false;
        }

        // The ID of the location to associate the created transaction with.
        $locationId = env("APP_SQUARE_LOCATION_ID", false);

        // An object object from the PHP SDK with the fields to POST for the request.
        $body = new \SquareConnect\Model\ChargeRequest();

        $body->setIdempotencyKey(uniqid());


        $amount = intval(str_replace('.', '', $ticket->amount));
        $tip_amount = intval(str_replace('.', '', $ticket->tip_amount));        
        //print_r($amount);exit;

        $money = new \SquareConnect\Model\Money();
        $money->setAmount($amount+$tip_amount);
        $money->setCurrency('USD');
        $body->setAmountMoney($money);


        // Set the customer card ID.
        $body->setCustomerCardId($customerCardId);

        // Set the customer ID.
        $body->setCustomerId($customerId);

        try {
          $result = $TransactionsApi->charge($locationId, $body);
          //print_r($result);
          $tenders = $result->getTransaction()->getTenders();
          
          $ticket->payment_status = 'USD '.number_format(2, $tenders[0]->getAmountMoney()->getAmount()).' - '.$tenders[0]->getCardDetails()->getStatus();
          $ticket->payment_done=true;
          $ticket->save();

        } catch (Exception $e) {
          echo 'Error when calling TransactionsApi->charge: ', $e->getMessage(), PHP_EOL;
        }


    }

    public static function validateCard($card_id){

        if(env("APP_ENV", false)=='dev'){return true;}

        if(isset($_POST['nonce'])){

            $card = Card::find($card_id);
            

            require(app_path() . '/connect-php-sdk-master/autoload.php');

            $access_token = env('SQUARE_TOKEN');

            // Configure OAuth2 access token for authorization: oauth2
            SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($access_token);


            $api_instance = new SquareConnect\Api\CustomersApi();

            $customer_id = $card->access->square_id; // string | The ID of the customer to link the card on file to.
            $body = new \SquareConnect\Model\CreateCustomerCardRequest(); // \SquareConnect\Model\CreateCustomerCardRequest | An object containing the fields to POST for the request.  See the corresponding object definition for field details.

            $billingAddress = new \SquareConnect\Model\Address();
            $billingAddress->setPostalCode($card->card_address_postal_code);

            $body->setCardNonce($_POST['nonce']);
            $body->setBillingAddress($billingAddress);
            $body->setCardholderName($card->name);


            try {
                
                $result = $api_instance->createCustomerCard($customer_id, $body);
                //print_r();
                $card->card_square_id = $result->getCard()->getId();
                $card->save();

            } catch (Exception $e) {
                echo 'Exception when calling CustomersApi->createCustomerCard: ', $e->getMessage(), PHP_EOL;
            }
        }

    }

    public static function createSquareUser($access){

        if(env("APP_ENV", false)=='dev'){return true;}

        require(app_path() . '/connect-php-sdk-master/autoload.php');

        $access_token = env("APP_SQUARE_TOKEN", false); 

        // Configure OAuth2 access token for authorization: oauth2
        SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($access_token);

        $api_instance = new SquareConnect\Api\CustomersApi();

        $body = new \SquareConnect\Model\CreateCustomerRequest(); // \SquareConnect\Model\CreateCustomerRequest | An object containing the fields to POST for the request.  See the corresponding object definition for field details.
        $body->setFamilyName($access->user->name);

        try {

            $result = $api_instance->createCustomer($body);
            //print_r($result);

            $access->square_id = $result->getCustomer()->getId(); 
            $access->save();

        } catch (Exception $e) {
            
            echo 'Exception when calling CustomersApi->createCustomer: ', $e->getMessage(), PHP_EOL;

        }

    }

}
