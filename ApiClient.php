<?php

namespace CL\DocData\Component\OrderApi;

use CL\DocData\Component\OrderApi\Type\ApproximateTotals;
use CL\DocData\Component\OrderApi\Type\PaymentPreferences;
use CL\DocData\Component\OrderApi\Type\StatusResponse;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * @author          Cas Leentfaar <info@casleentfaar.com>
 * @original_author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class ApiClient
{
    const VERSION = '1.2';

    /**
     * @var Type\Merchant
     */
    private $merchant;

    /**
     * @var \SoapClient
     */
    private $soapClient;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var int
     */
    private $timeOut = 30;

    /**
     * @var string
     */
    private $userAgent;

    /**
     * @var array
     */
    private $classMaps = [
        'address'                 => '\CL\DocData\Component\OrderApi\Type\Address',
        'amexPaymentInfo'         => '\CL\DocData\Component\OrderApi\Type\AmexPaymentInfo',
        'amount'                  => '\CL\DocData\Component\OrderApi\Type\Amount',
        'approximateTotals'       => '\CL\DocData\Component\OrderApi\Type\ApproximateTotals',
        'authorization'           => '\CL\DocData\Component\OrderApi\Type\Authorization',
        'bankTransferPaymentInfo' => '\CL\DocData\Component\OrderApi\Type\BankTransferPaymentInfo',
        'cancelError'             => '\CL\DocData\Component\OrderApi\Type\CancelError',
        'cancelSuccess'           => '\CL\DocData\Component\OrderApi\Type\CancelSuccess',
        'capture'                 => '\CL\DocData\Component\OrderApi\Type\Capture',
        'captureError'            => '\CL\DocData\Component\OrderApi\Type\CaptureError',
        'captureSuccess'          => '\CL\DocData\Component\OrderApi\Type\CaptureSuccess',
        'chargeback'              => '\CL\DocData\Component\OrderApi\Type\Chargeback',
        'country'                 => '\CL\DocData\Component\OrderApi\Type\Country',
        'createError'             => '\CL\DocData\Component\OrderApi\Type\CreateError',
        'createSuccess'           => '\CL\DocData\Component\OrderApi\Type\CreateSuccess',
        'destination'             => '\CL\DocData\Component\OrderApi\Type\Destination',
        'error'                   => '\CL\DocData\Component\OrderApi\Type\Error',
        'giftCardPaymentInfo'     => '\CL\DocData\Component\OrderApi\Type\GiftCardPaymentInfo',
        'iDealPaymentInfo'        => '\CL\DocData\Component\OrderApi\Type\IdealPaymentInfo',
        'invoice'                 => '\CL\DocData\Component\OrderApi\Type\Invoice',
        'item'                    => '\CL\DocData\Component\OrderApi\Type\Item',
        'language'                => '\CL\DocData\Component\OrderApi\Type\Language',
        'maestroPaymentInfo'      => '\CL\DocData\Component\OrderApi\Type\MaestroPaymentInfo',
        'masterCardPaymentInfo'   => '\CL\DocData\Component\OrderApi\Type\MasterCardPaymentInfo',
        'menuPreferences'         => '\CL\DocData\Component\OrderApi\Type\MenuPreferences',
        'merchant'                => '\CL\DocData\Component\OrderApi\Type\Merchant',
        'misterCashPaymentInfo'   => '\CL\DocData\Component\OrderApi\Type\MisterCashPaymentInfo',
        'name'                    => '\CL\DocData\Component\OrderApi\Type\name',
        'payment'                 => '\CL\DocData\Component\OrderApi\Type\Payment',
        'paymentInfo'             => '\CL\DocData\Component\OrderApi\Type\PaymentInfo',
        'paymentPreferences'      => '\CL\DocData\Component\OrderApi\Type\PaymentPreferences',
        'paymentReference'        => '\CL\DocData\Component\OrderApi\Type\PaymentReference',
        'paymentRequestInput'     => '\CL\DocData\Component\OrderApi\Type\PaymentRequestInput',
        'paymentResponse'         => '\CL\DocData\Component\OrderApi\Type\PaymentResponse',
        'quantity'                => '\CL\DocData\Component\OrderApi\Type\Quantity',
        'refund'                  => '\CL\DocData\Component\OrderApi\Type\Refund',
        'refundError'             => '\CL\DocData\Component\OrderApi\Type\RefundError',
        'refundSuccess'           => '\CL\DocData\Component\OrderApi\Type\RefundSuccess',
        'riskCheck'               => '\CL\DocData\Component\OrderApi\Type\RiskCheck',
        'shopper'                 => '\CL\DocData\Component\OrderApi\Type\Shopper',
        'startError'              => '\CL\DocData\Component\OrderApi\Type\StartError',
        'startSuccess'            => '\CL\DocData\Component\OrderApi\Type\StartSuccess',
        'statusError'             => '\CL\DocData\Component\OrderApi\Type\StatusError',
        'statusReport'            => '\CL\DocData\Component\OrderApi\Type\StatusReport',
        'statusResponse'          => '\CL\DocData\Component\OrderApi\Type\StatusResponse',
        'statusSuccess'           => '\CL\DocData\Component\OrderApi\Type\StatusSuccess',
        'success'                 => '\CL\DocData\Component\OrderApi\Type\Success',
        'vat'                     => '\CL\DocData\Component\OrderApi\Type\Vat',
        'visaPaymentInfo'         => '\CL\DocData\Component\OrderApi\Type\VisaPaymentInfo',
    ];

    /**
     * @var bool
     */
    private $test = false;

    /**
     * @param string          $merchantName
     * @param string          $merchantPassword
     * @param bool            $test
     * @param LoggerInterface $logger
     */
    public function __construct($merchantName, $merchantPassword, $test = false, LoggerInterface $logger = null)
    {
        $this->merchant = new Type\Merchant();
        $this->merchant->setName($merchantName);
        $this->merchant->setPassword($merchantPassword);

        $this->test   = $test;
        $this->logger = $logger ? : new NullLogger();
    }

    /**
     * @return int
     */
    public function getTimeOut()
    {
        return $this->timeOut;
    }

    /**
     * Set the timeout.
     *
     * After this time the request will stop. You should handle any errors triggered by this yourself.
     *
     * @param int $seconds The timeout in seconds.
     */
    public function setTimeOut($seconds)
    {
        $this->timeOut = (int) $seconds;
    }

    /**
     * Get the user-agent that will be used.
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Set the user-agent for you application
     *
     * @param string $userAgent Your user-agent, it should look like <app-name>/<app-version>.
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = (string) $userAgent;
    }

    /**
     * @return string
     */
    private function getWsdl()
    {
        if ($this->test === true) {
            return sprintf('https://test.docdatapayments.com/ps/services/paymentservice/%s?wsdl', str_replace('.', '_', self::VERSION));
        } else {
            return sprintf('https://secure.docdatapayments.com/ps/services/paymentservice/%s?wsdl', str_replace('.', '_', self::VERSION));
        }
    }

    /**
     * The goal of the create operation is solely to create a payment order on
     * Docdata Payments system. Creating a payment order is always the first
     * step of any workflow in Docdata Payments payment service.
     *
     * After an order is created, payments can be made on this order; either
     * through (the shopper via) the web menu or through the API by the
     * merchant. If the order has been created using information on specific
     * order items, the web menu can make use of this information by displaying
     * a shopping cart.
     *
     * @param string                       $paymentId
     * @param Type\Shopper                 $shopper
     * @param Type\Amount                  $totalGrossAmount
     * @param Type\Destination             $billTo
     * @param Type\PaymentPreferences|null $paymentPreferences
     * @param string|null                  $description
     * @param string|null                  $receiptText
     * @param Type\MenuPreferences|null    $menuPreferences
     * @param Type\PaymentRequest|null     $paymentRequest
     * @param Type\Invoice|null            $invoice
     * @param bool|null                    $includeCosts
     *
     * @return Type\CreateSuccess
     *
     * @throws \Exception
     */
    public function create(
        $paymentId,
        Type\Shopper $shopper,
        Type\Amount $totalGrossAmount,
        Type\Destination $billTo,
        Type\PaymentPreferences $paymentPreferences = null,
        $description = null,
        $receiptText = null,
        Type\MenuPreferences $menuPreferences = null,
        Type\PaymentRequest $paymentRequest = null,
        Type\Invoice $invoice = null,
        $includeCosts = null
    ) {
        $request = new Type\CreateRequest();
        $request->setMerchant($this->merchant);
        $request->setMerchantOrderReference($paymentId);
        $request->setShopper($shopper);
        $request->setTotalGrossAmount($totalGrossAmount);
        $request->setBillTo($billTo);
        if ($description !== null) {
            $request->setDescription($description);
        }
        if ($receiptText !== null) {
            $request->setReceiptText($receiptText);
        }
        if ($paymentPreferences === null) {
            $paymentPreferences = new PaymentPreferences();
        }
        $request->setPaymentPreferences($paymentPreferences);
        if ($menuPreferences !== null) {
            $request->setMenuPreferences($menuPreferences);
        }
        if ($paymentRequest !== null) {
            $request->setPaymentRequest($paymentRequest);
        }
        if ($invoice !== null) {
            $request->setInvoice($invoice);
        }
        if ($includeCosts !== null) {
            $request->setIncludeCosts($includeCosts);
        }

        // make the call
        $this->logger->info("Payment create: " . $paymentId, $request->toArray());
        $response = $this->soap('create', [$request->toArray()]);
        $this->logger->info("Payment create soap request: " . $paymentId, (array) $this->soapClient->__getLastRequest());
        $this->logger->info("Payment create soap response: " . $paymentId, (array) $this->soapClient->__getLastResponse());

        // validate response
        if (isset($response->createError)) {
            if ($this->test) {
                var_dump($this->soapClient->__getLastRequest());
            }

            $this->logger->error("Payment create: " . $paymentId, (array) $response->createError->getError()->getExplanation());

            throw new \Exception($response->createError->getError()->getExplanation());
        }

        return $response->createSuccess;
    }

    /**
     * The goal of the start operation is to start payment on an existing order
     *
     * @param string                   $orderKey
     * @param Type\PaymentRequestInput $payment
     *
     * @return Type\StartSuccess
     *
     * @throws \Exception
     */
    public function start($orderKey, Type\PaymentRequestInput $payment)
    {
        $request = new Type\StartRequest();
        $request->setPaymentOrderKey($orderKey);
        $request->setMerchant($this->merchant);
        $request->setPayment($payment);

        // make the call
        $this->logger->info("Payment start: " . $orderKey, $request->toArray());
        $response = $this->soap('start', [$request->toArray()]);
        $this->logger->info("Payment start soap request: " . $orderKey, (array) $this->soapClient->__getLastRequest());
        $this->logger->info("Payment start soap response: " . $orderKey, (array) $this->soapClient->__getLastResponse());

        // validate response
        if (isset($response->startError)) {
            if ($this->test) {
                var_dump($this->soapClient->__getLastRequest());
            }

            $this->logger->error("Payment start: " . $orderKey, (array) $response->startError->getError()->getExplanation());

            throw new \Exception($response->startError->getError()->getExplanation());
        }

        return $response->startSuccess;
    }

    /**
     * The cancel command is used for canceling a previously created payment,
     * and can only be used for payments with status NEW, STARTED and
     * AUTHORIZED.
     *
     * @param string $paymentOrderKey
     *
     * @return Type\CancelSuccess
     *
     * @throws \Exception
     */
    public function cancel($paymentOrderKey)
    {
        $request = new Type\CancelRequest();
        $request->setMerchant($this->merchant);
        $request->setPaymentOrderKey($paymentOrderKey);

        // make the call

        $this->logger->info("Payment cancel: " . $paymentOrderKey, $request->toArray());
        $response = $this->soap('cancel', [$request->toArray()]);
        $this->logger->info("Payment cancel soap request: " . $paymentOrderKey, (array) $this->soapClient->__getLastRequest());
        $this->logger->info("Payment cancel soap response: " . $paymentOrderKey, (array) $this->soapClient->__getLastResponse());

        // validate response
        if (isset($response->cancelError)) {
            if ($this->test) {
                var_dump($this->soapClient->__getLastRequest());
            }

            $this->logger->error("Payment cancel: " . $paymentOrderKey, (array) $response->cancelError->getError()->getExplanation());

            throw new \Exception($response->cancelError->getError()->getExplanation());
        }

        return $response->cancelSuccess;
    }

    /**
     * The capture command is used to create requests for performing captures
     * on authorized payments. A merchant can choose to have it set up through
     * Docdata Payments back office to automatically have the full
     * authorization amount captured for each payment after a configured delay.
     *The capture command can then be used to overwrite this default capture.
     * If no default capture is configured, a merchant should use the capture
     * command to create one.
     *
     * @param string           $paymentId
     * @param string|null      $merchantCaptureReference
     * @param Type\Amount|null $amount
     * @param string|null      $itemCode
     * @param string|null      $description
     * @param bool|null        $finalCapture
     * @param bool|null        $cancelReserved
     * @param string|null      $requiredCaptureDate
     *
     * @return Type\CaptureSuccess
     *
     * @throws \Exception
     */
    public function capture(
        $paymentId,
        $merchantCaptureReference = null,
        Type\Amount $amount = null,
        $itemCode = null,
        $description = null,
        $finalCapture = null,
        $cancelReserved = null,
        $requiredCaptureDate = null
    ) {
        $request = new Type\CaptureRequest();
        $request->setMerchant($this->merchant);
        $request->setPaymentId($paymentId);

        if ($merchantCaptureReference !== null) {
            $request->setMerchantCaptureReference($merchantCaptureReference);
        }
        if ($amount !== null) {
            $request->setAmount($amount);
        }
        if ($itemCode !== null) {
            $request->setItemCode($itemCode);
        }
        if ($description !== null) {
            $request->setDescription($description);
        }
        if ($finalCapture !== null) {
            $request->setFinalCapture($finalCapture);
        }
        if ($cancelReserved !== null) {
            $request->setCancelReserved($cancelReserved);
        }
        if ($requiredCaptureDate !== null) {
            $request->setRequiredCaptureDate($requiredCaptureDate);
        }

        // make the call

        $this->logger->info("Payment capture: " . $merchantCaptureReference, (array) $request->toArray());
        $response = $this->soap('capture', [$request->toArray()]);
        $this->logger->info("Payment capture soap request: " . $merchantCaptureReference, (array) $this->soapClient->__getLastRequest());
        $this->logger->info("Payment capture soap response: " . $merchantCaptureReference, (array) $this->soapClient->__getLastResponse());

        // validate response
        if (isset($response->captureError)) {
            if ($this->test) {
                var_dump($this->soapClient->__getLastRequest());
            }

            $this->logger->error("Payment capture: " . $merchantCaptureReference, (array) $response->captureError->getError()->getExplanation());

            throw new \Exception($response->captureError->getError()->getExplanation());
        }

        return $response->captureSuccess;
    }

    /**
     * The refund command is used to create requests for performing one or more refunds on payments that have been
     * captured successfully. Its functionality is very similar to submitting captures.
     *
     * @param string               $paymentId
     * @param string               $merchantRefundReference
     * @param Type\Amount          $amount
     * @param string               $itemCode
     * @param string               $description
     * @param bool                 $cancelReserved
     * @param string               $requiredRefundDate
     * @param Type\SepaBankAccount $refundBankAccount
     *
     * @return Type\RefundSuccess
     *
     * @throws \Exception
     */
    public function refund(
        $paymentId,
        $merchantRefundReference = null,
        Type\Amount $amount = null,
        $itemCode = null,
        $description = null,
        $cancelReserved = null,
        $requiredRefundDate = null,
        Type\SepaBankAccount $refundBankAccount = null
    ) {
        $request = new Type\RefundRequest();
        $request->setMerchant($this->merchant);
        $request->setPaymentId($paymentId);

        if ($merchantRefundReference !== null) {
            $request->setMerchantRefundReference($merchantRefundReference);
        }
        if ($amount !== null) {
            $request->setAmount($amount);
        }
        if ($itemCode !== null) {
            $request->setItemCode($itemCode);
        }
        if ($description !== null) {
            $request->setDescription($description);
        }
        if ($cancelReserved !== null) {
            $request->setCancelReserved($cancelReserved);
        }
        if ($requiredRefundDate !== null) {
            $request->setRequiredRefundDate($requiredRefundDate);
        }
        if ($refundBankAccount !== null) {
            $request->setRefundBankAccount($refundBankAccount);
        }

        // make the call
        $this->logger->info("Payment capture: " . $merchantRefundReference, (array) $request->toArray());
        $response = $this->soap('refund', [$request->toArray()]);
        $this->logger->info("Payment capture soap request: " . $merchantRefundReference, (array) $this->soapClient->__getLastRequest());
        $this->logger->info("Payment capture soap response: " . $merchantRefundReference, (array) $this->soapClient->__getLastRequest());

        // validate response
        if (isset($response->refundError)) {
            if ($this->test) {
                var_dump($this->soapClient->__getLastRequest());
                var_dump($response->refundError);
            }

            $this->logger->error("Payment capture: " . $merchantRefundReference, (array) $response->refundError->getError()->getExplanation());

            throw new \Exception(
                $response->refundError->getError()->getExplanation()
            );
        }

        return $response->refundSuccess;
    }

    /**
     * The status call can be used to get a report on the current status of a Payment Order, its payments and its
     * captures or refunds. It can be used to determine whether an order is considered paid, to retrieve a payment ID,
     * to get information on the statuses of captures/refunds.
     *
     * @param string $paymentOrderKey
     *
     * @return Type\StatusSuccess
     */
    public function status($paymentOrderKey)
    {
        $request = new Type\StatusRequest();
        $request->setMerchant($this->merchant);
        $request->setPaymentOrderKey($paymentOrderKey);

        // make the call
        $response = $this->statusReponse($paymentOrderKey);

        return $response->statusSuccess;
    }

    /**
     * The soap status response of a Payment Order,
     *
     * @param string $paymentOrderKey
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function statusReponse($paymentOrderKey)
    {
        $request = new Type\StatusRequest();
        $request->setMerchant($this->merchant);
        $request->setPaymentOrderKey($paymentOrderKey);

        // make the call
        $this->logger->info("Payment status: " . $paymentOrderKey, $request->toArray());
        $response = $this->soap('status', [$request->toArray()]);
        $this->logger->info("Payment status soap request: " . $paymentOrderKey, (array) $this->soapClient->__getLastRequest());
        $this->logger->info("Payment status soap response: " . $paymentOrderKey, (array) $this->soapClient->__getLastRequest());

        // validate response
        if (isset($response->statusError)) {
            if ($this->test) {
                var_dump($this->soapClient->__getLastRequest());
                var_dump($response->statusError);
            }

            $this->logger->error("Payment status: " . $paymentOrderKey, (array) $response->statusError->getError()->getExplanation());

            throw new \Exception(
                $response->statusError->getError()->getExplanation()
            );
        }

        return $response;
    }

    /**
     * Get the payment url
     *
     * @param string $clientLanguage
     * @param string $paymentClusterKey
     * @param string $successUrl           Merchant’s web page where the shopper will be sent to after a
     *                                     successful transaction. Mandatory in back office.
     * @param string $canceledUrl          Merchant’s web page where the shopper will be sent to if they
     *                                     cancel their transaction. Mandatory in back office.
     * @param string $pendingUrl           Merchant’s web page where the shopper will be sent to if a
     *                                     payment is started successfully but not yet paid.
     * @param string $errorUrl             Merchant’s web page where the shopper will be sent to if an
     *                                     error occurs.
     * @param string $defaultPaymentMethod ID of the default payment method.
     * @param string $defaultAct           If a default payment method is declared to direct the shopper
     *                                     to that payment method in the payment menu. Can contain the
     *                                     values “yes” or “no”.
     * @param bool   $production           Production mode?
     *
     * @return string
     */
    public function getPaymentUrl(
        $clientLanguage,
        $paymentClusterKey,
        $successUrl = null,
        $canceledUrl = null,
        $pendingUrl = null,
        $errorUrl = null,
        $defaultPaymentMethod = null,
        $defaultAct = null,
        $production = true
    ) {
        $parameters                        = [];
        $parameters['command']             = 'show_payment_cluster';
        $parameters['merchant_name']       = $this->merchant->getName();
        $parameters['client_language']     = (string) $clientLanguage;
        $parameters['payment_cluster_key'] = (string) $paymentClusterKey;

        if ($successUrl !== null) {
            $parameters['return_url_success'] = $successUrl;
        }
        if ($canceledUrl !== null) {
            $parameters['return_url_canceled'] = $canceledUrl;
        }
        if ($pendingUrl !== null) {
            $parameters['return_url_pending'] = $pendingUrl;
        }
        if ($errorUrl !== null) {
            $parameters['return_url_error'] = $errorUrl;
        }
        if ($defaultPaymentMethod !== null) {
            $parameters['default_pm'] = $defaultPaymentMethod;
        }
        if ($defaultAct !== null) {
            $parameters['default_act'] = $defaultAct;
        }

        if ($production) {
            $base = 'https://secure.docdatapayments.com/ps/menu';
        } else {
            $base = 'https://test.docdatapayments.com/ps/menu';
        }

        // build the url
        return $base . '?' . http_build_query($parameters);
    }

    /**
     * Redirect to the payment url
     *
     * @param string $clientLanguage
     * @param string $paymentClusterKey
     * @param string $successUrl           Merchant’s web page where the shopper will be sent to after a
     *                                     successful transaction. Mandatory in back office.
     * @param string $canceledUrl          Merchant’s web page where the shopper will be sent to if they
     *                                     cancel their transaction. Mandatory in back office.
     * @param string $pendingUrl           Merchant’s web page where the shopper will be sent to if a
     *                                     payment is started successfully but not yet paid.
     * @param string $errorUrl             Merchant’s web page where the shopper will be sent to if an
     *                                     error occurs.
     * @param string $defaultPaymentMethod ID of the default payment method.
     * @param string $defaultAct           If a default payment method is declared to direct the shopper
     *                                     to that payment method in the payment menu. Can contain the
     *                                     values “yes” or “no”.
     * @param bool   $production           Production mode?
     */
    public function redirectToPaymentUrl(
        $clientLanguage,
        $paymentClusterKey,
        $successUrl = null,
        $canceledUrl = null,
        $pendingUrl = null,
        $errorUrl = null,
        $defaultPaymentMethod = null,
        $defaultAct = null,
        $production = true
    ) {
        // get the url
        $url = $this->getPaymentUrl(
            $clientLanguage,
            $paymentClusterKey,
            $successUrl,
            $canceledUrl,
            $pendingUrl,
            $errorUrl,
            $defaultPaymentMethod,
            $defaultAct,
            $production
        );

        $this->logger->info("Redirect to docdata: " . $url);

        // redirect
        header('location: ' . $url);
        exit();
    }

    /**
     * Docdata document: 733126_Integration_manual_Order_Api_1-1.pdf
     * Chapter: 7.4 Determining whether an order is paid
     * Determining whether an order is paid
     * Different merchants can have different ways of determining when they consider an order “paid”,
     * the totals in the status report are there to help make this decision. Keep in mind that the status report
     * never reports about money actually having been transferred to a merchant, so it is not a complete guarantee
     * that a payment has been finished in that sense.
     * Using the totals to determine a level of confidence:
     *
     * @param $paymentOrderKey
     *
     * @return int The highest Paid level (from NotPaid to SafeRoute)
     */
    public function statusPaid($paymentOrderKey)
    {
        $response = $this->statusReponse($paymentOrderKey);

        return $this->getPaidLevel($response);
    }

    /**
     * @param StatusResponse $response
     *
     * @return int
     */
    public function getPaidLevel(StatusResponse $response)
    {
        $statusSuccess = $response->getStatusSuccess();
        if ($statusSuccess &&
            $statusSuccess->getSuccess() != null &&
            $statusSuccess->getSuccess()->getCode() == 'SUCCESS' &&
            $statusSuccess->getReport() != null &&
            $statusSuccess->getReport()->getApproximateTotals() != null
        ) {
            /** @var ApproximateTotals $approximateTotals */
            $approximateTotals = $statusSuccess->getReport()->getApproximateTotals();

            //Safe Route
            if (($approximateTotals->getTotalRegistered() == $approximateTotals->getTotalCaptured())) {
                return Type\PaidLevel::SafeRoute;
            }

            //Balanced Route
            if ($approximateTotals->getTotalRegistered() ==
                $approximateTotals->gettotalAcquirerApproved()
            ) {
                return Type\PaidLevel::BalancedRoute;
            }

            //Quick Route
            if ($approximateTotals->getTotalRegistered() ==
                ($approximateTotals->getTotalShopperPending()
                    + $approximateTotals->getTotalAcquirerPending()
                    + $approximateTotals->gettotalAcquirerApproved())
            ) {
                return Type\PaidLevel::QuickRoute;
            }
        }

        return Type\PaidLevel::NotPaid;
    }

    /**
     * @param string $method
     * @param array $args
     *
     * @return mixed
     */
    protected function soap($method, array $args = [])
    {
        return call_user_func_array([$this->getSoapClient(), $method], $args);
    }

    /**
     * @return \SoapClient
     */
    protected function getSoapClient()
    {
        // create the client if needed
        if (!$this->soapClient) {
            $options = [
                'trace'              => true,
                'exceptions'         => true,
                'connection_timeout' => $this->getTimeout(),
                'user_agent'         => $this->getUserAgent(),
                'cache_wsdl'         => $this->test ? WSDL_CACHE_NONE : WSDL_CACHE_BOTH,
                'classmap'           => $this->classMaps,
            ];

            $this->soapClient = new \SoapClient($this->getWsdl(), $options);
        }

        return $this->soapClient;
    }
}
