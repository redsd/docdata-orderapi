<?php

namespace CL\DocData\Component\OrderApi\Tests;

use CL\DocData\Component\OrderApi\ApiClient;
use CL\DocData\Component\OrderApi\Type;

class ApiClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ApiClient
     */
    private $apiClient;

    protected function setUp()
    {
        $this->apiClient = new ApiClient('foo', 'bar', true);
    }

    public function testGetTimeOut()
    {
        $this->apiClient->setTimeOut(5);
        $this->assertEquals(5, $this->apiClient->getTimeOut());
    }

    public function testGetUserAgent()
    {
        $this->apiClient->setUserAgent('testing/1.1.0');
        $this->assertEquals('testing/1.1.0', $this->apiClient->getUserAgent());
    }

    /**
     * @group functional
     */
    public function testCreate()
    {
        $name = new Type\Name();
        $name->setFirst('John');
        $name->setLast('Doe');

        $shopper = new Type\Shopper();
        $shopper->setId(1);
        $shopper->setGender('M');
        $shopper->setName($name);
        $shopper->setEmail('john@doe.com');
        $shopper->setLanguage(new Type\Language('nl'));

        $totalGrossAmount = new Type\Amount(2000);

        $address = new Type\Address();
        $address->setStreet('Coolsingel');
        $address->setHouseNumber(1);
        $address->setPostalCode('3020');
        $address->setCity('Rotterdam');
        $address->setCountry(new Type\Country('NL'));

        $name = new Type\Name();
        $name->setFirst('John');
        $name->setLast('Doe');

        $billTo = new Type\Destination();
        $billTo->setName($name);
        $billTo->setAddress($address);

        $paymentPreferences = new Type\PaymentPreferences();
        $paymentPreferences->setProfile('standard');
        $paymentPreferences->setNumberOfDaysToPay(4);

        $response = $this->apiClient->create(
            microtime(),
            $shopper,
            $totalGrossAmount,
            $billTo,
            $paymentPreferences
        );

        $this->assertInstanceOf('Type\CreateSuccess', $response);
    }

    /**
     * @group functional
     */
    public function testCancel()
    {
        $name = new Type\Name();
        $name->setFirst('John');
        $name->setLast('Doe');

        $shopper = new Type\Shopper();
        $shopper->setId(1);
        $shopper->setGender('M');
        $shopper->setName($name);
        $shopper->setEmail('john@doe.com');
        $shopper->setLanguage(new Type\Language('nl'));

        $totalGrossAmount = new Type\Amount(2000);

        $address = new Type\Address();
        $address->setStreet('Coolsingel');
        $address->setHouseNumber(1);
        $address->setPostalCode('3021AB');
        $address->setCity('Rotterdam');
        $address->setCountry(new Type\Country('NL'));

        $name = new Type\Name();
        $name->setFirst('John');
        $name->setLast('Doe');

        $billTo = new Type\Destination();
        $billTo->setName($name);
        $billTo->setAddress($address);

        $paymentPreferences = new Type\PaymentPreferences();
        $paymentPreferences->setProfile('standard');
        $paymentPreferences->setNumberOfDaysToPay(4);

        $var = $this->apiClient->create(
            microtime(),
            $shopper,
            $totalGrossAmount,
            $billTo,
            $paymentPreferences
        );

        $response = $this->apiClient->cancel($var->getKey());

        $this->assertInstanceOf('\CL\DocData\Component\OrderApi\Type\CancelSuccess', $response);
        $this->assertEquals('SUCCESS', $response->getSuccess()->getCode());
    }

    /**
     * @group functional
     */
    public function testCapture()
    {
        $this->markTestSkipped('we can\'t test this without using a fixed payment id, so alter the id below');
        $response = $this->apiClient->capture(4905992874);

        $this->assertInstanceOf('\CL\DocData\Component\OrderApi\Type\CaptureSuccess', $response);
        $this->assertEquals('SUCCESS', $response->getSuccess()->getCode());
    }

    /**
     * @group functional
     */
    public function testRefund()
    {
        $this->markTestSkipped('we can\'t test this without using a fixed payment id, so alter the id below');
        $response = $this->apiClient->refund(4905992874);

        $this->assertInstanceOf('\CL\DocData\Component\OrderApi\Type\RefundSuccess', $response);
        $this->assertEquals('SUCCESS', $response->getSuccess()->getCode());
    }

    /**
     * @group functional
     */
    public function testStatus()
    {
        $name = new Type\Name();
        $name->setFirst('John');
        $name->setLast('Doe');

        $shopper = new Type\Shopper();
        $shopper->setId(1);
        $shopper->setGender('M');
        $shopper->setName($name);
        $shopper->setEmail('john@doe.com');
        $shopper->setLanguage(new Type\Language('nl'));

        $totalGrossAmount = new Type\Amount(2000);

        $address = new Type\Address();
        $address->setStreet('Coolsingel');
        $address->setHouseNumber(1);
        $address->setPostalCode('3020AB');
        $address->setCity('Rotterdam');
        $address->setCountry(new Type\Country('NL'));

        $name = new Type\Name();
        $name->setFirst('Tijs');
        $name->setLast('Verkoyen');

        $billTo = new Type\Destination();
        $billTo->setName($name);
        $billTo->setAddress($address);

        $paymentPreferences = new Type\PaymentPreferences();
        $paymentPreferences->setProfile('standard');
        $paymentPreferences->setNumberOfDaysToPay(4);

        $var = $this->apiClient->create(
            microtime(),
            $shopper,
            $totalGrossAmount,
            $billTo,
            $paymentPreferences
        );

        $response = $this->apiClient->status($var->getKey());

        $this->assertInstanceOf('Type\StatusSuccess', $response);
        $this->assertEquals('SUCCESS', $response->getSuccess()->getCode());
    }

    /**
     * @group functional
     */
    public function testStatusNotPaid()
    {
        $name = new Type\Name();
        $name->setFirst('John');
        $name->setLast('Doe');

        $shopper = new Type\Shopper();
        $shopper->setId(1);
        $shopper->setGender('M');
        $shopper->setName($name);
        $shopper->setEmail('john@doe.com');
        $shopper->setLanguage(new Type\Language('nl'));

        $totalGrossAmount = new Type\Amount(2000);

        $address = new Type\Address();
        $address->setStreet('Coolsingel');
        $address->setHouseNumber(1);
        $address->setPostalCode('3020AB');
        $address->setCity('Rotterdam');
        $address->setCountry(new Type\Country('NL'));

        $name = new Type\Name();
        $name->setFirst('John');
        $name->setLast('Doe');

        $billTo = new Type\Destination();
        $billTo->setName($name);
        $billTo->setAddress($address);

        $paymentPreferences = new Type\PaymentPreferences();
        $paymentPreferences->setProfile('standard');
        $paymentPreferences->setNumberOfDaysToPay(4);

        $var = $this->apiClient->create(
            microtime(),
            $shopper,
            $totalGrossAmount,
            $billTo,
            $paymentPreferences
        );

        $paidLevel = $this->apiClient->statusPaid($var->getKey());

        $this->assertEquals(Type\PaidLevel::NotPaid, $paidLevel);
    }

    /**
     * @group functional
     */
    public function testStatusPaid()
    {
        $this->markTestSkipped('we can\'t test this without a manually docdata transaction, that has been paid.');

        //Please read the manual about the paidLevel
        $paidLevel = $this->apiClient->statusPaid('123ABD');

        $this->assertTrue(in_array($paidLevel, [Type\PaidLevel::BalancedRoute, Type\PaidLevel::SafeRoute]));

    }
}
