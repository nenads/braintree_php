<?php
require_once __DIR__ . '/../TestHelper.php';

class Braintree_OAuthTest extends PHPUnit_Framework_TestCase
{
    function testCreateAccessToken()
    {
        $gateway = new Braintree_Gateway(array(
            'clientId' => 'client_id$development$integration_oauth_client_id',
            'clientSecret' => 'client_secret$development$integration_oauth_client_secret'
        ));
        $result = $gateway->oauth()->createAccessToken(array(
            'code' => 'integration_oauth_auth_code_' . rand(0,299)
        ));

        $this->assertEquals(true, $result->success);
        $accessToken = $result->accessToken;
        $this->assertNotNull($accessToken->token);
    }

    function testCreateAccessTokenFail()
    {
        $gateway = new Braintree_Gateway(array(
            'clientId' => 'client_id$development$integration_oauth_client_id',
            'clientSecret' => 'client_secret$development$integration_oauth_client_secret'
        ));
        $result = $gateway->oauth()->createAccessToken(array(
            'code' => 'bad_code'
        ));

        $this->assertEquals(false, $result->success);
        $accessToken = $result->accessToken;
        $this->assertEquals('invalid_grant', $accessToken->error);
        $this->assertEquals('code not found', $accessToken->message);
    }
}
