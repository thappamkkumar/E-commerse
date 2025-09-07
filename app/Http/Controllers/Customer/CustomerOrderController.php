<?php

namespace App\Http\Controllers\Customer;

use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Transaction;
use Exception;
class CustomerOrderController extends Controller
{
	/*this controller hasx function related to order list and plcaing new order,
		address verification for order, payment gateway etc.*/
		
    //function for order list of user_error
	function orderList()
	{
		try
		{
			$prepage=session('user_back');
			$pre=$prepage[count($prepage)-1];
			if($pre!==url()->full())
			{
				$prepage[]=url()->full();
			}
			session(['user_back'=> $prepage ]);
			$orderList = auth()->user()->orders()->orderby('id','DESC')->paginate(10);
			 
			foreach ($orderList as  $order) {
					$order->product->thumnail = $order->product->thumnail
					? url(Storage::url('product_thumnail/' . $order->product->thumnail))  
					: null;
			}
			
			return View('customer/orderList', compact('orderList'));
			 
		}
		catch(Exception $e)
		{ 
			$message = $e->getMessage();
			return View('error', compact('message'));
			
		} 
	}
	
	//function for address Verfication
	function orderVerfication(Product $product)
	{
		try
		{
			  
			$prepage=session('user_back');
			$pre=$prepage[count($prepage)-1];
			if($pre!==url()->full())
			{
				$prepage[]=url()->full();
			}
			session(['user_back'=> $prepage ]);
			
		/*	if($product->sale_price != null || $product->sale_price != 0)
			{
				$gst = round((1 - $product->category->gst / $product->sale_price) * 100);
			}
			else
			{
			  $gst = round((1 - $product->category->gst / $product->price) * 100);
			}*/
			if ($product->sale_price != null && $product->sale_price != 0) {
					// Calculate GST amount based on sale price
						$gst = round($product->sale_price * ($product->category->gst / 100), 2);
				} else {
						// Calculate GST amount based on regular price
						$gst = round($product->price * ($product->category->gst / 100), 2);
				}
				
				
			$detail = [
				'product_name'=>$product->name,
				'product_id'=>$product->id,
				'price'=>($product->sale_price > 0)?$product->sale_price : $product->price,
				'gstPercentage'=>$product->category->gst,
				'gst'=>$gst,
				'delivery_charges'=>$product->delivery_charges,
				'stock'=>$product->stock,
				'quantity'=> 1,
			];
			 
			return View('customer/orderVerfication', compact('detail'));
   
		}
		catch(Exception $e)
		{ 
			$message = $e->getMessage();
			return View('error', compact('message'));
		} 
	}
	
	//function for place order 
	function placeOrder(Request $request)
	{
		//validateion for order data
		 $request->validate([
			'area_street_sector_village'=>'required',
			'flat_houseno_building_company'=>'required',
			'landmark'=>'required',
			'district'=>'required',
			'state'=>'required',
			'country'=>'required',
			'pincode'=>'required',
		]);
		
	 try
	 {
			//creating orderid or order number_format
			$lastOrderId = Order::max('id');
			$orderID=auth()->user()->customers->name.'_order_number_'.$lastOrderId+1;
			   
			//data that send or upload after payment
			$order_data = [
				'order_number'=>$orderID,
				'product_id'=>$request->product_id,
				'user_id'=>auth()->user()->id,
				'price'=>$request->price,
				'delivery_charges'=>$request->delivery_charges,
				'gst'=>$request->gst,
				'quantity'=>$request->quantity,
				'address'=> $request->flat_houseno_building_company.', '.$request->area_street_sector_village.', '.$request->district.', '.$request->state.', '.$request->country.', '.$request->pincode,
			];
			
			//putting order data into session because need to store in response route after payment success
			session(['order_product_detail'=>$order_data]);
			
			//geting data for payment
			$webDetail=Admin::orderBy('id','DESC')->first();
			
			//phonepay payment gateway data
			$merchantId = $webDetail->merchantId;
			$saltKey=$webDetail->saltKey;			
			$mobile=$webDetail->contact;			
			$email=$webDetail->email;			
			$webSiteName	=$webDetail->webSiteName	;			
			
			//payment ammount and description (something about the payment for)
			$amount = ($order_data['price']+$order_data['delivery_charges']+$order_data['gst'])*$order_data['quantity']; // amount in INR
			$description = 'Payment for Product';
			
			 
			//creating data that send to phonepay
			  $paymentData  = array (
						'merchantId' => $merchantId,
						'merchantTransactionId' => "MT7850590068188104", //
						"merchantUserId"=>"MUID123",
						'amount' => $amount*100,
						'redirectUrl'=>route('paymentResponse'),

						'redirectMode' => 'POST',
						'callbackUrl' => route('paymentResponse'),
						"merchantOrderId"=>$orderID,    //order number or id
						"mobileNumber"=>$mobile,       //admin mobile number
						"message"=>$description,       //message for payment
						"email"=>$email,              //admin email id
						"shortName"=>$webSiteName	,   // admin name
						"paymentInstrument"=> array(    
										"type"=> "PAY_PAGE",
										)
			);
			
			//encode payment data for security 
			$jsonencode = json_encode($paymentData);
			$payloadMain = base64_encode($jsonencode);
			
			//combining encoded payment data with saltkay
			$payload = $payloadMain . "/pg/v1/pay" . $saltKey;
			
			//hashing  the combined data with key "sha256"
			$sha256 = hash("sha256", $payload);
			
			$salt_index = 1;  //salt index
			
			//combining hashed data with salt index
			$finalXHeader = $sha256.'###'.$salt_index;

			//url where request is send and waiting or getting   response
			$url = "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay";

			// using curl send data to phonepay server
			//this is for verification of merchet to continue the payment
			$response = Curl::to($url)
					->withHeader('Content-Type:application/json')
					->withHeader('X-VERIFY:'.$finalXHeader) 
					->withData(json_encode(['request' => $payloadMain]))
					->post();
	 
			//decode the response fetch or get by curl reguest
			$rData = json_decode($response);
			
			//redirect to phonepay payment interface
			return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	
	//function for handling redponse of paymentData
	public function paymentResponse(Request $request)
	{
		try
		{
			//geting input from request send by payment gateway server
			$input = $request->all(); 
			$successMSG = null;//for storing message data about complete of transection
			$productData = null; //for storing product data from session
			
				
			//geting data for payment
			$webDetail=Admin::orderBy('id','DESC')->first();
			
			//initalizing salt key and index
			$saltKey=$webDetail->saltKey;
			$saltIndex = 1;
			
			//generating header by hashing   input and salt key and index
			$finalXHeader = hash('sha256','/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'].$saltKey).'###'.$saltIndex;

			//generating full respose of transection
			$responses = Curl::to('https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'])
					->withHeader('Content-Type:application/json')
					->withHeader('accept:application/json')
					->withHeader('X-VERIFY:'.$finalXHeader)
					->withHeader('X-MERCHANT-ID:'.$input['transactionId'])
					->get();
					
			//decoding responses
			$response = json_decode($responses);
			
			//geting product data for storing order detail
			
			if (session()->has('order_product_detail')) {
					$productData = session('order_product_detail');
					session()->forget('order_product_detail');//session delete because no need
			} 
			else 
			{
				return;
			}
			if($response!=null && $response->success === true)
			{ 
				//inssert data in transection table
				$transection_data = ['user_id'=>auth()->user()->id, 'product_id'=>$productData['product_id'], 'transaction_id'=>$response->data->transactionId,'status'=>$response->data->state, 'amount'=>$response->data->amount/100, 'transaction_details'=>$responses];
				$transection_data__success = Transaction::create($transection_data);
					
				//inssert data in order table
				$order_data = ['order_number'=>$productData['order_number'],'user_id'=>auth()->user()->id, 'product_id'=>$productData['product_id'], 'address'=>$productData['address'], 'price'=>$productData['price'], 'delivery_charges'=>$productData['delivery_charges'], 'gst'=>$productData['gst'], 'quantity'=>$productData['quantity'], 'transaction_id'=>$transection_data__success->id];
				$Order_data__success = Order::create($order_data);
				
				$successMSG=['status'=>'success','heading'=>'Thanks you for ordering !','message'=>'You will receive your product within few days','button'=>'CONTINUE SHOPPING'];
				$successMSG=(object)$successMSG;
			}
			else
			{ 
				$successMSG=['status'=>'fail','heading'=>'Fail to order product !','message'=>'If your payment is completed and product is not display in my order section, than contact us','button'=>'Back'];
				$successMSG=(object)$successMSG;
				 
			}
			
			 return View('customer/orderPlaced', compact('successMSG'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	
	
}
